  <header class="header  header-2">
       <div class="header-top-1" style="background: #25a9e0;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 hidden-xs">
                            <div class="haven-call">
                                <p><i class="fa fa-phone"></i> <?php echo $siteDetails['companyData'][0]->company_phone; ?></p>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="header-1-top-inner">
                                <div class="header-topbar-menu header-menu">
                                    <ul>
                                        <li><span><i class="fa fa-envelope"></i> </span> <?php echo $siteDetails['companyData'][0]->company_email; ?></li>
                                        <?php
                                        if(($this->session->userdata('WhUserLoggedinId')!="") && ($this->session->userdata('WhUserLoggedinId')!='0'))
                                        {
                                         $userId=$this->session->userdata('WhUserLoggedinId');
                                         $userType=$this->session->userdata('WhLoggedInUserType');
                                         switch($userType)
                                         {
                                            case "merchant":
                                               $folder="merchant";
                                            break;

                                            case "user":
                                               $folder="user";
                                            break;
                                         }

                                         $name=$userDetails[0]->name;
                                         $exName=explode(' ',$name);
                                         $name=$exName[0];
                                        ?>
                                           <li><a class="menuName" href="<?php echo base_url(); ?><?php echo $folder ?>" style="padding: 0px;"><i class="fa fa-user"></i>  Welcome <?php echo $name; ?> </a>
                                            <ul class="dropdown_menu">
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/dashboard">Dashboard</a></li>
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/profile">Profile</a></li>
                                                    <?php
                                                    if($userType=='merchant')
                                                    {
                                                    ?>
                                                      <li><a href="<?php echo base_url(); ?>merchant/gallery">My Gallery</a></li>
                                                      <li><a href="<?php echo base_url(); ?>merchant/events">Events</a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/bookings">Bookings</a></li>
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/enquiries">Enquiries</a></li>
                                                </ul>
                                            </li>
                                           <li><a href="<?php echo base_url(); ?>logout" style="    padding: 0px;"><i class="fa fa-lock"></i> Logout</a></li>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                           <li><a href="<?php echo base_url(); ?>login" style="    padding: 0px;"><i class="fa fa-user"></i>  Login</a></li>
                                           <li><a href="<?php echo base_url(); ?>register" style="    padding: 0px;"><i class="fa fa-user"></i> Register</a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="header-search">
                                    <div class="search-icon">
                                        <a href="#"><i class="fa fa-search" style="color: white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="logo">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo  base_url(); ?>assets/front/uploads/logo/<?php echo $siteDetails['companyData'][0]->company_logo; ?>" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-10 hidden-sm hidden-xs">
                            <div class="mgea-full-width">
                                <div class="header-menu">
                                    <nav>
                                        <ul>
                                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#"> Water Park</a>
                                                <ul class="dropdown_menu">
                                                    <?php
                                                    $prkCount=$this->Admin_model->getDataCount('merchants',array('status' => 1));
                                                    $getWaterPark=$this->Admin_model->getwithLimitOrderBy('merchants',array('status' => 1),'6','0','id','DESC');
                                                    foreach($getWaterPark as $prk)
                                                    {
                                                        $parkId=$prk->id;
                                                        $parkName=strtolower($prk->waterpark_name);

                                                        $parkName = preg_replace('/\s+/', '-', $parkName);
                                                        $randPrefix=rand(100,999);
                                                        $randSubfix=rand(100,999);
                                                        $urlId=$randPrefix.$parkId.$randSubfix;
                                                        $urlKey=$parkName.'-'.$urlId;
                                                    ?>
                                                      <li><a href="<?php echo base_url(); ?>park-detail/<?php echo $urlKey; ?>"><?php echo $prk->waterpark_name; ?></a></li>
                                                    <?php
                                                    }
                                                    if($prkCount>2)
                                                    {
                                                        ?>
                                                        <li style="background: #25a9e0;"><a style="color: white;" href="<?php echo base_url(); ?>parks">View More</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <li><a href="<?php echo base_url() ?>events">Events</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#"> Contact Us</a></li>
                                           
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-area hidden-lg hidden-md">
                    <div class="container">
                        <div class="col-md-12">
                            <nav id="dropdown">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#"> Water Park</a>
                                        <ul class="dropdown_menu">
                                                    <?php
                                                    $prkCount=$this->Admin_model->getDataCount('merchants',array('status' => 1));
                                                    $getWaterPark=$this->Admin_model->getwithLimitOrderBy('merchants',array('status' => 1),'6','0','id','DESC');
                                                    foreach($getWaterPark as $prk)
                                                    {
                                                        $parkId=$prk->id;
                                                        $parkName=strtolower($prk->waterpark_name);

                                                        $parkName = preg_replace('/\s+/', '-', $parkName);
                                                        $randPrefix=rand(100,999);
                                                        $randSubfix=rand(100,999);
                                                        $urlId=$randPrefix.$parkId.$randSubfix;
                                                        $urlKey=$parkName.'-'.$urlId;
                                                    ?>
                                                      <li><a href="<?php echo base_url(); ?>park-detail/<?php echo $urlKey; ?>"><?php echo $prk->waterpark_name; ?></a></li>
                                                    <?php
                                                    }
                                                    if($prkCount>2)
                                                    {
                                                        ?>
                                                        <li style="background: #25a9e0;"><a style="color: white;" href="<?php echo base_url(); ?>parks">View More</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                    </li>
                                    <li><a href="<?php echo base_url() ?>events">Events</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#"> Contact Us</a></li>
                                    <?php
                                        if(($this->session->userdata('WhUserLoggedinId')!="") && ($this->session->userdata('WhUserLoggedinId')!='0'))
                                        {
                                         $userId=$this->session->userdata('WhUserLoggedinId');
                                         $userType=$this->session->userdata('WhLoggedInUserType');
                                         switch($userType)
                                         {
                                            case "merchant":
                                               $folder="merchant";
                                            break;

                                            case "user":
                                               $folder="user";
                                            break;
                                         }

                                         $name=$userDetails[0]->name;
                                         $exName=explode(' ',$name);
                                         $name=$exName[0];
                                        ?>
                                           <li><a  href="<?php echo base_url(); ?><?php echo $folder ?>" > Welcome <?php echo $name; ?> </a>
                                                <ul class="dropdown_menu">
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/dashboard">Dashboard</a></li>
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/profile">Profile</a></li>
                                                    <?php
                                                    if($userType=='merchant')
                                                    {
                                                    ?>
                                                      <li><a href="<?php echo base_url(); ?>merchant/gallery">My Gallery</a></li>
                                                      <li><a href="<?php echo base_url(); ?>merchant/events">Events</a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/bookings">Bookings</a></li>
                                                    <li><a href="<?php echo base_url(); ?><?php echo $folder ?>/enquiries">Enquiries</a></li>
                                                </ul>
                                            </li>
                                           <li><a href="<?php echo base_url(); ?>logout" ><i class="fa fa-lock"></i> Logout</a></li>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                           <li><a href="<?php echo base_url(); ?>login"> Login</a></li>
                                           <li><a href="<?php echo base_url(); ?>register"> Register</a></li>
                                        <?php
                                        }
                                        ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="haven-call">
                                <p> <?php echo $siteDetails['companyData'][0]->company_phone; ?></p>
                            </div>
                            <div class="add-property">
                                <?php
                                 if(($this->session->userdata('WhUserLoggedinId')!="") && ($this->session->userdata('WhUserLoggedinId')!='0') && ($this->session->userdata('WhLoggedInUserType')=='merchant'))
                                 {
                                    ?>
                                    <a href="<?php echo base_url(); ?>merchant/add-event" style="background:#f6921e none repeat scroll 0 0">ADD EVENT</a>
                                  <?php
                                   }
                                   else
                                   {
                                    ?>
                                     <a href="<?php echo base_url(); ?>parks" style="background:#f6921e none repeat scroll 0 0">BOOK TICKET</a>
                                    <?php
                                    }
                                   ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Search box inner start-->
            <div class="search-box-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-form">
                                <div class="search-form-inner">
                                    <?php
                                    $attr=array('onsubmit' => 'getSearch()');
                                    echo form_open('find',$attr);
                                    ?>
                                        <input type="text" id="find_search" name="find" placeholder="Search..">
                                        <button type="submit"><i class="icofont icofont-search-alt-1"></i></button>
                                   <?php
                                   echo form_close();
                                   ?>
                                </div>
                                <div class="search-close-btn">
                                    <a href="#"><i class="zmdi zmdi-close"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Search box inner end-->
        </header>