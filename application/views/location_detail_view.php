<?php
$pagetab = "dashboard";
$pagename = "dashboard";

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
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Doctor`s Details</h6>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><?= $data['doctor_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td><?= $data['area'] ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?= $data['city_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Patients per day</td>
                                <td><?= $data['patients_per_day'] ?></td>
                            </tr>
                            <tr>
                                <td>Timings</td>
                                <td>
                                    <?php
                                        $parsed_timings = json_decode($data['timings'], true);
                                        foreach ($parsed_timings as $var) {
                                            echo $var["dayname"] . " - " . $var["from"] . " - " . $var["to"] . "<br>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Products</td>
                                <td><?= $data['product_names'] ?></td>
                            </tr>
                            
                            
                            <tr>
                                <td>Chemists</td>
                                <td>
                                    <?php
                                        $parsed_chemist = json_decode($data['chemists']);
                                        foreach ($parsed_chemist as $var) {
                                            echo ucwords($var) . "<br>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Specialities</td>
                                <td>
                                    <?php
                                        $parsed_specs = json_decode($data['specialities']);
                                        foreach ($parsed_specs as $var) {
                                            echo ucwords($var) . "<br>";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td><a href="https://www.google.com/maps?q=<?= $data['latitude'] ?>,<?= $data['longitude'] ?>" target="_blank"><i class="bi bi-geo-alt-fill"></i></a></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?= ($data['status'])? "Active" : "In-Active" ?></td>
                            </tr>
                        </tbody>
                    </table>
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