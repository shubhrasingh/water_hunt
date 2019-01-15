<!DOCTYPE html>
<html lang="en">
<head>
        
        <?php include('common/header-css.php'); ?>
        
    </head>
    <body class="compact-menu">
        <div class="overlay"></div>
        
        
       
        <main class="page-content content-wrap">

            <?php include('common/header.php'); ?>


            <?php include('common/sidebar.php'); ?>

            <div class="page-inner">
                <div class="page-title">
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo  base_url(); ?>admin/dashboard">Home</a></li>
                            <li class="active">Profile</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
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



                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="user-profile-panel panel panel-white">
                                <div class="panel-heading">
                                    <div class="panel-title">Logo</div> 
                                </div>
                                <div class="panel-body">
                                    <img src="<?php echo  base_url(); ?>assets/front/uploads/logo/<?php echo  $getProfile[0]->company_logo;  ?>" class="user-profile-image img-circle" alt="">
                                    <!-- <h4 class="text-center m-t-lg">Nick Doe</h4>
                                    <p class="text-center">UI/UX Designer</p> -->
                                    <hr>
                                    <ul class="list-unstyled text-center" style="text-align:left; ">
                                        <li><p><i class="icon-pointer m-r-xs"></i><?php echo  $getProfile[0]->company_address; ?></p></li>
                                        <li><p><i class="icon-envelope-open m-r-xs"></i><a href="mailto:<?php echo  $getProfile[0]->company_email; ?>"><?php echo  $getProfile[0]->company_email; ?></a></p></li>
                                        <li><p><i class="icon-link m-r-xs"></i><a href="<?php echo base_url(); ?>"><?php echo  base_url(); ?></a></p></li>
                                    </ul>
                                   <!--  <hr>
                                    <button class="btn btn-info btn-block"><i class="icon-plus m-r-xs"></i>Follow</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                           
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Profile</h4>
                                    <a href="<?php echo  base_url(); ?>admin/edit-company-profile" class="btn btn-warning modal-confirm pull-right">Edit Profile</a>
                                </div>
                                <div class="panel-body">
                                   
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1 "><b>Company Name :</b> <?php echo  $getProfile[0]->company_name; ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1"><b>Email address : </b><?php echo  $getProfile[0]->company_email; ?></label>
                                            </div>
                                        </div>
                                       
                                       <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1 "><b>Company Phone :</b> <?php echo  $getProfile[0]->company_phone; ?></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1 "><b>LinkedIn Link :</b><a href="<?php echo  $getProfile[0]->linkedin_link; ?>" target="_blank"> <?php echo  $getProfile[0]->linkedin_link; ?></a></label>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1 "><b>Facebook Link :</b><a href="<?php echo  $getProfile[0]->facebook_link; ?>" target="_blank"><?php echo  $getProfile[0]->facebook_link; ?></a></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1"><b>Twitter Link : </b> <a href="<?php echo  $getProfile[0]->twitter_link; ?>" target="_blank" > <?php echo  $getProfile[0]->twitter_link; ?></a></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                             <div class="col-md-12">
                                                <label for="exampleInputEmail1"><b>Address : </b><?php echo  $getProfile[0]->company_address; ?></label>
                                            </div>
                                        </div>

                                       <hr/>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1 "><b>Username :</b> <?php echo  $getProfile[0]->email; ?></label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1"><b>Password  : </b><?php echo  $getProfile[0]->password; ?></label>
                                            </div>
                                            <div class="col-md-2">
                                                 <a href="<?php echo  base_url(); ?>admin/change-password" class="btn btn-primary modal-confirm pull-right">Change Password</a>
                                            </div>
                                        </div>
                                       
                                        
                                       
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
	

       
        <?php include('common/footer-js.php'); ?>

    </body>
</html>