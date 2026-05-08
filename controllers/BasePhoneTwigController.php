<?php
require_once __DIR__ . "/../framework/TwigBaseController.php";

class BasePhoneTwigController extends TwigBaseController {
    public $template = "__object.twig";
    
    public function getContext(): array {
        $context = parent::getContext();
        
        
        $query = $this->pdo->query("SELECT id, name FROM object_types ORDER BY name");
        $types = $query->fetchAll();
        $context['types'] = $types;
        
        return $context;
    }
}