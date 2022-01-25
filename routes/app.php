<?php
use Bramus\Router\Router;
use App\Controllers\Login;
use App\Controllers\Home;

$router = new Router();
session_start();
//$user = unserialize($_SESSION['user']);


$router->before('GET','/', function(){
    if(isset($_SESSION['user'])){
        header('Location: home');
    } else {
        header('Location: login');
    }
});

$router->get('/', function (){
    echo "home asdasd";
    // $controller = new Login();
    // $controller->render('auth/login');
});

$router->get('/login', function(){
    $controller = new Login();
    $controller->render('auth/login');
});

$router->post('/auth', function() {
    $controller = new Login();
    $controller->autenticar($_POST);
});

$router->get('/home', function() { 
    global $user;
    $controller = new Home($user);
    $controller->index();
});

$router->run();