<div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button push-sidebar">
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="<?php echo base_url(); ?>admin/dashboard" class="logo-text"><span>
                            <img src="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" width="75" height="35" alt="<?php echo $siteDetails['0']->company_name; ?>" />    
                        </span></a>

                    </div><!-- Logo Box -->
                    <div class="search-button">
                        <a href="javascript:void(0);" class="show-search"><i class="icon-magnifier"></i></a>
                    </div>
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-left">
                                <li>		
                                    <a href="javascript:void(0);" class="sidebar-toggle"><i class="icon-arrow-left"></i></a>
                                </li>
                               
                                
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                               <!--  <li>	
                                    <a href="javascript:void(0);" class="show-search"><i class="icon-magnifier"></i></a>
                                </li> -->

                                <?php
                                 $getUnseenMsg=$this->Admin_model->getDataCount('merchant_contact_request',array('seen_status' => 2,'sender_type' => 'merchant'));
                                ?>
                                <li class="dropdown">
                                    <a href="<?php echo base_url(); ?>admin/messages" class="dropdown-toggle"><i class="icon-envelope-open"></i><span class="badge badge-danger pull-right"><?php echo $getUnseenMsg; ?></span></a>
                                    
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="user-name"><?php echo $adminDetails[0]->name; ?><i class="fa fa-angle-down"></i></span>
                                        <img class="img-circle avatar" src="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" width="40" height="40" alt="<?php echo $adminDetails[0]->name; ?>">
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="<?php echo base_url(); ?>admin/profile"><i class="icon-user"></i>Profile</a></li>
                                        <li role="presentation"><a href="<?php echo base_url(); ?>admin/change-password"><i class="icon-calendar"></i>Change Password</a></li>
                                    
                                        <li role="presentation" class="divider"></li>
                                        
                                        <li role="presentation"><a href="<?php echo base_url() ?>admin/logout"><i class="icon-key m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
                                
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->