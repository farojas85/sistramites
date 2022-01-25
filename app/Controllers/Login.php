<?php

namespace App\Controllers;
use App\Sets\Controller;
use App\Models\Usuario;

class Login extends Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function autenticar($data){
        if(isset($data['usuario']) && isset($data['password'])){
            $usuario = $data['usuario'];
            $password = $data['password'];

            if(Usuario::exists($usuario)){
                error_log('si existe');
                error_log('usuario: '.$usuario);
                $user = Usuario::get($usuario);
                
                if($user->compararPassword($usuario,$password)){
                    $_SESSION['correo'] = $user->getUsuEmail();
                    $_SESSION['usu_usuario'] = $user->getUsuUsuario();
                    $_SESSION['gru_id'] = $user->getGruId();
                    $_SESSION['usu_id'] = $user->getUsuId();
                    $_SESSION['usuario_valido'] = $user->getUsuId();
                    $_SESSION["dep_id"] = $user->getDepId();
                    header('location: home');
                }else{
                    echo "password incorrecto";
                }
            }else{
                header('location: login');
            }
        }else{
            $this->render('errors/index');
        }
    }

   
}