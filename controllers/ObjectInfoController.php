<?php

class ObjectInfoController extends TwigBaseController {
    public $template = "__object_info.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();
        
        // Получаем my_id из URL
        $my_id = $this->params['my_id'] ?? $this->params[1] ?? 0;
        
        // Запрашиваем данные объекта из БД - берем поле info
        $query = $this->pdo->prepare("SELECT title, info, image FROM phone_objects WHERE id = :my_id");
        $query->execute(['my_id' => $my_id]);
        $object = $query->fetch();
        
        if ($object) {
            $context['title'] = $object['title'];
            $context['url_title'] = "phone-object";
            $context['my_id'] = $my_id;
            $context['info'] = $object['info'] ?? "Нет информации";  // берем info из БД
            $context['is_infoActive'] = true;
        } else {
            $context['title'] = "Объект не найден";
            $context['my_id'] = $my_id;
            $context['info'] = "Информация не найдена";
        }
        
        return $context;
    }
}