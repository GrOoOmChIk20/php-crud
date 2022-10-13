<?php

mysqli_report(MYSQLI_REPORT_STRICT);

class Model
{
    private $connect;

    public $errorField;
    public $succesField;

    public function __construct($db)
    {
        try {
            $this->connect = new mysqli($db['host'], $db['userName'], $db['password'], $db['dataBase']);
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

                    $fetchUser = $this->fetch(['id'], ['login' => $userData['login']]);

                    if (empty($fetchUser)) {

                        $userData['birthday'] = strtotime($userData['birthday']);
                        $userData['pass'] = password_hash($userData['pass'], PASSWORD_DEFAULT);

                        $query = "INSERT INTO `users` (`login`, `password`, `name`, `surname`, `gender`, `birthday`) VALUES ('{$userData['login']}', '{$userData['pass']}', '{$userData['name']}', '{$userData['surname']}', '{$userData['gender']}', '{$userData['birthday']}')";

                        if ($sql = $this->connect->query($query)) {
                            $_SESSION['succesField'] = 'User successfully added';

                            header("Location: " . $_SERVER["REQUEST_URI"]);
                            die;
                        } else {
                            $_SESSION['errorField'] = 'The entry has not been added, try again';

                            header("Location: " . $_SERVER["REQUEST_URI"]);
                            die;
                        }
                    } else {

                        $_SESSION['errorField'] = 'A user with this login exists';

                        header("Location: " . $_SERVER["REQUEST_URI"]);
                        die;

                    }

                    break;

                case false:

                    $_SESSION['errorField'] = 'Please fill in all the fields';

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

                            $idUser = $fetchUser[0]['id'];

                            $userData['birthday'] = strtotime($userData['birthday']);
                            $userData['pass'] = password_hash($userData['pass'], PASSWORD_DEFAULT);

                            $query = "UPDATE users SET `password` = '{$userData['pass']}', `name` = '{$userData['name']}', `surname` = '{$userData['surname']}', `gender` = '{$userData['gender']}', `birthday` = '{$userData['birthday']}'  WHERE id = $idUser";

                            if ($sql = $this->connect->query($query)) {

                                if ($_SESSION['UserData']['id'] == $idUser) {

                                    header("Location: ../actions/logout.php" . $_SERVER["REQUEST_URI"]);
                                    die;

                                }
                                
                                $_SESSION['succesField'] = 'User successfully changed';

                                header("Location: " . $_SERVER["REQUEST_URI"]);
                                die;
                            } else {

                                $_SESSION['errorField'] = 'The entry has not been added, try again';

                                header("Location: " . $_SERVER["REQUEST_URI"]);
                                die;
                            }

                    } else {

                        $_SESSION['errorField'] = 'This user does not exist, please try again';
                        
                        header("Location: " . $_SERVER["REQUEST_URI"]);
                        die;
                    }

                    break;

                case false:

                    $_SESSION['errorField'] = 'Please fill in all the fields';
                    header("Location: " . $_SERVER["REQUEST_URI"]);
                    die;

                    break;
            }
        }
    }

    public function delete($data)
    {
        $validData = $this->validation($data);

        if ($validData['valid']) {
        
            $idUser = $validData['validFields']['id'];

            switch (isset($idUser)) {
                case true:

                    $fetchUser = $this->fetch(['id'], ['id' => $idUser]);
                    $idUser = $fetchUser[0]['id'];
                    
                    if (!empty($fetchUser)) {
                        $query = "UPDATE users SET `is_deleted` = 1 WHERE id =  $idUser";

                        if ($sql = $this->connect->query($query)) {

                            if ($_SESSION['UserData']['id'] == $idUser) {

                                header("Location: ../actions/logout.php" . $_SERVER["REQUEST_URI"]);
                                die;
                            }

                            $_SESSION['succesField'] = 'The user has been successfully deleted';

                            header("Location: /");
                            die;
                        } else {
                            $_SESSION['errorField'] = 'The user was not deleted, try again';

                            header("Location: /");
                            die;
                        }
                    } else {
                        $_SESSION['errorField'] = 'This user does not exist, please try again';

                        header("Location: /");
                        die;
                    }

                    break;

                case false:

                    $_SESSION['errorField'] = 'User deletion failed, please try again';

                    header("Location: /");
                    die;

                    break;
            }
        }

        header("Location: /");
        die;

    }

    public function view($data)
    {
        $validData = $this->validation($data);
       
        if ($validData['valid']) {

            $idUser = $validData['validFields']['id'];

            switch (isset($idUser)) {

                case true:

                    $fetchUser = $this->fetch('', ['id' => $idUser]);

                    if (!empty($fetchUser)) {

                        $user = $fetchUser[0];
                        $user['password'] = '';

                        return $user;

                    } else {

                        $_SESSION['errorField'] = 'This user does not exist, please try again';

                        header("Location: /");
                        die;

                    }

                    break;

                case false:

                    $_SESSION['errorField'] = 'This user does not exist, please try again';

                    header("Location: /");
                    die;

                    break;
            }
        }

        header("Location: /");
        die;

    }

    public function fetch($fields, $whereFields = null, $sort = null, $limit = null)
    {
        $data = [];
        $queryRows = null;

        if (is_array($fields)) {

            for ($i = 0; $i < count($fields); $i++) {

                if ($i + 1 == count($fields)) {

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
            
            $query .= ' WHERE ';

            foreach ($whereFields as $field => $value) {

                $query .= " $field = '$value'";

                end($whereFields);

                if ($field !== key($whereFields)) {
                    $query .= ' AND';
                }

            }

            $query .= ' AND is_deleted = 0';

        } else {

            $query .= " WHERE is_deleted = '0'";

        }

        if (!is_null($sort)) {

            $sort_list = array(
                'id_asc'   => '`id`',
                'name_asc'   => '`name`',
                'name_desc'  => '`name` DESC',
                'surname_asc'  => '`surname`',
                'surname_desc' => '`surname` DESC',
                'gender_asc'   => '`gender`',
                'gender_desc'  => '`gender` DESC',
                'birthday_asc'   => '`birthday`',
                'birthday_desc'  => '`birthday` DESC',
            );

            if (array_key_exists($sort, $sort_list)) {

                $sort_sql = $sort_list[$sort];
                $query .= " ORDER BY $sort_sql";

            }
        }

        if (!is_null($limit)) {

            switch(count($limit)) {

                case '1':

                    $query .= " LIMIT $limit[0]";
                    break;

                case '2':

                    $query .= " LIMIT $limit[0], $limit[1]";
                    break;

            }

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

    public function validation($data)
    {

        $formValid = [];
        $formValid['valid'] = true;
        $formValid['validFields'] = [];
        $formValid['notValidFields'] = [];

        foreach ($data as $key => $value) {

            if ($key == 'submit' || $key == 'insert' || $key == 'edit') continue;

            if (isset($value) && (!empty($value) || $value === '0')) {

               
                $dataValid = trim($value);
                $dataValid = stripslashes($value);
                $dataValid = htmlspecialchars($value);

                if ($key == 'id') {

                    $dataValid = (int)$dataValid;

                }

                if ($key == 'birthday' && !is_numeric(strtotime($value))) {
    
                    $formValid['valid'] = false;
                    $formValid['notValidFields'][] = $key;

                    continue;

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
