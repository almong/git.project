<?php

class ConnectionDb
{
    private $database;

    public function __construct()
    {
        $this->database = include '../config/db.php';
    }

    public function connect()
    {
        return new PDO($this->database['dsn'].';charset='.$this->database['charset'],
            $this->database['username'], $this->database['password']);

    }
}