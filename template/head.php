<?php
$configApp = include_once $_SERVER['DOCUMENT_ROOT'] . '/app/config.php';

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/model.php';

$model = new Model($configApp['components']);

if (isset($_SESSION['UserData'])) {

    $userDataAuth = $_SESSION['UserData'];

} elseif ($configApp['path_parts']['filename'] != 'login') {

    header("Location: ../login.php");
    die;

}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?= $configApp['name'] . ': ' . $titlePage ?></title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Web-interface</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li> -->
                </ul>

                <?php

                if (isset($userDataAuth)) { ?>

                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=  $userDataAuth['name'] . ' ' . $userDataAuth['surname'] ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <?= "<a href='../actions/edit.php?id={$userDataAuth['id']}' class='dropdown-item'>Edit profile</a>"; ?>
                            <?= "<a href='../actions/logout.php?id={$userDataAuth['id']}' class='dropdown-item'>Log out</a>"; ?>
                        </div>
                    </div>

                <?php }  ?>

            </div>
        </nav>
        <div class="row">
            <div class="col-md-12 mt-5">

                <?php $insert = $model->insert();  ?>

                <?php if (isset($_SESSION['errorField'])) {  ?>

                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['errorField']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <?php } elseif (isset($_SESSION['succesField'])) { ?>

                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['succesField']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <?php } ?>

            </div>
        </div>