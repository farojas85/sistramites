<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Usuario extends Model
{
    private int $usu_id;
    private string $usu_dni;
    private string $usu_nombre_apellido;
    private int $dep_id;
    private string $usu_usuario;
    private string $usu_clave;
    private int $gru_id;
    private $usu_fregistro;
    private $usu_vigencia;
    private string $usu_email;
    private int $usu_estatus;
    private string $usu_observacion;

    public function __construct(string $username, string $password)
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

    public static function exists(string $usuario){
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
            error_log($data['usu_usuario']);
            error_log($data['usu_clave']);
            $user = new Usuario($data['usu_usuario'], $data['usu_clave']);
            $user->setUsuId($data['usu_id']);
            $user->setUsuEmail($data['usu_email']);
            $user->setUsuUsuario($data['usu_usuario']);
            $user->setUsuClave($data['usu_clave']);
            $user->setGruId($data['gru_id']);
            $user->setDepId($data['dep_id']);
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
            return $usu->getUsuClave() == $pass_crypt;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function getUsuId():string{
        return $this->usu_id;
    }

    public function setUsuId(string $value){
        $this->usu_id = $value;
    }

    public function getUsuUsuario(){
        return $this->usu_usuario;
    }

    public function setUsuUsuario(string $value)
    {
        $this->usu_usuario = $value;
    }

    public function getUsuClave(){
        return $this->usu_clave;
    }

    public function setUsuClave($value){
        $this->usu_clave = $value;
    }

    public function getUsuDni(){
        return $this->usu_dni;
    }

    public function setUsuDni($value){
        $this->usu_dni = $value;
    }

    public function setGruId($value){
        $this->gru_id = $value;
    }

    public function getGruId(){
        return $this->gru_id;
    }

    public function setDepId($value){
        $this->dep_id = $value;
    }

    public function getDepId(){
        return $this->dep_id;
    }

    public function setUsuEmail($value){
        $this->usu_email = $value;
    }

    public function getUsuEmail(){
        return $this->usu_email;
    }

    // public function publish(Post $post){
    //     $res = $post->publish($this->id);
    //     array_push($this->posts, $res);
    // }

    // public function fetchPosts(){
    //     $this->posts = PostImage::getAll($this->getId());
    // }
}