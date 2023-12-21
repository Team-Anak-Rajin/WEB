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
    <link href="<?= base_url('assets/sweetalert2/dist/sweetalert2.css') ?>" rel="stylesheet" />
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
                                <h1 class="main-title float-left">History</h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">History</li>
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
                                    <h3><i class="fa fa-search"></i> History <?= $target ?></h3>
                                </div>

                                <div class="card-body" style="max-height: 65vh; overflow-y: auto">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Original</th>
                                                <th scope="col">Detect</th>
                                                <th scope="col">Coun</th>
                                                <th scope="col">UpTime</th>
                                                <th scope="col">Act</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($resData) && is_array($resData)) : ?>
                                                <?php $a = 1; ?>
                                                <?php foreach ($resData as $d) : ?>
                                                    <tr>
                                                        <th scope="row"><?= $a ?></th>
                                                        <td>
                                                            <img style="width: 100px;" src="<?= $urlOri . $d['image'] ?>" alt="">
                                                        </td>
                                                        <td>
                                                            <img style="width: 100px; cursor: pointer;" src="<?= $urlDetect . $d['detectName'] ?>" alt="" onclick="openModal('<?= $d['numDetected'] ?>')">
                                                        </td>
                                                        <td><?= $d['numDetected'] ?></td>
                                                        <td>
                                                            <?php
                                                            $timestamp = strtotime($d['up_time']);
                                                            $formatted_time = date('Y-m-d h:i:s A', $timestamp);
                                                            echo $formatted_time;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick="confirmDelete('<?= $d['id_' . $target] ?>')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php $a++; ?>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <p>No data available</p>
                                            <?php endif; ?>


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <!-- Modal -->
                    <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="imageModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Result Scan</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <div class="form-group">
                                                <img id="modalImage" style="width: 100%;" src="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Count Result</label>
                                                <input class="form-control" id="modalInfo" name="title" type="text" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openModal(info) {
            // Setel informasi tambahan di dalam modal
            document.getElementById('modalInfo').value = info;

            // Setel gambar di dalam modal
            document.getElementById('modalImage');

            // Buka modal
            $('#imageModal').modal('show');
        }
    </script>

    <script>
        function confirmDelete(targetId) {
            Swal.fire({
                title: 'Warning',
                text: 'Anda yakin ingin menghapus ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes'
            }).then((result) => {
                window.location.href = '<?= site_url('MainController/deleteTarget/' . $target) ?>/' + targetId;
            });
        }

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