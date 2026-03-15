<?php
require_once 'controllers/AuthController.php';
require_once 'models/Produit.php';
require_once 'models/Commande.php';
require_once 'models/Client.php';
require_once 'models/Notification.php';

class HomeController extends Controller {
    private $productModel;
    private $orderModel;
    private $clientModel;
    private $notificationModel;

    public function __construct() {
        $this->productModel = new Produit();
        $this->orderModel = new Commande();
        $this->clientModel = new Client();
        $this->notificationModel = new Notification();
    }

    private function getClient() {
        if (!isset($_SESSION['email'])) return null;
        $stmt = Database::getInstance()->prepare("SELECT id FROM clients WHERE email = ?");
        $stmt->execute([$_SESSION['email']]);
        return $stmt->fetch();
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['role'] === 'admin') {
                $this->redirect('/admin/dashboard');
            } else {
                // Client side
                $client = $this->getClient();
                $notifications = $client ? $this->notificationModel->getUnreadByClient($client['id']) : [];
                
                $this->render('home/index', [
                    'username' => $_SESSION['username'] ?? '', // Using email as username display for now
                    'notifications' => $notifications
                ]);
            }
        } else {
            // Public mode
            $products = $this->productModel->getAll();
            $this->render('home/public', ['products' => $products]);
        }
    }

    public function catalog() {
        AuthController::checkAuth();
        $products = $this->productModel->getAll();
        $client = $this->getClient();
        $notifications = $client ? $this->notificationModel->getUnreadByClient($client['id']) : [];
        $this->render('home/catalog', ['products' => $products, 'notifications' => $notifications]);
    }

    public function myOrders() {
        AuthController::checkAuth();
        $client = $this->getClient();
        
        $orders = [];
        $notifications = [];
        if ($client) {
            $orders = $this->orderModel->getAll($client['id']);
            $notifications = $this->notificationModel->getUnreadByClient($client['id']);
        }
        
        $this->render('home/orders', ['orders' => $orders, 'notifications' => $notifications]);
    }

    public function orderCreate() {
        AuthController::checkAuth();
        $client = $this->getClient();
        $notifications = $client ? $this->notificationModel->getUnreadByClient($client['id']) : [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$client) {
                die("Erreur : Aucun compte client associé à votre profil.");
            }

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
                $this->orderModel->create($client['id'], $items);
                $this->redirect('/my-orders');
            } catch (Exception $e) {
                $error = $e->getMessage();
                $products = $this->productModel->getAll();
                $this->render('home/order_add', ['products' => $products, 'error' => $error, 'notifications' => $notifications]);
            }
        } else {
            $products = $this->productModel->getAll();
            $this->render('home/order_add', ['products' => $products, 'notifications' => $notifications]);
        }
    }

    public function markNotificationsRead() {
        AuthController::checkAuth();
        $client = $this->getClient();
        if ($client) {
            if (isset($_GET['id'])) {
                $this->notificationModel->markAsRead($_GET['id']);
            } else {
                $this->notificationModel->markAsReadAll($client['id']);
            }
        }
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect('/');
        }
    }

    public function orderDetail() {
        AuthController::checkAuth();
        $id = $_GET['id'] ?? null;
        if (!$id) { http_response_code(400); echo json_encode(['error' => 'ID requis']); exit; }

        // Ensure the order belongs to this client
        $client = $this->getClient();
        if (!$client) { http_response_code(403); echo json_encode(['error' => 'Accès refusé']); exit; }

        $stmt = Database::getInstance()->prepare(
            "SELECT c.id, c.total_amount, c.status, c.created_at
             FROM commandes c WHERE c.id = ? AND c.client_id = ?"
        );
        $stmt->execute([$id, $client['id']]);
        $order = $stmt->fetch();

        if (!$order) { http_response_code(403); echo json_encode(['error' => 'Commande introuvable']); exit; }

        $items = $this->orderModel->getItems($id);

        $statusLabels = ['en attente' => 'En attente', 'en cours' => 'En cours', 'livree' => 'Livrée', 'rejetee' => 'Rejetée'];
        $order['status_label'] = $statusLabels[$order['status']] ?? ucfirst($order['status']);

        header('Content-Type: application/json');
        echo json_encode(['order' => $order, 'items' => $items]);
        exit;
    }
}
