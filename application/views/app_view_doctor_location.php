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
                        <hr>
                        <h3><?= ucwords($plan[0]['doctor_name']) . "'s" ?> Location</h3>
                        <div id="map"></div>
                        <hr>
                        <h3>Your Location</h3>
                        <div id="map1"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- END MAIN -->


<?php require_once("common2/footer.php") ?>



<script>
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
</script>
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




    var map2 = L.map('map1');
    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        map2.setView([latitude, longitude], 18); // Set map center to user's current location

        // Add OpenStreetMap tiles as the base layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map2);

        // Add a marker to the map at the user's current location
        var marker = L.marker([latitude, longitude]).addTo(map2);
        marker.bindPopup("Your Location").openPopup();
    });
</script>

</body>

</html>