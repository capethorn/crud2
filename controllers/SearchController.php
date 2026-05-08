<?php
require_once "BasePhoneTwigController.php";

class SearchController extends BasePhoneTwigController {
    public $template = "search.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        $type = $_GET['type'] ?? '';
        $title = $_GET['title'] ?? '';
        $search_info = $_GET['info'] ?? '';
        
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
        
        if (!empty($search_info)) {
            $sql .= " AND info LIKE :info";
            $params['info'] = "%{$search_info}%";
        }
        
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        
        $context['objects'] = $query->fetchAll();
        $context['old_type'] = $type;
        $context['old_title'] = $title;
        $context['old_info'] = $search_info;
        
        return $context;
    }
}