<?php
use App\Controllers\CodigoController;

// $router->get('/departamentos', function() { 
//     $controller = new DepartamentoController();
//     $controller->index();
// });

$router->get('/codigos-listar', function() { 
    $controller = new CodigoController();
    echo json_encode($controller->obtenerCodigos());
});
