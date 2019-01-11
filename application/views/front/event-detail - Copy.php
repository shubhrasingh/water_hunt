<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $getData[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="keyword" content="<?php echo $getData[0]->name; ?> , <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="description" content="<?php echo $getData[0]->description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Schema.org for Google -->

    <meta itemprop="name" content="<?php echo $getData[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta itemprop="description" content="<?php echo $getData[0]->description; ?>">
    <meta itemprop="type" content="image"/>
    <meta itemprop="image" content="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $getData[0]->image; ?>" />
                        
                        
                        
                        
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="<?php echo $getData[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="og:description" content="<?php echo $getData[0]->description; ?>">
    <meta name="og:image" content="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $getData[0]->image; ?>">
    <meta property="og:image:width" content="750">
    <meta property="og:image:height" content="506">
    <meta name="og:url" content="<?php echo base_url(); ?>event-detail/<?php echo $eventUrl; ?>">
    <meta name="og:site_name" content="<?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="og:type" content="website">
            <!-------------End Facebook--------->


            <!-- Twitter -->

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="twitter:title" content="<?php echo $getData[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="twitter:description" content="<?php echo $getData[0]->description; ?>">
    <meta name="twitter:image" content="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $getData[0]->image; ?>">



	<?php $this->load->view('front/common/css.php'); ?>
	
	<link  href="<?php echo base_url(); ?>assets/front/css/datepicker.css" rel="stylesheet"> <!-- 3 KB -->

	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->
     <!-- fotorama.css & fotorama.js. -->
	 
	 <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
	 <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->

								
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
	  <?php $this->load->view('front/common/header.php'); ?>
	  
        

        <!--Feature property section start-->
    
	      <?php
            $eventId=$getData[0]->id;
            $tblRvw=$this->db->dbprefix.'customer_review';
            $getReview=$this->Admin_model->getQuery("SELECT SUM(rating) as reviewRate FROM $tblRvw WHERE event_id='$eventId'");
            $getReviewCount=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt_rw FROM $tblRvw WHERE event_id='$eventId'");

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
                            
                            <div class="breadcrumbs-menu pull-right pt6 pb10">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li><?php echo $getData[0]->name; ?> </li>
                                </ul>
                              
                            </div>
							
                        </div>
						
						<div class="merchantDIv">
							<div class="col-md-6 col-sm-6 col-xs-12 ">
								<div class="merchantLogo" >
									<img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $getMerchant[0]->waterpark_logo; ?>" >
								</div>
								
								<div class="merchantDetail" >
									<h5><?php echo $getMerchant[0]->waterpark_name; ?></h5>
									<p><i class="fa fa-home"></i> <?php echo $getMerchant[0]->waterpark_city; ?> , <?php echo $getMerchant[0]->waterpark_state; ?></p>
								</div>
								
							</div>
							
							<div class="col-md-6 col-sm-6 col-xs-12 ">
								<div class="entry_price text-right pt5">
									<label><i class="fa fa-inr"></i> <?php echo $getData[0]->entry_fee_per_person; ?> / person</label>
								</div>
							</div>
						</div>
							
                    </div>
					
							
                </div>
            </div>
        </div>
        <!--Breadcrumbs end-->
     
	 
	    <div class="feature-property properties-list pt-50 pb5">
		
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 ">
                        <div class="single-property-details">
						    <div class="section-title">
                              <h3 style="padding-bottom: 15px;border-bottom: 1px solid #ccc;"><?php echo $getData[0]->name; ?> <div class="contact-social pull-right">
							        <label style="font-size: 12px;">Share : </label>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>event-detail/<?php echo $eventUrl; ?>" class="share-btn fb-btn" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="https://twitter.com/intent/tweet?ref_src=twsrc%5Etfw&text=<?php echo $getData[0]->name; ?>&tw_p=tweetbutton&url=<?php echo base_url(); ?>event-detail/<?php echo $eventUrl; ?>" class="share-btn tw-btn" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>event-detail/<?php echo $eventUrl; ?>" class="share-btn google-plus-btn" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    <a href="whatsapp://send?text=<?php echo base_url(); ?>event-detail/<?php echo $eventUrl; ?>" class="share-btn whatsapp-btn" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                </div></h3>
                            </div>
							
                            <div class="property-details-img">
							   
								<!-- 2. Add images to <div class="fotorama"></div>. -->
								<div class="fotorama" data-nav="thumbs" data-width="700" data-ratio="700/467" data-max-width="100%">
								  <img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $getData[0]->image; ?>">
								  
								  <?php
								  foreach($geteventGallery as $grt)
								  {
									  ?>
									   <img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $grt->image; ?>">
									  <?php
								  }
								  ?>
								</div>
                            </div>
                            <div class="single-property-description">
                                <div class="desc-title">
                                    <h5>Description</h5>
                                </div>
                                <div class="description-inner">
                                    <p class="text-1"><?php echo $getData[0]->description; ?></p>
                                   
                                </div>
                            </div>
                            <div class="condition-amenities" style="padding-top: 2%;">
                                <div class="row">
								
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="property-condition">
                                            <div class="condtion-title">
                                                <h5 style="margin-bottom: 20px;">Event Timing</h5>
                                            </div>
                                            <div class="property-condition-list">
                                                
                                                    <p><label>Start Date : </label> <?php echo date('F j,Y',strtotime($getData[0]->start_date)); ?></p>
                                       
                                                    <p><label>End Date : </label> <?php echo date('F j,Y',strtotime($getData[0]->end_date)); ?></p>
                                                
                                                    <p><label>Timing : </label> <?php echo date('g:i a',strtotime($getData[0]->time)); ?></p>
                                             
                                            </div>
                                        </div>
                                    </div>
									<div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="property-condition">
                                            <div class="condtion-title">
                                                <h5 style="margin-bottom: 20px;">Contact Details</h5>
                                            </div>
                                            <div class="property-condition-list">
                                                
                                                    <p><label>Email : </label> <?php echo $getMerchant[0]->email; ?></p>
                                       
                                                    <p><label>Contact : </label> <?php echo $getMerchant[0]->mobile_number; ?></p>
                                                
                                                    <p><label>Address : </label> <?php echo $getMerchant[0]->waterpark_address; ?> ,<?php echo $getMerchant[0]->waterpark_city; ?> , <?php echo $getMerchant[0]->waterpark_state; ?></p>
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php
							if(count($geteventReview)!=0)
							{
							?>
                            <div class="feedback">
                                <div class="feedback-title">
                                    <h5 style="border-bottom: 1px solid #ccc;padding-bottom: 1%;"><?php echo count($geteventReview); ?> Reviews</h5>
                                </div>
								<?php
								foreach($geteventReview as $rvw)
								{
									$user_id=$rvw->user_id;
									$rating=$rvw->rating;
									$getUser=$this->Admin_model->getWhere('users',array('id' => $user_id));
								?>
                                <div class="single-feedback mb-35 fix">
                                    <div class="feedback-img">
                                        <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/avatar.png" alt="">
                                    </div>
                                    <div class="feedback-desc">
                                        <div class="feedback-title">
                                            <h6><?php echo $getUser[0]->name; ?>
                                            <span class="pull-right"><?php
                                            for($a=1;$a<=$rating;$a++)
                                            {
                                            	?>
                                              <i class="fa fa-star eventStar"></i>
                                            	<?php
                                            }
                                            ?>
                                            </span>
                                            </h6>
                                        </div>
                                        <p class="feedback-post">
                                            <?php echo date('F j,Y',strtotime($rvw->added_on)); ?>
                                        </p>
                                        <p class="review-desc"><?php echo $rvw->comment; ?></p>
                                    </div>
                                </div>
                                <?php
							    }
								?>
                            </div>
							
							<?php
							}
							?>

							 <?php
                                if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0') || ($this->session->userdata('WhLoggedInUserType')=='user'))
			                    {
			                    	if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0'))
			                    	{
			                    		$userId="0";
			                    	}
			                    	else
			                    	{
			                    		$userId=$this->session->userdata('WhUserLoggedinId');
			                    	}
			                ?>
                            <div class="leave-review">
                                <div class="review-title">
                                    <h5 class="mb3">Leave a Review</h5>
                                     <?php
	                                if($this->session->flashdata('errorReview')!='')
	                                {
	                                ?>
	                                <div class="alert alert-danger">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                          <?php echo $this->session->flashdata('errorReview'); ?>
	                                </div>
	                                          
	                                <?php
	                                }
	                                ?>
	                                
	                                <?php
	            
	                                if($this->session->flashdata('successReview')!='')
	                                {
	                                ?>
	                                <div class="alert alert-success">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                          <?php echo $this->session->flashdata('successReview'); ?>
	                                </div>
	                                          
	                                <?php
	                                }
	                                ?>
                                </div>
                                <div class="review-inner">
                                	<?php 
		                              $attributes=array('id' => 'review_form');
		                              echo form_open('submit-review',$attributes);
		                            ?>

                                         <input type="hidden" name="event_id" value="<?php echo $getData[0]->id; ?>">
                                         <input type="hidden" name="merchant_id" value="<?php echo $getData[0]->merchant_id; ?>">
                                         <input type="hidden" id="review_user_id" name="user_id" value="<?php echo $userId; ?>">
                                         <input type="hidden" name="page_type" value="event_<?php echo $eventUrl; ?>">
	                                         
                                    	<div class="form-top" style="margin-bottom: 18px;">
                                            <div class='starrr' id='star2'></div>
										    <br />
										    <input type='hidden' name='rating' value='4' id='star2_input' />
                                        </div>

                                        <div class="form-bottom">
                                            <textarea placeholder="Write here" name="comment" required></textarea>
                                        </div>
                                        <div class="submit-form">
                                            <button type="submit" name="submit_review">SUBMIT REVIEW</button>
                                        </div>
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                            <?php
                             }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="sidebar right-side">
                           
                           <aside class="single-side-box search-property ratingSection mb33">
                                <div class="aside-title text-center ratingDiv">
                                    <h4 ><?php echo $finalReview; ?></h4> 
                                    <h5>  
                                    	<?php
                                         for($x=1;$x<=$finalReview;$x++)
                                         {
                                         ?>
                                           <i class="fa fa-star eventStar"></i> 
                                         <?php
                                         }
                                         ?>
                                     </h5>
                                </div>
                            </aside>

                           <aside class="single-side-box search-property">
                                <!--<div class="aside-title">
                                    <h5>Ticket Request</h5>
                                </div>-->
                                <div class="find_home-box">
                                	 <?php
		                                if($this->session->flashdata('errorMsg')!='')
		                                {
		                                ?>
		                                <div class="alert alert-danger">
		                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                                          <?php echo $this->session->flashdata('errorMsg'); ?>
		                                </div>
		                                          
		                                <?php
		                                }
		                                ?>
		                                
		                                <?php
		            
		                                if($this->session->flashdata('successMsg')!='')
		                                {
		                                ?>
		                                <div class="alert alert-success">
		                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                                          <?php echo $this->session->flashdata('successMsg'); ?>
		                                </div>
		                                          
		                                <?php
		                                }
		                                ?>
                                     <div class="elements-tab-1">
				                           
				                            <ul class="nav nav-tabs requestTabNav" >
				                            	<li class="active"><a href="#profile_1"  data-toggle="tab">Book Now</a></li>
				                                <li><a href="#profile_2"  data-toggle="tab">Enquire Now</a></li>
				                            </ul>
				                            <!-- Tab panes -->
				                            <div class="tab-content">
				                                <div class="tab-pane form_tab fade in active" id="profile_1">
				                                     <div class="find_home-box" style="padding:10px 5px">
				                                     	<p style="color: white;text-align: center;">Book your ticket now and enjoy your day.</p>
					                                    <div class="find_home-box-inner">
					                                        <?php
					                                        $arrtributes=array('id' => 'booking_form');
                                                            echo form_open('ticket-request',$arrtributes);
					                                       
						                                   if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0') || ($this->session->userdata('WhLoggedInUserType')=='merchant'))
									                    	{
									                    		$userId="0";
									                    	}
									                    	else
									                    	{
									                    		$userId=$this->session->userdata('WhUserLoggedinId');
									                    	}
			                    	                        ?>

					                                         <input type="hidden" name="event_id" value="<?php echo $getData[0]->id; ?>">
					                                         <input type="hidden" name="merchant_id" value="<?php echo $getData[0]->merchant_id; ?>">
					                                         <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
					                                         <input type="hidden" name="page_type" value="event_<?php echo $eventUrl; ?>">
						                                         

					                                            <div class="find-home-cagtegory">
					                                                <div class="row">
                                                                        <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="name" placeholder="Name" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="email" name="email" placeholder="Email" required>
					                                                        </div>
					                                                    </div>
					                                                     <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="mobile" placeholder="Mobile Number" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="address" placeholder="Address" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="number_of_adults" placeholder="Number fo Adults" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="number_of_children" placeholder="Number fo Children"  required>
					                                                        </div>
					                                                    </div>

                                                                        <div class="col-md-12" style="padding-bottom: 0px;">
					                                                        <div class="find-home-item ticket_input">
							                                                    <input class="span2 datepicker" size="16" type="text" name="visiting_date" placeholder="Visiting Date">
																			</div>
																		</div>

					                                                    <div class="find-home_bottom">
					                                                        <div class="col-md-12">
					                                                            <div class="find-home-item">
					                                                               <button type="submit" name="book_now"> Book Now </button>
					                                                            </div>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                            </div>
					                                        <?php echo form_close(); ?>
					                                        </div>
					                                    </div>
				                                </div>
				                                <div class="tab-pane form_tab fade" id="profile_2">
				                                    <div class="find_home-box" style="padding:10px 5px">
				                                    	<p style="color: white;text-align:center;">Have any query? Feel free to ask.</p>
					                                    <div class="find_home-box-inner">
					                                        <?php
                                                            echo form_open('ticket-request');
					                                         if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0') || ($this->session->userdata('WhLoggedInUserType')=='merchant'))
									                    	{
									                    		$userId="0";
									                    	}
									                    	else
									                    	{
									                    		$userId=$this->session->userdata('WhUserLoggedinId');
									                    	}
			                    	                        ?>

					                                         <input type="hidden" name="event_id" value="<?php echo $getData[0]->id; ?>">
					                                         <input type="hidden" name="merchant_id" value="<?php echo $getData[0]->merchant_id; ?>">
					                                         <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
					                                         <input type="hidden" name="page_type" value="event_<?php echo $eventUrl; ?>">
					                                            <div class="find-home-cagtegory">
					                                                <div class="row">
                                                                        <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="name" placeholder="Name" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="email" name="email" placeholder="Email" required>
					                                                        </div>
					                                                    </div>
					                                                     <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="mobile" placeholder="Mobile Number" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="address" placeholder="Address" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="number_of_adults" placeholder="Number fo Adults" required>
					                                                        </div>
					                                                    </div>

					                                                    <div class="col-md-6">
					                                                        <div class="find-home-item ticket_input">
					                                                            <input type="text" name="number_of_children" placeholder="Number fo Children" required>
					                                                        </div>
					                                                    </div>

                                                                        <div class="col-md-12">
					                                                        <div class="find-home-item ticket_input">
							                                                    <input class="span2 datepicker" name="visiting_date" size="16" type="text" placeholder="Visiting Date">
																			</div>
																		</div>

																		<div class="col-md-12" style="padding-bottom: 0px;">
					                                                        <div class="find-home-item ticket_input">
							                                                  <textarea name="message" placeholder="Message" required></textarea>
																			</div>
																		</div>

					                                                    <div class="find-home_bottom">
					                                                        <div class="col-md-12">
					                                                            <div class="find-home-item">
					                                                               <button type="submit" name="enquire_now"> Enquire Now </button>
					                                                            </div>
					                                                        </div>
					                                                    </div>
					                                                </div>
					                                            </div>
					                                        <?php echo form_close(); ?>
					                                        </div>
					                                    </div>
				                                </div>
				                            </div>
				                        </div>
                                    </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Feature property section end-->
        
         
     <!-- quick view start -->
    <div  class="modal fade" role="dialog" tabindex="-1" id="quick-view">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="register-page-form">
                        <div aria-label="Close" data-dismiss="modal" class="modal-header">
                            <span>x</span>
                        </div>
                        <div class="account-title">
                            <h5>Login</h5>
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
                        <?php 
                              echo form_open('login');
                        ?>
                        	<input type="hidden" name="page_type" value="event_<?php echo $eventUrl; ?>">
                        	<input type="hidden" name="user_type" value="user">
                            <div class="username">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="password">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="lost-password">
                               <p><a href="<?php echo base_url(); ?>register">Create an account ?</a></p>
                            </div>
                            <div class="login">
                                <button type="submit" name="submit">Sign in</button>
                            </div>
                       <?php 
                              echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>

	<script src="<?php echo base_url(); ?>assets/front/js/starrr.js"></script>
	<script src="<?php echo base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>

	  <script>
	  	$(function () {
		    $('#star2 a').on("click", function (e) {
		        e.preventDefault();
		    });
		});

	    var $s2input = $('#star2_input');
	    $('#star2').starrr({
	      max: 5,
	      rating: $s2input.val(),
	      change: function(e, value){
	        $s2input.val(value).trigger('input');
	      }
	    });

  $('#review_form').on('submit', function() {
  	   
  	   var uid=$('#review_user_id').val();
  	   if(uid=='0')
  	   {
  	   	 $('#quick-view').modal('show');
         return false;
  	   }
  	   else
  	   {
  	   	 return true;
  	   }
     });

    <?php
    if(($this->session->userdata('errorLogin')=='1') && ($this->session->userdata('errorLogin')!=''))
    {
    	?>
          $('#quick-view').modal('show');
    	<?php
    }
    ?>


$('.datepicker').datepicker();

  $('#booking_form').on('submit', function() {
  	   
  	   var uid=$('#booking_user_id').val();
  	   if(uid=='0')
  	   {
  	   	 $('#quick-view').modal('show');
         return false;
  	   }
  	   else
  	   {
  	   	 return true;
  	   }
     });

  </script>
   
</body>
</html>