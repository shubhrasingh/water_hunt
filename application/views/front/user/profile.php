<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo $userDetails[0]->name; ?> - Water Hunt </title>
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
         <div class="agent-details-page pt-50">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    <div class="row"  style="margin-bottom: 20px;">
                       <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
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
                     
                         <?php
                         $name=$userDetails[0]->name;
                         $address=$userDetails[0]->address;
                         $mobile_number=$userDetails[0]->mobile;
                         $email=$userDetails[0]->email;

                        if(($address!="") && ($mobile_number!="") && ($email!=""))
                        {

                         $address=$userDetails[0]->address;
                         $mobile_number=$userDetails[0]->mobile;
                         $email=$userDetails[0]->email;
                         if(empty($address))
                         {
                            $address="Update water park address";
                         }

                         if(empty($mobile_number))
                         {
                            $mobile_number="Update mobile number";
                         }

                         if(empty($email))
                         {
                            $email="Update entry fee";
                         }
                         
                        ?>
                            <div class="contact-details">
                                <div class="contact-title">
                                    <h5>Contact Details   <a class="btn btn-sm btn-danger btn-profile  pull-right" href="<?php echo base_url(); ?>user/change-password">Change Password</a> <a class="btn btn-sm btn-info btn-profile pull-right" href="<?php echo base_url(); ?>user/edit-profile" style="margin-right: 10px;">Edit Profile</a> </h5>
                                    <p><i class="fa fa-home"></i> <?php echo $address; ?> </p>
                                </div>
                                <div class="contact-list">
                                    <ul>
                                        <li> <i class="fa fa-user"></i> <?php echo $name; ?> </li>
                                        <li> <i class="fa fa-phone"></i> <?php echo $mobile_number; ?> </li>
                                        
                                        <li> <i class="fa fa-envelope"></i> <?php echo $userDetails[0]->email; ?> </li>
                                       
                                    </ul>
                                </div>
                               <!-- <div class="contact-social">
                                    <a  href="#"><i class="fa fa-facebook"></i></a>
                                    <a  href="#"><i class="fa fa-twitter"></i></a>
                                    <a  href="#"><i class="fa fa-google-plus"></i></a>
                                </div>-->
                            </div>
                        
                        <?php
                          }
                          else
                          {
                            ?>
                        
                            <div class="contact-inquiry" style="margin-bottom: 20px;">
                                <div class="contact-inquiry-title">
                                    <h5>Update Profile  <a class="btn btn-sm btn-danger btn-profile  pull-right" href="<?php echo base_url(); ?>user/change-password">Change Password</a> <a class="btn btn-sm btn-info btn-profile pull-right" href="<?php echo base_url(); ?>user/edit-profile" style="margin-right: 10px;">Edit Profile</a> </h5>
                                </div>
                                <div class="contact-inquiry-form">
                                     <?php 
                                      //  $attributes=array('autocomplete' => 'off');
                                      $urlUpdate=base_url().'user/edit-profile';
                                      echo form_open_multipart($urlUpdate);
                                     ?>
                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>Your Name : </label>
                                                <input type="text" placeholder="Your Name" value="<?php echo $userDetails[0]->name; ?>" name="name" required >
                                            </div>
                                             <div class="input-filed">
                                                <label>Email : </label>
                                                <input type="email" placeholder="Email" value="<?php echo $userDetails[0]->email; ?>" name="email" required readonly >
                                            </div>
                                        </div>
                                         <div class="form-top">
                                            <div class="input-filed">
                                                <label>Mobile Number : </label>
                                                <input type="text" placeholder="Phone" value="<?php echo $userDetails[0]->mobile; ?>" name="mobile_number" required>
                                            </div>
                                            <div class="input-filed">
                                                <label>Address : </label>
                                                <input type="text" placeholder="Your address" name="address" required value="<?php echo $userDetails[0]->address; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="submit-form">
                                            <button type="submit" name="update">Submit</button>
                                        </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>
                        

                            <?php
                          }
                        ?>
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