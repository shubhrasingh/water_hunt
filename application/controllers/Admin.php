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

		
		
		public function statusToggle()
		{
			$mode=$_GET['mode'];
			$action=$_GET['action'];

			switch($mode)
			{
				case "testimonial":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('testimonial',array('status' => 1),$rowid);
					      
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('testimonial',array('status' => 2),$rowid);
					       
						break;
					}
					
				break;


				case "slider":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('sliders',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('sliders',array('status' => 2),$rowid);

						break;
					}
					
				break;

				case "subadmin":
				    
					switch($action)
					{
						case "activate":
						  
						  $rowid=$_GET['rowid'];	
					
					      $this->Admin_model->updateData('master_admin',array('status' => 1),$rowid);
					
						break;
						
						case "deactivate":
						   
						   $rowid=$_GET['rowid'];	
					
					       $this->Admin_model->updateData('master_admin',array('status' => 2),$rowid);

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
			$this->load->view('admin/ajax-status',$data);
		}

		public function index()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		 $condition=array('status' =>'1');
		  $allmerchant=$this->Admin_model->getWhere('merchants',$condition);
		  $data['allmerchants']=count($allmerchant); 

          $condition=array('status' =>'1');
		  $allevent=$this->Admin_model->getWhere('merchants_events',$condition);
		  $data['allevents']=count($allevent);

		  $condition=array('request_type' =>'booking');
		  $bookingticket=$this->Admin_model->getWhere('ticket_request',$condition);
		  $data['allbooikngticket']=count($bookingticket);

		  $condition=array('request_type' =>'enquiry');
		  $enquirybooking=$this->Admin_model->getWhere('ticket_request',$condition);
		  $data['allenquirybooking']=count($enquirybooking);

		  $condition=array('status' =>'1');
		  $users=$this->Admin_model->getWhere('users',$condition);
		  $data['allusers']=count($users); 
           
          $cy=date('Y'); 
          $cm=date('m'); 
          $cd=date('d');
		  $tblbilling=$this->db->dbprefix.'ticket_billing_details';
          $data['thismonthsCommission']=$this->Admin_model->getQuery("SELECT SUM(commission_amount)  as cmt from $tblbilling WHERE month(added_on)='$cm' and year(added_on)='$cy'");
         
          $data['TodayCommission']=$this->Admin_model->getQuery("SELECT SUM(commission_amount)  as cmt from $tblbilling WHERE DATE(added_on)=CURDATE() ");

          $data['yearCommission']=$this->Admin_model->getQuery("SELECT SUM(commission_amount)  as cmt from $tblbilling WHERE year(added_on)='$cy' ");

           $data['merchants']=$this->Admin_model->getwithLimitOrderBy('merchants',array('status' => '1'),'5','0','id','DESC');
           $data['bookingticket']=$this->Admin_model->getwithLimitOrderBy('ticket_request',array('request_type' => 'booking'),'5','0','id','DESC');

           $data['bookingrequest']=$this->Admin_model->getwithLimitOrderBy('ticket_request',array('request_type' => 'enquiry'),'7','0','id','DESC');

           $data['users']=$this->Admin_model->getwithLimitOrderBy('users',array('status' => '1'),'5','0','id','DESC');

		  
		  $this->load->view('admin/dashboard',$data);
		  
		}
		
		
		public function subadmin()
		 {
		 	if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			$data['siteDetails']=$this->siteDetails();
		    $data['adminDetails']=$this->adminDetails();
           
           $condition=array('role' =>'2');
		   $data['subadmins']=$this->Admin_model->getWhere('master_admin',$condition);

         if(isset($_REQUEST['submit']))
		  {
		  	      $role='2';
		  	      $name=$_REQUEST['name'];
		  	      $email=$_REQUEST['email'];
		  	      $password=$_REQUEST['password'];

                  $addedOn=date('Y-m-d H:i:s');
                 
                if($name!="" && $email!='' && $password!='')
                {
                   
                    $tbl="master_admin";
          	   	    $dataArray=array('name' => $name,'email' => $email,'password' => $password,'added_on' => $addedOn,'role'=>$role,'status' => '1');

          	   	       $where=array('email' => $email);
					   $queryCount=$this->Admin_model->getWhere($tbl,$where);
					   $countData=count($queryCount);

						  if($countData!=0)
						  {
							$this->session->set_flashdata('error','Email id already registered');
							redirect(base_url('admin/subadmin')); 
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
										<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Thank you for registering with us. login to your account , list your water park and start posting your events too.You can use the details below to login to your account. </td> 
									    </tr> 
									    <tr align="center"> 
										<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$email.'</td> 
										    </tr> 
										     <tr align="center"> 
										 	<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Password : </b> '.$password.'</td> 
										    </tr> 
										   <tr> 
										<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'admin/login" target="_blank" data-saferedirecturl="'.base_url().'admin/login">Login </a></td> 
										    </tr> 
										   
										  </tbody></table> 
										 </center>';
                                      
                                        $fromName=$data['siteDetails'][0]->company_name;
                                        $subject="Registered successfully on ".$fromName;
                                        $from="no-reply@compaddicts.org";
										$this->mailHtml($email,$subject,$html,$fromName,$from);
										
										$this->session->set_flashdata('success','New SubAdmin Registered Successfully..');
							            redirect('admin/subadmin'); 
						  }
                }
                else
                {
                   $this->session->set_flashdata('error','All * Fields Are Required..');
				   redirect(base_url('admin/subadmin')); 
                }
		  }


           $this->load->view('admin/subadmin',$data);
		 }

		 /*#####   EDIT Subadmin #######*/
		 public function  updatesubadmin($id)
		 {
		 	if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			$data['siteDetails']=$this->siteDetails();
		    $data['adminDetails']=$this->adminDetails();
           
           $condition=array('role' =>'2');
		   $data['subadmins']=$this->Admin_model->getWhere('master_admin',$condition);

		   $condition2=array('role' =>'2','id'=>$id);
		   $data['singlesubadmin']=$this->Admin_model->getWhere('master_admin',$condition2);
          
         if(isset($_REQUEST['update']))
		  {
            $role='2';
		  	$id=$_REQUEST['id']; 
		  	$name=$_REQUEST['name']; 
		  	$email=$_REQUEST['email']; 
		  	$password=$_REQUEST['password']; 

             if($name!="" && $email!='' && $password!='')
                {  
                    $tbl="master_admin";
          	   	    $dataArray=array('name' => $name,'email' => $email,'password' => $password,'added_on' => $addedOn,'role'=>$role,'status' => '1');

          	   	       $where=array('email' => $email);
					   $queryCount=$this->Admin_model->getWhere($tbl,$where);
					   $countData=count($queryCount);

						  if($countData!=0)
						  {
							$this->session->set_flashdata('error','Email id already registered');
							redirect(base_url('admin/edit-subadmin/'.$id)); 
						  }
						  else
						  {
						  	  //$lastId=$this->Admin_model->insertData($tbl,$dataArray);

						  	   $this->Admin_model->updateData($tbl,$dataArray,$id); 
                              
                               $lastId=$id; 
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
										<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Thank you for registering with us. login to your account , list your water park and start posting your events too.You can use the details below to login to your account. </td> 
									    </tr> 
									    <tr align="center"> 
										<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$email.'</td> 
										    </tr> 
										     <tr align="center"> 
										 	<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Password : </b> '.$password.'</td> 
										    </tr> 
										   <tr> 
										<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'admin/login" target="_blank" data-saferedirecturl="'.base_url().'admin/login">Login </a></td> 
										    </tr> 
										   
										  </tbody></table> 
										 </center>';
                                      
                                        $fromName=$data['siteDetails'][0]->company_name;
                                        $subject="Registered successfully on ".$fromName;
                                        $from="no-reply@compaddicts.org";
										$this->mailHtml($email,$subject,$html,$fromName,$from);
										
										 $this->session->set_flashdata('success','Updates Successfully ..');
							            redirect('admin/subadmin'); 
						  }
                }
                else
                {
                   $this->session->set_flashdata('error','All * Fields Are Required..');
				   redirect(base_url('admin/edit-subadmin/'.$id)); 
                }
		  }
             $this->load->view('admin/edit-subadmin',$data);
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
										<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Thank you for registering with us. login to your account , list your water park and start posting your events too.You can use the details below to login to your account. </td> 
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
                                        $subject="Registered successfully on ".$fromName;
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
		else if($tbl=='merchants')
		{
           $file_name=$getData[0]->waterpark_logo;
			if($file_name!="" or $file_name!=null)
			{
				unlink('assets/front/uploads/merchant-logo/'.$file_name);
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

          $condition4=array('id' => $rowid); 
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
         

         $condition2=array('merchant_id' => $data['event'][0]->merchant_id,'event_id'=>$data['event'][0]->id); 
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
							
							$merchantId=$merchantId;

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

        $data['getBooking']=$this->Admin_model->getWhere('ticket_request',array('request_type' => 'booking','payment_status' => 1));

        
		  if(isset($_REQUEST['cancel_ticket']))
          {
            $booking_id=$_REQUEST['rowid'];
            $cancellation_reason=$_REQUEST['cancellation_reason'];
            $cancelled_by='admin';
            
            $getTicket=$this->Admin_model->getWhere('ticket_request',array('id' => $booking_id));
            $userId=$getTicket[0]->user_id;
            $merchantId=$getTicket[0]->merchant_id;
            $eventId=$getTicket[0]->event_id;
            $visit_date=$getTicket[0]->visit_date;
            $visitDate=date('M j,Y',strtotime($visit_date));

            $getUser=$this->Admin_model->getWhere('users',array('id' => $userId));
            $userName=$getUser[0]->name;
            $toUserEmail=$getUser[0]->email;

            $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
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
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello '.$userName.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Your ticket which was booked for '.$bookedFor.' , to be visited on '.$visitDate.' , has been cancelled by the admin.</td> 
					 </tr> 	
					  <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Reason : </b> '.$cancellation_reason.'</td> 
					 </tr> 	   
				    </tbody>
				</table> 
			</center>';

			$fromName=$data['siteDetails'][0]->company_name;
			$from="no-reply@compaddicts.org";

	        $subjectUser='Ticket cancelled - '.$waterParkName;
			$this->mailHtml($toUserEmail,$subjectUser,$htmlUser,$fromName,$from);
            
            $htmlMerchant='<center> 
				<table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
					<tbody>
					  <tr> 
						<td style="padding:5px;background:#fff;font-weight:bold;font-size:26px;border-bottom: 2px solid #262261;" align="center;"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails'][0]->company_logo.'" style="width:120px;"></a></font></td> 
					  </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello '.$merchantName.'</td> 
					 </tr> 
					 <tr align="center"> 
						<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">The ticket which was booked for '.$bookedFor.' , to be visited on '.$visitDate.' , has been cancelled by admin.Here are the customer details : </td> 
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

			$fromName=$data['siteDetails'][0]->company_name;
			$from="no-reply@compaddicts.org";

	        $subjectMerchant='Ticket cancelled - '.$bookedFor;
			$this->mailHtml($toMerchantEmail,$subjectMerchant,$htmlMerchant,$fromName,$from);

            $this->session->set_flashdata('success','Ticket has been cancelled');
            redirect('admin/bookticket');
          }

	$this->load->view('admin/book-ticket',$data);
}


public  function viewEnquiry()
{
    if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login'); 
			}
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

          $data['getEnquiry']=$this->Admin_model->getWhere('ticket_request',array('request_type' => 'enquiry'));
		

	$this->load->view('admin/enquiry',$data);
}

public function myMessages($page=0)
 {
        	if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login'); 
			}
			
		   $data['siteDetails']=$this->siteDetails();
		   $data['adminDetails']=$this->adminDetails();
           
         
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
	       $inboxCnt=$this->Admin_model->getDataCount('merchant_contact_request',array('delete_for_admin' => 1,'sender_type' => 'merchant'));
	       $data['inboxCount']=$inboxCnt;

          
		   $data['getInbox']=$this->Admin_model->getwithLimitOrderBy('merchant_contact_request',array('delete_for_admin' => 1,'sender_type' => 'merchant'),$data['fetchLimit'],$limit,'added_on','DESC');

		   $getSentItems=$this->Admin_model->getQuery("SELECT id FROM $tblMessage WHERE `sender_type`!='merchant'");

		   $data['getSentItems']=count($getSentItems);
		   
		   $data['unseenCount']=$this->Admin_model->getDataCount('merchant_contact_request',array('seen_status' => 2,'sender_type' => 'merchant'));
	       
            $data['fromData']=$limit + 1;
	        $data['toData']=$limit + $fetchLimit;
            
            if($data['toData']>$data['inboxCount'])
            {
            	$data['toData']=$data['inboxCount'];
            }
		   $this->load->library('pagination');

		   $config['base_url'] = base_url().'admin/messages';
		   $config['total_rows'] = $data['inboxCount'];
		   $config['per_page'] = $data['fetchLimit'];
	       $config['use_page_numbers'] = TRUE;

			$this->pagination->initialize($config);
		   $this->load->view('admin/messages',$data);
        }


        public function mySentitems($page=0)
        {
        	if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		   $data['siteDetails']=$this->siteDetails();
		   $data['adminDetails']=$this->adminDetails();

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
	       $sentItemsCnt=$this->Admin_model->getQuery("SELECT * FROM $tblMessage WHERE `sender_type`!='merchant'");
	       $data['sentItemsCount']=count($sentItemsCnt);

          
		   $data['getSentItems']=$this->Admin_model->getQuery("SELECT * FROM $tblMessage WHERE `sender_type`!='merchant' ORDER BY added_on DESC LIMIT $limit,$fetchLimit");

		   $data['unseenCount']=$this->Admin_model->getDataCount('merchant_contact_request',array('seen_status' => 2,'sender_type' => 'merchant'));
           
            $data['fromData']=$limit + 1;
	        $data['toData']=$limit + $fetchLimit;
            
            if($data['toData']>$data['sentItemsCount'])
            {
            	$data['toData']=$data['sentItemsCount'];
            }
		   $this->load->library('pagination');

		   $config['base_url'] = base_url().'admin/messages/sent-items';
		   $config['total_rows'] = $data['sentItemsCount'];
		   $config['per_page'] = $data['fetchLimit'];
	       $config['use_page_numbers'] = TRUE;

			$this->pagination->initialize($config);
		   $this->load->view('admin/sent-items',$data);
        }

 public function composeMessage()
        {
        	  if(isset($_REQUEST['compose_message']))
	           {
	           	  $message=nl2br($_REQUEST['message']);
	           	  if(!empty($message))
	           	  {
	           	  	 $data['siteDetails']=$this->siteDetails();
	           	  	 $adminDetails=$this->adminDetails();
	           	  	 $role=$adminDetails[0]->role;
	           	  	 $merchantId=$_REQUEST['merchant_id'];
	           	  	 $adminId=$this->session->userdata('WhAdminLoggedinId');
	                 $date=date('Y-m-d H:i:s');

	                 if($role==1)
	                 {
                       $sender_type="admin";
	                 }
	                 else
	                 {
                       $sender_type="subadmin";
	                 }

	                 $this->Admin_model->insertData('merchant_contact_request',array('merchant_id' => $merchantId,'admin_id' => $adminId,'message' => $message,'sender_type' => $sender_type,'added_on' => $date));

	                 $this->session->set_flashdata('success','Message sent Successfully');
	           	  	 redirect('admin/messages/sent-items');
	           	  }
	           	  else
	           	  {
	           	  	$this->session->set_flashdata('error','Message is required field');
	           	  	redirect('admin/messages/sent-items');
	           	  }
	              
	           }
        }


        public function markAsRead()
		{
			$rowid=$_GET['rowid'];
                    
            $tblMessage=$this->db->dbprefix."merchant_contact_request";
			$del=$this->db->query("UPDATE $tblMessage SET `seen_status`='1' WHERE id IN ($rowid)");
		}

		public function deleteMsgData()
		{
			$mode=$_GET['mode'];

			switch($mode)
			{
				
				case "messageInbox":

                    $rowid=$_GET['rowid'];
                    
                    $tblMessage=$this->db->dbprefix."merchant_contact_request";
					$del=$this->db->query("UPDATE $tblMessage SET `delete_for_admin`='2' WHERE id IN ($rowid)");

				break;

				case "messageSentItems":

                    $rowid=$_GET['rowid'];

					$tblMessage=$this->db->dbprefix."merchant_contact_request";
					$del=$this->db->query("DELETE FROM $tblMessage WHERE id IN ($rowid)");

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

				case "testimonial":
				
					$rowid=$_GET['rowid'];	

					$del=$this->Admin_model->deleteData('testimonial',array('id' => $rowid));

				break;
			}
		}

