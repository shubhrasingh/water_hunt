<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $siteDetails['companyData']['0']->company_name; ?> | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php $this->load->view('front/common/css.php'); ?>
	
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
	  <?php $this->load->view('front/common/header.php'); ?>
	  
        <div class="slider-area">
        <div class="slider-container overlay home-2" >
            <div id="mainSlider" class="nivoSlider slider-image">
                <img src="<?php echo base_url(); ?>assets/front/images/banner-2.jpg" alt="" title="#htmlcaption1"/>
                <img src="<?php echo base_url(); ?>assets/front/images/banner-2.jpg" alt="" title="#htmlcaption2"/>
                <img src="<?php echo base_url(); ?>assets/front/images/banner-3.jpg" alt="" title="#htmlcaption3"/>
            </div>
            <div id="htmlcaption1" class="nivo-html-caption slider-caption-1">
               <div class="display-table">
                    <div class="display-tablecell">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slide1-text">
                                        <div class="middle-text">
                                            <div class="title-1 wow fadeUp" data-wow-duration="0.9s" data-wow-delay="0s">
                                                <h3>WANT TO BOOK WATER PARK TICKET?</h3>
                                            </div>	
                                            <div class="title-2 wow fadeUp" data-wow-duration="1.9s" data-wow-delay="0.1s">
                                                <h1><span>WATER HUNT</span> SOLVE <br> YOUR PROBLEMS</h1>
                                            </div>	
                                            <div class="desc wow fadeUp" data-wow-duration="1.2s" data-wow-delay="0.2s">
                                                <p>We have a lot of water parks. <br> You want to choose and book any water park</p>
                                            </div>
                                            <div class="contact-us wow fadeUp" data-wow-duration="1.3s" data-wow-delay=".5s">
                                                <a href="#">BOOK NOW</a>
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
            <div id="htmlcaption2" class="nivo-html-caption slider-caption-1">
                <div class="display-table">
                    <div class="display-tablecell">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slide1-text">
                                        <div class="middle-text">
                                            <div class="title-1 wow fadeUp" data-wow-duration="0.9s" data-wow-delay="0s">
                                                <h3>WANT TO BOOK WATER PARK TICKET?</h3>
                                            </div>	
                                            <div class="title-2 wow fadeUp" data-wow-duration="1.9s" data-wow-delay="0.1s">
                                                <h1><span>WATER HUNT</span> SOLVE <br> YOUR PROBLEMS</h1>
                                            </div>	
                                            <div class="desc wow fadeUp" data-wow-duration="1.2s" data-wow-delay="0.2s">
                                                <p>We have a lot of water parks. <br> You want to choose and book any water park</p>
                                            </div>
                                            <div class="contact-us wow fadeUp" data-wow-duration="1.3s" data-wow-delay=".5s">
                                                <a href="#">BOOK NOW</a>
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
            <div id="htmlcaption3" class="nivo-html-caption slider-caption-1">
                <div class="display-table">
                    <div class="display-tablecell">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="slide1-text">
                                        <div class="middle-text">
                                            <div class="title-1 wow fadeUp" data-wow-duration="0.9s" data-wow-delay="0s">
                                                <h3>WANT TO BOOK WATER PARK TICKET?</h3>
                                            </div>	
                                            <div class="title-2 wow fadeUp" data-wow-duration="1.9s" data-wow-delay="0.1s">
                                                <h1><span>WATER HUNT</span> SOLVE <br> YOUR PROBLEMS</h1>
                                            </div>	
                                            <div class="desc wow fadeUp" data-wow-duration="1.2s" data-wow-delay="0.2s">
                                                <p>We have a lot of water parks. <br> You want to choose and book any water park</p>
                                            </div>
                                            <div class="contact-us wow fadeUp" data-wow-duration="1.3s" data-wow-delay=".5s">
                                                <a href="#">BOOK NOW</a>
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
        <!--Find home area start-->
            <div class="finde-home-postion">
                <div class="container">
                    <div class="find-home-box postion">
                        <div class="find-home-box-inner">
                        <div class="find-home-title">
                            <h3>BOOK TICKET</h3>
                        </div>
                            <form action="#">
                                <div class="find-home-cagtegory">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item custom-select ">                  
                                                <select class="selectpicker" title="Select Park" data-hide-disabled="true" data-live-search="true">
                                                    <optgroup disabled="disabled" label="disabled">
                                                        <option>Hidden</option>
                                                    </optgroup>
                                                    <optgroup label="Lucknow">
                                                        <option>Anandi Water Park</option>
                                                        <option>Nilansh Theme Park</option>
                                                        <option>Disney Water</option>
                                                    </optgroup>
                                                    <optgroup label="Kanpur">
                                                        <option>Diamond Aqua Park</option>
                                                        <option>Blue World</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item">                  
                                                <input type="text" name="min-area" placeholder="Your Name">
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item">
                                                <input type="text" name="min-area" placeholder="Email Id">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item ">
                                                <input type="text" name="max-area" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item no-caret  custom-select">                  
                                                <select class="selectpicker" title="No. of person" data-hide-disabled="true">
                                                    <optgroup  label="1">
                                                        <option label="1">1 Person</option>
                                                        <option>2 Person</option>
                                                        <option>3 Person</option>
                                                        <option>4 Person</option>
                                                        <option>5 Person</option>
                                                    </optgroup>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="find-home-item no-caret  custom-select">                  
                                                <select class="selectpicker" title="No. of Child" data-hide-disabled="true">
                                                    <optgroup label="2">
                                                        <option>1 Child</option>
                                                        <option>2 Child</option>
                                                        <option>3 Child</option>
                                                        <option>4 Child</option>
                                                        <option>5 Child</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                    <div class="find-home-bottom">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="find-home-item">
                                               <button type="submit">BOOK NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                ?>
                                <div class="col-md-4">
                                    <div class="single-property">
                                        <div class="property-img">
                                            <a href="#">
                                                <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $parkRw->waterpark_logo; ?>" alt="<?php echo $parkRw->waterpark_name; ?>" style="height: 250px;">
                                            </a>
                                        </div>
                                        <div class="property-desc">
                                            <div class="property-desc-top">
                                                <h6><a href="#"><?php echo $parkRw->waterpark_name; ?></a></h6>
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
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p> Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>James Bond, <span>CEO</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>Nirob Khan, <span>COO</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>Lara Craft, <span>CEO</span></h6> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>Zenefer Lopez, <span>CEO</span></h6> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>James Bond, <span>CEO</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>Nirob Khan, <span>COO</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>Lara Craft, <span>CEO</span></h6> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-reveiw">
                                <div class="review-quote">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                                <div class="review-desc">
                                    <p>Water hunt is the best theme for elit sed do od tempor dolor sit amet conse tetur adipiscingit</p>
                                </div>
                                <div class="happy-client-name">
                                    <h6>Zenefer Lopez, <span>CEO</span></h6> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="brand-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="brand-list">
                            <div class="single-brand">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/water-parks/anandi.png" alt="" style="height:100px"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/water-parks/dreamworld.png" alt="" style="height:100px"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/water-parks/nilansh.png" style="height:100px" alt=""></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/water-parks/swaraaj.png" alt="" style="height:100px"></a>
                            </div>
							<div class="single-brand">
                                <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/water-parks/dream-world.png" alt="" style="height:100px"></a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>
	
</body>
</html>