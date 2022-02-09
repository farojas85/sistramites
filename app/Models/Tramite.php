<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class Tramite extends Model
{
    private int $tr_id;
    private string $tr_tipo;
    private string $tr_numexp;
    private string $gru_nombre;

    public function __construct()
    {
        parent::__construct();
        $this->tr_id = 0;
        $this->tr_tipo="";
        $this->tr_numexp="";
        $this->gru_nombre = "";
    }

    public function getTrId():int{
        return $this->tr_id;
    }

    public function setTrId(int $value){
        $this->tr_id = $value;
    }

    
    public function getTrTipo():string{
        return $this->tr_tipo;
    }

    public function setTrTipo(string $value){
        $this->tr_tipo = $value;
    }

    public function getTrNumexp():string{
        return $this->tr_numexp;
    }

    public function setTrNumexp(string $value){
        $this->tr_numexp = $value;
    }

    public static function getById(int $id) :Tramite
    {
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM grupo WHERE tr_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $grupo = new Grupo();
            $grupo->setGruId($data['tr_id']);
            $grupo->setGruNombre($data['gru_nombre']);
            return $grupo;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getByDepartamentoId(int $depid,string $estado) 
    {
        $items = [];

        $estado = ($estado == 'T') ?  '%' : $estado;

        try{
            $db = new Database();
           
            $query = $db->connect()->prepare(
                "SELECT t.tr_id,t.tr_numexp, DATE_FORMAT(t.tr_fecdoc,'%d/%m/%Y') AS tr_fecdoc,t.tdoc_id,t.tr_numdoc,
                    t.tr_asunto,t.tr_remintente,t.usu_id,d.tdoc_nombre, e.dep_nombre AS dep_nombre, t.tr_archivo, t.tr_estatusr
                FROM tramites as t INNER JOIN tipo_documento as d ON d.tdoc_id = t.tdoc_id  
                    INNER JOIN departamento as e ON t.dep_recibe = e.dep_id 
                    INNER JOIN codigos as c ON c.tr_id = t.tr_id
                WHERE c.dep_id =:depid and  t.tr_estatusr like :estado
                ORDER BY t.tr_id desc");

            $query->execute([
                'depid' => $depid,
                'estado' =>$estado
            ]);
            
            //$items = array_map(null, $query->fetch(PDO::FETCH_ASSOC));
            while($data =  $query->fetch(PDO::FETCH_ASSOC))
            {
                array_push($items,$data);
            }
        
            return $items;
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
