<?php

$pagetab = "users";
$pagename = "manage_app_users";

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
                    <h6><i class="fa fa-table" aria-hidden="true"></i>Field Users</h6>

                </div>
                <div class="col-6" style="text-align: right;">
                    <a href="<?php echo base_url() ?>add-app-user" class="btn btn-primary">Add</a>

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
                                    <th>User Name</th>
                                    <th>Profile</th>
                                    <th>City</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= $row['username'] ?></td>
                                        <td><img src="<?= $row['profile_picture'] ?>" alt="" style="width:100px;height:100px"></td>
                                        <td><?= $row['city_name'] ?></td>
                                        <td><?= $row['created_at'] ?></td>
                                        <td><?= $row['status'] ? 'Active' : 'Inactive' ?></td>
                                        <td><a href="<?php echo base_url()?>edit-app-user/<?= $row['id'] ?>" class="btn btn-primary">Edit</a></td>
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


