<?php

$titlePage = 'Web-interface';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

?>

<div class="row">
    <div class="col-md-3 mx-auto">
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
                <button type="submit" class="btn btn-primary" name="User[submit]">Send</button>
            </div>
        </form>
    </div>

    <div class="col-md-7 mx-auto">
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
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

<script>
    todayDate = new Date();
    todayYear = todayDate.getFullYear();
    todayDay = todayDate.getDate();
    todayMonth = todayDate.getMonth() + 1;

    minDate = formatDate(new Date(todayYear - 130, todayMonth - 1, todayDay));
    maxDate = formatDate(new Date(todayYear - 14, todayMonth - 1, todayDay));

    document.getElementById("form-control-datepicker").onclick = function() {
        var input = document.getElementById("form-control-datepicker");
        input.setAttribute("max", maxDate);
        input.setAttribute("min", minDate);
    }

    function formatDate(date) {

        var dd = date.getDate();
        if (dd < 10) dd = '0' + dd;

        var mm = date.getMonth() + 1;
        if (mm < 10) mm = '0' + mm;

        var yy = date.getFullYear();

        return yy + '-' + dd + '-' + mm;

    }
</script>

</html>