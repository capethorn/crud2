<?php
require_once "TwigBaseController.php";

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "Главная";
    
    public function getContext(): array {
        $context = parent::getContext();
        $context['menu_items'] = [
            [
                "title" => "Samsung S22",
                "url_title" => "samsungS22"
            ],
            [
                "title" => "Iphone 17",
                "url_title" => "iphone17"
            ]
        ];
        return $context;
    }
}