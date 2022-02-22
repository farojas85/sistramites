<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;
use Google\Service\Dfareporting\FileList;

class Tramite extends Model
{
    public int $tr_id;
    public string $tr_tipo;
    public string $tr_remintente;
    public string $tr_numeracion;
    public $tr_fecdoc;
    public int $tdoc_id;
    public string $tr_numdoc;
    public string $tr_asunto;
    public string $tr_detalle;
    public string $tr_nfolio;
    public string $tr_archivo;
    public int $tup_id;
    public string $tup_tipo;
    public int $usu_id;
    public string $tr_numexp;
    public string $tup_silencio;
    public int $dep_origen;
    public string $tr_estatuso;
    public int $dep_recibe;
    public string $tr_estatusr;
    public string $tr_proveido;

    public function __construct()
    {
        parent::__construct();
        $this->tr_id=0;
        $this->tr_tipo="";
        $this->tr_remintente="";
        $this->tr_numeracion="";
        $this->tr_fecdoc="";
        $this->tdoc_id=0;
        $this->tr_numdoc="";
        $this->tr_asunto="";
        $this->tr_detalle="";
        $this->tr_nfolio="";
        $this->tr_archivo="";
        $this->tup_id=0;
        $this->tup_tipo="";
        $this->usu_id=0;
        $this->tr_numexp="";
        $this->tup_silencio="";
        $this->dep_origen=0;
        $this->tr_estatuso="";
        $this->dep_recibe=0;
        $this->tr_estatusr="";
        $this->tr_proveido="";
    }

    public static function getById(int $id) :Tramite
    {
        try{
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM grupo WHERE tr_id = :id');
            $query->execute([ 'id' => $id]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
           
            $tramite = new Tramite();
            $tramite->gru_id = $data['tr_id'];
            $tramite->gru_nombre=$data['gru_nombre'];
            return $tramite;
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
                $item->gru_id = $p['gru_id'];
                $item->gru_nombre= $p['gru_nombre'];

                array_push($items, $item);
            }
            return $items;


        }catch(PDOException $e){
            echo $e;
        }
    }

    public static function getContarPendintes(int $depid)
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT count(t.tr_id) as n_pendientes
                                    FROM tramites AS t INNER JOIN codigos as c ON  c.tr_id=t.tr_id
                                    WHERE t.tr_estatuso='DERIVADO' AND t.tr_estatusr='PENDIENTE' 
                                        AND t.dep_recibe=?");
            $query->execute([$depid]);
            $cantidad_pendientes = (int) $query->fetch(PDO::FETCH_OBJ)->n_pendientes;

