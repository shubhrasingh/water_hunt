<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo $userDetails[0]->name; ?> - Water Hunt </title>
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
                                <h1>Dashboard</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Dashboard</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php

            $image="avatar.png";

        ?>
       
        <!--Breadcrumbs end-->
         <div class="agent-details-page pt-50">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    <div class="row" >
                          
                          <?php

                            $totalTcktCount=$totalTickets[0]->cnt;
                            if($totalTcktCount!="")
                            {
                                $totalTcktCount='0';
                            }

                            $totalRvw=$totalReviews[0]->cnt;
                            if($totalRvw!="")
                            {
                                $totalRvw='0';
                            }
                          ?>
                           <div class="agent-funt-fact">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="singe-fun-fact dashboardCount">
                                                    <div class="fun-head">
                                                        <div class="fun-icon">
                                                            <i class="fa fa-ticket"></i>
                                                        </div>
                                                        <div class="fun-count">
                                                            <h3 class="counter"><?php echo $totalTcktCount; ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="fun-text">
                                                        <p>Booked Tickets</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="singe-fun-fact dashboardCount">
                                                    <div class="fun-head">
                                                        <div class="fun-icon">
                                                            <i class="fa fa-comment"></i>
                                                        </div>
                                                        <div class="fun-count">
                                                            <h3 class="counter"><?php echo $totalRvw; ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="fun-text">
                                                        <p>Customer's Comments</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                    </div>

                    
                    <div class="row" style="margin-bottom:20px">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-title text-center">
                                <h3>Recently <span>Booked Tickets</span></h3>
                            </div>
                       </div>

                        <div class="col-md-12">
                            <?php
                           if(count($bookedTickets)!='0')
                           {

                            ?>
                           <div class="table-responsive">
                            <table class="table table-bordered  table-hover">
                                <thead> 
                                    <tr>
                                        <th>#</th> 
                                        <th>Water Park</th>
                                        <th>Visit Date</th>
                                        <th>Total Visitors</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    <?php
                                    $a=1;
                                    foreach($bookedTickets as $bkr)
                                    {
                                        $merchantId=$bkr->merchant_id;
                                        $paymentStatus=$bkr->payment_status;
                                        $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));


                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $a; ?></th>
                                        <td><?php echo $getMerchant[0]->waterpark_name; ?></td> 
                                        <td><?php echo date('F j,Y',strtotime($bkr->visit_date)); ?></td> 
                                        <td><?php echo $bkr->total_visitors; ?></td> 
                                        <td><?php echo $bkr->gross_total; ?></td> 
                                        <td>
                                            <?php 
                                           switch($paymentStatus)
                                            {
                                                case "0":
                                            ?>
                                                <span class="btn btn-sm btn-danger btn-profile">Unpaid</span>
                                            <?php
                                                break;

                                                case "1":
                                             ?>
                                                <span class="btn btn-sm btn-success btn-profile">Paid</span>
                                            <?php
                                                break;
                                            }
                                            ?>
                                        </td> 
                                    </tr> 
                                   <?php
                                   $a++;
                                    }
                                   ?>
                                </tbody> 
                            </table>    
                        </div>
                            <?php
                            }
                            else
                            {
                                ?>
                              <h5 class="text-center">No Booked Tickets</h5>
                                <?php
                            }
                            ?>
                       </div>
                    </div>

                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
    
        
        
        
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>
	
</body>
</html>