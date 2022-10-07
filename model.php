<?php

mysqli_report(MYSQLI_REPORT_STRICT);

class Model {

    private $host = "localhost";
    private $userName = "root";
    private $password = "";
    private $dataBase = "sibers";

    private $connect;

    public $errorField;
    public $succesField;

    public function __construct () {

        try {

            $this->connect = new mysqli($this->host, $this->userName, $this->password, $this->dataBase);

        } catch (Exception $e) {
            echo 'Connection failed! ' . $e->getMessage();
        }
    }

    public function insert()
    {
        $userData = $_POST['User'];

        if (isset($userData['submit'])) {

            $formValidation = $this->formValidation($userData);

            switch ($formValidation['valid']) {
                case false:

                    $this->errorField = "Please fill in all the fields";

                    break;

                case true:

                    $userData = $formValidation['validFields'];

                    $query = "INSERT INTO `users` (`login`, `password`, `name`, `surname`, `gender`) VALUES ('{$userData['login']}', '{$userData['pass']}', '{$userData['name']}', '{$userData['surname']}', '{$userData['gender']}')";

                    if ($sql = $this->connect->query($query)) {

                        $this->succesField = "The entry successfully added";
                        //TODO: redirect to index becouse update page POST

                    } else {
                        $this->errorField = "The entry has not been added, try again";
                    }

                    break;
            }
        }
    }

    public function fetch ($fields)
    {
        $data = [];
        $queryRows = null;

        if (is_array($fields)) {

            for ($i = 0; $i < count($fields); $i++) {

                if ($i+1 == count($fields)) {

                    $queryRows .= ' ' . $fields[$i];
                    break;

                }

                $queryRows .= ' ' . $fields[$i] . ',';

            }

        } else {
            
            $queryRows = '*';
        }

        $query = "SELECT $queryRows FROM users";

        if ($sql = $this->connect->query($query)) {
            
            while ($row = mysqli_fetch_assoc($sql)) {

                $data[] = $row;

          }  

        }

       return $data;
    }

    public function formValidation ($formData)
    {


        $formValid = [];
        $formValid['valid'] = true;
        $formValid['validFields'] = [];
        $formValid['notValidFields'] = [];

        foreach ($formData as $key => $value) {

            if ($key == 'submit') continue;

            if (isset($value) && !empty($value)) {

                $dataValid = trim($value);
                $dataValid = stripslashes($value);
                $dataValid = htmlspecialchars($value);

                $formValid['validFields'][$key] = $dataValid;
            } else {

                $formValid['valid'] = false;
                $formValid['notValidFields'][] = $key;
            }
        }

        return $formValid;
    }
}
