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
                            <li class="active">Commission</li>
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
                                    <h4 class="panel-title">All Commission/Taxes </h4>

                                    <!--<a class="btn btn-xs btn-info pull-right" href="<?php echo base_url() ?>admin/add-testimonial"><i class="fa fa-plus"></i> Add Testimonial</a>-->
                                </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Percent</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Percent</th>
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
                                              <td><?php echo $row->amount; ?>%</td>
                                              <td>
                                                 
                                                  <a data-toggle="modal" data-target="#editSetting" onclick="putRowId('<?php echo $row->id; ?>','<?php echo $row->amount; ?>')" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                        
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
	
     <div class="modal fade" id="editSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h3 class="modal-title" id="myModalLabel">Edit Setting</h3>
                    </div>
                     <?php
                               echo form_open_multipart();
                      ?> 
                    <div class="modal-body row">
                       <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                   <input type="hidden" id="row_id" name="rowid">  
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount (in %)</label>
                                             <input type="text" id="amount" name="amount" class="form-control m-t-xxs" placeholder="Amount in percent" required>
                                           
                                        </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                    <?php echo form_close(); ?>     
                </div>
            </div>
        </div>
       
        <?php include('common/footer-js.php'); ?>
        
        <script>
          function putRowId(rowId,Amt)
          {
            $('#row_id').val(rowId);
            $('#amount').val(Amt);
          }
        </script>


    </body>
</html>