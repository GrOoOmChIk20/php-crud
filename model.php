<?php

mysqli_report(MYSQLI_REPORT_STRICT);

class Model{

    private $server = "localhost";
    private $userName = "root";
    private $password = "";
    private $dataBase = "siberss";

    private $connect;

    public function __construct(){

        try {

            $this->connect = new mysqli($this->server, $this->userName, $this->password, $this->dataBase);

        } catch (Exception $e) {
            echo 'Connection failed! ' . $e->getMessage();
        }

    }


}
