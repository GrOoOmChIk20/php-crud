<?php

$titlePage = 'Web-interface: View user';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

$userData = $model->view($_GET);

?>

<div class="row justify-content-center">

    <div class="col-6 align-self-center">
        <h1 class="text-center"><?= $titlePage ?></h1>

        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="User[name]" placeholder="Name" value="<?= $userData['name']; ?>" disabled readonly>
        </div>
        <div class="form-group">
            <label>Surname</label>
            <input type="text" class="form-control" name="User[surname]" placeholder="Surname" value="<?= $userData['surname']; ?>" disabled readonly>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="User[gender]" value="m" <? echo ($userData['gender'] == 'm') ?  'checked' : 'disabled' ?>>
                <label class="form-check-label" for="RadiosGenderM">
                    Male gender
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="User[gender]" value="f" <? echo ($userData['gender'] == 'f') ?  'checked' : 'disabled' ?>>
                <label class="form-check-label" for="RadiosGenderF">
                    Female gender
                </label>
            </div>
        </div>
        <div class="form-group">
            <label>Birthday</label>
            <div class="input-group date" data-provide="datepicker">
                <input type="date" id="form-control-datepicker" name="User[birthday]" value="<?= date('Y-m-d', $userData['birthday']); ?>" disabled>
            </div>
        </div>
        <a href="../actions/edit.php?id=<?= $userData['id'] ?>" type="button" class="btn btn-warning">Edit user</a>
    </div>
</div>

<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

?>