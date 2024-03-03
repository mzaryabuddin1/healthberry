<?php

$pagetab = "doctor";
$pagename = "manage_doctor";

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
                        <h1 class="pg-title">Doctors</h1>
                        <p>Interact with doctors.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Page Body -->
        <div class="hk-pg-body">

            <table id="datatable" class="table nowrap table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Specialities</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Zaryab</td>
                        <td>General, Cardiac</td>
                        <td>E180</td>
                        <td>92 333 3333333</td>
                        <td><a href="https://www.google.com/maps?q=24.8322342,67.1298671&z=15" target="_blank">View</a></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- /Page Body -->
    </div>



</div>
<!-- /Main Content -->

<?php require_once('common/footer.php') ?>

 
<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/datatables.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/datatables.min.js"></script>

<script>
    														

$("#datatable").DataTable({
    "dom": 'Bfrtip',
    "buttons":  ['copy', 'csv', 'excel', 'print'],
    "order": [1, 'asc' ],
    "searching": true
})
													
</script>