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
            $getReview=$this->Admin_model->getQuery("SELECT SUM(rating) as reviewRate FROM $tblRvw WHERE merchant_id='$merchantId' and `event_id`='0'");
            $getReviewCount=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt_rw FROM $tblRvw WHERE merchant_id='$merchantId' and `event_id`='0'");

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
                                <h1>Profile</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Profile</li>
                                </ul>
                                 <ul style="margin-top: 10px;">
                                    <li>Customer Rating : </li>
                                    <li>
                                         <?php
                                         if($finalReview==1)
                                         {
                                           ?>
                                             Not rated yet
                                           <?php
                                         }
                                         else
                                         {
                                             for($x=1;$x<=$finalReview;$x++)
                                             {
                                             ?>
                                               <i class="fa fa-star customerStar"></i> 
                                             <?php
                                             }
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
                    <div class="row"  style="margin-bottom: 20px;">
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

                        <div class="col-md-3 col-sm-4 col-xs-12">
                             <?php  $this->load->view('front/common/merchant-sidebar'); ?>
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

                        if(($waterpark_address!="") && ($parkLogo!="") && ($mobile_number!="") && ($email!="") && ($entry_fee_per_person!="") && ($parkdesc!=""))
                        {
                        ?>
                        <div class="col-md-5 col-sm-8 col-xs-12">
                            <div class="agent-description">
                                <div class="agent-text">
                                    <?php echo $description; ?>
                                </div>
                            </div>
							
                        </div>

                        <?php
                         $waterpark_address=$userDetails[0]->waterpark_address;
                         $mobile_number=$userDetails[0]->mobile_number;
                         $alternate_mobile_number=$userDetails[0]->alternate_mobile_number;
                         $email=$userDetails[0]->email;
                         $booking_availability=$userDetails[0]->booking_availability;
                         $entry_fee_per_person=$userDetails[0]->entry_fee_per_person;
                         if(empty($waterpark_address))
                         {
                            $waterpark_address="Update water park address";
                         }

                         if(empty($mobile_number))
                         {
                            $mobile_number="Update mobile number";
                         }

                         if(empty($entry_fee_per_person))
                         {
                            $entry_fee_per_person="Update entry fee";
                         }
                         else
                         {
                           $entry_fee_per_person='<i class="fa fa-inr"></i> '.$entry_fee_per_person .' / person';
                         }
                        ?>
                        <div class="col-md-4 col-sm-6 col-xs-12" >
                            <div class="contact-details bg-1">
                                <div class="contact-title" style="padding: 2%;">
                                    <h5 style="margin-bottom: 7px;font-size: 20px;margin-top: 7px;">Booking Availability   : 
                                      <span id="booking_availability"> 
                                          <?php
                                              switch($booking_availability)
                                              {
                                                case "1":
                                                   ?>
                                                     <a onclick="changeStatus('OFF')" class="btn btn-sm btn-success pull-right" style="font-size: 13px;padding: 0px 15px;height: 25px;line-height: 24px;">ON</a>
                                                   <?php
                                                   $txtMsg="User can book ticket online for your park.";
                                                   $color="green";
                                                break;

                                                case "2":
                                                   ?>
                                                     <a onclick="changeStatus('ON')"  class="btn btn-sm btn-danger pull-right"  style="font-size: 13px;padding: 0px 15px;height: 25px;line-height: 24px;">OFF</a>
                                                   <?php
                                                   $txtMsg="Online ticket booking is OFF for your park.";
                                                   $color="red";
                                                break;
                                              }

                                          ?>
                                      </span>
                                    </h5>
                                    <p id="booking_availability_text" style="font-size:12px;text-align:center;margin-bottom: 0px;color:<?php echo $color; ?>"><?php echo $txtMsg; ?></p>
                                   </div>
                                </div>

                             <div style="clear:both"></div>

                             <div class="contact-details bg-1" style="padding: 5%;margin-top: 10px;">
                                <div class="contact-title">
                                    <h5>Contact Details</h5>
                                    <p><i class="fa fa-home"></i> <?php echo $waterpark_address; ?> ,<?php echo $userDetails[0]->waterpark_city; ?>,<?php echo $userDetails[0]->waterpark_state; ?> </p>
                                </div>
                                <div class="contact-list">
                                    <ul>
                                        <li> <i class="fa fa-phone"></i> <?php echo $mobile_number; ?> </li>
                                        <?php
                                        if(!empty($alternate_mobile_number))
                                        {
                                        ?>
                                          <li> <i class="fa fa-phone"></i> <?php echo $alternate_mobile_number; ?>  </li>
                                        <?php
                                         }
                                        ?>
                                        <li> <i class="fa fa-envelope"></i> <?php echo $userDetails[0]->email; ?> </li>
                                        <li>Entry Fee : <?php echo $entry_fee_per_person; ?></li>
                                    </ul>
                                </div>
                               <!-- <div class="contact-social">
                                    <a  href="#"><i class="fa fa-facebook"></i></a>
                                    <a  href="#"><i class="fa fa-twitter"></i></a>
                                    <a  href="#"><i class="fa fa-google-plus"></i></a>
                                </div>-->
                            </div>
                        </div>

                        <?php
                          }
                          else
                          {
                            ?>
                         <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="contact-inquiry" style="margin-bottom: 20px;">
                                <div class="contact-inquiry-title">
                                    <h5>Update Profile</h5>
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

                            <?php
                          }
                        ?>
                    </div>
                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
    
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>

    <script type="text/javascript">
        function changeStatus(act)
            {   
             if (confirm('Are you sure you want to ' + act + ' this?')) {
                 
                 var base_url='<?php echo base_url(); ?>';
                 var md="booking_availability";
                 
                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/statusToggle", 
                     data: { mode : md , action : act},
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){
                            $('#booking_availability').html(data);  //as a debugging message.
                            switch(act)
                            {
                                case "ON":
                                   $('#booking_availability_text').html('User can book ticket online for your park');
                                   $('#booking_availability_text').css('color','green');
                                break;
                                
                                case "OFF":
                                   $('#booking_availability_text').html('Online ticket booking is OFF for your park.');
                                   $('#booking_availability_text').css('color','red');
                                break;
                            }
                            
                          }
                      });// you have missed this bracket
               }
            }
    </script>
	
</body>
</html>