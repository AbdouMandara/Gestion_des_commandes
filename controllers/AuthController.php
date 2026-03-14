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

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                $this->render('auth/register', ['error' => "Veuillez remplir les champs obligatoires."]);
                return;
            }

            // Check if email/username already exists
            if ($this->userModel->findByUsername($email)) {
                $this->render('auth/register', ['error' => "Cette adresse e-mail est déjà utilisée."]);
                return;
            }

            try {
                // We assume user creation also generates a Client profile based on the user's instructions.
                $this->userModel->create($email, $password, 'user');
                $user = $this->userModel->findByUsername($email);

                // Create associated client profile
                require_once 'models/Client.php';
                $clientModel = new Client();
                $clientModel->create([
                    'name' => $name,
                    'email' => $email, // Using email as username
                    'phone' => $phone,
                    'address' => $address
                ]);

                // Auto login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                $this->redirect('/');
            } catch (Exception $e) {
                $this->render('auth/register', ['error' => "Erreur lors de l'inscription. Veuillez réessayer."]);
            }
        } else {
            $this->render('auth/register');
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
