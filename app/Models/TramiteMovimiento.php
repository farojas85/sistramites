<?php
namespace App\Models;

use PDO;
use PDOException;

use App\Config\Database;
use App\Sets\Model;

class TramiteMovimiento extends Model
{
    public int $mov_id;
    public int $tr_id;
    public int $de_premite;
    public int $dep_recibe;
    public string $mov_detalle;
    public $mov_fecha;
    public $mov_hora;
    public string $mov_estatus;
    public int $trec_id;

    public function __construct()
    {
        parent::__construct();

        $this->mov_id=0;
        $this->tr_id=0;
        $this->de_premite=0;
        $this->dep_recibe=0;
        $this->mov_detalle='';
        $this->mov_fecha="";
        $this->mov_hora="";
        $this->mov_estatus='';
        $this->trec_id=0;
    }
}