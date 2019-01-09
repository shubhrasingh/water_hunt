<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
           parent::__construct();
           $this->load->model('Admin_model');
    }
  
   public function siteDetails()
    {
      $where=array('role' => '1');
      $data['companyData']=$this->Admin_model->getWhere('master_admin',$where);
      return $data;
    }

    public function userDetails()
	{
			$uid=$this->session->userdata('WhUserLoggedinId');
			$where=array('id' => $uid);

			 $userType=$this->session->userdata('WhLoggedInUserType');
             switch($userType)
               {
                  case "merchant":
                    $tbl="merchants";
                  break;

                  case "user":
                    $tbl="users";
                  break;
               }

			$data=$this->Admin_model->getWhere($tbl,$where);
			return $data;
	}

	public function index()
	{
		$data['siteDetails']=$this->siteDetails();

		if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

       $data['waterParks']=$this->Admin_model->getwithLimitOrderBy('merchants',array('status' => '1'),'6','0','id','DESC');

		$data['recentEvents']=$this->Admin_model->getwithLimitOrderBy('merchants_events',array('status' => '1'),'6','0','id','DESC');
		
		$date=date('Y-m-d');
		$tbl=$this->db->dbprefix.'merchants_events';
		$data['upcomingEvents']=$this->Admin_model->getQuery("SELECT * FROM $tbl WHERE `status`='1' AND (`start_date` > '$date') ORDER BY `start_date` ASC LIMIT 0,3");
        
		$this->load->view('front/index',$data);
	}

	public function eventDetail($eventUrl)
	{
        $data['siteDetails']=$this->siteDetails();

		if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

        $data['eventUrl']=$eventUrl;
        $exUrl=explode('-',$eventUrl);
        $endUrl=end($exUrl);
		$endUrl=substr($endUrl,3);
		$eventId=substr($endUrl,0,-3);

		$data['getData']=$this->Admin_model->getWhere('merchants_events',array('id' => $eventId));
        $merchantId=$data['getData'][0]->merchant_id;

        $data['geteventGallery']=$this->Admin_model->getWhere('gallery',array('event_id' => $eventId));

        $data['getMerchant']=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
        
        $data['geteventReview']=$this->Admin_model->getWhere('customer_review',array('event_id' => $eventId));

		$this->load->view('front/event-detail',$data);
	}

	public function submitReview()
	{
		$data['siteDetails']=$this->siteDetails();

		if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

        $event_id=$_REQUEST['event_id'];
        $merchant_id=$_REQUEST['merchant_id'];
        $user_id=$_REQUEST['user_id'];
        $page_type=$_REQUEST['page_type'];
        $rating=$_REQUEST['rating'];
        $comment=nl2br($_REQUEST['comment']);
        $date=date('Y-m-d');

        $exPage=explode('_',$page_type);

		$exPageType=$exPage[0];
		$exPageLink=$exPage[1];
        if($exPageType=="event")
        {
           $folder="event-detail";
        }
        else
        {
           $folder="park-detail";
        }
		$redirectUrl=$folder.'/'.$exPageLink;

        if((!empty($rating)) && (!empty($comment)) && ($user_id!='0') && ($user_id!=''))
        {
        	$inData=array('user_id' => $user_id,'merchant_id' => $merchant_id,'event_id' => $event_id,'rating' => $rating,'comment' => $comment,'added_on' => $date);
        	$this->Admin_model->insertData('customer_review',$inData);
            $this->session->set_flashdata('successReview','Review submitted');
            redirect($redirectUrl);
        }
        else
        {
            $this->session->set_flashdata('errorReview','Comment and Rating are required');
            redirect($redirectUrl);
        }
	}


	public function submitTicketRequest()
	{
		$data['siteDetails']=$this->siteDetails();

		if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

		if(isset($_REQUEST['enquire_now']))  //****** Submiting Enquiry ******
		{
            $event_id=$_REQUEST['event_id'];
	        $merchant_id=$_REQUEST['merchant_id'];
	        $user_id=$_REQUEST['user_id'];
	        $page_type=$_REQUEST['page_type'];
	        $name=$_REQUEST['name'];
	        $email=$_REQUEST['email'];
	        $mobile=$_REQUEST['mobile'];
	        $address=$_REQUEST['address'];
	        $number_of_adults=$_REQUEST['number_of_adults'];
	        $number_of_children=$_REQUEST['number_of_children'];
	        $visiting_date=$_REQUEST['visiting_date'];
	        $message=$_REQUEST['message'];
	        $date=date('Y-m-d');

	        $exPage=explode('_',$page_type);

			$exPageType=$exPage[0];
			$exPageLink=$exPage[1];
	        if($exPageType=="event")
	        {
	           $folder="event-detail";
	        }
	        else
	        {
	           $folder="park-detail";
	        }
			$redirectUrl=$folder.'/'.$exPageLink;

			if((!empty($name)) && (!empty($email)) && (!empty($mobile)) && (!empty($address)) && (!empty($number_of_adults)) && (!empty($visiting_date)))
			{

                $visiting_date=date('Y-m-d',strtotime($visiting_date));
				$inArray=array('user_id' => $user_id,'merchant_id' => $merchant_id,'event_id' => $event_id,'name' => $name,'email' => $email,'mobile' => $mobile,'address' => $address,'number_of_adults' => $number_of_adults,'number_of_children' => $number_of_children,'visit_date' => $visiting_date,'message' => $message,'requested_on' => $date,'request_type' => 'enquiry','status' => '1');
				$this->Admin_model->insertData('ticket_request',$inArray);
                
                if($message!='')
                {
                	$txtMsg='<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Message : </b> '.$message.'</td> 
						</tr>';
                }
                else
                {
                	$txtMsg='';
                }

				
                $visitingDate=date('F j,Y',strtotime($visiting_date));
                $tblEvent=$this->db->dbprefix."merchants_events";
                $tblMerchant=$this->db->dbprefix."merchants";
                $getEvent=$this->Admin_model->getQuery("SELECT $tblEvent.name,$tblMerchant.waterpark_name FROM $tblEvent LEFT JOIN $tblMerchant ON $tblEvent.merchant_id=$tblMerchant.id WHERE $tblEvent.id='$event_id'");

                if($exPageType=="event")
		        {
		           $mailtxt='on for event '.$getEvent[0]->name.' in '.$getEvent[0]->waterpark_name;
		        }
		        else
		        {
		           $mailtxt='for '.$getEvent[0]->waterpark_name;
		        }

				$html='<center> 
						<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
										   
						<tbody>
						<tr> 
							<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width: 120px;"></a></font></td> 
						</tr> 
						<tr align="center"> 
							<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello <span class="il">'.$name.'</span> </td> 
						</tr> 
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Your enquiry has been submitted successfully.We will get back to you soon.</td> 
						</tr> 
						
						<tr> 
											<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'">Visit Website</a></td> 
						</tr> 
										   
					</tbody></table> 
				</center>';
                                        
                                        $fromName=$data['siteDetails']['companyData'][0]->company_name;
                                        $subject="Enquiry submitted on ".$fromName;
                                        $from="no-reply@compaddicts.org";
                                     	$this->mailHtml($email,$subject,$html,$fromName,$from);

            $htmlAdmin='<center> 
						<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
										   
						<tbody>
						<tr> 
							<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width: 120px;"></a></font></td> 
						</tr> 
						<tr align="center"> 
							<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello </td> 
						</tr> 
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">You have received an enquiry '.$mailtxt.'.Here are the details : .</td> 
						</tr>
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Name : </b> '.$name.'</td> 
						</tr>  
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$email.'</td> 
						</tr> 
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Mobile : </b> '.$mobile.'</td> 
						</tr> 
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Address : </b> '.$address.'</td> 
						</tr>
						<tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Visiting Date : </b> '.$visitingDate.'</td> 
						</tr>'.$txtMsg.'
						<tr> 
											<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'admin" target="_blank" data-saferedirecturl="'.base_url().'admin">Login Now</a></td> 
						</tr> 
										   
					</tbody></table> 
				</center>';

                $fromName=$data['siteDetails']['companyData'][0]->company_name;
                $subjectAdmin="Enquiry received on ".$fromName;
                $from="no-reply@compaddicts.org";
                $to="shubhra.compaddicts@gmail.com";
				$this->mailHtml($to,$subjectAdmin,$htmlAdmin,$fromName,$from);

				$this->session->set_flashdata('successMsg','Request Submitted Successfully');
				redirect($redirectUrl);

			}
			else
			{
			   $this->session->set_flashdata('errorMsg','All fields are required');
               redirect($redirectUrl);
			}
		}


		if(isset($_REQUEST['book_now']))  //****** Submiting Enquiry ******
		{
            $event_id=$_REQUEST['event_id'];
	        $merchant_id=$_REQUEST['merchant_id'];
	        $user_id=$_REQUEST['user_id'];
	        $page_type=$_REQUEST['page_type'];
	        $name=$_REQUEST['name'];
	        $email=$_REQUEST['email'];
	        $mobile=$_REQUEST['mobile'];
	        $address=$_REQUEST['address'];
	        $number_of_adults=$_REQUEST['number_of_adults'];
	        $number_of_children=$_REQUEST['number_of_children'];
	        $visiting_date=$_REQUEST['visiting_date'];
	        $date=date('Y-m-d');

	        $exPage=explode('_',$page_type);

			$exPageType=$exPage[0];
			$exPageLink=$exPage[1];
	        if($exPageType=="event")
	        {
	           $folder="event-detail";

	           $getEvent=$this->Admin_model->getWhere('merchants_events',array('id' => $event_id));
	           $ticket_charge_per_person=$getEvent[0]->entry_fee_per_person;
	          
	        }
	        else
	        {
	           $folder="park-detail";

	           $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchant_id));
	           $ticket_charge_per_person=$getMerchant[0]->entry_fee_per_person;
	        }
			$redirectUrl=$folder.'/'.$exPageLink;
             
			if((!empty($name)) && (!empty($email)) && (!empty($mobile)) && (!empty($address)) && (!empty($number_of_adults)) && (!empty($visiting_date)))
			{

               $total_visitors=$number_of_adults + $number_of_children;
               $total_amount=$ticket_charge_per_person * $total_visitors;
               $total_amount=round($total_amount);

	           $getGstTax=$this->Admin_model->getWhere('commission_setting',array('type' => '1','title' => 'GST'));
	           $gst=$getGstTax[0]->amount;

	           $getCgstTax=$this->Admin_model->getWhere('commission_setting',array('type' => '1','title' => 'CGST'));
	           $cgst=$getCgstTax[0]->amount;

	           $tGst=$gst + $cgst;
	           $gstper=$tGst / 100;
	           $gstAmount=$total_amount * $gstper;
	           
	           $gross_total=$total_amount + $gstAmount;
               $gross_total=round($gross_total);

                $visiting_date=date('Y-m-d',strtotime($visiting_date));
				$inArray=array('user_id' => $user_id,'merchant_id' => $merchant_id,'event_id' => $event_id,'name' => $name,'email' => $email,'mobile' => $mobile,'address' => $address,'number_of_adults' => $number_of_adults,'number_of_children' => $number_of_children,'visit_date' => $visiting_date,'total_visitors' => $total_visitors,'ticket_charge_per_person' => $ticket_charge_per_person,'total_amount' => $total_amount,'gst' => $gst,'cgst' => $cgst,'gross_total' => $gross_total, 'requested_on' => $date,'request_type' => 'booking','status' => '0');

				$lastId=$this->Admin_model->insertData('ticket_request',$inArray);

				$this->session->set_userdata('lastWhOrderId',$lastId);

				redirect('billing-detail');

			}
			else
			{
			   $this->session->set_flashdata('errorMsg','All fields are required');
               redirect($redirectUrl);
			}
		}
	}


	public function billingDetails()
	{
		$data['siteDetails']=$this->siteDetails();

		if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

		$orderId=$this->session->userdata('lastWhOrderId');

		$data['getOrderDetail']=$this->Admin_model->getWhere('ticket_request',array('id' => $orderId));
        
        if(isset($_REQUEST['submit']))
        {
            $ticket_request_id=$_REQUEST['ticket_request_id'];
            $name=$_REQUEST['name'];
	        $email=$_REQUEST['email'];
	        $mobile=$_REQUEST['mobile'];
	        $address=$_REQUEST['address'];
	        $city=$_REQUEST['city'];
	        $state=$_REQUEST['state'];
	        $country=$_REQUEST['country'];
	        $pincode=$_REQUEST['pincode'];
	        $total_amount=$_REQUEST['total_amount'];
	        $total_gst=$_REQUEST['total_gst'];
	        $final_amount=$_REQUEST['final_amount'];

            if((!empty($name)) && (!empty($email)) && (!empty($mobile)) && (!empty($address)) && (!empty($city)) && (!empty($state)) && (!empty($country)) && (!empty($pincode))  && (!empty($final_amount)))
			{

	        $getCom=$this->Admin_model->getWhere('commission_setting',array('type' => '2'));
	        $commission=$getCom[0]->amount;

	        $comper=$commission / 100;
	        $comAmount=$final_amount * $comper;
	           
            $commission_amount=round($comAmount);

            $getReq=$this->Admin_model->getWhere('ticket_request',array('id' => $ticket_request_id));
            $user_id=$getReq[0]->user_id;
            $merchant_id=$getReq[0]->merchant_id;
            $event_id=$getReq[0]->event_id;

            $date=date('Y-m-d H:i:s');

                $inArray=array('ticket_request_id' => $ticket_request_id,'event_id' => $event_id,'merchant_id' => $merchant_id,'user_id' => $user_id,'name' => $name,'email' => $email,'mobile' => $mobile,'address' => $address,'city' => $city,'state' => $state,'country' => $country,'pincode' => $pincode,'total_amount' => $total_amount,'total_gst' => $total_gst,'final_amount' => $final_amount,'commission_amount' => $commission_amount, 'added_on' => $date,'payment_status' => '0');

				$lastId=$this->Admin_model->insertData('ticket_billing_details',$inArray);

				$this->session->set_userdata('lastWhTicketId',$lastId);

				redirect('pay-now');
		   }
		   else
		   {
		   	   $this->session->set_flashdata('errorMsg','All fields are required');
               redirect('billing-detail');
		   }

        }

		$this->load->view('front/billing-detail',$data);
	}


    public function payNow()
    {
      $data['siteDetails']=$this->siteDetails();

	  if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

	    $orderId=$this->session->userdata('lastWhTicketId');

		$data['getOrders']=$this->Admin_model->getWhere('ticket_billing_details',array('id' => $orderId));

      $this->load->view('front/pay-now',$data);
    }


    public function paymentSuccess()
    {
       
        $status =      $_REQUEST["status"];
        $firstname =   $_REQUEST["firstname"];
        $amount =      $_REQUEST["amount"];
        $txnid =       $_REQUEST["txnid"];
        $posted_hash = $_REQUEST["hash"];
        $key =         $_REQUEST["key"];
        $productinfo = $_REQUEST["productinfo"];
        $email =       $_REQUEST["email"];
        $salt="e5iIg1jwi8";
        
        
        If (isset($_REQUEST["additionalCharges"])) {
       $additionalCharges=$_REQUEST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
    else {    

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
         $hash = hash("sha512", $retHashSeq);
         
       if ($hash != $posted_hash) {
           $data['status'] = '400';
           return redirect('paymentfailure')->withErrors('Invalid Transaction. Please try again');
          }
      else {
          $data['status'] = '200';
          $data['orderstatus'] = $status;
          $data['transaction'] = $txnid;
          $data['payment'] = $amount;
          
            $orderid = $txnid ;
          


        $data['getData']=$this->Admin_model->getWhere('ticket_billing_details',array('id' => $orderid));
        $ticketid=$data['getData'][0]->ticket_request_id;
        $merchant_id=$data['getData'][0]->merchant_id;
        $event_id=$data['getData'][0]->event_id;
        $user_id=$data['getData'][0]->user_id;
        
        $data['getTicketData']=$this->Admin_model->getWhere('ticket_request',array('id' => $ticketid));
        
        $data['getMerchant']=$this->Admin_model->getWhere('merchants',array('id' => $merchant_id));

        $data['getUser']=$this->Admin_model->getWhere('users',array('id' => $user_id));

        if($event_id!='0')
        {
        	$data['getEvent']=$this->Admin_model->getWhere('merchants_events',array('id' => $event_id));

        	$mailtxt='for event '.$data['getEvent'][0]->name.' in '.$data['getMerchant'][0]->waterpark_name;
        }
        else
        {
		   $mailtxt='for '.$data['getMerchant'][0]->waterpark_name;
        }
       
       $visitDate=date('F j,Y',strtotime($data['getTicketData'][0]->visit_date));

	        ini_set('memory_limit', '256M');
				   // load library
			$this->load->library('pdf');
			$pdf = $this->pdf->load('c','A4','10');

			$htmlTicket = $this->load->view('front/ticket-pdf', $data, true);
		 	$date=date('F j,Y',strtotime(date('Y-m-d')));
			$pdf->Setheader($date);
			$pdf->SetWatermarkText($data['siteDetails']['companyData'][0]->company_name,0.1);
			$pdf->showWatermarkText = true;
			$pdf->SetDisplayMode('fullpage');
			$pdf->WriteHTML($htmlTicket);
			
			$tkName='ticket_' . date('Y_m_d_H_i_s') . '_.pdf';				  
			$output = 'assets/front/uploads/ticket/'.$tkName;
			$pdf->Output("$output", 'F');
	        

          $this->session->set_userdata('whordered_last_id',$orderid);
          $this->Admin_model->updateData('ticket_billing_details',array('payment_status' => '1','ticket' => $tkName),$orderid);
          
          $getData=$this->Admin_model->getWhere('ticket_billing_details',array('id' => $orderid));
          $ticketid=$getData[0]->ticket_request_id;

          $this->Admin_model->updateData('ticket_request',array('payment_status' => '1','status' => '1'),$ticketid);

          $this->session->unset_userdata('lastWhTicketId');
          $this->session->unset_userdata('lastWhOrderId');

          $this->sendOrderMail($orderid);
          
          $this->session->set_flashdata('success','Thank you for booking ticket.Your ticket will be delivered to you soon');
          redirect('thank-you');
        }
    }

    public function paymentFailure()
    {
        $status =      $_REQUEST["status"];
        $firstname =   $_REQUEST["firstname"];
        $amount =      $_REQUEST["amount"];
        $txnid =       $_REQUEST["txnid"];
        $posted_hash = $_REQUEST["hash"];
        $key =         $_REQUEST["key"];
        $productinfo = $_REQUEST["productinfo"];
        $email =       $_REQUEST["email"];
        $salt="e5iIg1jwi8";

         
        If (isset($_REQUEST["additionalCharges"])) {
        $additionalCharges=$_REQUEST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
        }else{    
          $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        $hash = hash("sha512", $retHashSeq);
  
        if($hash != $posted_hash) {
            
           
        }

        $orderid = $txnid ;

          $this->session->set_userdata('whordered_last_id',$orderid);
          $this->Admin_model->updateData('ticket_billing_details',array('payment_status' => '2'),$orderid);
          
          $getData=$this->Admin_model->getWhere('ticket_billing_details',array('id' => $orderid));
          $ticketid=$getData[0]->ticket_request_id;

          $this->Admin_model->updateData('ticket_request',array('payment_status' => '2','status' => '0'),$ticketid);

          $this->session->set_flashdata('error','Invalid Transaction. Please try again');
          redirect('payment-failed');

        //return view ('pages.paymentfailed');
    }
    
    public function thankYou()
    {
       $orderId=$this->session->userdata('whordered_last_id');

       $data['siteDetails']=$this->siteDetails();

	    if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

        $data['getData']=$this->Admin_model->getWhere('ticket_billing_details',array('id' => $orderId));
        $ticketid=$data['getData'][0]->ticket_request_id;
        $merchant_id=$data['getData'][0]->merchant_id;
        $event_id=$data['getData'][0]->event_id;
        $user_id=$data['getData'][0]->user_id;
        
        $data['getTicketData']=$this->Admin_model->getWhere('ticket_request',array('id' => $ticketid));
        
        $data['getMerchant']=$this->Admin_model->getWhere('merchants',array('id' => $merchant_id));

        $data['getUser']=$this->Admin_model->getWhere('users',array('id' => $user_id));

        if($event_id!='0')
        {
        	$data['getEvent']=$this->Admin_model->getWhere('merchants_events',array('id' => $event_id));
        }
        
       $this->load->view('front/thank-you',$data);
    }

    public function paymentFailed()
    {
    	$data['siteDetails']=$this->siteDetails();

	    if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

    	$this->load->view('front/payment-failed',$data);
    }

    public function sendOrderMail($orderId)
    {

    	$data['siteDetails']=$this->siteDetails();

	    if(($this->session->userdata('WhUserLoggedinId')!='') && ($this->session->userdata('WhUserLoggedinId')!='0'))
		{
		  $data['userDetails']=$this->userDetails();
	    }

        $data['getData']=$this->Admin_model->getWhere('ticket_billing_details',array('id' => $orderId));
        $ticketid=$data['getData'][0]->ticket_request_id;
        $merchant_id=$data['getData'][0]->merchant_id;
        $event_id=$data['getData'][0]->event_id;
        $user_id=$data['getData'][0]->user_id;
        
        $data['getTicketData']=$this->Admin_model->getWhere('ticket_request',array('id' => $ticketid));
        
        $data['getMerchant']=$this->Admin_model->getWhere('merchants',array('id' => $merchant_id));

        $data['getUser']=$this->Admin_model->getWhere('users',array('id' => $user_id));

        if($event_id!='0')
        {
        	$data['getEvent']=$this->Admin_model->getWhere('merchants_events',array('id' => $event_id));

        	$mailtxt='for event '.$data['getEvent'][0]->name.' in '.$data['getMerchant'][0]->waterpark_name;
        }
        else
        {
		   $mailtxt='for '.$data['getMerchant'][0]->waterpark_name;
        }
       
       $visitDate=date('F j,Y',strtotime($data['getTicketData'][0]->visit_date));
       $htmlAdmin='<center> 
				<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
					<tbody>
					  <tr> 
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello </td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">You have received a new booking '.$mailtxt.' . Below are the detials of customer : .</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Name : </b> '.$data['getTicketData'][0]->name.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$data['getTicketData'][0]->email.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Mobile : </b> '.$data['getTicketData'][0]->mobile.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Address : </b> '.$data['getTicketData'][0]->address.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Visit Date : </b> '.$visitDate.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Number of adults : </b> '.$data['getTicketData'][0]->number_of_adults.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Number of children : </b> '.$data['getTicketData'][0]->number_of_children.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Total Amount Paid : </b> Rs. '.$data['getData'][0]->final_amount.'</td> 
					 </tr> 
										   
				    </tbody>
				</table> 
			</center>';

		$fromName=$data['siteDetails']['companyData'][0]->company_name;
		$from="no-reply@compaddicts.org";

        $subjectAdmin="Ticket Booked ".$mailtxt;
        $to='shubhra.compaddicts@gmail.com';
		$this->mailHtml($to,$subjectAdmin,$htmlAdmin,$fromName,$from);

		$htmlMerchant='<center> 
				<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
					<tbody>
					  <tr> 
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello <span class="il">'.$data['getMerchant'][0]->name.'</span> </td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">You have received a new booking '.$mailtxt.' . Below are the detials of customer : .</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Name : </b> '.$data['getTicketData'][0]->name.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$data['getTicketData'][0]->email.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Mobile : </b> '.$data['getTicketData'][0]->mobile.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Address : </b> '.$data['getTicketData'][0]->address.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Visit Date : </b> '.$visitDate.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Number of adults : </b> '.$data['getTicketData'][0]->number_of_adults.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Number of children : </b> '.$data['getTicketData'][0]->number_of_children.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Total Amount Paid : </b> Rs. '.$data['getData'][0]->final_amount.'</td> 
					 </tr> 
										   
				    </tbody>
				</table> 
			</center>';

		$subjectMerchant="Ticket Booked ".$mailtxt;
        $toMerchant=$data['getMerchant'][0]->email;
		$this->mailHtml($toMerchant,$subjectMerchant,$htmlMerchant,$fromName,$from);
        
        ini_set('memory_limit', '256M');
			   // load library
		$this->load->library('pdf');
		$pdf = $this->pdf->load('c','A4','10');

		$htmlTicket = $this->load->view('front/ticket-pdf', $data, true);
	 	$date=date('F j,Y',strtotime(date('Y-m-d')));
		$pdf->Setheader($date);
		$pdf->SetWatermarkText($data['siteDetails']['companyData'][0]->company_name,0.1);
		$pdf->showWatermarkText = true;
		$pdf->SetDisplayMode('fullpage');
		$pdf->WriteHTML($htmlTicket);
		
		$tkName='ticket_' . date('Y_m_d_H_i_s') . '_.pdf';				  
		$output = 'assets/front/uploads/ticket/'.$tkName;
		$pdf->Output("$output", 'F');

		$htmlUser='<center> 
				<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
					<tbody>
					  <tr> 
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello <span class="il">'.$data['getUser'][0]->name.'</span> </td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Your ticket has been successfully booked  '.$mailtxt.' . Below are the detials : .</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Name : </b> '.$data['getTicketData'][0]->name.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$data['getTicketData'][0]->email.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Mobile : </b> '.$data['getTicketData'][0]->mobile.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Address : </b> '.$data['getTicketData'][0]->address.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Visit Date : </b> '.$visitDate.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Number of adults : </b> '.$data['getTicketData'][0]->number_of_adults.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Number of children : </b> '.$data['getTicketData'][0]->number_of_children.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Total Amount Paid : </b> Rs. '.$data['getData'][0]->final_amount.'</td> 
					 </tr> 
										   
				    </tbody>
				</table> 
			</center>';

		$subjectUser="Ticket Booked ".$mailtxt;
        $toUser=$data['getUser'][0]->email;
		$fileArray=array($output);
		$this->mailAttachment($toUser,$from,$fromName,$subjectUser,$fileArray,$htmlUser);

		unlink('assets/front/uploads/ticket/'.$tkName);

    }

	public function mailHtml($to,$subject,$template,$fromName,$from)
	{
		
	                $headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= "From: $fromName"." <".$from.">";
                    
                    mail($to,$subject,$template,$headers);

	}

	public function mailAttachment($to,$from,$fromName,$subject,$files,$htmlContent)
	{
			
			//header for sender info
			$headers = "From: $fromName"." <".$from.">";

			//boundary 
			$semi_rand = md5(time()); 
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

			//headers for attachment 
			$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

			//multipart boundary 
			$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
			"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

			//preparing attachment
			if(count($files) > 0){
				for($i=0;$i<count($files);$i++){
					if(is_file($files[$i])){
						$message .= "--{$mime_boundary}\n";
						$fp =    @fopen($files[$i],"rb");
						$data =  @fread($fp,filesize($files[$i]));

						@fclose($fp);
						$data = chunk_split(base64_encode($data));
						$message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
						"Content-Description: ".basename($files[$i])."\n" .
						"Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
						"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
					}
				}
			}
			
			$message .= "--{$mime_boundary}--";
			$returnpath = "-f" . $from;

			//send email
			$mail = @mail($to, $subject, $message, $headers, $returnpath); 
	}

	public function mailAttachmentWithoutUpload($to,$from,$fromName,$subject,$fileatt,$fileatt_type,$fileatt_name,$htmlContent)
	{
					// Read the file to be attached ('rb' = read binary) 
			$file = fopen($fileatt,'rb'); 
			$data = fread($file,filesize($fileatt)); 
			fclose($file); 
 

			//header for sender info
			$headers = "From: $fromName"." <".$from.">";

			//boundary 
			$semi_rand = md5(time()); 
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

			//headers for attachment 
			$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

			//multipart boundary 
			$messageHtml = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
			"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
			// Base64 encode the file data 
			$data = chunk_split(base64_encode($data)); 
			 
			 
			// Add file attachment to the message 
			$messageHtml .= "--{$mime_boundary}\n" . 
			"Content-Type: {$fileatt_type};\n" . 
			" name=\"{$fileatt_name}\"\n" . 
			//"Content-Disposition: attachment;\n" . 
			//" filename=\"{$fileatt_name}\"\n" . 
			"Content-Transfer-Encoding: base64\n\n" . 
			$data . "\n\n" . 
			"--{$mime_boundary}--\n"; 
	}
}
