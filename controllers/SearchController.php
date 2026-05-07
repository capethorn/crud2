<?php
require_once "BasePhoneTwigController.php";

class SearchController extends BasePhoneTwigController {
    public $template = "search.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        $type = $_GET['type'] ?? '';
        $title = $_GET['title'] ?? '';
        $description = $_GET['description'] ?? '';
        
        $sql = "SELECT * FROM phone_objects WHERE 1=1";
        $params = [];
        
        if (!empty($type) && $type != 'Все') {
            $sql .= " AND type = :type";
            $params['type'] = $type;
        }
        
        if (!empty($title)) {
            $sql .= " AND title LIKE :title";
            $params['title'] = "%{$title}%";
        }
        
        if (!empty($description)) {
            $sql .= " AND description LIKE :description";
            $params['description'] = "%{$description}%";
        }
        
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        
        $context['objects'] = $query->fetchAll();
        $context['old_type'] = $type;
        $context['old_title'] = $title;
        $context['old_description'] = $description;
        
        return $context;
    }
}