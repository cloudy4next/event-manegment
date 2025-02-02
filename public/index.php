<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);



$request = $_SERVER['REQUEST_URI'];
if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . parse_url($request, PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/EventController.php';
require_once __DIR__ . '/../app/controllers/RegistrationController.php';
require_once __DIR__ . '/../app/controllers/ReportController.php';

session_start();
$requestUri = $_SERVER['REQUEST_URI'];

$url = trim($requestUri, '/');

// echo "Requested URL: " . $url . "<br>"; 


switch ($url) {
    case '':
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'events':
    case 'events/index':
        $controller = new EventController();
        $controller->index();
        break;
    case 'events/create':
        $controller = new EventController();
        $controller->create();
        break;
    case 'events/store':
        $controller = new EventController();
        $controller->store();
        break;
    case (preg_match('/^events\/edit\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new EventController();
        $controller->edit($matches[1]);
        break;
    case (preg_match('/^events\/update\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new EventController();
        $controller->update($matches[1]);
        break;
    case (preg_match('/^events\/delete\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new EventController();
        $controller->delete($matches[1]);
        break;
    case (preg_match('/^events\/view\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new EventController();
        $controller->view($matches[1]);
        break;
    case (preg_match('/^registrations\/store\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new RegistrationController();
        $controller->store($matches[1]);
        break;
    case (preg_match('/^reports\/event\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new ReportController();
        $controller->downloadEventReport($matches[1]);
        break;
    case 'registrations':
        $controller = new RegistrationController();
        $controller->index();
        break;
    case (preg_match('/^registrations\/list\/([0-9]+)\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new RegistrationController();
        $controller->listRegistrations($matches[1], $matches[2]);
        break;
    case (preg_match('/^api\/event\/([0-9]+)$/', $url, $matches) ? true : false):
        $controller = new EventController();
        $controller->getEventDetails($matches[1]);
        break;
    case (preg_match('/^api\/event\/([0-9]+)\/attendance$/', $url, $matches) ? true : false):
        $controller = new EventController();
        $controller->getEventDetailsWithAttendance($matches[1]);
        break;
    default:
        echo "404 Not Found";
        break;
}
