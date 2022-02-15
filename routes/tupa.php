<?php
use App\Controllers\TupaController;

$router->get('/tupas-activas-listar', function(){
    $controller = new TupaController();
    echo json_encode($controller->obtenerTupasActivas());
});

// $router->get('/cantidad-documentos/(\d+)', function($depid){
//     $controller =new TupaController();
//     echo json_encode($controller->obtenerCantidadDocumentos($depid));
// });
