<?php
$pagetab = "report";
$pagename = "report_calls";

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
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Calls</h6>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form id="regstr">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Date From</label>
                                <input type="date" class="form-control" name="datefrom" id="datefrom" placeholder="Date From">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Date To</label>
                                <input type="date" class="form-control" name="dateto" id="dateto" placeholder="Date To">
                            </div>
                            <div class="col-sm-3">
                                <label for="">Users</label>
                                <select class="form-control" name="app_user_id" id="app_user_id">
                                    <option value="" selected disabled>Select</option>
                                    <?php foreach ($app_users as $key => $user) : ?>
                                        <option value="<?= $user['id']?>"><?= $user['username']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="">Day</label>
                                <select class="form-control" name="dayname" id="dayname">
                                    <option value="" selected disabled>Select</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-sm-12 d-flex mt-1 justify-content-end">
                                <button class="btn btn-primary me-1 mb-1 d-none" id="spinner" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Load</button>
                            </div>
                        </div>
                    </form>

                    <table id="dtable" class="d-none table table-bordered">
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

<script>

		$("#regstr").on("submit", function(e) {
			e.preventDefault()

			const formdata = new FormData(this)

			$.ajax({
				url: "<?php echo base_url() . "report-calls-get"; ?>",
				type: "post",
				data: formdata,
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					$(":submit").prop("disabled", true);
					$(":submit").addClass("d-none");
					$("#spinner").removeClass("d-none");
					$("#error").addClass("d-none");
				},
				success: function(res) {
                    let arr = JSON.parse(res);

                    function formatTime(dateTime) {
                        const date = new Date(dateTime);
                        const hours = date.getHours();
                        const minutes = date.getMinutes();
                        const ampm = hours >= 12 ? 'PM' : 'AM';
                        const formattedHours = hours % 12 || 12;
                        const formattedMinutes = minutes.toString().padStart(2, '0');
                        return `${formattedHours}:${formattedMinutes} ${ampm}`;
                    }

                    function createTable(data) {
                        const $table = $('#dtable');
                        const $headerRow = $('<tr></tr>');
                        
                        // Create headers
                        $headerRow.append('<th>Doctor</th>');

                        // Get unique dates
                        const uniqueDates = [...new Set(data.map(entry => new Date(entry.created_at).toLocaleDateString()))];
                        uniqueDates.forEach(date => {
                            $headerRow.append(`<th>${date}</th>`);
                        });

                        $table.append($headerRow);

                        // Group data by doctor
                        const doctorData = data.reduce((acc, entry) => {
                            if (!acc[entry.doctor_name]) {
                                acc[entry.doctor_name] = {};
                            }
                            const date = new Date(entry.created_at).toLocaleDateString();
                            const time = formatTime(entry.created_at);
                            if (!acc[entry.doctor_name][date]) {
                                acc[entry.doctor_name][date] = [];
                            }
                            acc[entry.doctor_name][date].push(time);
                            return acc;
                        }, {});

                        // Create data rows
                        for (const doctor in doctorData) {
                            let isFirstRow = true;
                            for (const date of uniqueDates) {
                                const $row = $('<tr></tr>');
                                if (isFirstRow) {
                                    $row.append(`<td>${doctor}</td>`);
                                    isFirstRow = false;
                                } else {
                                    $row.append('<td></td>'); // Empty cell for doctor column
                                }

                                const times = doctorData[doctor][date] ? doctorData[doctor][date].map(time => `<div>${time}</div>`).join('') : '';
                                $row.append(`<td>${times}</td>`);
                                
                                $table.append($row);
                            }
                        }
                    }

                    createTable(arr);


                    // $("#dtable").DataTable({
                    //     "dom": 'Bfrtip',
                    //     "buttons": ['copy', 'csv', 'excel', 'print'],
                    //     "order": [1, 'asc'],
                    //     "searching": true
                    // })

                    $('#dtable').removeClass('d-none')
                    $("#spinner").addClass("d-none");
                    $(":submit").removeClass("d-none");
                    $(":submit").prop("disabled", false);

				},
				error: function(error) {
					toastr.error("Error while sending request to server!", "Error");
					$(window).scrollTop(0);
					$("#spinner").addClass("d-none");
					$(":submit").prop("disabled", false);
					$(":submit").removeClass("d-none");
				}
			})

		})
	</script>
