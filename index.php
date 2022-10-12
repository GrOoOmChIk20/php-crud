<?php

$titlePage = 'Home';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

?>

<div class="row">
    <div class="col-md-4 mx-auto">
        <h4>Add user</h4>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="User[login]" placeholder="Login">
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
                <label>Birthday</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="User[gender]" value="m" checked>
                    <label class="form-check-label" for="RadiosGenderM">
                        Male gender
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="User[gender]" value="f">
                    <label class="form-check-label" for="RadiosGenderF">
                        Female gender
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group date" data-provide="datepicker">
                    <input type="date" id="form-control-datepicker" name="User[birthday]">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="User[insert]">Add user</button>
            </div>
        </form>
    </div>

    <div class="col-md-8 mx-auto">
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

                        $numUser++;

                        foreach ($userRow as $field => $value) {

                            if ($field == 'id') {

                                $idUser = $value;
                                echo "<td>$numUser</td>";

                            } elseif ($field == 'birthday') {

                                $value = date('d-m-Y', $value);
                                echo "<td>$value</td>";

                            } else {

                                $value = mb_strimwidth($value, 0, 15, '...');
                                echo "<td>$value</td>";
                            }
                        }

                        echo "<td><a href='actions/view.php?id=$idUser' class='badge badge-primary'>View</a>";
                        echo "<a href='actions/edit.php?id=$idUser' class='badge badge-warning'>Edit</a>";
                        echo "<a href='actions/delete.php?id=$idUser' class='badge badge-danger'>Delete</a></td>";
                        echo '</tr>';
                    }
                }

                ?>

            </tbody>
        </table>
    </div>
</div>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

?>

