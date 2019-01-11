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
		  
		 
		  
		  $this->load->view('admin/dashboard',$data);
		  
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
		  
		 
		  $this->load->view('admin/profile',$data);
		  
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
			 // $google_link=$_REQUEST['google_link']; 
			 $linkedin_link=$_REQUEST['linkedin_link']; 
			 $company_address=nl2br($_REQUEST['company_address']); 
			 //s$company_about=nl2br($_REQUEST['company_about']); 

			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($company_name)) && (!empty($company_email)) && (!empty($company_number)) )
			 {
				  $upData=array('company_name' => $company_name,'company_email' => $company_email,'company_phone' => $company_number,'company_address' => $company_address,'facebook_link' => $facebook_link,'twitter_link' => $twitter_link,'linkedin_link' => $linkedin_link,'updated_on' => $date);
			 
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
		  
		  $this->load->view('admin/edit-company-profile',$data);
		  
		}
		
		
		public function changePassword()
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
		  $this->load->view('admin/change-password',$data);
		}
  

  /*##############  ADmin Merchant #################*/

  public  function merchant()   
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


		  if(isset($_REQUEST['submit']))
		  {
		  	      $user_type='merchant';


		  	      $name=$_REQUEST['name'];
		  	      $waterpark_name=$_REQUEST['waterpark_name'];
		  	      $mobile=$_REQUEST['mobile_number'];
		  	      $a_mobile=$_REQUEST['alternate_mobile_number'];
		  	      $email=$_REQUEST['email'];
		  	      $password=$_REQUEST['password'];
		  	      $waterpark_address=$_REQUEST['waterpark_address'];
		  	      $waterpark_city=$_REQUEST['waterpark_city'];
				  $waterpark_state=$_REQUEST['waterpark_state'];
				  $description=$_REQUEST['description'];
				  // $start_time=$_REQUEST['start_time'];
				  // $end_time=$_REQUEST['end_time'];
				  $entry_fee=$_REQUEST['entry_fee'];
				 
                  $addedOn=date('Y-m-d H:i:s');
                  $added_by=$uid;
                   $filename=''; 
		           
          	   	 if(!empty($_FILES['file']['name']))
				 {

				 	
					$config['upload_path']          = './assets/front/uploads/merchant-logo/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;

                     
					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/merchant');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							$filename=$file_name;
					}
				}

                   $tbl="merchants";
          	   	   $dataArray=array('name' => $name,'waterpark_name' => $waterpark_name,'mobile_number' => $mobile,'alternate_mobile_number'=>$a_mobile,'email' => $email,'password' => $password,'waterpark_address'=>$waterpark_address,'waterpark_city'=>$waterpark_city,'waterpark_state'=>$waterpark_state,'description'=>$description,'entry_fee_per_person'=>$entry_fee,'waterpark_logo'=>$filename,'added_on' => $addedOn,'added_by' => $added_by,'status' => '2');

          	   	      $where=array('email' => $email);
					   $queryCount=$this->Admin_model->getWhere($tbl,$where);
					   $countData=count($queryCount);

						  if($countData!=0)
						  {
							$this->session->set_flashdata('error','Email id already registered');
							redirect(base_url('admin/merchant')); 
						  }
						  else
						  {

						  	  $lastId=$this->Admin_model->insertData($tbl,$dataArray);
                              $date=date('Y-m-d H:i:s');
                              $encodedprefixDate=base64_encode(base64_encode(base64_encode(base64_encode($date))));
                              $encodedsubfixDate=base64_encode(base64_encode(base64_encode($date)));
                              $encodedUrl=$encodedprefixDate.'='.$lastId.'='.$encodedsubfixDate;

                                  $data['siteDetails']=$this->siteDetails();
		                         
							   $html='<center>  
										  <table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
										   
										   <tbody><tr> 
										<td style="padding:5px;background:#00a1ff;font-weight:bold;font-size:26px" align="center"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails'][0]->company_logo.'" style="width: 80px;"></a></font></td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello <span class="il">'.$name.'</span> </td> 
										   </tr> 
										   <tr align="center"> 
										<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Thank you for registering with us. login to your account list your water park and start posting your events too.You can use the details below to login to your account. </td> 
									    </tr> 
									    <tr align="center"> 
										<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$email.'</td> 
										    </tr> 
										     <tr align="center"> 
										 	<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Password : </b> '.$password.'</td> 
										    </tr> 
										   <tr> 
										<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'login/" target="_blank" data-saferedirecturl="'.base_url().'login/">Login </a></td> 
										    </tr> 
										   
										  </tbody></table> 
										 </center>';
                                       
                                        $fromName=$data['siteDetails'][0]->company_name;
                                        $subject="Verify your merchant account on ".$fromName;
                                        $from="no-reply@compaddicts.org";
										$this->mailHtml($email,$subject,$html,$fromName,$from);
										
										$this->session->set_flashdata('success','Registered Successfully');
							            redirect('admin/allmerchant');
						  }
		  }
		  $this->load->view('admin/merchant',$data); 
  }

  public function allmerchant()
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

         $data['merchants']=$this->Admin_model->getData('merchants'); 
         
		  $this->load->view('admin/all-merchant',$data);
  }



