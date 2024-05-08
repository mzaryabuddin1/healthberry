<?php

$pagetab = "report";
$pagename = "report_doctors";

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
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Doctors</h6>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form id="regstr">
                        <div class="row">
                            <!-- <div class="col-md-6 form-group">
                                <label>Field User</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="everyone">All</option>
                                 
                                </select>
                            </div> -->
                            <div class="col-md-3 form-group">
                                <label>City</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="">All</option>
                                    <?php foreach ($cities as $value) : ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['city_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Load</button>
                        </div>
                    </form>
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

    });
</script>

<script>
    $("#regstr").on("submit", function(e) {
        e.preventDefault()
        const formdata = {
            city: $("#city").val()
        }
        if (marker) {
                    map.removeLayer(marker);
                }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>report-get-doctors",
            data: formdata,
            dataType: "json",
            beforeSend: function() {
                $('#formSubmit button[type="submit"]').prop('disabled', true);
            },
            success: function(response) {
                $('#formSubmit button[type="submit"]').prop('disabled', false);
                console.log(response)
              

                var markerPositions = [];
                response.forEach(function(doctor) {
                    var doctorMarker = L.marker([doctor.latitude, doctor.longitude])
                        .addTo(map)
                        .bindTooltip(doctor.doctor_name)
                        .openTooltip();
                    markerPositions.push([doctor.latitude, doctor.longitude]);
                });

                var bounds = L.latLngBounds(markerPositions);
                map.fitBounds(bounds);  



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
            $("#latitude").val(latitude);
            $("#longitude").val(longitude);
        });
    });
</script>