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

        $data['waterParks']=$this->Admin_model->getwithLimitOrderBy('merchants',array('status' => '1'),'6','0','id','DESC');

		$data['recentEvents']=$this->Admin_model->getwithLimitOrderBy('merchants_events',array('status' => '1'),'6','0','id','DESC');
		
		$date=date('Y-m-d');
		$tbl=$this->db->dbprefix.'merchants_events';
		$data['upcomingEvents']=$this->Admin_model->getQuery("SELECT * FROM $tbl WHERE `status`='1' AND (`start_date` > '$date') ORDER BY `start_date` ASC LIMIT 0,3");

		$this->load->view('front/index',$data);
	}

	public function eventDetail($eventUrl)
	{
        $data['siteDetails']=$this->siteDetails();
		$data['userDetails']=$this->userDetails();
        
        $exUrl=explode('-',$eventUrl);
        $endUrl=end($exUrl);
		$endUrl=substr($endUrl,3);
		$eventId=substr($endUrl,0,-3);

		$data['getData']=$this->Admin_model->getWhere('merchants_events',array('id' => $eventId));
        $merchantId=$data['getData'][0]->merchant_id;

        $data['geteventGallery']=$this->Admin_model->getWhere('gallery',array('event_id' => $eventId));

        $data['getMerchant']=$this->Admin_model->getWhere('merchants',array('id' => $merchantId));
        
        $data['geteventReview']=$this->Admin_model->getWhere('customer_review',array('event_id' => $eventId));

		$this->load->view('front/event-detail',$data);
	}
}
