<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class TipoDocumento extends Model
{
    public $tdoc_id;
    public $tdoc_nombre;
    public $tdoc_abrevia;

    public function __construct()
    {
        parent::__construct();
        $this->tdoc_id = 0;
        $this->tdoc_nombre = "";
        $this->tdoc_abrevia= "";
    }

    public static function getById(int $id) :TipoDocumento
    {
        try{
            $db = new Database();
            $query = $db->connect()->prepare(
                'SELECT * FROM tipo_documentos WHERE tdoc_id = :id'
            );
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $tipo_documentos = new TipoDocumento();
            $tipo_documentos->tdoc_id = $data['tdoc_id'];
            $tipo_documentos->tdoc_nombre = $data['tdoc_nombre'];
            $tipo_documentos->tdoc_abrevia = $data['tdoc_abrevia'];
            return $tipo_documentos;
        }catch(PDOException $e){
            return false;
        }
    }

    public static function getAll(){
        $items = [];

        try{
            $db = new Database();

            $query = $db->connect()->prepare('SELECT * FROM tipo_documento');
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

    public static function insertar($POST) {
        try{
            $db = new Database();
            $pdo = $db->connect();
            $query = $pdo->prepare(
                "INSERT INTO tipo_documento(tdoc_nombre,tdoc_abrevia)
                VALUES(?,?)"
            );

            $query->execute([$POST['docnombre'],$POST['docabrevia']]);

            $tipodoc_id = $pdo->lastInsertId();
            echo $tipodoc_id;
            

        } catch(PDOException $e) {
            echo $e;
        }
    }
}
