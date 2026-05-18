<?php
require_once "BasePhoneTwigController.php";

class LoginController extends BasePhoneTwigController {
    public $template = "__login.twig";
    
    public function getContext(): array {
        $context = parent::getContext();
        $context['title'] = 'Вход на сайт';
        return $context;
    }
    
    public function post(array $context) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $query->bindValue("username", $username);
        $query->bindValue("password", $password);
        $query->execute();
        
        $user = $query->fetch();
        
        if ($user) {
            $_SESSION['is_logged'] = true;
            $_SESSION['username'] = $username;
            header("Location: /");
            exit;
        } else {
            $context['error'] = 'Неверное имя пользователя или пароль';
            $context['title'] = 'Вход на сайт';
            $this->get($context);
        }
    }
}