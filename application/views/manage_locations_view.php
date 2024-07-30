<?php

$pagetab = "locations";
$pagename = "manage_locations";

// print_r($data);exit;

?>

<?php require_once('common/header.php') ?>
<?php require_once('common/navbar.php') ?>
<?php require_once('common/sidebar.php') ?>




<!-- Main Content -->
<div class="hk-pg-wrapper pb-0">
    <div class="container-fluid">
        <!-- Form -->
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-start">
                <div class="col-6">
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Doctors</h6>

                </div>
                <div class="col-6" style="text-align: right;">
                    <a href="<?php echo base_url() ?>add-location" class="btn btn-primary">Add</a>

                </div>

            </div>
            <div class="card-body">
                <div class="alert alert-danger d-none" role="alert" id="error"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Area</th>
                                        <th>City</th>
                                        <th>Chemists</th>
                                        <th>Specialities</th>
                                        <th>Timings</th>
                                        <th>Products</th>
                                        <!-- <th>Latitude</th>
                                        <th>Longitude</th> -->
                                        <th>Account</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $row) : ?>
                                        <tr>
                                            <td><?= ucfirst($row['doctor_name']) ?></td>
                                            <td><?= ucfirst($row['area']) ?></td>
                                            <td><?= ucfirst($row['city_name']) ?></td>
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
                                            <td>
                                                <?= $row['product_names'] ?>
                                            </td>
                                            <!-- <td><?= $row['latitude'] ?></td>
                                            <td><?= $row['longitude'] ?></td> -->
                                            <td><?= ($row['is_approved'] == 1) ? 'approved' : 'Not approved' ?></td>
                                            <td><?= $row['status'] ? 'Active' : 'Inactive' ?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td class="justify-content-center"><a href="https://www.google.com/maps?q=<?= $row['latitude'] ?>,<?= $row['longitude'] ?>" target="_blank"><i class="bi bi-geo-alt-fill"></i></a></td>
                                            <td><button class="btn btn-primary">Edit</button></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /Form -->
    </div>



</div>
<!-- /Main Content -->

<?php require_once('common/footer.php') ?>