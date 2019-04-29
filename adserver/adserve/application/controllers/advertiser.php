<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL ^ E_DEPRECATED);

class Advertiser extends Auth_Controller{
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
		$this->load->model('Advertiser_Model');
		$this->load->model('User_Model');
		$this->load->model('Login_Model');
		$this->load->model('Statistics_Model');
		$this->load->model('Update_Cache_Model');
	
	}
	
	function index(){
		$data = array();
		$data['cat']			= 'home';
		$data['activeaction']	= 'home';
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
		
		$data['advertiserStats'] = $this->Advertiser_Model->advertiserNetworksStats($startDate,$endDate);
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		    = getPresetWithDateRange();
		$this->load->view('advertiser/home', $data);
	}
	
	function profile(){
		$data		 = array();
		$pubId       = null;
		if(isset($_GET['uid'])){
			$advtId  = $this->input->get('uid');
		}
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);die;
			$input['username']		= $this->input->post('email');
			//$input['password']		= $this->input->post('password');
			$input['firstname']		= $this->input->post('firstname');
			$input['lastname']		= $this->input->post('lastname');
			$input['skype']			= $this->input->post('skype');
			$input['phone']			= $this->input->post('phone');
			$input['company']		= $this->input->post('company');

			$input['role']		= 2;
			$input['date_created']	= date('Y-m-d');
			$input['date_updated']	= date('Y-m-d');
			$data['msg'] 			= $this->Advertiser_Model->save($input, $advtId);
		}
		
		$data['profile']	= $this->Advertiser_Model->getAccountInfo($advtId);
		//echo '<pre>';print_r($data);die;
		$exp_data         = explode(" ",$data['profile']->phone);
		$exp_data_plus    = explode("+",$exp_data[0]);
		$exp_country_code = $exp_data_plus[1];  
		$data['country']  = $this->Login_Model->getCountryCode();
	 	 
	    $search_res = array_search($exp_country_code, array_column($data['country'], 'countries_isd_code'));
		$data['country_code'] = $data['country'][$search_res];

		$this->load->view('advertiser/profile', $data);	
	}
			
	
	function delivery(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewwebsite';
		//echo $this->session->userdata('username');die;
		$data['advertiser']			= $this->Advertiser_Model->getAdvertiser();
		$this->load->view('advertiser/delivery', $data);	
	}
	
	
	
	
	
	/**-------------------------Start of advertisemnt module-----------------------------------------------*/
	
	public function advertisement(){
				
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'advertisement';

		if ($this->input->post('submit')) {
			//echo '<pre>';print_r($_POST);die;
			
			//Contact
			$advertiser['agencyid']					= $this->session->userdata('uid');
			$advertiser['clientname']				= $this->input->post('name');
			$advertiser['contact']					= $this->input->post('contact');
			$advertiser['email']					= $this->input->post('email');
			$advertiser['comments']					= $this->input->post('comment');
			
			//Report
			$advertiser['reportinterval']			= $this->input->post('report_interval');
			$advertiser['report'] 					= $this->input->post('report') == 't' ? 't' : 'f';
			$advertiser['reportdeactivate'] 		= $this->input->post('activeemail') == 't' ? 't' : 'f';
			$advertiser['advertiser_limitation']  	= $this->input->post('adlimitation') == '1' ? 1 : 0;
			
			$userdata['username']	= $advertiser['email'];
			$userdata['role']	 	= 'advertiser';
			$userdata['firstname']	= $advertiser['clientname'];
			if(isset($_GET['id'])){
				$userId				= $this->input->get('uid');
				$clientid			= $this->input->get('id');
				$data['advertiser']	= $this->Advertiser_Model->addadvertiser($userdata, $advertiser, $clientid, $userId);
				$data['msg']		= "Advertiser Is Updated Successfully ";
			}else{
				$id 					= $this->Advertiser_Model->addadvertiser($userdata, $advertiser);
				$data['msg']			= "Advertiser Is Successful Added";
			}
			
		}else{
			if(isset($_GET['id'])){
				$clientid						= $this->input->get('id');
				$data['advertiser']				= $this->Advertiser_Model->getadvertiser(null,$clientid);
			}
			
		}
			$this->load->view('advertiser/header', $data);
			$this->load->view('advertiser/leftsidebar', $data);
			$this->load->view("advertiser/advertisement",	$data);
	}
	
	function getclientaccess(){
		$clientId						= $this->input->post('clientid');
		$users							= $this->Publisher_Model->getclientaccess($clientId);
		echo json_encode(array("users"=>$users));
	}
	
	function updateclientaccess(){
		$clientId						= $this->input->post('clientid');
		$userId							= $this->input->post('userid');
		$userId							= substr($userId,1);
		$userIds						= explode(',',$userId);
		$input["client_id"]				= $clientId;
		$input["user_id"]				= json_encode($userIds);
		$msg							= $this->Publisher_Model->updateclientaccess($clientId, $input);
		echo json_encode(array("msg"=>$msg));

	}
	
	// public function deleteadvertiser(){	
	//     $data['cat']		= 'inventory';
	// 	$advertzId			= $this->input->post('id');
	// 	$advertzId			= substr($advertzId, 1);
	// 	if(strpos($advertzId, 'main_0') === 0){
	// 		$advertzId		= substr($advertzId, 7);
	// 	}
	// 	$this->db->query("update `clients` set status = '0' where clientid in ('$advertzId')");
		
	// }
	
	
	
	public function viewadvertiser(){
		
		$data['cat']						= 'inventory';
		$data['activeaction']				= 'viewadvertiser';
		
		if(isset($_GET['clientid'])){
			$clientid						= $this->input->get('clientid');
			$data['advertiser']				= $this->Advertiser_Model->getadvertiser($clientid);
		}else{
			$data['advertiser']				= $this->Advertiser_Model->getadvertiser();
		}
		
		if(isset($_GET['key'])){
			$data['searchInput']		= $this->input->get('key');
			
		}
		//echo '<pre>';print_r($data);die;
		$this->load->view('advertiser/viewadvertiser',  $data);
	}
	
	public function getadvertiser(){	
	$data['cat']			= 'inventory';
		$data			= $this->Publisher_Model->getadvertiser();
		echo json_encode($data);
	}
	
	/********** Start of Campaign Section *********************************************************/
	
	
	public function compaign(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'compaign';
		$data['advertiserIdString']		= '';
		$data['remnant']				= CAMPAIGN_REMNANT;
		$data['contract']				= CAMPAIGN_CONTRACT;
		$data['override']				= CAMPAIGN_OVERRIDE;
		$campaign['clientid']			= $this->input	->get('clientid');
		
		if ($this->input->post('submit')) {
			//echo '<pre>';print_r($_POST);die;
			$campaign['campaignname']				= $this->input->post("campaign");
			$campaign['campaign_type']				= $this->input->post("campaign_type");
			
			if($this->input->post("startSet")=='t'){
				$activationTime							= $this->input->post("activate_time");
				$activationTime  						= str_replace("/","-",$activationTime);
				$activationTime							= date('Y-m-d',strtotime($activationTime));
				$campaign['activate_time']				= $activationTime;
				$today 									= date("Y-m-d");
				if($today == $activationTime){
					$campaign['status'] 					= 1; 
					
				}else{
					$campaign['status'] 					= 1; 
					
				}
			}else{
				$today 									= date("Y-m-d");
				$campaign['activate_time']				= $today;
				$campaign['status'] 					= 1;               

			}
			
			if($this->input->post("endSet")=='t'){
				$expiraitonTime							= $this->input->post("expire_time");
				$expiraitonTime  						= str_replace("/","-",$expiraitonTime);
				$expiraitonTime							= date('Y-m-d', strtotime($expiraitonTime));
				$campaign['expire_time']				= $expiraitonTime;
			}else{
				$campaign['expire_time']				= "";                

			}
			//echo '<pre>';print_r($campaign);die;

			

			$advertiser['report'] 					= $this->input->post('report') == 't' ? 't' : 'f';

			$campaign['revenue_type'] 				= $this->input->post("revenue_type");
			$campaign['revenue']	 				= $this->input->post("revenue");
			if(isset($_POST['views'])){
				$campaign['views'] 						= -1;
			}else{
				$campaign['views'] 						= $this->input->post("impressions");
			}
			$campaign['priority'] 						= $this->input->post("high_priority_value");
			if(isset($_POST['target_value'])){
				$targetValue							= $this->input->post("target_value");
			}
			if(isset($_POST['target_type'])){
				$targetType								= $this->input->post("target_type");
				$campaign['tracking_type']				= $targetType;
				if($targetType == 'target_impression'){
					$campaign['target_impression'] 		= $targetValue;
				
				}elseif($targetType == 'target_click'){
					$campaign['target_click'] 			= $targetValue;
				
				}elseif($targetType == 'target_conversion'){				
					$campaign['target_conversion']		= $targetValue; 
				}
			}
			
			//$campaign['capping'] 					= $this->input->post("capping");
			//$campaign['session_capping'] 			= $this->input->post("session_capping");
			
			$campaign['capping_amount'] 				= $this->input->post("capping_amount");
			$campaign['capping_period_value'] 			= $this->input->post("capping_period_value");
			$campaign['capping_period_type'] 			= $this->input->post("capping_period_type");

			$campaign['comments'] 					= $this->input->post("comments");
			if(isset($_POST['show_capped_no_cookie'])){
				$campaign['show_capped_no_cookie'] 		= 1;
			}else{
				$campaign['show_capped_no_cookie'] 		= 0;
			}
			
			if(isset($_POST['anonymous'])){
				$campaign['anonymous'] 		= 't';
			}else{
				$campaign['anonymous'] 		= 'f';
			}
			
			if(isset($_POST['companion'])){
				$campaign['companion'] 		= 1;
			}else{
				$campaign['companion'] 		= 0;
			}
			//$campaign['hours'] 					= $this->input->post("hours");
			//$campaign['mintues'] 					= $this->input->post("mintues");
			//$campaign['second'] 					= $this->input->post("second");
			
			
			if(isset($_GET['clientid']) && isset($_GET['campaignid'])){
				//echo '<pre>';print_r($campaign);die;
				$clientid					= $this->input->get('clientid');
				$campaignid					= $this->input->get('campaignid');
				$id							= $this->Advertiser_Model->addcampaign($campaign, $clientid, $campaignid);
				
				$data['campaign']			= $this->Advertiser_Model->getcampaigns($clientid, $campaignid);
				if(!empty($data['campaign'])){
					$this->Update_Cache_Model->updateCampaignBannerCacheData($data['campaign'], $campaignid);
				}
				if(!is_null($data['campaign'][0]->tracking_type)){
					$limit								= $data['campaign'][0]->tracking_type;
					$data['campaign'][0]->target_value	= $data['campaign'][0]->$limit;
				}
				
				
				if($data['campaign'][0]->activate_time > date("Y-m-d")){
					$data['campaign'][0]->activeaction_calc	= 'yes';
					$active 							= $data['campaign'][0]->activate_time;
					$utformat							= date('d-m-Y',strtotime($active));
					$data['campaign'][0]->activate_time	= $utformat;
				}else{
					$data['campaign'][0]->activeaction_calc	= 'no';
				}
				
				if(!is_null($data['campaign'][0]->expire_time) && ($data['campaign'][0]->expire_time !='0000-00-00')){
					
					$data['campaign'][0]->expirationtion_calc	= 'yes';
					$active 							= $data['campaign'][0]->expire_time;
					$utformat							= date('d-m-Y',strtotime($active));
					$data['campaign'][0]->expire_time	= $utformat;
				}else{
					$data['campaign'][0]->expirationtion_calc	= 'no';
				}

				$data['msg']				= 'Campaign is successfully updated';
			
			}else{
				if(isset($_GET['clientid'])){
					$clientid					= $this->input->get('clientid');
					$id							= $this->Advertiser_Model->addcampaign($campaign, $clientid);
					$insertId 					= $this->db->insert_id();
					$data['msg']				= 'Campaign is successfully added';
				}
			}
			
			if(isset($data['targeting'][0]->targetid)){
				$data['target']			= '&targetid='.$data['targeting'][0]->targetid;
			}else{
				$data['target']			= '';
			}
			//	echo '<pre>';print_r($data);die;

			
			$this->load->view('advertiser/header', $data);
			$this->load->view('advertiser/leftsidebar', $data);
			$this->load->view("advertiser/compaign",	$data);
		}else{
			if(isset($_GET['clientid']) && isset($_GET['campaignid'])){
				$clientid					= $this->input->get('clientid');
				$campaignid					= $this->input->get('campaignid');
				$data['campaign']			= $this->Advertiser_Model->getcampaigns($clientid, $campaignid);
				
				$data['targeting']			= $this->Advertiser_Model->gettargeting($campaignid);
				if(isset($data['targeting'][0]->targetid)){
					$data['target']			= '&targetid='.$data['targeting'][0]->targetid;
				}else{
					$data['target']			= '';
				}
			
			
			}elseif(isset($_GET['clientid'])){
				$clientid					= $this->input->get('clientid');
				$clientDetails				= $this->Advertiser_Model->getadvertiser($clientid);
				if(isset($clientDetails[0])){
					$data['defaultCampaign']	= $clientDetails[0]->clientname;
				}
			}else{
				
				$advertiserList          = $this->Advertiser_Model->getadvertiser();
				if(!empty($advertiserList)){
					$data['advertiserIdString']  = "?clientid=".$advertiserList[0]->clientid;
					redirect('advertiser/compaign'.$data['advertiserIdString']);
				}else{
					$data['advertiserIdString']	= '';
				}
				//echo '<pre>';print_r($data['advertiserIdString']);
			}


			
			//add campaign
			
			if(isset($_GET['campaignid'])){
				if(isset($data['campaign'][0]->tracking_type)){
					$limit	= $data['campaign'][0]->tracking_type;
					$data['campaign'][0]->target_value	= $data['campaign'][0]->$limit;
				}
				
				
				if($data['campaign'][0]->activate_time != "0000-00-00"){
					
					$data['campaign'][0]->activeaction_calc	= 'yes';
					$active 							= $data['campaign'][0]->activate_time;
					$utformat							= date('d-m-Y',strtotime($active));
					$data['campaign'][0]->activate_time	= $utformat;
				}else{
					
					$data['campaign'][0]->activeaction_calc	= 'no';
				}
				
				if($data['campaign'][0]->expire_time != "0000-00-00" ){
					$data['campaign'][0]->expirationtion_calc	= 'yes';
					$active 							= $data['campaign'][0]->expire_time;
					$utformat							= date('d-m-Y',strtotime($active));
					$data['campaign'][0]->expire_time	= $utformat;
				}else{
					$data['campaign'][0]->expirationtion_calc	= 'no';
				}
			}
			
			//echo $data['campaign'][0]->activate_time.'<br>'.$data['campaign'][0]->expire_time;			
			//echo '<pre>';print_r($data);die;
											
			$this->load->view('advertiser/header', $data);
			$this->load->view('advertiser/leftsidebar', $data);
			$this->load->view("advertiser/compaign");
		}
	}
	
	
	
	function changebannerstatus(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$bannerId		= $this->input->post('bannerid');
		$status			= $this->User_Model->getbannerstatus($bannerId);
		if($status == 0){
			$newStatus	= 1;
		}else{
			$newStatus	= 0;
			
		}
		$result			= $this->User_Model->changebannerstatus($bannerId, $newStatus);
		echo json_encode(array('newstatus' => $newStatus));
	}
	
	function changecampaignstatus(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$campaignId		= $this->input->post('campaignid');
		$status			= $this->User_Model->getcampaignstatus($campaignId);
		if($status == 0){
			$newStatus	= 1;
		}else{
			$newStatus	= 0;
			
		}
		$result			= $this->User_Model->changecampaignstatus($campaignId, $newStatus);
		echo json_encode(array('newstatus' => $newStatus));
		

		
	}
	
	
	public function viewcompaign(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewcompaign';
		
		if(isset($_GET['clientid'])){
			$clientid					= $this->input->get('clientid');
			$data['campaign']			= $this->Advertiser_Model->getcampaigns($clientid);
		}elseif(isset($_GET['campaignid'])){
			$campaignid					= $this->input->get('campaignid');	
			$data['campaign']			= $this->Advertiser_Model->getcampaigns($campaignid);
		}else{
			$data['advertiserlist']			= $this->Advertiser_Model->getadvertiser();
			$clientId						= $this->Advertiser_Model->getclients($data['advertiserlist']);
	
			if(!(empty($clientId))){
				$data['campaign']			= $this->Advertiser_Model->getcampaigns($clientId);
			}else{
				$data['campaign']			= array();
			}
		}
		
		if(isset($_GET['key'])){
			$data['searchInput']		= $this->input->get('key');
		}
		
		//echo '<pre>';print_r($data);die;

		$data['activeaction']			= 'viewcompaign';
		$this->load->view('advertiser/header',$data);
		$this->load->view('advertiser/leftsidebar', $data);
		$this->load->view("advertiser/viewcompaign");
	}
	/**********End of Campaign Section*********************************************************/
	
	/**********Start of Banner Section*********************************************************/
	public function banner(){
		header('X-XSS-Protection: 0');
		
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'banner';
		
		$targetDirImage	= $GLOBALS['targetDirImage'];
		$targetDirVideo	= $GLOBALS['targetDirVideo'];
		$cacheDir 		= $GLOBALS['cacheDir'];
		$videoPath		= $GLOBALS['videoPath'];
		$data['deliveryPath']	= $GLOBALS['deliveryPath'];

		/************start of form submission handling*****/
		if ($this->input->post('submit')) {
		//	echo '<pre>';print_r($_POST);print_r($_FILES);die;
			$bannerType						= $this->input->post('type');
			$banner['description']			= $this->input->post('description');  

			if($bannerType == 'web'){
				include APPPATH.'/libraries/banner/standerdbanner.php';
			}
			if($bannerType == 'html5'){
				include APPPATH.'/libraries/banner/html5creative.php';
			}
			if($bannerType == 'html'){
				include APPPATH.'/libraries/banner/inlinevideo.php';
			}
			
			
			if($bannerType == 'exscrpt'){
				$banner['storagetype']		= 'exscrpt';
				$banner['contenttype'] 		= 'exscrpt';
				$banner['extag']			= $this->input->post('extag');
			}
			
			if($bannerType == 'exiframe'){
				$banner['storagetype']		= 'exiframe';
				$banner['contenttype'] 		= 'exiframe';
				$banner['extag']			= $this->input->post('extag');
			}
			$banner['comments']				= $this->input->post('comments');     
			$banner['keyword']				= $this->input->post('keyword');      
			$banner['weight']				= $this->input->post('weight');
			$banner['updated']				= $this->input->post('comments');   
			
			if(isset($_GET['bannerid'])){
				include APPPATH.'/libraries/banner/updatebanner.php';
			}else{
				include APPPATH.'/libraries/banner/newupdatebanner.php';
			}
			//echo '<pre>';print_r($data);die;
			$this->load->view('advertiser/header', $data);
			$this->load->view('advertiser/leftsidebar', $data);
			$this->load->view("advertiser/banner",	$data);
		/************end of form submission handling *****/
		
		
		}else{
				/****add banner to default campaign and advertiser****/
				if(!isset($_GET['campaignid'])){
					$defaultAdvertiser          		= $this->Advertiser_Model->getadvertiser();
					if(!empty($defaultAdvertiser)){
						$data['advertExist']		= true;
						$clientId					= $defaultAdvertiser[0]->clientid;
						$data['defaultAdvtCmpIdString']  = "?clientid=".$clientId;
						
						$defaultCampaign			= $this->Advertiser_Model->getcampaigns($clientId);
						if(!empty($defaultCampaign)){
							$data['cmpExist']	= true;
							$data['defaultAdvtCmpIdString']	= $data['defaultAdvtCmpIdString'].'&campaignid='.$defaultCampaign[0]->campaignid;
							redirect('advertiser/banner'.$data['defaultAdvtCmpIdString']);
						}else{
							$data['cmpExist']	= false;
						}
						
						
					}else{
						$data['defaultAdvtCmpIdString']	= '';
						$data['advertExist']		= false;
					}
				}
				
				
			if(!isset($_GET['type'])){
				if(isset($_GET['clientid']) && isset($_GET['campaignid']) && isset($_GET['bannerid'])){
					$clientid					= $this->input->get('clientid');
					$campaignid					= $this->input->get('campaignid');
					$bannerid					= $this->input->get('bannerid');
					$data['banner']				= $this->User_Model->getbanner($campaignid, $bannerid);
					if(isset($data['banner'][0]->url)){
						$lp				= $data['banner'][0]->url;
						if(strpos($lp, '&')){
							$lp	= str_replace('&', '%26', $lp);
						}
					}else{
						$lp		= "http://mediaconversion.com/";		
					}
					$data['banner'][0]->url	= $lp;
					
				}elseif(isset($_GET['clientid'])){
					$clientid					= $this->input->get('clientid');
					$clientDetails				= $this->User_Model->getadvertiser($clientid);
					if(isset($clientDetails[0])){
						$data['defaultCampaign']	= $clientDetails[0]->clientname;
					}
				}
				

				
				
				if(isset($data['banner'][0]->bannerid) && $data['banner'][0]->storagetype == 'html'){
					$clickurl					= $GLOBALS['deliveryCorePath'].'ckvast.php?bannerid='.$data['banner'][0]->bannerid;
					$data['videoclickurl']		= $clickurl;

					if($data['banner'][0]->multiple_banner_existence){
						$status					= "active";
						$vastInactiveBannerId	= $this->User_Model->getinactivevideoadid($data['banner'][0]->bannerid);
						$data['inactivevideoid']= $vastInactiveBannerId;
					}else{
						$status	= "";
						
					}
					$data['videos']				= $this->User_Model->getvideoad($data['banner'][0]->bannerid, '', $status);
					$data['videoclickurl']		= $clickurl;
				}
			}
			include APPPATH.'/libraries/banner/contentvideo.php';
			
				//echo '<pre>';print_r($data);print_r($data['videos']);print_r($data['banner']);die;
				
				
				
			//echo '<pre>';print_r($data);	
			$this->load->view('advertiser/header',$data);
			$this->load->view('advertiser/leftsidebar', $data);
			$this->load->view("advertiser/banner");
		}
	}
	
	
	

	public function viewbanner(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewbanner';
		if(isset($_GET['campaignid'])){
			$campaignid					= $this->input->get('campaignid');
			$data['banner']				= $this->Advertiser_Model->getbanner($campaignid, null, null);
			
		}elseif(isset($_GET['clientid'])){
			$data['banner']				= $this->Advertiser_Model->getbanner();	
			
		}else{
				$advertiserList								= $this->Advertiser_Model->getAdvertiser();
				$clientIds									= $this->Advertiser_Model->getclients($advertiserList);
				if(empty($clientIds)){
					$campaignIds							= array();
				}else{
					$campaignIds							= $this->Advertiser_Model->campaignIds($clientIds);
				}
			
				if(!empty($campaignIds)){
					$data['banner']				= $this->Advertiser_Model->getclientbanner($campaignIds);
				}else{
					$data['banner']				= array();
				}
		}

		
		//echo '<pre>';print_r($data['banner']);die;
		$this->load->view('advertiser/header', $data);
		$this->load->view('advertiser/leftsidebar',		$data);
		$this->load->view("advertiser/viewbanner",	$data);
	}
	
	function banner_acl(){
		$data['cat']						= 'inventory';
		$data['activeaction']				= 'banner_acl';
		$clientid							= $this->input->get('clientid');
		$campaignid							= $this->input->get('campaignid');
		$bannerid							= $this->input->get('bannerid');
		$data['banner'][0] 					= new stdClass();

		$data['banner'][0]->bannerid			= $bannerid;
		$data['banner'][0]->campaignid			= $campaignid;
		$data['banner'][0]->clientid			= $clientid;
		$data['bannerData']						= $this->Advertiser_Model->getBannerDetails($bannerid);
		
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);die;
			$input			= $this->input->post('acl');
			$aclPlugins		= '';
			$compiledLimitPrefix	= 'Max_check';
			$loopCount		= 0;
			$compiledLimit	= '';
			if(!empty($input)){
			foreach($input as $key => $value){
				if(isset($value['data']) && (!empty($value['data']))){
					
					if($loopCount >= 1){
						$compiledLimit		= $compiledLimit.' '.$value['logical'].' ';
					}
					$pluginsName	= $value['type'];
					$pluginsNameArr	= explode(':', $pluginsName);
					
					$compiledLimit 	= $compiledLimit.'Max_check'.$pluginsNameArr[1].'_'.$pluginsNameArr[2];	
					$aclPlugins		.= $pluginsName.',';
					if($value['type'] == 'deliveryLimitations:Client:Domain' || $value['type']=='deliveryLimitations:Client:Ip' || $value['type']=='deliveryLimitations:Time:Date'){
						if($value['type']=='deliveryLimitations:Time:Date'){
							$dateformat	 	= $value['data']['date'];
							$dateformatArr	= explode('-',$dateformat);
							$timestamp		= $dateformatArr[2].$dateformatArr[1].$dateformatArr[0];
							$limitVariables	= $timestamp;
							
						}else{
							$limitVariables	 = $value['data'];
						}
						
					}else{
						if(count($value['data']) > 1){
							$limitVariables	 = implode(',',$value['data']);
						}else{
							
							$limitVariables	 = $value['data'][0];
						}
					}
					
					$compiledLimit 	 = $compiledLimit."('".$limitVariables."','".$value['comparison']."')";
					
					$loopCount++;	
				}	
				
			}
			if($loopCount==0){
				$compiledLimit	= '';
				
			}
			
			
		
			$aclPlugins						= substr($aclPlugins, 0, strlen($aclPlugins)-1);
			$aclPlugins						= addslashes($aclPlugins);
			$compiledLimit					= addslashes($compiledLimit);
			$bannerCacheData     			= $this->Advertiser_Model->updatelimitation($bannerid, $aclPlugins, $compiledLimit);
			if(!empty($bannerCacheData)){
				$cacheArr		= array($bannerCacheData[0]);
				$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_'.$bannerid.'.php';
				file_put_contents($my_file, json_encode($cacheArr));
			}
			
			}
		}
	
		if(isset($_POST['action']['new'])){
			$acls						= array();
			$limitationDetails			= $this->Advertiser_Model->getlimitation($bannerid);
			if(strlen($limitationDetails->acl_plugins)) {
				$acl_plugins 				= explode('and', $limitationDetails->compiledlimitation);
				$pluginData				    = explode(',', $limitationDetails->acl_plugins);

				foreach ($acl_plugins as $key=>$acl_plugin) {
					if(!empty($limitationDetails->compiledlimitation)){
						$limitations 		= $acl_plugins[$key];
						$start				= strpos($limitations,'(')+2;
						$end				= strpos($limitations,')')-6;
						$length				= $end - $start;
						$strlen				= strlen($limitations);
						$compStart			= $strlen-4;
									
						$limitValue			= substr($limitations, $start, $length);
						$comp				= substr($limitations, $compStart, 2);
						$acls[$key]							= array(
							"ad_id"	=> $bannerid,
							"comparison" => $comp,
							"data" => 		$limitValue	,
							"executionorder" => $key,
							"logical" => 'and',
							"type" => $pluginData[$key]//$limitationDetails->acl_plugins
						);
					
						if($limitationDetails->acl_plugins == 'deliveryLimitations:Geo:City'){
							$cCode 				= explode(',', $limitValue);
							$acls[0]['state']	= $cCode[1];
							
						}
						$limitValueArr		= explode(',', $limitValue);
					}
					
				}

			}
			
			
						

			if(empty($acls)){
				$acls[0]								= array(
					"comparison" => '',
					"data" => 		'',
					"executionorder" => 0,
					"logical" => '',
					"type" => $_POST['type']
				);
			}else{
				$typeCount		= count($acls);
				$acls[$typeCount]								= array(
					"comparison" => '',
					"data" => 		'',
					"executionorder" => $typeCount,
					"logical" => '',
					"type" => $_POST['type']
				);
			}
			
			

		}else if(isset($_POST['action']['del'])){
			
			$aclPlugins		= '';
			$compiledLimit	= '';
			$this->Advertiser_Model->updatelimitation($bannerid, $aclPlugins, $compiledLimit);
			$acls							= array();
			
		 }else if(isset($_GET['action']['clear'])){
			$aclPlugins		= '';
			$compiledLimit	= '';
			$this->Advertiser_Model->updatelimitation($bannerid, $aclPlugins, $compiledLimit);
			$acls							= array();
			$url			= "?clientid=".$clientid."&campaignid=".$campaignid."&bannerid=".$bannerid;
			header('Location: '.$url);
		}else if(isset($_POST['action']['none'])){
			//echo '<pre>';print_r($_POST);die;
			$acls			= $_POST['acl'];
			$aclsCount		= count($acls);
			$acls[$aclsCount-1]['data']			= $_POST['acl'][$aclsCount-1]['data'][0];
			$acls[$aclsCount-1]['type'] 		= $_POST['acl'][$aclsCount-1]['type'];

			
			
			
		}else if(isset($_POST['action']['city'])){
			//echo '<pre>';print_r($_POST);die;
			$acls			= $_POST['acl'];
			$aclsCount		= count($acls);
			$acls[$aclsCount-1]['data']			= $_POST['acl'][$aclsCount-1]['data'][0];
			$acls[$aclsCount-1]['type'] 		= $_POST['acl'][$aclsCount-1]['type'];
			$acls[$aclsCount-1]['state']		= $_POST['acl'][$aclsCount-1]['data'][1];
			
			
			
        
		}else{
			$acls						= array();
			$limitationDetails			= $this->Advertiser_Model->getlimitation($bannerid);
			if(strlen($limitationDetails->acl_plugins)) {
				$acl_plugins 				= explode('and', $limitationDetails->compiledlimitation);
				$pluginData				    = explode(',', $limitationDetails->acl_plugins);
				/* echo '<pre>';print_r($acl_plugins);
				echo '<pre>';print_r($pluginData);die; */

				foreach ($acl_plugins as $key=>$acl_plugin) {
					if(!empty($limitationDetails->compiledlimitation)){
						$limitations 		= $acl_plugins[$key];
						$start				= strpos($limitations,'(')+2;
						$end				= strpos($limitations,')')-6;
						$length				= $end - $start;
						$strlen				= strlen($limitations);
						$compStart			= $strlen-4;
									
						$limitValue			= substr($limitations, $start, $length);
						$comp				= substr($limitations, $compStart, 2);
						$acls[$key]							= array(
							"ad_id"				=> $bannerid,
							"comparison" 		=> $comp,
							"data" 				=> $limitValue,
							"executionorder" 	=> $key,
							"logical" 			=> 'and',
							"type" 				=> $pluginData[$key]
						);
					
						if($pluginData[$key] == 'deliveryLimitations:Geo:City'){
							$cCode 					= explode(',', $limitValue);
							$acls[$key]['state']	= $cCode[1];
							
						}
						$limitValueArr		= explode(',', $limitValue);
					}
					
				}
					//echo '<pre>';print_r($acls);die;

			}
		}
		
		
		
		$aParams								= array('clientid'=>$clientid, 'campaignid'=>$campaignid, 'bannerid'=>$bannerid);
		
		$data['aclselect']						= MAX_displayAcls($acls, $aParams);
		
		
		$this->load->view('advertiser/header', $data);
		$this->load->view('advertiser/leftsidebar', $data);
		$this->load->view("advertiser/banner_acl", $data);
		
	}
	
	function linked_zone(){
		$data['cat']						= 'inventory';
		$data['activeaction']				= 'linked_zone';
		if(isset($_POST['submit'])){
		$clientid							= $this->input->post('clientid');
		$campaignid							= $this->input->post('campaignid');
		$bannerid							= $this->input->post('bannerid');
		}else{
			$clientid							= $this->input->get('clientid');
			$campaignid							= $this->input->get('campaignid');
			$bannerid							= $this->input->get('bannerid');
		}
		$data['banner'][0] 					= new stdClass();

		$data['banner'][0]->bannerid			= $bannerid;
		$data['banner'][0]->campaignid			= $campaignid;
		$data['banner'][0]->clientid			= $clientid;
		$bannerData								= $this->Advertiser_Model->getBannerDetails($bannerid);
		$data['bannerDetails']					= $bannerData;
		//echo '<pre>';print_r($bannerData);die;
		
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);die;
				if($_POST['includezone']){
					$zone  = $this->input->post('includezone');
					foreach($zone as $key => $value){
						$zoneid             = $key;
					}
					$msg			        = $this->User_Model->updateAdZoneAssoc($bannerid, $zoneid);
				//die;
					//echo $clientid.'<br>'.$campaginid.'<br>'.$bannerid.'<br>'.$affiliateid.'<br>'.$zoneid;die;
					$assocData		= array(
						'ad_id' => $bannerData->bannerid,
						'status' => $bannerData->status,
						'width' => $bannerData->width,
						'height' =>  $bannerData->height,
						'type' => $bannerData->storagetype,
						'contenttype' => $bannerData->contenttype,
						'weight' => $bannerData->weight,
						'block_ad' => '0',
						'cap_ad' => '0',
						'session_cap_ad' => '0',
						'compiledlimitation' => '',
						'acl_plugins' => NULL,
						'alt_filename' => '',
						'priority' => '0',
						'priority_factor' => '1',
						'to_be_delivered' => '1',
						'campaign_id' => $bannerData->campaignid,
						'campaign_priority' => $bannerDatapriority,
						'campaign_weight' => $bannerData->weight,
						'campaign_companion' => '0',
						'block_campaign' => '0',
						'cap_campaign' => '0',
						'session_cap_campaign' => '0',
						'show_capped_no_cookie' => '0',
						'client_id' => $bannerData->clientid,
						'expire_time' => $bannerData->expire_time,

					);
					//echo '<pre>';print_r($assocData);print_r($data);die;
					$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_zone_'.$zoneid.'.php';
					file_put_contents($my_file, json_encode($assocData));
					}
					redirect('advertiser/linked_zone?bannerid='.$bannerid.'&campaignid='.$campaignid.'&clientid='.$clientid);
				}
		
		$data['zoneAffiliate']					= $this->Advertiser_Model->getzoneAffiliate($bannerData);
		$data['linkedZones']					= $this->Advertiser_Model->getlinkedZones($bannerid);

		
		
		$this->load->view('advertiser/header', $data);
		$this->load->view('advertiser/leftsidebar', $data);
		$this->load->view("advertiser/banner-zone-link", $data);
	}
	
	
	/**********End of Banner Section*********************************************************/
	
	/**********Start of Statistics Section*********************************************************/
	
		public function adcampstats(){
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'adcampstats';
		$data['affiliateQueryString']   = '';
		
		if(isset($_GET['clientid'])){
			$clientId							= $this->input->get('clientid');
			$data['advertiser']					= $this->User_Model->getAdvertiser(null,$clientId);
		}else{
			$clientId   = null;
		}
		if(isset($_GET['campaignid'])){
			$campaignId							= $this->input->get('campaignid');
			$data['affiliateQueryString']		.= '&campaignid='.$campaignId;
			$data['campaign']					= $this->User_Model->getCampaigns(null,$campaignId,null);
		}else{
			$campaignId		= null;
		}
		if(isset($_GET['bannerid'])){
			$bannerId                 			= $this->input->get('bannerid');
			$data['affiliateQueryString']		.= '&bannerid='.$bannerId;

			$data['banner']						= $this->User_Model->getBanner($campaignId,$bannerId);
		}else{
			$bannerId                 		= null;
		}
		if(isset($_GET['affiliateid'])){
			$affiliateId                 		= $this->input->get('affiliateid');
			$data['affiliate']					= $this->User_Model->getWebsites($affiliateId);
		}else{
			$affiliateId                 		= null;
		}
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
		if(isset($_GET['clientid']) && isset($_GET['breakthrough'])){
			$breakthrough				= $this->input->get('breakthrough');
			if($breakthrough == 'affiliate'){
				if(isset($_GET['affiliateid'])){
					$data['advertiserStats'] 	= $this->Statistics_Model->advertiserWebsiteDailyStatus($clientId, $campaignId,$bannerId,$affiliateId, $startDate,$endDate);
				}else{
					$data['advertiserStats'] 	= $this->Statistics_Model->advertiserWebsiteStatus($clientId, $campaignId,$bannerId,$startDate, $endDate);
				}
			}
			
			if($breakthrough == 'banner'){
				if(isset($_GET['bannerid'])){
					$data['advertiserStats'] 	= $this->Statistics_Model->advertiserBannerDailyStatus($bannerId, $startDate,$endDate);
				}else{
					$data['advertiserStats'] 	= $this->Statistics_Model->advertiserBannerStatus($clientId, $campaignId, $startDate, $endDate);
				}
			}
			
			if($breakthrough == 'campaign'){
				if(isset($_GET['campaignid'])){
					$data['advertiserStats'] 			= $this->Statistics_Model->getadvertiserCampaignDailyStatistics($clientId,$campaignId,$startDate,$endDate);
				}else{
					$data['advertiserStats'] 			= $this->Statistics_Model->advertiserCampaignStatus($clientId,$startDate,$endDate);
				}
			}
			if($breakthrough == 'client'){
				$data['advertiserStats'] 	= $this->Statistics_Model->advertiserStats($clientId,$startDate,$endDate);
			}
		
		}else if(isset($_GET['clientid'])){
			$data['advertiserStats'] = $this->Advertiser_Model->advertiserDailyStats($clientId, $startDate, $endDate);
		
		}else{
			$data['advertiserStats'] = $this->Advertiser_Model->advertiserStats($clientId,$startDate,$endDate);
		}
		
		//echo '<pre>';print_r($data);die;
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		    = getPresetWithDateRange();
		
		$data['checkVideoAdvt']	= $this->Statistics_Model->checkVideoAdvt($clientId, $campaignId, $bannerId);
		$this->load->view("advertiser/adcampstats", $data);

		
	}
	
	function adcampvideostats(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'adcampstats';
		$data['affiliateQueryString']   = '';
		
		if(isset($_GET['clientid'])){
			$clientId							= $this->input->get('clientid');
			$data['advertiser']					= $this->User_Model->getAdvertiser(null,$clientId);
		}else{
			$clientId   = null;
		}
		if(isset($_GET['campaignid'])){
			$campaignId							= $this->input->get('campaignid');
			$data['affiliateQueryString']		.= '&campaignid='.$campaignId;
			$data['campaign']					= $this->User_Model->getCampaigns(null,$campaignId,null);
		}else{
			$campaignId		= null;
		}
		if(isset($_GET['bannerid'])){
			$bannerId                 			= $this->input->get('bannerid');
			$data['affiliateQueryString']		.= '&bannerid='.$bannerId;

			$data['banner']						= $this->User_Model->getBanner($campaignId,$bannerId);
		}else{
			$bannerId                 		= null;
		}
		if(isset($_GET['affiliateid'])){
			$affiliateId                 		= $this->input->get('affiliateid');
			$data['affiliate']					= $this->User_Model->getWebsites($affiliateId);
		}else{
			$affiliateId                 		= null;
		}
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
		
		if(isset($_GET['breakthrough'])){
			$breakthrough					= $this->input->get('breakthrough');
			if($breakthrough == 'client'){
				$entityType   = 'advertiser';
				$entityID	  = $clientId;
				
			}elseif($breakthrough == 'campaign'){
				$entityType   = 'campaign';
				$entityID	  = $campaignId;
				
			}elseif($breakthrough == 'banner'){
				$entityType   = 'banner';
				$entityID	  = $bannerId;
				
			}elseif($breakthrough == 'affiliate'){
				$entityType   = 'affiliate';
				$entityID	  = $affiliateId;
			}
			
			$data['VideoStats'] 	= $this->Statistics_Model->adCampVideoStats($entityType, $entityID, 'day', $startDate, $endDate);
		}
		
		
		//echo '<pre>';print_r($data);die;
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		= getPresetWithDateRange();
		
		
		//echo '<pre>';print_r($data);die;
		$this->load->view('advertiser/header', $data);
		$this->load->view('advertiser/leftsidebar', $data);
		$this->load->view("advertiser/adcampvideostats", $data);
	}
	/**********End of Statistics Section*********************************************************/

