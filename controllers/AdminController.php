<?php
require_once 'models/Client.php';
require_once 'models/User.php';
require_once 'models/Produit.php';
require_once 'models/Commande.php';
require_once 'controllers/AuthController.php';

class AdminController extends Controller {
    private $clientModel;
    private $productModel;
    private $orderModel;

    public function __construct() {
        $this->clientModel = new Client();
        $this->productModel = new Produit();
        $this->orderModel = new Commande();
    }

    private function getPendingOrdersCount() {
        $stmt = Database::getInstance()->query("SELECT COUNT(*) FROM commandes WHERE status = 'en attente'");
        return $stmt->fetchColumn();
    }

    public function index() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        
        $clientCount = $this->clientModel->getCount();
        $productCount = $this->productModel->getCount(); 
        $orderCount = $this->orderModel->getCount();
        
        // Fetch recent orders (last 5)
        $recentOrders = $this->orderModel->getAll();
        $recentOrders = array_slice($recentOrders, 0, 5);
        
        // Fetch total revenue
        $stmt = Database::getInstance()->query("SELECT SUM(total_amount) FROM commandes WHERE status = 'livrée'");
        $totalRevenue = $stmt->fetchColumn() ?: 0;

        $this->render('admin/dashboard', [
            'username' => $admin['username'] ?? $_SESSION['email'],
            'clientCount' => $clientCount,
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'recentOrders' => $recentOrders,
            'totalRevenue' => $totalRevenue,
            'pendingOrdersCount' => $this->getPendingOrdersCount()
        ]);
    }

    // CLIENTS MANAGEMENT
    public function clientsList() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        $clients = $this->clientModel->getAll();
        $this->render('admin/clients/list', [
            'clients' => $clients, 
            'pendingOrdersCount' => $this->getPendingOrdersCount(),
            'username' => $admin['username'] ?? $_SESSION['email']
        ]);
    }

    public function clientAdd() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            if (!empty($name) && !empty($email) && !empty($password)) {
                $userModel = new User();
                // Create user first
                $userModel->create($name, $email, $password, 'client');
                
                // Then create client profile
                $this->clientModel->create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address
                ]);
            }
            $this->redirect('/admin/clients');
        } else {
            $this->render('admin/clients/add', [
                'pendingOrdersCount' => $this->getPendingOrdersCount(),
                'username' => $admin['username'] ?? $_SESSION['email']
            ]);
        }
    }



    public function clientDelete() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->clientModel->delete($id);
        }
        $this->redirect('/admin/clients');
    }

    // PRODUCTS MANAGEMENT
    public function productsList() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        $products = $this->productModel->getAll();
        $this->render('admin/products/list', [
            'products' => $products, 
            'pendingOrdersCount' => $this->getPendingOrdersCount(),
            'username' => $admin['username'] ?? $_SESSION['email']
        ]);
    }

    public function productAdd() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productModel->create($_POST);
            $this->redirect('/admin/products');
        } else {
            $this->render('admin/products/add', [
                'pendingOrdersCount' => $this->getPendingOrdersCount(),
                'username' => $admin['username'] ?? $_SESSION['email']
            ]);
        }
    }

    public function productEdit() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/products');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productModel->update($id, $_POST);
            $this->redirect('/admin/products');
        } else {
            $product = $this->productModel->getById($id);
            $this->render('admin/products/edit', [
                'product' => $product, 
                'pendingOrdersCount' => $this->getPendingOrdersCount(),
                'username' => $admin['username'] ?? $_SESSION['email']
            ]);
        }
    }

    public function productDelete() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->productModel->delete($id);
        }
        $this->redirect('/admin/products');
    }

    // ORDERS MANAGEMENT
    public function ordersList() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        $orders = $this->orderModel->getAll();
        $this->render('admin/orders/list', [
            'orders' => $orders, 
            'pendingOrdersCount' => $this->getPendingOrdersCount(),
            'username' => $admin['username'] ?? $_SESSION['email']
        ]);
    }

    public function orderAdd() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $admin = $userModel->findByEmail($_SESSION['email']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client_id = $_POST['client_id'];
            $items = [];
            foreach ($_POST['products'] as $index => $product_id) {
                if (!empty($product_id)) {
                    $items[] = [
                        'id' => $product_id,
                        'quantity' => $_POST['quantities'][$index]
                    ];
                }
            }
            try {
                $this->orderModel->create($client_id, $items);
                $this->redirect('/admin/orders');
            } catch (Exception $e) {
                $error = $e->getMessage();
                $clients = $this->clientModel->getAll();
                $products = $this->productModel->getAll();
                $this->render('admin/orders/add', [
                    'clients' => $clients, 
                    'products' => $products, 
                    'error' => $error, 
                    'pendingOrdersCount' => $this->getPendingOrdersCount(),
                    'username' => $admin['username'] ?? $_SESSION['email']
                ]);
            }
        } else {
            $clients = $this->clientModel->getAll();
            $products = $this->productModel->getAll();
            $this->render('admin/orders/add', [
                'clients' => $clients, 
                'products' => $products, 
                'pendingOrdersCount' => $this->getPendingOrdersCount(),
                'username' => $admin['username'] ?? $_SESSION['email']
            ]);
        }
    }

    public function orderUpdateStatus() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;
        if ($id && $status) {
            $this->orderModel->updateStatus($id, $status);
        }
        $this->redirect('/admin/orders');
    }

    public function orderDelete() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->orderModel->delete($id);
        }
        $this->redirect('/admin/orders');
    }

    public function orderDetail() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }

        $stmt = Database::getInstance()->prepare(
            "SELECT c.id, c.total_amount, c.status, c.created_at, cl.name as client_name
             FROM commandes c JOIN clients cl ON c.client_id = cl.id WHERE c.id = ?"
        );
        $stmt->execute([$id]);
        $order = $stmt->fetch();

        $items = $this->orderModel->getItems($id);

        $statusLabels = ['en attente' => 'En attente', 'en cours' => 'En cours', 'livree' => 'Livrée', 'rejetee' => 'Rejetée'];
        $order['status_label'] = $statusLabels[$order['status']] ?? ucfirst($order['status']);

        header('Content-Type: application/json');
        echo json_encode(['order' => $order, 'items' => $items]);
        exit;
    }

    public function settings() {
        AuthController::checkAuth('admin');
        $userModel = new User();
        $user = $userModel->findByEmail($_SESSION['email']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            
            if ($userModel->updateProfile($user['id'], $data)) {
                $_SESSION['email'] = $data['email'];
                $this->redirect('/admin/settings?success=1');
            } else {
                $error = "Erreur lors de la mise à jour.";
                $this->render('admin/settings', [
                    'user' => $user, 
                    'error' => $error, 
                    'pendingOrdersCount' => $this->getPendingOrdersCount(),
                    'username' => $user['username'] ?? $_SESSION['email']
                ]);
            }
        } else {
            $this->render('admin/settings', [
                'user' => $user, 
                'pendingOrdersCount' => $this->getPendingOrdersCount(),
                'username' => $user['username'] ?? $_SESSION['email']
            ]);
        }
    }
}
