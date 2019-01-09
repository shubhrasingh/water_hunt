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
                                    <li>Payment Failed </li>
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
                      <h5 style="border-bottom: 1px solid #ddd;padding-bottom: 2%;text-align: center;color: green;"><i class="fa fa-frown-o" style="font-size: 60px;"></i> <br/>Transaction Failed.</h5>
                      <p class="text-center"><b style="font-weight:bold"> Reason for Failure :  </b>Invalid Transaction. Please try again</p>
                      <p class="text-center"><a class="btn btn-sm btn-danger" href="<?php echo base_url(); ?>pay-now">Retry</a></p>
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