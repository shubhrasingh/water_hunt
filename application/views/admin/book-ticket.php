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
                            <li class="active">Booking</li>
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

                            <div class="alertmessage">
                                
                            </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Booking</a></li>
    <li><a data-toggle="tab" href="#menu1">Enquiry</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Booking Ticket List</h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">

 <?php if(count($getBooking_Ticketbooking)>0) {  ?>

                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Visitors</th>
                                                <th>Gst</th>
                                                <th>Total Amount(&#8377;)</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Visitors</th>
                                                <th>Gst</th>
                                                <th>Total Amount(&#8377;)</th>
                                                <th>Payment Status</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                             <?php foreach ($getBooking_Ticketbooking as $key => $value) { ?>
                                            <tr id="row_<?php echo $value->id;?>">
                                                <td><?php echo  'Name :'.$value->name.'<br/> Email :'.$value->email.'<br/> Address: '.$value->address; ?></td>
                                                <td><?php echo  'Adults : '.$value->number_of_adults.'<br/> Children :'.$value->number_of_children; ?></td>
                                                <td><?php echo  'Gst:'.$value->gst.'<br/> Cgst:'.$value->cgst; ?></td>
                                                <td><?php echo  $value->gross_total; ?></td>
                                               
                                                <td>
                                                  <div class="statuofrow<?php echo $value->id;?>">
                                                 <?php  if($value->payment_status=='1') {?>
                                                <button  class="btn btn-xs btn-info">Complete</button>
                                                    <?php }else if($value->payment_status=='2'){?>
                                                <button class="btn btn-xs btn-danger">Payment Failed..</button>
                                                    <?php }else{?>
                                                <button class="btn btn-xs btn-danger">Pending</button>
                                                    <?php }?>
                                                       
                                                    </div>
                                                </td>
                                                <td>
                                                    
                                                    <a  href="javascript:void()"  onclick="getbookingDetails(<?php echo  $value->id; ?>)"    data-toggle="modal" data-target="#myModal"  class=" btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>

                                                       <a href="javascript:void();" onclick="delData('ticket_request','<?php echo $value->id; ?>')"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

                                                       
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                       </table> 

                                       <?php } else{ ?>
                                         <div class="text-center">No Records ....</div>
                                       <?php }?> 
                                    </div>
                                </div>
                            </div>
    </div>
    <div id="menu1" class="tab-pane fade">
        <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Enquiry Ticket</h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">

 <?php if(count($getEnquiry_Ticketbooking)>0) { ?>
                                <table id="example1" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Visitors</th>
                                               
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                               <th>Name</th>
                                                <th>Visitors</th>
                                               
                                                <th>Message</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                             <?php foreach ($getEnquiry_Ticketbooking as $key => $value) { ?>
                                           <tr id="row_<?php echo $value->id;?>">
                                                <td><?php echo  'Name :'.$value->name.'<br/> Email :'.$value->email.'<br/> Address: '.$value->address; ?></td>
                                                <td><?php echo  'Adults : '.$value->number_of_adults.'<br/> Children :'.$value->number_of_children; ?></td>
                                               
                                                <td style="width:400px; ">
                                                 
                                                 <?php  echo $value->message;?>
                                              
                                                </td>
                                                <td>
                                                    
                                                    <a  href="javascript:void()"  onclick="getbookingDetails(<?php echo  $value->id; ?>)"    data-toggle="modal" data-target="#myModal"  class=" btn btn-xs btn-warning"><i class="fa fa-eye"></i></a>

                                                       <a href="javascript:void();" onclick="delData('ticket_request','<?php echo $value->id; ?>')"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

                                                       
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                       </table> 

                                       <?php } else{ ?>
                                         <div class="text-center">No Records ....</div>
                                       <?php }?> 
                                    </div>
                                </div>
                            </div>
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
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    
                </div>
            </div>
        </div>

        <!--Start of   Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     
                    
                </div>
            </div>
        </div><!--  End Of Modal Code -->


       
        <?php include('common/footer-js.php'); ?>
       <script type="text/javascript">

        $(document).ready(function() {
    $('#example1').DataTable();
} );
            
            function changeStatus(id,table)
            {
               $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>admin/statusTogg',
                    data: {id: id,table:table},
                    success: function (ht) { 
                        //alert(ht); 
                      $('.statuofrow'+id+' button').html(ht); 
                    }
                  });
            }

           

function delData(tbl,rowid)
{   
   //alert(tbl+'--'+rowid); exit();      
 if (confirm('Are you sure you want to delete this?')) {
     
     var base_url='<?php echo  base_url(); ?>';
     
    
     $.ajax({
         type: "post",
         url: base_url + "admin/deleteRecord", 
         data: {id: rowid , table : tbl },
         cache:false,
         success: 
              function(data){
               // alert(data); 
               $('#row_' + rowid).remove(); 
                $('.alertmessage').html('<div class="alert alert-success" >Record Delete Successfully..</div>');
              }
          });


   }
}


function getbookingDetails(bookingid)
            {
              $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>admin/getbookingDetails',
                    data: {Bid: bookingid},
                    success: function (ht) { 
                        //alert(ht); 
                        //console.log(ht);
                      $('.modal-content').html(ht); 
                    }
                  });

            }


        </script>


    </body>
</html>