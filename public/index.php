<?php

require_once "../vendor/autoload.php";

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

$url = $_SERVER["REQUEST_URI"];

$controller = new Controller404($twig);

$pdo = new PDO("mysql:host=localhost;dbname=mobile_phone;charset=utf8", "root", "");

if ($url == "/") {
    $controller = new MainController($twig);

} elseif (preg_match("#^/iphone17/image#", $url)) {
    $controller = new Iphone17ImageController($twig);

} elseif (preg_match("#^/iphone17/info#", $url)) {
    $controller = new Iphone17InfoController($twig);

} elseif (preg_match("#^/iphone17#", $url)) {
    $controller = new Iphone17Controller($twig);

} elseif (preg_match("#^/samsungS22/image#", $url)) {
    $controller = new SamsungS22ImageController($twig);

} elseif (preg_match("#^/samsungS22/info#", $url)) {
    $controller = new SamsungS22InfoController($twig);

} elseif (preg_match("#^/samsungS22#", $url)) {
    $controller = new SamsungS22Controller($twig);
}

if ($controller) {
    $controller->setPDO($pdo); 
    $controller->get();
}

