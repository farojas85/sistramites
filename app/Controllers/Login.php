<?php

namespace App\Controllers;
use App\Sets\Controller;
use App\Models\Usuario;
use App\Models\Grupo;
use App\Models\Departamento;
class Login extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function autenticar($data){
        if(isset($data['usuario']) && isset($data['password'])){
            $usuario = $data['usuario'];
            $password = $data['password'];

            if(Usuario::exists($usuario)){
                // error_log('si existe');
                // error_log('usuario: '.$usuario);
                $user = Usuario::get($usuario);
    
                
                if($user->compararPassword($usuario,$password)){
                    $_SESSION['correo'] = $user->usu_email;
                    $_SESSION['usu_usuario'] = $user->usu_usuario;
                    $_SESSION['gru_id'] = $user->gru_id;
                    $grupo = Grupo::getById($user->gru_id);
                    $_SESSION['gru_nombre'] = $grupo->gru_nombre;
                    $_SESSION['usu_id'] = $user->usu_id;
                    $_SESSION['usuario_valido'] = $user->usu_id;
                    $_SESSION["dep_id"] = $user->dep_id;
                    $depa = Departamento::getById($user->dep_id);
                    $_SESSION['dep_nombre'] = $depa->dep_nombre;
                    $_SESSION['dep_abrevia'] = $depa->dep_abrevia;

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