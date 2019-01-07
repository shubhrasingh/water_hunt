<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register | <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<?php $this->load->view('front/common/css.php'); ?>
	
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
	  <?php $this->load->view('front/common/header.php'); ?>
	  
        

        <!--Feature property section start-->
    
          <!--Breadcrumbs start-->
        <div class="breadcrumbs overlay-black p0" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            <div class="breadcrumbs-title text-center pull-left pt6 pb6">
                                <h1>Register</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb6">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Register</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumbs end-->
        <!--Register page inner start-->
        <div class="register-page-inner ptb-50 bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                        <div class="register-page-form">
                            <div class="account-title">
                                <h5>Create an Account</h5>
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
                            <?php 
                            //  $attributes=array('autocomplete' => 'off');
                              echo form_open();
                            ?>
                                <div class="username">
                                    <select name="user_type" onchange="getUserType(this.value)">
                                        <option value="merchant">Merchant</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>

                                <div class="waterpark" id="waterpark_nameDiv">
                                    <input type="text" placeholder="Water Park Name" id="waterpark_name" autocomplete="off" name="waterpark_name">
                                </div>

                                <div class="username">
                                    <input type="text" placeholder="Your Name" autocomplete="off" name="name" required>
                                </div>
                                <div class="email">
                                    <input type="text" placeholder="Email" name="email" autocomplete="off" required>
                                </div>
                                <div class="phone">
                                    <input type="text" placeholder="Mobile Number" name="mobile" autocomplete="off" required>
                                </div>
                                <div class="password">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off" required>
                                </div>

                                <div class="lost-password">
                                    <p><a href="<?php echo base_url(); ?>login">Already have an account?</a></p>
                                </div>
                              
                                <div class="register">
                                    <button type="submit" name="submit">Register</button>
                                </div>

                            <?php echo form_close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Register page inner end-->
    
        
        
        
        
        <?php $this->load->view('front/common/footer.php'); ?>
		
    </div>
	
	<?php $this->load->view('front/common/js.php'); ?>
	
    <script type="text/javascript">
        function getUserType(vl)
        {
          switch(vl)
          {
            case "merchant":
              $('#waterpark_nameDiv').show();
              $('#waterpark_name').prop('required',true);
            break;

            case "user":
              $('#waterpark_nameDiv').hide();
              $('#waterpark_name').prop('required',false);
            break;
          }
        }
    </script>
</body>
</html>