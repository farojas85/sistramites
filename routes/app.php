<?php
use Bramus\Router\Router;
use App\Controllers\Login;
use App\Controllers\Home;
use App\Controllers\DepartamentoController;

$router = new Router();
session_start();
//$user = unserialize($_SESSION['user']);


$router->before('GET','/', function(){
    if(isset($_SESSION['usu_usuario'])){
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

$router->get('/logout', function() {
    session_destroy();
    header('location: login');
});

$router->get('/home', function() { 
    $controller = new Home();
    $controller->index();
});

$router->get('/departamentos-listar', function() { 
    $controller = new DepartamentoController();
    echo json_encode($controller->obtenerDepartamentos());
});

$router->run();