<?php
use App\Controllers\DepartamentoController;

$router->get('/departamentos', function() { 
    $controller = new DepartamentoController();
    $controller->index();
});

$router->get('/departamentos-listar', function() { 
    $controller = new DepartamentoController();
    echo json_encode($controller->obtenerDepartamentos());
});