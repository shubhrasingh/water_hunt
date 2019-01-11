<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Events - <?php echo $siteDetails['companyData']['0']->company_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


  <?php $this->load->view('front/common/css.php'); ?>

<link  href="<?php echo base_url(); ?>assets/front/css/datepicker.css" rel="stylesheet"> <!-- 3 KB -->

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->
     <!-- fotorama.css & fotorama.js. -->
   
   <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
   <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->
   <style type="text/css">
    .bootstrap-select > .dropdown-toggle {
    background: #ffffff none repeat scroll 0 0;
    } 
   </style>       
</head>

<body>
    <div id="fakeLoader"></div>
   <div class="wrapper white_bg">
      
    <?php $this->load->view('front/common/header.php'); ?>
    
        
          <!--Breadcrumbs start-->
        <div class="breadcrumbs overlay-black p0" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumbs-inner">
                            <div class="breadcrumbs-title text-center pull-left pt6 pb6">
                                <h1>Events</h1>
                            </div>
                            <div class="breadcrumbs-menu pull-right pt6 pb10">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>">Home /</a></li>
                                    <li>Events </li>
                                </ul>
                              
                            </div>
              
                        </div>

                    </div>
          
              
                </div>
            </div>
        </div>
        <!--Breadcrumbs end-->
     
   
      <div class="feature-property pt-50">
            <div class="container">
                <div class="row">
                 
                     <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="sidebar left">
                            <aside class="single-side-box search-property" >
                                <!--<div class="aside-title">
                                    <h5>Ticket Request</h5>
                                </div>-->
                                <div class="find_home-box">
                                   <?php
                                    if($this->session->flashdata('errorMsg')!='')
                                    {
                                    ?>
                                    <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                              <?php echo $this->session->flashdata('errorMsg'); ?>
                                    </div>
                                              
                                    <?php
                                    }
                                    ?>
                                    
                                    <?php
                
                                    if($this->session->flashdata('successMsg')!='')
                                    {
                                    ?>
                                    <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                              <?php echo $this->session->flashdata('successMsg'); ?>
                                    </div>
                                              
                                    <?php
                                    }
                                    ?>
                                     <div class="elements-tab-1">
                                   
                                    <ul class="nav nav-tabs requestTabNav" >
                                      <li class="active"><a href="#profile_1"  data-toggle="tab">Book Now</a></li>
                                        <li><a href="#profile_2"  data-toggle="tab">Enquire Now</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane form_tab fade in active" id="profile_1">
                                             <div class="find_home-box" style="padding:10px 5px">
                                              <p style="color: white;text-align: center;">Book your ticket now and enjoy your day.</p>
                                              <div class="find_home-box-inner">
                                                  <?php
                                                  $arrtributes=array('id' => 'booking_form');
                                                  echo form_open('ticket-request',$arrtributes);
                                                 

                                                 if($this->session->userdata('WhLoggedInUserType')=='merchant') { 
                                                    $user_type_booking="merchant";
                                                   }
                                                   else
                                                   {
                                                    $user_type_booking="user";
                                                   }


                                               if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0') || ($this->session->userdata('WhLoggedInUserType')=='merchant'))
                                                {
                                                  $userId="0";
                                                }
                                                else
                                                {
                                                  $userId=$this->session->userdata('WhUserLoggedinId');
                                                }
                                                    ?>

                                                   <input type="hidden" id="merchant_id_book" name="merchant_id" value="0">
                                                   <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
                                                   <input type="hidden" name="page_type" value="events">
                                                   <input type="hidden" id="booking_user_type" name="booking_user_type" value="<?php echo $user_type_booking; ?>">

                                                      <div class="find-home-cagtegory">
                                                          <div class="row">
                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <select class="selectpicker" onchange="selEvent('book',this.value)" name="event_id" title="Select Event" data-hide-disabled="true" data-live-search="true" required>
                                                                        <?php
                                                                        $tblEvent=$this->db->dbprefix.'merchants_events';
                                                                        $getMer=$this->Admin_model->getQuery("SELECT DISTINCT merchant_id FROM $tblEvent WHERE status='1'");
                                                                        foreach($getMer as $crt)
                                                                        {
                                                                            $merchant_id=$crt->merchant_id;
                                                                            $getPark=$this->Admin_model->getWhere('merchants',array('id' => $merchant_id,'status' => 1));

                                                                            $getEvnt=$this->Admin_model->getWhere('merchants_events',array('merchant_id' => $merchant_id,'status' => 1));
                                                                            ?>
                                                                                <optgroup label="<?php echo $getPark[0]->waterpark_name; ?>">
                                                                                    <?php
                                                                                     foreach($getEvnt as $ent)
                                                                                     {
                                                                                    ?>
                                                                                      <option value="<?php echo $ent->id; ?>"><?php echo $ent->name; ?></option>
                                                                                    <?php
                                                                                     }
                                                                                     ?>
                                                                                </optgroup>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        
                                                                    </select>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="name" placeholder="Name" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="email" name="email" placeholder="Email" required>
                                                                  </div>
                                                              </div>
                                                               <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="mobile" placeholder="Mobile Number" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="address" placeholder="Address" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="number_of_adults" placeholder="Number fo Adults" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="number_of_children" placeholder="Number fo Children"  required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6" style="padding-bottom: 0px;">
                                                                  <div class="find-home-item ticket_input">
                                                                     <input class="span2 datepicker" size="16" type="text" name="visiting_date" placeholder="Visiting Date">
                                                                  </div>
                                                              </div>

                                                              <div class="find-home_bottom">
                                                                  <div class="col-md-12">
                                                                      <div class="find-home-item">
                                                                         <button type="submit" name="book_now"> Book Now </button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                     <?php echo form_close(); ?>
                                                  </div>
                                              </div>
                                        </div>
                                        <div class="tab-pane form_tab fade" id="profile_2">
                                            <div class="find_home-box" style="padding:10px 5px">
                                              <p style="color: white;text-align:center;">Have any query? Feel free to ask.</p>
                                              <div class="find_home-box-inner">
                                                  <?php
                                                   echo form_open('ticket-request');
                                                   if(($this->session->userdata('WhUserLoggedinId')=="") || ($this->session->userdata('WhUserLoggedinId')=='0') || ($this->session->userdata('WhLoggedInUserType')=='merchant'))
                                                    {
                                                      $userId="0";
                                                    }
                                                    else
                                                    {
                                                      $userId=$this->session->userdata('WhUserLoggedinId');
                                                    }
                                                    ?>

                                                    <input type="hidden" name="merchant_id_enquire" value="0">
                                                   <input type="hidden" id="booking_user_id" name="user_id" value="<?php echo $userId; ?>">
                                                   <input type="hidden" name="page_type" value="events">
                                                   <input type="hidden" id="booking_user_type" name="booking_user_type" value="<?php echo $user_type_booking; ?>">

                                                      <div class="find-home-cagtegory">
                                                          <div class="row">
                                                            <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <select class="selectpicker" onchange="selEvent('enquire',this.data)"  name="event_id" title="Select Event" data-hide-disabled="true" data-live-search="true" required>
                                                                        <?php
                                                                        $tblEvent=$this->db->dbprefix.'merchants_events';
                                                                        $getMer=$this->Admin_model->getQuery("SELECT DISTINCT merchant_id FROM $tblEvent WHERE status='1'");
                                                                        foreach($getMer as $crt)
                                                                        {
                                                                            $merchant_id=$crt->merchant_id;
                                                                            $getPark=$this->Admin_model->getWhere('merchants',array('id' => $merchant_id,'status' => 1));

                                                                            $getEvnt=$this->Admin_model->getWhere('merchants_events',array('merchant_id' => $merchant_id,'status' => 1));
                                                                            ?>
                                                                                <optgroup label="<?php echo $getPark[0]->waterpark_name; ?>">
                                                                                    <?php
                                                                                     foreach($getEvnt as $ent)
                                                                                     {
                                                                                    ?>
                                                                                      <option data.id='<?php echo $merchant_id; ?>' value="<?php echo $ent->id; ?>"><?php echo $ent->name; ?></option>
                                                                                    <?php
                                                                                     }
                                                                                     ?>
                                                                                </optgroup>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        
                                                                    </select>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="name" placeholder="Name" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="email" name="email" placeholder="Email" required>
                                                                  </div>
                                                              </div>
                                                               <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="mobile" placeholder="Mobile Number" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="address" placeholder="Address" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="number_of_adults" placeholder="Number fo Adults" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                      <input type="text" name="number_of_children" placeholder="Number fo Children" required>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-6">
                                                                  <div class="find-home-item ticket_input">
                                                                    <input class="span2 datepicker" name="visiting_date" size="16" type="text" placeholder="Visiting Date">
                                                                </div>
                                                              </div>

                                                              <div class="col-md-12" style="padding-bottom: 0px;">
                                                                  <div class="find-home-item ticket_input">
                                                                      <textarea name="message" placeholder="Message" required></textarea>
                                                                </div>
                                                              </div>

                                                              <div class="find-home_bottom">
                                                                  <div class="col-md-12">
                                                                      <div class="find-home-item">
                                                                         <button type="submit" name="enquire_now"> Enquire Now </button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  <?php echo form_close(); ?>
                                                  </div>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                            </aside>


                            <aside class="single-side-box feature">
                                <div class="aside-title">
                                    <h5>Parks</h5>
                                </div>
                                <div class="feature-property">
                                    <div class="row">
                                    <?php
                                     foreach($getRelatedParks as $parkRw)
                                     {
                                        $parkId=$parkRw->id;
                                        $parkName=strtolower($parkRw->waterpark_name);

                                        $parkName = preg_replace('/\s+/', '-', $parkName);
                                        $randPrefix=rand(100,999);
                                        $randSubfix=rand(100,999);
                                        $urlId=$randPrefix.$parkId.$randSubfix;
                                        $urlKey=$parkName.'-'.$urlId;
                                     ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="single-property">
                                        <div class="property-img">
                                          <a href="<?php echo base_url(); ?>park-detail/<?php echo $urlKey; ?>">
                                            <img src="<?php echo base_url(); ?>assets/front/uploads/merchant-logo/<?php echo $parkRw->waterpark_logo; ?>" alt="<?php echo $parkRw->waterpark_name; ?>" style="width:165px;height:130px">
                                          </a>
                                        </div>
                                        <div class="property-desc text-center" style="background: #262261 none repeat scroll 0 0;">
                                          <div class="property-desc-top">
                                            <h6 style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><a href="<?php echo base_url(); ?>park-detail/<?php echo $urlKey; ?>"><?php echo $parkRw->waterpark_name; ?></a></h6>
                                            <h4 class="price">₹ <?php echo $parkRw->entry_fee_per_person; ?> / person</h4>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                </div>
                            </aside>

                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                       <div class="section-title text-center">
                            <h3 style="margin-bottom: 40px;padding-top: 0;">ALL <span>EVENTS</span></h3>
                       </div>
                        <div class="row">
                            <div class="col-md-12">
                 <?php
                    foreach($getEvents as $rto)
                  {
                    $eventId=$rto->id;
                    $merchantId=$rto->merchant_id;
                    $startDate=$rto->start_date;
                    $endDate=$rto->end_date;
                    $timing=$rto->time;
                    $merchantId=$rto->merchant_id;
                    $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
                    $eventName=strtolower($rto->name);

                    $eventName = preg_replace('/\s+/', '-', $eventName);
                    $randPrefix=rand(100,999);
                    $randSubfix=rand(100,999);
                    $urlId=$randPrefix.$eventId.$randSubfix;
                    $urlKey=$eventName.'-'.$urlId;
                    
                    $cDate=date('Y-m-d');
                    
                  ?>
                                <div class="list_property fix mb-60">
                                    <div class="col-6 ">
                                        <div class="single-property">
                      <?php
                      if($cDate>$endDate)
                      {
                      ?>
                       <span style="background:red">Finished</span>
                      <?php
                      }
                      else if(($cDate<=$endDate) && ($cDate>=$startDate))
                      {
                      ?>
                       <span class="bg-blue">Ongoing</span>
                      <?php
                      }
                      else
                      {
                      ?>
                       <span style="background:green">Upcoming</span>
                      <?php
                      }
                      ?>
                                            
                                            <div class="property-img event-img">
                                               <a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>">
                                                    <img src="<?php echo base_url(); ?>assets/front/uploads/events/<?php echo $rto->image; ?>" alt="">
                                               </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div class="property-desc list_property_desc">
                                            <div class="property-desc-top">
                                                <h6><a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>"><?php echo $rto->name; ?></a></h6>
                                                <h4 class="price" style="color:#f6921e"><i class="fa fa-inr"></i> <?php echo $rto->entry_fee_per_person; ?></h4>
                                                <div class="property-location">
                                                    <p><i class="fa fa-home"></i> <?php echo $getMerchant[0]->waterpark_city; ?> , <?php echo $getMerchant[0]->waterpark_state; ?></p>
                                                </div>
                                            </div>
                                            <div class="property-list-desc">
                                                <p> <?php echo substr($rto->description,0,150); ?>...<a href="<?php echo base_url(); ?>event-detail/<?php echo $urlKey; ?>" style="color: #f6921e;font-weight: bold;">Continue Reading</a></p>
                                            </div>
                                            <div class="property-desc-bottom">
                                                <div class="property-bottom-list">
                                                    <ul>
                                                        <li>
                                                            <i class="fa fa-calendar"></i>  
                                                            <span><?php echo date('M j,Y',strtotime($startDate)); ?> To <?php echo date('M j,Y',strtotime($endDate)); ?></span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-clock-o"></i>  
                                                            <span><?php echo date('g:i a',strtotime($timing)); ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                <?php
                }
                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pagination">
                                    <div class="pagination-inner text-center">
                                        <?php
                                        if($eventCount > $fetchLimit)
                                        {
                                        ?>  
                                          <ul class="page-numbers">
                                            <?php
                                               echo $this->pagination->create_links();
                                            ?>
                                          </ul>
                                        <?php
                                        }
                                        ?>
                                       <!-- <ul>
                                            <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                            <li class="current">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>. . . . . .</li>
                                            <li><a href="#">15</a></li>
                                            <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                         </ul>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <!--Feature property section end-->
        
         
     <!-- quick view start -->
    <div  class="modal fade" role="dialog" tabindex="-1" id="quick-view">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="register-page-form">
                        <div aria-label="Close" data-dismiss="modal" class="modal-header">
                            <span>x</span>
                        </div>
                        <div class="account-title">
                            <h5>Login</h5>
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
                              echo form_open('login');
                        ?>
                          <input type="hidden" name="page_type" value="events">
                          <input type="hidden" name="user_type" value="user">
                            <div class="username">
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="password">
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="lost-password">
                               <p><a href="<?php echo base_url(); ?>register">Create an account ?</a></p>
                            </div>
                            <div class="login">
                                <button type="submit" name="submit">Sign in</button>
                            </div>
                       <?php 
                              echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php $this->load->view('front/common/footer.php'); ?>
    
    </div>
  
  <?php $this->load->view('front/common/js.php'); ?>

  <script src="<?php echo base_url(); ?>assets/front/js/starrr.js"></script>
  <script src="<?php echo base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>


    <script>
      $(function () {
        $('#star2 a').on("click", function (e) {
            e.preventDefault();
        });
    });

      var $s2input = $('#star2_input');
      $('#star2').starrr({
        max: 5,
        rating: $s2input.val(),
        change: function(e, value){
          $s2input.val(value).trigger('input');
        }
      });

  $('#review_form').on('submit', function() {
       
       var uid=$('#review_user_id').val();
       if(uid=='0')
       {
         $('#quick-view').modal('show');
         return false;
       }
       else
       {
         return true;
       }
     });

    <?php
    if(($this->session->userdata('errorLogin')=='1') && ($this->session->userdata('errorLogin')!=''))
    {
      ?>
          $('#quick-view').modal('show');
      <?php
    }
    ?>


$('.datepicker').datepicker();

 $('#booking_form').on('submit', function() {
       
           var uid=$('#booking_user_id').val();
           var utype=$('#booking_user_type').val();
           if(utype=='merchant')
           {
                 alert('Please login as user to buy ticket')
                 return false;
           }
           else
           {
               if(uid=='0')
               {
                 $('#quick-view').modal('show');
                 return false;
               }
               else
               {
                return true;
               }
           }
     });

function selEvent(ty,dt)
{
  $('#merchant_id_' + ty).val(dt);
}

  </script>
   
</body>
</html>