public function edit_merchant($id)
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

		  $condition2=array('id' => $id);
		  $data['merchant']=$this->Admin_model->getWhere('merchants',$condition2);
		 
		  if(isset($_REQUEST['submit']))
		  {
			      $user_type='merchant';

		  	      $id=$_REQUEST['id'];

		  	      $name=$_REQUEST['name'];
		  	      $waterpark_name=$_REQUEST['waterpark_name'];
		  	      $mobile=$_REQUEST['mobile_number'];
		  	      $a_mobile=$_REQUEST['alternate_mobile_number'];
		  	      $email=$_REQUEST['email'];
		  	      $password=$_REQUEST['password'];
		  	      $waterpark_address=$_REQUEST['waterpark_address'];
		  	      $waterpark_city=$_REQUEST['waterpark_city'];
				  $waterpark_state=$_REQUEST['waterpark_state'];
				  $description=$_REQUEST['description'];  
				  // $start_time=$_REQUEST['start_time'];
				  // $end_time=$_REQUEST['end_time'];
				  $entry_fee=$_REQUEST['entry_fee'];
                  

                  $addedOn=date('Y-m-d H:i:s');
                  $added_by=$uid;

                  

			
			 
			 if((!empty($name)) && (!empty($waterpark_name)) && (!empty($mobile)) && (!empty($email)) && (!empty($password)) &&  (!empty($entry_fee))   )
			 {
				 
				if(!empty($_FILES['file']['name']))
				 {
					$config['upload_path']          = './assets/front/uploads/merchant-logo/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG|GIF';
					$config['encrypt_name']         = TRUE;

                     $filename='';
					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload('file'))
					{
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('error',$error);
							redirect('admin/allmerchant');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							$filename=$file_name;
					}

					 $upData=array('name' => $name,'waterpark_name' => $waterpark_name,'mobile_number' => $mobile,'alternate_mobile_number'=>$a_mobile,'email' => $email,'password' => $password,'waterpark_address'=>$waterpark_address,'waterpark_city'=>$waterpark_city,'waterpark_state'=>$waterpark_state,'description'=>$description,'entry_fee_per_person'=>$entry_fee,'waterpark_logo'=>$filename,'added_on' => $addedOn,'added_by' => $added_by,'status' => '2');
				}
				else
				{
					 $upData=array('name' => $name,'waterpark_name' => $waterpark_name,'mobile_number' => $mobile,'alternate_mobile_number'=>$a_mobile,'email' => $email,'password' => $password,'waterpark_address'=>$waterpark_address,'waterpark_city'=>$waterpark_city,'waterpark_state'=>$waterpark_state,'description'=>$description,'entry_fee_per_person'=>$entry_fee,'added_on' => $addedOn,'added_by' => $added_by,'status' => '2');
				}  
				  $tbl="merchants";
				  $this->Admin_model->updateData($tbl,$upData,$id); 
                 $this->session->set_flashdata('success','Updates Successfully ..');
			     redirect('admin/allmerchant');
			 }
			 else
			 {
				$this->session->set_flashdata('error',' Name,Water park Name,mobile, Email, Password and Entry Fee  are required fields');
			    redirect('admin/allmerchant'); 
			 }
			
				

		  }
		 
		  $this->load->view('admin/edit-merchant',$data);
		}


