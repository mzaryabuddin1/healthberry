<!DOCTYPE html>

<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PROJECT_NAME ?></title>
    <meta name="description" content="<?= PROJECT_DESCRIPTION ?>" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="<?= base_url() ?>theme/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Wrapper -->
    <div class="hk-wrapper hk-pg-auth" data-footer="simple">
        <!-- Main Content -->
        <div class="hk-pg-wrapper pt-0 pb-xl-0 pb-5">
            <div class="hk-pg-body pt-0 pb-xl-0">
                <!-- Container -->
                <div class="container-xxl">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-10 position-relative mx-auto">
                            <div class="auth-content py-8">
                                <form class="w-100" id="regstr">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
                                            <div class="text-center mb-7">
                                                <a class="navbar-brand me-0" href="index.html">
                                                    <img class="brand-img d-inline-block" src="<?= base_url() ?>theme/dist/img/roilogo.png" alt="brand">
                                                </a>
                                            </div>
                                            <div class="card card-lg card-border">
                                                <div class="card-body">
                                                    <h4 class="mb-4 text-center">Recover your account</h4>
                                                    <div class="row gx-3">
                                                        <div class="form-group col-lg-12">
                                                            <div class="form-label-group">
                                                                <label>Email</label>
                                                            </div>
                                                            <input class="form-control" placeholder="Enter email" name="email" type="email" required />
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-uppercase btn-block">Reset</button>
                                                    <!-- <p class="p-xs mt-2 text-center">New to Jampack? <a href="#"><u>Create new account</u></a></p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->
                </div>
                <!-- /Container -->
            </div>
            <!-- /Page Body -->

            <!-- Page Footer -->
            <div class="hk-footer border-0">
                <footer class="container-xxl footer">
                    <div class="row">
                        <div class="col-xl-8 text-center">
                            <p class="footer-text pb-0"><span class="copy-text"><?= CREATED_BY ?> © <?= date('Y') ?> All rights reserved.</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- / Page Footer -->

        </div>
        <!-- /Main Content -->
    </div>
    <!-- /Wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>theme/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= base_url() ?>theme/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FeatherIcons JS -->
    <script src="<?= base_url() ?>theme/dist/js/feather.min.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="<?= base_url() ?>theme/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Simplebar JS -->
    <script src="<?= base_url() ?>theme/vendors/simplebar/dist/simplebar.min.js"></script>

    <!-- Init JS -->
    <script src="<?= base_url() ?>theme/dist/js/init.js"></script>


    <script>
        $("#regstr").on("submit", function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo base_url() . "forgot-password-submit"; ?>",
                type: "get",
                data: $(this).serialize(),
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                cache: false,
                beforeSend: function() {
                    // $(":submit").prop("disabled", true);
                    // $(":submit").addClass("d-none");
                    // $("#spinner").removeClass("d-none");
                    // $("#error").addClass("d-none");
                },
                success: function(res) {

                    console.log(res)
                    // let obj = JSON.parse(res);
                    // if (obj.error) {
                    //     $("#error").html(obj.error);
                    //     $("#error").removeClass("d-none");
                    //     $("#spinner").addClass("d-none");
                    //     $(":submit").removeClass("d-none");
                    //     toastr.error("Please check errors list!", "Error");
                    //     $(window).scrollTop(0);
                    // } else if (obj.success) {
                    //     $("#spinner").addClass("d-none");
                    //     toastr.success("Success!", "Hurray");
                    //     setTimeout(function() {
                    //         window.location = '<?php echo base_url() . 'customer-settings' ?>';
                    //     }, 1000);
                    // } else {
                    //     $("#spinner").addClass("d-none");
                    //     $(":submit").prop("disabled", false);
                    //     $(":submit").removeClass("d-none");
                    //     toastr.error("Something bad happened!", "Error");
                    //     $(window).scrollTop(0);
                    // }
                    // $(":submit").prop("disabled", false);
                },
                error: function(error) {
                    // toastr.error("Error while sending request to server!", "Error");
                    // $(window).scrollTop(0);
                    // $("#spinner").addClass("d-none");
                    // $(":submit").prop("disabled", false);
                    // $(":submit").removeClass("d-none");
                }
            })
        });
    </script>
</body>

</html>