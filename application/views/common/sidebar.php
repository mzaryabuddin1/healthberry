		<!-- Vertical Nav -->
		<div class="hk-menu">
			<!-- Brand -->
			<div class="menu-header">
				<span>
					<a class="navbar-brand" href="index.html">
						<!-- <img class="brand-img img-fluid" src="<?= base_url() ?>theme/dist/img/brand-sm.svg" alt="brand" />
						<img class="brand-img img-fluid" src="<?= base_url() ?>theme/dist/img/Jampack.svg" alt="brand" /> -->
						<h3 class="text-success">Health Berry</h3>
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
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
													<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
													<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z" />
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
										<li class="nav-item">
											<ul class="nav flex-column">
												<li class="nav-item <?= $pagename == "manage_app_users" ? 'active' : "" ?>">
													<a class="nav-link" href="<?= base_url() . 'manage-app-users' ?>"><span class="nav-link-text">Manage Feild User</span></a>
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
							<li class="nav-item <?= $pagetab == "locations" ? 'active' : "" ?>">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_location">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
												<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
												<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Doctors</span>
								</a>
								<ul id="dash_location" class="nav flex-column <?= $pagetab != "locations" ? 'collapse' : "" ?>  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item <?= $pagename == "manage_locations" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'manage-locations' ?>"><span class="nav-link-text">Manage</span></a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item <?= $pagename == "weekly_plan" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'weekly-plan' ?>"><span class="nav-link-text">Weekly Plan</span></a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="nav-item <?= $pagetab == "products" ? 'active' : "" ?>">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_products">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
												<path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Products</span>
								</a>
								<ul id="dash_products" class="nav flex-column <?= $pagetab != "products" ? 'collapse' : "" ?>  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item <?= $pagename == "manage_products" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'manage-products' ?>"><span class="nav-link-text">Manage</span></a>
											</li>
											<li class="nav-item <?= $pagename == "manage_products_gallery" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'manage-products-gallery' ?>"><span class="nav-link-text">Gallery</span></a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="nav-item <?= $pagetab == "report" ? 'active' : "" ?>">
								<a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_reports">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-line" viewBox="0 0 16 16">
												<path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-3 0V7H7v7zm-5 0v-3H2v3z" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Reports</span>
								</a>
								<ul id="dash_reports" class="nav flex-column <?= $pagetab != "report" ? 'collapse' : "" ?>  nav-children">
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item <?= $pagename == "report_doctors" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'report-doctors' ?>"><span class="nav-link-text">Doctors</span></a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item <?= $pagename == "report_calls" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'report-calls' ?>"><span class="nav-link-text">Calls</span></a>
											</li>
										</ul>
									</li>
									<li class="nav-item">
										<ul class="nav flex-column">
											<li class="nav-item <?= $pagename == "dynamic_reports" ? 'active' : "" ?>">
												<a class="nav-link" href="<?= base_url() . 'dynamic-report' ?>"><span class="nav-link-text">Dynamic Reports</span></a>
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