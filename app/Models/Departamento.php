<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Departamento extends Model
{
    public int $dep_id;
    public string $dep_nombre;
    public string $dep_abrevia;
    public string $dep_siglas;
    public string $dep_representante;
    public string $dep_cargo;
    public string $dep_observacion;
    public int $dep_maxdoc;
    public int $dep_estatus;

    public function __construct()
    {
        parent::__construct();
        $this->dep_id = 0;
        $this->dep_nombre = "";
        $this->dep_abrevia ="";
        $this->dep_siglas = "";
        $this->dep_representante = "";
        $this->dep_cargo= "";
        $this->dep_observacion = "";
        $this->dep_maxdoc = 0;
        $this->dep_estatus = 0;
    }

    public static function getById(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare(
                'SELECT * FROM departamento WHERE dep_id = :id'
            );
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $departamento = new Departamento();
            $departamento->dep_id = $data['dep_id'];
            $departamento->dep_nombre= $data['dep_nombre'];
            $departamento->dep_abrevia= $data['dep_abrevia'];
            $departamento->dep_representante= $data['dep_representante'];
            $departamento->dep_cargo= $data['dep_cargo'];
            $departamento->dep_observacion= $data['dep_observacion'];
            $departamento->dep_maxdoc = $data['dep_maxdoc'];
            $departamento->dep_estatus = $data['dep_estatus'] ?  $data['dep_estatus'] :0;

            return $departamento;

        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare(
                'SELECT * FROM departamento'
            );
            $query->execute();
            while($p = $query->fetch(PDO::FETCH_ASSOC))
            {
                array_push($items, $p);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }

    public static function getDepartamentos()
    {
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare(
                "SELECT * FROM departamento 
                WHERE dep_nombre NOT IN('NINGUNA','RRHH')"
            );

            $query->execute();
            while($p = $query->fetch(PDO::FETCH_ASSOC))
            {
                array_push($items, $p);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }
}
