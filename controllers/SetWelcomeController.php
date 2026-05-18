<?php

class SetWelcomeController extends BaseController{
    public function get(array $contex) {
        $_SESSION['welcome_message'] = $_GET['message'];

        if (!isset($_SESSION['messages'])){
            $_SESSION['messages'] = [];
        }

        array_push($_SESSION['messages'], $_GET['message']);
        
        $url = $_SERVER['HTTP_REFERER'];
        header("Location: $url");
        exit;
    }
}