<?php

require_once "SamsungS22Controller.php";

class SamsungS22InfoController extends SamsungS22Controller
{
    public $template = "samsungS22_info.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $context["info"] = "Samsung Galaxy S22 — флагманский смартфон Samsung с отличным дисплеем, камерой и высокой скоростью работы.";

        return $context;
    }
}