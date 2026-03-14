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
        if (!isset($_SESSION['username'])) return null;
        $stmt = Database::getInstance()->prepare("SELECT id FROM clients WHERE email = ?");
        $stmt->execute([$_SESSION['username'] . "@example.com"]);
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
                    'username' => $_SESSION['username'] ?? '',
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
}
