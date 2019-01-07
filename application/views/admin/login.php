<!doctype html>
<html class="fixed">
<head>

	  <title><?php echo $siteDetails['0']->company_name; ?></title>
   
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="<?php echo $siteDetails['0']->company_name; ?>" />
      <meta name="keywords" content="<?php echo $siteDetails['0']->company_name; ?>" />
      <meta name="author" content="<?php echo $siteDetails['0']->company_name; ?>" />
      <!-- Favicon icon -->
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo  base_url(); ?>assets/front/images/fav.png">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/animate/animate.css">

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/font-awesome/css/fontawesome-all.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/theme.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url(); ?>assets/admin/vendor/modernizr/modernizr.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/master/style-switcher/style.switcher.localstorage.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="<?php echo base_url(); ?>" class="logo float-left" target="_blank">
					<img src="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" height="85" alt="<?php echo $siteDetails['0']->company_name; ?>" />
				</a>

				<div class="panel card-sign">
					<div class="card-title-sign mt-3 text-right">
						<h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign In</h2>
					</div>
					<div class="card-body">
					
					            <?php
								if($this->session->flashdata('error')!='')
								{
								?>
								<div class="alert alert-danger">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										  <?php echo $this->session->flashdata('error'); ?>
								</div>
										  
								<?php
								}
								?>
								
								<?php
			
								if($this->session->flashdata('success')!='')
								{
								?>
								<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										  <?php echo $this->session->flashdata('success'); ?>
								</div>
										  
								<?php
								}
								?>
						<form action="<?php echo base_url(); ?>authenticate" method="post">
							<div class="form-group mb-3">
								<label>Email</label>
								<div class="input-group">
									<input name="username" type="text" autoComplete="Off" required class="form-control form-control-lg" />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-envelope"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-3">
								<div class="clearfix">
									<label class="float-left">Password</label>
									<!--<a href="pages-recover-password.html" class="float-right">Lost Password?</a>-->
								</div>
								<div class="input-group">
									<input name="password" autocomplete="off" required type="password" class="form-control form-control-lg" />
									<span class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4 text-right">
									<button type="submit" name="signin" class="btn btn-info mt-2" style="background-color: #003479;border-color: #003479 #003479 #003479;">Sign In</button>
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2018. All Rights Reserved.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url(); ?>assets/admin/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-cookie/jquery-cookie.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/master/style-switcher/style.switcher.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/vendor/popper/umd/popper.min.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/vendor/common/common.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/vendor/nanoscroller/nanoscroller.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/vendor/magnific-popup/jquery.magnific-popup.js"></script>	
		<script src="<?php echo base_url(); ?>assets/admin/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url(); ?>assets/admin/js/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>assets/admin/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>assets/admin/js/theme.init.js"></script>
	</body>
</html>