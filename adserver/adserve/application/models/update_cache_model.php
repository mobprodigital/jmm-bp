<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Update_Cache_Model extends CI_Model {
	function __construct(){
		/* Call the Model constructor */
		parent::__construct();
		$this->load->database();
	}
	
	function getBannerCacheData($bannerid){
		$this->db->select("*,banners.status as banner_status,campaigns.status as campaign_status");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		$this->db->where('banners.bannerid', $bannerid);
		
		$query 			= $this->db->get();
		$result			= $query->row_array();
		return $result;
	}
	
	function updateCampaignBannerCacheData($campaign, $campaignid){
		$this->db->select("*,banners.status as banner_status,campaigns.status as campaign_status");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		$this->db->where('banners.campaignid', $campaignid);
		
		$query 			= $this->db->get();
		$result			= $query->result_array();
		//echo '<pre>';print_r($result[0]->bannerid);die;

		if(!empty($result)){
			foreach($result as $key => $value){
				$bannerid       = $result[$key]['bannerid'];
				$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_'.$bannerid.'.php';
				if($result[$key]['storagetype'] == 'web'  || $result[$key]['storagetype'] == 'html5'){
					$cacheArr				= array($result[$key]);
						file_put_contents($my_file, json_encode($cacheArr));
					
					
				}elseif($result[$key]['storagetype'] == 'html'){
						$completeArr 			= json_decode(file_get_contents($my_file), true);
						$videodata				= $completeArr[1];
						$cacheArr				= array($result[$key], $videodata);
						file_put_contents($my_file, json_encode($cacheArr));
					
				}
			}
		}
		return $result;
	}
}