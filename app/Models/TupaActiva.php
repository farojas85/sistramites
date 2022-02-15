<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class TupaActiva extends Model
{
    public int $tua_id;
    public string $tua_nombre;
    public string $tua_estatus;

    public function __construct()
    {
        parent::__construct();
        $this->tua_id = 0;
        $this->tua_nombre = "";
        $this->tua_estatus = 0;
    }

    public static function getById(int $id) :TupaActiva{
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM tupa_act WHERE tua_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $tupa = new TupaActiva();
            $tupa->tua_id = $data['tua_id'];
            $tupa->tua_nombre = $data['tua_nombre'];
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
            $query = $db->connect()->prepare("SELECT * FROM tupa_act WHERE tua_nombre like '%?%'");
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

    public function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT * FROM tupa_act');
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
