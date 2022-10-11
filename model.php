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

    public function __construct () 
    {
        try {

            $this->connect = new mysqli($this->host, $this->userName, $this->password, $this->dataBase);

        } catch (Exception $e) {
            echo 'Connection failed! ' . $e->getMessage();
        }
    }

    public function insert()
    {
        $userData = $_POST['User'];

        if (isset($userData['insert'])) {

            $formValidation = $this->validation($userData);

            switch ($formValidation['valid']) {

                case true:

                    $userData = $formValidation['validFields'];

                    $userData['birthday'] = strtotime($userData['birthday']);

                    $query = "INSERT INTO `users` (`login`, `password`, `name`, `surname`, `gender`, `birthday`) VALUES ('{$userData['login']}', '{$userData['pass']}', '{$userData['name']}', '{$userData['surname']}', '{$userData['gender']}', '{$userData['birthday']}')";

                    if ($sql = $this->connect->query($query)) {

                        $_SESSION['succesField'] = "The entry successfully added";

                        header("Location: " . $_SERVER["REQUEST_URI"]);
                        die;

                    } else {

                        $_SESSION['errorField'] = "The entry has not been added, try again";

                        header("Location: " . $_SERVER["REQUEST_URI"]);
                        die;
                        
                    }

                    break;

                case false:

                    $_SESSION['errorField'] = "Please fill in all the fields";

                    header("Location: " . $_SERVER["REQUEST_URI"]);
                    die;

                    break;

            }
        }
    }

    public function edit()
    {

        $userData = $_POST['User'];

        if (isset($userData['edit'])) {

            $formValidation = $this->validation($userData);

            switch ($formValidation['valid']) {

                case true:

                    $userData = $formValidation['validFields'];

                    $idUser = $userData['id'];
                   
                    $fetchUser = $this->fetch(['id'], ['id' => $idUser]);

                    if (!empty($fetchUser)) {

                        $userData['birthday'] = strtotime($userData['birthday']);

                        $query = "UPDATE users SET `login` = '{$userData['login']}', `password` = '{$userData['pass']}', `name` = '{$userData['name']}', `surname` = '{$userData['surname']}', `gender` = '{$userData['gender']}', `birthday` = '{$userData['birthday']}'  WHERE id = $idUser";

                        if ($sql = $this->connect->query($query)) {

                            $_SESSION['succesField'] = "The entry successfully added";

                            header("Location: " . $_SERVER["REQUEST_URI"]);
                            die;

                        } else {

                            $_SESSION['errorField'] = "The entry has not been added, try again";

                            header("Location: " . $_SERVER["REQUEST_URI"]);
                            die;

                        }

                    } else {

                        $_SESSION['errorField'] = "This user does not exist, please try again";

                        header("Location: " . $_SERVER["REQUEST_URI"]);
                        die;

                    }

                    break;

                case false:

                    $_SESSION['errorField'] = "Please fill in all the fields";

                    header("Location: " . $_SERVER["REQUEST_URI"]);
                    die;

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

                $fetchUser = $this->fetch(['id'], ['id' => $idUser]);

                if (!empty($fetchUser)) {

                    $query = "UPDATE users SET `is_deleted` = 1 WHERE id =  $idUser";

                    if ($sql = $this->connect->query($query)) {

                        $_SESSION['succesField'] = "The entry successfully added";

                        header("Location: /");
                        die;

                    } else {

                        $_SESSION['errorField'] = "User not deleted, please try again";

                        header("Location: /");
                        die;

                    }

                } else {

                    $_SESSION['errorField'] = "This user does not exist, please try again";

                    header("Location: /");
                    die;

                }

                break;

            case false:

                $_SESSION['errorField'] = "User deletion failed, please try again";

                header("Location: /");
                die;

                break;
        }

    }

    public function view ($data) 
    {
        $validData = $this->validation($data);

        $idUser = $validData['validFields']['id'];

        switch (isset($idUser)) {

            case true:

                $fetchUser = $this->fetch('', ['id' => $idUser]);

                if (!empty($fetchUser)) {

                    return $fetchUser[0];

                } else {

                    $_SESSION['errorField'] = "This user does not exist, please try again";

                    //TODO: redirect to index

                }

                break;

            case false:

                $_SESSION['errorField'] = "This user does not exist, please try again";

                //TODO: redirect to index

                break;
        }

    }

    public function fetch ($fields, $whereFields = null)
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

        if (!is_null($whereFields)) {

            $query .= ' WHERE (';

            foreach ($whereFields as $field => $value) {

                $query .= " $field = $value";

                end($whereFields);
                
                if ($field !== key($whereFields)) {
                    $query .= ' AND';
                }

            }

            $query .= ' AND is_deleted = 0)';

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

            if ($key == 'submit' || $key == 'insert' || $key == 'edit') continue;

            if (isset($value) && (!empty($value) || $value === '0')) {

                 if ($key === 'id') {

                    $value = (int) $value;
                    
                }

                $dataValid = trim($value);
                $dataValid = stripslashes($value);
                $dataValid = htmlspecialchars($value);

                if ($key == 'birthday') {

                    if (!is_numeric(strtotime($value))) {

                        $formValid['valid'] = false;
                        $formValid['notValidFields'][] = $key;

                        continue;

                    }

                }

                $formValid['validFields'][$key] = $dataValid;

            } else {

                $formValid['valid'] = false;
                $formValid['notValidFields'][] = $key;
            }
        }

        return $formValid;
    }
}
