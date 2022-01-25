<?php

namespace App\Controller;

use App\Sets\Controller;
use App\Models\Usuario;

class Home extends Controller
{
    private Usuario $user;
    function __construct(Usuario $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    public function index(){
        $this->render('home/index', ['user' => $this->user]);
    }
}