/******************************* Added By Riccha ************************************************/
public function deleteadvertiser(){	
	if ($_GET['advertiser_ids']) {
		$advertzId= trim($_GET['advertiser_ids'],",");
		$advertzId = explode(',', $advertzId);
	 }
	
	$data['cat']		= 'inventory';
	if($advertzId[0]=='main_0'){
		array_shift($advertzId);
	}
	//print_r($advertzId); die;
	foreach ($advertzId as $adv_value) 
	{
		$query_camp = $this->db->query("SELECT campaignid FROM `campaigns`  WHERE clientid = '$adv_value'");
		$res_camp = $query_camp->result_array();
		$res_camp11 = array_column($res_camp,'campaignid');
		$res_camp12 = implode(',',$res_camp11);
		// print_r($res_camp12); die;
	  	if(!empty($res_camp)){
			 
		$query = $this->db->query("SELECT bannerid FROM `banners`  WHERE campaignid IN ($res_camp12)");
		$res = $query->result_array();
		$res11 = array_column($res,'bannerid');
		$res12 = implode(',',$res11);
		//print_r($res12); die;
		}
		if(!empty($res)){
			$this->db->query("DELETE FROM `banners` WHERE bannerid IN ($res12)");
			$this->db->query("DELETE FROM `rv_data_summary_ad_hourly` WHERE creative_id IN ($res12)");
			$this->db->query("DELETE FROM `rv_ad_zone_assoc` WHERE ad_id IN ($res12)");
			$this->db->query("DELETE FROM `campaigns` WHERE campaignid IN ($res_camp12)");
			}
			 $this->db->query("DELETE FROM `clients` WHERE clientid = '$adv_value'");
	}
	redirect('advertiser/viewadvertiser');;
}

