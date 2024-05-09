<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Set the options that I want
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    // toastr.error("Please check errors list!", "Error");
</script>
<script src="<?= base_url() ?>mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>mazer/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>mazer/assets/vendors/fontawesome/all.min.js"></script>
<script src="<?= base_url() ?>mazer/assets/vendors/choices.js/choices.min.js"></script>
<script src="<?= base_url() ?>mazer/assets/js/main.js"></script>


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