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
                <div class="col-6">
                    <h6><i class="fa fa-table" aria-hidden="true"></i> Edit User</h6>

                </div>


            </div>

            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" id="formSubmit">
                        <div class="form-body">
                            <div class="row">
                            <input type="hidden" class="form-control" value="<?php echo $data['id'] ?>" name="id" placeholder="id">

                                <div class="col-md-6 form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control"  value="<?php echo $data['name'] ?>" name="name" placeholder="User Name">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="<?php echo $data['email'] ?>" name="email" placeholder="Email">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"  name="password" placeholder="Password">
                                </div>
                               
                                <div class="col-md-6 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-6 form-group d-none">
                                    <label>role</label>
                                    <select name="roles" class="form-control">
                                        <option value="user" <?php echo ($data['roles'] == 'user') ? 'selected' : ''; ?>>User</option>
                                        <option value="admin" <?php echo ($data['roles'] == 'admin') ? 'selected' : ''; ?>>admin</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" <?php echo ($data['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?php echo ($data['status'] == 0) ? 'selected' : ''; ?>>De-Active</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Form -->
    </div>



</div>
<!-- /Main Content -->
<!-- SweetAlert CDN -->

<?php require_once('common/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#formSubmit').submit(function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Disable submit button to prevent multiple submissions
            $('#formSubmit button[type="submit"]').prop('disabled', true);

            var formData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>user-update",
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    $('#formSubmit button[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    $('#formSubmit button[type="submit"]').prop('disabled', false);
                    if (response.status == '1') {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500 // Automatically close the alert after 1.5 seconds
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            html: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                        });
                    }

                },
                error: function(xhr, status, error) {
                    $('#formSubmit button[type="submit"]').prop('disabled', false);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while processing your request.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

</script>