public function delete_merchant($id)
{
                 $tbl="merchants";
                    $getData=$this->Admin_model->getWhere($tbl,array('id' => $id));

					$file_name=$getData[0]->waterpark_logo; 

					$del=$this->Admin_model->deleteData($tbl,array('id' => $id));

					if($file_name!="")
					{
						unlink('assets/front/uploads/merchant-logo/'.$file_name);
					}

				  $this->session->set_flashdata('success','Delete Merchant Successfully ..');
				   redirect('admin/allmerchant');
}


/*##############  Start od delete record ################*/
public function deleteRecord() 
{
        $id=$_REQUEST['id']; 
        $tbl=$_REQUEST['table']; 

        $getData=$this->Admin_model->getWhere($tbl,array('id' => $id));
		
		if ($tbl=='gallery') {
			$file_name=$getData[0]->image;
			if($file_name!="" or $file_name!=null)
			{
				unlink('assets/front/uploads/gallery/'.$file_name);
				unlink('assets/front/uploads/events/'.$file_name);

			} 
		}
        
		$del=$this->Admin_model->deleteData($tbl,array('id' => $id));
        if ($del) {
        	echo '200';  
        }
        else
        {
        	echo '500'; 
        }
	   //$this->session->set_flashdata('success','Delete Gallery Successfully ..');
	   //redirect('admin/allmerchant');
}

/*###############  END Of delete Record ###################*/


 public function mailHtml($to,$subject,$template,$fromName,$from)
		{
		
	                $headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= "From: $fromName"." <".$from.">";
                    
                    mail($to,$subject,$template,$headers);
            
		}

public function statusTogg()
{
     $id=$_REQUEST['id']; 

     $tbl=$_REQUEST['table']; 

     $getData=$this->Admin_model->getWhere($tbl,array('id' => $id));

	$status=$getData[0]->status; 

	if($status=='0')
	{
		   $upData=array('status' => 1);
           $res=$this->Admin_model->updateData($tbl,$upData,$id);
           
           echo 'Active'; 
		  
				  
	}
	else if($status=='2')
	{
        $upData=array('status' => 1);
           $res=$this->Admin_model->updateData($tbl,$upData,$id);
           
           echo 'Active'; 
	}
	else
	{
           $upData=array('status' => 0);
           $res=$this->Admin_model->updateData($tbl,$upData,$id);
           
           echo 'Deactive'; 
	}



}
	



      public function addevent()
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
		  $data['merchants']=$this->Admin_model->getData('merchants');

		  if(isset($_REQUEST['submit']))
		  {  
		  	 
             $merchantId=$_REQUEST['merchantid']; 
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
							redirect('admin/addevent');
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];

							$inData=array('merchant_id' => $merchantId,'name' => $title,'description' => $description,'start_date' => $start_date , 'end_date' => $end_date ,'time' => $time,'entry_fee_per_person' => $entry_fee_per_person ,'image' => $file_name,'added_on' => $date,'status' => '1');
							$this->Admin_model->insertData('merchants_events',$inData);
							$this->session->set_flashdata('success','Event Added Successfully');
							redirect('admin/allevent'); 
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('merchant/addevent'); 
			 }
		  }

		  $this->load->view('admin/add-event',$data); 
	}

public function allevent()
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

         $data['events']=$this->Admin_model->getData('merchants_events'); 
		  $this->load->view('admin/all-events',$data);
}
public function editevent($id)
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

          $data['merchants']=$this->Admin_model->getData('merchants');
		  $condition2=array('id' => $id);
		  $data['merchants_events']=$this->Admin_model->getWhere('merchants_events',$condition2);
           
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
								redirect('admin/editevent/'.$rowid);
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
								redirect('admin/allevent');
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Event Updated Successfully');
					   redirect('admin/allevent');
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','Name,Designation and Description are required fields');
			        redirect('admin/editevent/'.$rowid); 
                 }

                 
		  }

		  $this->load->view('admin/edit-event',$data);
		}


