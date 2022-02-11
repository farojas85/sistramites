<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\TipoDocumento;

class TipoDocumentoController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->render('departamentos/index');
    }

    public function obtenerTipoDocumentos()
    {
        return TipoDocumento::getAll();
    }

    public function guardarTipodocumento($POST)
    {
        return TipoDocumento::insertar($POST);
    }

    
}