<?php

include "ConnectionDb.php";

class ImageFile
{
    public $db;
    public $name;
    public $path;
    public $type;

    public function __construct($file)
    {
        $connect = new ConnectionDb();
        $this->db = $connect->connect();
        $this->name = $file['name'];
        $this->path = $file['tmp_name'];
        $this->type = $file['type'];
    }

    public function validationFile()
    {
        $query = "SELECT count(*) FROM `images` WHERE `filename`='$this->name'";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_NUM)[0];

    }

    public function add()
    {

    }

    public function delete()
    {

    }

    public function checkType()
    {
        $pattern = "/^image/";
        return preg_match($pattern, $this->type);
    }
}