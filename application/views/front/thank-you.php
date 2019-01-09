<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ticket Booked - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


	<?php $this->load->view('front/common/css.php'); ?>
	
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
                            
                            <div class="breadcrumbs-menu pull-right pt6 pb10">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Ticket Booked</li>
                                </ul>
                              
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
                   <div class="col-xs-12">
                      <h5 class="mb3" style="border-bottom: 1px solid #ddd;padding-bottom: 2%;text-align: center;color: green;"><i class="fa fa-smile-o" style="font-size: 60px;"></i> <br/>Ticket Booked Successfully.</h5>
                      <p>Thank you for choosing our services.Your ticket has been booked successfully.A mail has already been sent to you and the merchant for the same.Please save your ticket. </p>
                      <p class="text-center"><a  href="<?php echo base_url(); ?>assets/front/uploads/ticket/<?php echo $getData[0]->ticket; ?>" download>Click to Save Ticket</a></p>
                   </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div class="single-property-details" >
						   
                          <?php include('ticket-html.php'); ?>

                           
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