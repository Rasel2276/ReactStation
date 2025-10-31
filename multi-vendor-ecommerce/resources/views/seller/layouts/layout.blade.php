<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

	<title>@yield('Seller_page_title')</title>

	<link href="{{asset('admin_asset/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">Seller Dashboard</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>

					<li class="sidebar-item {{request()->routeIs('vendor')?'active':''}}">
						<a class="sidebar-link" href="{{route('vendor')}}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-header">
						Product
					</li>

					<li class="sidebar-item {{request()->routeIs('product.create')?'active':''}}">
						<a class="sidebar-link" href="{{route('product.create')}}">
              <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add product</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('product.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('product.manage')}}">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage product</span>
            </a>
					</li>


					<li class="sidebar-item {{request()->routeIs('product.return_product_customer')?'active':''}}">
						<a class="sidebar-link" href="{{route('product.return_product_customer')}}">
              <i class="align-middle" data-feather="repeat"></i> <span class="align-middle">Return product</span>
            </a>
					</li>

					<li class="sidebar-header">
						Order
					</li>

					<li class="sidebar-item {{request()->routeIs('order.order_list')?'active':''}}">
						<a class="sidebar-link" href="{{route('order.order_list')}}">
              <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Manage Order</span>
            </a>
					</li>

					<li class="sidebar-header">
						Inventory Management
					</li>

					<li class="sidebar-item {{request()->routeIs('inventory.vendor_purchase')?'active':''}}">
						<a class="sidebar-link" href="{{route('inventory.vendor_purchase')}}">
              <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Purchase</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('inventory.manage_stock')?'active':''}}">
						<a class="sidebar-link" href="{{route('inventory.manage_stock')}}">
              <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Manage Stock</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('inventory.vendor_purchase_return')?'active':''}}">
						<a class="sidebar-link" href="{{route('inventory.vendor_purchase_return')}}">
              <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Purchase Return</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('inventory.admin_product_list')?'active':''}}">
						<a class="sidebar-link" href="{{route('inventory.admin_product_list')}}">
              <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Admin Product List</span>
            </a>
					</li>
					

					<li class="sidebar-header">
						Store
					</li>

					<li class="sidebar-item {{request()->routeIs('store.create')?'active':''}}">
						<a class="sidebar-link" href="{{route('store.create')}}">
              <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Store</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('store.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('store.manage')}}">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage Store</span>
            </a>
					</li>

					<li class="sidebar-header">
						Product Discount
					</li>

					<li class="sidebar-item {{request()->routeIs('discount.create_discount_vendor')?'active':''}}">
						<a class="sidebar-link" href="{{route('discount.create_discount_vendor')}}">
              <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Discount</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('discount.manage_discount_vendor')?'active':''}}">
						<a class="sidebar-link" href="{{route('discount.manage_discount_vendor')}}">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage Discount</span>
            </a>
					</li>


					<li class="sidebar-header">
						Payment
					</li>

					<li class="sidebar-item {{request()->routeIs('payment.payout_request')?'active':''}}">
						<a class="sidebar-link" href="{{route('payment.payout_request')}}">
              <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Payout Request</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('payment.payout_paid_list')?'active':''}}">
						<a class="sidebar-link" href="{{route('payment.payout_paid_list')}}">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Payout Paid List</span>
            </a>
					</li>

						<li class="sidebar-item {{request()->routeIs('payment.payout_pending_list')?'active':''}}">
						<a class="sidebar-link" href="{{route('payment.payout_pending_list')}}">
              <i class="align-middle" data-feather="loader"></i> <span class="align-middle">Payout Pending List</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('payment.refund')?'active':''}}">
						<a class="sidebar-link" href="{{route('payment.refund')}}">
              <i class="align-middle" data-feather="send"></i> <span class="align-middle">Refund</span>
            </a>
					</li>

					<li class="sidebar-header">
						Contact
					</li>

					<li class="sidebar-item {{request()->routeIs('contact.chat_with_customer')?'active':''}}">
						<a class="sidebar-link" href="{{route('contact.chat_with_customer')}}">
              <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Chat With Customer</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('contact.chat_with_admin')?'active':''}}">
						<a class="sidebar-link" href="{{route('contact.chat_with_admin')}}">
              <i class="align-middle" data-feather="inbox"></i> <span class="align-middle">Chat With Admin</span>
            </a>
					</li>

					<li class="sidebar-header">
						History
					</li>

					<li class="sidebar-item {{request()->routeIs('history.total_income')?'active':''}}">
						<a class="sidebar-link" href="{{route('history.total_income')}}">
              <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Total Income</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('history.transection')?'active':''}}">
						<a class="sidebar-link" href="{{route('history.transection')}}">
              <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Transection</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('history.sales_report')?'active':''}}">
						<a class="sidebar-link" href="{{route('history.sales_report')}}">
              <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Sales Report</span>
            </a>
					</li>

					<li class="sidebar-item {{request()->routeIs('history.account_setting')?'active':''}}">
						<a class="sidebar-link" href="{{route('history.account_setting')}}">
              <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Account Setting</span>
            </a>
					</li>

				</ul>

				<div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<div class="d-grid">
							<a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

          @yield('seller_layout')

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{asset('admin_asset/js/app.js')}}"></script>

</body>

</html>