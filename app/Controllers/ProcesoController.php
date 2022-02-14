<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Tramite;

class ProcesoController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->render('procesos/v-procesos');
    }

    public function obtenerCodigos()
    {
        $codigo = new Codigo();
        return $codigo->getAll();
    }
}