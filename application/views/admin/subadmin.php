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
                            <li class="active">SubAdmin </li>
                            <li class=""><a href="<?php echo  base_url(); ?>admin/allmerchant">Back</a></li>
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
                                    <h4 class="panel-title">Add New Subadmin</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="title">Name : <span class="text-danger">*</span></label>
                                            <input type="text" required  name="name" class="form-control m-t-xxs" id="title" placeholder="Name of sub-admin * ">
                                           
                                            </div>

                                           
                                            <div class="col-md-4">
                                                <label for="twitter_link"> Email: <span class="text-danger">*</span> </label>
                                           <input type="email" required  name="email" class="form-control" placeholder="email of subadmin  here * " />
                                            </div>

                                          <div class="col-md-4">
                                            <label for="description">Password : <span class="text-danger">*</span>  </label>
                                            <input type="text" required="required" name="password" class="form-control" placeholder="password here  * ">
                                           </div>

                                        </div>
                                         <div class="form-group row">
                                            <div class="col-md-8">
                                           
                                            </div>
                                             <div class="col-md-4">
                                                 <button type="submit" class="btn btn-info m-t-xs m-b-xs" name="submit">Add SubAdmin</button>
                                             </div>
                                            
                                        </div>
                                        
                                       
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">SubAdmin List </h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                              <?php if(count($subadmins) >0) { ?>
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>Name</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                             <?php foreach ($subadmins as $key => $value) { ?>
                                            <tr id="row_<?php echo $value->id; ?>">
                                                <td><?php echo  $value->name; ?></td>
                                                <td style="width:200px; "><?php echo  $value->email; ?></td>
                                                <td><?php echo  $value->password; ?></td>
                                                <td id="st_<?php echo $value->id; ?>">
                                                  <?php 
                                                  $status=$value->status;
                                               switch ($status) 
                                                {
                                                  case 1:
                                                ?>
                                                    <button  onclick="changeStatus('deactivate',<?php echo $value->id; ?>)" class="btn btn-xs btn-success">Active</button>
                                                <?php
                                                  break;
                                                  case 2:
                                                ?>
                                                    <button onclick="changeStatus('activate',<?php echo $value->id; ?>)" class="btn btn-xs btn-danger">Deactive</button>
                                                <?php
                                                  break;  
                                                }
                                                  ?>
                                                </td>
                                               <td>
                                                    <a href="javascript:void();" onclick="delData('master_admin','<?php echo $value->id; ?>')"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

                                                    <a href="<?php echo  base_url(); ?>admin/edit-subadmin/<?php echo $value->id; ?>" class=" btn btn-xs btn-success"><i class="fa fa-edit"></i></a>




                                                  
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                       </table> 
                                       <?php }else{?>
                                       <div class="text-center text-danger">No Record...</div>
                                       <?php }?> 
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
    

       
        <?php include('common/footer-js.php'); ?>
<script type="text/javascript">

 function changeStatus(act,rid)
{   
 if (confirm('Are you sure you want to ' + act + ' this?')) {
   
     var base_url='<?php echo base_url(); ?>';
     var md="subadmin";
   
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

function delData(tbl,rowid)
{   
     
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
               $('#msgDivAjax').html('<div class="alert alert-success background-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Deleted Successfully</div>');
              }
          });


   }
}


        </script>
    </body>
</html>