            return $cantidad_pendientes;


        }catch(PDOException $e){
            echo $e;
        }
    }
    public static function getContarRecibidos(int $depid)
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT count(*) as n_recibidos FROM tramites 
                                                where dep_origen=? and tr_estatusr='RECIBIDO'");
            $query->execute([$depid]);
            $cantidad_recibidos = (int) $query->fetch(PDO::FETCH_OBJ)->n_recibidos;

            return $cantidad_recibidos;


        }catch(PDOException $e){
            echo $e;
        }
    }

    public static function getContarDerivados(int $depid)
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT count(t.tr_id) as n_derivados 
                                            FROM tramites AS t INNER JOIN codigos as c ON  c.tr_id=t.tr_id
                                            WHERE t.tr_estatuso='DERIVADO' AND (t.tr_estatusr='RECIBIDO' OR t.tr_estatusr='PENDIENTE')
                                                AND t.dep_origen=?");
            $query->execute([$depid]);
            $cantidad_derivados = (int) $query->fetch(PDO::FETCH_OBJ)->n_derivados;

            return $cantidad_derivados;


        }catch(PDOException $e){
            echo $e;
        }
    }

    public static function getContarArchivados(int $depid)
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT count(t.tr_id) as n_archivados
                                            FROM tramites AS t INNER JOIN codigos as c ON c.tr_id=t.tr_id
                                            WHERE t.tr_estatuso='DERIVADO' AND t.tr_estatusr='ARCHIVADO' 
                                                AND t.usu_id=?");
            $query->execute([$depid]);
            $cantidad_archivados = (int) $query->fetch(PDO::FETCH_OBJ)->n_archivados;

            return $cantidad_archivados;


        }catch(PDOException $e){
            echo $e;
        }
    }

    public static function getContarDocumentosCreados()
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT count(t.tr_id) as n_doccreados 
                                                FROM tramites AS t INNER JOIN codigos as c ON c.tr_id=t.tr_id
                                                WHERE  t.usu_id=?");
            $query->execute([$_SESSION['usu_id']]);
            $cantidad_doccreados = (int) $query->fetch(PDO::FETCH_OBJ)->n_doccreados;

            return $cantidad_doccreados;


        }catch(PDOException $e){
            return $e;
        }
    }
    
    public static function getContarDocumentosCreadosss()
    {
        $items = [];

        try{
            $db = new Database();
            $query = $db->connect()->prepare("SELECT count(t.tr_id) as n_doccreados 
                                                FROM tramites AS t INNER JOIN codigos as c ON c.tr_id=t.tr_id
                                                WHERE  t.usu_id=?");
            $query->execute([$_SESSION['usu_id']]);
            $cantidad_doccreados = (int) $query->fetch(PDO::FETCH_OBJ)->n_doccreados;

            return $cantidad_doccreados;


        }catch(PDOException $e){
            echo $e;
        }
    }
    public static function insertar($POST) {
        try{
            $db = new Database();
            if($POST['action'] == 'upload')
            {
                // $archivo = $_FILES["file"]["name"];
                // $tamano = $_FILES["file"]["size"];
                // $tipo = $_FILES["file"]["type"];
                // $extension = pathinfo($_FILES["file"]["name"]);
                // $extension = "." . $extension["extension"];
       
                $numeroexp = $_POST['numero'];
                $tr_tipo = $_POST['tr_tipo'];
                $remitente = $_POST['remitente'];
                $fdocumento = $_POST['fdocumento'];
                $tdoc_id = $_POST['tipod'];
                $ndocumento = $_POST['ndocumento'];
                $asunto = $_POST['asunto'];
                $detalle = $_POST['detalle'];
                $folio = $_POST['folio'];
                $tupa = $_POST['tupa'];
                $silencio = $_POST['silencio'];
                $tipoEstatus = $_POST['tipoEstatus'];
                $unidad = $_POST['unidad'];
                $proveido =  $_POST['proveido'];
                $usu_id = $_POST['usu_id'];
                $tup_tipo = "nose";
                $dep_origen = $usu_id;
                $tr_estatusr = "PENDIENTE";
                
                if ($tipoEstatus == "RECIBIDO") {
                   $tipoEstatus = "DERIVADO";
                }
                $depid = $_SESSION['dep_id'];
                
                $carpeta_departamento='recepcion/'.$depid;
            
                if(!file_exists($carpeta_departamento))
                {
                    mkdir($carpeta_departamento,0777,true);
                }

                $contar_archivos = count($_FILES["files"]["name"]);

                $tr_id="500";
                $carpeta_tramite = $carpeta_departamento."/".$tr_id;
                if(!file_exists($carpeta_tramite))
                {
                    mkdir($carpeta_tramite,0777,true);
                }

                for($i=0;$i<$contar_archivos;$i++)
                {
                    $extension = pathinfo($_FILES["files"]["name"][$i]);
                    $extension = "." . $extension["extension"];
                    $archivo = $numeroexp."-".($i+1).$extension;
                    move_uploaded_file($_FILES['files']['tmp_name'][$i],$carpeta_tramite.'/'.$archivo);
                }


                // $pdo = $db->connect();
                // $query = $pdo->prepare(
                //     "INSERT INTO tipo_documento(tdoc_nombre,tdoc_abrevia)
                //     VALUES(?,?)"
                // );

                // $query->execute([$POST['docnombre'],$POST['docabrevia']]);

                // $tipodoc_id = $pdo->lastInsertId();

            }
            //return $carpeta_departamento;
            

        } catch(PDOException $e) {
            return $e;
        }
    }
}
