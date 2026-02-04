<!doctype html>
<html lang="en">

<head>

	<script>
		(function() {
			let t = localStorage.getItem("syndron_theme");
			if (!t) {
				t = "light";
			}
			document.documentElement.setAttribute("data-bs-theme", t);
		})();
	</script>




	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="<?= base_url('assets/remove.png') ?>" type="image/png">


		<!-- PWA Manifest -->
		<link rel="manifest" href="<?= base_url('manifest.json') ?>">
		<meta name="theme-color" content="#111827">

		<script>
			if ('serviceWorker' in navigator) {
				navigator.serviceWorker.register("<?= base_url('sw.js') ?>")
					.then(reg => console.log("SW registered"))
					.catch(err => console.log("SW failed", err));
			}
		</script>

		<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
		<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js"></script>

		<script>
			firebase.initializeApp({
				apiKey: "AIzaSyB1P7NfrLgn5zuz-N4ovE8wOqf3Pp6uKPA",
				authDomain: "taskboard-c3859.firebaseapp.com",
				projectId: "taskboard-c3859",
				storageBucket: "taskboard-c3859.firebasestorage.app",
				messagingSenderId: "311730411150",
				appId: "1:311730411150:web:b080932dbba40ab70ddbdf",
			});

			const messaging = firebase.messaging();

			navigator.serviceWorker.register("/framework/sw.js").then(reg => {

				messaging.getToken({
					vapidKey: "BHcWdj49nZ0Hwigna0f9VrJbeKeM5qGXYg8CC5BZEcXnVAZeyFQ9yHZehG8oSkivCsjUPt0GMEgJ3Enbh0zPWY0"
				}).then(token => {

					console.log("TOKEN:", token);

					fetch("/framework/index.php/push/save_token", {
						method: "POST",
						headers: {
							'Content-Type': 'application/json'
						},
						body: JSON.stringify({
							token: token
						})
					});

				});

			});
		</script>








		<!--plugins-->
		<link href="<?= base_url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">
		<!-- loader-->
		<link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet" />
		<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
		<!-- Bootstrap CSS -->
		<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

		<link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
		<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<!-- Theme Style CSS -->
		<link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/sass/semi-dark.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/sass/bordered-theme.css') ?>">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


		<title>Vision teachno-lab </title>
	</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
		 <div class="sidebar-header" style="display:flex;align-items:center;padding:15px;">

                <img id="logoFull"
                    src="<?= base_url('assets/new_logo.png') ?>"
                    style="width:160px;height:auto;">

                <img id="logoIcon"
                    src="<?= base_url('assets/icons-192.png') ?>"
                    style="width:42px;height:auto;display:none;">

            </div>




			<!--navigation-->
			<ul class="metismenu" id="menu">

				<li>
					<a href="<?= base_url('index.php/welcome');  ?>">
						<div class="parent-icon"><i class="bx bx-home"></i></div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>

				<!-- USERS MENU -->
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fa fa-user"></i></div>
						<div class="menu-title">TASKS</div>
					</a>
					<ul>
						<li><a href="<?= base_url('index.php/task/task_list'); ?>">Task List</a></li>
					</ul>

				</li>




				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fa fa-history"></i></div>


						<div class="menu-title">history</div>
					</a>
					<ul>
						<li><a href="<?= base_url('index.php/task/history'); ?>">Done</a></li>
						<!--  -->
					</ul>
				</li>

			</ul>




		</div>
		<!--end sidebar wrapper -->






		<!--start header -->
		<header>
			<div class="topbar">
				<nav class="navbar navbar-expand gap-2 align-items-center">
					<div class="mobile-toggle-menu d-flex"><i class='bx bx-menu'></i>
					</div>

					<!-- <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
						<a href="avascript:;" class="btn d-flex align-items-center"><i class="bx bx-search"></i>Search</a>
					</div> -->

					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
								<a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dark-mode d-none d-sm-flex">
								<a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
								</a>
							</li>

							<li class="nav-item dropdown dropdown-app">
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">

									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">
								<!-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
									<i class='bx bx-bell'></i>
								</a> -->
								<div class="dropdown-menu dropdown-menu-end">
									<!-- <a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-badge">8 New</p>
										</div>
									</a> -->
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
															ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<!-- <a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger">dc
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
															ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a> -->
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
															sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success">
													<img src="assets/images/app/outlook.png" width="25" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Account Created<span class="msg-time float-end">28 min
															ago</span></h6>
													<p class="msg-info">Successfully created new email</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info">Ss
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span
															class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
															min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
															ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary">
													<img src="assets/images/app/github.png" width="25" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
															ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
															ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
									</div>
									<!-- <a href="javascript:;">
										<div class="text-center msg-footer">
											<button class="btn btn-primary w-100">View All Notifications</button>
										</div>
									</a> -->
								</div>
							</li>
							<!-- <li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class='bx bx-shopping-bag'></i>
								</a> -->
							<div class="dropdown-menu dropdown-menu-end">
								<a href="javascript:;">
									<div class="msg-header">
										<!-- <p class="msg-header-title">My Cart</p> -->
										<p class="msg-header-badge">10 Items</p>
									</div>
								</a>
								<div class="header-message-list">
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/11.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/02.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/03.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/04.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/05.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/06.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/07.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/08.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
									<a class="dropdown-item" href="javascript:;">
										<div class="d-flex align-items-center gap-3">
											<div class="position-relative">
												<div class="cart-product rounded-circle bg-light">
													<img src="assets/images/products/09.png" class="" alt="product image">
												</div>
											</div>
											<div class="flex-grow-1">
												<h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
												<p class="cart-product-price mb-0">1 X $29.00</p>
											</div>
											<div class="">
												<p class="cart-price mb-0">$250</p>
											</div>
											<div class="cart-product-cancel"><i class="bx bx-x"></i>
											</div>
										</div>
									</a>
								</div>
								<a href="javascript:;">
									<div class="text-center msg-footer">
										<div class="d-flex align-items-center justify-content-between mb-3">
											<h5 class="mb-0">Total</h5>
											<h5 class="mb-0 ms-auto">$489.00</h5>
										</div>
										<button class="btn btn-primary w-100">Checkout</button>
									</div>
								</a>
							</div>
							</li>
							<!-- <li>
								<a href="<?= site_url('user/profile'); ?>">
									<i class="bx bx-user"></i>
									<span>Profile</span>
								</a>
							</li> -->

						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<?php
						// Safe session fetch (prevents notices on all pages)
						$userPhoto = $this->session->userdata('photo');
						$userName  = $this->session->userdata('user_name');
						$userRole  = $this->session->userdata('role');
						?>

						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
							href="<?= site_url('user/profile'); ?>"
							role="button"
							data-bs-toggle="dropdown"
							aria-expanded="false">

							<img
								src="<?= !empty($userPhoto)

											? base_url('uploads/profile/' . $userPhoto)
											: base_url('assets/images/avatars/avatar-2.png'); ?>"
								class="user-img rounded-circle"
								alt="user avatar"
								width="40"
								height="40"
								style="object-fit: cover;">

							<div class="user-info">
								<p class="user-name mb-0 fw-semibold">
									<?= htmlspecialchars($userName ?: 'User'); ?>

								</p>
								<p class="designattion mb-0 text-muted small">
									<?= htmlspecialchars($userRole ?: 'Member'); ?>
								</p>
							</div>
						</a>


						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->