<!DOCTYPE html>
<html lang="en">
<head>
        
        <?php include('common/header-css.php'); ?>
        <style type="text/css">
          .select2-container
          {
            width:100% !important;
          }

          .form-group
          {
            width:100% !important;
          }

          .form-control
          {
            width:100% !important;
          }
        </style>
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
                            <li class="active">Reports</li>
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
                       <div id="msgDivAjax">
                            
                       </div>


                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Get Report</h4>
                                </div>
                                <div class="panel-body">
                                    <form class="form-inline">

                                      <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Select Type</label>
                                            <select class="form-control" onchange="getReportType()" id="select_type">
                                              <option value="today">Today</option>
                                              <option value="yearly">Yearly</option>
                                              <option value="monthly">Monthly</option>
                                              <option value="between_dates">Between Date</option>
                                            </select>
                                        </div>
                                      </div>

                                      <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Select Merchant</label>
                                            <select class="form-control" id="select_merchant">
                                              <option value="0">Select Merchant</option>
                                              <?php
                                              foreach($getMerchant as $mrr)
                                              {
                                              ?>
                                              <option value="<?php echo $mrr->id; ?>"><?php echo $mrr->waterpark_name; ?></option>
                                              <?php
                                               }
                                               ?>
                                            </select>
                                        </div>
                                      </div>
                                        
                                        <?php
                                         $monthArray=array('01' => 'January' , '02' => 'February' , '03' => 'March' , '04' => 'April' ,'05' => 'May' , '06' => 'June' , '07' => 'July' , '08' => 'August' , '09' => 'September' , '10' => 'October' , '11' => 'November' ,'12' => 'December');
                                        ?>
                                      <div class="col-sm-3 monthDiv" style="display:none">
                                         <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Select Month</label>
                                            <select class="form-control" id="select_month">
                                              <option value="">Select Month</option>
                                              <?php
                                              foreach($monthArray as $monKey => $monVal)
                                              {
                                              ?>
                                              <option value="<?php echo $monKey; ?>"><?php echo $monVal?></option>
                                              <?php
                                               }
                                               ?>
                                            </select>
                                        </div>
                                      </div>
                                      
                                      <div class="col-sm-3 yearDiv" style="display:none">
                                         <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Select Month</label>
                                            <select class="form-control" id="select_year">
                                              <option value="">Select Year</option>
                                              <?php
                                              $y="2017";
                                              $cy=date('Y');
                                              for($y='2017';$y<=$cy;$y++)
                                              {
                                              ?>
                                              <option value="<?php echo $y; ?>"><?php echo $y?></option>
                                              <?php
                                               }
                                               ?>
                                            </select>
                                        </div>
                                      </div>

                                      <div class="col-sm-3 betweenDates" style="display:none">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">To</label>
                                            <input type="text" id="from_date" placeholder="From Date" class="form-control date-picker" >
                                        </div>
                                      </div>

                                      <div class="col-sm-3 betweenDates" style="display:none"> 
                                         <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">From</label>
                                            <input type="text" id="to_date" placeholder="To Date" class="form-control date-picker">
                                        </div>
                                      </div>

                                        <button type="button" onclick="getReportData()" class="btn btn-info">Get Report</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row resultReport" style="display:none">
                        <div class="col-md-12" id="ajaxResult">
                            
                        </div>
                    </div>


                </div>
                <div class="page-footer">
                    <p class="no-s">Made with <i class="fa fa-heart"></i> by Compaddicts</p>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        
        <div class="cd-overlay"></div>
  
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    
                </div>
            </div>
        </div>



       
        <?php include('common/footer-js.php'); ?>
      <script>

    function getReportType()
    {
      var typ=$('#select_type').val();

      switch(typ)
      {
        case "today":
          $('.monthDiv').hide();
          $('.yearDiv').hide();
          $('.betweenDates').hide();
        break;

        case "yearly":
          $('.monthDiv').hide();
          $('.yearDiv').show();
          $('.betweenDates').hide();
        break

        case "monthly":
          $('.monthDiv').show();
          $('.yearDiv').show();
          $('.betweenDates').hide();
        break;

        case "between_dates":
          $('.monthDiv').hide();
          $('.yearDiv').hide();
          $('.betweenDates').show();
        break;
      }
    }

function getReportData()
{   
   
     var base_url='<?php echo base_url(); ?>';
     var md="reportData";
     
     var typ=$('#select_type').val();
     var mrId=$('#select_merchant').val();
     var mn=$('#select_month').val();
     var yr=$('#select_year').val();
     var fdt=$('#from_date').val();
     var tdt=$('#to_date').val();
     
     switch(typ)
      {
        case "today":
          var err="0";
        break;

        case "yearly":
          if(yr=="")
          {
            var err="1";
            var errMsg="Select Year";
          }
          else
          {
            var err="0";
          }
        break

        case "monthly":
           if((yr=="") || (mn==""))
            {
              var err="1";
              var errMsg="Select year and month both";
            }
            else
            {
              var err="0";
            }
        break;

        case "between_dates":
            if((fdt=="") || (tdt==""))
            {
              var err="1";
              var errMsg="Select from and to date both";
            }
            else
            {
              var err="0";
            }
        break;
      }

     if(err==0)
     {
       $.ajax({
           type: "GET",
           url: base_url + "admin/getReportAjax", 
           data: {selTyp: typ , merchantId: mrId ,  month: mn ,  year: yr ,  fromDate: fdt ,  toDate: tdt , mode : md },
           dataType: "text",  
           cache:false,
           success: 
                function(data){
                  $('.resultReport').show();  //as a debugging message.
                  $('#ajaxResult').html(data);  //as a debugging message.
                }
            });// you have missed this bracket
     }
     else
     {
      alert(errMsg);
     }
}


</script>


    </body>
</html>