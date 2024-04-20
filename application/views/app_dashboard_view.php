<?php require_once("common2/header.php") ?>
<!-- MAIN -->
<div class="container">
    <div class="text-end">
        <div id="clock"></div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Hi, <?= ucfirst($_SESSION['app_user_username'])  ?></h5>
                        <a class="btn btn-danger" href="<?= base_url() ?>app-logout">Logout</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger  <?= isset($_GET['err']) ? "" : "d-none" ?>" role="alert" id="error"><?= isset($_GET['err']) ? $_GET['err'] : "" ?></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="spinner-border text-dark d-none" role="status" id="spinner">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Plan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Locations</a>
                            </li>
                            <li class="nav-item" role="presentation" id="historytab">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">History</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-secondary text-light text-center">
                                            <th>DOCTOR</th>
                                            <th>CITY</th>
                                            <th>AREA</th>
                                            <th>CHEMIST</th>
                                            <th>SPECI.</th>
                                            <th>DAY</th>
                                            <th>TIMINGS</th>
                                            <th>CALL</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($plan as $row) : ?>
                                                <tr>
                                                    <td><?= ucfirst($row['doctor_name']) ?></td>
                                                    <td><?= ucfirst($row['city']) ?></td>
                                                    <td><?= ucfirst($row['area']) ?></td>
                                                    <td>
                                                        <?php
                                                        $parsed_chemist = json_decode($row['chemists']);
                                                        foreach ($parsed_chemist as $var) {
                                                            echo ucwords($var) . "<br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $parsed_specs = json_decode($row['specialities']);
                                                        foreach ($parsed_specs as $var) {
                                                            echo ucwords($var) . "<br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= ucfirst($row['planned_day']) ?></td>
                                                    <td>
                                                        <?php
                                                        $parsed_timings = json_decode($row['timings'], true);
                                                        foreach ($parsed_timings as $var) {
                                                            echo $var["from"] . " - " . $var["to"] . "<br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group actBtns" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-outline-primary btn-md callbtn" data-doctor="<?= ucfirst($row['doctor_name']) ?>" data-planid="<?= ucfirst($row['id']) ?>" data-locationid="<?= ucfirst($row['location_id']) ?>"><i class="bi bi-telephone-fill"></i></button>

                                                            <a class="btn btn-outline-danger btn-md" href="<?= base_url() . 'app-view-doctor-location?id=' . $row['id'] ?>"><i class="bi bi-geo-alt"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Integer interdum diam eleifend metus lacinia, quis gravida eros mollis.
                                Fusce non sapien
                                sit amet magna dapibus
                                ultrices. Morbi tincidunt magna ex, eget faucibus sapien bibendum non. Duis
                                a mauris ex.
                                Ut finibus risus sed massa
                                mattis porta. Aliquam sagittis massa et purus efficitur ultricies. Integer
                                pretium dolor
                                at sapien laoreet ultricies.
                                Fusce congue et lorem id convallis. Nulla volutpat tellus nec molestie
                                finibus. In nec
                                odio tincidunt eros finibus
                                ullamcorper. Ut sodales, dui nec posuere finibus, nisl sem aliquam metus, eu
                                accumsan
                                lacus felis at odio. Sed lacus
                                quam, convallis quis condimentum ut, accumsan congue massa. Pellentesque et
                                quam vel
                                massa pretium ullamcorper vitae eu
                                tortor.
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-secondary text-light text-center">
                                            <th>DATETIME</th>
                                            <th>DOCTOR</th>
                                            <th>CITY</th>
                                            <th>AREA</th>
                                            <th>CHEMIST</th>
                                            <th>SPECI.</th>
                                            <th>PICTURE</th>
                                        </thead>
                                        <tbody id="history-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- END MAIN -->


<?php require_once("common2/footer.php") ?>

<!-- Modal -->
<div class="modal fade" id="cameraModal" tabindex="-1" role="dialog" aria-labelledby="cameraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cameraModalLabel">Camera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <video id="cameraView" width="100%" autoplay playsinline></video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="captureBtn">Capture</button>
            </div>
        </div>
    </div>
</div>

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

<script>
    // $(".callbtn").on("click", function(e) {
    //     // Store the value of data-planid in a variable
    //     var planId = $(this).data("planid");

    //     // Define the formdata object with default values
    //     var formdata = {
    //         plan_id: planId,
    //         latitude: 0,
    //         longitude: 0
    //     };

    //     // Get the current location
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //         // Update latitude and longitude with current position
    //         formdata.latitude = position.coords.latitude;
    //         formdata.longitude = position.coords.longitude;

    //         // Open camera modal
    //         $('#cameraModal').modal('show');

    //         // Get camera stream and display in modal
    //         navigator.mediaDevices.getUserMedia({
    //                 video: true
    //             })
    //             .then(function(stream) {
    //                 var video = document.getElementById('cameraView');
    //                 video.srcObject = stream;
    //                 video.play();
    //             })
    //             .catch(function(err) {
    //                 console.log("An error occurred: " + err);
    //             });

    //         // Handle capture button click
    //         $('#captureBtn').on('click', function() {
    //             var video = document.getElementById('cameraView');
    //             var canvas = document.createElement('canvas');
    //             var context = canvas.getContext('2d');

    //             canvas.width = video.videoWidth;
    //             canvas.height = video.videoHeight;
    //             context.drawImage(video, 0, 0, canvas.width, canvas.height);
    //             var imageData = canvas.toDataURL('image/jpeg');

    //             // Close camera stream
    //             video.srcObject.getTracks().forEach(function(track) {
    //                 track.stop();
    //             });

    //             // Close camera modal
    //             $('#cameraModal').modal('hide');

    //             // Append image data to formdata
    //             formdata.imageData = imageData;

    //             // Send AJAX request
    //             $.ajax({
    //                 url: "<?php echo base_url() . "app-call-submit"; ?>",
    //                 type: "post",
    //                 data: formdata,
    //                 beforeSend: function() {
    //                     // Disable submit button and show spinner
    //                     $(".callbtn").prop("disabled", true);
    //                     $("#spinner").removeClass("d-none");
    //                     $("#error").addClass("d-none");
    //                 },
    //                 success: function(res) {
    //                     // Handle success response
    //                 },
    //                 error: function(error) {
    //                     // Handle error response
    //                 },
    //                 complete: function() {
    //                     // Enable submit button and hide spinner
    //                     $(".callbtn").prop("disabled", false);
    //                     $("#spinner").addClass("d-none");
    //                 }
    //             });
    //         });
    //     });
    // });

    let formdata

    // Event listener for call button click
    $(".callbtn").on("click", function(e) {
        // Store the value of data-planid in a variable
        var planId = $(this).data("planid");
        var locationid = $(this).data("locationid");

        // Define the formdata object with default values
        formdata = {
            plan_id: planId,
            location_id: locationid,
            latitude: 0,
            longitude: 0
        };

        // Get the current location
        navigator.geolocation.getCurrentPosition(function(position) {
            // Update latitude and longitude with current position
            formdata.latitude = position.coords.latitude;
            formdata.longitude = position.coords.longitude;

            // Open camera modal
            $('#cameraModal').modal('show');

            // Get camera stream and display in modal
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    var video = document.getElementById('cameraView');
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                });
        });
    });

    // Event listener for capture button click
    $('#captureBtn').on('click', function() {
        var video = document.getElementById('cameraView');
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        var imageData = canvas.toDataURL('image/jpeg');

        // Close camera stream
        video.srcObject.getTracks().forEach(function(track) {
            track.stop();
        });

        // Close camera modal
        $('#cameraModal').modal('hide');

        // Append image data to formdata
        formdata.imageData = imageData;

        // Send AJAX request
        $.ajax({
            url: "<?php echo base_url() . "app-call-submit"; ?>",
            type: "post",
            data: formdata,
            beforeSend: function() {
                // Disable submit button and show spinner
                $(".callbtn").prop("disabled", true);
                $("#spinner").removeClass("d-none");
                $("#error").addClass("d-none");
            },
            success: function(res) {
                let obj = JSON.parse(res);
                if (obj.error) {
                    $("#error").html(obj.error);
                    $("#error").removeClass("d-none");
                    $("#spinner").addClass("d-none");
                    toastr.error("Please check errors list!", "Error");
                    $(window).scrollTop(0);
                } else if (obj.success) {
                    $("#spinner").addClass("d-none");
                    toastr.success("Success!", "Call Successfully Added!");
                } else {
                    $("#spinner").addClass("d-none");
                    $(".callbtn").prop("disabled", false);
                    toastr.error("Something bad happened!", "Error");
                    $(window).scrollTop(0);
                }

                $(".callbtn").prop("disabled", false);
            },
            error: function(error) {
                toastr.error("Error while sending request to server!", "Error");
                $(window).scrollTop(0);
                $("#spinner").addClass("d-none");
                $(".callbtn").prop("disabled", false);
            }
        });
    });
</script>

<script>
    // Function to format date
    function formatDate(dateString) {
        var date = new Date(dateString);
        return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
    }

    // Function to capitalize the first letter of a string
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    
    $("#historytab").on("click", function() {
        $.ajax({
            url: "<?php echo base_url() . "app-get-my-history"; ?>",
            beforeSend: function() {
					$("#spinner").removeClass("d-none");
            },
            success: function(res) {
                $("#spinner").addClass("d-none");
                let obj = JSON.parse(res);
                let html = ""

                obj.map(row => {
                    html += "<tr>"
                    html += "<td>" + formatDate(row.created_at) + "</td>"
                    html += "<td>"+ capitalizeFirstLetter(row.doctor_name) + "</td>"
                    html += "<td>" + capitalizeFirstLetter(row.city_name) +"</td>"
                    html += "<td>" + capitalizeFirstLetter(row.area) +"</td>"

                    html += "<td>"
                    const parsedChemists = JSON.parse(row.chemists);
                    parsedChemists.map(chemist => {
                        html += capitalizeFirstLetter(chemist) + '<br>';
                    })
                    html += "</td>"

                    html += "<td>"
                    const parsedSpecialities  = JSON.parse(row.specialities);
                    parsedSpecialities.map(special => {
                        html += capitalizeFirstLetter(special) + '<br>';
                    })
                    html += "</td>"

                    html += '<td class="text-center"><img src="' + row.evidance_picture + '" width="100px" alt=""></td>';

                    html += "</tr>"
                })

                $("#history-body").html(html)

            },
            error: function(error) {
                $("#spinner").addClass("d-none");
                toastr.error("Error while sending request to server!", "Error");
            }
        })
    })
</script>

</body>

</html>