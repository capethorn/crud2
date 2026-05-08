<?php
require_once "BasePhoneTwigController.php";

class MainController extends BasePhoneTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        // Изменил type на type_id, чтобы не путаться
        $type_id = $_GET['type_id'] ?? '';
        
        if (!empty($type_id)) {
            // Теперь type - это число (id из object_types)
            $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE type = :type_id");
            $query->bindValue("type_id", $type_id);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM phone_objects");
        }
        
        $context['phone_objects'] = $query->fetchAll();
        
        return $context;
    }
}