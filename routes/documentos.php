<?php

use App\Controllers\DocumentoController;
use App\Controllers\TipoDocumentoController;

$router->get('/documentos', function() { 
    $controller = new DocumentoController();
    $controller->index();
});

$router->get('/tipo-documentos-listar',function(){
    $controller = new TipoDocumentoController();
    echo json_encode($controller->obtenerTipoDocumentos());
});

$router->post('tipo-documentos-guardar',function() {
    $controller = new TipoDocumentoController();
    echo json_encode($controller->guardarTipodocumento($_POST));
});

// $router->get('/departamentos-listar', function() { 
//     $controller = new DepartamentoController();
//     echo json_encode($controller->obtenerDepartamentos());
// });
