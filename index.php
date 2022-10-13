<?php

$titlePage = 'Home';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

// var_dump($_SESSION);die;
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
                    <?php

                    function sort_link($title, $sort_asc, $sort_desc, $page, $getSort)
                    {

                        if ($getSort == $sort_asc) {

                            return '<a class="active" href="?p=' . $page . '&sort=' . $sort_desc . '">' . $title . ' <i>▲</i></a>';

                        } elseif ($getSort == $sort_desc) {

                            return '<a class="active" href="?p=' . $page . '&sort=' . $sort_asc . '">' . $title . ' <i>▼</i></a>';

                        } else {

                            return '<a href="?p=' . $page . '&sort=' . $sort_asc . '">' . $title . '</a>';

                        }
                    }

                    if (isset($_GET) && !empty($_GET)) {

                        $validGet = $model->validation($_GET);

                        if ($validGet['valid']) {

                            $validFields = $validGet['validFields'];

                            if (isset($validFields['sort']) && !empty($validFields['sort'])) {

                                $sort = $validFields['sort'];

                            } else {

                                $sort = 'id_asc';

                            }
                            if (isset($validFields['p']) && !empty($validFields['p'])) {

                                $page = (int)$validFields['p'];

                            } else {

                                $page = 1;

                            }
                        }
                    } else {

                        $page = 1;
                        $sort = 'id_asc';

                    }

                    ?>
                    <th scope="col">ID</th>
                    <th scope="col"><?= sort_link('Name', 'name_asc', 'name_desc', $page, $sort); ?></th>
                    <th scope="col"><?= sort_link('Surname', 'surname_asc', 'surname_desc', $page, $sort); ?></th>
                    <th scope="col"><?= sort_link('Gender', 'gender_asc', 'gender_desc', $page, $sort); ?></th>
                    <th scope="col"><?= sort_link('Birthday', 'birthday_asc', 'birthday_desc',$page, $sort); ?></th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>

                <?php

                $userRowsCount = count($model->fetch(['id']));

                $countRow = $configApp['count_list'];
                $pageCount = ceil($userRowsCount / $countRow);
                $startRow = ($page * $configApp['count_list']) - $countRow;
                
                $limit = array($startRow,$countRow);

                $usersRowsLimit = $model->fetch(['id', 'name', 'surname', 'gender', 'birthday'], null, $sort, $limit);

                if (!empty($usersRowsLimit)) {

                    foreach ($usersRowsLimit as $userRow) {

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

        <nav aria-label="...">
            <ul class="pagination">

                <?php

                for ($i = 1; $i <= $pageCount; $i++) {

                    $classLi = 'page-item';

                    if ($i == $page) {
                        $classLi .= ' active';
                    }

                    echo "<li class='$classLi'><a class='page-link' href='?p=$i&sort=$sort'>$i</a></li>";
                }

                ?>

            </ul>
        </nav>
    </div>
</div>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

?>