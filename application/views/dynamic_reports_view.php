<?php
$pagetab = "report";
$pagename = "dynamic_reports";

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
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Dynamic Reports</h6>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form id="regstr">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="">Date From <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="datefrom" id="datefrom" placeholder="Date From" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="">Date To <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="dateto" id="dateto" placeholder="Date To" required>
                            </div>
                            <div class="col-sm-2">
                                <label for="">City</label>
                                <select class="form-control" name="city_id" id="city_id">
                                    <option value="" selected disabled>Select City</option>
                                    <?php foreach ($cities as $key => $city) : ?>
                                        <option value="<?= $city['id']?>"><?= $city['city_name']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="">Doctor/User</label>
                                <select name="doctor-user" class="form-control"  id="doctor-user">
                                    <option value="" selected disabled>Select</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="">Calls/Plan <span class="text-danger">*</span></label>
                                <select name="calls-plan" class="form-control" id="calls-plan" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="location_calls">Calls</option>
                                    <option value="weekly_plan">Plans</option>
                                </select>
                            </div>
                            <div class="col-sm-2 d-none" id="user-select">
                                <label for="">User</label>
                                <select class="form-control" name="app_user_id" id="app_user_id">
                                    <option value="" selected disabled>Select User</option>
                                    <?php foreach ($app_users as $key => $user) : ?>
                                        <option value="<?= $user['id']?>"><?= $user['username']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-sm-2 d-none" id="doctor-select">
                                <label for="">Doctor</label>
                                <select class="form-control" name="location_id" id="location_id">
                                    <option value="" selected disabled>Select Doctor</option>
                                    <?php foreach ($locations as $key => $doctor) : ?>
                                        <option value="<?= $doctor['id']?>"><?= $doctor['doctor_name']?></option>
                                    <?php endforeach ?>
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
                </div>
            </div>
        </div>
        <!-- /Form -->

        <!-- Table -->
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-start">
                <div class="col-6">
                    <h6><i class="fa fa-table" aria-hidden="true"></i> <span id="which"></span></h6>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dtable" class="d-none table table-bordered">
                            <thead>
                                <tr id="thead">
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Table -->
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
    $("#doctor-user").change(function (){
        if($(this).val() == "doctor"){
            $("#doctor-select").removeClass("d-none");
            $("#user-select").addClass("d-none");
        }else{
            $("#doctor-select").addClass("d-none");
            $("#user-select").removeClass("d-none");
        }
    })

    $("#calls-plan").change(function () {
        if($(this).val() == "weekly_plan"){
            $("#which").text("Plans");
        }else{
            $("#which").text("Calls");
        }
    })

    function formatDate(dateString) {
        var date = new Date(dateString);

        // Format date as dd/mm/yyyy
        var day = date.getDate().toString().padStart(2, '0');
        var month = (date.getMonth() + 1).toString().padStart(2, '0'); // January is 0!
        var year = date.getFullYear();

        var formattedDate = day + '/' + month + '/' + year;

        return formattedDate;
    }

    function formatTime(timeString) {
        var timeSplit = timeString.split(':');
        var hours = parseInt(timeSplit[0], 10);
        var minutes = timeSplit[1];
        
        // Determine AM or PM
        var period = hours >= 12 ? 'PM' : 'AM';

        // Convert hours to 12-hour format
        if (hours === 0) {
            hours = 12; // Midnight
        } else if (hours > 12) {
            hours -= 12; // PM hours
        }

        // Format time as hh:mm AM/PM
        var formattedTime = hours + ':' + minutes + ' ' + period;

        return formattedTime;
    }

    function convertTimeTo12HourFormat(time24) {
        // Split the time string into hours, minutes, and seconds
        var timeSplit = time24.split(':');
        var hours = parseInt(timeSplit[0], 10);
        var minutes = timeSplit[1];
        
        // Determine AM or PM
        var period = hours >= 12 ? 'PM' : 'AM';

        // Convert hours to 12-hour format
        if (hours === 0) {
            hours = 12; // Midnight
        } else if (hours > 12) {
            hours -= 12; // PM hours
        }

        // Return formatted time
        return hours + ':' + minutes + ' ' + period;
    }

    $("#regstr").on("submit", function(e) {
			e.preventDefault()

			const formdata = new FormData(this)

			$.ajax({
				url: "<?php echo base_url() . "dynamic-reports-get"; ?>",
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

                    let header = ""
                    let html = "";

                    if($("#calls-plan").val() == "location_calls" && $("#doctor-user").val() == "user"){
                        header = `<th>User</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>City</th>
                                <th>Evidance</th>
                                <th>Doctor</th>`;

                        $.each(arr, function(key, val) {
                            html += `<tr>
                                    <td>${val.user_name}</td>
                                    <td>${formatDate(val.created_at)}</td>
                                    <td>${formatTime(val.created_at.split(' ')[1])}</td>
                                    <td>${val.city_name}</td>
                                    <td><img src="${val.evidance_picture}" width="80px"></img></td>
                                    <td>${val.doctor_name}</td>
                            </tr>`;
                        })
                    }else if(($("#calls-plan").val() == "location_calls" && $("#doctor-user").val() == "doctor") || ($("#calls-plan").val() == "location_calls" && $("#doctor-user").val() == null)){
                        console.log("chala")
                        header = `<th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>City</th>
                                <th>Evidance</th>
                                <th>User</th>`;

                        $.each(arr, function(key, val) {
                            html += `<tr>
                                <td>${val.doctor_name}</td>
                                <td>${formatDate(val.created_at)}</td>
                                <td>${formatTime(val.created_at.split(' ')[1])}</td>
                                <td>${val.city_name}</td>
                                <td><img src="${val.evidance_picture}" width="80px"></img></td>
                                <td>${val.user_name}</td>
                            </tr>`;
                        })
                    }else if($("#calls-plan").val() == "weekly_plan" && $("#doctor-user").val() == "user"){
                        header = `<th>User</th>
                                <th>Planned Day</th>
                                <th>Planned Time</th>
                                <th>City</th>
                                <th>Doctor</th>`;

                        $.each(arr, function (key, val) {
                            html += `<tr>
                                    <td>${val.user_name}</td>
                                    <td>${val.planned_day}</td>
                                    <td>${convertTimeTo12HourFormat(val.planned_time)}</td>
                                    <td>${val.city_name}</td>
                                    <td>${val.doctor_name}</td>
                            </tr>`;
                        })
                    }else if (($("#calls-plan").val() == "weekly_plan" && $("#doctor-user").val() == "doctor") || ($("#calls-plan").val() == "weekly_plan" && $("#doctor-user").val() == null)){
                        header = `<th>Doctor</th>
                                <th>Planned Day</th>
                                <th>Planned Time</th>
                                <th>City</th>
                                <th>User</th>`;

                        $.each(arr, function (key, val) {
                            html += `<tr>
                                    <td>${val.doctor_name}</td>
                                    <td>${val.planned_day}</td>
                                    <td>${convertTimeTo12HourFormat(val.planned_time)}</td>
                                    <td>${val.city_name}</td>
                                    <td>${val.user_name}</td>
                            </tr>`;
                        })
                    }

                    $("#thead").html(header);
                    $("#tbody").html(html);

                    // foreach on arr
                    

                    // $("#dtable").DataTable({
                    //     "dom": 'Bfrtip',
                    //     "buttons": ['copy', 'csv', 'excel', 'print'],
                    //     "order": [1, 'asc'],
                    //     "searching": true,
                    //     "destroy": true
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

