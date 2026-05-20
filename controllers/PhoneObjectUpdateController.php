<?php
require_once "BasePhoneTwigController.php";

class PhoneObjectUpdateController extends BasePhoneTwigController {
    public $template = "Add.twig";

    public function get(array $context) 
    {
        $id = $this->params['id'];
        
        $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE id = :id");
        $query->bindValue("id", $id);
        $query->execute();
        $context['object'] = $query->fetch();
        
        parent::get($context); 
    }

    public function post(array $context) {
        $id = $this->params['id'];
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $type = $_POST['type'] ?? 0;
        $info = $_POST['info'] ?? '';

        $image_url = $_POST['existing_image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        }

        $sql = "UPDATE phone_objects SET title = :title, description = :description, type = :type, info = :info, image = :image_url WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->bindValue("id", $id);
        $query->execute();
        
        $context['message'] = 'Вы успешно обновили объект';
        $context['id'] = $id;

        $this->get($context);
    }
}