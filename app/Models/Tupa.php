<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Tupa extends Model
{
    public int $tup_id;
    public string $tup_nombre;
    public int $tup_estatus;

    public function __construct()
    {
        parent::__construct();
        $this->tup_id = 0;
        $this->tup_nombre = "";
        $this->tup_estatus = 0;
    }

    public static function getById(int $id) :Tupa{
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM tupa WHERE tup_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $tupa = new Tupa();
            $tupa->tup_id = $data['tup_id'];
            $tupa->tup_nombre = $data['tup_nombre'];
            $tupa->tup_estatus = $data['tup_estatus'] ?  $data['tup_estatus'] : 0;

            return $tupa;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT * FROM tupa');
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

    public static function getTupasActivas()
    {
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare("SELECT t.tup_id,t.tup_nombre 
                                            FROM tupa t INNER JOIN tupas_act tu ON t.tup_estatus=tu.tua_id
                                            WHERE tu.tua_estatus='ACTIVO' AND t.tup_nombre not in ('NINGUNA')");
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
