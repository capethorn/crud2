<?php
require_once "BasePhoneTwigController.php";

class SearchController extends BasePhoneTwigController {
    public $template = "search.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext();


        return $context;
    }
}