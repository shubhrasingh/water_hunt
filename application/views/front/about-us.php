<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>About Us - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


  <?php $this->load->view('front/common/css.php'); ?>

<link  href="<?php echo base_url(); ?>assets/front/css/datepicker.css" rel="stylesheet"> <!-- 3 KB -->

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->
     <!-- fotorama.css & fotorama.js. -->
   
   <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
   <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
   <style type="text/css">
    .bootstrap-select > .dropdown-toggle {
    background: #ffffff none repeat scroll 0 0;
    } 
    .liststyle
    {
        padding: 5px !important;
        list-style: disc !important;
    }
    .overlay-blue:before
    {
        background: rgb(38, 34, 97);
    }
    .overlay-blue
    {
        padding-bottom: 0; 
    }
    .download-apps-title h3
    {
        color: #f6921e;
        font-size: 26px;
    }
   </style>       
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
    <?php $this->load->view('front/common/header.php'); ?>
    
        
          <!--Breadcrumbs start-->
        <div class="breadcrumbs overlay-black p0" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            <div class="breadcrumbs-title text-center pull-left pt6 pb6">
                                <h1>ABOUT US</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb10">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>About Us</li>
                                </ul>
                              
                            </div>
              
                        </div>

                    </div>
          
              
                </div>
            </div>
        </div>
        <!--Breadcrumbs end-->
     
   
        
        <!--Welcome Haven section end-->

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


        <!--Download apps section start-->
        <div class="download-apps overlay-blue">
            <div class="container">
                <div class="row">
                    <div class="download-app-inner">
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="download-apps-desc wow fadeInDown" data-wow-delay="0.1s">
                                <div class="download-apps-title">
                                    <h3 class="title-1">Create A Merchant Account</h3>
                                    <h3 class="title-2">AND add Your Own Water Park And events. </h3>
                                </div>
                                <div class="download-apps-bottom">
                                    <p> After Create A Merchants account Add your Water Park And Events </p>
                                    <a href="<?php echo  base_url(); ?>register" style="background:#f6921e none repeat scroll 0 0; ">Register</a> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="download-apps-caption-img f-right wow fadeUp" data-wow-duration="1.2s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1.2s; animation-delay: 0.2s; animation-name: fadeUp;">
                                <img style="width: 80%; " src="<?php echo base_url(); ?>assets/front/images/register.png" alt="">
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!--Download apps section end-->
        
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


        <!--Awesome Feature section end-->


        
         
    

        <?php $this->load->view('front/common/footer.php'); ?>
    
    </div>
  
  <?php $this->load->view('front/common/js.php'); ?>

  <script src="<?php echo base_url(); ?>assets/front/js/starrr.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>


   
   
</body>
</html>