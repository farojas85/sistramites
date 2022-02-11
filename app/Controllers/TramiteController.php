<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Tramite;

class TramiteController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->render('departamentos/index');
    }

    public function obtenerTramiteporDepartamento($depid,$estado)
    {
        $tramite = new Tramite();
        return $tramite->getByDepartamentoId($depid,$estado);
    }

    public function obtenerCantidadDocumentos(int $depid)
    {
        return [
            'cantidad_pendientes' => Tramite::getContarPendintes($depid),
            'cantidad_recibidos' => Tramite::getContarRecibidos($depid),
            'cantidad_derivados' => Tramite::getContarDerivados($depid),
            'cantidad_archivados' => Tramite::getContarArchivados($depid),
            'cantidad_doccreados' => Tramite::getContarDocumentosCreados()
        ];
    }
}