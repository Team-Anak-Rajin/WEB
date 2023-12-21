<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= base_url('icon.svg') ?>">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="<?= base_url('assets/auth/css/styles.css') ?>">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/dist/sweetalert2.css') ?>">

    <title><?= $title ?></title>
</head>

<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
                <img src="<?= base_url('assets/auth/img/img-login.svg') ?>" alt="">
            </div>

            <div class="login__forms">
                <form action="<?= base_url('AuthController/loginUser') ?>" method="post" class="login__registre" id="login-in">
                    <?= csrf_field() ?>
                    <h1 class="login__title">Sign In</h1>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="text" name="usernameLogin" placeholder="Username" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="passwordLogin" placeholder="Password" class="login__input">
                    </div>

                    <button type="submit" class="login__button">Sign In</button>

                    <div>
                        <span class="login__account">Don't have an Account ?</span>
                        <span class="login__signin" id="sign-up">Sign Up</span>
                    </div>
                </form>

                <form action="<?= base_url('AuthController/registerUser') ?>" method="post" class="login__create none" id="login-up">
                    <?= csrf_field() ?>
                    <h1 class="login__title">Create Account</h1>


                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="text" name="usernameRegist" placeholder="Username" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" name="name" placeholder="Name" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-envelope login__icon'></i>
                        <input type="text" name="email" placeholder="Email" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-phone login__icon'></i>
                        <input type="number" name="hp" placeholder="Phone" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="passwordRegist" placeholder="Password" class="login__input">
                    </div>

                    <button type="submit" class="login__button">Sign Up</button>

                    <div>
                        <span class="login__account">Already have an Account ?</span>
                        <span class="login__signup" id="sign-in">Sign In</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <script src="<?= base_url('assets/auth/js/main.js') ?>"></script>



    <script>
        function showAlert(status, message) {
            Swal.fire({
                icon: status,
                title: message
            });
        }
    </script>

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            showAlert('success', '<?= session()->getFlashdata('success') ?>');
        </script>
    <?php elseif (session()->getFlashdata('error')) : ?>
        <script>
            showAlert('error', '<?= session()->getFlashdata('error') ?>');
        </script>
    <?php endif; ?>

</body>

</html>