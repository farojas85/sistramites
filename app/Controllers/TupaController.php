<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Tupa;
use App\Models\TupaActiva;
use App\Models\TupaRequisito;
use App\Models\TupaArea;

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

    public function obtenerTupaRequisitoporId(int $turid)
    {
        return TupaRequisito::getByTupaId($turid);
    }

    public function obtenerDepartamentosTupaPorTupaId(int $id_tupa)
    {
        return TupaArea::getByDepartamentoPorTupa($id_tupa);
    }
}