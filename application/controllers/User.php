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

}
?>