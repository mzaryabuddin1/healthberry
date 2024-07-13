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
                            <li class="nav-item" role="presentation" id="locationtab">
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
                                                    <td><?= ucfirst($row['city_name']) ?></td>
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
                                <div class="row">
                                    <div class="col-12">
                                        <form >
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <form class="form form-vertical" id="regstr">
                                                            <div class="form-body">
                                                                <div class="row">

                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="first-name-icon">Doctor Name</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control" name="doctor_name" minlength="3" placeholder="Doctor name" required>
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-person"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="email-id-icon">Products</label>
                                                                            <div class="position-relative">
                                                                                <select class="choices form-select multiple-remove" name="products[]" multiple="multiple" required>
                                                                                    <?php foreach ($products as $row) : ?>
                                                                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>

                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="mobile-id-icon">Area</label>
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control" placeholder="Area" name="area" required>
                                                                                <div class="form-control-icon">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
                                                                                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8z" />
                                                                                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="password-id-icon">City</label>
                                                                            <div class="position-relative">
                                                                                <select class="choices form-select" name="city" required>
                                                                                    <?php foreach ($cities as $row) : ?>
                                                                                        <option value="<?= $row['id'] ?>"><?= $row['city_name'] ?></option>

                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="d-flex justify-content-between">
                                                                                <label for="password-id-icon">Chemists</label>
                                                                                <button type="button" class="btn btn-sm btn-outline-secondary" id="add-chemist">Add More</button>
                                                                            </div>
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control" placeholder="Chemist" name="chemists[]">
                                                                                <div class="form-control-icon">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                                                                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div id="chemists-more-inputs">
                                                                                <!-- <div class="input-group mt-2">
                                                                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-bookmark"></i></span>
                                                                                    <input type="text" style="padding-left: 5px !important;" class="form-control" placeholder="Chemist" name="chemists[]" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                                                    <button class="btn btn-danger" type="button">-</button>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <div class="d-flex justify-content-between">
                                                                                <label for="password-id-icon">Specialities</label>
                                                                                <button type="button" class="btn btn-sm btn-outline-secondary" id="add-specialities">Add More</button>
                                                                            </div>
                                                                            <div class="position-relative">
                                                                                <input type="text" class="form-control" placeholder="Specialities" name="specialities[]">
                                                                                <div class="form-control-icon">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-raised-hand" viewBox="0 0 16 16">
                                                                                        <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207" />
                                                                                        <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <div id="specialities-more-input">
                                                                                <!-- <div class="input-group mt-2">
                                                                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-bookmark"></i></span>
                                                                                    <input type="text" style="padding-left: 5px !important;" class="form-control" placeholder="Specialities" name="specialities[]" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                                                    <button class="btn btn-danger" type="button">-</button>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group">
                                                                            <div class="d-flex justify-content-between">
                                                                                <label for="password-id-icon">Timings</label>
                                                                                <button type="button" class="btn btn-sm btn-outline-secondary" id="add-timings">Add More</button>
                                                                            </div>
                                                                            <div class="position-relative">
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <select name="days[]" class="form-control" required>
                                                                                            <option value="Monday">Mon</option>
                                                                                            <option value="Tuesday">Tue</option>
                                                                                            <option value="Wednesday">Wed</option>
                                                                                            <option value="Thursday">Thu</option>
                                                                                            <option value="Friday">Fri</option>
                                                                                            <option value="Saturday">Sat</option>
                                                                                            <option value="Sunday">Sun</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <input type="time" class="form-control" placeholder="T" name="timings_from[]">
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <input type="time" class="form-control" placeholder="T" name="timings_to[]">
                                                                                    </div>
                                                                                </div>
                                                                                <div id="timings-more-input">
                                                                                    <!-- <div class="row mt-2">
                                                                                        <div class="col-4">
                                                                                            <select name="days[]" class="form-control" required>
                                                                                                <option value="Monday">Mon</option>
                                                                                                <option value="Tuesday">Tue</option>
                                                                                                <option value="Wednesday">Wed</option>
                                                                                                <option value="Thursday">Thu</option>
                                                                                                <option value="Friday">Fri</option>
                                                                                                <option value="Saturday">Sat</option>
                                                                                                <option value="Sunday">Sun</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <div class="input-group">
                                                                                                <input type="time" style="padding-left: 5px !important;" class="form-control" placeholder="Specialities" name="timings[]" aria-label="Recipient username" aria-describedby="button-addon2" required>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <div class="input-group">
                                                                                              
                                                                                                <input type="time" style="padding-left: 5px !important;" class="form-control" placeholder="Specialities" name="timings[]" aria-label="Recipient username" aria-describedby="button-addon2" required>
                                                                                                <button class="btn btn-danger" type="button">-</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div> -->
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="password-id-icon">Patients Per Day</label>
                                                                            <div class="position-relative">
                                                                                <input type="number" id="patients_per_day" min="0" max="1000000000" class="form-control" placeholder="Patients Per Day" name="patients_per_day" required>
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-people"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12 d-none">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="password-id-icon">Latitude</label>
                                                                            <div class="position-relative">
                                                                                <input type="number" step="0.000000000000001" id="lat" min="-90" max="90" class="form-control latlng" placeholder="Latitude" name="latitude" required>
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-geo-alt"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-12 d-none">
                                                                        <div class="form-group has-icon-left">
                                                                            <label for="password-id-icon">Longitude</label>
                                                                            <div class="position-relative">
                                                                                <input type="number" step="0.000000000000001" min="-180" max="180" class="form-control latlng" placeholder="Longitude" id="lng" name="longitude" required>
                                                                                <div class="form-control-icon">
                                                                                    <i class="bi bi-geo-alt"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div id="map"></div>
                                                                        <button id="resetMarkerBtn" type="button" class="btn btn-block btn-primary">RESET CURRENT LOCATION</button>
                                                                    </div>
                                                                    <div class="col-12 mt-3 d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-outline-success me-1 mb-1">Save</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bg-secondary text-light text-center">
                                                                <th>DOCTOR</th>
                                                                <th class="d-none">APPROVAL</th>
                                                                <th>CITY</th>
                                                                <th>AREA</th>
                                                                <th>CHEMIST</th>
                                                                <th>SPECI.</th>
                                                                <th>TIMINGS</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($locations as $row) : ?>
                                                                    <tr>
                                                                        <td><?= ucfirst($row['doctor_name']) ?></td>
                                                                        <td><?= ucfirst($row['city_name']) ?></td>
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
                                                                        <td>
                                                                            <?php
                                                                            $parsed_timings = json_decode($row['timings'], true);
                                                                            foreach ($parsed_timings as $var) {
                                                                                echo $var["dayname"] . " - " . $var["from"] . " - " . $var["to"] . "<br>";
                                                                            }
                                                                            ?>
                                                                        </td>

                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <video id="cameraView" width="100%" autoplay playsinline></video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary" id="captureBtn">Capture</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#regstr").on("submit", function(e) {
            e.preventDefault();
            // var formdata = new FormData(this);
            var formdata = $(this).serialize();

            $.ajax({
                url: "<?php echo base_url() . "app-new-location-submit"; ?>",
                type: "post",
                data: formdata,
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
                        $(":submit").removeClass("d-none");
                        toastr.success("Success!", "Location added for approval!");
                        setTimeout(function() {
                            window.location = '<?php echo base_url() . 'app-dashboard'; ?>';
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
    $(document).ready(function() {
        let formdata;

        // Function to stop the camera stream
        function stopCameraStream() {
            var video = document.getElementById('cameraView');
            if (video.srcObject) {
                var stream = video.srcObject;
                var tracks = stream.getTracks();

                tracks.forEach(function(track) {
                    track.stop();
                });

                video.srcObject = null;
            }
        }

        // Event listener for call button click
        $(".callbtn").on("click", function(e) {
            // Store the value of data-planid and data-locationid in variables
            var planId = $(this).data("planid");
            var locationId = $(this).data("locationid");

            // Define the formdata object with default values
            formdata = new FormData();
            formdata.append('plan_id', planId);
            formdata.append('location_id', locationId);
            formdata.append('latitude', 0);
            formdata.append('longitude', 0);

            // Get the current location
            navigator.geolocation.getCurrentPosition(function(position) {
                // Update latitude and longitude with current position
                formdata.set('latitude', position.coords.latitude);
                formdata.set('longitude', position.coords.longitude);

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
                        if (err.name === 'NotAllowedError') {
                            alert("You have denied permission to access the camera. Please grant permission to proceed.");
                        } else {
                            console.log("An error occurred: " + err);
                        }
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

            // Revert mirroring before capturing the image
            context.save();
            context.scale(-1, 1);
            context.drawImage(video, -canvas.width, 0, canvas.width, canvas.height);
            context.restore();

            canvas.toBlob(function(blob) {
                // Append image data to formdata
                formdata.append('imageData', blob, 'photo.jpg');

                // Close camera stream
                stopCameraStream();

                // Close camera modal
                $('#cameraModal').modal('hide');

                // Send AJAX request
                $.ajax({
                    url: "<?php echo base_url() . 'app-call-submit'; ?>",
                    type: "post",
                    data: formdata,
                    processData: false,
                    contentType: false,
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
            }, 'image/jpeg');
        });

        // Listen for modal close event
        $('#cameraModal').on('hidden.bs.modal', function() {
            // Call the function to stop the camera stream
            stopCameraStream();
        });
    });
</script>

<script>
    // Function to format date
    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = ("0" + date.getDate()).slice(-2);
        var month = ("0" + (date.getMonth() + 1)).slice(-2);
        var year = date.getFullYear();
        var hours = ("0" + date.getHours()).slice(-2);
        var minutes = ("0" + date.getMinutes()).slice(-2);
        var seconds = ("0" + date.getSeconds()).slice(-2);

        return day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;
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
                    html += "<td>" + capitalizeFirstLetter(row.doctor_name) + "</td>"
                    html += "<td>" + capitalizeFirstLetter(row.city_name) + "</td>"
                    html += "<td>" + capitalizeFirstLetter(row.area) + "</td>"

                    html += "<td>"
                    const parsedChemists = JSON.parse(row.chemists);
                    parsedChemists.map(chemist => {
                        html += capitalizeFirstLetter(chemist) + '<br>';
                    })
                    html += "</td>"

                    html += "<td>"
                    const parsedSpecialities = JSON.parse(row.specialities);
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var inputElement = document.getElementById("inputArray");

        inputElement.addEventListener("input", function() {
            var value = this.value.trim();
            if (value.includes(",")) {
                var valuesArray = value.split(",").map(function(item) {
                    return item.trim();
                });
                this.value = "[" + valuesArray.map(function(item) {
                    return '"' + item + '"';
                }).join(", ") + "]";
            }
        });
    });
</script>

<script>
    $("#add-chemist").on("click", function() {
        const html = '<div class="input-group mt-2"><span class="input-group-text" id="basic-addon1"><i class="bi bi-bookmark"></i></span><input type="text" style="padding-left: 5px !important;" class="form-control" placeholder="Chemist" name="chemists[]" aria-label="" aria-describedby="button-addon2"><button class="btn btn-danger removechemist" type="button">-</button></div>'
        $("#chemists-more-inputs").append(html)
        $(".removechemist").bind("click", function() {
            $(this).parent().remove()
        })
    })
    $("#add-specialities").on("click", function() {
        const html = '<div class="input-group mt-2"><span class="input-group-text" id="basic-addon1"><i class="bi bi-bookmark"></i></span><input type="text" style="padding-left: 5px !important;" class="form-control" placeholder="Specialities" name="specialities[]" aria-label="" aria-describedby="button-addon2"><button class="btn btn-danger removespecial" type="button">-</button></div>'
        $("#specialities-more-input").append(html)
        $(".removespecial").bind("click", function() {
            $(this).parent().remove()
        })
    })
    $("#add-timings").on("click", function() {
        const html = '<div class="row mt-2"><div class="col-4"><select name="days[]" class="form-control" required><option value="Monday">Mon</option><option value="Tuesday">Tue</option><option value="Wednesday">Wed</option><option value="Thursday">Thu</option><option value="Friday">Fri</option><option value="Saturday">Sat</option><option value="Sunday">Sun</option></select></div><div class="col-4"><div class="input-group"><input type="time" style="padding-left: 5px !important;" class="form-control"  name="timings_from[]" aria-label="Recipient username" aria-describedby="button-addon2" required></div></div><div class="col-4"><div class="input-group"><input type="time" style="padding-left: 5px !important;" class="form-control"  name="timings_to[]" aria-label="Recipient username" aria-describedby="button-addon2" required><button class="btn btn-danger removetimings" type="button">-</button></div></div></div>'

        $("#timings-more-input").append(html)
        $(".removetimings").bind("click", function() {
            $(this).parent().parent().parent().remove()
        })
    })
</script>


<style>
    /* Style the map container */
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<script>
    var map;
    var marker;
    $(".latlng").on("wheel", function(e) {
        // e.preventDefault();
    });
    $("#locationtab").on("click", function() {
        setTimeout(function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                $("#lat").val(latitude)
                $("#lng").val(longitude)

                // Initialize the map
                map = L.map('map').setView([latitude, longitude], 18); // Centered at [0,0], zoom level 5
                // Add OpenStreetMap tiles as the base layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Add a marker to the map at the user's current location
                marker = L.marker([latitude, longitude]).addTo(map);

                // Event listener for map click
                map.on('click', function(e) {
                    var newLatLng = e.latlng;
                    // marker.setLatLng(newLatLng); // Update marker position
                    // map.panTo(newLatLng); // Move map to the clicked position
                    // $("#lat").val(newLatLng.lat);
                    // $("#lng").val(newLatLng.lng);
                });
            });
        }, 1500); // 100 milliseconds delay
    })
</script>

<script>
    $("#resetMarkerBtn").on("click", function() {
        // Get current geolocation
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Update marker position, map center, and input fields
            marker.setLatLng([latitude, longitude]);
            map.setView([latitude, longitude]);
            $("#lat").val(latitude);
            $("#lng").val(longitude);
        });
    });
</script>


</body>

</html>