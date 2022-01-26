<?php

namespace App\Controllers;

use App\Sets\Controller;
use App\Models\Usuario;

class Home extends Controller
{
    private Usuario $user;

    function __construct()
    {
        parent::__construct();

        $this->user =Usuario::get($_SESSION['usu_usuario']);
    }

    public function index(){
        $this->render('home/index', ['user' => $this->user]);
    }
}