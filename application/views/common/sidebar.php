		<!-- Vertical Nav -->
		<div class="hk-menu">
			<!-- Brand -->
			<div class="menu-header">
				<span>
					<a class="navbar-brand" href="index.html">
						<img class="brand-img img-fluid" src="<?= base_url() ?>theme/dist/img/brand-sm.svg" alt="brand" />
						<img class="brand-img img-fluid" src="<?= base_url() ?>theme/dist/img/Jampack.svg" alt="brand" />
					</a>
					<!-- <button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle">
		                <span class="icon">
		                    <span class="svg-icon fs-5">
		                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
		                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
		                            <line x1="10" y1="12" x2="20" y2="12"></line>
		                            <line x1="10" y1="12" x2="14" y2="16"></line>
		                            <line x1="10" y1="12" x2="14" y2="8"></line>
		                            <line x1="4" y1="4" x2="4" y2="20"></line>
		                        </svg>
		                    </span>
		                </span>
		            </button> -->
				</span>
			</div>
			<!-- /Brand -->

			<!-- Main Menu -->
			<div data-simplebar class="nicescroll-bar">
				<div class="menu-content-wrap">
					<div class="menu-group">
						<ul class="navbar-nav flex-column">
							<li class="nav-item <?= $pagetab == "dashboard" ? 'active' : "" ?>">
								<a class="nav-link" href="<?= base_url() ?>dashboard">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-template" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<rect x="4" y="4" width="16" height="4" rx="1" />
												<rect x="4" y="12" width="6" height="8" rx="1" />
												<line x1="14" y1="12" x2="20" y2="12" />
												<line x1="14" y1="16" x2="20" y2="16" />
												<line x1="14" y1="20" x2="20" y2="20" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Dashboard</span>
									<span class="badge badge-sm badge-soft-pink ms-auto">Hot</span>
								</a>
							</li>
						</ul>
					</div>

					<?php if ($_SESSION['user_roles'] == 'admin') : ?>
						<div class="menu-gap"></div>
						<div class="menu-group">
							<div class="nav-header">
								<span>Management</span>
							</div>
							<ul class="navbar-nav flex-column">
								<!-- <li class="nav-item <?= $pagetab == "doctor" ? 'active' : "" ?>">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_doctor">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Doctor</span>
									</a>
									<ul id="dash_doctor" class="nav flex-column  <?= $pagetab != "doctor" ? 'collapse' : "" ?>  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item <?= $pagename == "manage_doctor" ? 'active' : "" ?>">
													<a class="nav-link" href="<?= base_url() . 'manage-doctor' ?>"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_chemist">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Chemist</span>
									</a>
									<ul id="dash_chemist" class="nav flex-column collapse  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link" href="chats.html"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_product">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Product</span>
									</a>
									<ul id="dash_product" class="nav flex-column collapse  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link" href="chats.html"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_activity">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Activity</span>
									</a>
									<ul id="dash_activity" class="nav flex-column collapse  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link" href="chats.html"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_sales">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Sales</span>
									</a>
									<ul id="dash_sales" class="nav flex-column collapse  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link" href="chats.html"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_report_roi">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Reports</span>
									</a>
									<ul id="dash_report_roi" class="nav flex-column collapse  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link" href="chats.html"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li> -->

								<li class="nav-item <?= $pagetab == "users" ? 'active' : "" ?>">
									<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_app_user">
										<span class="nav-icon-wrap">
											<span class="svg-icon">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
													<line x1="12" y1="11" x2="12" y2="11.01" />
													<line x1="8" y1="11" x2="8" y2="11.01" />
													<line x1="16" y1="11" x2="16" y2="11.01" />
												</svg>
											</span>
										</span>
										<span class="nav-link-text">Users</span>
									</a>
									<ul id="dash_app_user" class="nav flex-column  <?= $pagetab != "users" ? 'collapse' : "" ?>  nav-children">
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item <?= $pagename == "manage_users" ? 'active' : "" ?>">
													<a class="nav-link" href="<?= base_url() . 'manage-users' ?>"><span class="nav-link-text">Manage</span></a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>

					<?php endif; ?>

					<div class="menu-gap"></div>
					<div class="menu-group">
						<div class="nav-header">
							<span>Tracking</span>
						</div>
						<ul class="navbar-nav flex-column">
							<li class="nav-item">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_location">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
												<line x1="12" y1="11" x2="12" y2="11.01" />
												<line x1="8" y1="11" x2="8" y2="11.01" />
												<line x1="16" y1="11" x2="16" y2="11.01" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Location</span>
								</a>
								<ul id="dash_location" class="nav flex-column collapse  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="#"><span class="nav-link-text">Chats</span></a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_reports">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-dots" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
												<line x1="12" y1="11" x2="12" y2="11.01" />
												<line x1="8" y1="11" x2="8" y2="11.01" />
												<line x1="16" y1="11" x2="16" y2="11.01" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Reports</span>
								</a>
								<ul id="dash_reports" class="nav flex-column collapse  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item">
												<a class="nav-link" href="#"><span class="nav-link-text">Chats</span></a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>

					<div class="callout card card-flush bg-orange-light-5 text-center mt-5 w-220p mx-auto">
						<div class="card-body">
							<h5 class="h5">Contact</h5>
							<p class="p-sm card-text">For webapps, mobile application and lot more</p>
							<a href="https://liveasoft.com" target="_blank" class="btn btn-primary btn-block">Go Liveasoft</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Menu -->
		</div>
		<div id="hk_menu_backdrop" class="hk-menu-backdrop"></div>
		<!-- /Vertical Nav -->