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
}