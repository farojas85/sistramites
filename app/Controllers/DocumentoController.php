<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Tramite;

class DocumentoController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->render('documentos/index');
    }

    // public function obtenerDepartamentos()
    // {
    //     $depa = new Departamento();
    //     return $depa->getAll();
    // }
}