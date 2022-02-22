<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class TupaArea extends Model
{
    public int $tua_id;
    public int $dep_id;
    public int $tup_id;
    public int $tup_dias;
    public int $tua_estatus;

    public function __construct()
    {
        parent::__construct();
        $this->tua_id = 0;
        $this->dep_id = 0;
        $this->tup_id =0;
        $this->tup_dias =0;
        $this->tua_estatus = 0;
    }

    public static function getById(int $id) :TupaArea{
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM tupa_areas WHERE tua_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $tupa = new TupaArea();
            $tupa->tua_id = $data['tua_id'];
            $tupa->dep_id = $data['dep_id'];
            $tupa->tup_id = $data['tup_id'];
            $tupa->tua_estatus = $data['tua_estatus'] ?  $data['tua_estatus'] : 0;

            return $tupa;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getByNombre(string $nombre) :array {
        $items = []; 
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM tupa_act WHERE dep_id like '%?%'");
            $query->execute([$nombre]);

            while($p = $query->fetch(PDO::FETCH_ASSOC))
            {
                array_push($items, $p);
            }

            return $items;

        }catch(PDOException $e){
            return false;
        }
    }

    public static function getByTupaId(int $id_tupa) :array {
        $items = []; 
        try{
            $db = new Database();
            $query = $db->connect()->prepare(
                "SELECT * FROM tupa_areas WHERE tup_id =? ORDER BY tua_id"
            );
            $query->execute([$id_tupa]);

            while($p = $query->fetch(PDO::FETCH_ASSOC))
            {
                array_push($items, $p);
            }

            return $items;

        }catch(PDOException $e){
            return false;
        }
    }

    public static function getByDepartamentoPorTupa(int $id_tupa) :array {
        $items = []; 
        try{
            $db = new Database();
            $query = $db->connect()->prepare(
                "SELECT a.dep_id,d.dep_nombre, tup_dias 
                FROM tupa_areas a INNER JOIN departamento d  ON  d.dep_id = a.dep_id 
                WHERE a.tup_id= ? AND a.tua_estatus='1' 
                ORDER BY tua_id"
            );
            $query->execute([$id_tupa]);

            while($p = $query->fetch(PDO::FETCH_ASSOC))
            {
                array_push($items, $p);
            }

            return $items;

        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT * FROM tupa_areas');
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
