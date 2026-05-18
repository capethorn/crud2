<?php

class LoginRequiredMiddeware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] !== true) {
            header("Location: /login");
            exit;
        }
    }
}