<?php

namespace Framework;

use PDO;
use PDOException;

class Database {

    public $conn;

    /**
     * Constructor for Database class
     * 
     * @param array $config
     */
    public function __construct($config)
    {
        // inspectAndDie($config);
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new \Exception("Could not connect to database: {$e->getMessage()}");
        }
    }

    /** 
     * Query the database
     * 
     * @param string $query
     * @param array $params
     * 
     * @return PDOStatement
     * @throws PDOException
    */
    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            //Bind named params
            foreach($params as $param => $value){
                $sth->bindValue(':' . $param, $value);
            }
            
            $sth->execute();
            return $sth;
        } catch (PDOException $E) {
            //throw $th;
            throw new \Exception("Could not query the database: {$E->getMessage()}");
        }
    }
}