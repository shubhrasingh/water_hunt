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

				case "eventGallery":
				
					$rowid=$_GET['rowid'];	

					$getData=$this->Admin_model->getWhere('gallery',array('id' => $rowid));
					$file_name=$getData[0]->image;

					$del=$this->Admin_model->deleteData('gallery',array('id' => $rowid));

					if($file_name!="")
					{
						unlink('assets/front/uploads/events/'.$file_name);
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
			 $waterpark_city=$_REQUEST['waterpark_city'];
			 $waterpark_state=$_REQUEST['waterpark_state'];
			 $alternate_mobile_number=$_REQUEST['alternate_mobile_number'];
			 $entry_fee_per_person=$_REQUEST['entry_fee_per_person'];
			 $description=nl2br($_REQUEST['description']); 
			 $logo=$_FILES['logo']['name']; 

			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($waterpark_name)) && (!empty($name)) && (!empty($mobile_number)) && (!empty($waterpark_address)) && (!empty($waterpark_city)) && (!empty($waterpark_state)) && (!empty($entry_fee_per_person)) && (!empty($description)))
			 {
				  $upData=array('waterpark_name' => $waterpark_name,'name' => $name,'mobile_number' => $mobile_number,'waterpark_address' => $waterpark_address,'waterpark_city' => $waterpark_city,'waterpark_state' => $waterpark_state,'entry_fee_per_person' => $entry_fee_per_person,'description' => $description,'alternate_mobile_number' => $alternate_mobile_number,'updated_on' => $date);

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
		
		public function editTiming()
		{
			if($this->session->userdata('WhUserLoggedinId')=='')
		  {
			  redirect('login');
		  }
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
			 $dCount=$_REQUEST['day_name']; 
			 
			 if(count($dCount)!=0)
			 {
			 	$limit=count($dCount);
			 	for($a=0;$a<$limit;$a++)
			 	{
			 		$day_name=$_REQUEST['day_name'][$a];
			 		$closed=$_REQUEST['closed'][$a];
			 		$start_time=$_REQUEST['start_time'][$a];
			 		$end_time=$_REQUEST['end_time'][$a];
                    
                    $merchantId=$this->session->userdata('WhUserLoggedinId');

			 		if($closed!='1')
			 		{
			 			$dtArray=array('merchant_id' => $merchantId,'day_name' => $day_name,'closed_status ' => '0','start_time' => $start_time,'end_time' => $end_time);
			 		}
			 		else
			 		{
			 			$dtArray=array('merchant_id' => $merchantId,'day_name' => $day_name,'closed_status ' => '1','start_time' => '','end_time' => '');
			 		}

			 	   $getDt=$this->Admin_model->getWhere('merchant_timing',array('merchant_id' => $merchantId,'day_name' =>$day_name));
                   if(count($getDt)!=0)
                   {
                   	  $rid=$getDt[0]->id;
                   	  $this->Admin_model->updateData('merchant_timing',$dtArray,$rid);
                   }
                   else
                   {
                    	$this->Admin_model->insertData('merchant_timing',$dtArray);
                   }
			 	}
			 	$this->session->set_flashdata('success','Timings updated successfully');
				redirect('merchant/profile');	
			 }
			 else
			 {
			 	$this->session->set_flashdata('error','Something went wrong');
				redirect('merchant/edit-timing');	
			 }
			 
		  }

		  $this->load->view('front/merchant/edit-timing',$data);
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
		
		public function eventGallery($eventId)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();

		  $data['getData']=$this->Admin_model->getWhere('gallery',array('event_id' => $eventId));
          $data['eventId']=$eventId;

		  $this->load->view('front/merchant/event-gallery',$data);
		}

		public function addEventGallery($eventId)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['eventId']=$eventId;
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $eventId=$_REQUEST['event_id'];
             $title=$_REQUEST['title'];
             $description=nl2br($_REQUEST['description']); 

			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($title)) && (!empty($description)) && (!empty($_FILES['file']['name'])))
			 {

					$config['upload_path']          = './assets/front/uploads/events/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('merchant/add-event-gallery/'.$eventId);
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$merchantId=$this->session->userdata('WhUserLoggedinId');

							$inData=array('merchant_id' => $merchantId,'event_id' => $eventId,'title' => $title,'description' => $description,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('gallery',$inData);
							$this->session->set_flashdata('success','Event Gallery Added Successfully');
							redirect('merchant/event-gallery/'.$eventId);
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('merchant/add-event-gallery/'.$eventId); 
			 }
		  }

		  $this->load->view('front/merchant/add-event-gallery',$data);
		}


         public function editEventGallery($rowId)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
		  
          
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $condition=array('id' => $rowId);
		  $data['getData']=$this->Admin_model->getWhere('gallery',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $title=$_REQUEST['title'];
	             $description=nl2br($_REQUEST['description']); 
                 $getoldData=$this->Admin_model->getWhere('gallery',array('id' => $rowid));
                 $eventId=$getoldData['0']->event_id;
				
				 $date=date('Y-m-d H:i:s');
				 
				 if((!empty($title)) && (!empty($description)))
				 {
                     $upData=array('title' => $title,'description' => $description,'updated_on' => $date);
					 $this->Admin_model->updateData('gallery',$upData,$rowid);
					 
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
								redirect('merchant/edit-event-gallery/'.$rowid);
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
									unlink('assets/front/uploads/events/'.$oldImg);
								}

								$this->session->set_flashdata('success','Event Gallery Updated Successfully');
								redirect('merchant/event-gallery/'.$eventId);
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Event Gallery Updated Successfully');
					   redirect('merchant/event-gallery/'.$eventId);
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','All fields are required');
			        redirect('merchant/edit-event-gallery/'.$rowid); 
                 }

                 
		  }

		  $this->load->view('front/merchant/edit-event-gallery',$data);
		}

		public function myGallery()
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
          
          $merchantId=$this->session->userdata('WhUserLoggedinId');
		  $data['getData']=$this->Admin_model->getWhere('gallery',array('merchant_id' => $merchantId,'event_id' => '0'));

		  $this->load->view('front/merchant/gallery',$data);
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
             $description=nl2br($_REQUEST['description']); 

			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($title)) && (!empty($description)) && (!empty($_FILES['file']['name'])))
			 {

					$config['upload_path']          = './assets/front/uploads/gallery/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('merchant/add-gallery');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$merchantId=$this->session->userdata('WhUserLoggedinId');

							$inData=array('merchant_id' => $merchantId,'event_id' => '0','title' => $title,'description' => $description,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('gallery',$inData);
							$this->session->set_flashdata('success','Gallery Added Successfully');
							redirect('merchant/gallery/');
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('merchant/add-gallery/'); 
			 }
		  }

		  $this->load->view('front/merchant/add-gallery',$data);
		}


         public function editGallery($rowId)
		{
		  if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
		  
          
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
		  
		  $condition=array('id' => $rowId);
		  $data['getData']=$this->Admin_model->getWhere('gallery',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $title=$_REQUEST['title'];
	             $description=nl2br($_REQUEST['description']); 
                 
				 $date=date('Y-m-d H:i:s');
				 
				 if((!empty($title)) && (!empty($description)))
				 {
                     $upData=array('title' => $title,'description' => $description,'updated_on' => $date);
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
								redirect('merchant/edit-gallery/'.$rowid);
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
								redirect('merchant/gallery/');
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Gallery Updated Successfully');
					   redirect('merchant/gallery/');
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','All fields are required');
			        redirect('merchant/edit-gallery/'.$rowid); 
                 }

                 
		  }

		  $this->load->view('front/merchant/edit-gallery',$data);
		}


}
?>