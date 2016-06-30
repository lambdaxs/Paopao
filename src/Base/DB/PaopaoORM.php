<?php

namespace Paopao\Base\DB;

use Paopao\Base\Config\DataBase;
//use Paopao\Base\Exception\PaopaoException;

require_once __DIR__.'/NotORM/NotORM.php';


/**
 * Created by PhpStorm.
 * User: xiaos
 * Date: 16/6/29
 * Time: 15:04
 */

class PaopaoPDO extends \PDO{

    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;
    private $port;
    private $charset;

    public function __construct(){
        $configs = DataBase::getDBConfig();
        $this->engine = 'mysql';
        $this->host = $configs['host'];
        $this->database = $configs['name'];
        $this->user = $configs['user'];
        $this->pass = $configs['password'];
        $this->port = $configs['port'];
        $this->charset = $configs['charset'];
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host.';port='.$this->port.';charset='.$this->charset;
        parent::__construct($dns,$this->user,$this->pass);
    }
}

class PaopaoORM {

    private static $_instance;

    public static function getInstance(){
        if (!self::$_instance instanceof self){
            $pdo = new PaopaoPDO();
            self::$_instance = new \NotORM($pdo);
        }
        return self::$_instance;
    }

    public static function beign(){
        $notorm = PaopaoORM::getInstance();
        $connection = $notorm->getConnection();
        return $connection->beginTransaction();
    }

    public static function commit(){
        $notorm = PaopaoORM::getInstance();
        $connection = $notorm->getConnection();
        return $connection->commit();
    }

    public static function rollBack(){
        $notorm = PaopaoORM::getInstance();
        $connection = $notorm->getConnection();
        return $connection->rollBack();
    }


}
