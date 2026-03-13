<?php
session_start();

// Autoload (simple version for this project)
require_once 'config/database.php';
require_once 'models/Model.php';
require_once 'controllers/Controller.php';
require_once 'routes/Router.php';

$router = new Router();

// Define routes
$router->add('/', 'HomeController', 'index');
$router->add('/catalog', 'HomeController', 'catalog');
$router->add('/my-orders', 'HomeController', 'myOrders');
$router->add('/order/create', 'HomeController', 'orderCreate');
$router->add('/login', 'AuthController', 'login');
$router->add('/logout', 'AuthController', 'logout');
$router->add('/admin/dashboard', 'AdminController', 'index');

// Clients CRUD
$router->add('/admin/clients', 'AdminController', 'clientsList');
$router->add('/admin/clients/add', 'AdminController', 'clientAdd');
$router->add('/admin/clients/edit', 'AdminController', 'clientEdit');
$router->add('/admin/clients/delete', 'AdminController', 'clientDelete');

// Products CRUD
$router->add('/admin/products', 'AdminController', 'productsList');
$router->add('/admin/products/add', 'AdminController', 'productAdd');
$router->add('/admin/products/edit', 'AdminController', 'productEdit');
$router->add('/admin/products/delete', 'AdminController', 'productDelete');

// Orders Management
$router->add('/admin/orders', 'AdminController', 'ordersList');
$router->add('/admin/orders/add', 'AdminController', 'orderAdd');
$router->add('/admin/orders/status', 'AdminController', 'orderUpdateStatus');
$router->add('/admin/orders/delete', 'AdminController', 'orderDelete');

// Dispatch request
$url = $_SERVER['REQUEST_URI'] ?? '/';
$router->dispatch($url);
