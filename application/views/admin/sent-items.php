<!DOCTYPE html>
<html lang="en">
<head>
        
        <?php include('common/header-css.php'); ?>

        <style type="text/css">
          .select2-container
          {
            z-index:9999;
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
                            <li class="active">Sent Items</li>
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

                            <div id="msgDivAjax"></div>

                    </div>


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
                                      <ul class="list-unstyled mailbox-nav" >
                                          <li><a href="<?php echo base_url(); ?>admin/messages"><i class="icon-envelope-open"></i>Inbox <span class="badge badge-info pull-right"><?php echo $unseenCount ?></span></a></li>
                                          <li class="active"><a href="<?php echo base_url(); ?>admin/messages/sent-items"><i class="icon-paper-plane"></i>Sent <span class="badge badge-default pull-right"><?php echo $sentItemsCount; ?></span></a></li>
                                         
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
                                                          <span class="text-muted m-r-sm"><?php echo $fromData; ?> - <?php echo $toData; ?> of <?php echo $sentItemsCount; ?> </span>

                                                          <div class="btn-group m-r-sm ">
                                                              <a class="btn btn-default" data-toggle="tooltip" data-placement="top" onclick="delData()" title="Delete"><i class="fa fa-trash"></i></a>

                                                          </div>
                                                          
                                                          <div class="btn-group">
                                                              
                                                          </div>
                                                      </th>
                                                  </tr>
                                              </thead>
                                              <tbody id="tbodyDiv">
                                                 <?php

                                                 foreach($getSentItems as $rt)
                                                 {
                                                    $merchantId=$rt->merchant_id;

                                                    $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
                                                 ?>
                                                  <tr id="tr_<?php echo $rt->id; ?>" >
                                                      <td class="hidden-xs">
                                                          <span><input id="checkItem<?php echo $rt->id; ?>" onclick="addActionClass('<?php echo $rt->id; ?>')" type="checkbox" value="<?php echo $rt->id; ?>" name="m_row" class="checkbox-mail mailNumber"></span>
                                                      </td>
                                                      <td class="hidden-xs">
                                                          <?php echo $getMerchant[0]->waterpark_name; ?>
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
                                                                      if($sentItemsCount > $fetchLimit)
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
                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
    
       <div class="modal fade" id="compose-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h3 class="modal-title" id="myModalLabel">Compose Message</h3>
                    </div>
                     <?php
                       echo form_open('admin/compose-message');
                      ?> 
                    <div class="modal-body row">
                       <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Merchant</label>
                                             <select name="merchant_id" class="js-states form-control" tabindex="-1" style="width: 100%">
                                        
                                                  <optgroup label="Merchant Name"> 
                                                      <option value="">---------Select Merchant----------</option>
                                                      <?php
                                                      $getMerchant=$this->Admin_model->getWhere('merchants',array('status' => 1));
                                                      foreach($getMerchant as $mr)
                                                      {
                                                        ?>
                                                          <option value="<?php echo $mr->id; ?>"><?php echo $mr->waterpark_name; ?></option>
                                                        <?php
                                                      }
                                                      ?>
                                                      
                                                  </optgroup>
                                              </select>
                                           
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Message</label>
                                             <textarea name="message" class="form-control m-t-xxs" placeholder="Write your message here" required></textarea>
                                        </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button type="submit" name="compose_message" class="btn btn-success">Send</button>
                    </div>
                    <?php echo form_close(); ?>     
                </div>
            </div>
        </div>

      
        <div class="modal fade" id="read-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h3 class="modal-title" id="myModalLabel">Read Message</h3>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-xs-12"  id="ajaxDetail">
                          
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>  
                </div>
            </div>
        </div>
       
        <?php include('common/footer-js.php'); ?>


    <script type="text/javascript">

      
      function viewMessage(rid)
            {
                 var base_url='<?php echo base_url(); ?>';
                 var md="readMessageSent";
                 
                 $.ajax({
                     type: "GET",
                     url: base_url + "merchant/readMessageAjax", 
                     data: {rowid: rid , mode : md },
                     dataType: "text",  
                     cache:false,
                     success: 
                          function(data){
                            $('#ajaxDetail').html(data);  //as a debugging message.
                          }
                      });// you have missed this bracket
            }

      

           function delData()
            {   
             if (confirm('Are you sure you want to delete this?')) {
                 
                 var base_url='<?php echo base_url(); ?>';
                 var md="messageSentItems";
                 
                 var msgSel = [];
                 $.each($("input[name='m_row']:checked"), function(){            
                            msgSel.push($(this).val());
                 });
                 var selMsg=msgSel.join(", ");

                 $.ajax({
                     type: "GET",
                     url: base_url + "admin/deleteMsgData", 
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