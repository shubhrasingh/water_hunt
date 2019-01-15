<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
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
    .ptb-20
    {
        padding:20px 0;
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
                                <h1>CONTACT</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb10">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Contact </li>
                                </ul>
                              
                            </div>
              
                        </div>

                    </div>
          
              
                </div>
            </div>
        </div>
        <!--Breadcrumbs end-->
     
   
       <!--Contact page start-->
        <div class="contact-page ptb-20 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="row">
                             <div class="leave-message">
                           
                                <div class="col-md-8 ">

                                     
                                    <div class="contact-form-inner">
                                        <div class="contact-form-title">
                                            <h5>Leave a Message</h5>
                                        </div>
                                              <?php
                                    if($this->session->flashdata('errorMsg')!='')
                                    {
                                    ?>
                                    <div class="alert alert-danger">
                                                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
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
                                                <a type="button" class="close" data-dismiss="alert" aria-hidden="true">×</a>
                                              <?php echo $this->session->flashdata('successMsg'); ?>
                                    </div>
                                              
                                    <?php
                                    }
                                    ?>
                                   
                                        <form id="" action="" method="post">
                                            <input name="name" type="text" placeholder="Your Name * ">
                                            <input  name="email" type="email" placeholder="Email here * ">
                                            <input  name="contact" type="number" placeholder="Mobile Here">

                                            <textarea name="message" placeholder="Write here * "></textarea>
                                            <div class="form-submit">
                                                <button type="submit" name="submit">Submit</button>
                                            </div>
                                            <p class="form-messege"></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-4">
                                  <div class="contact-list-inner ">
                                    <div class="row">
                                        
                                    <div class="single-contact_list">
                                        <div class="single-contact-icon">
                                            <img src="<?php echo base_url(); ?>assets/front/images/c-1.png" alt="">
                                        </div>
                                        <div class="single-contact-desc">
                                           <p><?php echo  substr($siteDetails['companyData'][0]->company_address,0,26); ?></p>

                                           <p><?php echo  substr($siteDetails['companyData'][0]->company_address,26,33); ?></p> 
                                           <p><?php echo  substr($siteDetails['companyData'][0]->company_address,59,60); ?></p> 

                                           
                                          <!--  <p><?php echo  substr($siteDetails['companyData'][0]->company_address,26,50); ?></p> 

                                           <p><?php echo  substr($siteDetails['companyData'][0]->company_address,78,100); ?></p>  -->
                                        </div>
                                    </div> <br/>
                                
                               
                                    <div class="single-contact_list">
                                        <div class="single-contact-icon">
                                            <img src="<?php echo base_url(); ?>assets/front/images/c-2.png" alt="">
                                        </div>
                                        <div class="single-contact-desc">
                                            <p>Telephone : <?php echo  substr($siteDetails['companyData'][0]->company_phone,0,10); ?></p>
                                            <p>Telephone : <?php echo  substr($siteDetails['companyData'][0]->company_phone,11,22); ?></p>
                                           
                                        </div>
                                    </div> <br/>
                                
                               
                                    <div class="single-contact_list">
                                        <div class="single-contact-icon">
                                            <img src="<?php echo base_url(); ?>assets/front/images/c-3.png" alt="">
                                        </div>
                                        <div class="single-contact-desc">
                                            <p>Email : <?php echo  $siteDetails['companyData'][0]->company_email; ?></p>
                                            <p>Web : www.waterhunt.com</p>
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
        <!--Contact page end-->




        
         
    
        
        <?php $this->load->view('front/common/footer.php'); ?>
    
    </div>
  
  <?php $this->load->view('front/common/js.php'); ?>

  <script src="<?php echo base_url(); ?>assets/front/js/starrr.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>


   
   
</body>
</html>