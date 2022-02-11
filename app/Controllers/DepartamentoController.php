<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->render('departamentos/index');
    }

    public function obtenerDepartamentos()
    {
        $depa = new Departamento();
        return $depa->getAll();
    }

    
}