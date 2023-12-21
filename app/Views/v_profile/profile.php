<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?></title>
    <meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
    <meta name="author" content="Pike Web Development - https://www.pikephp.com">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('icon.svg') ?>">

    <!-- Switchery css -->
    <link href="<?= base_url('assets/panel/plugins/switchery/switchery.min.css') ?>" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/panel/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Font Awesome CSS -->
    <link href="<?= base_url('assets/panel/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/panel/css/style.css') ?>" rel="stylesheet" type="text/css" />

    <!-- BEGIN CSS for this page -->
    <script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/dist/sweetalert2.css') ?>">
    <!-- END CSS for this page -->

</head>

<body class="adminbody">

    <div id="main">

        <!-- top bar navigation -->
        <?= $navbar ?>
        <!-- End Navigation -->


        <!-- Left Sidebar -->
        <?= $this->include('layout/sidebar'); ?>
        <!-- End Sidebar -->


        <div class="content-page">

            <!-- Start content -->
            <div class="content">

                <div class="container-fluid">


                    <div class="row">
                        <div class="col-xl-12">
                            <div class="breadcrumb-holder">
                                <h1 class="main-title float-left">Profile</h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">Profile</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3><i class="fa fa-file-o"></i> Form Profile</h3>
                                </div>

                                <div class="card-body">

                                    <form action="<?= site_url('MainController/updateUser') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" placeholder="Enter Username" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" placeholder="Enter Name" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" placeholder="Enter Email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="hp">Phone</label>
                                            <input type="text" placeholder="Enter Phone" class="form-control" id="hp" name="hp" value="<?= $user['hp'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" placeholder="Enter Password" class="form-control" id="password" name="password" value="" required>
                                        </div>


                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary" type="submit">
                                                Submit
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div><!-- end card-->
                        </div>



                    </div>



                </div>
                <!-- END container-fluid -->

            </div>
            <!-- END content -->

        </div>
        <!-- END content-page -->

        <?= $this->include('layout/footer'); ?>

    </div>
    <!-- END main -->

    <script src="<?= base_url('assets/panel/js/modernizr.min.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/moment.min.js') ?>"></script>

    <script src="<?= base_url('assets/panel/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/bootstrap.min.js') ?>"></script>

    <script src="<?= base_url('assets/panel/js/detect.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/fastclick.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/jquery.blockUI.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/jquery.nicescroll.js') ?>"></script>
    <script src="<?= base_url('assets/panel/js/jquery.scrollTo.min.js') ?>"></script>
    <script src="<?= base_url('assets/panel/plugins/switchery/switchery.min.js') ?>"></script>

    <!-- App js -->
    <script src="<?= base_url('assets/panel/js/pikeadmin.js') ?>"></script>

    <!-- BEGIN Java Script for this page -->
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
    <!-- END Java Script for this page -->

</body>

</html>