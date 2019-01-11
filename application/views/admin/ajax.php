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
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title"><b>Booking Details</b></h4>
                                 
                              <!-- <button class="btn btn-xs btn-danger pull-right">Payment failed..</button>
                                    <button class="btn btn-xs btn-danger pull-right">Payment failed..</button> -->

                                </div>
                                 <?php if(isset($getBooikng)) {
                                    ?>
                                <div class="panel-body">
                                   
                                    <div class="row">
                                        <div class="col-md-1"><b>Name:</b></div>
                                        <div class="col-md-5"><?php echo $getBooikng[0]->name; ?></div>
                                        <div class="col-md-1"><b>Status:</b></div>
                                        <div class="col-md-5">
                                           <?php if($getBooikng[0]->payment_status=='1') {?>
                                            <button class="btn btn-xs btn-info">Complete</button>
                                           <?php }else if($getBooikng[0]->payment_status=='2'){  ?>
                                           <button class="btn btn-xs btn-danger">Payment failed..</button>
                                           <?php }else{ ?>
                                            <button class="btn btn-xs btn-danger">Pending..</button>
                                           <?php }?>
                                           


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><b>Email:</b></div>
                                        <div class="col-md-5"><?php echo $getBooikng[0]->email; ?></div>
                                        <div class="col-md-1"><b>Visit:</b></div>
                                        <div class="col-md-5"><?php echo $getBooikng[0]->visit_date; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"><b>Mobile:</b></div>
                                        <div class="col-md-5"><?php echo $getBooikng[0]->name; ?></div>
                                        <div class="col-md-2"><b>Address:</b></div>
                                        <div class="col-md-4"><?php echo $getBooikng[0]->name; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><b>Adults:</b></div>
                                        <div class="col-md-4"><?php echo $getBooikng[0]->number_of_adults; ?></div>
                                        <div class="col-md-1"><b>Visitor</b></div>
                                        <div class="col-md-5"><?php echo $getBooikng[0]->total_visitors; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><b>Children:</b></div>
                                        <div class="col-md-4"><?php echo $getBooikng[0]->number_of_children; ?></div>
                                        <div class="col-md-1"><b>GST</b></div>
                                        <div class="col-md-5"><?php echo 'Gst:'.$getBooikng[0]->gst.'&nbsp; cgst:'.$getBooikng[0]->cgst; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"><b>Amount:</b></div>
                                        <div class="col-md-4"><?php echo $getBooikng[0]->gross_total; ?>&nbsp; &#8377;</div>
                                        <div class="col-md-2"><b>Message</b></div>
                                        <div class="col-md-4"><?php echo $getBooikng[0]->message; ?></div>
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
	}




}?>