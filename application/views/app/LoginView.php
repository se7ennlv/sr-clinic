<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SR Clinic</title>

    <!-- css core -->
    <link href="<?= base_url() . "assets/"; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() . "assets/"; ?>css/sb-admin-2.css" rel="stylesheet">
    <link href="<?= base_url() . "assets/"; ?>vendor/smoke/css/smoke.min.css" rel="stylesheet">
    <link href="<?= base_url() . "assets/"; ?>css/style.css?v=1.0.0" rel="stylesheet">
</head>

<body class="" id="login">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6" style="background-image: linear-gradient(-225deg, #FFFEFF 0%, #D7FFFE 100%);">
                                <div class="p-5">
                                    <img src="<?= base_url(); ?>/assets/img/logo.png" alt="Logo" class="rounded mx-auto d-block img-logo" />
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>SR CLINIC</strong></h1>
                                    </div>
                                    <form class="user" name="frm-login" id="frm-login" method="POST" autocomplete="off" novalidate="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="Username" id="Username" placeholder="Enter Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="Password" id="Password" placeholder="Enter Password" required>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small"><strong>Version 3.0.2</strong></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- js core -->
    <script src="<?= base_url() . "assets/"; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() . "assets/"; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() . "assets/"; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() . "assets/"; ?>js/sb-admin-2.min.js"></script>
    <script src="<?= base_url() . "assets/"; ?>vendor/smoke/js/smoke.min.js"></script>
    <script src="<?= base_url() . "assets/"; ?>vendor/blockUI/jquery.blockUI.js"></script>
    <script src="<?= base_url() . "assets/"; ?>js/script.js?v=1.0.8"></script>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();

                if ($(this).smkValidate()) {
                    var formData = $(this).serialize();

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('AppController/ExecuteLogin'); ?>',
                        data: formData,
                        beforeSend: function() {
                            BlockUI('Checking...');
                        }
                    }).done(function(data) {
                        UnblockUI();

                        if (data.status == 'success') {
                            SmkAlert(data.message, data.status);
                            window.location = '<?= site_url('HomeController'); ?>';
                        } else {
                            SmkAlert(data.message, data.status);
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        SmkAlert('Something went wrong, please contact IT', 'danger');
                    });
                }
            });
        });
    </script>

</body>

</html>