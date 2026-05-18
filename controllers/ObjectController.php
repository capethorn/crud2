<?php
require_once "BasePhoneTwigController.php";

class ObjectController extends BasePhoneTwigController {
    public $template = "__object.twig";
    
    public function getContext(): array 
    {
        $context = parent::getContext();
        
        $my_id = $this->params['my_id'] ?? $this->params[1] ?? 0;
        
        $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE id = :my_id");
        $query->bindValue("my_id", $my_id);
        $query->execute();
        
        $data = $query->fetch();
        
        if (!$data) {
            $context['title'] = "Объект не найден";
            return $context;
        }
        
        $context['title'] = $data['title'];
        $context['description'] = $data['description'];
        $context['url_title'] = "phone-object/" . $data['id'];
        $context['my_id'] = $data['id'];
        $context['image'] = $data['image'];
        $context['info'] = $data['info'];
        
        $show = $_GET['show'] ?? '';
        
        if ($show == 'image') {
            $context['is_image'] = true;
            $context['is_info'] = false;
            $context['active'] = 'image';
        } else if ($show == 'info') {
            $context['is_info'] = true;
            $context['is_image'] = false;
            $context['active'] = 'info';
        } else {
            $context['is_image'] = false;
            $context['is_info'] = false;
            $context['active'] = '';
        }

        $context["my_session_message"] = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : "";

        $context["messages"] = isset($_SESSION['messages']) ? $_SESSION['messages'] : "";

        
        return $context;
    }
}