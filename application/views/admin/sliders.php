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
                            <li class="active">Sliders</li>
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
                       <div id="msgDivAjax">
                            
                       </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                           <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">All Sliders </h4>

                                    <a class="btn btn-xs btn-info pull-right" href="<?php echo base_url() ?>admin/add-slider"><i class="fa fa-plus"></i> Add Slider</a>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th style="width: 40%;">Description</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th style="width: 40%;">Description</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php
                                              $sl=1;
                                              foreach($getData as $row)
                                               {

                                            ?>
                                            <tr id="tr_<?php echo $row->id; ?>">
                                              <td><?php echo $sl; ?></td>
                                              <td><?php echo $row->title; ?></td>
                                              <td><?php echo $row->description; ?></td>
                                              
                                              <td><img src="<?php echo base_url(); ?>assets/front/uploads/slider/<?php echo $row->image; ?>" style="width:100px"></td>
                                              
                                              <td id="st_<?php echo $row->id; ?>">
                                                <?php
                                                 $status=$row->status;
                                                switch ($status) 
                                                {
                                                  case 1:
                                                ?>
                                                    <button  onclick="changeStatus('deactivate',<?php echo $row->id; ?>)" class="btn btn-xs btn-success">Active</button>
                                                <?php
                                                  break;
                                                  case 2:
                                                ?>
                                                    <button onclick="changeStatus('activate',<?php echo $row->id; ?>)" class="btn btn-xs btn-danger">Deactive</button>
                                                <?php
                                                  break;  
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button  onclick="delData(<?php echo $row->id; ?>)"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                      
                                                <a href="<?php echo base_url(); ?>admin/edit-slider/<?php echo $row->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                      
                                              </td>
                                                                       
                                            </tr>
                                  
                                                                 <?php
                                                                 $sl++;
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



       
        <?php include('common/footer-js.php'); ?>
      <script>

function delData(rid)
{   
 if (confirm('Are you sure you want to delete this?')) {
   
     var base_url='<?php echo base_url(); ?>';
     var md="slider";
   
     $.ajax({
         type: "GET",
         url: base_url + "admin/deleteMsgData", 
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
     var md="slider";
   
     $.ajax({
         type: "GET",
         url: base_url + "admin/statusToggle", 
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