/*#################  End  All Booking Ticket Listing  ###################*/

/*========  Get   Booking Details ==========*/

public function getbookingDetails()
{
	$data['bookingid']=$_REQUEST['Bid']; 
    $data['mode']='bookingdetails'; 

    $condition2=array('id' => $data['bookingid']);
    $data['getBooikng']=$this->Admin_model->getWhere('ticket_request',$condition2);
   
    $data['getBillingDetail']=$this->Admin_model->getWhere('ticket_billing_details',array('ticket_request_id' => $data['bookingid']));

    $condition=array('id' => $data['getBooikng'][0]->merchant_id);
    $data['merchants']=$this->Admin_model->getWhere('merchants',$condition);
    
    //$data['waterparkname']=$merchant[0]->waterpark_name;

   
	$this->load->view('admin/ajax',$data);  
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

		  $this->load->view('admin/sliders',$data);
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
					$config['min_width']            = '1300';
				    $config['min_height']           = '500';

                    $addedBy=$this->session->userdata('WhAdminLoggedinId');

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
							
							$inData=array('title' => $title,'description' => $description,'image' => $file_name,'added_on' => $date,'added_by' => $addedBy,'status' => 1);
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

		  $this->load->view('admin/add-slider',$data);
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
                 $updatedBy=$this->session->userdata('WhAdminLoggedinId');

                 $upData=array('title' => $title,'description' => $description,'updated_on' => $date,'updated_by' => $updatedBy);
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
		  

		  $this->load->view('admin/edit-slider',$data);
		}



        public function viewTestimonial()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

		  $data['getData']=$this->Admin_model->getData('testimonial');

		  $this->load->view('admin/testimonial',$data);
		}


		public function addTestimonial()
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
             $comment=nl2br($_REQUEST['comment']); 
			
			 $date=date('Y-m-d H:i:s');
			 
			 if((!empty($name)) && (!empty($comment)))
			 {
                    $addedBy=$this->session->userdata('WhAdminLoggedinId');
							
					$inData=array('name' => $name,'comment' => $comment,'added_on' => $date,'added_by' => $addedBy,'status' => 1);
					$this->Admin_model->insertData('testimonial',$inData);
					$this->session->set_flashdata('success','Testimonial Added Successfully');
					redirect('admin/testimonials');
								
			 }
			 else
			 {
				    $this->session->set_flashdata('error','All fields are required');
			        redirect('admin/add-testimonial'); 
			 }
		  }

		  $this->load->view('admin/add-testimonial',$data);
		}


		public function editTestimonial($id)
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
		  
		  $condition=array('id' => $id);
		  $data['getData']=$this->Admin_model->getWhere('testimonial',$condition);
		  
		  
		  if(isset($_REQUEST['update']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $name=$_REQUEST['name'];  
                 $comment=nl2br($_REQUEST['comment']); 
                 
			     $date=date('Y-m-d H:i:s');
                 $updatedBy=$this->session->userdata('WhAdminLoggedinId');

                 if((!empty($name)) && (!empty($comment)))
			     {
                   $upData=array('name' => $name,'comment' => $comment,'updated_on' => $date,'updated_by' => $updatedBy);
				   $this->Admin_model->updateData('testimonial',$upData,$rowid);
				   $this->session->set_flashdata('success','Updated Successfully');
				    redirect('admin/testimonials');
				}
				else
				{
					$this->session->set_flashdata('error','All fields are required');
				    redirect('admin/edit-testimonial/'.$rowid); 
				}
	
		  }
		  

		  $this->load->view('admin/edit-testimonial',$data);
		}

		public function viewCommission()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();
           
          if(isset($_REQUEST['submit']))
		  {
			     $rowid=$_REQUEST['rowid'];  
			     $amount=$_REQUEST['amount'];   
                 
			     $date=date('Y-m-d H:i:s');
                 $updatedBy=$this->session->userdata('WhAdminLoggedinId');

                 if(!empty($amount))
			     {
                   $upData=array('amount' => $amount,'updated_on' => $date,'updated_by' => $updatedBy);
				   $this->Admin_model->updateData('commission_setting',$upData,$rowid);
				   $this->session->set_flashdata('success','Updated Successfully');
				    redirect('admin/commissions');
				}
				else
				{
					$this->session->set_flashdata('error','All fields are required');
				    redirect('admin/commissions/'); 
				}
	
		  }

		  $data['getData']=$this->Admin_model->getData('commission_setting');

		  $this->load->view('admin/commission-setting',$data);
		}


		public function viewReports()
		{
		  if($this->session->userdata('WhAdminLoggedinId')=='')
			{
			  redirect('admin/login');
			}
			
		  $data['siteDetails']=$this->siteDetails();
		  $data['adminDetails']=$this->adminDetails();

		  $data['getMerchant']=$this->Admin_model->getData('merchants');

		  $this->load->view('admin/reports',$data);
		}

		public function getReportAjax()
		{
			$selTyp=$_REQUEST['selTyp'];
			$merchantId=$_REQUEST['merchantId'];
			$month=$_REQUEST['month'];
			$year=$_REQUEST['year'];
			$fromDate=$_REQUEST['fromDate'];
			$toDate=$_REQUEST['toDate'];
			$mode=$_REQUEST['mode'];
            
            if($merchantId!=0)
            {
              $whereOne=" AND `merchant_id`='$merchantId'";

              $getMerchant=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
            }
            else
            {
              $whereOne='';
            }

			switch($selTyp)
			{
				case "today":
                   $cDate=date('Y-m-d');
                   $whereTwo=" AND date(added_on)='$cDate'";
                   
                   if($merchantId!=0)
		           {
                     $data['reportOf']="Report of ".$getMerchant[0]->waterpark_name." of ".date('M j,Y',strtotime($cDate));
		           }
		           else
		           {
                     $data['reportOf']="Report of ".date('M j,Y',strtotime($cDate));
		           }
                   
		        break;

		        case "yearly":
                  $whereTwo=" AND year(added_on)='$year'";

                  if($merchantId!=0)
		           {
                     $data['reportOf']="Report of ".$getMerchant[0]->waterpark_name." of year ".$year;
		           }
		           else
		           {
                     $data['reportOf']="Report of year ".$year;
		           }
		        break;

		        case "monthly":
                  $whereTwo=" AND ((year(added_on)='$year') AND (month(added_on)='$month'))";
                  
                  $monthArray=array('01' => 'January' , '02' => 'February' , '03' => 'March' , '04' => 'April' ,'05' => 'May' , '06' => 'June' , '07' => 'July' , '08' => 'August' , '09' => 'September' , '10' => 'October' , '11' => 'November' ,'12' => 'December');

                  if($merchantId!=0)
		           {
                     $data['reportOf']="Report of ".$getMerchant[0]->waterpark_name." of ".$monthArray[$month] ." ".$year;
		           }
		           else
		           {
                     $data['reportOf']="Report of ".$monthArray[$month] ." ".$year;
		           }

		        break;

		        case "between_dates":

		          $fromDate=date('Y-m-d',strtotime($fromDate));
		          $toDate=date('Y-m-d',strtotime($toDate));
                  $whereTwo=" AND (date(added_on) BETWEEN '$fromDate' AND '$toDate')";

                  if($merchantId!=0)
		           {
                     $data['reportOf']="Report of ".$getMerchant[0]->waterpark_name." from ".date('M j,Y',strtotime($fromDate))." to ".date('M j,Y',strtotime($toDate));
		           }
		           else
		           {
                     $data['reportOf']="Report from ".date('M j,Y',strtotime($fromDate))." to ".date('M j,Y',strtotime($toDate));
		           }
		        break;
			}

            $tblReport=$this->db->dbprefix."ticket_billing_details";
			$data['getReport']=$this->Admin_model->getQuery("SELECT * FROM $tblReport WHERE `payment_status`='1' $whereOne $whereTwo");

			$data['totalSale']=$this->Admin_model->getQuery("SELECT SUM(final_amount) as grossAmt FROM $tblReport WHERE `payment_status`='1' $whereOne $whereTwo");

			$data['totalCommission']=$this->Admin_model->getQuery("SELECT SUM(commission_amount) as comAmt FROM $tblReport WHERE `payment_status`='1' $whereOne $whereTwo");
            
            $data['mode']=$mode;

            $this->session->set_userdata('queryData',"SELECT * FROM $tblReport WHERE `payment_status`='1' $whereOne $whereTwo");
            $this->session->set_userdata('totalSaleData',"SELECT SUM(final_amount) as grossAmt FROM $tblReport WHERE `payment_status`='1' $whereOne $whereTwo");
            $this->session->set_userdata('totalCommissionData',"SELECT SUM(commission_amount) as comAmt FROM $tblReport WHERE `payment_status`='1' $whereOne $whereTwo");

            $this->session->set_userdata('reportOfPdf',$data['reportOf']);

			$this->load->view('admin/ajax',$data);

		}

		public function pdfReport()
		{
			$queryData=$this->session->userdata('queryData');
			$totalSaleData=$this->session->userdata('totalSaleData');
			$totalCommissionData=$this->session->userdata('totalCommissionData');
			$reportOfPdf=$this->session->userdata('reportOfPdf');
			$merchantId=$this->session->userdata('reportmerchantId');
            

            $data['siteDetails']=$this->siteDetails();

            $data['getReport']=$this->Admin_model->getQuery($queryData);

			$data['totalSale']=$this->Admin_model->getQuery($totalSaleData);

			$data['totalCommission']=$this->Admin_model->getQuery($totalCommissionData);

			$data['reportOf']=$reportOfPdf;

            $data['mode']='reportData';

			ini_set('memory_limit', '256M');
			   // load library
			$this->load->library('pdf');
			$pdf = $this->pdf->load('c','A4','10');

			$htmlPdf = $this->load->view('admin/report-pdf', $data, true);
		 	$date=date('F j,Y',strtotime(date('Y-m-d')));
			$pdf->Setheader($date);
			$pdf->SetWatermarkText($data['siteDetails'][0]->company_name,0.1);
			$pdf->showWatermarkText = true;
			$pdf->SetDisplayMode('fullpage');
			$pdf->WriteHTML($htmlPdf);
			
			$output='report_' . date('Y_m_d_H_i_s') . '_.pdf';				  
			$pdf->Output("$output", 'D');
		}



} ?>