<?php

class Controller {
    protected function render($view, $data = []) {
        extract($data);
        $viewPath = "views/$view.php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View $view not found.");
        }
    }

    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
}
