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
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                 
                 <div id="main-wrapper">
                    <div class="row">
                        <div  class="text-center text-success"><h1>Welcome To Dashboard</h1></div>
                    </div>
                </div>
                
                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts pvt. ltd. </p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
	

        <?php include('common/footer-js.php'); ?>
        
    </body>
</html>