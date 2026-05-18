<?php

class LogoutController extends BaseController {
    public function get(array $context) {
        session_start();
        $_SESSION['is_logged'] = false;
        session_destroy();
        header("Location: /login");
        exit;
    }
}