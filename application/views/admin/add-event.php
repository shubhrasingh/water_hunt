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
                            <li class="active">Add Event</li>
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
                                    <h4 class="panel-title">Add Event</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group row">
                                           <div class="col-md-4">
                                            <label for="name">Merchant :</label>
                                            <!-- <input type="text"  name="name" required class="form-control m-t-xxs" id="name" placeholder="Merchant Name "> -->
                                    <select name="merchantid" class="js-states form-control" tabindex="-1" style="display: none; width: 100%">
                                        
                                        <optgroup label="Merchant Name"> 
                                            <option value="">---------Select Merchant----------</option>
                                            <?php foreach($merchants as $value) { ?>
                                                 <option value="<?php echo  $value->id; ?>"><?php echo  ucfirst($value->waterpark_name);  ?></option> 
                                            <?php } ?>
                                            
                                        </optgroup>
                                    </select>

                                 </div>
                                            <div class="col-md-4">
                                                <label for="title">Name</label>
                                            <input type="text" required name="title" class="form-control m-t-xxs" id="title" placeholder="Name">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="start_date">Start Date</label>
                                            <input type="date"  required name="start_date" class="form-control m-t-xxs" id="start_date" placeholder="Start date ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="end_date">End date : </label>
                                            <input type="date"  name="end_date" class="form-control m-t-xxs" id="end_date" placeholder="End date.... ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="time">Time : </label>
                                            <input type="time" required name="time" class="form-control m-t-xxs" id="time" placeholder="Time">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="entry_fee_per_person">Entry Fee : </label>
                                            <input type="number" required  name="entry_fee_per_person" class="form-control m-t-xxs" id="entry_fee_per_person" placeholder="Entry Fee per person...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                            <label for="description">Description :  </label>
                                            
                                            <textarea name="description" class="form-control m-t-xxs" placeholder="description ..." ></textarea>
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <label for="twitter_link"> Image : </label>
                                           <input type="file" required  name="file" class="form-control" />
                                            </div>
                                            
                                        </div>


                                        <button type="submit" class="btn btn-primary m-t-xs m-b-xs" name="submit">Add Event</button>
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