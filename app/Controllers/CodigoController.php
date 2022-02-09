<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Codigo;

class CodigoController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {
        $this->render('departamentos/index');
    }

    public function obtenerCodigos()
    {
        $codigo = new Codigo();
        return $codigo->getAll();
    }
}