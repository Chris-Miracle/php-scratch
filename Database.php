<?php

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
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password']);
        } catch (PDOException $e) {
            throw new Exception("Could not connect to database: {$e->getMessage()}");
        }
    }
}