<?php
require_once 'controllers/AuthController.php';
require_once 'models/Produit.php';
require_once 'models/Commande.php';
require_once 'models/Client.php';

class HomeController extends Controller {
    private $productModel;
    private $orderModel;
    private $clientModel;

    public function __construct() {
        $this->productModel = new Produit();
        $this->orderModel = new Commande();
        $this->clientModel = new Client();
    }

    public function index() {
        AuthController::checkAuth();
        if ($_SESSION['role'] === 'admin') {
            $this->redirect('/admin/dashboard');
        }
        $this->render('home/index', ['username' => $_SESSION['username']]);
    }

    public function catalog() {
        AuthController::checkAuth();
        $products = $this->productModel->getAll();
        $this->render('home/catalog', ['products' => $products]);
    }

    public function myOrders() {
        AuthController::checkAuth();
        // For simplicity, we assume the user is linked to a client by their username or email
        // In a real app, there would be a link in the DB.
        // Here we'll just try to find a client with the same name/email or just show all for demo if it's the same.
        // Let's assume the "user" is actually a client.
        $stmt = Database::getInstance()->prepare("SELECT id FROM clients WHERE email = ?");
        $stmt->execute([$_SESSION['username'] . "@example.com"]); // Mock logic
        $client = $stmt->fetch();
        
        $orders = [];
        if ($client) {
            $orders = $this->orderModel->getAll($client['id']);
        }
        
        $this->render('home/orders', ['orders' => $orders]);
    }

    public function orderCreate() {
        AuthController::checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // In a real app, find the client_id linked to the logged-in user
            $stmt = Database::getInstance()->prepare("SELECT id FROM clients WHERE email = ?");
            $stmt->execute([$_SESSION['username'] . "@example.com"]);
            $client = $stmt->fetch();

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
                $this->render('home/order_add', ['products' => $products, 'error' => $error]);
            }
        } else {
            $products = $this->productModel->getAll();
            $this->render('home/order_add', ['products' => $products]);
        }
    }
}