/*========  Get Time Schedule of ==========*/

public function getTimeSchedule()
{
	$data['merchantid']=$_REQUEST['mId']; 
    $data['mode']='timeschedule'; 

    $condition2=array('id' => $data['merchantid']);
    $merchant=$this->Admin_model->getWhere('merchants',$condition2);
    $data['waterparkname']=$merchant[0]->waterpark_name;

    $condition=array('merchant_id' => $data['merchantid']);
	$data['Timingschedule']=$this->Admin_model->getWhere('merchant_timing',$condition);
	 
	$this->load->view('admin/ajax',$data); 
}

public function editTiming($id)
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
          
           $condition3=array('merchant_id' => $id);
	       $data['Timingschedule']=$this->Admin_model->getWhere('merchant_timing',$condition3);

          $condition2=array('id' => $id);
          $data['merchant']=$this->Admin_model->getWhere('merchants',$condition2);

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
                    
                    $merchantId=$id;

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
				redirect('admin/allmerchant');	
			 }
			 else
			 {
			 	$this->session->set_flashdata('error','Something went wrong');
				redirect('admin/edit-timing/'.$id); 	
			 }
			 
		  }
         
	 $this->load->view('admin/edit-timing',$data); 
}


/*###################  Start  Gallery ########################*/
 public function addgallery($id) 
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

          $condition2=array('merchant_id' => $id,'event_id'=>'0'); 
          $data['Gallery']=$this->Admin_model->getWhere('gallery',$condition2);

          $condition3=array('id' => $id); 
          $data['merchants']=$this->Admin_model->getWhere('merchants',$condition3);

          if(isset($_REQUEST['submit']))
		  {
             $title=$_REQUEST['title'];
             $id=$_REQUEST['id'];

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
							redirect('admin/add-gallery/'.$id);
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$merchantId=$id; 

							$inData=array('merchant_id' => $merchantId,'event_id' => '0','title' => $title,'description' => $description,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('gallery',$inData);
							$this->session->set_flashdata('success','Gallery Added Successfully');
							redirect('admin/add-gallery/'.$id);
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('admin/add-gallery/'.$id); 
			 }
		  }

           
      $this->load->view('admin/add-gallery',$data);
 }
 
 public function editgallery($rowid,$id)
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

          $condition2=array('merchant_id' => $id,'event_id'=>'0'); 
          $data['Gallery']=$this->Admin_model->getWhere('gallery',$condition2);

          $condition3=array('id' => $id); 
          $data['merchants']=$this->Admin_model->getWhere('merchants',$condition3);

          $condition4=array('merchant_id' => $id); 
          $data['singlegallery']=$this->Admin_model->getWhere('gallery',$condition4);


           if(isset($_REQUEST['update']))
		  {
			     // $rowid=$_REQUEST['rowid'];  
			     $id=$_REQUEST['id'];  
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
								redirect('admin/edit-gallery/'.$rowid.'/'.$id);
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
								redirect('admin/add-gallery/'.$id);
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Gallery Updated Successfully');
					   redirect('admin/add-gallery/'.$id);
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','All fields are required');
			        redirect('admin/edit-gallery/'.$rowid.'/'.$id); 
                 }

                 
		  }


   $this->load->view('admin/edit-gallery',$data); 
 }

/*###################  END Merchants Gallery ########################*/


