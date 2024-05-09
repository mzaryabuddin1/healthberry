		<!-- Top Navbar -->
		<nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
		    <div class="container-fluid">
		        <!-- Start Nav -->
		        <div class="nav-start-wrap">
		            <button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle d-xl-none"><span class="icon"><span class="feather-icon"><i data-feather="align-left"></i></span></span></button>

		        </div>
		        <!-- /Start Nav -->

		        <!-- End Nav -->
		        <div class="nav-end-wrap">
		            <ul class="navbar-nav flex-row">
		                <li class="nav-item">
		                    <div class="dropdown ps-2">
		                        <a class=" dropdown-toggle no-caret" href="#" role="button" data-bs-display="static" data-bs-toggle="dropdown" data-dropdown-animation data-bs-auto-close="outside" aria-expanded="false">
		                            <div class="avatar avatar-rounded avatar-xs">
		                                <img src="<?= base_url() ?>theme/dist/img/avatar12.jpg" alt="user" class="avatar-img">
		                            </div>
		                        </a>
		                        <div class="dropdown-menu dropdown-menu-end">
		                            <div class="p-2">
		                                <div class="media">
		                                    <div class="media-head me-2">
		                                        <div class="avatar avatar-primary avatar-sm avatar-rounded">
		                                            <span class="initial-wrap">ZA</span>
		                                        </div>
		                                    </div>
		                                    <div class="media-body">
		                                        <div class="fs-7"><?= $_SESSION['user_email'] ?></div>
		                                        <a href="<?= base_url() . 'logout' ?>" class="d-block fs-8 link-secondary"><u>Sign Out</u></a>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="dropdown-divider"></div>
		                            <h6 class="dropdown-header">Manage Account</h6>
		                            <a class="dropdown-item" href="#"><span class="dropdown-icon feather-icon"><i data-feather="settings"></i></span><span>Settings</span></a>
		                          
		                        </div>
		                    </div>
		                </li>
		            </ul>
		        </div>
		        <!-- /End Nav -->
		    </div>
		</nav>
		<!-- /Top Navbar -->