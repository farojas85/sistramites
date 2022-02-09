<?php
use App\Controllers\TramiteController;

// $router->get('/departamentos', function() { 
//     $controller = new DepartamentoController();
//     $controller->index();
// });

$router->get('/tramites-por-departamento/(\d+)/(\w+)', function($depid,$estado){
    $controller = new TramiteController();
    //echo $depid;
    echo json_encode($controller->obtenerTramiteporDepartamento($depid,$estado));
});
