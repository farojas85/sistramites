<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Codigo extends Model
{
    public $cod_id;
    public $dep_id;
    public $tr_id;

    public function __construct()
    {
        parent::__construct();
        $this->cod_id = 0;
        $this->dep_id = 0;
        $this->dep_nombre = "";
    }

    public static function getById(int $id){
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM codigos WHERE cod_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $codigo = new Codigo();
            $codigo->tr_id = $data['tr_id'];
            $codigo->dep_id = $data['dep_id'];
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
    public static function getFilasCodigo(int $depid)
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT (count(id) + 1) as fila_codigo  FROM codigos WHERE dep_id=?");
            $query->execute([$depid]);
            $cantidad_filas = (int) $query->fetch(PDO::FETCH_OBJ)->n_archivados;

            return $cantidad_filas;


        }catch(PDOException $e){
            echo $e;
        }
    }
}
