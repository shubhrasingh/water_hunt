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
                            <li class="active">Edit Event</li>
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
                                    <h4 class="panel-title">Update Event</h4>
                                </div>
                                <div class="panel-body">
                                    <form  method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group row">
                                           <div class="col-md-4">


                                            <label for="name">Merchant : </label>
                                            <!-- <input type="text"  name="name" required class="form-control m-t-xxs" id="name" placeholder="Merchant Name "> -->
                                    <!--  <?php foreach($merchants as $value) { 
                                        echo $merchants_events[0]->merchant_id.'=='.$value->id.'<br/>'; 
                                      } ?>  -->
                                    <select name="merchantid" class="form-control">

                                            <option value="">---------Select Merchant----------</option>
                                            <?php foreach($merchants as $value) { ?>
                                                 <option <?php if($merchants_events[0]->merchant_id==$value->id) echo 'selected'; ?> value="<?php echo  $value->id; ?>" ><?php echo  ucfirst($value->name);  ?></option>   
                                            <?php } ?> 

                                    </select> 

                                 </div>
                                     <div class="col-md-4">
                                       <label for="title">Name</label>
                                       <input type="text" required name="title" value="<?php echo $merchants_events[0]->name; ?>" class="form-control m-t-xxs" id="title" placeholder="Name">

                                        <input type="hidden"  name="rowid" value="<?php echo $merchants_events[0]->id; ?>" class="form-control m-t-xxs" >

                                            </div>
                                             <div class="col-md-4">
                                                <label for="start_date">Start Date</label>
                                            <input type="date" value="<?php echo $merchants_events[0]->start_date; ?>"  required name="start_date" class="form-control m-t-xxs" id="start_date" placeholder="Start date ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="end_date">End date : </label>
                                            <input type="date" value="<?php echo $merchants_events[0]->end_date; ?>" name="end_date" class="form-control m-t-xxs" id="end_date" placeholder="End date.... ">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="time">Time : </label>
                                            <input type="time" value="<?php echo $merchants_events[0]->time; ?>" required name="time" class="form-control m-t-xxs" id="time" placeholder="Time">
                                            </div>
                                             <div class="col-md-4">
                                                <label for="entry_fee_per_person">Entry Fee : </label>
                                            <input type="number" value="<?php echo $merchants_events[0]->entry_fee_per_person; ?>" required  name="entry_fee_per_person" class="form-control m-t-xxs" id="entry_fee_per_person" placeholder="Entry Fee per person...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                            <label for="description">Description :  </label>
                                            
                                            <textarea name="description" class="form-control m-t-xxs" placeholder="description ..." ><?php echo $merchants_events[0]->description; ?></textarea>
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <label for="twitter_link"> Image : </label>
                                           <input type="file"   name="file" class="form-control" />
                                            </div>
                                            <div class="col-md-4">
                                                <img src="<?php echo  base_url(); ?>assets/front/uploads/events/<?php echo $merchants_events[0]->image; ?>" style="height:80px; width:50%; " >
                                            </div>
                                            
                                        </div>


                                        <button type="submit" class="btn btn-primary m-t-xs m-b-xs" name="update">Update Event</button>
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
        <nav class="cd-nav-container" id="cd-nav">
            <header>
                <h3>DEMOS</h3>
            </header>
            <div class="col-md-6 demo-block demo-selected demo-active">
                <p>Dark<br>Design</p>
            </div>
            <div class="col-md-6 demo-block">
                <a href="http://stacksthemes.com/meteor/admin2/index.html"><p>Light<br>Design</p></a>
            </div>
            <div class="col-md-6 demo-block">
                <a href="http://stacksthemes.com/meteor/admin3/index.html"><p>Material<br>Design</p></a>
            </div>
            <div class="col-md-6 demo-block demo-coming-soon">
                <p>Horizontal<br>(Coming)</p>
            </div>
            <div class="col-md-6 demo-block demo-coming-soon">
                <p>Coming<br>Soon</p>
            </div>
            <div class="col-md-6 demo-block demo-coming-soon">
                <p>Coming<br>Soon</p>
            </div>
        </nav>
        <div class="cd-overlay"></div>
    

       
        <?php include('common/footer-js.php'); ?>

    </body>
</html>