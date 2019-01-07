<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo $userDetails[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php $this->load->view('front/common/css.php'); ?>
	
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
	  <?php $this->load->view('front/common/header.php'); ?>
	  
       
          <!--Feature property section start-->
    
          <!--Breadcrumbs start-->
        <div class="breadcrumbs overlay-black p0" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            <div class="breadcrumbs-title text-center pull-left pt6 pb6">
                                <h1>Dashboard</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

            $image="avatar.png";

        ?>
        <!--Breadcrumbs end-->
        <!--Breadcrumbs end-->
         <div class="agent-details-page pt-50">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    <div class="row"  style="margin-bottom:20px">
                      
                         <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                            <div class="contact-inquiry" style="margin-bottom: 20px;">
                                <div class="contact-inquiry-title">
                                    <h5>Change Password</h5>
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
                                <div class="contact-inquiry-form">
                                     <?php 
                                      //  $attributes=array('autocomplete' => 'off');
                                      $urlUpdate=base_url().'user/change-password';
                                      echo form_open_multipart($urlUpdate);
                                     ?>
                                        <div class="form-bottom">
                                            <div class="input-filed">
                                                <label>New Password : </label>
                                                <input type="password" placeholder="New Password" name="new_password" required >
                                            </div>
                                           
                                        </div>
                                         <div class="form-bottom">
                                            <div class="input-filed">
                                                <label>Confirm Password : </label>
                                                <input type="text" placeholder="Re-enter new password"  name="confirm_password" required >
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="submit-form">
                                            <button type="submit" name="submit">Submit</button>
                                        </div>

                                    <?php echo form_close(); ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
    
        
        
        
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>
	
</body>
</html>