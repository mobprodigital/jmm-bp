<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL ^ E_DEPRECATED);

class Publisher extends Auth_Controller{
 protected $var1,$var2;
    function __construct() {
		parent::__construct();
		 /*  if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        } */
		date_default_timezone_set('Asia/Kolkata');
		header("Access-Control-Allow-Origin: *");
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('Publisher_Model');
		$this->load->model('User_Model');
		$this->load->model('Login_Model');
		$this->load->model('Statistics_Model');


		/* $this->load->model('User_Model');
		$this->load->model('Statistics_Model');
		$this->load->model('Admin_Model');
		$this->load->model('Home_Model'); */
	}
	
	function  index(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewwebsite';
		if(is_numeric($this->uri->segment(2))){
			$pubId 							= $this->uri->segment(2);
		}else{
			$pubId = null;
		}
		$data['pubId']					= $pubId;
		$data['affiliates']				= $this->Publisher_Model->getwebsites();
		$this->load->view('publisher/dashboard', $data);	
	}
	
	function home(){
		$data['cat']					= 'home';
		$data['activeaction']			= 'home';
		if(isset($_GET['period_preset'])){
			$startDate              = $this->input->get('period_start');
			$endDate				= $this->input->get('period_end');
			$data['period_preset']	= $this->input->get('period_preset');
			$data['period_start']	= $startDate;
			$data['period_end']		= $endDate;
		}else{
			$startDate              = Date('Y-m-d');
			$endDate				= Date('Y-m-d');
			$data['period_preset']	= 'today';
			$data['period_start']	= $startDate;
			$data['period_end']		= $endDate;
		}
		
		$data['publisherStats'] = $this->Publisher_Model->publisherNetworksStats($startDate,$endDate);
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		    = getPresetWithDateRange();
		$this->load->view('publisher/home', $data);
	}
	
	function inventory(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewwebsite';
		$data['affiliates']				= $this->Publisher_Model->getwebsites();
		$this->load->view('publisher/viewwebsite', $data);	
	}
	
	function viewwebsites(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewwebsite';
		

		$data['affiliates']				= $this->Publisher_Model->getwebsites();
		$this->load->view('publisher/viewwebsite', $data);	
	}
	
	function profile(){
		echo 'hi';
		$data		 = array();
	 	$pubId       = null;
	 if(isset($_GET['uid'])){
			    $pubId  = $this->input->post('uid');   
		 
	 	}
		if(isset($_POST['submit'])){
			 
			  
			$pubId              = $this->input->post('uid');  
			$input['username']	= $this->input->post('email');
			//$input['password']	= $this->input->post('password');
			$input['firstname']	= $this->input->post('firstname');
			$input['lastname']	= $this->input->post('lastname');
			$input['skype']		= $this->input->post('skype');
			$input['phone']		= $this->input->post('phone');
			$input['company']		= $this->input->post('company');

			$input['role']		= 3;
			$input['date_created']	= date('Y-m-d');
			$input['date_updated']	= date('Y-m-d');
		   //print_r($input); die;
			$result 			= $this->Publisher_Model->save($input, $pubId);
			//print_r($result); die;
		}
		
		$data['profile']	= $this->Publisher_Model->getAccountInfo();
		//echo "<pre>"; print_r($data['profile']->phone);
		$exp_data         = explode(" ",$data['profile']->phone);
		$exp_data_plus    = explode("+",$exp_data[0]);
		$exp_country_code = $exp_data_plus[1];  
		$data['country']  = $this->Login_Model->getCountryCode();
	 	 
	  $search_res = array_search($exp_country_code, array_column($data['country'], 'countries_isd_code'));
		$data['country_code'] = $data['country'][$search_res];
    $this->load->view('publisher/profile', $data);	
	}
	
