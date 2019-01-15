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
                            <li class="active">Edit Slider</li>
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
                       
                        <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Edit Slider</h4>
                                </div>
                                <div class="panel-body">

                                    <?php echo form_open_multipart(); ?>

                                        <input type="hidden"  class="form-control" name="rowid" value="<?php echo $getData[0]->id; ?>">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control m-t-xxs" id="exampleInputEmail1" placeholder="Enter Title" name="title" value="<?php echo $getData[0]->title; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea class="form-control m-t-xxs" id="exampleInputEmail1" placeholder="Enter Description" name="description" ><?php echo $getData[0]->description; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Image</label>
                                            <input type="file" name="file" ><img class="pull-right" src="<?php echo base_url(); ?>assets/front/uploads/slider/<?php echo $getData[0]->image?>" alt="<?php echo $getData[0]->title?>" style="width:100px"><br/>
                                            <small>Image size should be greater than 1300x500 </small>
                                        </div>
                                        
                                        <button type="submit" name="update" class="btn btn-primary m-t-xs m-b-xs">Submit</button>
                                    <?php echo form_close(); ?>
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

    </body>
</html>