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
    <?php
            $merchantId=$this->session->userdata('WhUserLoggedinId');
            $tblRvw=$this->db->dbprefix.'customer_review';
            $getReview=$this->Admin_model->getQuery("SELECT SUM(rating) as reviewRate FROM $tblRvw WHERE merchant_id='$merchantId'");
            $getReviewCount=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt_rw FROM $tblRvw WHERE merchant_id='$merchantId'");

            $reviewRate=$getReview[0]->reviewRate;
            $userCount=$getReviewCount[0]->cnt_rw;
            if(($userCount!="") && ($userCount!='0'))
            {
                $fReview=$reviewRate / $userCount;
                $finalReview=round($fReview);
            }
            else
            {
                $finalReview='1';
            }

          ?>
          <!--Breadcrumbs start-->
        <div class="breadcrumbs overlay-black p0" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            <div class="breadcrumbs-title text-center pull-left pt6 pb6">
                                <h1>Edit Profile</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Edit Profile</li>
                                </ul>
                                 <ul style="margin-top: 10px;">
                                    <li>Customer Rating : </li>
                                    <li>
                                         <?php
                                         for($x=1;$x<=$finalReview;$x++)
                                         {
                                         ?>
                                           <i class="fa fa-star customerStar"></i> 
                                         <?php
                                         }
                                         ?>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
        <!--Breadcrumbs end-->
         <div class="agent-details-page pt-50">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12">
						
						    <?php
                             $image=$userDetails[0]->waterpark_logo;
                             $description=$userDetails[0]->description;
                             if(empty($image))
                             {
                                $image="avatar.png";
                             }

                             if(empty($description))
                             {
                                $description="Update Description of your water park";
                             }
                            ?>
                            <div class="agent-profile">
                                <div class="single-team">
                                    <div class="team-img">
                                        <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $image; ?>" alt="">
                                    </div>
                                    <div class="team-desc sidebar-team-desc">
                                        <div class="team-member-title">
                                            <h6><?php echo $userDetails[0]->name; ?></h6>
                                            <p><?php echo $userDetails[0]->waterpark_name; ?></p>
                                            <p style="margin: 10px 0px;"><a class="btn btn-sm btn-info btn-profile" href="<?php echo base_url(); ?>merchant/edit-profile">Edit Profile</a> <a class="btn btn-sm btn-danger btn-profile" href="<?php echo base_url(); ?>merchant/change-password">Change Password</a></p>
                                            
                                        </div>

                                    </div>

                                </div>

                            </div>
						   
                        </div>
						
                         <?php
						   $image=$userDetails[0]->waterpark_logo;
                             $description=$userDetails[0]->description;
                             if(empty($image))
                             {
                                $image="avatar.png";
                             }

                             if(empty($description))
                             {
                                $description="Update Description of your water park";
                             }

                         $parkLogo=$userDetails[0]->waterpark_logo;
                         $parkdesc=$userDetails[0]->description;
                         $waterpark_address=$userDetails[0]->waterpark_address;
                         $mobile_number=$userDetails[0]->mobile_number;
                         $alternate_mobile_number=$userDetails[0]->alternate_mobile_number;
                         $email=$userDetails[0]->email;
                         $entry_fee_per_person=$userDetails[0]->entry_fee_per_person;

                        ?>
                       
                         <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="contact-inquiry" style="margin-bottom: 20px;">
                                <div class="contact-inquiry-title">
                                    <h5>Update Profile</h5>
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
                                      $urlUpdate=base_url().'merchant/edit-profile';
                                      echo form_open_multipart($urlUpdate);
                                     ?>
                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>Water Park Name : </label>
                                                <input type="text" placeholder="Water park name" name="waterpark_name" required value="<?php echo $userDetails[0]->waterpark_name; ?>">
                                            </div>
                                            <div class="input-filed">
                                                <label>Your Name : </label>
                                                <input type="text" placeholder="Your Name" value="<?php echo $userDetails[0]->name; ?>" name="name" required >
                                            </div>
                                        </div>
                                         <div class="form-top">
                                            <div class="input-filed">
                                                <label>Email : </label>
                                                <input type="email" placeholder="Email" value="<?php echo $userDetails[0]->email; ?>" name="email" required readonly >
                                            </div>
                                            <div class="input-filed">
                                                <label>Water park Address : </label>
                                                <input type="text" placeholder="Water park address" name="waterpark_address" required value="<?php echo $userDetails[0]->waterpark_address; ?>">
                                            </div>
                                        </div>
                                          <div class="form-top">
                                            <div class="input-filed">
                                                <label>City : </label>
                                                <input type="text" placeholder="Water park city" value="<?php echo $userDetails[0]->waterpark_city; ?>" name="waterpark_city" required  >
                                            </div>
                                            <div class="input-filed">
                                                <label>State : </label>
                                                <input type="text" placeholder="Water park State" name="waterpark_state" required value="<?php echo $userDetails[0]->waterpark_state; ?>">
                                            </div>
                                        </div>
                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>Mobile Number : </label>
                                                <input type="text" placeholder="Phone" value="<?php echo $userDetails[0]->mobile_number; ?>" name="mobile_number" required>
                                            </div>
                                            <div class="input-filed">
                                                <label>Alternate Mobile Number : </label>
                                                <input type="text" placeholder="Alternate Mobile Number" value="<?php echo $userDetails[0]->alternate_mobile_number; ?>" name="alternate_mobile_number"  >
                                            </div>
                                        </div>
                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>Entry Fee Per Person : </label>
                                                <input type="text" placeholder="Entry Fee Per Person" value="<?php echo $userDetails[0]->entry_fee_per_person; ?>" name="entry_fee_per_person" required>
                                            </div>
                                            <div class="input-filed">
                                                <label>Water Park Logo : </label>
                                                <?php
                                                 $image=$userDetails[0]->waterpark_logo;
                                                 if(!empty($image))
                                                 {
                                                    ?>
                                                    <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $image; ?>" style="width:100px;" alt="">
                                                    <?php
                                                    $required="";
                                                 }
                                                 else
                                                 {
                                                    $required="required";
                                                 }
                                                 ?>
                                                <input type="file" name="logo" <?php echo $required; ?>> 

                                            </div>
                                        </div>
                                         <div class="form-bottom">
                                             <label>Water Park Description : </label>
                                            <textarea placeholder="Write description about the water park here" name="description" required ><?php echo $userDetails[0]->description; ?></textarea>
                                        </div>
                                        <div class="submit-form">
                                            <button type="submit" name="update">Submit</button>
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