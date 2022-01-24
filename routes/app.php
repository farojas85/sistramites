<?php

use Bramus\Router\Router;

use App\Controllers\Login;

$router = new  Router();

$router->before('GET','/', function(){
    if(isset($_SESSION['user'])){
        header('Location: home');
    } else {
        header('Location: login');
    }
});

$router->get('/', function (){
    echo "home";
});

$router->get('/login', function(){
    $controller = new Login();
    $controller->render('auth/login');
});