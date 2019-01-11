<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo $userDetails[0]->name; ?> - <?php echo $siteDetails['companyData']['0']->company_name; ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php $this->load->view('front/common/css.php'); ?>
	<style type="text/css">
   input
   {
    background:#fff;
   } 
    select
   {
    background:#fff;
   }
  </style>>
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
                                <h1>Edit Timing</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Edit Timing</li>
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
                    <div class="row">
                      
                        <div class="col-md-3 col-sm-4 col-xs-12">
						                   <?php  $this->load->view('front/common/merchant-sidebar'); ?>
                        </div>
						
                         <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="contact-inquiry" style="margin-bottom: 20px;">
                                <div class="contact-inquiry-title">
                                    <h5>Edit Timing</h5>
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
                                <div class="contact-inquiry-form">
                                     <?php 
                                      echo form_open_multipart();
                                     ?>
                                       <table class="table table-border">
                                          <thead> 
                                            <tr>
                                              <th  class="text-center">#</th> 
                                              <th class="text-center">Day</th>
                                              <th class="text-center">Closed</th> 
                                              <th  class="text-center">Timing</th> 
                                              <th  class="text-center"></th> 
                                              
                                            </tr> 
                                          </thead>
                                          <tbody> 
                                             <?php
                                             $a=0;
                                             $merchantId=$this->session->userdata('WhUserLoggedinId');
                                             $arr='mon,tue,wed,thur,fri,sat,sun';
                                             $DayArray=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                                             foreach($DayArray as  $val)
                                             {
                                               $getDt=$this->Admin_model->getWhere('merchant_timing',array('merchant_id' => $merchantId,'day_name' =>$val));
                                               if(count($getDt)!=0)
                                               {
                                                 $closed_status=$getDt[0]->closed_status;
                                                 $start_time=$getDt[0]->start_time;
                                                 $end_time=$getDt[0]->end_time;
                                               }
                                               
                                               ?>
                                              <tr>
                                                 <input type="hidden" name="day_name[]" value="<?php echo $val; ?>">
                                              <td  class="text-center" scope="row"><?php echo $a + 1; ?></td>
                                              <td  class="text-center"><?php echo $val; ?></td> 
                                              <td  class="text-center">
                                                <select name="closed[]" id="closed_<?php echo $a; ?>" onchange="getClosedStatus(this.value,'<?php echo $a; ?>')" required style="padding-left:0px;height: 30px;">
                                                   <option value="0" <?php if((count($getDt)!=0) && ($closed_status=='0')) { echo "selected"; }?>>Open</option>
                                                   <option value="1" <?php if((count($getDt)!=0) && ($closed_status=='1')) { echo "selected"; }?>>Closed</option>
                                                </select>
                                              </td> 
                                              <td  class="text-center">
                                                   <div class="col-sm-2">
                                                       <label>From</label>
                                                 </div>
                                                 
                                                 <div class="col-sm-4">                          
                                                       <input type="time" id="start_time_<?php echo $a; ?>" class="timing<?php echo $a; ?>" name="start_time[]" <?php if(count($getDt)!=0) { ?> value="<?php echo $start_time; ?>" <?php } ?> required placeholder="Start Time" style="height: 30px;background:white">
                                                  </div>
                                                  
                                                  <div class="col-sm-2">
                                                       <label>To</label>
                                                 </div>
                                                 
                                                  <div class="col-sm-4">
                                                       <input type="time" id="end_time_<?php echo $a; ?>" class="timing<?php echo $a; ?>" name="end_time[]" <?php if(count($getDt)!=0) { ?> value="<?php echo $end_time; ?>" <?php } ?>  required style="height: 30px;background:white" placeholder="End Time">
                                                  </div>
                                              </td> 
                                              <td>
                                                <?php
                                                 if($a!=0)
                                                 {
                                                  $b=$a-1;
                                                  $prevDay=$DayArray[$b];
                                                  ?>
                                                    <input type="checkbox" value="1" onchange="getTimeCheck('<?php echo $a; ?>','<?php echo $b; ?>')" id="checkDay_<?php echo $a; ?>"> <label for="checkDay_<?php echo $a; ?>" style="font-weight:normal;font-size: 13px;cursor:pointer">Same as <?php echo $prevDay; ?></label>
                                                  <?php
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
                                        
                                        <div class="submit-form">
                                            <button type="submit" name="submit">Submit</button>
                                        </div>

                                    <?php echo form_close(); ?>
                                    
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
	
  <script>
    function getClosedStatus(vl,rid)
    {
       switch(vl)
       {
         case "1":

          $('.timing' + rid).prop('readonly',true);
          $('.timing' + rid).prop('style','background:#eceff8;height:30px');
         break;

         case "0":
          $('.timing' + rid).prop('readonly',false);
          $('.timing' + rid).prop('style','background:#fff;height:30px');
         break;
       }
    }

    function getTimeCheck(cid,pid)
    {
      var chk=document.getElementById('checkDay_' + cid).checked;
      if(chk==true)
      {
        var cls=$('#closed_' + pid).val();
        $('#closed_' + cid).val(cls);
        switch(cls)
        {
          case "1":

            $('#start_time_' + cid).val('');
            $('#end_time_' + cid).val('');

            $('.timing' + cid).prop('readonly',true);
            $('.timing' + cid).prop('style','background:#eceff8;height:30px');

          break;

          case "0":

            var pst=$('#start_time_' + pid).val();
            var pet=$('#end_time_' + pid).val();

            $('#start_time_' + cid).val(pst);
            $('#end_time_' + cid).val(pet);

             $('.timing' + cid).prop('readonly',false);
             $('.timing' + cid).prop('style','background:#fff;height:30px');

          break;
        }
      }
      else
      {
           $('#closed_' + cid).val('0');
           $('#start_time_' + cid).val('');
           $('#end_time_' + cid).val('');

           $('.timing' + cid).prop('readonly',false);
          $('.timing' + cid).prop('style','background:#fff;height:30px');
      }
      

    }
  </script>  
</body>
</html>