<?php
require 'functions.php';

if (isset($_POST['register'])) {
    if (register($_POST) > 0) {
        echo "<script>
            alert('Registrasi berhasil !');location = 'index.php';
        </script>";
        exit;
    } else {
        exit;
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container my-5 d-flex justify-content-center">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-3 text-center">
                    <h3>Registrasi</h3>
                </div>
                <div class="card-body p-5">
                    <form action="" method="post">
                        <div class="container-fluid">
                            <div class="row d-flex gap-4">
                                <div class="input-group">
                                    <div class="col-3">
                                        <label for="username" class="col-form-label">Username</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" id="username" class="form-control" name="username" required>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="col-3">
                                        <label for="password" class="col-form-label">Password</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="col-3">
                                        <label for="confirmation_password" class="col-form-label">Konfirmasi Password</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="password" name="confirmation_password" id="confirmation_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="remember_me" type="checkbox" id="checkDefault">
                                            <label class="form-check-label" for="checkDefault">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <div class="col-12">
                                        <p class="fw-light">Sudah punya akun ? silahkan <a href="#" class="text-decoration-none text-dark">login </a></p>
                                        <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>