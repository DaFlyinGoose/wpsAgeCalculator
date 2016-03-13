<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * This is the start up script, if I was using a more complex framework the initial
 * booting would occur here, since I'm trying to keep it relatively simple, all
 * that is happening here is the routing to the single controller we use.
 */
// Include all our cool composer packages and Laravels helper functions
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../vendor/illuminate/support/helpers.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Screen request method for any tampering of the HTTP request
$requestMethod = 'get';
if (in_array(strtolower($_SERVER['REQUEST_METHOD']), ['get', 'post'])) {
    $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
}
$classMethod = $requestMethod . camel_case($path);

$controller = new \Controllers\HomeController();

// We should have a method name based on the URL and the request method, if this
// method exists we will call it, else route to getIndex
if (method_exists($controller, $classMethod)) {
    $controller->$classMethod();
} else {
    $classMethod = $requestMethod . 'Index';
    $controller->$classMethod();
}



