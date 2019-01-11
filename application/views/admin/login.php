<!DOCTYPE html>
<html lang="en">
<head>
        
        <!-- Title -->
        <title> <?php echo $siteDetails['0']->company_name; ?> </title>

         <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="<?php echo $siteDetails['0']->company_name; ?>" />
        <meta name="keywords" content="<?php echo $siteDetails['0']->company_name; ?>" />
        <meta name="author" content="<?php echo $siteDetails['0']->company_name; ?>" />


       <?php include('common/header-css.php'); ?>  


    </head>
    <body class="page-login">
        <main class="page-content">
            <div class="page-inner">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3 center">
                            <div class="panel panel-white" id="js-alerts">
                                <div class="panel-body">
                                    <div class="login-box">
                                        <a href="<?php echo base_url(); ?>admin/login" class="logo-name text-lg text-center m-t-xs"><?php echo $siteDetails['0']->company_name; ?></a>
                                        <p class="text-center m-t-md">Please login into your account.</p>
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
                                

                                        <form class="m-t-md" action="<?php echo base_url(); ?>authenticate" method="post" >
                                            <div class="form-group">
                                                <input type="email" name="username" class="form-control" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control password" placeholder="Password" required>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block" name="signin">Login</button>
                                          <!--   <a href="forgot.html" class="display-block text-center m-t-md text-sm">Forgot Password?</a> -->
                                            <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                            <!-- <a href="register.html" class="btn btn-default btn-block m-t-md">Create an account</a> -->
                                        </form>
                                        <p class="text-center m-t-xs text-sm"><?php echo date('Y');?> &copy; <?php echo $siteDetails['0']->company_name; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
	

       <?php include('common/footer-js.php'); ?>
        
    </body>
</html>