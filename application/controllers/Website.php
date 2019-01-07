<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

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

    public function userDetails()
	{
			$uid=$this->session->userdata('WhUserLoggedinId');
			$where=array('id' => $uid);
			$data=$this->Admin_model->getWhere('merchants',$where);
			return $data;
	}

	public function index()
	{
		$data['siteDetails']=$this->siteDetails();
		$data['userDetails']=$this->userDetails();
		
		$this->load->view('front/index',$data);
	}
}
