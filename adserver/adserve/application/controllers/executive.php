<?php 	

defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL ^ E_DEPRECATED);

class Executive extends Auth_Controller{
 protected $var1,$var2;
    function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		header("Access-Control-Allow-Origin: *");
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('Advertiser_Model');
		$this->load->model('User_Model');
		$this->load->model('Statistics_Model');
		$this->load->model('Update_Cache_Model');
	}
	

		function index(){
		//	echo 'sss';die;
		$data = array();
		$data['cat']			= 'home';
		$data['activeaction']	= 'home';
		$clientId				= $this->input->get('clientid');
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
		
		$data['advertiserStats'] = $this->Advertiser_Model->advertiserStats($clientId,$startDate,$endDate);
		//echo '<pre>';print_r($data['advertiserStats']);die;
		
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		    = getPresetWithDateRange();
		$this->load->view('executive/home', $data);
	}
	
	function profile(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'advetiseruserstart';
		$clientId						= $this->input->get('id');
		if($this->input->post('submit')){
			$userdata['username']	= $this->input->post('email');
			$userdata['password'] 	= $this->input->post('password');
			$userdata['firstname'] 	= $this->input->post('firstname');
			$userdata['lastname'] 	= $this->input->post('lastname');
			$userdata['date_created'] 		= date('Y-m-d H:i:s');
			
			if(isset($_GET['uid'])){
				$userId        		= $this->input->get('uid');
				$this->User_Model->updateuser($userId, $userdata);
				$data['msg'] 		= "Profile Is Successful Updated";
			}	
		}
		
		if(isset($_GET['uid'])){
			$userId        						= $this->input->get('uid');
			$data['profile']					= $this->Advertiser_Model->getAccountInfo($userId);
		}

		//echo '<pre>';print_r($data);die;
		$this->load->view('executive/profile', $data);

	}
	
	
	
	function advertiserCampaigns(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewcompaign';
		
		if(isset($_GET['clientid'])){
			$clientid					= $this->input->get('clientid');
			$data['campaign']			= $this->Advertiser_Model->getcampaigns($clientid);
		}
		
		//echo '<pre>';print_r($data);die;
		
		$data['activeaction']			= 'viewcompaign';
		$this->load->view('executive/header',$data);
		$this->load->view('executive/leftsidebar', $data);
		$this->load->view("executive/viewcompaign");
	}
	
	function campaignBanners(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewbanner';
		$campaignid						= $this->input->get('campaignid');
		$data['banner']					= $this->Advertiser_Model->getbanner($campaignid, null, null);
		
		//echo '<pre>';print_r($data);die;
		
		$data['activeaction']			= 'viewcompaign';
		$this->load->view('executive/header',$data);
		$this->load->view('executive/leftsidebar', $data);
		$this->load->view("executive/viewbanner");
	}
	
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
			$this->load->view('executive/header', $data);
			$this->load->view('executive/leftsidebar', $data);
			$this->load->view("executive/banner",	$data);
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
			$this->load->view('executive/header',$data);
			$this->load->view('executive/leftsidebar', $data);
			$this->load->view("executive/banner");
		}
	}
	
	function adcampstats(){
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'adcampstats';
		$data['affiliateQueryString']   = '';
		if(isset($_GET['clientid'])){
			$clientId							= $this->input->get('clientid');
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
			$breakthrough				= $this->input->get('breakthrough');
		}else{
			$breakthrough	= '';
		}
		
		if($breakthrough){
			
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
						$campaignId							= $this->input->get('campaignid');
						$data['advertiserStats'] 			= $this->Statistics_Model->getadvertiserCampaignDailyStatistics($clientId,$campaignId,$startDate,$endDate);
					}else{
						$data['advertiserStats'] 			= $this->Statistics_Model->advertiserCampaignStatus($clientId,$startDate,$endDate);
					}
				}
			if(isset($_GET['campaignid'])){
					$data['checkVideoAdvt']	= $this->Statistics_Model->checkVideoAdvt($clientId, $campaignId, $bannerId);
			}
		}else{
			$data['advertiserStats'] = $this->Advertiser_Model->advertiserDailyStats($clientId,$startDate,$endDate);
			$data['checkVideoAdvt']	= $this->Statistics_Model->checkVideoAdvt($clientId, $campaignId, $bannerId);

		}
		
		$data['breakthrough'] = $breakthrough;
		
		//echo '<pre>';print_r($data);die;
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		    = getPresetWithDateRange();

		$this->load->view("executive/adcampstats",$data);
	}
	
	function adcampvideostats(){
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
			$data['breakthrough'] = $breakthrough;
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
		}else{
			$data['breakthrough'] = '';
		}
		
		
		//echo '<pre>';print_r($data);die;
		require_once APPPATH.'libraries/statistics/dateTimeFilter.php';
		$data['date'] 		= getPresetWithDateRange();
		
		
		//echo '<pre>';print_r($data);die;
		$this->load->view('executive/header', $data);
		$this->load->view('executive/leftsidebar', $data);
		$this->load->view("executive/adcampvideostats", $data);
	}
	
	
}

