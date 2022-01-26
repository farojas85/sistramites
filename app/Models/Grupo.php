<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Grupo extends Model
{
    private int $gru_id;
    private string $gru_nombre;

    public function __construct()
    {
        parent::__construct();
        $this->gru_id = 0;
        $this->gru_nombre = "";
    }

    public function getGruId():int{
        return $this->gru_id;
    }

    public function setGruId(int $value){
        $this->gru_id = $value;
    }

    
    public function getGruNombre():string{
        return $this->gru_nombre;
    }

    public function setGruNombre(string $value){
        $this->gru_nombre = $value;
    }

    public static function getById(int $id) :Grupo
    {
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM grupo WHERE gru_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $grupo = new Grupo();
            $grupo->setGruId($data['gru_id']);
            $grupo->setGruNombre($data['gru_nombre']);
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
                $item->setGruId($p['gru_id']);
                $item->setGruNombre($p['gru_nombre']);

                array_push($items, $item);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }
}
