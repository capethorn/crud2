<?php
require_once "BasePhoneTwigController.php";

class MainController extends BasePhoneTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    
    public function getContext(): array
    {
        $context = parent::getContext();

        if (isset($_GET['type']) && !empty($_GET['type'])){
            $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            
            $query = $this->pdo->query("SELECT * FROM phone_objects");
        }
        
        $context['phone_objects'] = $query->fetchAll();

        return $context;
    }
}