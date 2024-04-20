<?php require_once("common2/header.php") ?>
<!-- MAIN -->
<div class="container">
    <div>
        <button id="bckbtn" class="btn btn-dark">GO BACK</button>
    </div>
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
                        <h3><?= ucwords($plan[0]['doctor_name']) . "'s" ?> Location</h3>
                        <div id="map"></div>
                        <button id="resetBtn" class="btn btn-primary mt-3 btn-block">RE POSITION</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- END MAIN -->


<?php require_once("common2/footer.php") ?>




<style>
    /* Style the map container */
    #map {
        height: 400px;
        width: 100%;
    }

    /* Style the map container */
    #map1 {
        height: 400px;
        width: 100%;
    }
</style>
<script>
    document.getElementById("bckbtn").addEventListener("click", function() {
        window.history.back();
    });
    // Initialize the map
    var map = L.map('map').setView([<?= $plan[0]['latitude'] ?>, <?= $plan[0]['longitude'] ?>], 18); // Centered at [0,0], zoom level 5

    // Add OpenStreetMap tiles as the base layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add a marker to the map
    var marker = L.marker([<?= $plan[0]['latitude'] ?>, <?= $plan[0]['longitude'] ?>]).addTo(map); // Replace YOUR_LATITUDE and YOUR_LONGITUDE with the desired coordinates

    // You can also add a popup to the marker
    marker.bindPopup("<?= $plan[0]['doctor_name'] ?>").openPopup();

    // Create a circle with a 1-meter radius around the marker1
    var circle = L.circle([<?= $plan[0]['latitude'] ?>, <?= $plan[0]['longitude'] ?>], {
        color: 'red',
        fillColor: '#00ff00',
        fillOpacity: 0.5,
        radius: 100
    }).addTo(map);


    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        // Add a marker to the map at the user's current location
        var marker1 = L.marker([latitude, longitude]).addTo(map);
        marker1.bindPopup("Your Location").openPopup();
        // Create a LatLngBounds object including both markers
        var bounds = L.latLngBounds([marker.getLatLng(), marker1.getLatLng()]);
        // Fit the map to the bounds
        map.fitBounds(bounds);

        $("#resetBtn").on("click", () => {
            map.fitBounds(bounds);
        })
    });
</script>

</body>

</html>