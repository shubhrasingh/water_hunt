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
                            <li class="active">Update Merchant</li>
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
                                    <h4 class="panel-title">Update Merchant</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data" >
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="name">Name :</label>
                                                <input type="hidden" value="<?php echo $merchant[0]->id; ?>" class="form-control" name="id" >
                                            <input type="text" value="<?php echo  $merchant[0]->name;?>" name="name" class="form-control m-t-xxs" id="name" placeholder="Merchant Name ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="waterpark_name">WaterPark Name</label>
                                            <input type="text" value="<?php echo  $merchant[0]->waterpark_name;?>" name="waterpark_name" class="form-control m-t-xxs" id="waterpark_name" placeholder="waterpark_name">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="mobile_number">Mobile Number : </label>
                                            <input type="text" value="<?php echo  $merchant[0]->mobile_number;?>" name="mobile_number" class="form-control m-t-xxs" id="mobile_number" placeholder="mobile_number ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="alternate_mobile_number">Alternate Mobile Number : </label>
                                            <input type="text" value="<?php echo  $merchant[0]->alternate_mobile_number;?>" name="alternate_mobile_number" class="form-control m-t-xxs" id="alternate_mobile_number" placeholder="Alternate Mobile_number ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email">Email </label>
                                            <input type="email" value="<?php echo  $merchant[0]->email;?>" name="email" class="form-control m-t-xxs" id="email" placeholder="Enter email">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="password">Password</label>
                                            <input type="text" value="<?php echo  $merchant[0]->password;?>" name="password" class="form-control m-t-xxs" id="company_email" placeholder="Password ...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <div class="col-md-4">
                                                <label for="waterpark_city">Waterpark City : </label>
                                            <input type="text" value="<?php echo  $merchant[0]->waterpark_city;?>" name="waterpark_city" class="form-control m-t-xxs" id="waterpark_city" placeholder="waterpark_city ">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="waterpark_state">Waterpark State : </label>
                                            <input type="text" value="<?php echo  $merchant[0]->waterpark_state;?>" name="waterpark_state" class="form-control m-t-xxs" id="waterpark_state" placeholder="waterpark_state ">
                                            </div>
                                            <div class="col-md-4">
                                               <label for="entry_fee">Entry Fee : </label>
                                            <input type="number" value="<?php echo  $merchant[0]->entry_fee_per_person;?>" name="entry_fee" class="form-control m-t-xxs" id="entry_fee" placeholder="Enter email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            
                                           <!--  <div class="col-md-4">
                                                <label for="start_time">Start Time : </label>
                                            <input type="time" value="<?php echo  $merchant[0]->start_time;?>" name="start_time" class="form-control m-t-xxs" id="start_time" placeholder="start_time ">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="end_time">End Time :  </label>
                                            <input type="time" value="<?php echo  $merchant[0]->end_time;?>" name="end_time" class="form-control m-t-xxs" id="end_time" placeholder="End_time ... ">
                                            </div> -->
                                            <div class="col-md-4">
                                                <label for="waterpark_address">Waterpark Address :</label>
                                            <input type="text" value="<?php echo  $merchant[0]->waterpark_address;?>" name="waterpark_address" class="form-control m-t-xxs" id="waterpark_address" placeholder="Waterpark_address .... ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="twitter_link"> Waterpark Logo : </label>
                                           <input type="file" name="file" class="form-control" />
                                            </div>
                                            <div class="col-md-4">
                                                <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $merchant[0]->waterpark_logo; ?>" style="width:50%; height:80px; " />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <label for="description">Description :  </label>
                                            
                                            <textarea name="description" class="form-control m-t-xxs" placeholder="description ..." ><?php echo $merchant[0]->description; ?></textarea>
                                            </div>
                                           
                                            
                                            
                                        </div>


                                        <button type="submit" class="btn btn-primary m-t-xs m-b-xs" name="submit">Update Merchant</button>
                                    </form>
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