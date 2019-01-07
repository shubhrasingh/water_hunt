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
          <?php
            $merchantId=$this->session->userdata('WhUserLoggedinId');
            $tblRvw=$this->db->dbprefix.'customer_review';
            $getReview=$this->Admin_model->getQuery("SELECT SUM(rating) as reviewRate FROM $tblRvw WHERE merchant_id='$merchantId'");
            $getReviewCount=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt_rw FROM $tblRvw WHERE merchant_id='$merchantId'");

            $reviewRate=$getReview[0]->reviewRate;
            $userCount=$getReviewCount[0]->cnt_rw;
            if(($userCount!="") && ($userCount!='0'))
            {
                $fReview=$reviewRate / $userCount;
                $finalReview=round($fReview);
            }
            else
            {
                $finalReview='1';
            }

          ?>
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
                                <ul style="margin-top: 10px;">
                                    <li>Customer Rating : </li>
                                    <li>
                                         <?php
                                         for($x=1;$x<=$finalReview;$x++)
                                         {
                                         ?>
                                           <i class="fa fa-star customerStar"></i> 
                                         <?php
                                         }
                                         ?>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <!--Breadcrumbs end-->
         <div class="agent-details-page pt-50">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    <div class="row" >
                          
                          <?php

                            $pastCount=$pasteventCount[0]->cnt;
                            if($pastCount=="")
                            {
                                $pastCount='0';
                            }

                            $upcomingCount=$upcomingeventCount[0]->cnt;
                            if($upcomingCount=="")
                            {
                                $upcomingCount='0';
                            }

                            $totalTcktCount=$totalTickets[0]->cnt;
                            if($totalTcktCount=="")
                            {
                                $totalTcktCount='0';
                            }

                            $totalRvw=$totalReviews[0]->cnt;
                            if($totalRvw=="")
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
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <div class="fun-count">
                                                            <h3 class="count"><?php echo $upcomingCount; ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="fun-text">
                                                        <p>Upcoming Events</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="singe-fun-fact dashboardCount">
                                                    <div class="fun-head">
                                                        <div class="fun-icon">
                                                            <i class="fa fa-tasks"></i>
                                                        </div>
                                                        <div class="fun-count">
                                                            <h3 class="count"><?php echo $pastCount; ?></h3>
                                                        </div>
                                                    </div>
                                                    <div class="fun-text">
                                                        <p>Past Events</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <div class="singe-fun-fact dashboardCount">
                                                    <div class="fun-head">
                                                        <div class="fun-icon">
                                                            <i class="fa fa-ticket"></i>
                                                        </div>
                                                        <div class="fun-count">
                                                            <h3 class="count"><?php echo $totalTcktCount; ?></h3>
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
                                                            <h3 class="count"><?php echo $totalRvw; ?></h3>
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

<div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-title text-center">
                                <h3>Ongoing <span>Events</span></h3>
                            </div>
                       </div>

                        <div class="col-md-12">
                            <?php
                           if(count($ongoingEvents)!='0')
                           {

                            ?>
                            <div class="property-list">
                                <?php
                                foreach($ongoingEvents as $rt)
                                {
                                ?>
                                <div class="col-md-4">
                                    <div class="single-property">
                                        <div class="property-img">
                                            <a href="#">
                                                <img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $rt->image; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="property-desc">
                                            <div class="property-desc-top">
                                                <h6><a href="#"><?php echo $rt->name; ?></a></h6>
                                                <h4 class="price"><i class="fa fa-inr"></i> <?php echo $rt->entry_fee_per_person; ?></h4>
                                                <div class="property-location">
                                                    <p><i class="fa fa-calendar"></i> <?php echo date('F j,Y',strtotime($rt->start_date))?> to <?php echo date('F j,Y',strtotime($rt->end_date))?></p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            }
                            else
                            {
                                ?>
                              <h5 class="text-center">No Upcoming Event Found</h5>
                                <?php
                            }
                            ?>
                       </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="section-title text-center">
                                <h3>Upcoming <span>Events</span></h3>
                            </div>
                       </div>

                        <div class="col-md-12">
                            <?php
                           if(count($upcomingEvents)!='0')
                           {

                            ?>
                            <div class="property-list">
                                <?php
                                foreach($upcomingEvents as $rt)
                                {
                                ?>
                                <div class="col-md-4">
                                    <div class="single-property">
                                        <div class="property-img">
                                            <a href="#">
                                                <img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $rt->image; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="property-desc">
                                            <div class="property-desc-top">
                                                <h6><a href="#"><?php echo $rt->name; ?></a></h6>
                                                <h4 class="price"><i class="fa fa-inr"></i> <?php echo $rt->entry_fee_per_person; ?></h4>
                                                <div class="property-location">
                                                    <p><i class="fa fa-calendar"></i> <?php echo date('F j,Y',strtotime($rt->start_date))?> to <?php echo date('F j,Y',strtotime($rt->end_date))?></p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            }
                            else
                            {
                                ?>
                              <h5 class="text-center">No Upcoming Event Found</h5>
                                <?php
                            }
                            ?>
                       </div>
                    </div>

                    
                    <div class="row">
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
                                        <th>Name</th>
                                        <th>Contact</th> 
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
                                        $paymentStatus=$bkr->payment_status;

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $a; ?></th>
                                        <td><?php echo $bkr->name; ?></td> 
                                        <td><?php echo $bkr->mobile; ?></td> 
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