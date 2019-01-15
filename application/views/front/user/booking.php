<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo $userDetails[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php $this->load->view('front/common/css.php'); ?>
    
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
      <?php $this->load->view('front/common/header.php'); ?>
      
        

          <!--Feature property section start-->
    
          <!--Breadcrumbs start-->
        <div class="breadcrumbs overlay-black p0" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            <div class="breadcrumbs-title text-center pull-left pt6 pb6">
                                <h1>Booking</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Booking</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!--Breadcrumbs end-->
         <div class="agent-details-page pt-10">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    
                    <div class="row pb-120">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h3>All <span> Bookings</span> </h3>
                            </div>
                       </div>

                        <div class="col-md-12">
                            
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

                            <div id="msgDivAjax"></div>

                            
                           <div class="table-responsive">
                            <table class="table table-bordered  table-hover">
                                <thead> 
                                    <tr>
                                        <th>#</th> 
                                        <th>Name</th>
                                        <th>Booked For</th>
                                        <th>Total Amount</th>
                                        <th>Booked on</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    <?php
                                   if(count($getBooking)!='0')
                                   {
                                    $a=1;
                                    foreach($getBooking as $bkr)
                                    {
                                        $ticketId=$bkr->id;
                                        $merchantId=$bkr->merchant_id;
                                        $eventId=$bkr->event_id;
                                        $status=$bkr->payment_status;

                                        $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));

                                         if($eventId!='0')
                                         {
                                           $getEvent=$this->Admin_model->getWhere('merchants_events',array('id' => $eventId));
                                         }

                                         $getBillingDetail=$this->Admin_model->getWhere('ticket_billing_details',array('ticket_request_id' => $ticketId));


                                    ?>
                                    <tr id="tr_<?php echo $bkr->id; ?>">
                                        <th scope="row"><?php echo $a; ?></th>
                                        <td><?php echo $bkr->name; ?></td> 
                                         <td>
                                          <?php
                                            if($eventId!='0')
                                             {
                                               ?>
                                                 <b style="font-weight:bold">Event : </b> <?php echo $getEvent[0]->name;?> <br/>
                                                 <b style="font-weight:bold">Water park : </b> <?php echo $getMerchant[0]->waterpark_name;?>
                                               <?php
                                             }
                                             else
                                             {
                                               echo $getMerchant[0]->waterpark_name;
                                             }
                                              ?>
                                            </td> 
                                        <td><i class="fa fa-inr"></i> <?php echo $bkr->gross_total; ?></td> 
                                        <td><?php echo date('F j,Y g:i a',strtotime($bkr->requested_on)); ?> </td>
                                        <td id="st_<?php echo $bkr->id; ?>">
                                            <?php 
                                           switch($status)
                                            {
                                                case "0":
                                            ?>
                                                <button class="btn btn-sm btn-danger btn-mini">Unpaid</button>
                                            <?php
                                                break;

                                                case "1":
                                             ?>
                                                <button class="btn btn-sm btn-success btn-mini">Paid</button>
                                            <?php
                                                break;
                                            }
                                            ?>
                                           </td>
                                           <td> 

                                           <a href="<?php echo base_url(); ?>assets/front/uploads/ticket/<?php echo $getBillingDetail[0]->ticket; ?>"  download class=" btn btn-mini btn-primary"><i class="fa fa-download"></i></a>

                                           <button data-target="#quick-view"  data-toggle="modal" onclick="viewDetail(<?php echo $bkr->id; ?>)"   class="btn btn-sm btn-success btn-mini"><i class="fa fa-eye"></i></button>

                                           <button  onclick="delData(<?php echo $bkr->id; ?>)"  class="btn btn-sm btn-danger btn-mini"><i class="fa fa-trash"></i></button>

                                           <span id="sts_<?php echo $bkr->id; ?>">
                                           <?php
                                           $visit_date=$bkr->visit_date;
                                           $cDate=date('Y-m-d');
                                           $status=$bkr->status;
                                           if($cDate < $visit_date)
                                           {
                                              switch($status)
                                              {
                                                case "1";
                                                   ?>
                                                    <button data-target="#cancel-ticket"  data-toggle="modal" onclick="putBookingId(<?php echo $bkr->id; ?>)" class="btn btn-sm btn-info btn-mini">Cancel Booking</button>
                                                   <?php
                                                break;

                                                case "2":
                                                   $cancelledBy=$bkr->cancelled_by;
                                                   ?>
                                                   <button class="btn btn-sm btn-danger btn-mini">Cancelled</button><br/>
                                                    <p>
                                                      <span>Cancelled By : </span> <?php echo $cancelledBy; ?><br/>
                                                      <span>Reason : </span> <?php echo $bkr->cancellation_reason; ?>
                                                    </p>
                                                   <?php
                                                break;
                                              }
                                             ?>
                                               
                                             <?php
                                           }
                                           ?>
                                         </span>                                
                                        </td> 
                                    </tr> 
                                   <?php
                                   $a++;
                                    }
                                   }
                                   else
                                    {
                                        ?>
                                       <tr><td colspan="8" style="text-align:center">No Booking Found</td></tr>
                                        <?php
                                    }
                                   ?>
                                </tbody> 
                            </table>    
                        </div>
                           
                       </div>
                    </div>

                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
    
        
        <!-- quick view start -->
    <div  class="modal fade" role="dialog" tabindex="-1" id="cancel-ticket">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:540px">
                <div class="modal-body">
                    <div class="contact-inquiry" style="padding: 5% 0px;">
                        <div aria-label="Close" data-dismiss="modal" class="modal-header">
                          <span>x</span>
                        </div>
                
                        <div class="contact-inquiry-title" style="padding-bottom: 2%;border-bottom: 1px solid #ccc;padding-left: 3%;">
                            <h5 style="margin-bottom: 0px;">Cancel Ticket</h5>               
                        </div>

                        <div class="contact-inquiry-form" style="padding: 3%;">
                            <?php
                               echo form_open_multipart();
                             ?>   

                           <input type="hidden" id="booking_id" name="rowid">   
                           <div class="form-bottom" >
                             <textarea name="cancellation_reason" placeholder="Write here the reason of cancellation" required></textarea>
                           </div>
                    
                          <div class="submit-form">
                             <button type="submit" name="cancel_ticket">Submit</button>
                          </div>
                         <?php echo form_close(); ?>                                
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- quick view end -->


    <!-- quick view start -->
    <div  class="modal fade" role="dialog" tabindex="-1" id="quick-view">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:600px">
                <div class="modal-body">
                    <div class="contact-inquiry" style="padding: 5% 0px;">
                        <div aria-label="Close" data-dismiss="modal" class="modal-header">
                          <span>x</span>
                        </div>
                
                        <div class="contact-inquiry-title" style="padding-bottom: 2%;border-bottom: 1px solid #ccc;padding-left: 3%;">
                            <h5 style="margin-bottom: 0px;">View Detail</h5>               
                        </div>

                        <div class="contact-inquiry-form" id="ajaxDetail" style="padding: 3%;">
                                                        
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- quick view end -->
        
        <?php $this->load->view('front/common/footer.php'); ?>
        
    </div>
    
    <?php $this->load->view('front/common/js.php'); ?>
    

    <script type="text/javascript">

         function putBookingId(rid)
        {
           $('#booking_id').val(rid);
        }

        function delData(rid)
            {   
             if (confirm('Are you sure you want to delete this?')) {
                 
                 var base_url='<?php echo base_url(); ?>';
                 var md="booking";
                 
                 $.ajax({
                     type: "GET",
                     url: base_url + "user/deleteData", 
                     data: {rowid: rid , mode : md },
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){
                            $('#tr_' + rid).remove();  //as a debugging message.
                            $('#msgDivAjax').html('<div class="alert alert-success background-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Deleted Successfully</div>');
                            
                          }
                      });// you have missed this bracket
               }
            }

            function viewDetail(rid)
            {   
                 
                 var base_url='<?php echo base_url(); ?>';
                
                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/viewBookingDetailAjax", 
                     data: {rowid: rid},
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){
                            $('#ajaxDetail').html(data);  //as a debugging message.
                          }
                      });// you have missed this bracket
            }
    </script>

</body>
</html>