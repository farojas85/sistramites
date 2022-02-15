<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Usuario extends Model
{
    public int $usu_id;
    public string $usu_dni;
    public string $usu_nombre_apellido;
    public int $dep_id;
    public string $usu_usuario;
    public string $usu_clave;
    public int $gru_id;
    public $usu_fregistro;
    public $usu_vigencia;
    public string $usu_email;
    public int $usu_estatus;
    public string $usu_observacion;

    public function __construct( $username,  $password)
    {
        parent::__construct();
        $this->usu_id = 0;
        $this->usu_dni = "";
        $this->usu_nombre_apellido ="";
        $this->dep_id = 0;
        $this->usu_usuario = $username;
        $this->usu_clave = $password;
        $this->gru_id = 0;
        $this->usu_fregistro = "";
        $this->usu_vigencia= "";
        $this->usu_email = "";
        $this->usu_estatus = 1;
        $this->usu_observacion = "";
    }

    public static function exists($usuario){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT usu_usuario FROM usuarios WHERE usu_usuario = :usuario');
            $query->execute( ['usuario' => $usuario]);
            
            if($query->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public static function get($usuario){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM usuarios WHERE usu_usuario = :usuario');
            $query->execute([ 'usuario' => $usuario]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $user = new Usuario($data['usu_usuario'], $data['usu_clave']);
            
            $user->usu_id = $data['usu_id'];
            $user->usu_email=$data['usu_email'];
            $user->usu_usaurio = $data['usu_usuario'];
            $user->usu_clave=$data['usu_clave'];
            $user->gru_id = $data['gru_id'];
            $user->dep_id = $data['dep_id'];
            
            return $user;
        }catch(PDOException $e){
            return false;
        }
    }

    public function compararPassword(string $usuario,string $password){
        try{
            $codificar = substr ($usuario, 0, 2);
            $pass_crypt = crypt ($password, $codificar);
            $usu = Usuario::get($usuario);
            return $usu->usu_clave == $pass_crypt;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }
    // public function publish(Post $post){
    //     $res = $post->publish($this->id);
    //     array_push($this->posts, $res);
    // }

    // public function fetchPosts(){
    //     $this->posts = PostImage::getAll($this->getId());
    // }
}