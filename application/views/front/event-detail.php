<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $getData[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php $this->load->view('front/common/css.php'); ?>
	
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
                            
                            <div class="breadcrumbs-menu pull-right pt6 pb8">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li><?php echo $getData[0]->name; ?> </li>
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
     
	 
	    <div class="feature-property properties-list pt-50">
		
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-xs-12 ">
                        <div class="single-property-details">
						    <div class="section-title">
                              <h3 style="padding-bottom: 15px;border-bottom: 1px solid #ccc;"><?php echo $getData[0]->name; ?> <div class="contact-social pull-right">
							        <label style="font-size: 12px;">Share : </label>
                                    <a href="#" class="share-btn fb-btn"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="share-btn tw-btn"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="share-btn google-plus-btn"><i class="fa fa-google-plus"></i></a>
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
                                    <h5><?php echo count($geteventReview); ?> Reviews</h5>
                                </div>
								<?php
								foreach($geteventReview as $rvw)
								{
								?>
                                <div class="single-feedback mb-35 fix">
                                    <div class="feedback-img">
                                        <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/avatar.png" alt="">
                                    </div>
                                    <div class="feedback-desc">
                                        <div class="feedback-title">
                                            <h6><?php echo $rvw->name; ?></h6>
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
                            <div class="leave-review">
                                <div class="review-title">
                                    <h5>Leave a Review</h5>
                                </div>
                                <div class="review-inner">
                                    <form action="#">
                                        <div class="form-top">
                                            <div class="input-filed">
                                                <input type="text" placeholder="Your name">
                                            </div>
                                            <div class="input-filed">
                                                <input type="text" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="form-bottom">
                                            <div class="input-field">
                                                <input type="text" placeholder="Subject">
                                            </div>
                                            <textarea placeholder="Write here"></textarea>
                                        </div>
                                        <div class="submit-form">
                                            <button type="submit">SUBMIT REVIEW</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="sidebar right-side">
                            <aside class="single-side-box search-property">
                                <div class="aside-title">
                                    <h5>Search for Property</h5>
                                </div>
                                <div class="find_home-box">
                                    <div class="find_home-box-inner">
                                        <form action="#">
                                            <div class="find-home-cagtegory">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="find-home-item custom-select ">                  
                                                            <select class="selectpicker" title="Location" data-hide-disabled="true" data-live-search="true">
                                                                <optgroup disabled="disabled" label="disabled">
                                                                    <option>Hidden</option>
                                                                </optgroup>
                                                                <optgroup label="Australia">
                                                                    <option>Sydney</option>
                                                                    <option>Melbourne</option>
                                                                    <option>Cairns</option>
                                                                </optgroup>
                                                                <optgroup label="USA">
                                                                    <option>South Carolina</option>
                                                                    <option>Florida</option>
                                                                    <option>Rhode Island</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="find-home-item custom-select">                  
                                                            <select class="selectpicker" title="Sub - Location" data-hide-disabled="true" data-live-search="true">
                                                                <optgroup disabled="disabled" label="disabled">
                                                                    <option>Hidden</option>
                                                                </optgroup>
                                                                <optgroup label="Australia">
                                                                    <option>southeastern coast</option>
                                                                    <option>southeastern tip</option>
                                                                    <option>northwest corner</option>
                                                                </optgroup>
                                                                <optgroup label="USA">
                                                                    <option>Charleston</option>
                                                                    <option>St. Petersburg</option>
                                                                    <option>Newport</option>
                                                                </optgroup>
                                                            </select>
                                                        </div> 
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="find-home-item">
                                                            <input type="text" name="min-area" placeholder="Min area (sqft)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="find-home-item ">
                                                            <input type="text" name="max-area" placeholder="Max area (sqft)">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="find-home-item no-caret  custom-select">                  
                                                            <select class="selectpicker" title="No. of Beadrooms" data-hide-disabled="true">
                                                                <optgroup  label="1">
                                                                    <option label="1">1 Beadrooms</option>
                                                                    <option>2 Beadrooms</option>
                                                                    <option>3 Beadrooms</option>
                                                                    <option>4 Beadrooms</option>
                                                                    <option>5 Beadrooms</option>
                                                                </optgroup>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="find-home-item no-caret  custom-select">                  
                                                            <select class="selectpicker" title="No. of Bathrooms" data-hide-disabled="true">
                                                                <optgroup label="2">
                                                                    <option>1 Bathrooms</option>
                                                                    <option>2 Bathrooms</option>
                                                                    <option>3 Bathrooms</option>
                                                                    <option>4 Bathrooms</option>
                                                                    <option>5 Bathrooms</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="find-home_bottom">
                                                        <div class="col-md-12">
                                                            <div class="find-home-item">
                                                                <!-- shop-filter -->
                                                                <div class="shop-filter">
                                                                    <div class="price_filter">
                                                                        <div class="price_slider_amount">
                                                                            <input type="submit"  value="price range"/> 
                                                                            <input type="text" id="amount" name="price"  placeholder="Add Your Price" /> 
                                                                        </div>
                                                                        <div id="slider-range"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="find-home-item">
                                                               <button type="submit">SEARCH PROPERTY </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                            </aside>
                            <aside class="single-side-box feature">
                                <div class="aside-title">
                                    <h5>Featured Property</h5>
                                </div>
                                <div class="feature-property">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="single-property">
                                                <div class="property-img">
                                                    <a href="single-properties.html">
                                                        <img src="img/property/7.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="property-desc text-center">
                                                    <div class="property-desc-top">
                                                        <h6><a href="single-properties.html">Friuli-Venezia Giulia</a></h6>
                                                        <h4 class="price">$52,354</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="single-property">
                                                <div class="property-img">
                                                    <a href="single-properties.html">
                                                        <img src="img/property/3.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="property-desc text-center">
                                                    <div class="property-desc-top">
                                                        <h6><a href="single-properties.html">Friuli-Venezia Giulia</a></h6>
                                                        <h4 class="price">$52,354</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="single-property">
                                                <div class="property-img">
                                                    <a href="single-properties.html">
                                                        <img src="img/property/5.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="property-desc text-center">
                                                    <div class="property-desc-top">
                                                        <h6><a href="single-properties.html">Friuli-Venezia Giulia</a></h6>
                                                        <h4 class="price">$52,354</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="single-property">
                                                <div class="property-img">
                                                    <a href="single-properties.html">
                                                        <img src="img/property/11.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="property-desc text-center">
                                                    <div class="property-desc-top">
                                                        <h6><a href="single-properties.html">Friuli-Venezia Giulia</a></h6>
                                                        <h4 class="price">$52,354</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                             <aside class="single-side-box agent">
                                <div class="aside-title">
                                    <h5>Our Agent</h5>
                                </div>
                                <div class="our-agent-sidbar">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-agent">
                                                <div class="agent-img">
                                                    <a href="agent-details.html">
                                                        <img src="img/team/1.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="agent-title">
                                                    <h6><a href="agent-details.html">Evan Smith</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-agent">
                                                <div class="agent-img">
                                                    <a href="agent-details.html">
                                                        <img src="img/team/2.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="agent-title">
                                                    <h6><a href="agent-details.html">Evan Smith</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-agent">
                                                <div class="agent-img">
                                                    <a href="agent-details.html">
                                                        <img src="img/team/3.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="agent-title">
                                                    <h6><a href="agent-details.html">Evan Smith</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-agent">
                                                <div class="agent-img">
                                                    <a href="agent-details.html">
                                                        <img src="img/team/4.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="agent-title">
                                                    <h6><a href="agent-details.html">Evan Smith</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-agent">
                                                <div class="agent-img">
                                                    <a href="agent-details.html">
                                                        <img src="img/team/5.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="agent-title">
                                                   <h6><a href="agent-details.html">Evan Smith</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-agent">
                                                <div class="agent-img">
                                                    <a href="agent-details.html">
                                                        <img src="img/team/6.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="agent-title">
                                                    <h6><a href="agent-details.html">Evan Smith</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <aside class="single-side-box tags">
                                <div class="aside-title">
                                    <h5>Tags</h5>
                                </div>
                                <div class="our-tag-list">
                                    <ul>
                                        <li><a href="#">Real Estate</a></li>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Appartment</a></li>
                                        <li><a href="#">Duplex villa</a></li>
                                        <li><a href="#">But property</a></li>
                                    </ul>
                                </div>
                            </aside>
                            <aside class="single-side-box video">
                                <div class="aside-title">
                                    <h5>Take a tour</h5>
                                </div>
                                <div class="video-sidebar">
                                    <div class="video-img">
                                        <img src="img/common/video.jpg" alt="">
                                    </div>
                                    <div class="play-button">
                                        <a href="https://youtu.be/vb5KLYAtPIs"><i class="fa fa-play"></i></a>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Feature property section end-->
        
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>
	
   
</body>
</html>