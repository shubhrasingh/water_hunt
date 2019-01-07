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
		
		
		public function testSetting()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $data['getData']=$this->Admin_model->getData('test_setting');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/test-setting',$data);
		  $this->load->view('admin/common/footer',$data);
		}

		public function editTestSetting()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  if(isset($_REQUEST['update']))
		  {
			 $mark_per_question=$_REQUEST['mark_per_question']; 
			 $passing_percent=$_REQUEST['passing_percent']; 
			 $per_set_question_count=$_REQUEST['per_set_question_count']; 
			 $test_duration_minute=$_REQUEST['test_duration_minute']; 

			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($mark_per_question)) && (!empty($passing_percent)) && (!empty($per_set_question_count)) && (!empty($test_duration_minute)))
			 {
				  $upData=array('mark_per_question' => $mark_per_question,'passing_percent' => $passing_percent,'per_set_question_count' => $per_set_question_count,'test_duration_minute' => $test_duration_minute,'updated_on' => $date);
			 
				  $this->Admin_model->updateTestSetting($upData);
				 
				   $this->session->set_flashdata('success','Test Setting has been updated successfully');
				   redirect('admin/test-setting');	
			 }
			 else
			 {
				$this->session->set_flashdata('error','Marks Per Question,Passing Percentage , Number of Questions Per Set and Test Duration are required fields');
			    redirect('admin/edit-test-setting'); 
			 }
			
				

		  }
		  
		  $data['getData']=$this->Admin_model->getData('test_setting');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-test-setting',$data);
		  $this->load->view('admin/common/footer',$data);
		}	

		public function testQuestions()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $data['getData']=$this->Admin_model->getData('questions');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/test-questions',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addQuestions()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $question=$_REQUEST['question'];
             $dateTime=date('Y-m-d H:i:s');
             if(!empty($question))
             {
             	 $question=nl2br($question);
	             $inArray=array('question' => $question,'added_on' => $dateTime);
	             $questionId=$this->Admin_model->insertData('questions',$inArray);

	             $countAns=count($_REQUEST['answer']);
	             if($countAns>1)
	             {
		             for($i=0;$i<$countAns;$i++)
		             {
		               $answer=$_REQUEST['answer'][$i];
                       $rName="correct_answer".$i;

		               if((!isset($_REQUEST[$rName])) && ($_REQUEST[$rName]==""))
		               {
		               	 $correct_answer="2";
		               }
		               else
		               {
		               	$correct_answer="1";
		               }

		               $inAnsArray=array('question_id' => $questionId,'answer' => $answer,'correct_answer_status' => $correct_answer,'added_on' => $dateTime);
		               $lastAnswerId=$this->Admin_model->insertData('answer_set',$inAnsArray);
		               if($correct_answer==1)
		               {
		               	$this->Admin_model->updateData('questions',array('correct_answer_id' => $lastAnswerId),$questionId);
		               }
		             }

		             $this->session->set_flashdata('success','Question Added Successfully');
			        redirect('admin/test-questions');
	             }
	             else
	             {
	             	$this->session->set_flashdata('error','Please add atleast two answers');
			        redirect('admin/add-question');
	             }
            }
            else
            {
            	$this->session->set_flashdata('error','Question is Required');
			    redirect('admin/add-question'); 
            }
		  }

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/add-question',$data);
		  $this->load->view('admin/common/footer',$data);
		}	


		public function editQuestions($id)
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $data['getData']=$this->Admin_model->getWhere('questions',array('id' => $id));
		  $data['getAnswerData']=$this->Admin_model->getWhere('answer_set',array('question_id' => $id));

		  if(isset($_REQUEST['submit']))
		  {
             $rowid=$_REQUEST['rowid'];
             $question=$_REQUEST['question'];
             $dateTime=date('Y-m-d H:i:s');
             if(!empty($question))
             {
             	 $question=nl2br($question);
	             $inArray=array('question' => $question,'updated_on' => $dateTime);
	             $this->Admin_model->updateData('questions',$inArray,$rowid);
                 $questionId=$rowid;
	             $countAns=count($_REQUEST['answer']);
	             if($countAns>1)
	             {
		             for($i=0;$i<$countAns;$i++)
		             {
		               $answer=$_REQUEST['answer'][$i];
		               $ansrowid=$_REQUEST['ansrowid'][$i];
                       $rName="correct_answer".$i;

		               if((!isset($_REQUEST[$rName])) && ($_REQUEST[$rName]==""))
		               {
		               	 $correct_answer="2";
		               }
		               else
		               {
		               	$correct_answer="1";
		               }
                       
                       if($ansrowid==0)
                       {
                       	  $inAnsArray=array('question_id' => $questionId,'answer' => $answer,'correct_answer_status' => $correct_answer,'added_on' => $dateTime);
		                  $lastAnswerId=$this->Admin_model->insertData('answer_set',$inAnsArray);
                       }
                       else
                       {
                          if($answer!="")
                          {
                          	$this->Admin_model->updateData('answer_set',array('question_id' => $questionId,'answer' => $answer,'correct_answer_status' => $correct_answer,'updated_on' => $dateTime),$ansrowid);
                          	
                          }
                          else
                          {
                          	$this->Admin_model->deleteData('answer_set',array('id' => $ansrowid));
                          	$correct_answer="2";
                          }
                          $lastAnswerId=$ansrowid;
                       }

		               if($correct_answer==1)
		               {
		               	$this->Admin_model->updateData('questions',array('correct_answer_id' => $lastAnswerId),$questionId);
		               }
		             }

		             $this->session->set_flashdata('success','Question Updated Successfully');
			        redirect('admin/test-questions');
	             }
	             else
	             {
	             	$this->session->set_flashdata('error','Please add atleast two answers');
			        redirect('admin/edit-question/'.$questionId);
	             }
            }
            else
            {
            	$this->session->set_flashdata('error','Question is Required');
			    redirect('admin/edit-question/'.$rowid); 
            }
		  }

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-question',$data);
		  $this->load->view('admin/common/footer',$data);
		}

		public function testResults()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $data['getData']=$this->Admin_model->getData('students');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/test-results',$data);
		  $this->load->view('admin/common/footer',$data);
		}
		

		public function viewSlider()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

		  $data['getData']=$this->Admin_model->getData('sliders');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/sliders',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addSlider()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  if(isset($_REQUEST['submit']))
		  {
             $title=$_REQUEST['title'];
             $description=$_REQUEST['description']; 
			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($_FILES['file']['name'])))
			 {

					$config['upload_path']          = './assets/front/uploads/slider/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/add-slider');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$inData=array('title' => $title,'description' => $description,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('sliders',$inData);
							$this->session->set_flashdata('success','Slider Added Successfully');
							redirect('admin/sliders');
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','Slider image is required field');
			    redirect('admin/add-slider'); 
			 }
		  }

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/add-slider',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function editSlider($id)
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $condition=array('id' => $id);
		  $data['getData']=$this->Admin_model->getWhere('sliders',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $title=$_REQUEST['title'];  
                 $description=$_REQUEST['description']; 
                 
			     $date=date('Y-m-d H:i:s');
                 
                 $upData=array('title' => $title,'description' => $description,'updated_on' => $date);
				 $this->Admin_model->updateData('sliders',$upData,$rowid);
				 
				 if(!empty($_FILES['file']['name']))
				 {
					$config['upload_path']          = './assets/front/uploads/slider/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;


					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/edit-slider/'.$rowid);
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$getoldData=$this->Admin_model->getWhere('sliders',array('id' => $rowid));
                            $oldImg=$getoldData[0]->image;

							$upData=array('image' => $file_name,'updated_on' => $date);
							$this->Admin_model->updateData('sliders',$upData,$rowid);

							if($oldImg!="")
							{
								unlink('assets/front/uploads/slider/'.$oldImg);
							}

							$this->session->set_flashdata('success','Slider Updated Successfully');
							redirect('admin/sliders');
							
					}
				}
				else
				{
				   $this->session->set_flashdata('success','Slider Updated Successfully');
				   redirect('admin/sliders');
				}	
		  }
		  
		  
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/edit-slider',$data);
		  $this->load->view('admin/common/footer',$data);
		}
		

        public function viewStaff()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

		  $data['getData']=$this->Admin_model->getData('staff');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/staff',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addStaff()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
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
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
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
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

		  $data['getData']=$this->Admin_model->getData('gallery');
		  
		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/gallery',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addGallery()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
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
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
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
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

		  $data['getData']=$this->Admin_model->getData('content');

		  $this->load->view('admin/common/header',$data);
		  $this->load->view('admin/common/sidebar',$data);
		  $this->load->view('admin/content',$data);
		  $this->load->view('admin/common/footer',$data);
		}


		public function addContent()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
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
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
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