<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

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
			$data=$this->Admin_model->getWhere('merchants',$where);
			return $data;
		}
		
        public function deleteData()
		{
			$mode=$_GET['mode'];

			switch($mode)
			{
				case "event":
				
					$rowid=$_GET['rowid'];

					$getData=$this->Admin_model->getWhere('merchants_events',array('id' => $rowid));
					$file_name=$getData[0]->image;

					$del=$this->Admin_model->deleteData('merchants_events',array('id' => $rowid));

					$getGal=$this->Admin_model->getWhere('gallery',array('event_id' => $rowid));
					foreach($getGal as $rt)
					{
						$rid=$rt->id;
						$img=$rt->image;
						unlink('assets/front/uploads/events/'.$img);
						$del=$this->Admin_model->deleteData('gallery',array('id' => $rid));
					}

					if($file_name!="")
					{
						unlink('assets/front/uploads/events/'.$file_name);
					}

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
				case "event":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('merchants_events',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('merchants_events',array('status' => 0),$rowid);

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
			$this->load->view('front/merchant/ajax',$data);
		}

		public function index()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
          $merchantId=$this->session->userdata('WhUserLoggedinId');

          $date=date('Y-m-d');
          
          $tbl=$this->db->dbprefix.'merchants_events';
		  $data['pasteventCount']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tbl WHERE `end_date` < '$date' and `merchant_id`='$merchantId'");

		  $data['upcomingeventCount']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tbl WHERE `start_date` > '$date' and `merchant_id`='$merchantId'");
          
          $tblTicket=$this->db->dbprefix.'ticket_request';
		  $data['totalTickets']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblTicket WHERE `merchant_id`='$merchantId'");

		  $tblRvw=$this->db->dbprefix.'customer_review';
		  $data['totalReviews']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblRvw WHERE `merchant_id`='$merchantId'");
          
          $data['upcomingEvents']=$this->Admin_model->getQuery("SELECT * FROM $tbl WHERE `start_date` > '$date' and `merchant_id`='$merchantId' ORDER BY `start_date` ASC LIMIT 0,10");

           $data['ongoingEvents']=$this->Admin_model->getQuery("SELECT * FROM $tbl WHERE (`start_date` <= '$date' and `end_date` >= '$date') and (`merchant_id`='$merchantId') ORDER BY `start_date`");

          $data['bookedTickets']=$this->Admin_model->getwithLimitOrderBy('ticket_request',array('merchant_id' => $merchantId),10,0,'id','DESC');
		  
		  $this->load->view('front/merchant/dashboard',$data);
		}

		public function myProfile()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $this->load->view('front/merchant/profile',$data);
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
			 $waterpark_name=$_REQUEST['waterpark_name'];
			 $name=$_REQUEST['name'];
			 $mobile_number=$_REQUEST['mobile_number'];
			 $waterpark_address=$_REQUEST['waterpark_address'];
			 $alternate_mobile_number=$_REQUEST['alternate_mobile_number'];
			 $entry_fee_per_person=$_REQUEST['entry_fee_per_person'];
			 $description=nl2br($_REQUEST['description']); 
			 $logo=$_FILES['logo']['name']; 

			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($waterpark_name)) && (!empty($name)) && (!empty($mobile_number)) && (!empty($waterpark_address)) && (!empty($entry_fee_per_person)) && (!empty($description)))
			 {
				  $upData=array('waterpark_name' => $waterpark_name,'name' => $name,'mobile_number' => $mobile_number,'waterpark_address' => $waterpark_address,'entry_fee_per_person' => $entry_fee_per_person,'description' => $description,'alternate_mobile_number' => $alternate_mobile_number,'updated_on' => $date);

			     $merchantId=$this->session->userdata('WhUserLoggedinId');

				 $this->Admin_model->updateData('merchants',$upData,$merchantId);
				 
				 if(!empty($_FILES['logo']['name']))
				 {
					$config['upload_path']          = './assets/front/uploads/merchant-logo/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('logo'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('merchant/edit-profile');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$merchantId=$this->session->userdata('WhUserLoggedinId');

							$getOldLogo=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
							$oldImg=$getOldLogo[0]->waterpark_logo;

							$upData=array('waterpark_logo' => $file_name,'updated_on' => $date);
							$this->Admin_model->updateData('merchants',$upData,$merchantId);

							if($oldImg!="")
							{
								unlink('assets/front/uploads/merchant-logo/'.$oldImg);
							}

							$this->session->set_flashdata('success','Profile Updated Successfully');
							redirect('merchant/profile');
							
					}
				}
				else
				{
				   $this->session->set_flashdata('success','Profile Updated Successfully');
				   redirect('merchant/profile');
				}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('merchant/edit-profile'); 
			 }
		  }
		  
		  $this->load->view('front/merchant/edit-profile',$data);
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
			      redirect('merchant/change-password'); 
				}
				else
				{
				  $upData=array('password' => $new_password,'updated_on' => $date);
				  $rid=$this->session->userdata('WhUserLoggedinId');
				  $this->Admin_model->updateData('merchants',$upData,$rid);
				  $this->session->set_flashdata('success','Password Changed Successfully');
				  redirect('merchant/profile');	
				}	
			 }
			 else
			 {
			   $this->session->set_flashdata('error','New Password and Confirm Password both are required fields');
			   redirect('merchant/change-password'); 
			 }
			 
		  }

		  $this->load->view('front/merchant/change-password',$data);
		}
		
		public function myEvents()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $merchantId=$this->session->userdata('WhUserLoggedinId');

		  $data['getData']=$this->Admin_model->getWhere('merchants_events',array('merchant_id' => $merchantId));

		  $this->load->view('front/merchant/events',$data);
		}

		public function addEvent()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $title=$_REQUEST['title'];
             $description=nl2br($_REQUEST['description']); 
             $start_date=$_REQUEST['start_date'];
             $end_date=$_REQUEST['end_date'];
             $time=$_REQUEST['time'];
             $entry_fee_per_person=$_REQUEST['entry_fee_per_person'];

			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($title)) && (!empty($description)) && (!empty($start_date)) && (!empty($end_date)) && (!empty($time)) && (!empty($entry_fee_per_person)) && (!empty($_FILES['file']['name'])))
			 {

					$config['upload_path']          = './assets/front/uploads/events/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('merchant/add-event');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$merchantId=$this->session->userdata('WhUserLoggedinId');

							$inData=array('merchant_id' => $merchantId,'name' => $title,'description' => $description,'start_date' => $start_date , 'end_date' => $end_date ,'time' => $time,'entry_fee_per_person' => $entry_fee_per_person ,'image' => $file_name,'added_on' => $date,'status' => '1');
							$this->Admin_model->insertData('merchants_events',$inData);
							$this->session->set_flashdata('success','Event Added Successfully');
							redirect('merchant/events');
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('merchant/add-event'); 
			 }
		  }

		  $this->load->view('front/merchant/add-event',$data);
		}


		public function editEvent($id)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $condition=array('id' => $id);
		  $data['getData']=$this->Admin_model->getWhere('merchants_events',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $title=$_REQUEST['title'];
	             $description=nl2br($_REQUEST['description']); 
	             $start_date=$_REQUEST['start_date'];
	             $end_date=$_REQUEST['end_date'];
	             $time=$_REQUEST['time'];
	             $entry_fee_per_person=$_REQUEST['entry_fee_per_person'];

				
				 $date=date('Y-m-d H:i:s');
				 
				 if((!empty($title)) && (!empty($description)) && (!empty($start_date)) && (!empty($end_date)) && (!empty($time)) && (!empty($entry_fee_per_person)))
				 {
                     $upData=array('name' => $title,'description' => $description,'start_date' => $start_date , 'end_date' => $end_date ,'time' => $time,'entry_fee_per_person' => $entry_fee_per_person ,'updated_on' => $date);
					 $this->Admin_model->updateData('merchants_events',$upData,$rowid);
					 
					 if(!empty($_FILES['file']['name']))
					 {
						$config['upload_path']          = './assets/front/uploads/events/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
						$config['encrypt_name']         = TRUE;


						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('file'))
						{
								$error = $this->upload->display_errors();
								$this->session->set_flashdata('error',$error);
								redirect('merchant/edit-event/'.$rowid);
						}
						else
						{
								$data = $this->upload->data();
								$file_name=$data['file_name'];
								
								$getoldData=$this->Admin_model->getWhere('merchants_events',array('id' => $rowid));
	                            $oldImg=$getoldData[0]->image;
	                            
								$upData=array('image' => $file_name,'updated_on' => $date);
								$this->Admin_model->updateData('merchants_events',$upData,$rowid);

								if($oldImg!="")
								{
									unlink('assets/front/uploads/events/'.$oldImg);
								}

								$this->session->set_flashdata('success','Event Updated Successfully');
								redirect('merchant/events');
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Event Updated Successfully');
					   redirect('merchant/events');
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','Name,Designation and Description are required fields');
			        redirect('merchant/edit-event/'.$rowid); 
                 }

                 
		  }

		  $this->load->view('front/merchant/edit-event',$data);
		}
		

        public function viewStaff()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();

		  $data['getData']=$this->Admin_model->getData('staff');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/staff',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addStaff()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $name=$_REQUEST['name']; 
             $designation=$_REQUEST['designation']; 
             $description=$_REQUEST['description']; 
             $facebook_link=$_REQUEST['facebook_link']; 
             $twitter_link=$_REQUEST['twitter_link']; 
             $google_plus_link=$_REQUEST['google_plus_link']; 
			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($name)) && (!empty($_FILES['file']['name'])) && (!empty($designation)) && (!empty($description)))
			 {

					$config['upload_path']          = './assets/front/uploads/staff/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/add-staff');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$inData=array('name' => $name,'designation' => $designation,'description' => $description,'facebook_link' => $facebook_link,'twitter_link' => $twitter_link,'google_plus_link' => $google_plus_link,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('staff',$inData);
							$this->session->set_flashdata('success','Staff Added Successfully');
							redirect('admin/staff');
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','Name,Designation,Description and Image are required fields');
			    redirect('admin/add-staff'); 
			 }
		  }

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/add-staff',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function editStaff($id)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $condition=array('id' => $id);
		  $data['getData']=$this->Admin_model->getWhere('staff',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $name=$_REQUEST['name']; 
	             $designation=$_REQUEST['designation']; 
	             $description=$_REQUEST['description']; 
	             $facebook_link=$_REQUEST['facebook_link']; 
	             $twitter_link=$_REQUEST['twitter_link']; 
	             $google_plus_link=$_REQUEST['google_plus_link'];  

			     $date=date('Y-m-d H:i:s');
                 if((!empty($name)) && (!empty($designation)) && (!empty($description)))
                 {
                     $upData=array('name' => $name,'designation' => $designation,'description' => $description,'facebook_link' => $facebook_link,'twitter_link' => $twitter_link,'google_plus_link' => $google_plus_link,'updated_on' => $date);
					 $this->Admin_model->updateData('staff',$upData,$rowid);
					 
					 if(!empty($_FILES['file']['name']))
					 {
						$config['upload_path']          = './assets/front/uploads/staff/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
						$config['encrypt_name']         = TRUE;


						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('file'))
						{
								$error = $this->upload->display_errors();
								$this->session->set_flashdata('error',$error);
								redirect('admin/edit-staff/'.$rowid);
						}
						else
						{
								$data = $this->upload->data();
								$file_name=$data['file_name'];
								
								$getoldData=$this->Admin_model->getWhere('staff',array('id' => $rowid));
	                            $oldImg=$getoldData[0]->image;
	                            
								$upData=array('image' => $file_name,'updated_on' => $date);
								$this->Admin_model->updateData('staff',$upData,$rowid);

								if($oldImg!="")
								{
									unlink('assets/front/uploads/staff/'.$oldImg);
								}

								$this->session->set_flashdata('success','Staff Updated Successfully');
								redirect('admin/staff');
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Staff Updated Successfully');
					   redirect('admin/staff');
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','Name,Designation and Description are required fields');
			        redirect('admin/edit-staff/'.$rowid); 
                 }

                 
		  }
		  
		  
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-staff',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function viewGallery()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();

		  $data['getData']=$this->Admin_model->getData('gallery');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/gallery',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addGallery()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $title=$_REQUEST['title']; 
			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($_FILES['file']['name'])))
			 {

					$config['upload_path']          = './assets/front/uploads/gallery/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/add-gallery');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$inData=array('title' => $title,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('gallery',$inData);
							$this->session->set_flashdata('success','Gallery Added Successfully');
							redirect('admin/gallery');
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','Gallery image is required field');
			    redirect('admin/add-gallery'); 
			 }
		  }

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/add-gallery',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function editGallery($id)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $condition=array('id' => $id);
		  $data['getData']=$this->Admin_model->getWhere('gallery',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $title=$_REQUEST['title'];  

			     $date=date('Y-m-d H:i:s');
                 
                 $upData=array('title' => $title,'updated_on' => $date);
				 $this->Admin_model->updateData('gallery',$upData,$rowid);
				 
				 if(!empty($_FILES['file']['name']))
				 {
					$config['upload_path']          = './assets/front/uploads/gallery/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/edit-gallery/'.$rowid);
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$getoldData=$this->Admin_model->getWhere('gallery',array('id' => $rowid));
                            $oldImg=$getoldData[0]->image;

							$upData=array('image' => $file_name,'updated_on' => $date);
							$this->Admin_model->updateData('gallery',$upData,$rowid);

							if($oldImg!="")
							{
								unlink('assets/front/uploads/gallery/'.$oldImg);
							}

							$this->session->set_flashdata('success','Gallery Updated Successfully');
							redirect('admin/gallery');
							
					}
				}
				else
				{
				   $this->session->set_flashdata('success','Gallery Updated Successfully');
				   redirect('admin/gallery');
				}	
		  }
		  
		  
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-gallery',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function viewContent()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();

		  $data['getData']=$this->Admin_model->getData('content');

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/content',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addContent()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $menu=$_REQUEST['menu']; 
             $date=date('Y-m-d H:i:s');
             
             if(!empty($menu))
             {
	            switch($menu)
	             {
	             	case "home":
	                  
	                  $position=$_REQUEST['position'];

	                  if(empty($position))
	                  {
                         $errAlert="1";
                         $errMsg="Position is required";
	                  }
	                  else
	                  {
		                  switch($position)
		                  {
		                    case "fourth-row":
		                        
		                        $home_teacher_count=$_REQUEST['home_teacher_count'];
		                        $home_course_count=$_REQUEST['home_course_count'];
		                        $home_student_count=$_REQUEST['home_student_count'];
		                        $home_satisfied_client_count=$_REQUEST['home_satisfied_client_count'];

		                        if((!empty($home_teacher_count)) && (!empty($home_course_count)) && (!empty($home_student_count)) && (!empty($home_satisfied_client_count)))
								 {
								 	$errAlert="2";
								 	$inArray=array('menu' => $menu,'position' => $position,'home_teacher_count' => $home_teacher_count,'home_course_count' => $home_course_count,'home_student_count' => $home_student_count,'home_satisfied_client_count' => $home_satisfied_client_count,'added_on' => $date);
								 }
								 else
								 {
								 	$errAlert="1";
                                    $errMsg="Stats fro Teacher,Courses,Students and satisfied clients are required";
								 }

		                    break;

		                    default:

		                        $title=$_REQUEST['title'];
		                        $description=nl2br($_REQUEST['description']);

		                        if((!empty($title)) && (!empty($description)))
								 {
								 	$errAlert="2";
								 	$inArray=array('menu' => $menu,'position' => $position,'title' => $title,'description' => $description,'added_on' => $date);
								 }
								 else
								 {
								 	$errAlert="1";
                                    $errMsg="Title and description are required";
								 }

		                    break;
		                  }
	                  }

	             	break;

	             	default:
	                        $title=$_REQUEST['title'];
	                        $description=$_REQUEST['description'];
echo $description;
exit;
	                        if((!empty($title)) && (!empty($description)))
							{
								$errAlert="2";
								$inArray=array('menu' => $menu,'position' => '','title' => $title,'description' => $description,'added_on' => $date);
							}
							else
							{
								$errAlert="1";
                                $errMsg="Title and description are required";
							}
	             	break;
	             }

	             if($errAlert==1)
	             {
				    $this->session->set_flashdata('error',$errMsg);
			        redirect('admin/add-content'); 	
	             }
	             else
	             {
             	   $lastId=$this->Admin_model->insertData('content',$inArray);
                   
                   if(!empty($_FILES['file']['name']))
                   {
	             	    $config['upload_path']          = './assets/front/uploads/content/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
						$config['encrypt_name']         = TRUE;


						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('file'))
						{
								$err = $this->upload->display_errors();
								$error="Content added successfully but unable to save image".$err;
								$this->session->set_flashdata('error',$error);
								redirect('admin/content');
						}
						else
						{
								$data = $this->upload->data();
								$file_name=$data['file_name'];
								
								$inImg=array('image' => $file_name);
								$this->Admin_model->updateData('content',$inImg,$lastId);
								$this->session->set_flashdata('success','Content Added Successfully');
								redirect('admin/content');
								
						}	
				   }
				   else
				   {
				       	$this->session->set_flashdata('success','Content Added Successfully');
						redirect('admin/content');
				   }
	             }
            }
            else
			 {
				$this->session->set_flashdata('error','Menu is required');
			    redirect('admin/add-content'); 
			 }

		  }

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/add-content',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function editContent($id)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $condition=array('id' => $id);
		  $data['getData']=$this->Admin_model->getWhere('content',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			 $rowid=$_REQUEST['rowid'];  
			 $menu=$_REQUEST['menu']; 
             $date=date('Y-m-d H:i:s');
             
             if(!empty($menu))
             {
	            switch($menu)
	             {
	             	case "home":
	                  
	                  $position=$_REQUEST['position'];

	                  if(empty($position))
	                  {
                         $errAlert="1";
                         $errMsg="Position is required";
	                  }
	                  else
	                  {
		                  switch($position)
		                  {
		                    case "fourth-row":
		                        
		                        $home_teacher_count=$_REQUEST['home_teacher_count'];
		                        $home_course_count=$_REQUEST['home_course_count'];
		                        $home_student_count=$_REQUEST['home_student_count'];
		                        $home_satisfied_client_count=$_REQUEST['home_satisfied_client_count'];

		                        if((!empty($home_teacher_count)) && (!empty($home_course_count)) && (!empty($home_student_count)) && (!empty($home_satisfied_client_count)))
								 {
								 	$errAlert="2";
								 	$inArray=array('menu' => $menu,'position' => $position,'home_teacher_count' => $home_teacher_count,'home_course_count' => $home_course_count,'home_student_count' => $home_student_count,'home_satisfied_client_count' => $home_satisfied_client_count,'title' => '','description' => '','image' => '','updated_on' => $date);
								 }
								 else
								 {
								 	$errAlert="1";
                                    $errMsg="Stats fro Teacher,Courses,Students and satisfied clients are required";
								 }

		                    break;

		                    default:

		                        $title=$_REQUEST['title'];
		                        $description=$_REQUEST['description'];

		                        if((!empty($title)) && (!empty($description)))
								 {
								 	$errAlert="2";
								 	$inArray=array('menu' => $menu,'position' => $position,'home_teacher_count' => '0','home_course_count' => '0','home_student_count' => '0','home_satisfied_client_count' => '0','title' => $title,'description' => $description,'updated_on' => $date);
								 }
								 else
								 {
								 	$errAlert="1";
                                    $errMsg="Title and description are required";
								 }

		                    break;
		                  }
	                  }

	             	break;

	             	default:
	                        $title=$_REQUEST['title'];
	                        $description=$_REQUEST['description'];

	                        if((!empty($title)) && (!empty($description)))
							{
								$errAlert="2";
								$inArray=array('menu' => $menu,'position' => '','home_teacher_count' => '0','home_course_count' => '0','home_student_count' => '0','home_satisfied_client_count' => '0','title' => $title,'description' => $description,'updated_on' => $date);
							}
							else
							{
								$errAlert="1";
                                $errMsg="Title and description are required";
							}
	             	break;
	             }

	             if($errAlert==1)
	             {
				    $this->session->set_flashdata('error',$errMsg);
			        redirect('admin/edit-content/'.$rowid);
	             }
	             else
	             {
             	   $this->Admin_model->updateData('content',$inArray,$rowid);
                   
                   if(!empty($_FILES['file']['name']))
                   {
	             	    $config['upload_path']          = './assets/front/uploads/content/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
						$config['encrypt_name']         = TRUE;


						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('file'))
						{
								$err = $this->upload->display_errors();
								$error="Content added successfully but unable to save image".$err;
								$this->session->set_flashdata('error',$error);
								redirect('admin/content');
						}
						else
						{
								$data = $this->upload->data();
								$file_name=$data['file_name'];
								
								$inImg=array('image' => $file_name);
								$this->Admin_model->updateData('content',$inImg,$rowid);
								$this->session->set_flashdata('success','Content Updated Successfully');
								redirect('admin/content');
								
						}	
				   }
				   else
				   {
				       	$this->session->set_flashdata('success','Content Updated Successfully');
						redirect('admin/content');
				   }
	             }
            }
            else
			 {
				$this->session->set_flashdata('error','Menu is required');
			    redirect('admin/edit-content/'.$rowid); 
			 }
                 
		  }
		  
		  
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-content',$data);
		  $this->load->view('admin/common/footer',$data);
		}

}
?>