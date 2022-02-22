<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class TupaRequisito extends Model
{
    public int $tur_id;
    public string $tur_nombre;
    public int $tup_id;
    public int $tur_estatus;

    public function __construct()
    {
        parent::__construct();
        $this->tur_id = 0;
        $this->tur_nombre = "";
        $this->tup_id =0;
        $this->tur_estatus = 0;
    }

    public static function getById(int $id) :TupaRequisito{
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM tupa_requisito WHERE tur_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $tupa = new TupaRequisito();
            $tupa->tur_id = $data['tur_id'];
            $tupa->tur_nombre = $data['tur_nombre'];
            $tupa->tup_id = $data['tup_id'];
            $tupa->tur_estatus = $data['tur_estatus'] ?  $data['tur_estatus'] : 0;

            return $tupa;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getByNombre(string $nombre) :array {
        $items = []; 
        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT * FROM tupa_act WHERE tur_nombre like '%?%'");
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
                "SELECT * FROM tupa_requisito WHERE tup_id =? ORDER BY tur_id"
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

            $query = $db->connect()->prepare('SELECT * FROM tupa_requisito');
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
