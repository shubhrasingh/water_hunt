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
                                <h1>Edit Gallery</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Edit Gallery</li>
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
         <div class="creat-agency-page pt-50">
     
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                         <?php 
                            echo form_open_multipart();
                        ?>
                          <input type="hidden" name="rowid" value="<?php echo $getData[0]->id; ?>">
                            <div class="creat-agency-profile">
                                <div class="agency-profile-title">
                                    <h5>Edit Gallery</h5>
                                </div>
                                <div class="creat-agency-form">
                                    <input type="text" value="<?php echo $getData[0]->title; ?>" name="title" placeholder="Title" required>
                                    <textarea name="description" class="mb0" required placeholder="Description"><?php echo strip_tags($getData[0]->description); ?></textarea>

                                    <input type="file" name="file" style="margin-top:10px">
                                    
                                    <img src="<?php echo base_url(); ?>assets/front/uploads/gallery/<?php echo $getData[0]->image; ?>" style="width:100px;">

                                    <div class="submit-form mt0 mb33">
                                            <button type="submit" name="update">Submit</button>
                                    </div>
                                </div>
                            </div>
                          <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            
        </div>
    
        
        
        
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>
	
</body>
</html>