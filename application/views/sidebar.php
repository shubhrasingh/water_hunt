<div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <ul class="menu accordion-menu">
                        <li><a href="<?php echo  base_url(); ?>admin/dashboard" class="waves-effect waves-button"><span class="menu-icon icon-home"></span><p>Dashboard</p></a></li>
                        
                       <!--  <li><a href="<?php echo  base_url(); ?>admin/profile" class="waves-effect waves-button"><span class="menu-icon icon-user"></span><p>Profile</p></a></li> -->
                        <!-- <li class="droplink active open"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-envelope-open"></span><p>Mailbox</p><span class="arrow"></span><span class="active-page"></span></a>
                            <ul class="sub-menu">
                                <li class="active"><a href="inbox.html">Inbox</a></li>
                                <li><a href="message-view.html">View Message</a></li>
                                <li><a href="compose.html">Compose</a></li>
                            </ul>
                        </li> -->
                       <?php if($adminDetails[0]->role=='1') {?>
                          <li><a href="<?php echo  base_url(); ?>admin/subadmin" class="waves-effect waves-button"><span class="menu-icon icon-tag"></span><p>Sub Admin</p></a></li>
                       <?php }?>
                       

                       <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-layers"></span><p>Settings</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url(); ?>admin/commissions">Commissions/Tax</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/sliders">Sliders</a></li> 
                                <li><a href="<?php echo base_url(); ?>admin/testimonials">Testimonial</a></li> 
                            </ul>
                        </li>

                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-puzzle"></span><p>Merchants</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url(); ?>admin/merchant">Add Merchant</a></li>
                                
                                <li><a href="<?php echo base_url(); ?>admin/allmerchant">All Merchant</a></li>
                            </ul>
                        </li>

                        <li class="droplink"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-layers"></span><p>Events</p><span class="arrow"></span></a>
                            <ul class="sub-menu">
                                <li><a href="<?php echo base_url(); ?>admin/addevent">Add Event</a></li>
                                <li><a href="<?php echo base_url(); ?>admin/allevent">All Events</a></li> 
                                
                            </ul>
                        </li>
                         <li ><a href="<?php echo base_url(); ?>admin/allusers" ><span class="menu-icon icon-layers"></span><p>All Users</p></a></li>
                         <li ><a href="<?php echo base_url(); ?>admin/bookticket" ><span class="menu-icon icon-layers"></span><p>Bookings</p></a></li>
                         <li><a href="<?php echo base_url(); ?>admin/enquiry" ><span class="menu-icon icon-layers"></span><p>Enquries</p></a></li>
                        <li><a href="<?php echo base_url(); ?>admin/messages" ><span class="menu-icon icon-layers"></span><p>Messages</p></a></li> 
                    </ul>
                </div><!-- Page Sidebar Inner -->
            </div><!-- Page Sidebar -->


