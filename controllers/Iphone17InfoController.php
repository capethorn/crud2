<?php

require_once "Iphone17Controller.php";

class Iphone17InfoController extends Iphone17Controller
{
    public $template = "iphone17_info.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context["info"] = "iPhone 17 — современный смартфон Apple с улучшенной камерой, мощным процессором и высокой производительностью.";
        $context['is_infoActive'] = true; 

        return $context;
    }
}