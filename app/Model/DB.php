<?php

namespace App\Model;

use PDO;
use PDOException;


class DB
{
    private static  $instance;
    private $dbh;
    private $stmt;

    private function __construct()
    {
        $config = require_once "./../config/db.php";
        $driver = $config['driver'];
        $host = $config['host'];
        $db_name = $config['db_name'];
        $db_user = $config['db_user'];
        $db_pass = $config['db_pass'];
        $charset = $config['charset'];
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        //Create PDO instance
        try {
            $this->dbh =  new PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options);
        } catch (PDOException $e){
            echo $e->getMessage();
        }

    }


    public static function getConnection()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __clone()
    {
    }

    //Prepare statement with query
    public function prepare($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values, to prepared statement using named parameters
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statement
    public function execute(){
        return $this->stmt->execute();
    }

    //Return multiple records
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Return a single record
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}






