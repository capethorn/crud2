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
require_once "../middlewares/HistoryMiddleware.php";
require_once "../controllers/SetWelcomeController.php";
require_once "../controllers/LoginController.php";       
require_once "../controllers/LogoutController.php";

$loader = new \Twig\Loader\FilesystemLoader("../views");
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$twig->addFilter(new \Twig\TwigFilter('url_decode', function ($url) {
    return urldecode($url);
}));

$pdo = new PDO("mysql:host=localhost;dbname=mobile_phone;charset=utf8", "root", "");

$router = new Router($twig, $pdo);

$historyMiddleware = new HistoryMiddleware();
$loginMiddleware = new LoginRequiredMiddeware();

$router->add("/", MainController::class)->middleware($historyMiddleware);
$router->add("/phone-object/(?P<my_id>\d+)", ObjectController::class)->middleware($historyMiddleware);
$router->add("/search", SearchController::class)->middleware($historyMiddleware);
$router->add("/add", PhoneObjectCreateController::class)
        ->middleware($loginMiddleware)
        ->middleware($historyMiddleware);
$router->add("/type/add", TypeCreateController::class)
        ->middleware($loginMiddleware)
        ->middleware($historyMiddleware);
$router->add("/phone-object/(?P<id>\d+)/delete", PhoneObjectDeleteController::class)
        ->middleware($loginMiddleware)
        ->middleware($historyMiddleware);
$router->add("/phone-object/(?P<id>\d+)/edit", PhoneObjectUpdateController::class)
        ->middleware($loginMiddleware)
        ->middleware($historyMiddleware);
$router->add("/set-welcome/", SetWelcomeController::class);
$router->add("/login", LoginController::class);
$router->add("/logout", LogoutController::class);
$router->get_or_default(Controller404::class);