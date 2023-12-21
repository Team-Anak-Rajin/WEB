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

    <link href="<?= base_url('assets/panel/plugins/ion-rangeslider/ion.rangeSlider.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/panel/plugins/ion-rangeslider/ion.rangeSlider.skinFlat.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/panel/plugins/star-rating/star-rating.min.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/panel/plugins/star-rating/theme.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/sweetalert2/dist/sweetalert2.css') ?>" rel="stylesheet" />
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        .status-container {
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
            border: 2px solid #4CAF50;
        }

        p.status {
            margin: 0;
            padding: 8px;
            border-radius: 4px;
            color: #4CAF50;
        }

        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- BEGIN CSS for this page -->

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
                                <h1 class="main-title float-left">Store</h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">Store</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="input-group">
                                <input type="text" name="search_input" class="form-control" placeholder="Search..." aria-label="Search">
                                <div class="input-group-append">
                                    <button type="button" name="btn_search" id="btn_search" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <button type="button" name="btn_filter" class="btn btn-primary" data-toggle="modal" data-target="#modal_filter"><i class="fa fa-filter" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h3><i class="fa fa-search"></i> Search Store</h3>
                                </div>

                                <div class="card-body" style="max-height: 60vh; overflow-y: auto">
                                    <table class=" table table-borderless">
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div id="loadingData" style="display: flex; align-items: center; justify-content: center;">

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
    <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_filter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body" style="overflow-y: auto; max-height: 75vh">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Radius</label>
                                <input name="radius" type="text" id="radius_slider">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Price</label>
                                <input name="price" type="text" id="price_slider">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Rating</label>
                                <input name="rating" class="fa-theme rating-loading" value="1" dir="ltr" data-size="xs" data-step="0.5">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Opened</label>
                                <select name="isOpened" class="form-control">
                                    <option selected="selected" value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tag</label>
                                <select style="width: 100%" class="select2" name="category[]" multiple="multiple">
                                    <option value="fruits">Fruits</option>
                                    <option value="vegetables">Vegetables</option>
                                    <option value="meat">Meat</option>
                                    <option value="seafood">Seafood</option>
                                    <option value="farmers">Farmers</option>
                                    <option value="bakerie">Bakerie</option>
                                    <option value="delis">Delis</option>
                                    <option value="grocery store">Grocery Store</option>
                                    <option value="market">Market</option>
                                    <option value="supermarket">Supermarket</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
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

    <!-- END Java Script for this page -->

    <script src="<?= base_url('assets/panel/plugins/star-rating/star-rating.min.js') ?>"></script>
    <script src="<?= base_url('assets/panel/plugins/star-rating/theme.js') ?>"></script>
    <script src="<?= base_url('assets/panel/plugins/ion-rangeslider/ion.rangeSlider.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        function showAlert(status, message) {
            Swal.fire({
                icon: status,
                title: message
            });
        }
    </script>

    <script>
        $("#radius_slider").ionRangeSlider({
            min: 300,
            max: 10000,
            from: 1000,
            postfix: " m"
        });

        $("#price_slider").ionRangeSlider({
            type: "double",
            grid: true,
            min: 15000,
            max: 5000000,
            from: 15000,
            to: 500000,
            prefix: "Rp "
        });
    </script>
    <script>
        jQuery(function($) {
            $('.fa-theme').rating({
                theme: 'krajee-fa'
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function limitCharacters(element, limit) {
                var text = element.innerText;
                if (text.length > limit) {
                    element.innerText = text.substring(0, limit) + "...";
                }
            }

            function setCharacterLimit() {
                var h5Elements = document.querySelectorAll('.card-body h5');
                var limit = window.innerWidth >= 768 ? 180 : 20;

                h5Elements.forEach(function(h5) {
                    limitCharacters(h5, limit);
                });
            }
            setCharacterLimit();
            window.addEventListener('resize', setCharacterLimit);
        });
    </script>

    <script>
        let csrfToken = '<?= csrf_token() ?>';
        let csrfHash = '<?= csrf_hash() ?>';
        $(document).ready(function() {
            var userLatitude, userLongitude;
            var isLoad = false;
            var isLocation = false;
            var addMore = true;


            function getUserLocation() {
                Swal.fire({
                    title: 'Get location...',
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            userLatitude = position.coords.latitude;
                            userLongitude = position.coords.longitude;
                            isLocation = true;
                            Swal.close();
                            showAlert('success', 'Location found');
                        },
                        function(error) {
                            isLocation = false;
                            Swal.close();
                            showAlert('error', 'Error getting user location');
                        }
                    );
                } else {
                    showAlert('error', 'Geolocation is not supported by this browser');
                }
            }

            getUserLocation();

            function fetchData() {
                addMore = false;
                loadMore();
                fetch(`<?= site_url('MainController/getNextStores/') ?>${userLatitude}/${userLongitude}`)
                    .then(response => response.json())
                    .then(data => {
                        hideLoad();
                        if (data.status && data.message) {
                            showAlert('error', data.message);
                        }
                        if (data.resData && data.resData.length > 0) {
                            $.each(data.resData, function(index, store) {
                                const photoUrl = store.place.photos && store.place.photos.length > 0 ?
                                    store.place.photos[0].url :
                                    '<?= base_url('assets/panel/images/2b8ce5d5-canon-powershot-g3-x-sample-images-1.jpg') ?>';

                                const isOpenNow = store.place.opening_hours && store.place.opening_hours.open_now === true;
                                const businessStatus = isOpenNow ? 'Open' : 'Closed';
                                const fontColor = isOpenNow ? 'green' : 'red';

                                var row = '<tr>' +
                                    '<td style="width: 130px;">' +
                                    '<img style="width: 100px; height: 110px; object-fit: cover;" alt="image" src="' + photoUrl + '">' +
                                    '</td>' +
                                    '<td>' +
                                    '<h5><a href="<?= site_url('app/store/') ?>' + store.place.place_id + '">' + store.place.name + '</a></h5>' +
                                    '<p><i class="bx bxs-star" style="color:#d6ec05"></i> ' + store.place.rating + ' • <span style="color:' + fontColor + '">' + businessStatus + '</span></p>' +
                                    '<p class="card-text" style="font-size: 11px; margin-top: -8px;">' +
                                    store.distance + ' • ' + store.duration +
                                    '</p>' +
                                    '</td>' +
                                    '</tr>';

                                $('.table tbody').append(row);
                                addMore = true;
                            });
                        } else {
                            window.removeEventListener('scroll', fetchData);
                            showAlert('error', 'No data received or invalid format');
                        }
                    })
                    .catch(error => console.log('Error fetching data:', error));
            }

            function loadMore() {
                $('#loadingData').html('<div class="spinner"></div>');

            }

            function hideLoad() {
                $('#loadingData').empty();
            }


            const cardBody = document.querySelector('.card-body');

            cardBody.addEventListener('scroll', function() {
                const scrollPosition = cardBody.scrollTop + cardBody.clientHeight;
                const totalHeight = cardBody.scrollHeight;

                if (scrollPosition >= totalHeight - 100) {
                    if (isLoad === true && addMore === true) {
                        fetchData();
                    }
                }
            });

            $('#btn_search').on('click', function() {
                if (isLocation === true) {
                    isLoad = true;
                    var searchInputValue = $('input[name="search_input"]').val();
                    var radiusValue = $('#radius_slider').data("ionRangeSlider").result.from;
                    var priceValues = $('#price_slider').data("ionRangeSlider").result;
                    var ratingValue = $('input[name="rating"]').val();
                    var isOpenedValue = $('select[name="isOpened"]').val();
                    var selectedValues = $('.select2').val();

                    if (searchInputValue === '') {
                        showAlert('error', 'Search input must be filled')
                    } else {
                        $.ajax({
                            url: '<?= site_url('MainController/getStores') ?>',
                            type: 'POST',
                            data: {
                                [csrfToken]: csrfHash,
                                searchInput: searchInputValue,
                                radius: radiusValue,
                                minPrice: priceValues.from,
                                maxPrice: priceValues.to,
                                rating: ratingValue,
                                isOpened: isOpenedValue,
                                userLatitude: userLatitude,
                                userLongitude: userLongitude,
                                category: selectedValues
                            },
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

                                if (!response.resData || response.resData.length === 0) {
                                    showAlert('info', 'No places found.');
                                    return;
                                }

                                $('.table tbody').empty();

                                $.each(response.resData, function(index, store) {
                                    // Use the first photo reference if available
                                    const photoUrl = store.place.photos && store.place.photos.length > 0 ?
                                        store.place.photos[0].url :
                                        '<?= base_url('assets/panel/images/2b8ce5d5-canon-powershot-g3-x-sample-images-1.jpg') ?>';

                                    const isOpenNow = store.place.opening_hours && store.place.opening_hours.open_now === true;
                                    const businessStatus = isOpenNow ? 'Open' : 'Closed';
                                    const fontColor = isOpenNow ? 'green' : 'red';

                                    var row = '<tr>' +
                                        '<td style="width: 130px;">' +
                                        '<img style="width: 100px; height: 110px; object-fit: cover;" alt="image" src="' + photoUrl + '">' +
                                        '</td>' +
                                        '<td>' +
                                        '<h5><a href="<?= site_url('app/store/') ?>' + store.place.place_id + '">' + store.place.name + '</a></h5>' +
                                        '<p><i class="bx bxs-star" style="color:#d6ec05"></i> ' + store.place.rating + ' • <span style="color:' + fontColor + '">' + businessStatus + '</span></p>' +
                                        '<p class="card-text" style="font-size: 11px; margin-top: -8px;">' +
                                        store.distance + ' • ' + store.duration +
                                        '</p>' +
                                        '</td>' +
                                        '</tr>';

                                    $('.table tbody').append(row);
                                });


                            },
                            error: function(error) {
                                Swal.close();
                                showAlert('error', 'Unknown error occurred');
                            }
                        });
                    }

                } else {
                    showAlert('error', 'Error getting user location');
                }

            });

        });
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