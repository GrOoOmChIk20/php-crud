<?php

$titlePage = 'Web-interface: Edit user';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

$userData = $model->view($_GET);

?>

<div class="row justify-content-center">

    <div class="col-6 align-self-center">
        <h1 class="text-center">Web-interface: Edit user</h1>

        <form action="" method="post">
            <div class="form-group">
                <label>Login</label>
                <input type="text" class="form-control" name="User[login]" placeholder="Login" value="<?= $userData['login']; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="User[pass]" placeholder="Password" value="<?= $userData['login']; ?>">
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
            <a href="../actions/edit.php?id=<?= $userData['id'] ?>" type="button" class="btn btn-warning">Edit user</a>
        </form>
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