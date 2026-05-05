<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->prepare("SELECT description, id FROM phone_objects WHERE id= :my_id");
       
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();
        

        $context['description'] = $data['description'];
        $context['is_infoActive'] = true; 
        $context['is_imgActive'] = true; 
       
        return $context;
   }
 }

