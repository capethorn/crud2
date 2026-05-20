<?php

class HistoryMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
         
        $currentUrl = $_SERVER['REQUEST_URI'];
        $excludeUrls = ['/set-welcome/', '/set-welcome', '/login', '/logout'];
        
        if (!in_array($currentUrl, $excludeUrls)) {
            if (!isset($_SESSION['history'])) {
                $_SESSION['history'] = [];
            }
            
            $_SESSION['history'] = array_slice(
                array_unique([$currentUrl, ...$_SESSION['history']]), 
                0, 
                10
            );
        }
        
        return true;
    }
}