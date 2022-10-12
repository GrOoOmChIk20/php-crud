<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

$formData = $model->validation($_POST['User']);

if ($formData['valid']) {

    $validData = $formData['validFields'];

    if (isset($validData['login']) && isset($validData['pass'])){

        $userData = $model->fetch(['*'], ['login' => $validData['login'], 'password' => $validData['pass']]);

        if (!empty($userData)) {

            $_SESSION['UserData'] = $userData[0];

            $_SESSION['succesField'] = 'Hi '. $_SESSION['UserData']['name'] . ' ' . $_SESSION['UserData']['surname'];

            header("Location: /");
            die;

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


?>