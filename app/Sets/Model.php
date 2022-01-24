<?php

namespace Marcosrivasr\Instagram\lib;

use App\Config\Database;

class Model{

    private Database $db;
    
    function __construct(){
        $this->db = new Database();
    }

    function query($query){
        return $this->db->connect()->query($query);
    }

    function prepare($query){
        return $this->db->connect()->prepare($query);
    }
}

?>