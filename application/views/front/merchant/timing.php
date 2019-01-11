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
                                <h1>Timing</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Timing</li>
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
                    <div class="row"  style="margin-bottom: 20px;">
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

                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <?php  $this->load->view('front/common/merchant-sidebar'); ?>
                        </div>

                         <?php
                             $image=$userDetails[0]->waterpark_logo;
                             $description=$userDetails[0]->description;
                             if(empty($image))
                             {
                                $image="avatar.png";
                             }

                             if(empty($description))
                             {
                                $description="Update Description of your water park";
                             }

                         $parkLogo=$userDetails[0]->waterpark_logo;
                         $parkdesc=$userDetails[0]->description;
                         $waterpark_address=$userDetails[0]->waterpark_address;
                         $mobile_number=$userDetails[0]->mobile_number;
                         $alternate_mobile_number=$userDetails[0]->alternate_mobile_number;
                         $email=$userDetails[0]->email;
                         $entry_fee_per_person=$userDetails[0]->entry_fee_per_person;
                        ?>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="agent-description">
                               <h4 class="pb2" style="border-bottom: 1px solid #ddd;"> Timings  <a href="<?php echo base_url(); ?>merchant/edit-timing" class="btn btn-mini btn-success pull-right">Update Timing</a> </h4>
                               <div class="table-responsive" style="background: #f5f9fd;padding: 3%;">
                                    <table class="table">
                                        <thead> 
                                            <tr>
                                                <th>#</th> 
                                                <th>Day</th>
                                                <th>Timing</th> 
                                            </tr> 
                                        </thead>
                                        <tbody> 
                                           <?php
                                           $a=1;
                                           $merchantId=$this->session->userdata('WhUserLoggedinId');
                                           $arr='mon,tue,wed,thur,fri,sat,sun';
                                           $DayArray=array('mon' => 'Monday','tue' => 'Tuesday' ,'wed' => 'Wednesday' , 'thur' => 'Thursday' ,'fri' => 'Friday', 'sat' => 'Saturday' ,'sun' => 'Sunday');
                                           foreach($DayArray as $key => $val)
                                           {
                                               $getDt=$this->Admin_model->getWhere('merchant_timing',array('merchant_id' => $merchantId,'day_name' =>$val));
                                               if(count($getDt)!=0)
                                               {
                                                   $closed_status=$getDt[0]->closed_status;
                                                   switch($closed_status)
                                                   {
                                                       case "1":
                                                         $time='<span style="color:red">Closed</span>';
                                                       break;
                                                       
                                                       case "0":
                                                         $start_time=date('g:i a',strtotime($getDt[0]->start_time));
                                                         $end_time=date('g:i a',strtotime($getDt[0]->end_time));
                                                         $time='<span >'.$start_time.' to '.$end_time.'</span>';
                                                       break;
                                                   }
                                               }
                                               else
                                               {
                                                   $time="Update Timings";
                                               }
                                               ?>
                                              <tr>
                                                <td scope="row"><?php echo $a; ?></td>
                                                <td><?php echo $val; ?></td> 
                                                <td><?php echo $time; ?></td> 
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