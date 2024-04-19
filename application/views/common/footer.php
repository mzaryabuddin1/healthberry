</div>
<!-- /Wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>theme/vendors/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url() ?>theme/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- FeatherIcons JS -->
<script src="<?= base_url() ?>theme/dist/js/feather.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="<?= base_url() ?>theme/dist/js/dropdown-bootstrap-extended.js"></script>

<!-- Simplebar JS -->
<script src="<?= base_url() ?>theme/vendors/simplebar/dist/simplebar.min.js"></script>



<!-- Daterangepicker JS -->
<script src="<?= base_url() ?>theme/vendors/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>theme/vendors/daterangepicker/daterangepicker.js"></script>
<script src="dist/js/daterangepicker-data.js"></script>

<!-- Amcharts Maps JS -->
<script src="<?= base_url() ?>theme/vendors/@amcharts/amcharts4/core.js"></script>
<script src="<?= base_url() ?>theme/vendors/@amcharts/amcharts4/maps.js"></script>
<script src="<?= base_url() ?>theme/vendors/@amcharts/amcharts4-geodata/worldLow.js"></script>
<script src="<?= base_url() ?>theme/vendors/@amcharts/amcharts4-geodata/worldHigh.js"></script>
<script src="<?= base_url() ?>theme/vendors/@amcharts/amcharts4/themes/animated.js"></script>

<!-- Apex JS -->
<script src="<?= base_url() ?>theme/vendors/apexcharts/dist/apexcharts.min.js"></script>

<!-- Init JS -->
<script src="<?= base_url() ?>theme/dist/js/init.js"></script>
<script src="<?= base_url() ?>theme/dist/js/chips-init.js"></script>
<script src="<?= base_url() ?>theme/dist/js/dashboard-data.js"></script>


<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/datatables.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/datatables.min.js"></script>

<script>
	if ($("#datatable").length > 0)
		$("#datatable").DataTable({
			"dom": 'Bfrtip',
			"buttons": ['copy', 'csv', 'excel', 'print'],
			"order": [1, 'asc'],
			"searching": true
		})
</script>
</body>

</html>