<!DOCTYPE html>
<html lang="en">
<head>
        
        <?php include('common/header-css.php'); ?>
        
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
                            <li class="active">Edit Timing</li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row">
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



                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="user-profile-panel panel panel-white">
                               <!--  <div class="panel-heading">
                                    <div class="panel-title">Water Park</div> 
                                </div> -->
                                <div class="panel-body">
                                    <img src="<?php echo  base_url(); ?>assets/front/uploads/merchant-logo/<?php echo  $merchant[0]->waterpark_logo;  ?>" class="user-profile-image" alt="">
                                     <h4 class="text-center m-t-lg"><?php echo  ucfirst($merchant[0]->name);  ?></h4>
                                    <p class="text-center"><?php echo  ucfirst($merchant[0]->waterpark_name);  ?></p>
                                    <!-- <hr>
                                    <ul class="list-unstyled text-center" style="text-align:left; ">
                                        <li><p><i class="icon-pointer m-r-xs"></i><?php echo  $getProfile[0]->company_address; ?></p></li>
                                        <li><p><i class="icon-envelope-open m-r-xs"></i><a href="mailto:<?php echo  $getProfile[0]->company_email; ?>"><?php echo  $getProfile[0]->company_email; ?></a></p></li>
                                        <li><p><i class="icon-link m-r-xs"></i><a href="<?php echo base_url(); ?>"><?php echo  base_url(); ?></a></p></li>
                                    </ul> -->
                                   <hr>
                                    <a href="<?php echo  base_url(); ?>admin/allmerchant" class="btn btn-sm btn-warning">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                           
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Update Water Park Timing Schedule</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data" >
                                        <?php if(!empty($Timingschedule)) { ?>
                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Day</th>
                                                <th>Open/Close</th>
                                                <th colspan="2" class="text-center">Timing</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           <?php  $i=1; foreach($Timingschedule as $timing) {

                                                  $closed_status=$timing->closed_status;
                                                   switch($closed_status)
                                                   {
                                                       case "1":
                                                         $time='<span style="color:red">Closed</span>';
                                                         $red='readonly';
                                                         $style='background:rgb(149, 149, 150);height:30px;';
                                                         $dis='disable';
                                                       break;
                                                       
                                                       case "0":
                                                         $start_time=date('g:i a',strtotime($timing->start_time));
                                                         $end_time=date('g:i a',strtotime($timing->end_time));
                                                         $time='<span >'.$start_time.' to '.$end_time.'</span>';
                                                         $red='';
                                                         $style='';
                                                         $dis='';
                                                       break;
                                                   } 

                                             ?>
                                               <tr>
                                            <input type="hidden" name="day_name[]" value="<?php echo  $timing->day_name; ?>">
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?php echo  $timing->day_name; ?></td>
                                                <td style="width:200px;  ">
                                                 <select name="closed[]" onchange="getClosedStatus(this.value,'<?php echo $i; ?>')" required="" class="form-control" style="padding-left:0px;height: 30px;">
                                                  
                                                   
                                                   <option value="0" <?php if($closed_status=='0') echo 'selected'; ?> >Open</option>
                                                   <option value="1" <?php if($closed_status=='1') echo 'selected'; ?> style="color:red !important;">Closed</option>
                                               
                                                </select>
                                            </td>
                                                <td>
                                                    
                                                    <div class="col-md-2"><b>From </b></div>
                                                    <div class="col-md-4"><input type="time" class="timing<?php echo $i; ?>" name="start_time[]" value="<?php echo  $timing->start_time; ?>" placeholder="start time" <?php echo $red; ?><?php echo $dis; ?>  style="<?php echo $style; ?>"> </div>
                                                    <div class="col-md-2"><b> To </b></div>
                                                    <div class="col-md-4"><input type="time" class="timing<?php echo $i; ?>"  name="end_time[]" value="<?php echo  $timing->end_time; ?>"  placeholder="end time" <?php echo $red; ?><?php echo $dis; ?>  style="<?php echo $style; ?>" ></div>
                                                </td>
                                            </tr>

                                            <?php $i++;  }  ?> 

                                            
                                        </tbody>
                                    </table>

                                       <?php }else{?>

                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Day</th>
                                                <th>Open/Close</th>
                                                <th colspan="2" class="text-center">Timing</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           <?php  $i=1;   
                                            
                                               $DayArray=array('mon' => 'Monday','tue' => 'Tuesday' ,'wed' => 'Wednesday' , 'thur' => 'Thursday' ,'fri' => 'Friday', 'sat' => 'Saturday' ,'sun' => 'Sunday');
                                           foreach($DayArray as $key => $val)
                                           {  

                                             ?>
                                               <tr>
                                            <input type="hidden" name="day_name[]" value="<?php echo  $val; ?>">
                                                <th scope="row"><?php echo $i; ?></th>
                                                <td><?php echo  $val; ?></td>
                                                <td style="width:200px;  ">
                                                 <select name="closed[]" onchange="getClosedStatus(this.value,'<?php echo $i; ?>')" required="" class="form-control" style="padding-left:0px;height: 30px;">
                                                  
                                                   
                                                   <option value="0" >Open</option>
                                                   <option value="1"  style="color:red !important;" >Closed</option>
                                               
                                                </select>
                                            </td>
                                                <td>
                                                    
                                                    <div class="col-md-2"><b>From </b></div>
                                                    <div class="col-md-4"><input type="time" class="timing<?php echo $i; ?>" name="start_time[]"  placeholder="start time" > </div>
                                                    <div class="col-md-2"><b> To </b></div>
                                                    <div class="col-md-4"><input type="time" class="timing<?php echo $i; ?>"  name="end_time[]"   placeholder="end time"  ></div>
                                                </td>
                                            </tr>

                                            <?php $i++;  }  ?> 

                                            
                                        </tbody>
                                    </table>
                                              
                                       <?php }?>

                                        <button type="submit" class="btn btn-primary m-t-xs m-b-xs" name="submit">Update Timing</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
      
        <div class="cd-overlay"></div>
	

       
        <?php include('common/footer-js.php'); ?>
 <script>
    function getClosedStatus(vl,rid)
    {
       switch(vl)
       {
         case "1":
          $('.timing' + rid).prop('disable',true);
          $('.timing' + rid).prop('readonly',true);
          $('.timing' + rid).prop('style','background:rgb(149, 149, 150);height:30px');
         break;

         case "0":
          $('.timing' + rid).prop('disable',false);
          $('.timing' + rid).prop('readonly',false);
          $('.timing' + rid).prop('style','background:white;height:30px');
         break;
       }
    }
  </script>


    </body>
</html>