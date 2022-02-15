
<?php
use App\Controllers\TipoDocumentoController;

$router->get('/tipo-documentos', function() { 
    $controller = new TipoDocumentoController();
    $controller->index();
});

$router->get('/tipo-documentos-listar', function() { 
    $controller = new TipoDocumentoController();
    echo json_encode($controller->obtenerTipoDocumentos());
});

$router->get('/tipo-documento-por-id/(\d+)', function (int $depid) {
    $controller = new TipoDocumentoController();
    //echo json_encode($controller->obten($depid));
});