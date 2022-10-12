<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

class User extends Model
{

    public function login($userData)
    {

        $formData = $this->validation($userData);

        if ($formData['valid']) {

            $validData = $formData['validFields'];

            if (isset($validData['login']) && isset($validData['pass'])) {

                $fetchUser = $this->fetch(['*'], ['login' => $validData['login']]);

                if (!empty($fetchUser)) {

                    $userData = $fetchUser[0];

                    if (password_verify($validData['pass'], $userData['password'])) {

                        $_SESSION['UserData'] = $userData;

                        $_SESSION['succesField'] = 'Hi ' . $_SESSION['UserData']['name'] . ' ' . $_SESSION['UserData']['surname'];

                        header("Location: /");
                        die;

                    } else {

                        $_SESSION['errorField'] = 'Invalid username or password';

                        header("Location: /login.php");
                        die;

                    }

                } else {

                    $_SESSION['errorField'] = 'Invalid username or password';

                    header("Location: /login.php");
                    die;

                }
            } else {

                $_SESSION['errorField'] = 'Please fill in all the fields';

                header("Location: /login.php");
                die;

            }
        } else {

            $_SESSION['errorField'] = 'Please fill in all the fields';

            header("Location: /login.php");
            die;

        }
    }

}

$user = new User($configApp['components']);

$user->login($_POST['User']);

?>