<?php
use App\Controllers\ProcesoController;
use App\Controllers\DepartamentoController;

$router->get('/procesos', function() { 
    $controller = new ProcesoController();
    $controller->index();
});

$router->get('/departamentos-listar', function() { 
    $controller = new DepartamentoController();
    echo json_encode($controller->obtenerDepartamentos());
});