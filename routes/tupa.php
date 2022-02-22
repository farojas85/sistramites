<?php
use App\Controllers\TupaController;

$router->get('/tupas-activas-listar', function(){
    $controller = new TupaController();
    echo json_encode($controller->obtenerTupasActivas());
});

$router->get('/tupa-requisito-por-id/(\d+)', function($id_tupa){
    $controller = new TupaController();
    echo json_encode($controller->obtenerTupaRequisitoporId($id_tupa));
});

$router->get('/tupa-departamento-por-tupa/(\d+)', function($id_tupa){
    $controller = new TupaController();
    echo json_encode($controller->obtenerDepartamentosTupaPorTupaId($id_tupa));
});

// $router->get('/cantidad-documentos/(\d+)', function($depid){
//     $controller =new TupaController();
//     echo json_encode($controller->obtenerCantidadDocumentos($depid));
// });
