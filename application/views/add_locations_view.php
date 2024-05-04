<?php

$pagetab = "locations";
$pagename = "manage_locations";

?>

<?php require_once('common/header.php') ?>
<?php require_once('common/navbar.php') ?>
<?php require_once('common/sidebar.php') ?>



<style>
    .badge {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        border-radius: 4px;
        background-color: #007d88;
        /* Blue color */
        color: #fff;
    }
</style>
<div class="text-end">
    <div id="clock"></div>
</div>
<!-- Main Content -->
<div class="hk-pg-wrapper pb-0">
    <div class="container-fluid">
        <!-- Form -->
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-start">
                <div class="col-6">
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Locations</h6>

                </div>
                <div class="col-6" style="text-align: right;">
                    <a href="<?php echo base_url() ?>add-location" class="btn btn-primary">Add</a>

                </div>

            </div>

            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" id="formSubmit">
                        <div class="form-body">
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <label>Doctor Name</label>
                                    <input type="text" class="form-control" name="doctor_name" placeholder="Doctor Name">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Products</label>
                                    <select name="products[]" id="products" class="form-control" required multiple>
                                        <option value="">Select Products</option>
                                        <?php foreach ($products as $value) : ?>
                                            <option value="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Area</label>
                                    <input type="text" class="form-control" name="area" placeholder="Area" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <select name="city" id="city" class="form-control" required>
                                        <option value="" disabled>Selecte City</option>
                                        <?php foreach ($cities as $value) : ?>
                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['city_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Chemists</label>
                                    <input type="text" class="form-control" id="chemists" name="chemists" placeholder="Chemists" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Specialities</label>
                                    <input type="text" class="form-control" id="specialities" name="specialities" placeholder="specialities" required>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="password-id-icon">Timings</label>
                                            <button type="button" class="btn btn-sm btn-outline-secondary m-4" id="add-timings">Add More</button>
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
                                <!-- <div class="col-md-6 form-group">
                                    <label>End time</label>

                                    <input type="text" class="form-control" id="endTime" name="endTime" placeholder="End time" required>
                                </div> -->
                                <div class="col-md-6 form-group">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="latitude" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Logitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="longitude" required>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- After your form -->
                    <div id="map" style="height: 400px; margin-top: 20px;"></div>
                    <button id="resetMarkerBtn" type="button" class="btn btn-block btn-primary">RESET CURRENT LOCATION</button>

                </div>
            </div>
        </div>
        <!-- /Form -->
    </div>



</div>
<!-- /Main Content -->

<?php require_once('common/footer.php') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    $("#products").select2({
        multiple: true
    })
    $('#chemists').on('keyup', function() {
        var chemistsValues = $(this).val().split(','); // Split input values by comma
        var chemistscombinedInput = ''; // Combined input values

        // Loop through each value and create badge
        for (var i = 0; i < chemistsValues.length; i++) {
            // If value is not empty
            if (chemistsValues[i].trim() !== '') {
                chemistscombinedInput += '<span class="mt-2 badge">' + chemistsValues[i].trim() + '</span>';
            }
        }

        // Update input field with combined badges
        $('#chemists').nextAll('.badge').remove(); // Remove existing badges
        $('#chemists').after(chemistscombinedInput); // Add new badges
    });

    $('#specialities').on('keyup', function() {
        var specialitiesValues = $(this).val().split(','); // Split input values by comma
        var specialitiescombinedInput = ''; // Combined input values

        // Loop through each value and create badge
        for (var i = 0; i < specialitiesValues.length; i++) {
            // If value is not empty
            if (specialitiesValues[i].trim() !== '') {
                specialitiescombinedInput += '<span class="mt-2 badge">' + specialitiesValues[i].trim() + '</span>';
            }
        }

        // Update input field with combined badges
        $('#specialities').nextAll('.badge').remove(); // Remove existing badges
        $('#specialities').after(specialitiescombinedInput); // Add new badges
    });


    $('form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        $('#formSubmit button[type="submit"]').prop('disabled', true);

        var selectedValues = [];
        $('select[name="days[]"] option:selected').each(function() {
            selectedValues.push($(this).val());
        });

        var selectedValuestimings_from = [];
        $('input[name="timings_from[]"]').each(function() {
            selectedValuestimings_from.push($(this).val());
        });
        var selectedValuestimings_to = [];
        $('input[name="timings_to[]"]').each(function() {
            selectedValuestimings_to.push($(this).val());
        });


        // Get form data
        var formData = {
            doctor_name: $('input[name=doctor_name]').val(),
            products: $('select[name="products[]"]').val(),
            city: $('select[name="city"]').val(),
            area: $('input[name=area]').val(),
            chemists: $('input[name=chemists]').val().split(',').map(item => item.trim()),
            specialities: $('input[name=specialities]').val().split(',').map(item => item.trim()),
            // timings: [{
            //     from: $('#startTime').val(),
            //     to: $('#endTime').val()
            // }],
            days: selectedValues,
            timings_from: selectedValuestimings_from,
            timings_to: selectedValuestimings_to,

            latitude: $('input[name=latitude]').val(),
            longitude: $('input[name=longitude]').val()
        };

        // Convert chemists and specialities to JSON string
        formData.chemists = JSON.stringify(formData.chemists);
        formData.specialities = JSON.stringify(formData.specialities);

        // Convert timings to JSON string
        formData.timings = JSON.stringify(formData.timings);

        // Send data via AJAX
        $.ajax({
            url: '<?php echo base_url() ?>location-submit',
            type: 'POST',
            data: formData,
            beforeSend: function() {
                $('#formSubmit button[type="submit"]').prop('disabled', true);
            },
            success: function(response) {
                $('#formSubmit button[type="submit"]').prop('disabled', false);
                if (response.status == '1') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500 // Automatically close the alert after 1.5 seconds
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        html: response.message,
                        icon: 'error',
                        showConfirmButton: false,
                    });
                }

            },
            error: function(xhr, status, error) {
                $('#formSubmit button[type="submit"]').prop('disabled', false);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    var map;
    var marker;
    $(".latlng").on("wheel", function(e) {
        e.preventDefault();
    });
    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        $("#latitude").val(latitude)
        $("#longitude").val(longitude)

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
            marker.setLatLng(newLatLng); // Update marker position
            map.panTo(newLatLng); // Move map to the clicked position
            $("#latitude").val(newLatLng.lat);
            $("#longitude").val(newLatLng.lng);
        });
    });
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
            $("#latitude").val(latitude);
            $("#longitude").val(longitude);
        });
    });


    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var day = now.toLocaleString('en-US', {
            weekday: 'long'
        });
        var date = now.toLocaleDateString('en-US');

        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;

        var timeString = hours + ":" + minutes + ":" + seconds;
        var dateTimeString = day + ", " + date + " " + timeString;

        document.getElementById("clock").innerText = dateTimeString;
    }


    // Update the clock every second
    setInterval(updateClock, 1000);

    // Initial call to display the clock immediately
    updateClock();
    $("#add-timings").on("click", function() {
        const html = '<div class="row mt-2"><div class="col-4"><select name="days[]" class="form-control" required><option value="Monday">Mon</option><option value="Tuesday">Tue</option><option value="Wednesday">Wed</option><option value="Thursday">Thu</option><option value="Friday">Fri</option><option value="Saturday">Sat</option><option value="Sunday">Sun</option></select></div><div class="col-4"><div class="input-group"><input type="time" style="padding-left: 5px !important;" class="form-control"  name="timings_from[]" aria-label="Recipient username" aria-describedby="button-addon2" required></div></div><div class="col-4"><div class="input-group"><input type="time" style="padding-left: 5px !important;" class="form-control"  name="timings_to[]" aria-label="Recipient username" aria-describedby="button-addon2" required><button class="btn btn-danger removetimings" type="button">-</button></div></div></div>'

        $("#timings-more-input").append(html)
        $(".removetimings").bind("click", function() {
            $(this).parent().parent().parent().remove()
        })
    })
</script>