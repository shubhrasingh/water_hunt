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

      .mailbox-content table tbody tr.unread
      {
          background: #ffffff;
          color: #7F7F7F;
      }

      .mailbox-content table tbody tr.read 
      {
          background: #F9F9F9;
          color: #7F7F7F;
      }

    </style>
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
                                <h1>Messages</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Messages</li>
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
                                <h3>All <span> Messages</span> </h3>
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
                              <div class="row m-t-md">
                                  <div class="col-md-12">
                                      <div class="row mailbox-header">
                                          <div class="col-md-2">
                                              <a data-toggle="modal" data-target="#compose-message" class="btn btn-info btn-block">Compose</a>
                                          </div>
                                          <div class="col-md-6">
                                              <h2>Inbox</h2>
                                          </div>
                                          <div class="col-md-4 pull-right" style="text-align: right;">
                                              <!--<button class="btn btn-mini btn-danger">Delete Selected Messages</button>-->
                                         </div>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <ul class="list-unstyled mailbox-nav" style="background: #e5e8ea;">
                                          <li class="active"><a href="<?php echo base_url(); ?>merchant/messages"><i class="fa fa-envelope"></i> Inbox <span class="badge badge-info pull-right"><?php echo count($unseenCount) ?></span></a></li>
                                          <li><a href="<?php echo base_url(); ?>merchant/messages/sent-items"><i class="fa fa-reply"></i> Sent <span class="badge badge-default pull-right"><?php echo $getSentItems; ?></span></a></li>
                                         
                                      </ul>
                                  </div>
                                  <div class="col-md-10">
                                      <div class="mailbox-content">
                                          <table id="MwDataList" class="table">
                                              <thead>
                                                  <tr>
                                                      <th colspan="1" class="hidden-xs">
                                                          <span><input type="checkbox" onclick="checkforCheck()" id="check_mail_all" class="check-mail-all"></span>
                                                      </th>
                                                      <th class="text-right" colspan="5">
                                                          <span class="text-muted m-r-sm"><?php echo $fromData; ?> - <?php echo $toData; ?> of <?php echo $inboxCount; ?> </span>

                                                          <div class="btn-group m-r-sm mail-hidden-options">
                                                              <a class="btn btn-default" data-toggle="tooltip" data-placement="top" onclick="delData()" title="Delete"><i class="fa fa-trash"></i></a>
                                                         
                                                              <a class="btn btn-default" data-toggle="tooltip" data-placement="top" onclick="markasRead()" title="Mark as Read"><i class="fa fa-pencil"></i></a>

                                                          </div>
                                                          
                                                          <div class="btn-group">
                                                              
                                                          </div>
                                                      </th>
                                                  </tr>
                                              </thead>
                                              <tbody id="tbodyDiv">
                                                 <?php

                                                 foreach($getInbox as $rt)
                                                 {
                                                    $seenStatus=$rt->seen_status;
                                                    $adminId=$rt->admin_id;

                                                    $getAdmin=$this->Admin_model->getWhere('master_admin',array('id' => $adminId));

                                                    switch($seenStatus)
                                                    {
                                                      case "1":
                                                         $trClass="read";
                                                      break;

                                                      case "2":
                                                          $trClass="unread";
                                                      break;
                                                    }
                                                 ?>
                                                  <tr id="tr_<?php echo $rt->id; ?>" class="<?php echo $trClass; ?>">
                                                      <td class="hidden-xs">
                                                          <span><input id="checkItem<?php echo $rt->id; ?>" onclick="addActionClass('<?php echo $rt->id; ?>')" type="checkbox" value="<?php echo $rt->id; ?>" name="m_row" class="checkbox-mail mailNumber"></span>
                                                      </td>
                                                      <td class="hidden-xs">
                                                          <?php echo $getAdmin[0]->name; ?>
                                                      </td>
                                                      <td style="width: 60%;">
                                                          <?php echo substr($rt->message,0,100); ?>...<a  onclick="viewMessage('<?php echo $rt->id; ?>')" data-toggle="modal" data-target="#read-message" style="cursor:pointer">Read More</a>
                                                      </td>
                                                      <td>
                                                         <?php echo date('M j,Y g:i a',strtotime($rt->added_on)); ?>
                                                      </td>
                                                  </tr>

                                                  <?php
                                                   }
                                                  ?>
                                                 
                                              </tbody>

                                            </table>


                                               <div class="pagination">
                                                                  <div class="pagination-inner text-center">
                                                                    <?php
                                                                      if($inboxCount > $fetchLimit)
                                                                      {
                                                                      ?>  
                                                                        <ul class="page-numbers">
                                                                          <?php
                                                                          echo $this->pagination->create_links();
                                                                          ?>
                                                                        </ul>
                                                                      <?php
                                                                      }
                                                                      ?>
                                                                  </div>
                                                </div>
                                          </div>
                                  </div>
                              </div><!-- Row -->
                       </div>
                    </div>

                </div>
            </div>
            <!--Agent Deatils end-->
           
        </div>
        

        <!-- quick view start -->
              <div  class="modal fade" role="dialog" tabindex="-1" id="compose-message">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content" style="width:540px">
                          <div class="modal-body">
                              <div class="contact-inquiry" style="padding: 5% 0px;">
                                  <div aria-label="Close" data-dismiss="modal" class="modal-header">
                                    <span>x</span>
                                  </div>
                          
                                  <div class="contact-inquiry-title" style="padding-bottom: 2%;border-bottom: 1px solid #ccc;padding-left: 3%;">
                                      <h5 style="margin-bottom: 0px;">Compose Message</h5>               
                                  </div>

                                  <div class="contact-inquiry-form" style="padding: 3%;">
                                      <?php
                                         echo form_open('merchant/compose-message');
                                       ?>   

                                     <div class="form-bottom" >
                                       <textarea name="message" placeholder="Write your message here" required></textarea>
                                     </div>
                              
                                    <div class="submit-form">
                                       <button type="submit" name="compose_message">Submit</button>
                                    </div>
                                   <?php echo form_close(); ?>                                
                                 </div>
                             </div>
                          </div>
                      </div>
                  </div>
              </div>
             
              <!-- quick view end -->
         
          <!-- quick view start -->
    <div  class="modal fade" role="dialog" tabindex="-1" id="read-message">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:600px">
                <div class="modal-body">
                    <div class="contact-inquiry" style="padding: 5% 0px;">
                        <div aria-label="Close" data-dismiss="modal" class="modal-header">
                          <span>x</span>
                        </div>
                
                        <div class="contact-inquiry-title" style="padding-bottom: 2%;border-bottom: 1px solid #ccc;padding-left: 3%;">
                            <h5 style="margin-bottom: 0px;">Read Message</h5>               
                        </div>

                        <div class="contact-inquiry-form" id="ajaxDetail" style="padding: 3%;">
                                                        
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

      function viewMessage(rid)
            {
                 var base_url='<?php echo base_url(); ?>';
                 var md="readMessage";
                 
                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/readMessageAjax", 
                     data: {rowid: rid , mode : md },
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){
                            $('#ajaxDetail').html(data);  //as a debugging message.
                            $('#tr_' + rid).removeClass('unread');
                            $('#tr_' + rid).addClass('read');
                          }
                      });// you have missed this bracket
            }

      
            function markasRead()
            {   
                 
                 var base_url='<?php echo base_url(); ?>';
                 
                 var msgSel = [];
                 $.each($("input[name='m_row']:checked"), function(){            
                            msgSel.push($(this).val());
                 });
                 var selMsg=msgSel.join(", ");

                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/markAsRead", 
                     data: {rowid: selMsg },
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){

                            $("#MwDataList input[name=m_row]:checked").closest('tr').removeClass('unread');
                            $("#MwDataList input[name=m_row]:checked").closest('tr').addClass('read');
                            $('.actionThisCheck').prop('checked',false);
                            $('#check_mail_all').prop('checked',false);
                          }
                      });// you have missed this bracket
            }

           function delData()
            {   
             if (confirm('Are you sure you want to delete this?')) {
                 
                 var base_url='<?php echo base_url(); ?>';
                 var md="messageInbox";
                 
                 var msgSel = [];
                 $.each($("input[name='m_row']:checked"), function(){            
                            msgSel.push($(this).val());
                 });
                 var selMsg=msgSel.join(", ");

                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/deleteData", 
                     data: {rowid: selMsg , mode : md },
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){

                           $("#MwDataList input[name=m_row]:checked").closest('tr').remove();
                            $('#check_mail_all').prop('checked',false);

                            $('#msgDivAjax').html('<div class="alert alert-success background-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Deleted Successfully</div>');
                            
                          }
                      });// you have missed this bracket
               }
            }
            
            
            function checkforCheck()
            {
              var chk=document.getElementById('check_mail_all').checked;
              if(chk==true)
              {
                $('.mailNumber').prop('checked',true);
                $('.mailNumber').addClass('actionThisCheck');
              }
              else
              {
                $('.mailNumber').prop('checked',false);
                $('.mailNumber').removeClass('actionThisCheck');
              }
            }

            function addActionClass(rid)
            {
              var chk=document.getElementById('checkItem' + rid).checked;
              if(chk==true)
              {
                $('#checkItem' + rid).addClass('actionThisCheck');
              }
              else
              {
                $('#checkItem' + rid).removeClass('actionThisCheck');
              }
            }

    </script>

</body>
</html>