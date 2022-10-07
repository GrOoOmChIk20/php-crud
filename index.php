<?php

include_once 'model.php';

$model = new Model();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Web-interface</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">

                <h1 class="text-center">Web-interface</h1>

                <?php $insert = $model->insert();  ?>
                <?php if (isset($model->errorField)) {  ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $model->errorField; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } elseif (isset($model->succesField)) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $model->succesField; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h4>Add user</h4>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" name="User[login]" class="form-control" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="User[pass]" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="User[name]" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="User[surname]" placeholder="Surname">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="User[gender]" value="m" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Male gender
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="User[gender]" value="f">
                            <label class="form-check-label" for="exampleRadios2">
                                Female gender
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- TODO: DatePicker -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="User[submit]">Send</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 mx-auto">
                <h4>Views users</h4>
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            $usersRows = $model->fetch(['id', 'name', 'surname', 'gender', 'birthday']);

                            if (!empty($usersRows)) {

                                foreach ($usersRows as $userRow) {

                                    echo '<tr>';

                                    foreach ($userRow as $field => $value) {
                                        
                                        if ($field == 'id') {
                                            $idUser = $value;
                                        }

                                        echo "<td>$value</td>";

                                    }

                                    echo "<td><a href='read.php?id=$idUser' class='badge badge-primary'>View</a>";
                                    echo "<a href='edit.php?id=$idUser' class='badge badge-warning'>Edit</a>";
                                    echo "<a href='delete.php?id=$idUser' class='badge badge-danger'>Delete</a></td>";
                                    echo '</tr>';
                                    
                                }

                            }

                        ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>