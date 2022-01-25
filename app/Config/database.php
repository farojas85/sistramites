<?php

namespace App\Config;

use PDO;
use PDOException;

use App\Config\Config;

class Database
{
    private static $link = null;

    public function __construct(){

    }
    
    public function __clone()
    {

    }

    public function connect()
    {
        try
        {
            if (self::$link) {
                return self :: $link;
            }
    
            $config = Config::getInstance();
    
            $dsn = $config->conexiones['mysql']['dsn'];
            $user = $config->conexiones['mysql']['username'];
            $pass = $config->conexiones['mysql']['password'];
            $options = $config->conexiones['mysql']['options'];
    
            self::$link = new PDO ($dsn, $user, $pass, $options);
            self::$link->exec("SET NAMES utf8");
            self::$link->exec("SET CHARACTER SET utf8");
    
            return self::$link;
        } catch(PDOException $e) {
            print_r('Error Connection' . $e->getMessage());
        }
    }

    public static function __callStatic($name, $args)
    {
        $callback = array(self :: getLink(), $name);
        return call_user_func_array($callback, $args);
    }
}