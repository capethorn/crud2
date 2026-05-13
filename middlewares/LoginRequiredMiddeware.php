<?php

class LoginRequiredMiddeware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        $pdo = $controller->pdo;
        
       
        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
        
        
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $query = $pdo->prepare($sql);
        $query->bindValue("username", $user);
        $query->bindValue("password", $password);
        $query->execute();
        
        $userData = $query->fetch();
        
        
        if (!$userData) {
            header('WWW-Authenticate: Basic realm="Phone Objects Admin"');
            http_response_code(401); 
            exit; 
        }
    }
}