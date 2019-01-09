<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Billing Detail - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
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
                                    <li>Billing Detail </li>
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
                    <div class="col-md-8 col-sm-12 col-xs-12 ">
                        <div class="single-property-details">
						   
                            <div class="leave-review mt0">
                                <div class="review-title">
                                    <h5 class="mb3" style="border-bottom: 1px solid #ddd;padding-bottom: 2%;">Fill Your Billing Details</h5>
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
                                <div class="review-inner">
                                	<?php 
		                              echo form_open();
		                            ?>

                                         <input type="hidden" name="ticket_request_id" value="<?php echo $getOrderDetail[0]->id; ?>">
                                        
                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>Name : </label>
                                                <input type="text" name="name" placeholder="Your name" value="<?php echo $getOrderDetail[0]->name; ?>" required>
                                            </div>
                                            <div class="input-filed">
                                                 <label>Email : </label>
                                                <input type="email" name="email" placeholder="Your email" value="<?php echo $getOrderDetail[0]->email; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>Mobile : </label>
                                                <input type="text" name="mobile" placeholder="Your mobile" value="<?php echo $getOrderDetail[0]->mobile; ?>" required>
                                            </div>
                                            <div class="input-filed">
                                                 <label>Address : </label>
                                                <input type="text" name="address" value="<?php echo $getOrderDetail[0]->address; ?>" placeholder="Your address" required>
                                            </div>
                                        </div>

                                        <div class="form-top">
                                            <div class="input-filed">
                                                <label>City : </label>
                                                <input type="text" name="city" placeholder="Your city" required>
                                            </div>
                                            <div class="input-filed">
                                                 <label>State : </label>
                                                <input type="text" name="state" placeholder="Your state" required>
                                            </div>
                                        </div>

                                         <div class="form-top">
                                            <div class="input-filed">
                                                <label>Country : </label>
                                                <input type="text" name="country" placeholder="Your country" required>
                                            </div>
                                            <div class="input-filed">
                                                 <label>Pincode : </label>
                                                <input type="text" name="pincode" placeholder="Your pincode" required>
                                            </div>
                                        </div>

                                        <?php
                                        $total_visitors=$getOrderDetail[0]->total_visitors;
                                        $total_amount=$getOrderDetail[0]->total_amount;
                                        $gross_total=$getOrderDetail[0]->gross_total;
                                        $total_gst=$gross_total - $total_amount;
                                        ?>
                                        
                                        <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
                                        <input type="hidden" name="total_gst" value="<?php echo $total_gst; ?>">
                                        <input type="hidden" name="final_amount" value="<?php echo $gross_total; ?>">
                                        <div class="submit-form">
                                            <button type="submit" name="submit">SUBMIT</button>
                                        </div>
                                   <?php echo form_close(); ?>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="sidebar right-side">
                           
                          <aside class="single-side-box guide">
                                <div class="property-buying-guide">
                                    <div class="single-guide" style="height: auto;">
                                        <div class="guide-title" style="width: 100%;margin-left: 0px;">
                                            <h5 class="text-center pt5" ><a href="#" style="font-weight: bold;border-bottom: 1px solid #000;">Order Detail</a></h5>
                                            <p><label>Total : </label> <span class="pull-right"> <i class="fa fa-inr"></i> <?php echo $total_amount; ?> </span></p>
                                            <p><label> GST : </label> <span class="pull-right"> <i class="fa fa-inr"></i> <?php echo $total_gst; ?></span></p>
                                            <p><label> Grand Total : </label> <span class="pull-right"><i class="fa fa-inr"></i> <?php echo $gross_total; ?></span></p>
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