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

    public function insert()
    {

        if (isset($_POST['submit'])) {
            var_dump($this->formValidation($_POST));
        }
    }

    public function formValidation($formData)
    {

        $formValid = array();
        $formValid['valid'] = true;
        $formValid['validFields'] = array();
        $formValid['notValidFields'] = array();

        foreach ($formData as $key => $value) {

            if ($key == 'submit') continue;

            if (isset($value)) {

                if (empty($value)) {
                    $formValid['valid'] = false;
                    $formValid['notValidFields'][] = $key;
                } else {
                    $dataValid = trim($value);
                    $dataValid = stripslashes($value);
                    $dataValid = htmlspecialchars($value);

                    $formValid['validFields'][$key] = $dataValid;
                }
            } else {

                $formValid['valid'] = false;
                $formValid['notValidFields'][] = $key;
            }
        }

        return $formValid;
    }

}
