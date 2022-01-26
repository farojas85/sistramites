<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Departamento extends Model
{
    private int $dep_id;
    private string $dep_nombre;

    public function __construct()
    {
        parent::__construct();
        $this->dep_id = 0;
        $this->dep_nombre = "";
    }

    public function getDepId():int{
        return $this->dep_id;
    }

    public function setDepId(int $value){
        $this->dep_id = $value;
    }

    
    public function getDepNombre():string{
        return $this->dep_nombre;
    }

    public function setDepNombre(string $value){
        $this->dep_nombre = $value;
    }

    public static function getById(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM departamento WHERE dep_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $departamento = new Departamento();
            $departamento->setDepId($data['dep_id']);
            $departamento->setDepNombre($data['dep_nombre']);
            return $departamento;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT * FROM departamento');
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
