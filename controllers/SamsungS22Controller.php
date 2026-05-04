<?php

require_once "TwigBaseController.php";

class SamsungS22Controller extends TwigBaseController
{
    public $template = "object.twig";
    public $title = "Samsung S22";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context["url_title"] = "samsungS22";

        return $context;
    }
}