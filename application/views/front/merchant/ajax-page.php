<?php
switch($mode)
	{
		case "bookingDetail":
			?>
			   <div class="condition-amenities mt0 pt0" >
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="property-condition">
                                            <div class="condtion-title">
                                                <h5 class="mb3">User Detail</h5>
                                            </div>
                                            <div class="property-condition-list" style="padding: 15px;">
                                                
                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Name : </span><?php echo $getTicket[0]->name; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p style="word-break: break-all;"><span style="font-weight:bold">Email : </span><?php echo $getTicket[0]->email; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Mobile : </span><?php echo $getTicket[0]->mobile; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Address : </span><?php echo $getTicket[0]->address; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Visit date : </span><?php echo date('M j,Y',strtotime($getTicket[0]->visit_date)); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                    	<div class="property-condition">
                                            <div class="condtion-title">
                                                <h5 class="mb3">Booking Detail</h5>
                                            </div>
                                            <div class="property-condition-list" style="padding: 15px;">
                                                
                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Total Visitors : </span><?php echo $getTicket[0]->total_visitors; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Total Amount : </span><i class="fa fa-inr"></i> <?php echo $getBillingDetail[0]->total_amount; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Total GST : </span> <i class="fa fa-inr"></i> <?php echo $getBillingDetail[0]->total_gst; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Final Amount  : </span><i class="fa fa-inr"></i> <?php echo $getBillingDetail[0]->final_amount; ?></p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Booked On : </span><?php echo date('M j,Y g:i a',strtotime($getTicket[0]->requested_on)); ?> </p>
                                                </div>

                                                <div class="property-location pb2">
                                                    <p><span style="font-weight:bold">Download Ticket : </span><a href="<?php echo base_url(); ?>assets/front/uploads/ticket/<?php echo $getBillingDetail[0]->ticket; ?>"  download class=" btn btn-mini btn-primary"><i class="fa fa-download"></i></a>  </p>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
			<?php
		break;

        case "readMessage":
           
           ?>
             <p><?php echo $getMessage[0]->message; ?></p>
           <?php
        break;
	}
?>