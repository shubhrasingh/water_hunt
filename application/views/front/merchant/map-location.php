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
                                <h1>Map Location</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Map Location</li>
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
                             $map_iframe=$userDetails[0]->map_iframe;
                             if(empty($map_iframe))
                             {
                                $map_iframe='<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227821.933757976!2d80.80242330326529!3d26.84892933300214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd991f32b16b%3A0x93ccba8909978be7!2sLucknow%2C+Uttar+Pradesh!5e0!3m2!1sen!2sin!4v1547104741394" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
                             }

                             
                        ?>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <div class="agent-description">
                               <h4 class="pb2" style="border-bottom: 1px solid #ddd;"> Location on Map  <a data-target="#quick-view"  data-toggle="modal" class="btn btn-mini btn-success pull-right">Update Map</a> </h4>
                                <div class="agent-text">   
                                  <?php echo $map_iframe; ?>
                                </div>
                            </div>                      
                        </div>
                    </div>
                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
    
        

 <!-- quick view start -->
    <div  class="modal fade" role="dialog" tabindex="-1" id="quick-view">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:540px">
                <div class="modal-body">
                    <div class="contact-inquiry" style="padding: 5% 0px;">
                        <div aria-label="Close" data-dismiss="modal" class="modal-header">
                          <span>x</span>
                        </div>
                
                        <div class="contact-inquiry-title" style="padding-bottom: 2%;border-bottom: 1px solid #ccc;padding-left: 3%;">
                            <h5 style="margin-bottom: 0px;">Update Map</h5>               
                        </div>

                        <div class="contact-inquiry-form" style="padding: 3%;">
                            <?php
                               echo form_open_multipart();
                             ?>
                                        
                           <div class="form-bottom" >
                             <textarea name="map_iframe" placeholder="Paste the iframe of your map here"></textarea>
                           </div>
                    
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
   
    <!-- quick view end -->

        <?php $this->load->view('front/common/footer.php'); ?>
        
    </div>
    
    <?php $this->load->view('front/common/js.php'); ?>

    <script type="text/javascript">
      function selProfileType(vl)
      {
         switch(vl)
         {
          case "1":
            $('#imgDiv').show();
            $('#videoDiv').hide();
          break;

          case "2":
            $('#imgDiv').hide();
            $('#videoDiv').show();
          break;
         }
      }
    </script>
</body>
</html>