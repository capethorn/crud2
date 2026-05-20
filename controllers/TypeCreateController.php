<?php
require_once "BasePhoneTwigController.php";

class TypeCreateController extends BasePhoneTwigController {
    public $template = "type_create.twig";
    public $title = "Добавление типа";
    
    public function get(array $context)
    {
        $query = $this->pdo->query("SELECT * FROM object_types ORDER BY id");
        $context['existing_types'] = $query->fetchAll();
        
        parent::get($context);
    }
    
    public function post(array $context)
    {
        $name = $_POST['name'] ?? '';
        
        $image_url = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name_file = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name_file");
            $image_url = "/media/$name_file";
        }
        
        $sql = "INSERT INTO object_types (name, image) VALUES (:name, :image)";
        $query = $this->pdo->prepare($sql);
        $query->bindValue("name", $name);
        $query->bindValue("image", $image_url);
        $query->execute();
        
        $query = $this->pdo->query("SELECT * FROM object_types ORDER BY id");
        $context['existing_types'] = $query->fetchAll();
        
        $context['message'] = "Тип '{$name}' успешно добавлен";
        $this->get($context);
    }
}