public function deletecampaigncheckbox()
{
	if ($_GET['campaign_ids']) 
	{
		$campaignid = trim($_GET['campaign_ids'],",");
		$ids = explode(',', $campaignid);
	}
	//print_r($ids); die;
	$data['cat']		= 'inventory';
	//$campIds			= $this->input->get('campaign_ids');
	$campIds			= $ids;

	if($campIds[0]=='main_00')
	{
		array_shift($campIds);
		//print_r($campIds); die;
	}
	  
	foreach ($campIds as $campId_value) 
	{
		$query = $this->db->query("SELECT bannerid FROM `banners`  WHERE campaignid = '$campId_value'");
		$res = $query->result_array();
		$res11 = array_column($res,'bannerid');
		$res12 = implode(',',$res11);
		//print_r($res); die;
		if(!empty($res))
		{

			$this->db->query("DELETE FROM `banners` WHERE bannerid IN ($res12)");
			$this->db->query("DELETE FROM `rv_data_summary_ad_hourly` WHERE creative_id IN ($res12)");
			$this->db->query("DELETE FROM `rv_ad_zone_assoc` WHERE ad_id IN ($res12)");
		}
			$this->db->query("DELETE FROM `campaigns` WHERE campaignid = '$campId_value'");
		 
	}
	redirect('advertiser/viewcompaign');
}
/************************************ Ends ******************************************************/
	
	


}