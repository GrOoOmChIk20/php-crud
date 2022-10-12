<?php

$titlePage = 'Edit user';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

$userData = $model->view($_GET);

?>

<div class="row justify-content-center">

    <div class="col-6 align-self-center">
        <h1 class="text-center"><?= $titlePage ?></h1>
        <?php $insert = $model->edit();  ?>

        <form action="" method="post">
            <div class="form-group">
                <input type="hidden" name="User[id]" value="<?= $userData['id']; ?>"></p>
            </div>
            <div class="form-group">
                <label>Login</label>
                <input type="text" class="form-control" name="User[login]" placeholder="Login" value="<?= $userData['login']; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="User[pass]" placeholder="Password" value="<?= $userData['password']; ?>">
            </div>
            <div class=" form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="User[name]" placeholder="Name" value="<?= $userData['name']; ?>">
            </div>
            <div class="form-group">
                <label>Surname</label>
                <input type="text" class="form-control" name="User[surname]" placeholder="Surname" value="<?= $userData['surname']; ?>">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="User[gender]" value="m" <? echo ($userData['gender'] == 'm') ?  'checked' : '' ?>>
                    <label class="form-check-label" for="RadiosGenderM">
                        Male gender
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="User[gender]" value="f" <? echo ($userData['gender'] == 'f') ?  'checked' : '' ?>>
                    <label class="form-check-label" for="RadiosGenderF">
                        Female gender
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Birthday</label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="date" id="form-control-datepicker" name="User[birthday]" value="<?= date('Y-m-d', $userData['birthday']); ?>">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning" name="User[edit]">Edit user</button>
            </div>
        </form>
    </div>
</div>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

?>