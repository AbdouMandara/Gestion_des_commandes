<?php
require_once 'models/User.php';

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    $this->redirect('/admin/dashboard');
                } else {
                    $this->redirect('/');
                }
            } else {
                $error = "Identifiants incorrects.";
                $this->render('auth/login', ['error' => $error]);
            }
        } else {
            $this->render('auth/login');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/login');
    }

    public static function checkAuth($role = null) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ./login");
            exit();
        }

        if ($role && $_SESSION['role'] !== $role) {
            http_response_code(403);
            die("Accès refusé.");
        }
    }
}
