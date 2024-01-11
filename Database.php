<?php

class Database {
    private $host = 'localhost';
    private $password = '';
    private $username = "root";
    private $db = "dbs_pembayaran_kuliah";

    private $connection;

    function connect(){
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $this->connection;
    }
}