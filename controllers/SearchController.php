<?php
require_once "BasePhoneTwigController.php";

class SearchController extends BasePhoneTwigController {
    public $template = "search.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        
        $sql = <<<EOL
SELECT id, title
FROM phone_objects
WHERE (:type = '' OR type = :type)
  AND (:title = '' OR title LIKE CONCAT('%', :title, '%'))
EOL;
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("type", $type);
        $query->bindValue("title", $title);
        $query->execute();
        
        $context['phone_objects'] = $query->fetchAll();
        $context['selected_type'] = $type;
        $context['search_title'] = $title;
        
        return $context;
    }
}