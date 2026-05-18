<?php
abstract class BaseController {
    public PDO $pdo; 
    public array $params;
    
    public function setPDO(PDO $pdo) { 
        $this->pdo = $pdo;
    }

    public function setParams(array $params) {
        $this->params = $params;
    }
    
    public function getContext(): array {
        return []; 
    }
    
    public function process_response() {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params(60 * 60 * 10);
            session_start();
        }
        
        $currentUrl = $_SERVER['REQUEST_URI'];
        if ($currentUrl != '/set-welcome/' && $currentUrl != '/set-welcome' && $currentUrl != '/login' && $currentUrl != '/logout') {
            if (!isset($_SESSION['history'])) $_SESSION['history'] = [];
            $_SESSION['history'] = array_slice(array_unique([$currentUrl, ...$_SESSION['history']]), 0, 10);
        }
        
        $method = $_SERVER['REQUEST_METHOD'];
        $context = $this->getContext();
        $context['history'] = $_SESSION['history'] ?? [];
        $context['session_is_logged'] = $_SESSION['is_logged'] ?? false;
        
        if ($method == 'GET') {
            $this->get($context);
        } else if ($method == 'POST') {
            $this->post($context);
        }
    }

    public function get(array $context) {}
    public function post(array $context) {}
}