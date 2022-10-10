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

            $formValidation = $this->validation($userData);

            switch ($formValidation['valid']) {

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

                case false:

                    $this->errorField = "Please fill in all the fields";

                    break;

            }
        }
    }

    public function delete ($data)
    {

        $validData = $this->validation($data);

        $idUser = $validData['validFields']['id'];

        switch (isset($idUser)) {
           
            case true:

                $fetchUser = $this->fetch(['id'], $idUser);

                if (!empty($fetchUser)) {

                    $query = "UPDATE users SET `is_deleted` = 1 WHERE id =  $idUser";

                    if ($sql = $this->connect->query($query)) {

                        $this->succesField = "The entry successfully added";
                        //TODO: redirect to index becouse we action delete

                    } else {

                        $this->errorField = "User not deleted, please try again";

                    }

                } else {

                    $this->errorField = "This user does not exist, please try again";

                }

                break;

            case false:

                $this->errorField = "User deletion failed, please try again";

                break;
        }

    }

    public function view ($data) {

        $validData = $this->validation($data);

        $idUser = $validData['validFields']['id'];

        switch (isset($idUser)) {

            case true:

                $fetchUser = $this->fetch('', $idUser);

                if (!empty($fetchUser)) {

                    return $fetchUser[0];

                } else {

                    $this->errorField = "This user does not exist, please try again";

                    //TODO: redirect to index

                }

                break;

            case false:

                $this->errorField = "This user does not exist, please try again";

                //TODO: redirect to index

                break;
        }

    }

    public function fetch ($fields, $id = null)
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

        if (!is_null($id)) {

            $query.= " WHERE (id = $id AND is_deleted = 0)";

        } else {

            $query .= " WHERE is_deleted = 0";

        }

        if ($sql = $this->connect->query($query)) {

            if (mysqli_num_rows($sql) == 0) {

                return $data;
            }

            while ($row = mysqli_fetch_assoc($sql)) {

                $data[] = $row;

          }  

        }

       return $data;
    }

    public function validation ($data)
    {


        $formValid = [];
        $formValid['valid'] = true;
        $formValid['validFields'] = [];
        $formValid['notValidFields'] = [];

        foreach ($data as $key => $value) {

            if ($key == 'submit') continue;

            if (isset($value) && (!empty($value) || $value === '0')) {

                 if ($key === 'id') {

                    $value = (int) $value;
                    
                }

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
