<?php

use App\Controllers\DocumentoController;

$router->get('/documentos', function() { 
    $controller = new DocumentoController();
    $controller->index();
});

// $router->get('/departamentos-listar', function() { 
//     $controller = new DepartamentoController();
//     echo json_encode($controller->obtenerDepartamentos());
// });
