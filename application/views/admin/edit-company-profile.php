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
                            <li class="active">Edit Profile</li>
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
                                    <h4 class="panel-title">Update Profile</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data" >
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="company_name">Company Name :</label>
                                            <input type="text" value="<?php echo  $getProfile[0]->company_name;?>" name="company_name" class="form-control m-t-xxs" id="company_name" placeholder="Enter email">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="company_email">Email address</label>
                                            <input type="email" value="<?php echo  $getProfile[0]->company_email;?>" name="company_email" class="form-control m-t-xxs" id="company_email" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="company_number">Company Contact : </label>
                                            <input type="text" value="<?php echo  $getProfile[0]->company_phone;?>" name="company_number" class="form-control m-t-xxs" id="company_number" placeholder="company_number ">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="facebook_link">Facebook Link : </label>
                                            <input type="text" value="<?php echo  $getProfile[0]->facebook_link;?>"  name="facebook_link" class="form-control m-t-xxs" id="facebook_link" placeholder="facebook_link">
                                            </div>

                                            
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="twitter_link">Twitter Link : </label>
                                            <input type="text" value="<?php echo  $getProfile[0]->twitter_link;?>" name="twitter_link"  class="form-control m-t-xxs" id="twitter_link" placeholder="twitter_link ">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="linkedin_link">linkedIn Link : </label>
                                            <input type="text" value="<?php echo  $getProfile[0]->linkedin_link;?>" name="linkedin_link" class="form-control m-t-xxs" id="linkedin_link" placeholder="linkedin_link ">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="company_address">Company Address  : </label>
                                            
                                            <textarea name="company_address" class="form-control m-t-xxs" placeholder="company_address" ><?php echo  $getProfile[0]->company_address;?></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="twitter_link">Company Logo: </label>
                                           <input type="file" name="file" class="form-control" />
                                            </div>
                                            <div class="col-md-2">
                                                <img src="<?php echo  base_url(); ?>assets/front/uploads/logo/<?php echo  $getProfile[0]->company_logo;  ?>" class="img img-thumbnail" >
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary m-t-xs m-b-xs" name="update">Update</button>
                                    </form>
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
        <nav class="cd-nav-container" id="cd-nav">
            <header>
                <h3>DEMOS</h3>
            </header>
            <div class="col-md-6 demo-block demo-selected demo-active">
                <p>Dark<br>Design</p>
            </div>
            <div class="col-md-6 demo-block">
                <a href="http://stacksthemes.com/meteor/admin2/index.html"><p>Light<br>Design</p></a>
            </div>
            <div class="col-md-6 demo-block">
                <a href="http://stacksthemes.com/meteor/admin3/index.html"><p>Material<br>Design</p></a>
            </div>
            <div class="col-md-6 demo-block demo-coming-soon">
                <p>Horizontal<br>(Coming)</p>
            </div>
            <div class="col-md-6 demo-block demo-coming-soon">
                <p>Coming<br>Soon</p>
            </div>
            <div class="col-md-6 demo-block demo-coming-soon">
                <p>Coming<br>Soon</p>
            </div>
        </nav>
        <div class="cd-overlay"></div>
	

       
        <?php include('common/footer-js.php'); ?>

    </body>
</html>