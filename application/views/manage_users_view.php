<?php

$pagetab = "users";
$pagename = "manage_users";

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
                <h6><i class="fa fa-table" aria-hidden="true"></i> Users</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-danger d-none" role="alert" id="error"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['roles'] ?></td>
                                        <td><?= $row['status'] ? 'Active' : 'Inactive' ?></td>
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


