<!doctype html>
<html class="fixed sidebar-left-sm" data-style-switcher-options="{'sidebarSize': 'sm'}">
<head>

		  <title><?php echo $siteDetails[0]->company_name; ?></title>
    
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
		  <meta name="description" content="<?php echo $siteDetails['0']->company_name; ?>" />
		  <meta name="keywords" content="<?php echo $siteDetails['0']->company_name; ?>" />
		  <meta name="author" content="<?php echo $siteDetails['0']->company_name; ?>" />

		  <!-- Favicon icon -->
          <link rel="shortcut icon" type="image/x-icon" href="<?php echo  base_url(); ?>assets/front/images/fav.jpg">
	  
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/animate/animate.css">

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Specific Page Vendor CSS -->		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/jquery-ui/jquery-ui.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/jquery-ui/jquery-ui.theme.css" />	
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url(); ?>assets/admin/vendor/modernizr/modernizr.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/master/style-switcher/style.switcher.localstorage.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="<?php echo base_url(); ?>admin/dashboard" class="logo">	
					   <img src="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" width="75" height="35" alt="Porto Admin" />		
				    </a>	
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">		
					  <i class="fas fa-bars" aria-label="Toggle sidebar"></i>		
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="https://preview.oklerthemes.com/porto-admin/2.1.1/pages-search-results.html" class="search nav-form">
						<div class="input-group">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-append">
								<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fas fa-tasks"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="float-right badge badge-default">3</span>
									Tasks
								</div>
			
								<div class="content">
									<ul>
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left">Generating Sales Report</span>
												<span class="message float-right text-dark">60%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left">Importing Contacts</span>
												<span class="message float-right text-dark">98%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left">Uploading something big</span>
												<span class="message float-right text-dark">33%</span>
											</p>
											<div class="progress progress-xs light mb-1">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fas fa-envelope"></i>
								<span class="badge">4</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="float-right badge badge-default">230</span>
									Messages
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="img/%21sample-user.jpg" alt="Joseph Doe Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joseph Doe</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="img/%21sample-user.jpg" alt="Joseph Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="img/%21sample-user.jpg" alt="Joe Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joe Junior</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="img/%21sample-user.jpg" alt="Joseph Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fas fa-bell"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="float-right badge badge-default">3</span>
									Alerts
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fas fa-thumbs-down bg-danger text-light"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fas fa-lock bg-warning text-light"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fas fa-signal bg-success text-light"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2017</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" alt="<?php echo $adminDetails[0]->name; ?>" class="rounded-circle" data-lock-picture="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $adminDetails[0]->name; ?></span>
								<span class="role" style="text-transform:capitalize"><?php echo $this->session->userdata('LoggedInUserType'); ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/profile"><i class="fas fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>admin/change-password" ><i class="fas fa-lock"></i>Change Password</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url() ?>admin/logout"><i class="fas fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->