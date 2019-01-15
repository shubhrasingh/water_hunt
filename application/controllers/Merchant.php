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

				case "booking":
				
					$rowid=$_GET['rowid'];

					$del=$this->Admin_model->deleteData('ticket_request',array('id' => $rowid));
					$del=$this->Admin_model->deleteData('ticket_billing_details',array('ticket_request_id' => $rowid));

				break;

				case "enquiry":
				
					$rowid=$_GET['rowid'];

					$del=$this->Admin_model->deleteData('ticket_request',array('id' => $rowid));

				break;

				case "reviews":

                    $rowid=$_GET['rowid'];

					$del=$this->Admin_model->deleteData('customer_review',array('id' => $rowid));

				break;

				case "messageInbox":

                    $rowid=$_GET['rowid'];
                    
                    $tblMessage=$this->db->dbprefix."merchant_contact_request";
					$del=$this->db->query("UPDATE $tblMessage SET `delete_for_merchant`='2' WHERE id IN ($rowid)");

				break;

				case "messageSentItems":

                    $rowid=$_GET['rowid'];

					$tblMessage=$this->db->dbprefix."merchant_contact_request";
					$del=$this->db->query("DELETE FROM $tblMessage WHERE id IN ($rowid)");

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

				case "booking_availability":

                    switch($action)
					{
						case "ON":
						  
						  $rowid=$this->session->userdata('WhUserLoggedinId');	
					
					      $this->Admin_model->updateData('merchants',array('booking_availability' => 1),$rowid);
					
						break;
						
						case "OFF":
						   
						   $rowid=$this->session->userdata('WhUserLoggedinId');	
					
					       $this->Admin_model->updateData('merchants',array('booking_availability' => 2),$rowid);

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
		  $data['totalTickets']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblTicket WHERE `merchant_id`='$merchantId' and `status`='1'");

		  $tblRvw=$this->db->dbprefix.'customer_review';
		  $data['totalReviews']=$this->Admin_model->getQuery("SELECT COUNT(id) as cnt FROM $tblRvw WHERE `merchant_id`='$merchantId'");
          
          $data['upcomingEvents']=$this->Admin_model->getQuery("SELECT * FROM $tbl WHERE `start_date` > '$date' and `merchant_id`='$merchantId' ORDER BY `start_date` ASC LIMIT 0,10");

           $data['ongoingEvents']=$this->Admin_model->getQuery("SELECT * FROM $tbl WHERE (`start_date` <= '$date' and `end_date` >= '$date') and (`merchant_id`='$merchantId') ORDER BY `start_date`");

          $data['bookedTickets']=$this->Admin_model->getwithLimitOrderBy('ticket_request',array('merchant_id' => $merchantId,'status' => 1),10,0,'id','DESC');
		  
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
		
		public function viewTiming()
		{
            if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		    $data['siteDetails']=$this->siteDetails();
		    $data['userDetails']=$this->userDetails();
            
		    $this->load->view('front/merchant/timing',$data);
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

		public function profileCover()
		{
            if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		    $data['siteDetails']=$this->siteDetails();
		    $data['userDetails']=$this->userDetails();
            
            if(isset($_REQUEST['submit']))
		  {
			 $profile_cover_type=$_REQUEST['profile_cover_type'];
			 $video_iframe=$_REQUEST['video_iframe'];
			 $file=$_FILES['file']['name']; 

			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($profile_cover_type)) && ((!empty($video_iframe)) || (!empty($file))))
			 {
			 	switch($profile_cover_type)
			 	{
			 		case "1":
                       
                        $config['upload_path']          = './assets/front/uploads/merchant-cover/';
						$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
						$config['encrypt_name']         = TRUE;
						$config['min_width']            = '1000';
						$config['min_height']           = '300';


						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('file'))
						{
								$error = $this->upload->display_errors();
								$this->session->set_flashdata('error',$error);
								redirect('merchant/profile-cover');
						}
						else
						{
								$data = $this->upload->data();
								$file_name=$data['file_name'];
								
								$merchantId=$this->session->userdata('WhUserLoggedinId');

								$getOldLogo=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
								$CoverTypeOld=$getOldLogo[0]->profile_cover_type;
								$oldImg=$getOldLogo[0]->profile_cover;

								$upData=array('profile_cover' => $file_name,'profile_cover_type' => $profile_cover_type,'updated_on' => $date);
								$this->Admin_model->updateData('merchants',$upData,$merchantId);

								if(($CoverTypeOld==1) && ($oldImg!=""))
								{
									unlink('assets/front/uploads/merchant-cover/'.$oldImg);
								}

								$this->session->set_flashdata('success','Profile Cover Updated Successfully');
								redirect('merchant/profile-cover');
								
						}

			 		break;

			 		case "2":

			 		          $merchantId=$this->session->userdata('WhUserLoggedinId');
                              $upData=array('profile_cover' => $video_iframe,'profile_cover_type' => $profile_cover_type,'updated_on' => $date);
							  $this->Admin_model->updateData('merchants',$upData,$merchantId);
							  $this->session->set_flashdata('success','Profile Cover Updated Successfully');
							  redirect('merchant/profile-cover');
			 		break;
			 	}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('merchant/profile-cover'); 
			 }
		  }

		    $this->load->view('front/merchant/profile-cover',$data);
		}

		public function mapLocation()
		{
            if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		    $data['siteDetails']=$this->siteDetails();
		    $data['userDetails']=$this->userDetails();
            
            if(isset($_REQUEST['submit']))
			  {
				 $map_iframe=$_REQUEST['map_iframe'];

				 $date=date('Y-m-d H:i:s');
				 
				 if(!empty($map_iframe))
				 {
				 	$merchantId=$this->session->userdata('WhUserLoggedinId');
	                $upData=array('map_iframe' => $map_iframe,'updated_on' => $date);
					$this->Admin_model->updateData('merchants',$upData,$merchantId);
					$this->session->set_flashdata('success','Map Location Updated Successfully');
					redirect('merchant/map-location');	
				 }
				 else
				 {
					$this->session->set_flashdata('error','Map Iframe is required');
				    redirect('merchant/map-location'); 
				 }
			  }

		    $this->load->view('front/merchant/map-location',$data);
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
            $cancelled_by='merchant';
            
            $getTicket=$this->Admin_model->getWhere('ticket_request',array('id' => $booking_id));
            $userId=$getTicket[0]->user_id;
            $merchantId=$getTicket[0]->merchant_id;
            $eventId=$getTicket[0]->event_id;
            $visit_date=$getTicket[0]->visit_date;
            $visitDate=date('M j,Y',strtotime($visit_date));

            $getUser=$this->Admin_model->getWhere('users',array('id' => $userId));
            $userName=$getUser[0]->name;
            $toUserEmail=$getUser[0]->email;

            $getMerchant=$this->userDetails();
            $waterParkName=$getMerchant[0]->waterpark_name;
            $merchantName=$getMerchant[0]->name;
            $toMerchantEmail=$getMerchant[0]->email;

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
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Your ticket which was booked for '.$bookedFor.' , to be visited on '.$visitDate.' , has been cancelled by the merchant.</td> 
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
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">The ticket which was booked for '.$bookedFor.' , to be visited on '.$visitDate.' , has been cancelled successfully.Here are the customer details : </td> 
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
            redirect('merchant/bookings');
          }

          $merchantId=$this->session->userdata('WhUserLoggedinId');
		  $data['getBooking']=$this->Admin_model->getWhere('ticket_request',array('merchant_id' => $merchantId,'request_type' => 'booking','payment_status' => 1));
		  
		  $this->load->view('front/merchant/booking',$data);
		}


		public function myEnquiries()
		{
		   if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['userDetails']=$this->userDetails();
          
          $merchantId=$this->session->userdata('WhUserLoggedinId');
		  $data['getEnquiry']=$this->Admin_model->getWhere('ticket_request',array('merchant_id' => $merchantId,'request_type' => 'enquiry'));
		  
		  $this->load->view('front/merchant/enquiry',$data);
		}
        
        public function myReviews()
        {
            if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		   $data['siteDetails']=$this->siteDetails();
		   $data['userDetails']=$this->userDetails();
          
           $merchantId=$this->session->userdata('WhUserLoggedinId');
		   $data['getProfileReview']=$this->Admin_model->getWhere('customer_review',array('merchant_id' => $merchantId,'event_id' => '0'));

		   $tblReview=$this->db->dbprefix.'customer_review';
		   $data['getEventReview']=$this->Admin_model->getQuery("SELECT * FROM $tblReview WHERE merchant_id='$merchantId' and `event_id`!='0'");
		  
		   $this->load->view('front/merchant/reviews',$data);
        }


        public function myMessages($page=0)
        {
        	if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		   $data['siteDetails']=$this->siteDetails();
		   $data['userDetails']=$this->userDetails();
           
           $merchantId=$this->session->userdata('WhUserLoggedinId');
           
            $data['fetchLimit']=10;
			if($page==0)
	        {
	          $limit=0;
	        }
	        else
	        {
	          $limit=($page - 1) * $data['fetchLimit'];
	        }
            

	        $fetchLimit=$data['fetchLimit'];
	        
	       

	       $tblMessage=$this->db->dbprefix.'merchant_contact_request';
	       $inboxCnt=$this->Admin_model->getQuery("SELECT * FROM $tblMessage WHERE merchant_id='$merchantId' and `sender_type`!='merchant' and `delete_for_merchant`='1'");
	       $data['inboxCount']=count($inboxCnt);

          
		   $data['getInbox']=$this->Admin_model->getQuery("SELECT * FROM $tblMessage WHERE merchant_id='$merchantId' and `sender_type`!='merchant' and `delete_for_merchant`='1' ORDER BY added_on DESC LIMIT $limit,$fetchLimit");

		   $data['getSentItems']=$this->Admin_model->getDataCount('merchant_contact_request',array('merchant_id' => $merchantId,'sender_type' => 'merchant'));
		   
		   $data['unseenCount']=$this->Admin_model->getQuery("SELECT * FROM $tblMessage WHERE merchant_id='$merchantId' and `sender_type`!='merchant' and `seen_status`='2'");
	       $data['inboxCount']=count($inboxCnt);
           
            $data['fromData']=$limit + 1;
	        $data['toData']=$limit + $fetchLimit;
            
            if($data['toData']>$data['inboxCount'])
            {
            	$data['toData']=$data['inboxCount'];
            }
		   $this->load->library('pagination');

		   $config['base_url'] = base_url().'merchant/messages';
		   $config['total_rows'] = $data['inboxCount'];
		   $config['per_page'] = $data['fetchLimit'];
	       $config['use_page_numbers'] = TRUE;

			$this->pagination->initialize($config);
		   $this->load->view('front/merchant/messages',$data);
        }

        
        public function mySentitems($page=0)
        {
        	if($this->session->userdata('WhUserLoggedinId')=='')
			{
			  redirect('login');
			}
			
		   $data['siteDetails']=$this->siteDetails();
		   $data['userDetails']=$this->userDetails();
           
           $merchantId=$this->session->userdata('WhUserLoggedinId');
           
            $data['fetchLimit']=2;
			if($page==0)
	        {
	          $limit=0;
	        }
	        else
	        {
	          $limit=($page - 1) * $data['fetchLimit'];
	        }
            

	       $fetchLimit=$data['fetchLimit'];

	       $tblMessage=$this->db->dbprefix.'merchant_contact_request';
	       $sentItemsCnt=$this->Admin_model->getDataCount('merchant_contact_request',array('merchant_id' => $merchantId,'sender_type' => 'merchant'));
	       $data['sentItemsCount']=$sentItemsCnt;

          
		   $data['getSentItems']=$this->Admin_model->getwithLimitOrderBy('merchant_contact_request',array('merchant_id' => $merchantId,'sender_type' => 'merchant'),$data['fetchLimit'],$limit,'added_on','DESC');

		   $data['unseenCount']=$this->Admin_model->getQuery("SELECT * FROM $tblMessage WHERE merchant_id='$merchantId' and `sender_type`!='merchant' and `seen_status`='2'");
           
            $data['fromData']=$limit + 1;
	        $data['toData']=$limit + $fetchLimit;
            
            if($data['toData']>$data['sentItemsCount'])
            {
            	$data['toData']=$data['sentItemsCount'];
            }
		   $this->load->library('pagination');

		   $config['base_url'] = base_url().'merchant/messages/sent-items';
		   $config['total_rows'] = $data['sentItemsCount'];
		   $config['per_page'] = $data['fetchLimit'];
	       $config['use_page_numbers'] = TRUE;

			$this->pagination->initialize($config);
		   $this->load->view('front/merchant/sent-items',$data);
        }


        public function composeMessage()
        {
        	  if(isset($_REQUEST['compose_message']))
	           {
	           	  $message=nl2br($_REQUEST['message']);
	           	  if(!empty($message))
	           	  {
	           	  	 $data['siteDetails']=$this->siteDetails();
	           	  	 $merchantId=$this->session->userdata('WhUserLoggedinId');
	           	  	 $adminId=$data['siteDetails']['companyData'][0]->id;
	                 $date=date('Y-m-d H:i:s');
	                 $this->Admin_model->insertData('merchant_contact_request',array('merchant_id' => $merchantId,'admin_id' => $adminId,'message' => $message,'sender_type' => 'merchant','added_on' => $date));

	                 $this->session->set_flashdata('success','Message sent Successfully');
	           	  	 redirect('merchant/messages/sent-items');
	           	  }
	           	  else
	           	  {
	           	  	$this->session->set_flashdata('error','Message is required field');
	           	  	redirect('merchant/messages/sent-items');
	           	  }
	              
	           }
        }


		public function viewBookingDetailAjax()
		{
			$rowId=$_REQUEST['rowid'];

			$data['getTicket']=$this->Admin_model->getWhere('ticket_request',array('id' => $rowId));
			$data['getBillingDetail']=$this->Admin_model->getWhere('ticket_billing_details',array('ticket_request_id' => $rowId));
            
            $data['mode']="bookingDetail";

			$this->load->view('front/merchant/ajax-page',$data);
		}

		public function readMessageAjax()
		{
			$rowId=$_REQUEST['rowid'];
			$mode=$_REQUEST['mode'];

			if($mode=='readMessage')
			{
			  $this->Admin_model->updateData('merchant_contact_request',array('seen_status' => '1'),$rowId);
			}
            
            
			$data['getMessage']=$this->Admin_model->getWhere('merchant_contact_request',array('id' => $rowId));
			
            $data['mode']="readMessage";

			$this->load->view('front/merchant/ajax-page',$data);
		}

		public function markAsRead()
		{
			$rowid=$_GET['rowid'];
                    
            $tblMessage=$this->db->dbprefix."merchant_contact_request";
			$del=$this->db->query("UPDATE $tblMessage SET `seen_status`='1' WHERE id IN ($rowid)");
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