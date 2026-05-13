<?php

require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/MainController.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/PhoneObjectCreateController.php";
require_once "../controllers/TypeCreateController.php";
require_once "../controllers/PhoneObjectDeleteController.php";
require_once "../controllers/PhoneObjectUpdateController.php";
require_once "../middlewares/LoginRequiredMiddeware.php";

$loader = new \Twig\Loader\FilesystemLoader("../views");
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); 

$pdo = new PDO("mysql:host=localhost;dbname=mobile_phone;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/phone-object/(?P<my_id>\d+)", ObjectController::class);
$router->add("/search", SearchController::class);
$router->add("/add", PhoneObjectCreateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/type/add", TypeCreateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/phone-object/(?P<id>\d+)/delete", PhoneObjectDeleteController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/phone-object/(?P<id>\d+)/edit", PhoneObjectUpdateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->get_or_default(Controller404::class);