/*#################  Start   Event Gallery ####################*/

  public  function eventgallery($evetid)
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
          $data['eventid']=$evetid; 

          $condition3=array('id' => $evetid); 
          $data['event']=$this->Admin_model->getWhere('merchants_events',$condition3);
        
         $condition2=array('merchant_id' => $data['event'][0]->merchant_id,'event_id'=>$evetid); 
          $data['Gallery']=$this->Admin_model->getWhere('gallery',$condition2);
         
          $condition4=array('id' => $data['event'][0]->merchant_id); 
          $data['merchants']=$this->Admin_model->getWhere('merchants',$condition4);

          if(isset($_REQUEST['submit']))
		  {
             $eventId=$_REQUEST['eventid'];
             $merchantId=$_REQUEST['id'];
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
							redirect('admin/event-gallery/'.$eventId);
					}
					else
					{
							$data = $this->upload->data();
							$file_name=$data['file_name'];
							
							$merchantId=$this->session->userdata('WhUserLoggedinId');

							$inData=array('merchant_id' => $merchantId,'event_id' => $eventId,'title' => $title,'description' => $description,'image' => $file_name,'added_on' => $date);
							$this->Admin_model->insertData('gallery',$inData);
							$this->session->set_flashdata('success','Event Gallery Added Successfully');
							redirect('admin/event-gallery/'.$eventId);
							
					}	
			 }
			 else
			 {
				$this->session->set_flashdata('error','All fields are required');
			    redirect('admin/event-gallery/'.$eventId); 
			 }
		  }

      $this->load->view('admin/event-gallery',$data);
  }
/*----------  Edit Event gallery ---------*/


public  function editeventgallery($eventid,$rowid,$id)
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
          $data['eventid']=$eventid; 

          $condition2=array('merchant_id' => $id,'event_id'=>$eventid); 
          $data['Gallery']=$this->Admin_model->getWhere('gallery',$condition2);

          $condition3=array('id' => $id); 
          $data['merchants']=$this->Admin_model->getWhere('merchants',$condition3);

          $condition4=array('id' => $rowid); 
          $data['singlegallery']=$this->Admin_model->getWhere('gallery',$condition4);

           if(isset($_REQUEST['update']))
		  {
			     $eventid=$_REQUEST['eventid'];  
			     $merchantid=$_REQUEST['id'];  
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
								redirect('admin/edit-event-gallery/'.$eventid.'/'.$rowid.'/'.$merchantid);
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
								redirect('admin/event-gallery/'.$eventid);
								
						}
					}
					else
					{
					   $this->session->set_flashdata('success','Event Gallery Updated Successfully');
					   redirect('admin/event-gallery/'.$eventid);
					}	
                 }
                 else
                 {
                 	$this->session->set_flashdata('error','All fields are required');
			        redirect('admin/edit-event-gallery/'.$eventid.'/'.$rowid.'/'.$merchantid); 
                 }
		  }

        $this->load->view('admin/edit-event-gallery',$data);


}

/*#################  Start   Event Gallery ####################*/

/*#################  Start All Users Listing ###################*/
public function allusers()
{
	if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login'); 
			}
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

        $data['getAllUsers']=$this->Admin_model->getData('users');

	$this->load->view('admin/allusers',$data);
}

/*#################  End  All Users Listing ###################*/


/*#################  Start  All Booking Ticket Listing ###################*/

public  function bookticket()
{
    if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login'); 
			}
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

        $condition=array('request_type' =>'enquiry');
        $data['getEnquiry_Ticketbooking']=$this->Admin_model->getWhere('ticket_request',$condition);

        $condition2=array('request_type' =>'booking');
        $data['getBooking_Ticketbooking']=$this->Admin_model->getWhere('ticket_request',$condition2);
        
	$this->load->view('admin/book-ticket',$data);
}


/*#################  End  All Booking Ticket Listing  ###################*/

/*========  Get   Booking Details ==========*/

public function getbookingDetails()
{
	$data['bookingid']=$_REQUEST['Bid']; 
    $data['mode']='bookingdetails'; 

    $condition2=array('id' => $data['bookingid']);
    $data['getBooikng']=$this->Admin_model->getWhere('ticket_request',$condition2);
   
    $condition=array('id' => $data['getBooikng'][0]->merchant_id);
    $data['merchants']=$this->Admin_model->getWhere('merchants',$condition);
    
    //$data['waterparkname']=$merchant[0]->waterpark_name;

   
	 
	$this->load->view('admin/ajax',$data); 
}






} ?>