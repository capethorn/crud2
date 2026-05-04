<?php

require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/MainController.php";

require_once "../controllers/Iphone17Controller.php";
require_once "../controllers/Iphone17ImageController.php";
require_once "../controllers/Iphone17InfoController.php";

require_once "../controllers/SamsungS22Controller.php";
require_once "../controllers/SamsungS22ImageController.php";
require_once "../controllers/SamsungS22InfoController.php";

require_once "../controllers/Controller404.php";

$loader = new \Twig\Loader\FilesystemLoader("../views");
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

$pdo = new PDO("mysql:host=localhost;dbname=mobile_phone;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("#^/$#", MainController::class);
$router->add("#^/iphone17$#", Iphone17Controller::class);
$router->get_or_default(Controller404::class);


