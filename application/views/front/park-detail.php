<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $getData[0]->waterpark_name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="keyword" content="<?php echo $getData[0]->waterpark_name; ?> , <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="description" content="<?php echo $getData[0]->description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Schema.org for Google -->

    <meta itemprop="name" content="<?php echo $getData[0]->waterpark_name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta itemprop="description" content="<?php echo $getData[0]->description; ?>">
    <meta itemprop="type" content="image"/>
    <meta itemprop="image" content="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $getData[0]->waterpark_logo; ?>" />
                        
                        
                        
                        
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="<?php echo $getData[0]->waterpark_name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="og:description" content="<?php echo $getData[0]->description; ?>">
    <meta name="og:image" content="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $getData[0]->waterpark_logo; ?>">
    <meta property="og:image:width" content="750">
    <meta property="og:image:height" content="506">
    <meta name="og:url" content="<?php echo base_url(); ?>park-detail/<?php echo $parkUrl; ?>">
    <meta name="og:site_name" content="<?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="og:type" content="website">
            <!-------------End Facebook--------->


            <!-- Twitter -->

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="twitter:title" content="<?php echo $getData[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?>">
    <meta name="twitter:description" content="<?php echo $getData[0]->description; ?>">
    <meta name="twitter:image" content="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $getData[0]->waterpark_logo; ?>">



	<?php $this->load->view('front/common/css.php'); ?>
	
	<link  href="<?php echo base_url(); ?>assets/front/css/datepicker.css" rel="stylesheet"> <!-- 3 KB -->

	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->
     <!-- fotorama.css & fotorama.js. -->
	 
	 <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
	 <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
     
	 <?php
	 $profile_cover=$getData[0]->profile_cover;
     if(empty($profile_cover))
     {
        $profile_cover="default-cover.jpg";
     }

	 ?>
	  <style type="text/css">
	  	.breadcrumbsDetail
		{
			background: url(<?php echo base_url(); ?>assets/front/uploads/merchant-cover/<?php echo $profile_cover; ?>)no-repeat scroll center center / cover;
		}
	  </style>						
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
	  <?php $this->load->view('front/common/header.php'); ?>
	  
        

        <!--Feature property section start-->
    
	      <?php
            $parkId=$getData[0]->id;
            $tblRvw=$this->db->dbprefix.'customer_review';
            $getReview=$this->Admin_model->getQuery("SELECT SUM(rating) as reviewRate FROM $tblRvw WHERE merchant_id='$parkId' and `event_id`='0'");
            $getReviewCount=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt_rw FROM $tblRvw WHERE merchant_id='$parkId' and `event_id`='0'");

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
            
			                            $parkId=$getData[0]->id;
                                        $parkName=strtolower($getData[0]->waterpark_name);

                                        $parkName = preg_replace('/\s+/', '-', $parkName);
                                        $randPrefix=rand(100,999);
                                        $randSubfix=rand(100,999);
                                        $urlId=$randPrefix.$parkId.$randSubfix;
                                        $urlParkKey=$parkName.'-'.$urlId;
										
          ?>
		  
          <!--Breadcrumbs start-->
        <div class="breadcrumbs breadcrumbsDetail overlay-black" style="padding: 200px 0 20px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            
                            <div class="breadcrumbs-menu pull-right pt6 pb10">
                               <!--<ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li><?php echo $getData[0]->waterpark_name; ?> </li>
                                </ul>-->
                              
                            </div>
							
                        </div>
						
						<div class="merchantDIv">
							<div class="col-md-2 col-sm-2 col-xs-2 ">
								<div class="merchantLogo" >
									<a href="<?php echo base_url(); ?>park-detail/<?php echo $urlParkKey; ?>"><img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $getData[0]->waterpark_logo; ?>" ></a>
								</div>
							</div>

							<div class="col-md-10 col-sm-10 col-xs-10 ">
								
									<div class="col-md-9 col-sm-9 col-xs-9 p0">
										<div class="merchantDetail" >
											<h5><a href="<?php echo base_url(); ?>park-detail/<?php echo $urlParkKey; ?>"><?php echo $getData[0]->waterpark_name; ?></a></h5>
											<p><i class="fa fa-home"></i> <?php echo $getData[0]->waterpark_city; ?> , <?php echo $getData[0]->waterpark_state; ?></p>
											<?php
                                            $closed_on=$getClosedTiming[0]->closed_on;
                                            if($closed_on!="")
                                            {
                                            	?>

                                             <p><i class="fa fa-adjust"></i> Closed on <?php echo $closed_on; ?></p>
                                            	<?php
                                            }
                                           
											?>
											
										</div>
										
									</div>
									
									<div class="col-md-3 col-sm-3 col-xs-3 p0">
										<div class="entry_price share-options text-right pt5">
											<div class="contact-social pull-right">
			                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>park-detail/<?php echo $parkUrl; ?>" class="share-btn fb-btn" target="_blank"><i class="fa fa-facebook"></i></a>
			                                    <a href="https://twitter.com/intent/tweet?ref_src=twsrc%5Etfw&text=<?php echo $getData[0]->waterpark_name; ?>&tw_p=tweetbutton&url=<?php echo base_url(); ?>park-detail/<?php echo $parkUrl; ?>" class="share-btn tw-btn" target="_blank"><i class="fa fa-twitter"></i></a>
			                                    <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>park-detail/<?php echo $parkUrl; ?>" class="share-btn google-plus-btn" target="_blank"><i class="fa fa-google-plus"></i></a>
			                                    <a href="whatsapp://send?text=<?php echo base_url(); ?>park-detail/<?php echo $parkUrl; ?>" class="share-btn whatsapp-btn" target="_blank"><i class="fa fa-whatsapp"></i></a>
			                                </div>
										</div>
									</div>
							</div>



						<div class="merchantRatingDetail" style="width: 83%;top: 93px;left: 16%;">
				
							<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;margin: 0px;">
								
									<div class="col-md-12 col-sm-12 col-xs-12 p0">
									
										<div class="merchantDetail col-xs-12 p0" >
											<div class="col-sm-3 col-xs-12 p0">
												<div class="detailCounter">
													<?php

                                                    if($finalReview==1)
                                                    {
                                                        ?>
                                                          <h4 class="pt5">Not rated yet</h4> 
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                    	?>
	                                                    <h4 ><?php echo $finalReview; ?></h4> 
					                                    <h5>  
					                                    	<?php
					                                         for($x=1;$x<=$finalReview;$x++)
					                                         {
					                                         ?>
					                                           <i class="fa fa-star eventStarTop"></i> 
					                                         <?php
					                                         }
					                                         ?>
					                                     </h5>
                                                    	<?php
                                                    }
													?>
													
			                                    </div> 
											</div>
											<div class="col-sm-3 col-xs-12 p0">
												<div class="detailCounter">
												  <h4 >Fee</h4> 
			                                      <h5><i class="fa fa-inr"></i> <?php echo $getData[0]->entry_fee_per_person; ?> / person</h5>
											  </div>
											</div>
											<div class="col-sm-3 col-xs-12 p0">
												<div class="detailCounter">
												  <h4 ><i class="fa fa-comment"></i></h4> 
			                                      <h5><?php echo count($getReview); ?>  Reviews</h5>
											  </div>
											</div>

											<div class="col-sm-3 col-xs-12 p0">
												<div class="detailCounter">
												  <a class="btn btn-sm btn-info" onclick="gotodiv()" style="background: #262261;border: 1px solid #262261;margin-top: 10px;"> BOOK TICKET</a>
											  </div>
											</div>

										</div>
										
									</div>
							</div>

						</div>

						</div>

					   

                    </div>
					
							
                </div>
            </div>

            <div class="overlayCover"></div>	

        </div>
        <!--Breadcrumbs end-->
     
	 
	    <div class="feature-property properties-list pt-70 pb5">
		
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 ">
                        <div class="single-property-details">
						    <div class="section-title">
                              <h3 style="padding-bottom: 15px;border-bottom: 1px solid #ccc;"><?php echo $getData[0]->waterpark_name; ?> </h3>
                            </div>
							
                            <div class="property-details-img">
							   
								<!-- 2. Add images to <div class="fotorama"></div>. -->
								<div class="fotorama" data-nav="thumbs" data-width="700" data-ratio="700/467" data-max-width="100%">
								  <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $getData[0]->waterpark_logo; ?>">
								  
								  <?php
								  foreach($getGallery as $grt)
								  {
									  ?>
									   <img src="<?php echo base_url(); ?>assets/front/uploads/gallery/<?php echo $grt->image; ?>">
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
							
							<?php

							if(count($getMerchantReview)!=0)
							{
							?>
                            <div class="feedback">
                                <div class="feedback-title">
                                    <h5 style="border-bottom: 1px solid #ccc;padding-bottom: 1%;"><?php echo count($getMerchantReview); ?> Reviews</h5>
                                </div>
								<?php
								foreach($getMerchantReview as $rvw)
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

                                         <input type="hidden" name="event_id" value="0">
                                         <input type="hidden" name="merchant_id" value="<?php echo $getData[0]->id; ?>">
                                         <input type="hidden" id="review_user_id" name="user_id" value="<?php echo $userId; ?>">
                                         <input type="hidden" name="page_type" value="park_<?php echo $parkUrl; ?>">
	                                         
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
                        <div class="sidebar right-side pt-50">

                           <aside class="single-side-box search-property" id="bookTicketDiv" <?php if(count($getTiming)!=0) {
							?> style="display:none" <?php } ?>>
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

		                                    $booking_availability=$getData[0]->booking_availability;
		                                	if($booking_availability==1)
		                                	{
		                                		$clsBook="active";
			                                	$clsEnquire="";
			                                	$style='';

			                                	$clsBookDiv="in active";
			                                	$clsEnquireDiv="";
			                                	$stylewidth='';
		                                	}
		                                	else
		                                	{
		                                		$clsBook="";
			                                	$clsEnquire="active";
			                                	$style='style="display:none"';

			                                	$clsBookDiv="";
			                                	$clsEnquireDiv="in active";
			                                	$stylewidth='style="width:100%"';
		                                	}

		                                ?>

                                     <div class="elements-tab-1">
				                           
				                            <ul class="nav nav-tabs requestTabNav" >
				                            	<li class="<?php echo $clsBook; ?>" <?php echo $style; ?>><a href="#profile_1"  data-toggle="tab">Book Now </a></li>
				                                <li class="<?php echo $clsEnquire; ?>" <?php echo $stylewidth; ?>><a href="#profile_2"  data-toggle="tab">Enquire Now</a></li>
				                            </ul>
				                            <!-- Tab panes -->
				                            <div class="tab-content">
				                                <div class="tab-pane form_tab fade <?php echo $clsBookDiv ?>" id="profile_1" <?php echo $style; ?>>
				                                     <div class="find_home-box" style="padding:10px 5px">
				                                     	<p style="color: white;text-align: center;">Book your ticket now and enjoy your day.</p>
					                                    <div class="find_home-box-inner">
					                                        <?php
					                                        $arrtributes=array('id' => 'booking_form');
                                                            echo form_open('ticket-request',$arrtributes);
					                                       

					                                       if($this->session->userdata('WhLoggedInUserType')=='merchant') { 
							                                $user_type_booking="merchant";
							                               }
							                               else
							                               {
							                                $user_type_booking="user";
							                               }


						                                   if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0') || ($this->session->userdata('WhLoggedInUserType')=='merchant'))
									                    	{
									                    		$userId="0";
									                    	}
									                    	else
									                    	{
									                    		$userId=$this->session->userdata('WhUserLoggedinId');
									                    	}
			                    	                        ?>

					                                         <input type="hidden" name="event_id" value="0">
					                                         <input type="hidden" name="merchant_id" value="<?php echo $getData[0]->id; ?>">
					                                         <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
					                                         <input type="hidden" name="page_type" value="park_<?php echo $parkUrl; ?>">
						                                     <input type="hidden" id="booking_user_type" name="booking_user_type" value="<?php echo $user_type_booking; ?>">

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
				                                <div class="tab-pane form_tab fade <?php echo $clsEnquireDiv; ?>" id="profile_2">
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

					                                         <input type="hidden" name="event_id" value="0">
					                                         <input type="hidden" name="merchant_id" value="<?php echo $getData[0]->id; ?>">
					                                         <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
					                                         <input type="hidden" name="page_type" value="park_<?php echo $parkUrl; ?>">
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
							
							<?php
							if(count($getTiming)!=0)
							{
							?>
							<aside class="single-side-box feature">
                                <div class="aside-title">
                                    <h5>Timing</h5>
                                </div>
                                <div class="feature-property">
                                    <div class="row">
									 <div class="single-guide" style="height: auto;">
                                        <div class="guide-title" style="width: 100%;margin-left: 0px;padding-top: 20px;">
                                           
                                            <?php
                                            foreach($getTiming as $grt)
                                            {
                                            	   $closed_status=$grt->closed_status;
                                                   switch($closed_status)
                                                   {
                                                       case "1":
                                                         $time='<span style="color:red">Closed</span>';
                                                       break;
                                                       
                                                       case "0":
                                                         $start_time=date('g:i a',strtotime($grt->start_time));
                                                         $end_time=date('g:i a',strtotime($grt->end_time));
                                                         $time='<span >'.$start_time.' to '.$end_time.'</span>';
                                                       break;
                                                   }
                                            ?>
                                              <p><label><?php echo $grt->day_name; ?> : </label> <span class="pull-right"> <?php echo $time; ?> </span></p>
                                           <?php
                                           }
                                           ?>
                                        </div>
                                      </div>
										
                                    </div>
                                </div>
                            </aside>
							
                            <?php
							}
							?>
							
							<?php
								$mapLocation=$getData[0]->map_iframe;
								if($mapLocation!="")
								{
							?>
							
							<aside class="single-side-box guide">
                                <div class="property-buying-guide">
                                    <div class="single-guide" style="height: auto;padding: 0 10px;">
                                        <div class="guide-title" style="width: 100%;margin-left: 0px;">
                                            <h5 class="text-center pt5" ><a href="#" style="font-weight: bold;border-bottom: 1px solid #000;font-size:15px"><?php echo $getData[0]->waterpark_city; ?> , <?php echo $getData[0]->waterpark_state; ?></a></h5>
											<div id="mapLoc">
											  <?php echo $mapLocation; ?>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
							
							<?php
								}
							?>
                            
							<?php

                            if((count($upcomingEvents)!=0) || (count($pastEvents)!=0))
							{

								if((count($upcomingEvents)!=0))
								{
									$clsUpcoming="active";
									$clsPast="";
									$clsUpcomingDiv="in active";
									$clsPastDiv="";
								}
								else
								{
									$clsUpcoming="";
									$clsPast="active";
									$clsUpcomingDiv="";
									$clsPastDiv="in active";
								}
							?>
							<aside class="single-side-box feature">
                                <div class="aside-title">
                                    <h5>Other Events</h5>
                                </div>
                                <div class="feature-property">
                                    <div class="row">
									<div class="elements-tab-1">
				                           
				                            <ul class="nav nav-tabs requestTabNav" >
				                            	<li class="<?php echo $clsUpcoming; ?>"><a href="#upcoming_events"  data-toggle="tab">Upcoming Events</a></li>
				                                <li class="<?php echo $clsPast; ?>"><a href="#past_events"  data-toggle="tab">Past Events</a></li>
				                            </ul>
				                            <!-- Tab panes -->
				                            <div class="tab-content">
				                                <div class="tab-pane fade <?php echo $clsUpcomingDiv; ?> pt5" id="upcoming_events">
				                                     
														   <?php
														if(count($upcomingEvents)!=0)
														{
														   foreach($upcomingEvents as $rto)
														   {
																$eventId=$rto->id;
																$merchantId=$rto->merchant_id;
																$getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
																$eventName=strtolower($rto->name);

																$eventName = preg_replace('/\s+/', '-', $eventName);
																$randPrefix=rand(100,999);
																$randSubfix=rand(100,999);
																$urlId=$randPrefix.$eventId.$randSubfix;
																$urlKey=$eventName.'-'.$urlId;
														   ?>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="single-property">
																	<div class="property-img">
																		<a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>">
																			<img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $rto->image; ?>" alt="" style="width:165px;height:130px">
																		</a>
																	</div>
																	<div class="property-desc text-center" style="background: #262261 none repeat scroll 0 0;">
																		<div class="property-desc-top">
																			<h6 style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>"><?php echo $rto->name; ?></a></h6>
																			<h4 class="price" >on <?php echo date('j F,Y',strtotime($rto->start_date)); ?></h4>
																		</div>
																	</div>
																</div>
															</div>
															<?php
															}
														  }
														  else
														  {
														  	?>
                                                            <h5 class="text-center">No Upcoming Events</h5>
														  	<?php
														  }
														?>
				                                </div>
				                                <div class="tab-pane fade <?php echo $clsPastDiv; ?> pt5" id="past_events" >
				                                    <?php
				                                       if(count($pastEvents)!=0)
													   {
														   foreach($pastEvents as $rtop)
														   {
																$eventId=$rtop->id;
																$merchantId=$rtop->merchant_id;
																$getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
																$eventName=strtolower($rtop->name);

																$eventName = preg_replace('/\s+/', '-', $eventName);
																$randPrefix=rand(100,999);
																$randSubfix=rand(100,999);
																$urlId=$randPrefix.$eventId.$randSubfix;
																$urlKey=$eventName.'-'.$urlId;
														   ?>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="single-property">
																	<div class="property-img">
																		<a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>">
																			<img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $rtop->image; ?>" alt="" style="width:165px;height:130px">
																		</a>
																	</div>
																	<div class="property-desc text-center" style="background: #262261 none repeat scroll 0 0;">
																		<div class="property-desc-top">
																			<h6 style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>"><?php echo $rtop->name; ?></a></h6>
																			<h4 class="price">on <?php echo date('j F,Y',strtotime($rto->start_date)); ?></h4>
																		</div>
																	</div>
																</div>
															</div>
															<?php
															}
														  }
														  else
														  {
														  	?>
                                                            <h5 class="text-center">No Past Events</h5>
														  	<?php
														  }
														 ?>
				                                </div>
				                            </div>
				                        </div>
										
                                    </div>
                                </div>
                            </aside>

                            <?php
                            }
                            ?>
							
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
                        	<input type="hidden" name="page_type" value="park_<?php echo $parkUrl; ?>">
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
           var utype=$('#booking_user_type').val();
           if(utype=='merchant')
           {
                 alert('Please login as user to buy ticket')
                 return false;
           }
           else
           {
               if(uid=='0')
               {
                 $('#quick-view').modal('show');
                 return false;
               }
               else
               {
                return true;
               }
           }
     });

  </script>

   <script async type="text/javascript">
	  
	  
	  function gotodiv()
		{
			$("#bookTicketDiv").show();
		$('html,body').animate({
        scrollTop: $("#bookTicketDiv").offset().top - 160},
        'slow');
		}
		
    </script>
   
</body>
</html>