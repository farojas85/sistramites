<?php
use App\Controllers\TramiteController;

$router->get('/tramites-por-departamento/(\d+)/(\w+)', function($depid,$estado){
    $controller = new TramiteController();
    //echo $depid;
    echo json_encode($controller->obtenerTramiteporDepartamento($depid,$estado));
});

$router->get('/cantidad-documentos/(\d+)', function($depid){
    $controller =new TramiteController();
    echo json_encode($controller->obtenerCantidadDocumentos($depid));
});
