<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kinerja Dosen</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #6201ED">
        <div class="container-fluid">
            <a class="navbar-brand-a">

                <div class="align-self-md-center" style="font-size: 1.6rem;">
                    E-Kinerja Dosen
                </div>


            </a>
        </div>
    </nav>

    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light p-3">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url(); ?>/auth/login" method="post" class="row g-3">
                        <h4 class="text-center">Welcome Back</h4>
                        <div class="col-12">
                            <label style="margin-bottom: 0.5rem;">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-12">
                            <label style="margin-bottom: 0.5rem;">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-12" style="margin-top: 2rem;">
                            <button type="submit" class="btn btn-dark float-end">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>


</html>