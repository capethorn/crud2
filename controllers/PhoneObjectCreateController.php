<?php
require_once "BasePhoneTwigController.php";

class PhoneObjectCreateController extends BasePhoneTwigController {
    public $template = "Add.twig";

    public function get(array $context) 
    {
        echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); 
    }

    public function post(array $context) {
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $type = $_POST['type'] ?? 0;
        $info = $_POST['info'] ?? '';

        // Загрузка картинки
        $image_url = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = time() . '_' . $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        }

        $sql = <<<EOL
INSERT INTO phone_objects(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}