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
            $getReview=$this->Admin_model->getQuery("SELECT SUM(rating) as reviewRate FROM $tblRvw WHERE merchant_id='$merchantId' and `event_id`='0'");
            $getReviewCount=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt_rw FROM $tblRvw WHERE merchant_id='$merchantId' and `event_id`='0'");

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
                                <h1>Reviews</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Reviews</li>
                                </ul>
                                <ul style="margin-top: 10px;">
                                    <li>Customer Rating : </li>
                                    <li>
                                         <?php
                                         if($finalReview==1)
                                         {
                                           ?>
                                             Not rated yet
                                           <?php
                                         }
                                         else
                                         {
                                             for($x=1;$x<=$finalReview;$x++)
                                             {
                                             ?>
                                               <i class="fa fa-star customerStar"></i> 
                                             <?php
                                             }
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
         <div class="agent-details-page pt-10">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    
                    <div class="row pb-120">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h3>All <span> Reviews</span> </h3>
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
                            <div class="elements-tab-1">
                           
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#profile_1"  data-toggle="tab">Profile Reviews</a></li>
                                <li><a href="#messages_1"  data-toggle="tab">Events Reviews</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="profile_1">
                                     <div class="table-responsive">
                                        <table class="table table-bordered  table-hover">
                                            <thead> 
                                                <tr>
                                                    <th>#</th> 
                                                    <th>Name</th>
                                                    <th>Rating</th>
                                                    <th>Comment</th>
                                                    <th>Commented on</th>
                                                    <th></th>
                                                </tr> 
                                            </thead>
                                            <tbody> 
                                                <?php
                                               if(count($getProfileReview)!='0')
                                               {
                                                $a=1;
                                                foreach($getProfileReview as $bkr)
                                                {
                                                    $user_id=$bkr->user_id;
                                                    $eventId=$bkr->event_id;

                                                    $getUser=$this->Admin_model->getWhere('users',array('id' => $user_id));

                                                     
                                                ?>
                                                <tr id="tr_<?php echo $bkr->id; ?>">
                                                    <th scope="row"><?php echo $a; ?></th>
                                                    <td><?php echo $getUser[0]->name; ?></td> 
                                                    <td><i class="fa fa-star"></i> <?php echo $bkr->rating; ?></td> 
                                                    <td><?php echo $bkr->comment; ?></td> 
                                                    <td><?php echo date('F j,Y',strtotime($bkr->added_on)); ?> </td> 
                                                    <td> 
                                                       <button  onclick="delData(<?php echo $bkr->id; ?>)"  class="btn btn-sm btn-danger btn-mini"><i class="fa fa-trash"></i></button>                           
                                                    </td> 
                                                </tr> 
                                               <?php
                                               $a++;
                                                }
                                               }
                                               else
                                                {
                                                    ?>
                                                   <tr><td colspan="8" style="text-align:center">No Review Found</td></tr>
                                                    <?php
                                                }
                                               ?>
                                            </tbody> 
                                        </table>    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="messages_1">
                                     <div class="table-responsive">
                                        <table class="table table-bordered  table-hover">
                                            <thead> 
                                                <tr>
                                                    <th>#</th> 
                                                    <th>Name</th>
                                                    <th>Event</th>
                                                    <th>Rating</th>
                                                    <th>Comment</th>
                                                    <th>Commented on</th>
                                                    <th></th>
                                                </tr> 
                                            </thead>
                                            <tbody> 
                                                <?php
                                               if(count($getEventReview)!='0')
                                               {
                                                $a=1;
                                                foreach($getEventReview as $bkr)
                                                {
                                                    $user_id=$bkr->user_id;
                                                    $eventId=$bkr->event_id;

                                                    $getUser=$this->Admin_model->getWhere('users',array('id' => $user_id));

                                                    $getEvent=$this->Admin_model->getWhere('merchants_events',array('id' => $eventId));
                                                     
                                                ?>
                                                <tr id="tr_<?php echo $bkr->id; ?>">
                                                    <th scope="row"><?php echo $a; ?></th>
                                                    <td><?php echo $getUser[0]->name; ?></td> 
                                                    <td><?php echo $getEvent[0]->name;?> </td> 
                                                    <td><i class="fa fa-star"></i> <?php echo $bkr->rating; ?></td> 
                                                    <td><?php echo $bkr->comment; ?></td> 
                                                    <td><?php echo date('F j,Y',strtotime($bkr->added_on)); ?> </td> 
                                                    <td> 
                                                       <button  onclick="delData(<?php echo $bkr->id; ?>)"  class="btn btn-sm btn-danger btn-mini"><i class="fa fa-trash"></i></button>                           
                                                    </td> 
                                                </tr> 
                                               <?php
                                               $a++;
                                                }
                                               }
                                               else
                                                {
                                                    ?>
                                                   <tr><td colspan="8" style="text-align:center">No Review Found</td></tr>
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

                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
    
        <?php $this->load->view('front/common/footer.php'); ?>
        
    </div>
    
    <?php $this->load->view('front/common/js.php'); ?>
    

    <script type="text/javascript">


        function delData(rid)
            {   
             if (confirm('Are you sure you want to delete this?')) {
                 
                 var base_url='<?php echo base_url(); ?>';
                 var md="reviews";
                 
                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/deleteData", 
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
    </script>

</body>
</html>