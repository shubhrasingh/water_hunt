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
                            <li class="active">Merchants</li>
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



                    </div>
                    <div class="row">
                        <div class="col-md-12">
                           <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">All Merchants</h4>
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Merchant</th>
                                                <th>WaterPark Name</th>
                                                <th>Logo</th>
                                                <th>City</th>
                                                <th>Enty Fee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Merchant</th>
                                                <th>WaterPark Name</th>
                                                <th>Logo</th>
                                                <th>City</th>
                                                <th>Enty Fee</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                             <?php foreach ($merchants as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo  'Name:-'.$value->name.', Mobile :-'.$value->mobile_number.',<br/> Email:-'.$value->email.', Password :-'.$value->password; ?></td>
                                                <td><?php echo  $value->waterpark_name; ?></td>
                                                <td><img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo  $value->waterpark_logo; ?>" style="height: 63px;"></td>
                                                <td><?php echo  $value->waterpark_city.'<br/><b>'.$value->waterpark_state.'</b>'; ?></td>
                                                <td><?php echo  $value->entry_fee_per_person; ?></td>
                                                <td>
                                                    <a href="<?php echo  base_url(); ?>admin/edit-merchant/<?php echo $value->id;?>" class=" btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                                    <a href="<?php echo  base_url(); ?>admin/delete_merchant/<?php echo $value->id;?>"  class=" btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                    

                                                    <a href="javascript:void()"  onclick="gettimingSchedule(<?php echo  $value->id; ?>)"    data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-warning"><i class="icon icon-clock"></i></a>

                                                    <a href="<?php echo  base_url(); ?>admin/add-gallery/<?php echo $value->id;?>" class="btn btn-xs btn-info"><i class="fa fa-file-image-o" aria-hidden="true"></i></a>

                                                    <div class="statuofrow<?php echo $value->id;?>">
                                                        <br/>
                                                        <?php  if($value->status=='0') {?>
                                                     <button onclick="changeStatus(<?php echo $value->id;?>,'merchants')" class="btn btn-xs btn-info">Deactive</button>
                                                    <?php }else{?> 
                                                   <button onclick="changeStatus(<?php echo $value->id;?>,'merchants')" class="btn btn-xs btn-info">Active</button>
                                                    <?php }?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            
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
       <script type="text/javascript">
            
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

            function gettimingSchedule(MerchantId)
            {
              $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>admin/getTimeSchedule',
                    data: {mId: MerchantId},
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