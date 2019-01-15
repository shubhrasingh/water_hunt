<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
			$data=$this->Admin_model->getWhere('master_admin',$where);
			return $data;
		}
		
		
		public function adminDetails()
		{
			$uid=$this->session->userdata('WhAdminLoggedinId');
			$where=array('id' => $uid);
			$data=$this->Admin_model->getWhere('master_admin',$where);
			return $data;
		}
		
        public function deleteData()
		{
			$mode=$_GET['mode'];

			switch($mode)
			{
				case "questions":
				
					$rowid=$_GET['rowid'];	
					$del=$this->Admin_model->deleteData('questions',array('id' => $rowid));
					$del=$this->Admin_model->deleteData('answer_set',array('question_id' => $rowid));
					
				break;

				case "slider":
				
					$rowid=$_GET['rowid'];	

					$getData=$this->Admin_model->getWhere('sliders',array('id' => $rowid));
					$file_name=$getData[0]->image;

					$del=$this->Admin_model->deleteData('sliders',array('id' => $rowid));

					if($file_name!="")
					{
						unlink('assets/front/uploads/slider/'.$file_name);
					}
					
				break;

				case "staff":
				
					$rowid=$_GET['rowid'];	

					$getData=$this->Admin_model->getWhere('staff',array('id' => $rowid));
					$file_name=$getData[0]->image;

					$del=$this->Admin_model->deleteData('staff',array('id' => $rowid));

					if($file_name!="")
					{
						unlink('assets/front/uploads/staff/'.$file_name);
					}
					
				break;

				case "gallery":
				
					$rowid=$_GET['rowid'];	

					$getData=$this->Admin_model->getWhere('gallery',array('id' => $rowid));
					$file_name=$getData[0]->image;

					$del=$this->Admin_model->deleteData('gallery',array('id' => $rowid));

					if($file_name!="")
					{
						unlink('assets/front/uploads/gallery/'.$file_name);
					}
					
				break;

				case "content":
				
					$rowid=$_GET['rowid'];	

					$getData=$this->Admin_model->getWhere('content',array('id' => $rowid));
					$file_name=$getData[0]->image;

					$del=$this->Admin_model->deleteData('content',array('id' => $rowid));

					if($file_name!="")
					{
						unlink('assets/front/uploads/content/'.$file_name);
					}
					
				break;
			
			}
		}
		
		
		public function statusToggle()
		{
			$mode=$_GET['mode'];
			$action=$_GET['action'];

			switch($mode)
			{
				case "questions":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('questions',array('status' => 1),$rowid);
					      $this->Admin_model->updateWhere('answer_set',array('status' => 1),array('question_id' => $rowid));
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('questions',array('status' => 2),$rowid);
					       $this->Admin_model->updateWhere('answer_set',array('status' => 2),array('question_id' => $rowid));

						break;
					}
					
				break;


				case "slider":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('slider',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('slider',array('status' => 2),$rowid);

						break;
					}
					
				break;

				case "staff":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('staff',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('staff',array('status' => 2),$rowid);

						break;
					}
					
				break;

				case "gallery":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('gallery',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('gallery',array('status' => 2),$rowid);

						break;
					}
					
				break;

				case "content":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('content',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('content',array('status' => 2),$rowid);

						break;
					}
					
				break;
			
			}
			
			$data['action']=$action;
			$data['rowid']=$rowid;
			$this->load->view('admin/ajax',$data);
		}

		public function index()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/dashboard',$data);
		  $this->load->view('admin/common/footer',$data);
		}
		
		
		public function profile()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $uid=$this->session->userdata('WhAdminLoggedinId');
		  $condition=array('id' => $uid);
		  $data['getProfile']=$this->Admin_model->getWhere('master_admin',$condition);
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/profile',$data);
		  $this->load->view('admin/common/footer',$data);
		}
		
		
		public function editCompanyprofile()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $uid=$this->session->userdata('WhAdminLoggedinId');
		  $condition=array('id' => $uid);
		  $data['getProfile']=$this->Admin_model->getWhere('master_admin',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			 $company_name=$_REQUEST['company_name']; 
			 $company_email=$_REQUEST['company_email']; 
			 $company_number=$_REQUEST['company_number']; 
			 $facebook_link=$_REQUEST['facebook_link']; 
			 $twitter_link=$_REQUEST['twitter_link']; 
			 $google_link=$_REQUEST['google_link']; 
			 $linkedin_link=$_REQUEST['linkedin_link']; 
			 $company_address=nl2br($_REQUEST['company_address']); 
			 $company_about=nl2br($_REQUEST['company_about']); 

			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($company_name)) && (!empty($company_email)) && (!empty($company_number)) && (!empty($company_about)))
			 {
				  $upData=array('company_name' => $company_name,'company_email' => $company_email,'company_number' => $company_number,'company_address' => $company_address,'company_about' => $company_about,'facebook_link' => $facebook_link,'twitter_link' => $twitter_link,'google_link' => $google_link,'linkedin_link' => $linkedin_link,'updated_on' => $date);
			 
				 $this->Admin_model->updateCompanyprofile($upData);
				 
				 if(!empty($_FILES['file']['name']))
				 {
					$config['upload_path']          = './assets/front/uploads/logo/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/edit-company-profile');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$upData=array('company_logo' => $file_name,'updated_on' => $date);
							$this->Admin_model->updateCompanyprofile($upData);
							$this->session->set_flashdata('success','Profile Updated Successfully');
							redirect('admin/profile');
							
					}
				}
				else
				{
				   $this->session->set_flashdata('success','Profile Updated Successfully');
				   redirect('admin/profile');
				}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','Company Name,Company Email and Company Phone are required fields');
			    redirect('admin/edit-company-profile'); 
			 }
			
				

		  }
		  
		  
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-company-profile',$data);
		  $this->load->view('admin/common/footer',$data);
		}
		
		
		public function changePassword()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
		  {
			  redirect('admin/login');
		  }
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
			 $new_password=$_REQUEST['new_password']; 
			 $confirm_password=$_REQUEST['confirm_password']; 
			 
			 if((!empty($new_password)) && (!empty($confirm_password)))
			 {
				if($new_password!=$confirm_password)
				{
				  $this->session->set_flashdata('error','New Password and Confirm Password do not matched');
			      redirect('admin/change-password'); 
				}
				else
				{
				  $upData=array('password' => $new_password,'updated_on' => $date);
				  $rid=$this->session->userdata('WhAdminLoggedinId');
				  $this->Admin_model->updateData('master_admin',$upData,$rid);
				  $this->session->set_flashdata('success','Password Changed Successfully');
				  redirect('admin/profile');	
				}	
			 }
			 else
			 {
			   $this->session->set_flashdata('error','New Password and Confirm Password both are required fields');
			   redirect('admin/change-password'); 
			 }
			 
		  }
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/change-password',$data);
		  $this->load->view('admin/common/footer',$data);
		}
		

}
?>