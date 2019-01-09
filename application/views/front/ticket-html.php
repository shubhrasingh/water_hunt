<center>
<table style="width:600px">
<tr>
<td>
	<div style="width:100%;height:300px;background:url('<?php echo base_url(); ?>assets/front/images/bg/ticket-bg.jpg');background-size: 100%;">
	 <div style="width:100%;text-align:center;background: #ffffffb5;padding-top: 1%;"> 
	    <h2 style="color: #e81519;width: 50%;margin:0px;margin-left: 23%;font-size: 16px;"><?php echo $getMerchant[0]->waterpark_name; ?></h2>
		<p style="margin: 7px;margin-top: 1px;padding-bottom: 5px;font-size: 13px;color: black;line-height: 17px;"><?php echo $getMerchant[0]->waterpark_address; ?> , <?php echo $getMerchant[0]->waterpark_city; ?> ,<?php echo $getMerchant[0]->waterpark_state; ?>  <br/>Phone :  <?php echo $getMerchant[0]->mobile_number; ?> 
		<?php
		$alternate_mobile_number=$getMerchant[0]->alternate_mobile_number;
		if($alternate_mobile_number!="")
		{
			echo ','.$alternate_mobile_number;
		}
		
		$visitDate=date('F j,Y',strtotime($getTicketData[0]->visit_date));
		$event_id=$getTicketData[0]->event_id;
		?> 
		</p>
	 </div>
	 <div style="width:100%;text-align:center;min-height: 220px;"> 
		 <div style="width:68%;float:left;text-align:left;padding-left:5%;background: #ffffff61;"> 
		     
			<p style="margin: 0px;margin-top: 26px;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Name : </b> <?php echo $getTicketData[0]->name; ?></p>
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Email : </b> <?php echo $getTicketData[0]->email; ?></p>
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Contact : </b> <?php echo $getTicketData[0]->mobile; ?></p>
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Total Visitors : </b> <?php echo $getTicketData[0]->total_visitors; ?></p>
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Visit Date : </b> <?php echo $visitDate; ?> </p>
		   <?php
		   if($event_id!='0')
		   {
		   ?>	
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Event : </b><?php echo $getEvent[0]->name; ?></p>
		   <?php
		   }
		   ?>
		 
		 </div>
		 <div style="width:26%;float:right;text-align:center;background: #ffffff61;min-height:220px"> 
		 
		    
		    <?php
			$bookedOn=date('F j,Y',strtotime($getData[0]->added_on));
			?>
		    <p style="margin: 0px;margin-top: 26px;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Amount : </b> Rs. <?php echo $getData[0]->total_amount; ?> </p>
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> GST : </b> Rs.  <?php echo $getData[0]->total_gst; ?></p>
			<p style="margin: 9px 0;padding-bottom: 3px;border-bottom: 1px dotted #050108;line-height: 20px;"> <b style="font-weight:bold"> Final : </b> Rs. <?php echo $getData[0]->final_amount; ?></p>
			<p style="margin: 9px 0;line-height: 20px;"> <b style="font-weight:bolder;color: green;font-size: 25px;"> PAID </b></p>
			<p style="margin: 9px 0;line-height: 20px;"> <small style="font-size: 11px;">Booked on <?php echo $bookedOn?> </small></p>
		 
		 </div>
	 </div>


	</div>
	</td>
	</tr>
	</table>
</center>