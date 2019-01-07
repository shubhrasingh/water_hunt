<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

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
			$data=$this->Admin_model->getWhere('master_admin',$where);
			return $data;
		}
		
		public function index()
		{
			if($this->session->userdata('WhAdminLoggedinId')!='')
			{
			  redirect('admin/dashboard');
			}
		
			$data['siteDetails']=$this->siteDetails();
			  
			if(isset($_REQUEST['signin']))
			  {
				  $username=$_REQUEST['username'];
				  $password=$_REQUEST['password'];
				  $ip=$_SERVER['REMOTE_ADDR'];
				  
				   $where=array('email' => $username,'password' => $password,'status' => 1);
				   $queryCount=$this->Admin_model->getWhere('master_admin',$where);
				   $countData=count($queryCount);

					  if($countData!=0)
					  {
						  $uid=$queryCount[0]->id;
						  $role=$queryCount[0]->role;
                          
                          switch($role)
                          {
                          	case "1":
                              $userType="admin";
                          	break;

                          	case "2":
                              $userType="subadmin";
                          	break;
                          }
                          
						  $this->session->set_userdata('WhAdminLoggedinId',$uid);
						  $this->session->set_userdata('WhLoggedInAdminType',$userType);
						  $this->session->set_flashdata('success','Welcome to your portal');
						  redirect('admin/dashboard');
					  }
					  else
					  {
						   $this->session->set_flashdata('error','Invalid Login Details');
					  }
			  }
			  
			$this->load->view('admin/login',$data);
		}
		
		
		public function logout()
		{
		    $this->session->unset_userdata('WhAdminLoggedinId');			
		    $this->session->unset_userdata('WhLoggedInAdminType');			
			$this->session->sess_destroy();
			redirect('admin');
		}
		
		
		public function getAddress($latitude,$longitude){
			if(!empty($latitude) && !empty($longitude)){
				//Send request and receive json data by address
				$geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
				$output = json_decode($geocodeFromLatLong);
				$status = $output->status;
				//Get address from json data
				$address = ($status=="OK")?$output->results[1]->formatted_address:'';
				//Return address of the given latitude and longitude
				if(!empty($address)){
					return $address;
				}else{
					return false;
				}
			}else{
				return false;   
			}
		}
		
		
}
?>