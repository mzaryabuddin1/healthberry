<?php

$pagetab = "products";
$pagename = "manage_products_gallery";

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
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Products</h6>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($data as $row) :?>
                        <div class="col-md-3 col-lg-3 col-sm-12">
                            <div class="card">
                                <img class="card-img-top" src="<?=  $row['picture'] ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= ucfirst($row['name'])  ?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Generic: <?= $row['generic'] ?></li>
                                    <li class="list-group-item">Form: <?= $row['form'] ?></li>
                                    <li class="list-group-item">Perc: <?= $row['maxpercentage'] . " %" ?></li>
                                </ul>
                                <div class="card-footer <?= $row['status'] ?  'bg-success' : 'bg-danger' ?>" style="color: white !important; " >
                                    <?= $row['status'] ? 'Active' : 'Inactive' ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>

            </div>
        </div>
        <!-- /Form -->
    </div>



</div>
<!-- /Main Content -->

<?php require_once('common/footer.php') ?>