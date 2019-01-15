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
                            <li class="active">Gallery</li>
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

                        <div id="msgDivAjax"></div>

                    </div>
                    <div class="row">
                       
                        <div class="col-md-12">
                           
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Update Gallery</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data">
                                       
                                        

                                        <div class="form-group row">
                                            
                                           
                                            <div class="col-md-4">
                                                <label for="title">Title :</label>
                                            <input type="text" required  name="title" class="form-control m-t-xxs" id="title" value="<?php echo  $singlegallery[0]->title; ?>" placeholder="Title of Image .... ">
                                            <input type="hidden"   name="id" value="<?php echo $merchants[0]->id; ?> ">
                                            <input type="hidden"   name="eventid" value="<?php echo $eventid; ?> ">
                                            </div>

                                           
                                            <div class="col-md-4">
                                                <label for="twitter_link"> Images: </label>
                                           <input type="file"   name="file" class="form-control" />
                                            </div>

                                            <div class="col-md-4">
                                              <img src="<?php echo  base_url(); ?>assets/front/uploads/events/<?php echo $singlegallery[0]->image;?>" style="height:100px; ">
                                            </div>

                                        </div>
                                         <div class="form-group row">
                                            <div class="col-md-8">
                                            <label for="description">Description :  </label>
                                            
                                            <textarea name="description" required="required" rows="2"  class="form-control m-t-xxs" placeholder="description ..." ><?php echo  $singlegallery[0]->description; ?></textarea>
                                            </div>
                                             <div class="col-md-4">
                                                 <button type="submit" class="btn btn-info m-t-xs m-b-xs" name="update">Update Gallery</button>
                                             </div>
                                            
                                        </div>
                                        
                                       
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Event`s Gallery Of <b><?php echo ucfirst($merchants[0]->waterpark_name); ?></b></h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php if(count($Gallery)>0) {?>
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Merchant</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Merchant</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                             <?php foreach ($Gallery as $key => $value) { ?>
                                            <tr id="row_<?php echo $value->id; ?>">
                                                <td><?php echo  $value->title; ?></td>
                                                <td style="width:200px; "><?php echo  $value->description; ?></td>
                                                <td><img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo  $value->image; ?>" style="height: 63px;"></td>
                                                <td><?php echo $merchants[0]->name.'<br/><b>==>'.ucfirst($merchants[0]->waterpark_name).'</b>'; ?></td>
                                                
                                                <td>
                                                    <a href="<?php echo  base_url(); ?>admin/edit-event-gallery/<?php echo $eventid;  ?>/<?php echo $value->id; ?>/<?php echo  $merchants[0]->id; ?>" class=" btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                                    <a href="javascript:void();" onclick="delData('gallery','<?php echo $value->id; ?>')"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                       <!-- <?php echo  base_url(); ?>admin/delete_gallery/<?php echo $value->id;?> -->
                                                    <div class="statuofrow<?php echo $value->id;?>">
                                                        <br/>
                                                        <?php  if($value->status=='0') {?>
                                                     <button onclick="changeStatus(<?php echo $value->id;?>,'gallery')" class="btn btn-xs btn-info">Deactive</button>
                                                    <?php }else{?> 
                                                   <button onclick="changeStatus(<?php echo $value->id;?>,'gallery')" class="btn btn-xs btn-info">Active</button>
                                                    <?php }?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
                                        </tbody>
                                       </table> 
                                       <?php }else{  ?>
                                  <div class="text-center">No Gallery Image Here..</div>
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