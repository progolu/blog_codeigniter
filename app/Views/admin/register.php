<!doctype html>
<html lang="en">

<head>
    <title>ULEVEL</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <!--Convert to an external stylesheet-->
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            background: #141E30;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #243B55, #141E30);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #243B55, #141E30);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: white;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            color: #212121;
            border: 4px solid #ff993b;
            border-radius: 25px;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>

</head>

<body class="text-center">
    <div class="form-signin bg-light">
    <form action="<?= site_url('admin/save'); ?>" method="post" autocomplete="off">
                                    <?= csrf_field(); ?>
                                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                                        <?php endif ?>

                                        <?php if(!empty(session()->getFlashdata('success'))) : ?>
                                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                        <?php endif ?>

                                            <div class="mb-3">
                                                    <label for="Input Full Name" class="form-label">Enter Full name</label>
                                                    <input type="name" class="form-control" name="name" value="<?= set_value('name'); ?>">
                                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                                            </div>
                                                <div class="mb-3">
                                                    <label for="Input Email1" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>">
                                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                                                </div>
                                                    <div class="mb-3">
                                                        <label for="Input Password" class="form-label">Password</label>
                                                        <input type="text" class="form-control" name="password" value="<?= set_value('password'); ?>">
                                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="InputPassword1" class="form-label">Confirm Password</label>
                                                        <input type="text" class="form-control" name="cpassword" value="<?= set_value('cpasswrd'); ?>">
                                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                                                    </div>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                                </div>
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                    <br>
                                   
                                    </form>
                                            <a href="<?= site_url('admin/login'); ?>" >i already have an account, login now</a>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>
</body>

</html>