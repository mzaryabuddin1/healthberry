<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PROJECT_NAME ?></title>
    <meta name="description" content="<?= PROJECT_DESCRIPTION ?>" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>mazer/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>mazer/assets/css/app.css">
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light">
        <div class="container d-block">
            <!-- <a href="index.html"><i class="bi bi-chevron-left"></i></a> -->
            <a class="navbar-brand ms-4" href="#">
                <!-- <img width="100" src="<?= base_url() ?>mazer/assets/images/logo/logo.jpeg"> -->
                <h3 class="text-success">Health Berry</h3>
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sign In</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body pt-0">
                                <form class="form form-vertical" id="regstr">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger  <?= isset($_GET['err']) ? "" : "d-none" ?>" role="alert" id="error"><?= isset($_GET['err']) ? $_GET['err'] : "" ?></div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="first-name-icon">Username</label>
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control" placeholder="Enter your username" id="first-name-icon" minlength="3" name="username" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group has-icon-left">
                                                    <label for="password-id-icon">Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" placeholder="Enter your password" id="password-id-icon" minlength="5" name="password" required>
                                                        <div class="form-control-icon">
                                                            <i class="bi bi-lock"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 d-flex justify-content-center">
                                                <div class="spinner-border text-dark d-none" role="status" id="spinner">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Vertical form layout section end -->
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Set the options that I want
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        // toastr.error("Please check errors list!", "Error");
    </script>

    <script>
        $(function() {
            $("#regstr").on("submit", function(e) {
                e.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                    url: "<?php echo base_url() . "app-login-submit"; ?>",
                    type: "post",
                    data: formdata,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    cache: false,
                    beforeSend: function() {
                        $(":submit").prop("disabled", true);
                        $(":submit").addClass("d-none");
                        $("#spinner").removeClass("d-none");
                        $("#error").addClass("d-none");
                    },
                    success: function(res) {
                        let obj = JSON.parse(res);
                        if (obj.error) {
                            $("#error").html(obj.error);
                            $("#error").removeClass("d-none");
                            $("#spinner").addClass("d-none");
                            $(":submit").removeClass("d-none");
                            toastr.error("Please check errors list!", "Error");
                            $(window).scrollTop(0);
                        } else if (obj.success) {
                            $("#spinner").addClass("d-none");
                            toastr.success("Welcome!", "On Board!");
                            setTimeout(function() {
                                window.location = '<?php echo base_url() . 'app-dashboard' ?>';
                            }, 1000);
                        } else {
                            $("#spinner").addClass("d-none");
                            $(":submit").prop("disabled", false);
                            $(":submit").removeClass("d-none");
                            toastr.error("Something bad happened!", "Error");
                            $(window).scrollTop(0);
                        }

                        $(":submit").prop("disabled", false);
                    },
                    error: function(error) {
                        toastr.error("Error while sending request to server!", "Error");
                        $(window).scrollTop(0);
                        $("#spinner").addClass("d-none");
                        $(":submit").prop("disabled", false);
                        $(":submit").removeClass("d-none");
                    }
                })
            })
        })
    </script>

</body>

</html>