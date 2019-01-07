<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class websiteAuthenticate extends CI_Controller {

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
	      $data['companyData']=$this->Admin_model->getWhere('master_admin',$where);
	      return $data;
	    }
		
		public function login()
		{
			if($this->session->userdata('WhUserLoggedinId')!='')
			{
			  $userType=$this->session->userdata('WhLoggedInUserType');
			  switch($userType)
			  {
			  	case "merchant":
                     redirect('merchant/dashboard');
			  	break;

			  	case "user":
                     redirect('user/dashboard');
			  	break;
			  }
			 
			}
		
			$data['siteDetails']=$this->siteDetails();
			  
			if(isset($_REQUEST['submit']))
			  {
				  $user_type=$_REQUEST['user_type'];
				  $username=$_REQUEST['email'];
				  $password=$_REQUEST['password'];
                  
                  if((!empty($user_type)) && (!empty($username)) && (!empty($password)))
                  {
                  	   switch($user_type)
                  	   {
                  	   	 case "merchant":
                  	   	   $tbl="merchants";
                  	   	   $folder="merchant";
                  	   	 break;

                  	   	 case "user":
                  	   	   $tbl="users";
                  	   	   $folder="user";
                  	   	 break;
                  	   }

	                   $where=array('email' => $username,'password' => $password,'status' => 1);
					   $queryCount=$this->Admin_model->getWhere($tbl,$where);
					   $countData=count($queryCount);

						  if($countData!=0)
						  {
							  $uid=$queryCount[0]->id;
							  $this->session->set_userdata('WhUserLoggedinId',$uid);
							  $this->session->set_userdata('WhLoggedInUserType',$user_type);
							  $this->session->set_flashdata('success','Welcome to your portal');
							  redirect($folder.'/dashboard');
						  }
						  else
						  {
							   $this->session->set_flashdata('error','Invalid Login Details');
						  }
                  }
                  else
                  {
                  	$this->session->set_flashdata('error','All fields are required');
                  }

			  }
			  
			$this->load->view('front/login',$data);
		}
		
		public function register()
		{
			if($this->session->userdata('WhUserLoggedinId')!='')
			{
			  $userType=$this->session->userdata('WhLoggedInUserType');
			  switch($userType)
			  {
			  	case "merchant":
                     redirect('merchant/dashboard');
			  	break;

			  	case "user":
                     redirect('user/dashboard');
			  	break;
			  }
			 
			}
		
			$data['siteDetails']=$this->siteDetails();
			 


			if(isset($_REQUEST['submit']))
			  {
				  $user_type=$_REQUEST['user_type'];
				  $name=$_REQUEST['name'];
				  $email=$_REQUEST['email'];
				  $mobile=$_REQUEST['mobile'];
				  $password=$_REQUEST['password'];
                  
                  if((!empty($user_type)) && (!empty($name)) && (!empty($email)) && (!empty($mobile)) && (!empty($password)))
                  {
                  	   $addedOn=date('Y-m-d H:i:s');
                  	   switch($user_type)
                  	   {
                  	   	 case "merchant":
                  	   	   $tbl="merchants";
                  	   	   $folder="merchant";
                  	   	   $waterpark_name=$_REQUEST['waterpark_name'];
                  	   	   $dataArray=array('name' => $name,'waterpark_name' => $waterpark_name,'mobile_number' => $mobile,'email' => $email,'password' => $password,'added_on' => $addedOn,'added_by' => '0','status' => '2');
                  	   	 break;

                  	   	 case "user":
                  	   	   $tbl="users";
                  	   	   $folder="user";
                  	   	   $dataArray=array('name' => $name,'mobile' => $mobile,'email' => $email,'password' => $password,'added_on' => $addedOn,'status' => '1');
                  	   	 break;
                  	   }

	                   $where=array('email' => $email);
					   $queryCount=$this->Admin_model->getWhere($tbl,$where);
					   $countData=count($queryCount);

						  if($countData!=0)
						  {
							$this->session->set_flashdata('error','Email id already registered');
						  }
						  else
						  {

						  	  $lastId=$this->Admin_model->insertData($tbl,$dataArray);
                              $date=date('Y-m-d H:i:s');
                              $encodedprefixDate=base64_encode(base64_encode(base64_encode(base64_encode($date))));
                              $encodedsubfixDate=base64_encode(base64_encode(base64_encode($date)));
                              $encodedUrl=$encodedprefixDate.'='.$lastId.'='.$encodedsubfixDate;
                              if($user_type=='merchant')
                              {

							    $html='<center> 
										 <table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
										   
										   <tbody><tr> 
											<td style="padding:5px;background:#00a1ff;font-weight:bold;font-size:26px" align="center"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width: 80px;"></a></font></td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello <span class="il">'.$name.'</span> </td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Thank you for registering with us.Verify your email id to list your water park and start posting your events too.You can use the details below to login to your account after verifying your email id. </td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$email.'</td> 
										   </tr> 
										    <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Password : </b> '.$password.'</td> 
										   </tr> 
										   <tr> 
											<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'verify-account/'.$encodedUrl.'" target="_blank" data-saferedirecturl="'.base_url().'verify-account/'.$encodedUrl.'">Click to verify email</a></td> 
										   </tr> 
										   
										 </tbody></table> 
										</center>';
                                        
                                        $fromName=$data['siteDetails']['companyData'][0]->company_name;
                                        $subject="Verify your merchant account on ".$fromName;
                                        $from="no-reply@compaddicts.org";
										$this->mailHtml($email,$subject,$html,$fromName,$from);
										$this->session->set_flashdata('success','Thank you for registering.A verification link has been sent on your mail.Please check your mail and verify your account to login.');
                              }
                              else
                              {
                              	 $html='<center> 
										 <table style="max-width:550px;border-radius:5px;background:#fff;font-family:Arial,Helvetica,sans-serif;table-layout:fixed;margin:0 auto" border="0" width="100%" cellspacing="0" cellpadding="0" align="center"> 
										   
										   <tbody><tr> 
											<td style="padding:5px;background:#00a1ff;font-weight:bold;font-size:26px" align="center"><font color="#FFFFFF"><a href="'.base_url().'" target="_blank" data-saferedirecturl="'.base_url().'"><img alt="'.$data['siteDetails']['companyData'][0]->company_name.'" src="'.base_url().'assets/front/uploads/logo/'.$data['siteDetails']['companyData'][0]->company_logo.'" style="width: 80px;"></a></font></td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;font-weight:bold;text-align:justify">Hello <span class="il">'.$name.'</span> </td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:18px;color:#000;text-align:justify">Thank you for registering with us.You can use the details below to login to your account. </td> 
										   </tr> 
										   <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Email : </b> '.$email.'</td> 
										   </tr> 
										    <tr align="center"> 
											<td style="background:#ffffff;padding:10px;font-size:14px;line-height:22px;color:#000;text-align:justify"><b> Password : </b> '.$password.'</td> 
										   </tr> 
										   <tr> 
											<td style="background:#000;padding-top:25px;padding-bottom:25px" align="center"><a style="outline:none;border:0px;padding-top:10px;padding-bottom:10px;padding-left:30px;padding-right:30px;border-radius:50px;text-decoration:none;color:#000;font-weight:bold;font-size:14px;background-color:#fff" href="'.base_url().'login" target="_blank" data-saferedirecturl="'.base_url().'verify-account">Login Now</a></td> 
										   </tr> 
										   
										 </tbody></table> 
										</center>';
                                        
                                        $fromName=$data['siteDetails']['companyData'][0]->company_name;
                                        $subject="Thank you for registering on ".$fromName;
                                        $from="no-reply@compaddicts.org";
										$this->mailHtml($email,$subject,$html,$fromName,$from);
                              	        $this->session->set_flashdata('success','Registered Successfully');
                              }
							 
							  redirect('login');
							  
						  }
                  }
                  else
                  {
                  	$this->session->set_flashdata('error','All fields are required');
                  }

			  }
			  
			$this->load->view('front/register',$data);
		}

        public function accountVerification($encodedUrl)
        {
          $exUrl=explode('=',$encodedUrl);
          $cnt=count($exUrl);
          for($i=0;$i<$cnt;$i++)
          {
          	$val=$exUrl[$i];
          	if(($val!="") && ($val!='0') && (filter_var($val, FILTER_VALIDATE_INT)))
          	{
          		       $this->Admin_model->updateData('merchants',array('status' => 1),$val);
          		       $where=array('id' => $val);
					   $queryCount=$this->Admin_model->getWhere('merchants',$where);
					   $uid=$queryCount[0]->id;
	                   $this->session->set_userdata('WhUserLoggedinId',$uid);
					   $this->session->set_userdata('WhLoggedInUserType','merchant');
					   $this->session->set_flashdata('success','Welcome to your portal');
					   redirect('merchant/dashboard');
          	}
          }

        }

		public function logout()
		{
		    $this->session->unset_userdata('WhUserLoggedinId');			
		    $this->session->unset_userdata('WhLoggedInUserType');			
			$this->session->sess_destroy();
			redirect('login');
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