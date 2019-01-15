<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $siteDetails['companyData']['0']->company_name; ?> | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php $this->load->view('front/common/css.php'); ?>
	
    <link  href="<?php echo base_url(); ?>assets/front/css/datepicker.css" rel="stylesheet"> <!-- 3 KB -->

</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
	  <?php $this->load->view('front/common/header.php'); ?>
	  
       
        <div class="slider-area">
        <div class="slider-container overlay home-2" >
            <div id="mainSlider" class="nivoSlider slider-image">
                <?php 
                if (count($sliderimage))
                { 
                    $i=1; 
                    foreach($sliderimage as $image) {
                ?>

                     <img src="<?php echo base_url(); ?>assets/front/uploads/slider/<?php echo $image->image; ?>" alt="<?php echo $siteDetails['companyData']['0']->company_name; ?>" title="#htmlcaption<?php echo $i; ?>"/>

                <?php  $i++; 
                }
            }
            else
                { ?>
                <img src="<?php echo base_url(); ?>assets/front/images/banner-2.jpg" alt="" title="#htmlcaption1"/>
                <img src="<?php echo base_url(); ?>assets/front/images/banner-2.jpg" alt="" title="#htmlcaption2"/>
                <img src="<?php echo base_url(); ?>assets/front/images/banner-3.jpg" alt="" title="#htmlcaption3"/>
                <?php }  ?>
               

            </div>

             <?php 
                if (count($sliderimage))
                {   
                    $i=1; 
                    foreach($sliderimage as $rw) {
                ?>
        <div id="htmlcaption<?php echo  $i; ?>" class="nivo-html-caption slider-caption-1">
               <div class="display-table">
                    <div class="display-tablecell">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slide1-text">
                                        <div class="middle-text">
                                           <!--  <div class="title-1 wow fadeUp" data-wow-duration="0.9s" data-wow-delay="0s">
                                                <h3>WANT TO BOOK WATER PARK TICKET?</h3>
                                            </div>  --> 
                                            <div class="title-2 wow fadeUp" data-wow-duration="1.9s" data-wow-delay="0.1s">
                                                <h1><?php echo $rw->title; ?></h1>
                                            </div>  
                                            <div class="desc wow fadeUp" data-wow-duration="1.2s" data-wow-delay="0.2s">
                                               <?php
												if($rw->description!="")
												{
												?>
                                                <p><?php echo $rw->description; ?></p>
												<?php
												  }
												?>
                                            </div>
                                            <div class="contact-us wow fadeUp" data-wow-duration="1.3s" data-wow-delay=".5s">
                                               <!--  <a href="#">BOOK NOW</a> -->
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
                     
                <?php  $i++; 
                }
            }
			?>
            
        </div>
        <!--Find home area start-->
            <div class="finde-home-postion">
                <div class="container">
                    <div class="find-home-box postion">
                        <div class="find-home-box-inner">
                        <div class="find-home-title">
                            <h3>BOOK TICKET</h3>
                        </div>
                            <?php
                              if($this->session->userdata('WhLoggedInUserType')=='merchant') { 
                                $user_type_booking="merchant";
                               }
                               else
                               {
                                $user_type_booking="user";
                               }

                               $attributes=array('id' => 'booking_form');
                               echo form_open('ticket-request',$attributes);

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
                                <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
                                <input type="hidden" name="page_type" value="index">
                                <input type="hidden" id="booking_user_type" name="booking_user_type" value="<?php echo $user_type_booking; ?>">

                                <div class="find-home-cagtegory">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item custom-select ">                  
                                                <select class="selectpicker" name="merchant_id" title="Select Park" data-hide-disabled="true" data-live-search="true" required>
                                                    <?php
                                                    $tblMerchants=$this->db->dbprefix.'merchants';
                                                    $getCity=$this->Admin_model->getQuery("SELECT DISTINCT waterpark_city FROM $tblMerchants WHERE status='1' and `booking_availability`='1'");
                                                    foreach($getCity as $crt)
                                                    {
                                                        $ctyNm=$crt->waterpark_city;
                                                        $getPark=$this->Admin_model->getWhere('merchants',array('waterpark_city' => $ctyNm,'status' => 1));
                                                        ?>
                                                            <optgroup label="<?php echo $crt->waterpark_city; ?>">
                                                                <?php
                                                                 foreach($getPark as $prk)
                                                                 {
                                                                ?>
                                                                  <option value="<?php echo $prk->id; ?>"><?php echo $prk->waterpark_name; ?></option>
                                                                <?php
                                                                 }
                                                                 ?>
                                                            </optgroup>

                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item">                  
                                                <input type="text" name="name" placeholder="Your Name" required>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item">
                                                <input type="email" name="email" placeholder="Email Id" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item ">
                                                <input type="text" name="mobile" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item ">
                                                <input type="text" name="address" placeholder="Address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item ">
                                                <input type="text" class="datepicker" name="visiting_date" placeholder="Visiting Date" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item no-caret  custom-select">                  
                                                <input type="text"  name="number_of_adults" placeholder="Number of Adults" required>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item no-caret  custom-select">                  
                                                <input type="text"  name="number_of_children" placeholder="Number of Children" required>
                                            </div> 
                                        </div>

                                    <div class="find-home-bottom">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="find-home-item">
                                               <button type="submit" name="book_now">BOOK NOW</button>

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
        <!--Find home area end-->
    </div>
        <!--slider section end-->
        

        <!--Feature property section start-->
        <div class="property-area fadeInUp wow ptb-30" data-wow-delay="0.2s">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="feature-property-title">
                            <h3>WATER <span>PARKS</span></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="sale">
                            <div class="property-list">
                                <?php
                                foreach($waterParks as $parkRw)
                                {
                                        $parkId=$parkRw->id;
                                        $parkName=strtolower($parkRw->waterpark_name);

                                        $parkName = preg_replace('/\s+/', '-', $parkName);
                                        $randPrefix=rand(100,999);
                                        $randSubfix=rand(100,999);
                                        $urlId=$randPrefix.$parkId.$randSubfix;
                                        $urlKey=$parkName.'-'.$urlId;
                                ?>
                                <div class="col-md-4">
                                    <div class="single-property">
                                        <div class="property-img">
                                            <a href="<?php echo base_url(); ?>park-detail/<?php echo $urlKey; ?>">
                                                <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $parkRw->waterpark_logo; ?>" alt="<?php echo $parkRw->waterpark_name; ?>" style="height: 250px;">
                                            </a>
                                        </div>
                                        <div class="property-desc">
                                            <div class="property-desc-top">
                                                <h6><a href="<?php echo base_url(); ?>park-detail/<?php echo $urlKey; ?>"><?php echo $parkRw->waterpark_name; ?></a></h6>
                                                <h4 class="price">₹ <?php echo $parkRw->entry_fee_per_person; ?> / person</h4>
                                                <div class="property-location">
                                                    <p><img src="<?php echo base_url(); ?>assets/front/images/icon-5.png" alt=""> <?php echo $parkRw->waterpark_city; ?> , <?php echo $parkRw->waterpark_state; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="welcome-haven bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 fadeInLeft wow welcome-pd" data-wow-delay="0.2s">
                        <div class="welcome-title">
                            <h3 class="title-1">WELCOME TO <span>WATER HUNT</span></h3>
                            <h4 class="title-2">WE ALWAYS PROVIDE PRORITY TO OUR CUSTOMER</h4>
                        </div>
                        <div class="welcome-content">
                            <p> We provide service all over India. We have always tried are candid efforts to give the best possible entertainment to our customers & we are overeuhelmed by the response which we get.</p>
                        </div>
                        <div class="welcome-services">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="w-single-services">
                                        <div class="services-img">
                                            <img src="<?php echo base_url(); ?>assets/front/images/icon-1.png" alt="">
                                        </div>
                                        <div class="services-desc">
                                            <h6>Low Cost</h6>
                                            <p>Get yourself registered at very  <br> low and earn more.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="w-single-services">
                                        <div class="services-img">
                                            <img src="<?php echo base_url(); ?>assets/front/images/icon-2.png" alt="">
                                        </div>
                                        <div class="services-desc">
                                            <h6>Good Marketing </h6>
                                            <p>Registering yourself with us<br>will give you good marketing.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="w-single-services">
                                        <div class="services-img">
                                            <img src="<?php echo base_url(); ?>assets/front/images/icon-3.png" alt="">
                                        </div>
                                        <div class="services-desc">
                                            <h6>Easy to Find</h6>
                                            <p>Visit us to find your water<br>  park easily.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="w-single-services">
                                        <div class="services-img">
                                            <img src="<?php echo base_url(); ?>assets/front/images/icon-4.png" alt="">
                                        </div>
                                        <div class="services-desc">
                                            <h6>Reliable</h6>
                                            <p>Reliable in both,listing <br>  your park and booking ticket. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="welcome-haven-img fadeInRight wow" data-wow-delay="0.2s">
                            <img src="<?php echo base_url(); ?>assets/front/images/about.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="services-section ptb-30 bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>OUR <span>SERVICES</span></h3>
                            <p>We have multiple services.You can list your water park to get more and more people in your park.You can also buy online tickets for any water park.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-sm-12">
                        <div class="single-services wow fadeInUp text-center" data-wow-duration="1.3s" data-wow-delay="0.2s">
                            <div class="single-services-img">
                                <img src="<?php echo base_url(); ?>assets/front/images/service-3.png" alt="">
                            </div>
                            <div class="single-services-desc">
                                <h5>Online Ticket Booking</h5>
                                <p>You can book tickets for any water park.Fill your detail and pay the amount to get the tickets.</p>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-4 col-sm-12">
                        <div class="single-services wow fadeInUp text-center" data-wow-duration="1.5s" data-wow-delay="0.4s">
                            <div class="single-services-img">
                                <img src="<?php echo base_url(); ?>assets/front/images/service-1.png" alt="">
                            </div>
                            <div class="single-services-desc">
                                <h5>Water Park Listing</h5>
                                <p>List your water park to get more and more people.People can buy tickets for your water park online..</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-sm-12">
                        <div class="single-services wow fadeInUp text-center" data-wow-duration="1.4s" data-wow-delay="0.2s">
                            <div class="single-services-img">
                                <img src="<?php echo base_url(); ?>assets/front/images/service-2.png" alt="">
                            </div>
                            <div class="single-services-desc">
                                <h5>Theme Parties</h5>
                                <p>List your events and parties which are going to be organised in your water park.People can buy tickets for it online.</p>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        
        <div class="feature-property ptb-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>OUR <span>EVENTS</span></h3>
                            <p>These events provide Water hunt members with the opportunity to connect with their fellow water leisure professionals, either in person or through online meetings. </p>
                        </div>
                    </div>
                </div>
                <div class="row">
				<div class="property_list">
                                <div class="single_property_list">
                                    <?php
                                    foreach($recentEvents as $rwEv)
                                    {
                                        $eventId=$rwEv->id;
                                        $merchantId=$rwEv->merchant_id;
                                        $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
                                        $eventName=strtolower($rwEv->name);

                                        $eventName = preg_replace('/\s+/', '-', $eventName);
                                        $randPrefix=rand(100,999);
                                        $randSubfix=rand(100,999);
                                        $urlId=$randPrefix.$eventId.$randSubfix;
                                        $urlKey=$eventName.'-'.$urlId;
                                    ?>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                         <a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>">
                                            <div class="single_property mb-30">
                                                <div class="single_propert_img">
                                                    <a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>"><img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $rwEv->image; ?>" alt="" style="width:100%;height:210px"></a>
                                                </div>
                                                <div class="single_property-text">
                                                    <div class="single_property_inner">
                                                        <h4><a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>"><?php echo $rwEv->name; ?> <br> <small style="font-size: 12px;color: white;"><?php echo $getMerchant[0]->waterpark_name; ?></small></a></h4>
                                                        <p><?php echo date('j F,Y',strtotime($rwEv->start_date)); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                         </a>
                                    </div>
									<?php
                                     }
                                    ?>
                                 
                                </div>
                            </div>
                </div>
            </div>
        </div>
        
        <div class="awesome-feature bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>AWESOME <span>FEATURES</span></h3>
                            <p>Water Hunt  the best theme for  elit, sed do eiusmod tempor dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lorna aliquatd minimam, quis nostrud exercitation.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="awesome-feature-desc">
                            <div class="awesome-feature-img">
                                <div class="awesome-feature-img-border">
                                    <div class="awesome-feature-img-inner">
                                        <img src="<?php echo base_url(); ?>assets/front/images/feature.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="awesome-feature-list">
                                <div class="col-4 left">
                                    <div class="single-awesome-feature one mb-87 wow fadeInLeft" data-wow-delay="0.2s" data-wow-duration="1.2s">
                                        <div class="s-awesome-feature-head">
                                            <div class="s-awesome-feature-title">
                                                <h6>Fully Furnished</h6>
                                            </div>
                                            <div class="s-awesome-feature-text">
                                                <p>Paint cost provides ar best for <br> elit, sed do eiusmod tempe</p>
                                            </div>
                                        </div>
                                        <div class="s-awesome-feature-icon">
                                            <i class="icofont icofont-tools-alt-2"></i>
                                        </div>
                                    </div>
                                    <div class="single-awesome-feature two mb-87 wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1.3s">
                                        <div class="s-awesome-feature-head">
                                            <div class="s-awesome-feature-title">
                                                <h6>Royal Touch Paint</h6>
                                            </div>
                                            <div class="s-awesome-feature-text">
                                                <p>Paint cost provides ar best for <br> elit, sed do eiusmod tempe</p>
                                            </div>
                                        </div>
                                        <div class="s-awesome-feature-icon">
                                            <i class="icofont icofont-paint-brush"></i>
                                        </div>
                                    </div>
                                    <div class="single-awesome-feature three wow fadeInLeft" data-wow-delay="0.3s" data-wow-duration="1.4s">
                                        <div class="s-awesome-feature-head">
                                            <div class="s-awesome-feature-title">
                                                <h6>Non Stop Security</h6>
                                            </div>
                                            <div class="s-awesome-feature-text">
                                                <p>Paint cost provides ar best for <br> elit, sed do eiusmod tempe</p>
                                            </div>
                                        </div>
                                        <div class="s-awesome-feature-icon">
                                            <i class="zmdi zmdi-bug"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 right">
                                    <div class="single-awesome-feature four mb-87 wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="1.2s">
                                        <div class="s-awesome-feature-icon">
                                            <i class="icofont icofont-calculations"></i>
                                        </div>
                                        <div class="s-awesome-feature-head">
                                            <div class="s-awesome-feature-title">
                                                <h6>Latest Interior Design</h6>
                                            </div>
                                            <div class="s-awesome-feature-text">
                                                <p>Paint cost provides ar best for <br> elit, sed do eiusmod tempe</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-awesome-feature five mb-87 wow fadeInRight" data-wow-delay="0.3s" data-wow-duration="1.3s">
                                        <div class="s-awesome-feature-icon">
                                            <i class="fa fa-leaf" ></i>
                                        </div>
                                        <div class="s-awesome-feature-head">
                                            <div class="s-awesome-feature-title">
                                                <h6>Living Inside a Nature</h6>
                                            </div>
                                            <div class="s-awesome-feature-text">
                                                <p>Paint cost provides ar best for <br> elit, sed do eiusmod tempe</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-awesome-feature six wow fadeInRight" data-wow-delay="0.2s" data-wow-duration="1.4s">
                                        <div class="s-awesome-feature-icon">
                                            <i class="icofont icofont-fix-tools"></i>
                                        </div>
                                        <div class="s-awesome-feature-head">
                                            <div class="s-awesome-feature-title">
                                                <h6>Luxurious Fittings</h6>
                                            </div>
                                            <div class="s-awesome-feature-text">
                                                <p>Paint cost provides ar best for <br> elit, sed do eiusmod tempe</p>
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
       
	   <div class="fun-fact overlay-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="singe-fun-fact  f-left">
                            <div class="fun-head">
                                <div class="fun-icon">
                                    <i class="fa fa-tint"></i>
                                </div>
                                <div class="fun-count">
                                    <h3 class="counter">999</h3>
                                </div>
                            </div>
                            <div class="fun-text">
                                <p>Water Parks</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="singe-fun-fact middle">
                            <div class="fun-head">
                                <div class="fun-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="fun-count">
                                    <h3 class="counter">567</h3>
                                </div>
                            </div>
                            <div class="fun-text">
                                <p>Events</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="singe-fun-fact text-center middle-2">
                            <div class="fun-head">
                                <div class="fun-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="fun-count">
                                    <h3 class="counter">450</h3>
                                </div>
                            </div>
                            <div class="fun-text">
                                <p>Clients</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 hidden-sm col-xs-12">
                        <div class="singe-fun-fact f-right">
                            <div class="fun-head">
                                <div class="fun-icon">
                                    <i class="zmdi zmdi-mood"></i>
                                </div>
                                <div class="fun-count">
                                    <h3 class="counter">120</h3>
                                </div>
                            </div>
                            <div class="fun-text">
                                <p>Happy Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="latest-blog ptb-40">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>UPCOMING <span>EVENTS</span></h3>
                            <p>Preview the following list of Water hunt Events. These events provide Water hunt members with the opportunity to connect with their fellow water leisure professionals, either in person or through online meetings.  To learn more about an upcoming event, click the event titles in blue</p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php
                    foreach($upcomingEvents as $upr)
                    {
                        $startDate=$upr->start_date;
                        $day=date('j',strtotime($startDate));
                        $month=date('M',strtotime($startDate));

                        $eventId=$upr->id;
                        $eventName=strtolower($upr->name);

                        $eventName = preg_replace('/\s+/', '-', $eventName);
                        $randPrefix=rand(100,999);
                        $randSubfix=rand(100,999);
                        $urlId=$randPrefix.$eventId.$randSubfix;
                        $urlKey=$eventName.'-'.$urlId;
                    ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-blog wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="1s">
                            <div class="blog-thubmnail">
                                <a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>">
                                    <img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $upr->image; ?>" alt="">
                                </a>
                                <div class="blog-post">
                                    <span class="post-day">
                                        <?php echo $day; ?>
                                    </span>
                                    <span class="post-month">
                                        <?php echo $month; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="blog-desc">
                                <h6><a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>"><?php echo $upr->name; ?></a></h6>
								<p class="post-content"><?php echo substr($upr->description,0,250); ?>...</p>
								<div class="bolg-continue">
                                    <a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>">Continure Reading  &gt;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                      }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="happy-client wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1.3s">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-title text-center">
                            <h3>REVIEW OF OUR <span>HAPPY CLIENTS</span></h3>
                            <p>Water hunt  the best theme for  elit, sed do eiusmod tempor dolor sit amet, conse ctetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et lorna aliquatd minimam, quis nostrud exercitation.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="happy-client-list">
					
                         <?php foreach($testimonial as $testimonials) {  ?>
								<div class="col-md-3">
									<div class="client-reveiw">
										<div class="review-quote">
											<i class="fa fa-quote-right"></i>
										</div>
										<div class="review-desc">
											<p><?php echo  $testimonials->comment; ?></p>
										</div>
										<div class="happy-client-name">
											<h6><?php echo  $testimonials->name; ?></h6>
										</div>
									</div>
								</div>
								<?php 
								}
								?>
                    </div>
                </div>
            </div>
        </div>
        
         <?php if(count($waterpark_brand)) {?>
        <div class="brand-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="brand-list">
                            
                           <?php foreach($waterpark_brand as $parkimage) {?>
                            <div class="single-brand">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo  $parkimage->waterpark_logo; ?>" alt="" style="height:100px; "></a>
                            </div>

                        <?php } ?>
                            


                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <?php } ?>
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>

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
                            <input type="hidden" name="page_type" value="index">
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
	
	<?php $this->load->view('front/common/js.php'); ?>
	
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>

    
    <script type="text/javascript">
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
</body>
</html>