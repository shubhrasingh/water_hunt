<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		   $this->load->library('form_validation');
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
			$data=$this->Admin_model->getWhere('users',$where);
			return $data;
		}
		

		public function index()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $userId=$this->session->userdata('WhUserLoggedinId');

          $date=date('Y-m-d');

          $tblTicket=$this->db->dbprefix.'ticket_request';
		  $data['totalTickets']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblTicket WHERE `user_id`='$userId' and `request_type`='booking' and `payment_status`='1'");

		  $data['totalEnqTickets']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblTicket WHERE `user_id`='$userId' and `request_type`='enquiry'");

		  $tblRvw=$this->db->dbprefix.'customer_review';
		  $data['totalReviews']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblRvw WHERE `user_id`='$userId'");

          $data['bookedTickets']=$this->Admin_model->getwithLimitOrderBy('ticket_request',array('request_type' => 'booking','payment_status' => '1','user_id' => $userId),10,0,'id','DESC');

		  $this->load->view('front/user/dashboard',$data);
		}

		public function myProfile()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $this->load->view('front/user/profile',$data);
		}

		public function editProfile()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();

		  if(isset($_REQUEST['update']))
		  {
			 $name=$_REQUEST['name'];
			 $mobile_number=$_REQUEST['mobile_number'];
			 $address=$_REQUEST['address'];
			 
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($name)) && (!empty($mobile_number)) && (!empty($address)))
			 {
				  $upData=array('name' => $name,'mobile' => $mobile_number,'address' => $address,'updated_on' => $date);

			     $merchantId=$this->session->userdata('WhUserLoggedinId');

				 $this->Admin_model->updateData('users',$upData,$merchantId);
				 
				 $this->session->set_flashdata('success','Profile Updated Successfully');
				 redirect('user/profile');	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('user/edit-profile'); 
			 }
		  }
		  
		  $this->load->view('front/user/edit-profile',$data);
		}
		
		
		public function changePassword()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
		  {
			  redirect('login');
		  }
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
			 $new_password=$_REQUEST['new_password']; 
			 $confirm_password=$_REQUEST['confirm_password']; 
			 
			 if((!empty($new_password)) && (!empty($confirm_password)))
			 {
				if($new_password!=$confirm_password)
				{
				  $this->session->set_flashdata('error','New Password and Confirm Password do not matched');
			      redirect('user/change-password'); 
				}
				else
				{
				  $upData=array('password' => $new_password,'updated_on' => $date);
				  $rid=$this->session->userdata('WhUserLoggedinId');
				  $this->Admin_model->updateData('users',$upData,$rid);
				  $this->session->set_flashdata('success','Password Changed Successfully');
				  redirect('user/profile');	
				}	
			 }
			 else
			 {
			   $this->session->set_flashdata('error','New Password and Confirm Password both are required fields');
			   redirect('user/change-password'); 
			 }
			 
		  }
		  
		  $this->load->view('front/user/change-password',$data);
		}

		public function myBookings()
		{
		   if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
          
          if(isset($_REQUEST['cancel_ticket']))
          {
            $booking_id=$_REQUEST['rowid'];
            $cancellation_reason=$_REQUEST['cancellation_reason'];
            $cancelled_by='user';
            
            $getTicket=$this->Admin_model->getWhere('ticket_request',array('id' => $booking_id));
            $userId=$getTicket[0]->user_id;
            $merchantId=$getTicket[0]->merchant_id;
            $eventId=$getTicket[0]->event_id;
            $visit_date=$getTicket[0]->visit_date;
            $visitDate=date('M j,Y',strtotime($visit_date));

            $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $userId));
            $waterParkName=$getMerchant[0]->waterpark_name;
            $merchantName=$getMerchant[0]->name;
            $toMerchantEmail=$getMerchant[0]->email;

            $getUser=$this->userDetails();
            $userName=$getUser[0]->name;
            $toUserEmail=$getUser[0]->email;

            $this->Admin_model->updateData('ticket_request',array('status' => 2,'cancellation_reason' => $cancellation_reason,'cancelled_by' => $cancelled_by),$booking_id);

             if($eventId!='0')
             {
                $getEvent=$this->Admin_model->getWhere('merchants_events',array('id' => $eventId));
                $bookedFor="event ".$getEvent[0]->name;
             }
             else
             {
             	$bookedFor="water park ".$waterParkName;
             }

            $data['siteDetails']=$this->siteDetails();
            $htmlUser='<center> 
				<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
					<tbody>
					  <tr> 
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello '.$userName.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">The ticket which was booked for '.$bookedFor.' , to be visited on '.$visitDate.' , has been cancelled successfully.</td> 
					 </tr> 	
					  <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Reason : </b> '.$cancellation_reason.'</td> 
					 </tr> 	   
				    </tbody>
				</table> 
			</center>';

			$fromName=$data['siteDetails']['companyData'][0]->company_name;
			$from="no-reply@compaddicts.org";

	        $subjectUser='Ticket cancelled - '.$waterParkName;
			$this->mailHtml($toUserEmail,$subjectUser,$htmlUser,$fromName,$from);


			$htmlMerchant='<center> 
				<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
					<tbody>
					  <tr> 
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello '.$merchantName.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">The ticket which was booked for '.$bookedFor.' , to be visited on '.$visitDate.' , has been cancelled by the customer.Here are the customer details : </td> 
					 </tr> 	
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Name : </b> '.$getTicket[0]->name.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$getTicket[0]->email.'</td> 
					 </tr>
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Mobile : </b> '.$getTicket[0]->mobile.'</td> 
					 </tr>
					  <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Reason : </b> '.$cancellation_reason.'</td> 
					 </tr> 	   
				    </tbody>
				</table> 
			</center>';

			$fromName=$data['siteDetails']['companyData'][0]->company_name;
			$from="no-reply@compaddicts.org";

	        $subjectMerchant='Ticket cancelled - '.$bookedFor;
			$this->mailHtml($toMerchantEmail,$subjectMerchant,$htmlMerchant,$fromName,$from);

            $this->session->set_flashdata('success','Ticket has been cancelled');
            redirect('user/bookings');
          }

          $userId=$this->session->userdata('WhUserLoggedinId');
		  $data['getBooking']=$this->Admin_model->getWhere('ticket_request',array('user_id' => $userId,'request_type' => 'booking','payment_status' => 1));
		  
		  $this->load->view('front/user/booking',$data);
		}


		public function myEnquiries()
		{
		   if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
          
          $userId=$this->session->userdata('WhUserLoggedinId');
		  $data['getEnquiry']=$this->Admin_model->getWhere('ticket_request',array('user_id' => $userId,'request_type' => 'enquiry'));
		  
		  $this->load->view('front/user/enquiry',$data);
		}


		public function deleteData()
		{
			$mode=$_GET['mode'];

			switch($mode)
			{
				case "booking":
				
					$rowid=$_GET['rowid'];

					$del=$this->Admin_model->deleteData('ticket_request',array('id' => $rowid));
					$del=$this->Admin_model->deleteData('ticket_billing_details',array('ticket_request_id' => $rowid));

				break;

				case "enquiry":
				
					$rowid=$_GET['rowid'];

					$del=$this->Admin_model->deleteData('ticket_request',array('id' => $rowid));

				break;
			}
		}

		public function mailHtml($to,$subject,$template,$fromName,$from)
		{
			
		                $headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						// More headers
						$headers .= "From: $fromName"." <".$from.">";
	                    
	                    mail($to,$subject,$template,$headers);

		}

}
?>