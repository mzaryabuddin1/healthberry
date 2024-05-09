<?php

$pagetab = "locations";
$pagename = "weekly_plan";

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
                        <h1 class="pg-title">Weekly Plan</h1>
                        <p>Interact with plans.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Page Body -->
        <div class="hk-pg-body">
            <form id="search">
                <div class="row">
                    <div class="col-md-5">
                        <label for="user">User</label>
                        <select name="user" id="user" class="form-control" required>
                            <option value="" selected disabled>Select</option>
                            <?php foreach($app_users as $key => $value): ?>
                                <option value="<?= $value['id'] ?>"><?= $value['username'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="city">City</label>
                        <select name="city" id="city" class="form-control" required>
                            <option value="" selected disabled>Select</option>
                            <?php foreach($cities as $key => $value): ?>
                                <option value="<?= $value['id'] ?>"><?= $value['city_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end justify-content-end"> <!-- Adjusted column size and added justify-content-end -->
                        <button id="load" type="submit" class="btn btn-md btn-primary">Load</button>
                    </div>
                </div>
            </form>

            <!-- Table Already Planned -->
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-start">
                    <div class="col-6">
                        <h6><i class="fa fa-table" aria-hidden="true"></i> Doctors</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger d-none" role="alert" id="error"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable2">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Doctor</th>
                                            <th>Area</th>
                                            <th>City</th>
                                            <th>Chemists</th>
                                            <th>Specialities</th>
                                            <th>Timings</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Locations -->
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-start">
                    <div class="col-6">
                        <h6><i class="fa fa-table" aria-hidden="true"></i> Planned</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger d-none" role="alert" id="errortbl2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable3">
                                    <thead>
                                        <tr>
                                            <th>DoctorId</th>
                                            <th>Doctor</th>
                                            <th>Area</th>
                                            <th>Timings</th>
                                            <th>Planned Day</th>
                                            <th>Planned Time</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody2">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Body -->
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form id="planadd">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Create Plan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger d-none" id="error3" role="alert"></div>
					<div class="d-none form-group col-md-12">
                        <input type="text" class="readonly" name="location_id" value="" id="locid" required>
                        <input type="text" class="readonly" name="app_user_id" value="" id="app_userid" required>
					</div>
					<div class="form-group col-md-12">
						<label class="form-label">Day <span class="text-danger">*</span></label>
                        <select class="form-control" name="planned_day" id="planned_day" required>
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
					<div class="form-group col-md-12">
						<label class="form-label">Time <span class="text-danger">*</span></label>
                        <input type="time" name="planned_time" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div class="text-center d-none" id="spinner">
						<button class="btn btn-primary" type="button" disabled>
							<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
							Creating Plan...
						</button>
					</div>
					<button type="submit" class="btn btn-primary">Create</button>
				</div>
			</div>
		</form>
	</div>
</div>



</div>
<!-- /Main Content -->

<?php require_once('common/footer.php') ?>

<script>
    $(document).ready(function() {
        $("#user, #city").click(() => {
            $("#datatable2").DataTable().clear().destroy();
            $("#datatable3").DataTable().clear().destroy();
        })

        $("#search").submit((e) => {
            e.preventDefault();

            let formdata = new FormData($("#search")[0]);

            $.ajax({
                url: "<?= base_url() . "search-plan"; ?>",
                type: "post",
                data: formdata,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                cache: false,
                beforeSend: function() {
                    $("#datatable2").DataTable().destroy()
                    $("#datatable3").DataTable().destroy()
                },
                success: function(data) {
                    let json_parsed = JSON.parse(data);

                    let tbl1html = ""

                    $.each(json_parsed.locations, function (indexInArray, valueOfElement) { 
                        var chemists = JSON.parse(valueOfElement.chemists);
                        var specialities = JSON.parse(valueOfElement.specialities);
                        var timings = JSON.parse(valueOfElement.timings);
                       

                         tbl1html += "<tr>"
                         tbl1html += "<td>" + valueOfElement.id + "</td>"
                         tbl1html += "<td>" + valueOfElement.doctor_name + "</td>"
                         tbl1html += "<td>" + valueOfElement.area + "</td>"
                         tbl1html += "<td>" + valueOfElement.city_name + "</td>"
                         tbl1html += "<td>"
                         $.each(chemists, function(index, value) {
                             tbl1html += value + "<br>"
                         })
                         tbl1html += "</td>"
                         tbl1html += "<td>"
                         $.each(specialities, function(index, value) {
                            tbl1html += value + "<br>"
                         })
                         tbl1html += "</td>"
                         tbl1html += "<td>"
                         $.each(timings, function(index, value) {
                             tbl1html += value.dayname + " - " + value.from + " - " + value.to + "<br>"
                         })
                         tbl1html += "</td>"
                         tbl1html += "<td><a href='https://www.google.com/maps?q="+ valueOfElement.latitude +","+ valueOfElement.longitude +"' target='_blank'><i class='fa fa-map-marker' aria-hidden='true'></i></a></td>"
                         tbl1html += "<td><button class='btn btn-sm btn-primary modalbtn' data-bs-toggle='modal' data-bs-target='#staticBackdrop' data-locid='"+ valueOfElement.id +"' data-appuserid='"+ $("#user").val() +"'>Plan</button></td>"
                         tbl1html += "</tr>"
                    });

                    $("#tbody").html(tbl1html)
                    $("#datatable2").DataTable({
                        "dom": 'Bfrtip',
                        "buttons": ['copy', 'csv', 'excel', 'print'],
                        "order": [1, 'asc'],
                        "searching": true
                    })

                    let tbl2html = ""
                    $.each(json_parsed.plans, function (indexInArray, valueOfElement) { 
                        var timings = JSON.parse(valueOfElement.timings);

                        tbl2html += "<tr>"
                        tbl2html += "<td>" + valueOfElement.id + "</td>"
                        tbl2html += "<td>" + valueOfElement.doctor_name + "</td>"
                        tbl2html += "<td>" + valueOfElement.area + "</td>"
                        tbl2html += "<td>"
                        $.each(timings, function(index, value) {
                            tbl2html += value.dayname + " - " + value.from + " - " + value.to + "<br>"
                        })
                        tbl2html += "</td>"
                        tbl2html += "<td>" + valueOfElement.planned_day + "</td>"
                        tbl2html += "<td>" + valueOfElement.planned_time + "</td>"
                        tbl2html += "<td><a href='https://www.google.com/maps?q="+ valueOfElement.latitude +","+ valueOfElement.longitude +"' target='_blank'><i class='fa fa-map-marker' aria-hidden='true'></i></a></td>"
                        tbl2html += "<td><button class='btn btn-sm btn-danger rm-btn' data-planid='"+ valueOfElement.plan_id +"'>Remove</button></td>"
                        tbl2html += "</tr>"

                    });
                    $("#tbody2").html(tbl2html)
                    $("#datatable3").DataTable({
                        "dom": 'Bfrtip',
                        "buttons": ['copy', 'csv', 'excel', 'print'],
                        "order": [1, 'asc'],
                        "searching": true
                    })


                    $(".modalbtn").on("click", function() {
                        var locid = $(this).data('locid');
                        var app_userid = $(this).data('appuserid');

                        $("#locid").val(locid);
                        $("#app_userid").val(app_userid);
                    });

                    $(".rm-btn").on("click", function() {
                        var planid = $(this).data('planid');
                        $.ajax({
                            url: "<?= base_url() . "remove-plan-submit"; ?>",
                            type: "post",
                            data: {id: planid},
                            beforeSend: function () {
                                $(".rm-btn").prop("disabled", true);
                                $(".rm-btn").addClass("d-none");
                            },
                            success: function (res) {
                                let obj = JSON.parse(res);
                                if (obj.error) {
                                    $(".rm-btn").removeClass("d-none");
                                    $(window).scrollTop(0);
                                } else if (obj.success) {
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000);
                                } else {
                                    $(".rm-btn").prop("disabled", false);
                                    $(".rm-btn").removeClass("d-none");
                                    $(window).scrollTop(0);
                                }
                                $(".rm-btn").prop("disabled", false);
                            },
                            error: function (error) {
                                $(window).scrollTop(0);
                                $("#spinner").addClass("d-none");
                                $(":submit").prop("disabled", false);
                                $(":submit").removeClass("d-none");
                            }
                        })
                    })
                    
                },
                error: function(data) {
                    console.log(data);
                }
            })
        });

        $("#planadd").on("submit", function(e) {
            e.preventDefault();
			var formdata = new FormData(this);
			$.ajax({
				url: "<?= base_url() . "create-plan-submit"; ?>",
				type: "post",
				data: formdata,
				processData: false, // tell jQuery not to process the data
				contentType: false, // tell jQuery not to set contentType
				cache: false,
				beforeSend: function () {
					$(":submit").prop("disabled", true);
					$(":submit").addClass("d-none");
					$("#spinner").removeClass("d-none");
					$("#error").addClass("d-none");
				},
				success: function (res) {
					let obj = JSON.parse(res);
                    if (obj.error) {
						$("#error").html(obj.error);
						$("#error").removeClass("d-none");
						$("#spinner").addClass("d-none");
						$(":submit").removeClass("d-none");
						$(window).scrollTop(0);
					} else if (obj.success) {
						$("#spinner").addClass("d-none");
						setTimeout(function () {
							window.location.reload();
						}, 1000);
					} else {
						$("#spinner").addClass("d-none");
						$(":submit").prop("disabled", false);
						$(":submit").removeClass("d-none");
						$(window).scrollTop(0);
					}
					$(":submit").prop("disabled", false);
				},
				error: function (error) {
					$(window).scrollTop(0);
					$("#spinner").addClass("d-none");
					$(":submit").prop("disabled", false);
					$(":submit").removeClass("d-none");
				}
			})
        })

        


    });
</script>