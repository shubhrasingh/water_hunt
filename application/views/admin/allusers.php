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
                            <li class="active">Users</li>
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
                    <div class="row">
                        <div class="col-md-12">
                           <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">All Users</h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">

 <?php if(count($getAllUsers)>0) { ?>
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                             <?php foreach ($getAllUsers as $key => $value) { ?>
                                            <tr id="row_<?php echo $value->id;?>">
                                                <td><?php echo  $value->name; ?></td>
                                                <td><?php echo  $value->email; ?></td>
                                                <td><?php echo  $value->mobile; ?></td>
                                                <td><?php echo  $value->address; ?></td>
                                                <td>
                                                     <div class="statuofrow<?php echo $value->id;?>">
                                                      
                                                        <?php  if($value->status=='0') {?>
                                                     <button onclick="changeStatus(<?php echo $value->id;?>,'users')" class="btn btn-xs btn-danger">Deactive</button>
                                                    <?php }else{?> 
                                                   <button onclick="changeStatus(<?php echo $value->id;?>,'users')" class="btn btn-xs btn-info">Active</button>
                                                    <?php }?>
                                                       
                                                    </div>
                                                </td>
                                                <td>
                                                    
                                                    <!-- <a href="<?php echo  base_url(); ?>admin/delete_merchant/<?php echo $value->id;?>"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a> -->

                                                       <a href="javascript:void();" onclick="delData('users','<?php echo $value->id; ?>')"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                       </table> 

                                       <?php } else{ ?>
                                         <div class="text-center">No Users ....</div>
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
	
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    
                </div>
            </div>
        </div>



       
        <?php include('common/footer-js.php'); ?>
       <script type="text/javascript">
            
            function changeStatus(id,table)
            {
               $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>admin/statusTogg',
                    data: {id: id,table:table},
                    success: function (ht) { 
                     if (ht=='Active') {
                         $('.statuofrow'+id+' button').removeClass("btn-danger");
                         $('.statuofrow'+id+' button').addClass("btn-info");
                         $('.statuofrow'+id+' button').html(ht);
                      }
                      if(ht=='Deactive')
                      {
                         $('.statuofrow'+id+' button').removeClass("btn-info");
                         $('.statuofrow'+id+' button').addClass("btn-danger");
                         $('.statuofrow'+id+' button').html(ht);
                      }
                    }
                  });
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