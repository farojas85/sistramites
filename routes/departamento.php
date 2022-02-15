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

$router->get('/departamento-por-id/(\d+)', function (int $depid) {
    $controller = new DepartamentoController();
    echo json_encode($controller->obtenerDepartamentoPorId($depid));
});

$router->get('/departamentos-filtro-listar', function() { 
    $controller = new DepartamentoController();
    echo json_encode($controller->obtenerFiltroDepartamentos());
});

