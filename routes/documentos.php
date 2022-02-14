<?php
use App\Controllers\ProcesoController;

$router->get('/procesos', function() { 
    $controller = new ProcesoController();
    $controller->index();
});

$router->get('/departamentos-listar', function() { 
    $controller = new DepartamentoController();
    echo json_encode($controller->obtenerDepartamentos());
});