<?php

class ObjectImageController extends TwigBaseController {
    public $template = "__object_image.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        // Получаем my_id из URL
        $my_id = $this->params['my_id'] ?? $this->params[1] ?? 0;
        
        // Запрашиваем данные объекта из БД
        $query = $this->pdo->prepare("SELECT * FROM phone_objects WHERE id = :my_id");
        $query->execute(['my_id' => $my_id]);
        $object = $query->fetch();
        
        if ($object) {
            $context['title'] = $object['title'];
            $context['url_title'] = "phone-object";
            $context['my_id'] = $my_id;
            $context['image_url'] = $object['image'] ?? "/images/placeholder.jpg";
            $context['is_imgActive'] = true;
        } else {
            $context['title'] = "Объект не найден";
            $context['my_id'] = $my_id;
            $context['image_url'] = "/images/error.gif";
        }
        
        return $context;
    }
}