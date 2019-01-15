<div class="panel panel-white">

            <div class="panel-heading clearfix" style="width:100%;margin-bottom:5px">
                <p style="font-weight:bold;text-align:center;font-size:15px;border-bottom:1px solid black"> <?php echo $reportOf; ?></p>
                <p style="text-align:right">
                     
                    <b>Total sale : </b> Rs. <?php echo $totalSale[0]->grossAmt; ?> ,
                    <b>Total Commission : </b> Rs. <?php echo $totalCommission[0]->comAmt; ?> 
                </p>    
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="example1" cellspacing="2" border="0" class="display table" style="width: 100%; cellspacing: 2;border:1px solid black">
                        <thead> 
                            <tr>
                                <th style="border:1px solid black">#</th> 
                                <th style="border:1px solid black">Water Park</th>
                                <th style="border:1px solid black">Booked By</th>
                                <th style="border:1px solid black">Final Amount</th>
                                <th style="border:1px solid black">Commission Amount</th>
                                <th style="border:1px solid black">Booked On</th>
                            </tr> 
                         </thead>
                        
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
                                <td style="border:1px solid black;text-align:center"><?php echo $a; ?></td> 
                                <td style="border:1px solid black;text-align:center"><?php echo $getMerchant[0]->waterpark_name; ?></td>
                                <td style="border:1px solid black;text-align:center"><?php echo $getTicket[0]->name; ?></td>
                                <td style="border:1px solid black;text-align:center">Rs. <?php echo $rt->final_amount; ?></td>
                                <td style="border:1px solid black;text-align:center">Rs. <?php echo $rt->commission_amount; ?></td>
                                <td style="border:1px solid black;text-align:center"><?php echo date('M j,Y g:i a',strtotime($rt->added_on)); ?></td>
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