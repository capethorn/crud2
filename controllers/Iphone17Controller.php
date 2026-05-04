<?php

// require_once "TwigBaseController.php";

class Iphone17Controller extends TwigBaseController
{
    public $template = "object.twig";
    public $title = "Iphone 17";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context["url_title"] = "iphone17";

        return $context;
    }
}