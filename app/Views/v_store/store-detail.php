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
    <link href="<?= base_url('assets/panel/plugins/owlcarousel/owl.carousel.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/panel/plugins/owlcarousel/owl.theme.default.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet' />
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
                                <h1 class="main-title float-left">Store Detail</h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">Store Detail</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                    <div class="row">
                        <div class="col-xl-12">

                            <div class="card mb-3">

                                <div class="card-body">
                                    <!-- Display place details here -->
                                    <h2 class="mb-3"><?= $resData['name'] ?></h2>

                                    <div class="owl-2 owl-carousel owl-theme">
                                        <!-- Add images dynamically based on the response data -->
                                        <?php if (isset($resData['photoUrls']) && is_array($resData['photoUrls'])) : ?>
                                            <?php foreach ($resData['photoUrls'] as $photo) : ?>
                                                <img style="object-fit: cover; width: 100%; height: 50vh;" src="#" alt="image" class="owl-lazy" data-src="<?= $photo ?>">
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <p>No photos available</p>
                                        <?php endif; ?>
                                    </div>

                                    <p style="margin-bottom: 3px;"><b><?= $resData['formatted_address'] ?></b></p>
                                    <p style="margin-bottom: 3px;"><i class="bx bxs-star" style="color:#d6ec05"></i> <?= $resData['rating'] ?></p>
                                    <?php
                                    $isOpenNow = isset($resData['opening_hours']['open_now']) && $resData['opening_hours']['open_now'] === true;
                                    $isOpen = $isOpenNow ? 'Open' : 'Closed';
                                    $fontColor = $isOpenNow ? 'green' : 'red';
                                    ?>

                                    <p style="color: <?= $fontColor ?>;"><?= $isOpen ?></p>
                                    <!-- Opening Hours -->
                                    <h4>Opening Hours</h4>
                                    <ul>
                                        <?php
                                        if (isset($resData['opening_hours']['periods']) && is_array($resData['opening_hours']['periods'])) :
                                            $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                            foreach ($resData['opening_hours']['periods'] as $period) :
                                                $openDayIndex = $period['open']['day'] ?? null;
                                                $closeDayIndex = $period['close']['day'] ?? null;

                                                // Ensure the day indices are valid
                                                if ($openDayIndex !== null && $closeDayIndex !== null && array_key_exists($openDayIndex, $daysOfWeek) && array_key_exists($closeDayIndex, $daysOfWeek)) :
                                                    $openDay = $daysOfWeek[$openDayIndex];
                                                    $closeDay = $daysOfWeek[$closeDayIndex];

                                                    $openTime = date('g:i A', strtotime($period['open']['time'] ?? '00:00'));
                                                    $closeTime = date('g:i A', strtotime($period['close']['time'] ?? '00:00'));
                                        ?>
                                                    <li><?= $openDay ?>: <span style="color: green;"><?= $openTime ?> - <?= $closeTime ?></span></li>
                                            <?php
                                                endif;
                                            endforeach;
                                        else :
                                            ?>
                                            <li>N/A</li>
                                        <?php endif; ?>
                                    </ul>


                                    <!-- Contact Information -->
                                    <h4>Contact Information</h4>
                                    <p>Phone: <?= $resData['international_phone_number'] ?? 'N/A' ?></p>
                                    <p>Email: <?= $resData['email'] ?? 'N/A' ?></p>

                                    <!-- Additional Details -->
                                    <h4>Additional Details</h4>
                                    <p>Delivery: <?= isset($resData['delivery']) ? ($resData['delivery'] ? 'Available' : 'Not Available') : 'N/A' ?></p>
                                    <p>Dine-in: <?= isset($resData['dine_in']) ? ($resData['dine_in'] ? 'Available' : 'Not Available') : 'N/A' ?></p>
                                    <p>Takeout: <?= isset($resData['takeout']) ? ($resData['takeout'] ? 'Available' : 'Not Available') : 'N/A' ?></p>

                                    <!-- WhatsApp Share Button -->
                                    <?php
                                    $whatsAppMessage = "Check out this place: " . $resData['url'];
                                    $whatsAppShareLink = "https://wa.me/?text=" . rawurlencode($whatsAppMessage);
                                    ?>

                                    <a role="button" href="<?= $whatsAppShareLink ?>" class="btn btn-success" target="_blank">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>

                                    <a role="button" href="<?= $resData['url'] ?>" class="btn btn-primary" target="_blank">
                                        <i class="fa fa-map-marker"></i>
                                    </a>

                                    <button class="btn btn-secondary" id="copyLinkBtn">
                                        <i class="fa fa-external-link"></i>
                                    </button>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url('assets/panel/plugins/owlcarousel/owl.carousel.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('.owl-2').owlCarousel({
                items: 1,
                lazyLoad: true,
                loop: true,
                margin: 10
            });

            // Inisialisasi Magnific Popup
            $('.owl-2').magnificPopup({
                delegate: 'img',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });

        });
    </script>
    <!-- END Java Script for this page -->
    <script>
        document.getElementById('copyLinkBtn').addEventListener('click', function() {
            // Get the URL
            var url = '<?= $resData['url'] ?>';

            // Create a temporary input element
            var input = document.createElement('input');
            input.style.position = 'fixed';
            input.style.opacity = 0;
            input.value = url;
            document.body.appendChild(input);

            // Select and copy the text
            input.select();
            document.execCommand('copy');

            // Remove the temporary input
            document.body.removeChild(input);

            // Optionally, provide feedback to the user (e.g., display a tooltip)
            this.setAttribute('data-toggle', 'tooltip');
            this.setAttribute('data-placement', 'bottom');
            this.setAttribute('title', 'Link copied to clipboard');
            $(this).tooltip('show');
            setTimeout(function() {
                $('#copyLinkBtn').tooltip('dispose');
            }, 2000); // Hide tooltip after 2 seconds
        });
    </script>
</body>

</html>