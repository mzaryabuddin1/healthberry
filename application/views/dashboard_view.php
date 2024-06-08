<?php
$pagetab = "dashboard";
$pagename = "dashboard";
?>


<?php require_once('common/header.php') ?>
<?php require_once('common/navbar.php') ?>
<?php require_once('common/sidebar.php') ?>


<!-- Main Content -->
<div class="hk-pg-wrapper">
    <div class="container-xxl">
        <!-- Page Header -->
        <div class="hk-pg-header pg-header-wth-tab pt-7">
            <div class="d-flex">
                <div class="d-flex flex-wrap justify-content-between flex-1">
                    <div class="mb-lg-0 mb-2 me-8">
                        <h1 class="pg-title">Dashboard</h1>
                        <p>Summerize reports of application.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Page Body -->
        <div class="hk-pg-body">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-3 col-sm-6 mb-xxl-0 mb-3">
                            <span class="d-block fw-medium fs-7">Doctors</span>
                            <div class="d-flex align-items-center">
                                <span class="d-block fs-4 fw-medium text-dark mb-0"><?= sizeof($doctors) ?></span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6 mb-xxl-0 mb-3">
                            <span class="d-block fw-medium fs-7">Products</span>
                            <div class="d-flex align-items-center">
                                <span class="d-block fs-4 fw-medium text-dark mb-0"><?= sizeof($products) ?></span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6 mb-xxl-0 mb-3">
                            <span class="d-block fw-medium fs-7">Feild Users</span>
                            <div class="d-flex align-items-center">
                                <span class="d-block fs-4 fw-medium text-dark mb-0"><?= sizeof($feild_users) ?></span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <span class="d-block fw-medium fs-7">Admin Users</span>
                            <div class="d-flex align-items-center">
                                <span class="d-block fs-4 fw-medium text-dark mb-0"><?= sizeof($admin_users) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Leader Board (Top 10 Feild Users)
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div id="leaderchart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Doctors Analysis
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-6 col-sm-12 mb-xxl-0">
                            <div id="city_wise_doctor_chart"></div>
                        </div>
                        <div class="col-xxl-6 col-sm-12 mb-xxl-0">
                            <div id="call_wise_doctor_chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    100 Random Doctors
                </div>
                <div class="card-body">
                    <div class="row">
                        <div id="map" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Body -->
    </div>


</div>
<!-- /Main Content -->

<?php require_once('common/footer.php') ?>
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

    const arr = <?= json_encode($locations) ?>;

    // Initialize the map without centering it
    map = L.map('map');

    // Add OpenStreetMap tiles as the base layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Create a LatLngBounds object to store the bounds of all markers
    var bounds = L.latLngBounds();

    // Add markers for each location in the array and extend the bounds
    arr.forEach(function(item) {
        var lat = parseFloat(item.latitude);
        var lng = parseFloat(item.longitude);
        var marker = L.marker([lat, lng]).addTo(map);

        // Optional: Add a popup with the doctor's name
        marker.bindPopup(item.doctor_name).openPopup();

        // Extend the bounds to include this marker's location
        bounds.extend([lat, lng]);
    });

    // Adjust the map view to fit the bounds of all markers
    map.fitBounds(bounds);
</script>

<script>
    var options = {
        series: [{
            name: 'Calls',
            data: <?= json_encode(array_column($leader, 'call_count')) ?>
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 0
        },
        grid: {
            row: {
                colors: ['#fff', '#f2f2f2']
            }
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: <?= json_encode(array_column($leader, 'username')) ?>,
            tickPlacement: 'on'
        },
        yaxis: {
            title: {
                text: 'Calls Count',
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#leaderchart"), options);
    chart.render();
</script>

<script>
    var options = {
        series: [{
            name: 'Doctors',
            data: <?= json_encode(array_column($city_wise, 'loc_count')) ?>
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 0
        },
        grid: {
            row: {
                colors: ['#fff', '#f2f2f2']
            }
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: <?= json_encode(array_column($city_wise, 'city_name')) ?>,
            tickPlacement: 'on'
        },
        yaxis: {
            title: {
                text: 'Doctors Count (Top 10 Cities)',
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };


    var chart = new ApexCharts(document.querySelector("#city_wise_doctor_chart"), options);
    chart.render();
</script>

<script>
    var options = {
        series: [{
            name: 'Calls',
            data: <?= json_encode(array_column($calls_of_doctors, 'call_count')) ?>
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                columnWidth: '50%',
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 0
        },
        grid: {
            row: {
                colors: ['#fff', '#f2f2f2']
            }
        },
        xaxis: {
            labels: {
                rotate: -45
            },
            categories: <?= json_encode(array_column($calls_of_doctors, 'doctor_name')) ?>,
            tickPlacement: 'on'
        },
        yaxis: {
            title: {
                text: 'Call Count (Top 10 Doctors)',
            },
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "horizontal",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100]
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#call_wise_doctor_chart"), options);
    chart.render();
</script>