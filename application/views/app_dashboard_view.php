<?php require_once("common2/header.php") ?>
<!-- MAIN -->
<div class="container">
    <div class="text-end">
        <div id="clock"></div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Hi, <?= ucfirst($_SESSION['app_user_username'])  ?></h5>
                        <a class="btn btn-danger" href="<?= base_url() ?>app-logout">Logout</a>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Plan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Locations</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">History</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-secondary text-light text-center">
                                            <th>DOCTOR</th>
                                            <th>CITY</th>
                                            <th>AREA</th>
                                            <th>CHEMIST</th>
                                            <th>SPECI.</th>
                                            <th>DAY</th>
                                            <th>TIMINGS</th>
                                            <th>CALL</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($plan as $row) : ?>
                                                <tr>
                                                    <td><?= ucfirst($row['doctor_name']) ?></td>
                                                    <td><?= ucfirst($row['city']) ?></td>
                                                    <td><?= ucfirst($row['area']) ?></td>
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
                                                    <td><?= ucfirst($row['planned_day']) ?></td>
                                                    <td>
                                                        <?php
                                                        $parsed_timings = json_decode($row['timings'], true);
                                                        foreach ($parsed_timings as $var) {
                                                            echo $var["from"] . " - " . $var["to"] . "<br>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group actBtns" role="group" aria-label="Basic example">
                                                            <button type="button" class="btn btn-outline-primary btn-md callbtn" data-doctor="<?= ucfirst($row['doctor_name']) ?>"><i class="bi bi-telephone-fill"></i></button>
                                                            <a class="btn btn-outline-danger btn-md" href="<?= base_url() . 'app-view-doctor-location?id=' . $row['id']?>"><i class="bi bi-geo-alt"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>



                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Integer interdum diam eleifend metus lacinia, quis gravida eros mollis.
                                Fusce non sapien
                                sit amet magna dapibus
                                ultrices. Morbi tincidunt magna ex, eget faucibus sapien bibendum non. Duis
                                a mauris ex.
                                Ut finibus risus sed massa
                                mattis porta. Aliquam sagittis massa et purus efficitur ultricies. Integer
                                pretium dolor
                                at sapien laoreet ultricies.
                                Fusce congue et lorem id convallis. Nulla volutpat tellus nec molestie
                                finibus. In nec
                                odio tincidunt eros finibus
                                ullamcorper. Ut sodales, dui nec posuere finibus, nisl sem aliquam metus, eu
                                accumsan
                                lacus felis at odio. Sed lacus
                                quam, convallis quis condimentum ut, accumsan congue massa. Pellentesque et
                                quam vel
                                massa pretium ullamcorper vitae eu
                                tortor.
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean
                                    ornare interdum
                                    viverra. Sed ut odio velit. Aenean eu diam
                                    dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum.
                                    Maecenas id
                                    sollicitudin ex. Cras in ex vestibulum,
                                    posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in
                                    cursus sem
                                    placerat ut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- END MAIN -->


<?php require_once("common2/footer.php") ?>


<script>
    $(function() {
        $("#regstr").on("submit", function(e) {
            e.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                url: "<?php echo base_url() . "app-login-submit"; ?>",
                type: "post",
                data: formdata,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                cache: false,
                beforeSend: function() {
                    $(":submit").prop("disabled", true);
                    $(":submit").addClass("d-none");
                    $("#spinner").removeClass("d-none");
                    $("#error").addClass("d-none");
                },
                success: function(res) {
                    let obj = JSON.parse(res);
                    if (obj.error) {
                        $("#error").html(obj.error);
                        $("#error").removeClass("d-none");
                        $("#spinner").addClass("d-none");
                        $(":submit").removeClass("d-none");
                        toastr.error("Please check errors list!", "Error");
                        $(window).scrollTop(0);
                    } else if (obj.success) {
                        $("#spinner").addClass("d-none");
                        toastr.success("Welcome!", "On Board!");
                        setTimeout(function() {
                            window.location = '<?php echo base_url() . 'app-dashboard' ?>';
                        }, 1000);
                    } else {
                        $("#spinner").addClass("d-none");
                        $(":submit").prop("disabled", false);
                        $(":submit").removeClass("d-none");
                        toastr.error("Something bad happened!", "Error");
                        $(window).scrollTop(0);
                    }

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
    })
</script>

<script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var day = now.toLocaleString('en-US', {
            weekday: 'long'
        });
        var date = now.toLocaleDateString('en-US');

        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;

        var timeString = hours + ":" + minutes + ":" + seconds;
        var dateTimeString = day + ", " + date + " " + timeString;

        document.getElementById("clock").innerText = dateTimeString;
    }


    // Update the clock every second
    setInterval(updateClock, 1000);

    // Initial call to display the clock immediately
    updateClock();
</script>

<script>
    $(".callbtn").on("click", () => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Call!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    })
</script>

</body>

</html>