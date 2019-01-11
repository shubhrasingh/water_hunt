 <?php
                             $image=$userDetails[0]->waterpark_logo;
                             $description=$userDetails[0]->description;
                             if(empty($image))
                             {
                                $image="avatar.png";
                             }

                             if(empty($description))
                             {
                                $description="Update Description of your water park";
                             }
                            ?>
                            <div class="agent-profile">
                                <div class="single-team">
                                    <div class="team-img">
                                        <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $image; ?>" alt="">
                                    </div>
                                    <div class="team-desc sidebar-team-desc">
                                        <div class="team-member-title pb0" >
                                            <h6><?php echo $userDetails[0]->name; ?></h6>
                                            <p><?php echo $userDetails[0]->waterpark_name; ?></p>
                                            <p style="margin: 10px 0px;"><a class="btn btn-sm btn-info btn-profile" href="<?php echo base_url(); ?>merchant/edit-profile">Edit Profile</a> <a class="btn btn-sm btn-danger btn-profile" href="<?php echo base_url(); ?>merchant/change-password">Change Password</a></p>
											
											<div class="categories-list pt5" style="background: #e8eff7;border-top: 1px solid #cccccc80;">
												<ul style="text-align:left">
                                                  <li class="pl10"><a href="<?php echo base_url(); ?>merchant/profile"><i class="fa fa-angle-right"></i> Profile</a></li>
												  <li class="pl10"><a href="<?php echo base_url(); ?>merchant/timing"><i class="fa fa-angle-right"></i> Timing</a></li>
												  <li class="pl10"><a href="<?php echo base_url(); ?>merchant/profile-cover"><i class="fa fa-angle-right"></i>  Profile Cover</a></li>
												  <li class="pl10" style="border-bottom: 0px;"><a href="<?php echo base_url(); ?>merchant/map-location"><i class="fa fa-angle-right"></i> Map</a></li>
												</ul>
											</div>
                                            
                                        </div>

                                    </div>

                                </div>

                            </div>