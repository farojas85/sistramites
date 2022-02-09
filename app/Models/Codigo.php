<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Codigo extends Model
{
    private int $cod_id;
    private int $dep_id;
    private int $tr_id;

    public function __construct()
    {
        parent::__construct();
        $this->cod_id = 0;
        $this->dep_id = 0;
        $this->dep_nombre = "";
    }

    public function getCodId():int{
        return $this->cod_id;
    }

    public function setCodId(int $value){
        $this->cod_id = $value;
    }

    public function getDepId():int{
        return $this->dep_id;
    }

    public function setDepId(int $value){
        $this->dep_id = $value;
    }

    
    public function getTrId():string{
        return $this->tr_id;
    }

    public function setTrId(string $value){
        $this->tr_id = $value;
    }

    public static function getById(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM codigos WHERE cod_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $codigo = new Codigo();
            $codigo->setTrId($data['tr_id']);
            $codigo->setDepId($data['dep_id']);
            return $codigo;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT * FROM codigos');
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
