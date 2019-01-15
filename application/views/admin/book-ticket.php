<!DOCTYPE html>
<html lang="en">
<head>
        
        <?php include('common/header-css.php'); ?>
        
    </head>
    <body class="compact-menu">
        <div class="overlay"></div>
        
        
       
        <main class="page-content content-wrap">

            <?php include('common/header.php'); ?>


            <?php include('common/sidebar.php'); ?>

            <div class="page-inner">
                <div class="page-title">
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo  base_url(); ?>admin/dashboard">Home</a></li>
                            <li class="active">Booking</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
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

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                           
      <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Booking Ticket List</h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
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
                                        <tfoot>
                                            <tr>
                                                <th>#</th> 
                                                <th>Name</th>
                                                <th>Booked For</th>
                                                <th>Total Amount</th>
                                                <th>Booked on</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr> 
                                        </tfoot>
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
                                                <button class="btn  btn-danger btn-xs">Unpaid</button>
                                            <?php
                                                break;

                                                case "1":
                                             ?>
                                                <button class="btn btn-success btn-xs">Paid</button>
                                            <?php
                                                break;
                                            }
                                            ?>
                                           </td>
                                           <td> 
                                            
                                            <a href="<?php echo base_url(); ?>assets/front/uploads/ticket/<?php echo $getBillingDetail[0]->ticket; ?>"  download class=" btn btn-xs btn-primary"><i class="fa fa-download"></i></a>
                                           
                                            <a href="javascript:void()"  onclick="getbookingDetails(<?php echo  $bkr->id; ?>)" data-toggle="modal" data-target="#myModal"  class=" btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>

                                           <a href="javascript:void();" onclick="delData('ticket_request','<?php echo $bkr->id; ?>')"  class=" btn btn-xs btn-danger" ><i class="fa fa-trash"></i></a>
                                           
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
                                                   <a href="javascript:void()"  onclick="putBookingId(<?php echo  $bkr->id; ?>)" data-toggle="modal" data-target="#cancel-ticket"  class=" btn btn-xs btn-info">Cancel Booking</a>

                                                   <?php
                                                break;

                                                case "2":
                                                   $cancelledBy=$bkr->cancelled_by;
                                                   ?>
                                                    <a  class=" btn btn-xs btn-danger">Cancelled</a>
                                                     <br/>
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


                </div>
                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
    
     
        <!--Start of   Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     
                    
                </div>
            </div>
        </div><!--  End Of Modal Code -->


        <div class="modal fade" id="cancel-ticket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h3 class="modal-title" id="myModalLabel">Cancel Ticket</h3>
                    </div>
                     <?php
                               echo form_open_multipart();
                      ?> 
                    <div class="modal-body row">
                       <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                   <input type="hidden" id="booking_id" name="rowid">  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Reason</label>
                                             <textarea name="cancellation_reason"  class="form-control m-t-xxs" placeholder="Write here the reason of cancellation" required></textarea>
                                           
                                        </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button type="submit" name="cancel_ticket" class="btn btn-success">Submit</button>
                    </div>
                    <?php echo form_close(); ?>     
                </div>
            </div>
        </div>

       
        <?php include('common/footer-js.php'); ?>
       <script type="text/javascript">

        $(document).ready(function() {
    $('#example1').DataTable();
} );

         function putBookingId(rid)
        {
           $('#booking_id').val(rid);
        }
            
            function changeStatus(id,table)
            {
               $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>admin/statusTogg',
                    data: {id: id,table:table},
                    success: function (ht) { 
                        //alert(ht); 
                      $('.statuofrow'+id+' button').html(ht); 
                    }
                  });
            }

           

function delData(tbl,rowid)
{   
   //alert(tbl+'--'+rowid); exit();      
 if (confirm('Are you sure you want to delete this?')) {
     
     var base_url='<?php echo  base_url(); ?>';
     
    
     $.ajax({
         type: "post",
         url: base_url + "admin/deleteRecord", 
         data: {id: rowid , table : tbl },
         cache:false,
         success: 
              function(data){
               // alert(data); 
               $('#row_' + rowid).remove(); 
               $('#msgDivAjax').html('<div class="alert alert-success background-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Deleted Successfully</div>');
              }
          });


   }
}


function getbookingDetails(bookingid)
            {
              $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>admin/getbookingDetails',
                    data: {Bid: bookingid},
                    success: function (ht) { 
                        //alert(ht); 
                        //console.log(ht);
                      $('.modal-content').html(ht); 
                    }
                  });

            }


        </script>


    </body>
</html>