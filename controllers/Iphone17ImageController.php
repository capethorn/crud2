<?php

require_once "Iphone17Controller.php";

class Iphone17ImageController extends Iphone17Controller
{
    public $template = "object_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context["image_url"] = "/images/Iphone17pro.jpg";
        $context['is_imgActive'] = true; 

        return $context;
    }
}