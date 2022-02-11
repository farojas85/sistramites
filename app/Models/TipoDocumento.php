<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class TipoDocumento extends Model
{
    private int $tdoc_id;
    private string $tdoc_nombre;
    private string $tdoc_abrevia;

    public function __construct()
    {
        parent::__construct();
        $this->tdoc_id = 0;
        $this->tdoc_nombre = "";
        $this->tdoc_abrevia= "";
    }

    public function getDocId():int{
        return $this->tdoc_id;
    }

    public function setDocId(int $value){
        $this->tdoc_id = $value;
    }

    
    public function getTdocNombre():string{
        return $this->tdoc_nombre;
    }

    public function setTdocNombre(string $value){
        $this->tdoc_nombre = $value;
    }

    public function getTdocAbrevia():string{
        return $this->tdoc_abrevia;
    }

    public function setTdocAbrevia(string $value){
        $this->tdoc_abrevia = $value;
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
            $tipo_documentos->setDocId($data['tdoc_id']);
            $tipo_documentos->setTdocNombre($data['tdoc_nombre']);
            $tipo_documentos->setTdocAbrevia($data['tdoc_abrevia']);
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
            $query = $db->connect()->prepare(
                "INSERT INTO tipo_documento(tdoc_nombre,tdoc_abrevia)
                VALUES(?,?)"
            );

            $query->execute([$POST['docnombre'],$POST['docabrevia']]);

            $tipodoc_id = $query->lastInsertId();
            echo $tipodoc_id;

        } catch(PDOException $e) {
            echo $e;
        }
    }
}
