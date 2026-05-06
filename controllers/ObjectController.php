<?php
require_once "BasePhoneTwigController.php";

class ObjectController extends BasePhoneTwigController {
    public $template = "__object.twig";
    
    public function getContext(): array
    {
        
        $context = parent::getContext();
        
      
        $my_id = $this->params['my_id'] ?? $this->params[1] ?? 0;
        
        $show = $_GET['show'] ?? null;
        
        $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE id = :my_id");
        $query->execute(['my_id' => $my_id]);
        $object = $query->fetch();
        
        if (!$object) {
            
            $context['title'] = "Объект не найден";
            $context['my_id'] = $my_id;
            $context['description'] = "Объект с ID {$my_id} не существует";
            $context['is_infoActive'] = false;
            $context['is_imgActive'] = false;
            return $context;
        }
        
      
        $context['title'] = $object['title'];
        $context['url_title'] = "phone-object";
        $context['my_id'] = $my_id;
        $context['image'] = $object['image'] ?? "";
        $context['description'] = $object['description'] ?? "Нет описания";
        $context['info'] = $object['info'] ?? "Нет полной информации";
        

        if ($show === 'image') {
            $context['is_imgActive'] = true;
            $context['is_infoActive'] = false;
            $context['image_url'] = $object['image'] ?? "/images/placeholder.jpg";
        
            $this->template = "__object_image.twig";
        }
     
        else if ($show === 'info') {
            $context['is_imgActive'] = false;
            $context['is_infoActive'] = true;
         
            $this->template = "__object_info.twig";
        }
        
        else {
            $context['is_imgActive'] = false;
            $context['is_infoActive'] = false;
           
        }
        
        return $context;
    }
}