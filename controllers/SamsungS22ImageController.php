<?php

require_once "SamsungS22Controller.php";

class SamsungS22ImageController extends SamsungS22Controller
{
    public $template = "object_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context["image_url"] = "/images/samsungS22.jpg";
        $context['is_imgActive'] = true; 
        return $context;
    }
}