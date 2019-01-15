<?php 


if(isset($mode))
{
    switch($mode)
	{
	   case 'timeschedule': ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel"><?php echo  ucfirst($waterparkname); ?></h3>
                    </div>
                    <div class="modal-body">
                       <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><b>Timimg</b></h4>
                                    <a href="<?php echo  base_url(); ?>admin/edit-timing/<?php echo  $merchantid; ?>" class="btn btn-xs btn-success pull-right">Update Timing</a>
                                </div>
                                 <?php if(isset($Timingschedule)) {
                                    ?>
                                <div class="panel-body">
                                   
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Day</th>
                                                <th>Timing</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	

                                            <?php  $i=1; foreach($Timingschedule as $timing) {

                                                  $closed_status=$timing->closed_status;
                                                   switch($closed_status)
                                                   {
                                                       case "1":
                                                         $time='<span style="color:red">Closed</span>';
                                                       break;
                                                       
                                                       case "0":
                                                         $start_time=date('g:i a',strtotime($timing->start_time));
                                                         $end_time=date('g:i a',strtotime($timing->end_time));
                                                         $time='<span >'.$start_time.' to '.$end_time.'</span>';
                                                       break;
                                                   } 

                                             ?>
                                               <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?php echo  $timing->day_name; ?></td>
                                                
                                                <td><?php echo  $time; ?></td>
                                            </tr>

                                        	<?php $i++;  }  ?> 
                                        </tbody>
                                    </table>


                                </div>
                                <?php }else{ ?>
                                 <a href="<?php echo  base_url(); ?>admin/edit-timing/<?php echo  $merchantid; ?>" class="btn btn-xs btn-success">Update Timing</a>
                                </div><?php } ?>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
                    </div>
	    
      <?php
	   break; 

       case   'bookingdetails':  ?>

          <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="myModalLabel"><?php echo  ucfirst($merchants[0]->waterpark_name); ?></h3>
                    </div>
                    <div class="modal-body">
                       <div class="panel panel-white">
                               
                                 <?php if(isset($getBooikng)) {
                                    ?>
                                <div class="panel-body">
                                   
                                    <div class="row">
                                        <div class="col-sm-6">

                                            <h3 class="mb3" style="margin-top: 0px;">User Detail</h3>

                                            <p><span style="font-weight:bold">Name : </span><?php echo $getBooikng[0]->name; ?></p>

                                             <p style="word-break: break-all;"><span style="font-weight:bold">Email : </span><?php echo $getBooikng[0]->email; ?></p>

                                             <p><span style="font-weight:bold">Mobile : </span><?php echo $getBooikng[0]->mobile; ?></p>

                                             <p><span style="font-weight:bold">Address : </span><?php echo $getBooikng[0]->address; ?></p>

                                             <p><span style="font-weight:bold">Visit date : </span><?php echo date('M j,Y',strtotime($getBooikng[0]->visit_date)); ?></p>
                                        </div>

                                        <div class="col-sm-6">

                                             <h3 class="mb3" style="margin-top: 0px;">Booking Detail</h3>

                                             <p><span style="font-weight:bold">Total Visitors : </span><?php echo $getBooikng[0]->total_visitors; ?></p>

                                              <p><span style="font-weight:bold">Total Amount : </span><i class="fa fa-inr"></i> <?php echo $getBillingDetail[0]->total_amount; ?></p>

                                             <p><span style="font-weight:bold">Total GST : </span> <i class="fa fa-inr"></i> <?php echo $getBillingDetail[0]->total_gst; ?></p>

                                            <p><span style="font-weight:bold">Final Amount  : </span><i class="fa fa-inr"></i> <?php echo $getBillingDetail[0]->final_amount; ?></p>

                                            <p><span style="font-weight:bold">Booked On : </span><?php echo date('M j,Y g:i a',strtotime($getBooikng[0]->requested_on)); ?> </p>

                                            <p><span style="font-weight:bold">Download Ticket : </span>
                                                <a href="<?php echo base_url(); ?>assets/front/uploads/ticket/<?php echo $getBillingDetail[0]->ticket; ?>"  download class=" btn btn-xs btn-primary"><i class="fa fa-download"></i></a> 
                                            </p>
                                        </div>
                                    </div>
                                   

                                </div>
                                <?php }else{ ?>
                                 <a href="<?php echo  base_url(); ?>admin/edit-timing/<?php echo  $merchantid; ?>" class="btn btn-xs btn-success">Update Timing</a>
                                </div><?php } ?>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-success">Save changes</button> -->
                    </div>

       <?php 
       break; 

       case "reportData":

         ?>

         <div class="panel panel-white">
           
            <div class="panel-heading clearfix">
                <h4 class="panel-title"><?php echo $reportOf; ?></h4>
                <span class="pull-right" style="width: 40%;text-align: right;">
                     
                    <b>Total sale : </b> <i class="fa fa-inr"></i> <?php echo $totalSale[0]->grossAmt; ?> ,
                    <b>Total Commission : </b> <i class="fa fa-inr"></i> <?php echo $totalCommission[0]->comAmt; ?>

                    <a href="<?php echo base_url(); ?>admin/pdf-report" style="margin-left: 3%;"class="btn btn-xs btn-danger pull-right" download>PDF</a> 
                </span>    
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="example1" class="display table" style="width: 100%; cellspacing: 0;">
                        <thead> 
                            <tr>
                                <th>#</th> 
                                <th>Water Park</th>
                                <th>Booked By</th>
                                <th>Final Amount</th>
                                <th>Commission Amount</th>
                                <th>Booked On</th>
                            </tr> 
                         </thead>
                         <tfoot>
                            <tr>
                                <th>#</th> 
                                <th>Water Park</th>
                                <th>Booked By</th>
                                <th>Final Amount</th>
                                <th>Commission Amount</th>
                                <th>Booked On</th>
                            </tr> 
                        </tfoot>
                        <tbody>
                           <?php
                           $a=1;
                           foreach($getReport as $rt)
                           {
                              $merchantId=$rt->merchant_id;
                              $ticketId=$rt->ticket_request_id;
                              $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
                              $getTicket=$this->Admin_model->getWhere('ticket_request',array('id' => $ticketId));
                             ?>
                              <tr>
                                <td><?php echo $a; ?></td> 
                                <td><?php echo $getMerchant[0]->waterpark_name; ?></td>
                                <td><?php echo $getTicket[0]->name; ?></td>
                                <td><i class="fa fa-inr"></i> <?php echo $rt->final_amount; ?></td>
                                <td><i class="fa fa-inr"></i> <?php echo $rt->commission_amount; ?></td>
                                <td><?php echo date('M j,Y g:i a',strtotime($rt->added_on)); ?></td>
                              </tr> 
                             <?php
                             $a++;
                           }  
                           ?>
                        </tbody>
                </table> 
               </div>           
            </div>
         </div>

         <?php

       break;
	}




}?>