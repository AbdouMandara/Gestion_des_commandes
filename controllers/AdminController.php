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
            'username' => $_SESSION['email'] ?? '',
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
        $clients = $this->clientModel->getAll();
        $this->render('admin/clients/list', ['clients' => $clients, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
    }

    public function clientAdd() {
        AuthController::checkAuth('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientModel->create($_POST);
            $this->redirect('/admin/clients');
        } else {
            $this->render('admin/clients/add', ['pendingOrdersCount' => $this->getPendingOrdersCount()]);
        }
    }

    public function clientEdit() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/clients');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->clientModel->update($id, $_POST);
            $this->redirect('/admin/clients');
        } else {
            $client = $this->clientModel->getById($id);
            $this->render('admin/clients/edit', ['client' => $client, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
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
        $products = $this->productModel->getAll();
        $this->render('admin/products/list', ['products' => $products, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
    }

    public function productAdd() {
        AuthController::checkAuth('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productModel->create($_POST);
            $this->redirect('/admin/products');
        } else {
            $this->render('admin/products/add', ['pendingOrdersCount' => $this->getPendingOrdersCount()]);
        }
    }

    public function productEdit() {
        AuthController::checkAuth('admin');
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect('/admin/products');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productModel->update($id, $_POST);
            $this->redirect('/admin/products');
        } else {
            $product = $this->productModel->getById($id);
            $this->render('admin/products/edit', ['product' => $product, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
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
        $orders = $this->orderModel->getAll();
        $this->render('admin/orders/list', ['orders' => $orders, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
    }

    public function orderAdd() {
        AuthController::checkAuth('admin');
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
                $this->render('admin/orders/add', ['clients' => $clients, 'products' => $products, 'error' => $error, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
            }
        } else {
            $clients = $this->clientModel->getAll();
            $products = $this->productModel->getAll();
            $this->render('admin/orders/add', ['clients' => $clients, 'products' => $products, 'pendingOrdersCount' => $this->getPendingOrdersCount()]);
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
}
