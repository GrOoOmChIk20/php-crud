<?php

$titlePage = 'Login user';

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

?>


<div class="container-fluid h-custom">

    <h1 class="text-center"><?= $titlePage ?></h1>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
        </div>

        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="actions/login.php" method="post">
                <div class="form-outline mb-4">
                    <input type="text" class="form-control form-control-lg" name="User[login]" placeholder="Enter login" />
                </div>

                <div class="form-outline mb-3">
                    <input type="password" id="form3Example4" class="form-control form-control-lg" name="User[pass]" placeholder="Enter password" />
                </div>

                <div class="text-lg-start mt-4 pt-2">
                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/footer.php';

?>