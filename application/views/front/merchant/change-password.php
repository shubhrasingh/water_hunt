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
                                <h1>Change Password</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Change Password</li>
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
						
                         <div class="col-md-9 col-sm-8 col-xs-12">
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
                                      $urlUpdate=base_url().'merchant/change-password';
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