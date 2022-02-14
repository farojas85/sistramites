<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Grupo extends Model
{
    public $gru_id;
    public $gru_nombre;

    public function __construct()
    {
        parent::__construct();
        $this->gru_id = 0;
        $this->gru_nombre = "";
    }

    public static function getById(int $id) :Grupo
    {
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM grupo WHERE gru_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $grupo = new Grupo();
            $grupo->gru_idd =$data['gru_id'];
            $grupo->gru_nombre = $data['gru_nombre'];
            return $grupo;
        }catch(PDOException $e){
            return false;
        }
    }

    public function getAll(){
        $items = [];

        try{
            $query = $this->query('SELECT * FROM grupo');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new Grupo();
                $item->gru_id =$p['gru_id'];
                $item->gru_nombre = $p['gru_nombre'];

                array_push($items, $item);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }
}
