<div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button push-sidebar">
                            <i class="icon-arrow-right"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="<?php echo base_url(); ?>admin/dashboard" class="logo-text"><span>
                            <img src="<?php echo base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['0']->company_logo; ?>" width="75" height="35" alt="Porto Admin" />    
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
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-envelope-open"></i><span class="badge badge-danger pull-right">4</span></a>
                                    <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                        <li><p class="drop-title">You have 4 new  messages!</p></li>
                                        <li class="dropdown-menu-list slimscroll messages">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar2.png" alt=""></div>
                                                        <p class="msg-name">Michael Lewis</p>
                                                        <p class="msg-text">Yeah science!</p>
                                                        <p class="msg-time">3 minutes ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar4.png" alt=""></div>
                                                        <p class="msg-name">John Doe</p>
                                                        <p class="msg-text">Hi Nick</p>
                                                        <p class="msg-time">8 minutes ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar3.png" alt=""></div>
                                                        <p class="msg-name">Emma Green</p>
                                                        <p class="msg-text">Let's meet!</p>
                                                        <p class="msg-time">56 minutes ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar5.png" alt=""></div>
                                                        <p class="msg-name">Nick Doe</p>
                                                        <p class="msg-text">Nice to meet you</p>
                                                        <p class="msg-time">2 hours ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/avatar2.png" alt=""></div>
                                                        <p class="msg-name">Michael Lewis</p>
                                                        <p class="msg-text">Yeah science!</p>
                                                        <p class="msg-time">5 hours ago</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="msg-img"><div class="online off"></div><img class="img-circle" src="assets/images/avatar4.png" alt=""></div>
                                                        <p class="msg-name">John Doe</p>
                                                        <p class="msg-text">Hi Nick</p>
                                                        <p class="msg-time">9 hours ago</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="drop-all"><a href="#" class="text-center">All Messages</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-bell"></i><span class="badge badge-danger pull-right">3</span></a>
                                    <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                        <li><p class="drop-title">You have 3 pending tasks!</p></li>
                                        <li class="dropdown-menu-list slimscroll tasks">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="#">
                                                        <div class="task-icon badge badge-success"><i class="fa fa-user"></i></div>
                                                        <span class="badge badge-roundless badge-default pull-right">1m</span>
                                                        <p class="task-details">New user registered</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="task-icon badge badge-primary"><i class="fa fa-refresh"></i></div>
                                                        <span class="badge badge-roundless badge-default pull-right">24m</span>
                                                        <p class="task-details">3 Charts refreshed</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="task-icon badge badge-danger"><i class="fa fa-phone"></i></div>
                                                        <span class="badge badge-roundless badge-default pull-right">1h</span>
                                                        <p class="task-details">2 Missed calls</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="drop-all"><a href="#" class="text-center">All Tasks</a></li>
                                    </ul>
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