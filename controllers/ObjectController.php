<?php
require_once "BasePhoneTwigController.php";

class ObjectController extends BasePhoneTwigController {
    public $template = "__object.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        $my_id = $this->params['my_id'] ?? $this->params[1] ?? 0;
        

        $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE id = :my_id");
        $query->execute(['my_id' => $my_id]);
        $object = $query->fetch();
        
        if ($object) {
            $context['title'] = $object['title'];
            $context['url_title'] = "phone-object";
            $context['my_id'] = $my_id;
            $context['description'] = $object['description'] ?? "Нет описания";
            $context['image'] = $object['image'] ?? "";
        } else {
            $context['title'] = "Объект не найден";
            $context['my_id'] = $my_id;
            $context['description'] = "Объект с ID {$my_id} не существует";
        }
        
        return $context;
    }
}