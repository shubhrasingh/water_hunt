<!DOCTYPE html>
<html lang="en">
<head>
        <?php include('common/header-css.php'); ?>

        <style type="text/css">
            .no-m {
               color: white !important;
            }
        </style>
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
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                 
                 <div id="main-wrapper">
                    <div class="row">
                       
                        <div class="col-md-12">
                            <div class="">
                                <!-- <div class="panel-heading clearfix">
                                    <h3 class="panel-title">Visitors</h3>
                                    <div class="panel-control">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a>
                                    </div>
                                </div> -->
                                <div class="panel-body">
                                    <div class="panel-header-stats">
                                        <div class="row">

                                            <a href="<?php echo  base_url('admin/allmerchant'); ?>"><div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-dribbble">
                                                <h2><?php if($allmerchants >0) {echo $allmerchants;}else{ echo '0';} ?></h2>
                                                <h4 class="no-m">All Merchants</h4>
                                            </div></a>

                                           <a href="<?php echo  base_url('admin/bookticket'); ?>">
                                            <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-warning">
                                                <h2><?php if($allbooikngticket >0){ echo  $allbooikngticket; }else{ echo '0';} ?></h2>
                                                <h4 class="no-m">Booking Tickets</h4>
                                            </div>
                                           </a>
                                      
                                            <a href="<?php echo  base_url('admin/enquiry'); ?>">
                                             <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-info">
                                                <h2><?php if($allenquirybooking >0 ){echo  $allenquirybooking;}else{ echo '0'; } ?></h2>
                                                <h4 class="no-m">Booking Enquiry</h4>
                                            </div>
                                           </a>
                                           <a href="<?php echo  base_url('admin/allusers'); ?>">
                                            <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-danger">
                                                <h2><?php if ($allusers >0) {
                                                   echo  $allusers;
                                                }else{ echo '0'; }  ?></h2>
                                                <h4 class="no-m">All Users </h4>
                                            </div>
                                           </a>
                                           

                                    </div>
                                     <br/>
                                    <div class="row">
                                        <a href="<?php echo  base_url('admin/reports'); ?>">
                                            <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-instagram">
                                               <h2>&#8377; <?php if($TodayCommission[0]->cmt >0) { echo $TodayCommission[0]->cmt;}else{ echo '0'; } ?></h2>
                                                <h4 class="no-m">Today Commission</h4>
                                            </div>
                                        </a>
                                        <a href="<?php echo  base_url('admin/reports'); ?>">
                                            <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-vimeo">
                                                <h2>&#8377; <?php if ($thismonthsCommission[0]->cmt >0) {
                                                   echo  $thismonthsCommission[0]->cmt;
                                                }else{ echo '0'; }  ?></h2>
                                                <h4 class="no-m"><?php echo date('F'); ?> Commision</h4>
                                            </div>
                                        </a>
                                        <a href="<?php echo  base_url('admin/reports'); ?>">
                                            <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-success">
                                                <h2>&#8377; <?php if ($yearCommission[0]->cmt >0) {
                                                   echo  $yearCommission[0]->cmt;
                                                }else{ echo '0'; }  ?></h2>
                                                <h4 class="no-m">Year Commision</h4>
                                            </div>
                                        </a>
                                        <a href="<?php echo  base_url('admin/allevent'); ?>">
                                             <div class="col-md-2 col-md-offset-1 col-xs-6 btn btn-primary">
                                                <h2><?php if($allevents >0){echo  $allevents;}else{ echo '0'; } ?></h2>
                                                <h4 class="no-m">All Events</h4>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                        
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title">Booking Ticket`s</h3>
                                    <!-- <div class="panel-control">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a>
                                    </div> -->
                                </div>
                                <div class="panel-body">
                                    <div class="panel-header-stats">
                                        <div class="row">
                                          <?php  if(isset($bookingticket)) { ?>   
                                     <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>WaterPark</th>
                                                <th>Amount</th>
                                                <th>Commission</th>
                                                <!--<th>Payment</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; foreach($bookingticket as $booking) { ?>
                                             
                                                <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td style="width:"><?php echo  ucfirst($booking->name); ?><br/><?php echo  $booking->mobile; ?></td>
                                                <td><?php 
                                                 $mrid=$booking->merchant_id; 
                                                 $this->db->where('id',$mrid); 
                                                 $merchant=$this->db->get('wh_merchants')->row(); 
                                                 echo  $merchant->waterpark_name; 
                                                 ?></td>
                                                <td>&#8377; <?php echo  $booking->gross_total; ?></td>
                                                <td>&#8377; <?php  $id=$booking->id;
                                                 $this->db->where('ticket_request_id',$id); 
                                                 $result=$this->db->get('wh_ticket_billing_details')->row(); 
                                                 if($result){ echo  $result->commission_amount; }else{ echo '0'; } ?></td>
                                               <!--  <td><?php if($booking->payment_status=='1') {?>
                                                    <button class="btn btn-xs btn-info">Paid</button>
                                                     
                                                    <?php }else{?>
                                                       <button class="btn btn-xs  btn-danger">Unpaid</button>
                                                        <?php } ?></td> -->
                                            </tr>
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                <div class="text-center text-danger"> No Records ...</div>
                                <?php } ?>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title">Booking Enquiry</h3>
                                    <!-- <div class="panel-control">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a>
                                    </div> -->
                                </div>
                                <div class="panel-body">
                                    <div class="panel-header-stats">
                                        <div class="row">
                                          <?php  if(isset($bookingrequest)) { ?>   
                                     <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>WaterPark</th>
                                                <th>Visitors</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; foreach($bookingrequest as $booking) { ?>
                                             
                                                <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td style="width:"><?php echo  ucfirst($booking->name); ?><br/><?php echo  $booking->mobile; ?></td>
                                                <td><?php 
                                                 $mrid=$booking->merchant_id; 
                                                 $this->db->where('id',$mrid); 
                                                 $merchant=$this->db->get('wh_merchants')->row(); 
                                                 echo  $merchant->waterpark_name; 
                                                 ?></td>
                                                <td><?php echo  $booking->total_visitors; ?></td>
                                                <td><?php echo $booking->message; ?></td>
                                            </tr>
                                            <?php $i++; } ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                <div class="text-center text-danger"> No Records ...</div>
                                <?php } ?>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title">Merchants</h3>
                                    <!-- <div class="panel-control">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a>
                                    </div> -->
                                </div>
                                <div class="panel-body">
                                    <div class="panel-header-stats">
                                        <div class="row">
                                          <?php  if(isset($merchants)) { ?>   
                                     <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>WaterPark Name</th>
                                                <th>City</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; foreach($merchants as $merchant) { ?>
                                             
                                                <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?php echo  ucfirst($merchant->name); ?><br/><?php echo  $merchant->email; ?></td>
                                                <td><?php echo  ucfirst($merchant->waterpark_name); ?></td>
                                                <td><?php echo  ucfirst($merchant->waterpark_city); ?></td>
                                            </tr>
                                            <?php $i++;  } ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                <div class="text-center text-danger"> No Records ...</div>
                                <?php } ?>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h3 class="panel-title">All Users</h3>
                                    <div class="panel-control">
                                        <!-- <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" class="panel-reload" data-original-title="Reload"><i class="icon-reload"></i></a> -->
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="panel-header-stats">
                                        <div class="row">
                                          <?php  if(isset($users)) { ?>   
                                     <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; foreach($users as $user) { ?>
                                             
                                                <tr>
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?php echo  ucfirst($user->name); ?></td>
                                                <td><?php echo  ucfirst($user->email); ?></td>
                                                <td><?php echo  ucfirst($user->mobile); ?></td>
                                            </tr>
                                            <?php $i++;  } ?>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                <div class="text-center text-danger"> No Records ...</div>
                                <?php } ?>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>

                    </div>

            </div>
                


                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts pvt. ltd. </p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
    

        <?php include('common/footer-js.php'); ?>
        
    </body>
</html>