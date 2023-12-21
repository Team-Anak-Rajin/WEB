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
    <link href="<?= base_url('assets/filepond/dist/filepond.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/sweetalert2/dist/sweetalert2.css') ?>" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
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
                                <h1 class="main-title float-left">ScanMaster <?= $target ?></h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">ScanMaster</li>
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
                                    <h3><i class="fa fa-camera"></i> Scan Image</h3>
                                </div>

                                <div class="card-body">
                                    <input id="inputImage" type="file" class="filepond" name="inputImage" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="1">
                                    <button id="scanButton" style="display:none;" class="btn btn-success">Scan<span class="btn-label btn-label-right"><i class="fa fa-camera"></i></span></button>
                                    <button id="modalButton" style="display:none;" class="btn btn-secondary" data-toggle="modal" data-target="#modal_scan">Result<span class="btn-label btn-label-right"><i class="fa fa-eye"></i></span></button>
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

    <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_scan">
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
                                <img style="max-width: 100%;height: auto; display: block;" src="<?= base_url('assets/panel/images/8b75635e-final-nature.png') ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Count Result</label>
                                <input class="form-control" name="title" type="text" value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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

    <script src="<?= base_url('assets/filepond/dist/filepond.js') ?>"></script>

    <!-- FilePond Image Preview Plugin -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

        const inputImage = document.getElementById('inputImage');
        const scanButton = document.getElementById('scanButton');
        const modalButton = document.getElementById('modalButton');

        const pond = FilePond.create(inputImage, {
            allowReorder: true,
            maxFileSize: '3MB',
            maxFiles: 1,
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            labelFileTypeNotAllowed: 'File of invalid type',
            fileValidateTypeLabelExpectedTypes: 'Expects {allButLastType} or {lastType}',
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

                    if (allowedTypes.includes(type)) {
                        scanButton.style.display = 'inline-block';
                        resolve(type);
                    } else {
                        scanButton.style.display = 'none';
                        showAlert('error', 'Invalid file type');
                        resolve(null);
                    }
                }),
            onremovefile: (err, fileItem) => {
                scanButton.style.display = 'none';
                modalButton.style.display = 'none';
            },
        });

        scanButton.addEventListener('click', function() {
            const files = pond.getFiles();

            if (files.length > 0) {
                const formData = new FormData();
                formData.append('image', files[0].file, files[0].file.name);

                fetch('<?= $urlUp ?>', {
                        method: 'POST',
                        headers: {
                            'Authorization': '<?= $token ?>',
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        const imageName = data.imageName;
                        $.ajax({
                            url: '<?= site_url('MainController/getScan/' . $target) ?>/' + imageName,
                            beforeSend: function(data) {
                                Swal.fire({
                                    title: 'Fetching data...',
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function(response) {
                                Swal.close();
                                if (!response) {
                                    showAlert('error', 'Empty response received from the server');
                                    return;
                                }

                                try {
                                    if (typeof response === 'string') {
                                        response = JSON.parse(response);
                                    }
                                } catch (e) {
                                    showAlert('error', 'Error parsing JSON');
                                    return;
                                }

                                if (response.status === 'error') {
                                    showAlert('error', response.message);
                                    return;
                                }

                                if (!response.dataImage || response.dataImage.length === 0) {
                                    showAlert('info', 'No image found.');
                                    return;
                                }
                                $('#modal_scan img').attr('src', response.dataImage);
                                $('#modal_scan input').val(response.totalDetections);
                                modalButton.style.display = 'inline-block';
                                scanButton.style.display = 'none';
                                $("#modal_scan").modal("show");
                            },
                            error: function(xhr, status, error) {
                                showAlert('error', 'Failed to send the file. ' + error);
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('error', 'Error while uploading file.');
                    });
            } else {
                showAlert('error', 'Please select a file first.');
            }
        });

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