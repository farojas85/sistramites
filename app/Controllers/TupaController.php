<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Tupa;
use App\Models\TupaActiva;

class TupaController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index() 
    {

        $this->render('departamentos/index');
    }

    public function obtenerTupasActivas()
    {
        return Tupa::getTupasActivas();
    }
}