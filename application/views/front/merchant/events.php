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
                                <h1>Events</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Events</li>
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
         <div class="agent-details-page pt-10">
            <!--Agent Deatils start-->
            <div class="agent-details">
                <div class="container">
                    
                    <div class="row pb-120">
                        <div class="col-md-12">
                            <div class="section-title text-center">
                                <h3>All <span>Events</span> <a class="btn btn-sm btn-primary btn-profile pull-right" href="<?php echo base_url(); ?>merchant/add-event"><i class="fa fa-plus"></i> Add Event</a></h3>
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

                            
                           <div class="table-responsive">
                            <table class="table table-bordered  table-hover">
                                <thead> 
                                    <tr>
                                        <th>#</th> 
                                        <th>Name</th>
                                        <th style="width: 30%;">Description</th> 
                                        <th style="width: 20%;">Date Time</th>
                                        <th>Entry Fee</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr> 
                                </thead>
                                <tbody> 
                                    <?php
                                   if(count($getData)!='0')
                                   {
                                    $a=1;
                                    foreach($getData as $bkr)
                                    {
                                        $status=$bkr->status;

                                    ?>
                                    <tr id="tr_<?php echo $bkr->id; ?>">
                                        <th scope="row"><?php echo $a; ?></th>
                                        <td><?php echo $bkr->name; ?></td> 
                                        <td><?php echo $bkr->description; ?></td> 
                                        <td><?php echo date('F j,Y',strtotime($bkr->start_date)); ?> to <?php echo date('F j,Y',strtotime($bkr->end_date)); ?> at <?php echo date('g:i a',strtotime($bkr->time)); ?></td> 
                                        <td><i class="fa fa-inr"></i> <?php echo $bkr->entry_fee_per_person; ?> / person</td> 
                                        <td><img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $bkr->image?>" style="width:100px"></td> 
                                           <td id="st_<?php echo $bkr->id; ?>">
                                            <?php 
                                           switch($status)
                                            {
                                                case "0":
                                            ?>
                                                <button onclick="changeStatus('activate',<?php echo $bkr->id; ?>)" class="btn btn-sm btn-danger btn-mini">Deactive</button>
                                            <?php
                                                break;

                                                case "1":
                                             ?>
                                                <button  onclick="changeStatus('deactivate',<?php echo $bkr->id; ?>)" class="btn btn-sm btn-success btn-mini">Active</button>
                                            <?php
                                                break;
                                            }
                                            ?>
                                           </td>
                                           <td> 
                                           <button  onclick="delData(<?php echo $bkr->id; ?>)"  class="btn btn-sm btn-danger btn-mini"><i class="fa fa-trash"></i></button>
                                                                            
                                           <a href="<?php echo base_url(); ?>merchant/edit-event/<?php echo $bkr->id; ?>" class="btn btn-sm btn-primary btn-mini"><i class="fa fa-edit"></i></a>

                                           <a class="btn btn-sm btn-success btn-mini" href="<?php echo base_url(); ?>merchant/event-gallery/<?php echo $bkr->id; ?>">Gallery</a>
                                        </td> 
                                    </tr> 
                                   <?php
                                   $a++;
                                    }
                                   }
                                   else
                                    {
                                        ?>
                                       <tr><td colspan="8" style="text-align:center">No Event Found</td></tr>
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
            <!--Agent Deatils end-->
           
        </div>
    
        
        
        
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>


                                                           
<script>

function delData(rid)
{   
 if (confirm('Are you sure you want to delete this?')) {
     
     var base_url='<?php echo base_url(); ?>';
     var md="event";
     
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


function changeStatus(act,rid)
{   
 if (confirm('Are you sure you want to ' + act + ' this?')) {
     
     var base_url='<?php echo base_url(); ?>';
     var md="event";
     
     $.ajax({
         type: "GET",
         url: base_url + "merchant/statusToggle", 
         data: {rowid: rid , mode : md , action : act},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                $('#st_' + rid).html(data);  //as a debugging message.
                switch(act)
                {
                    case "activate":
                       var act_txt="Activated";
                    break;
                    
                    case "deactivate":
                       var act_txt="Deactivated";
                    break;
                }
                $('#msgDivAjax').html('<div class="alert alert-success background-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+ act_txt +' Successfully</div>');
                
              }
          });// you have missed this bracket
   }
}

</script>
	
</body>
</html>