	public function website(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'website';
		
		
		if($this->input->post('submit')){
			//echo '<pre>';print_r($_POST);
			$model['agencyid']						= 1;
			$model['website']       				= $this->input->post('website');
			$model['name']							= $this->input->post('name');
			$model['contact']						= $this->input->post('contact');
			$model['email']   						= $this->input->post('email');
			$model['updated']   					= date("Y-m-d H:i:s");
			
			if(isset($_GET['affiliateid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$id							= $this->Publisher_Model->addwebsite($model, $affiliateid);
				$data['affiliates']			= $this->Publisher_Model->getwebsites($affiliateid);
				$data['msg']				= 'website is successfully updated';
			}else{
				$newbannerId					= $this->Publisher_Model->addwebsite($model);
				$data['msg']					= 'website is successful added';
			}
			$this->load->view('publisher/header',$data);
			$this->load->view('publisher/leftsidebar', $data);
			$this->load->view("publisher/website",	$data);
		}else{
			if(isset($_GET['affiliateid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$data['affiliates']			= $this->Publisher_Model->getwebsites($affiliateid);
			}
			
			$this->load->view('publisher/header',$data);
			$this->load->view('publisher/leftsidebar', $data);
			$this->load->view("publisher/website");
		}
	}
	
	public function zone(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'zones';
		
		if(isset($_GET['affiliateid'])){
			$affiliateid				= $this->input->get('affiliateid');
			$zone['affiliateid']		= $affiliateid;
		}else{
			$default			= $this->Publisher_Model->getDefaultAffiliate();
			if(!empty($default)){
				$zone['affiliateid']				= $default->affiliateid;
			}else{
				$zone['affiliateid']		= null;
			}
		}
		$data['affiliateid']		= $zone['affiliateid'];

		
		
		if($this->input->post('submit')){
			//echo '<pre>';print_r($_POST);die;
			$zone['zonename']				= $this->input->post('zonename');
			$zone['description']			= $this->input->post('description');
			$zone['delivery']				= $this->input->post('delivery');
			$zone['zonetype']				= $this->input->post('sizetype');
			
			//$zone['size']				= $this->input->post('size');
			$zone['width']				= $this->input->post('width');
			$zone['height']				= $this->input->post('height');
			$zone['comments']			= $this->input->post('comments');
			$zone['updated']			= date('Y-m-d H:i:s');
			if(isset($_GET['affiliateid']) && isset($_GET['zoneid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$zoneid						= $this->input->get('zoneid');

				$id							= $this->Publisher_Model->addzone($zone, $affiliateid, $zoneid);
				$data['affiliates']			= $this->Publisher_Model->getzones($affiliateid, $zoneid);
				$data['msg']				= 'zone is successfully updated';
			}else{
				$affiliateid				= $this->input->get('affiliateid');
				$zoneid						= $this->Publisher_Model->addzone($zone, $affiliateid);
				$data['msg']				= 'zone is successful added';
			}
			//echo '<pre>';print_r($zone);die;
			//echo '<pre>';print_r($data);die;
			//echo $GLOBALS['cacheDir'];die;
			$cacheArr		= array($zone);
			$my_file 		= $GLOBALS['cacheDir'].'delivery_zone_'.$zoneid.'.php';
			file_put_contents($my_file, json_encode($cacheArr));
			$this->load->view('publisher/header',$data);
			$this->load->view('publisher/leftsidebar', $data);
			$this->load->view("publisher/zone",	$data);
		}else{
			if(isset($_GET['affiliateid']) && isset($_GET['zoneid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$zoneid						= $this->input->get('zoneid');
				$data['zones']				= $this->Publisher_Model->getzones($affiliateid, $zoneid);
			}
			
			
			$this->load->view('publisher/header',$data);
			$this->load->view('publisher/leftsidebar', $data);
			$this->load->view("publisher/zone");
		}
		
	}
	
	function viewzone(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewzones';
		if(isset($_GET['affiliateid']) && isset($_GET['zoneid'])){
			$affiliateid				= $this->input->get('affiliateid');
			$data['affiliates']			= $this->Publisher_Model->getzones($affiliateid, $zoneid);
			$data['msg']				= 'zone is successfully updated';
		}elseif(isset($_GET['affiliateid'])){
			$affiliateid					= $_GET['affiliateid'];
			$data['zones']					= $this->Publisher_Model->getzones($affiliateid);
		}else{
			$data['zones']					= $this->Publisher_Model->getzones();
		}
		
		$this->load->view('publisher/header', $data);
		$this->load->view('publisher/leftsidebar', $data);
		$this->load->view("publisher/viewzones", $data);
	}
	
	public function webzonestats(){
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'webzonestats';
		$zoneId 		= null;
		$publisherId	= null;
		
		if(isset($_GET['affiliateid'])){
			$publisherId					= $this->input->get('affiliateid');
			$data['affiliates']				= $this->User_Model->getwebsites($publisherId);
		}else{
			$publisherId   = null;
		}
		
		if(isset($_GET['period_preset'])){
			$startDate              = $this->input->get('period_start');
			$endDate				= $this->input->get('period_end');
			$data['period_preset']	= $this->input->get('period_preset');
			$data['period_start']	= $startDate;
			$data['period_end']		= $endDate;
			/* if($data['period_preset'] == 'specific'){
				$data['enableDateBox']	= true;

			}else{
				$data['enableDateBox']	= false;

			} */

		}else{
			$startDate              = Date('Y-m-d');
			$endDate				= Date('Y-m-d');
			$data['period_preset']	= 'today';
			$data['period_start']	= $startDate;
			$data['period_end']		= $endDate;
			//$data['enableDateBox']	= false;
		}
		if(isset($_GET['affiliateid']) && isset($_GET['breakthrough'])){
			$affiliateid				= $this->input->get('affiliateid');
			$breakthrough				= $this->input->get('breakthrough');
		
			if($breakthrough == 'zone'){
				if(isset($_GET['zoneid'])){
					$zoneId                     = $this->input->get('zoneid');
					$data['zone']				= $this->User_Model->getzones($affiliateid, $zoneId);
					$data['publisherStats'] 	= $this->User_Model->websiteZoneDailyStats($affiliateid,$zoneId,$startDate,$endDate);
				}else{
					$data['publisherStats'] 	= $this->User_Model->websiteZoneStats($affiliateid,$startDate,$endDate);
				}
			}
			if($breakthrough == 'campaigns'){
				if(isset($_GET['campaignid'])){
					$campaignId                 = $this->input->get('campaignid');

					if(isset($_GET['zoneid'])){
						$zoneId                     = $this->input->get('zoneid');
						$data['zone']				= $this->User_Model->getzones($affiliateid, $zoneId);
						$data['publisherStats'] 	= $this->Statistics_Model->helloGoolge($publisherId, $campaignId,$zoneId, $startDate, $endDate, $localTZ = false);
					}else{	
					
						$data['publisherStats'] 	= $this->Statistics_Model->helloGoolge($publisherId, $campaignId, null,$startDate, $endDate, $localTZ = false);
					}
					if(!empty($data['publisherStats'])){
						$data['campaign']	= $data['publisherStats'][0]->campaignName;
					}
					
					//$data['publisherStats'] 	= $this->Statistics_Model->getPublisherCampaignDailyStatistics($affiliateid,$campaginId,$startDate,$endDate);
				}else{
					if(isset($_GET['zoneid'])){
						$zoneId                     = $this->input->get('zoneid');
						$data['zone']				= $this->User_Model->getzones($affiliateid, $zoneId);
						$data['publisherStats'] 	= $this->User_Model->websiteCampaginStats($affiliateid,$zoneId,$startDate,$endDate);
						$data['campaign_zone_id']	= $zoneId;
					}else{
						$data['publisherStats'] 	= $this->User_Model->websiteCampaginStats($affiliateid,null,$startDate,$endDate);

					}
				}
			}
			
			
			if($breakthrough == 'affiliate'){
				$data['publisherStats'] 	= $this->User_Model->publisherStats($affiliateid,$startDate,$endDate);
			}
		
		}else if(isset($_GET['affiliateid'])){
		
			$data['publisherStats'] = $this->User_Model->publisherDailyStats($publisherId, $startDate, $endDate);
		}else{
			$data['publisherStats'] = $this->Publisher_Model->publisherStats($publisherId,$startDate,$endDate);

		}
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 			= getPresetWithDateRange();
		
		$data['checkVideoPub']	= $this->User_Model->checkVideoPub($publisherId,$zoneId);
		
		//echo $zoneId.'<br>'.$publisherId.'<br>'.$campaignId;die;
		//echo '<pre>';print_r($data);die;
		$this->load->view('publisher/header', $data);
		$this->load->view('publisher/leftsidebar', $data);
		$this->load->view("publisher/webzone", $data);
		
	}
	
	function webzonevideostats(){
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'webzonevideostats';
		if(isset($_GET['period_preset'])){
			$startDate              = $this->input->get('period_start');
			$endDate				= $this->input->get('period_end');
			$data['period_preset']	= $this->input->get('period_preset');
			$data['period_start']	= $startDate;
			$data['period_end']		= $endDate;
			/* if($data['period_preset'] == 'specific'){
				$data['enableDateBox']	= true;

			}else{
				$data['enableDateBox']	= false;

			} */

		}else{
			$startDate              = Date('Y-m-d');
			$endDate				= Date('Y-m-d');
			$data['period_preset']	= 'today';
			$data['period_start']	= $startDate;
			$data['period_end']		= $endDate;
			//$data['enableDateBox']	= false;
		}
		
		
		if(isset($_GET['breakthrough'])){
			$breakthrough				= $this->input->get('breakthrough');
			if($breakthrough == 'zone'){
				$zoneId                     = $this->input->get('zoneid');
				$affiliateId                = $this->input->get('affiliateid');
				$data['VideoStats'] 		= $this->User_Model->websiteZoneVideoStats($breakthrough,$zoneId,'day',$startDate,$endDate);
			}
			if($breakthrough == 'affiliate'){
				$zoneId 						 = null;
				$affiliateId                     = $this->input->get('affiliateid');

				$data['VideoStats'] 	= $this->User_Model->websiteZoneVideoStats($breakthrough,$affiliateId,'day',$startDate,$endDate);
			}
		}
		
		
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		= getPresetWithDateRange();
		
		//echo $zoneId.'<br>'.$publisherId.'<br>'.$campaignId;die;
		//echo '<pre>';print_r($data);die;
		$this->load->view('publisher/header', $data);
		$this->load->view('publisher/leftsidebar', $data);
		$this->load->view("publisher/webzonevideostats", $data);
		
	}


	/*************************** Added By Riccha *********/
	public function deletewebsite(){	
		if ($_GET['website_ids']) {
			$websiteId= trim($_GET['website_ids'],",");
			$websiteId = explode(',', $websiteId);
		 }
		
		$data['cat']		= 'inventory';
		
		 
		if($websiteId[0]=='main_0'){
			array_shift($websiteId);
		}
		//print_r($websiteId); die;
		$web_ids = implode(',',$websiteId);
		
		$result = $this->Publisher_Model->deleteWebsite($web_ids);
		redirect('publisher/viewwebsite');
	}

	public function deletezone(){	
		if ($_GET['zone_ids']) {
			$zoneId= trim($_GET['zone_ids'],",");
			$zoneId = explode(',', $zoneId);
		}
		
		$data['cat']		= 'inventory';
		
		if($zoneId[0]=='main_0'){
			array_shift($zoneId);
		}
		//print_r($zoneId); die;
		$res_zone = implode(',',$zoneId);
	
		$result = $this->Publisher_Model->deleteZone($res_zone);
		redirect('publisher/viewzone');
		
	}

	/*********************** Ends ***********************/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}