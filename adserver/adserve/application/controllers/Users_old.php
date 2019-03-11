<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL ^ E_DEPRECATED);

class Users extends CI_Controller{
 protected $var1,$var2;
    function __construct() {
         parent::__construct();
		/*  if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        } */
		date_default_timezone_set('Asia/Kolkata');
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('User_Model');
    }
	
	
	function propelleradsrequesturl(){
		$now 					= time();
		$query 					= "INSERT INTO `propeller_request` (`datetime`) VALUES (FROM_UNIXTIME(".$now."))";
		$result 				= $this->db->query($query);
		header('Location:http://ubercoolstyle.com/user/register?aid=114936&pid=&tid=27677&visitor_id=1234');
	}
	
	function propelleradsconversionurl(){
		$now 					= time();
		$query 					= "INSERT INTO `propeller_conversion` (`datetime`) VALUES (FROM_UNIXTIME(".$now."))";
		$result 				= $this->db->query($query);
		$queryString			= "aid=".$_GET['aid']."&pid=".$_GET['aid']."&tid=".$_GET['aid']."&visitor_id=".$_GET['visitor_id'];          

		//$pixel 	= "<iFrame src='http://ad.propellerads.com/conversion.php?".$queryString."'></iFrame>"; 
		$pixel 	= "<iFrame src='http://ad.propellerads.com/conversion.php?".$queryString."'></iFrame>"; 		
		echo $pixel; 
		
	}
	
	function integrationreport(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        } 
		$data['cat']				= 'statistics';
		$data['activeaction']		= 'integrationreport';
		$reportData					= $this->User_Model->fetchintegrationdata();
		$request					= $reportData[0];
		$conversion					= $reportData[1];
		//echo '<pre>';print_r($request);print_r($conversion);die;
		 foreach($request as $key => $value){
			$data['reportData'][$key]['cdate']	= $value->cdate;
			$data['reportData'][$key]['reqst']	= $value->total_count;
			if($value->cdate == $conversion[$key]->cdate){
				$data['reportData'][$key]['conversion']	= $conversion[$key]->total_count;
				
			}else{
				$data['reportData'][$key]['conversion']	= 0;
				
			}
		} 
		//echo '<pre>';print_r($reportData);die;

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/intergrationreport", $data);
		
	}
	
	public function track(){
		$now 		= time()+23;
		$bannerId	= 49;
		$zoneId		= 23;
		$eventid	= 1;
		$query		= "INSERT INTO `data_bkt_c` (`interval_start` ,`creative_id` ,`zone_id` ,`count`)
					VALUES (
					FROM_UNIXTIME(".$now."), '".$bannerId."', '".$zoneId."','8'
					)";
		
		$result =  $this->db->query($query);
		
	}
	public function starttrack(){
		$now 		= time();
		$bannerId	= 49;
		$zoneId		= 23;
		$eventid	= 1;
		$query		= "INSERT INTO `data_bkt_c` (`interval_start` ,`creative_id` ,`zone_id` ,`count`)
					VALUES (
					FROM_UNIXTIME(".$now."), '".$bannerId."', '".$zoneId."','8'
					)";
		$result =  $this->db->query($query);
	}
	
	
	
	
	
	public function getevent(){
		$now 			= time();
		$event			= $this->input->get('event');
		$bannerId		= $this->input->get('bannerid');

		if(isset($_GET['time'])){
			$eventtime		= $this->input->get('time');
		}else{
			$eventtime		= 0;
			
		}
		if(isset($_GET['src'])){
			$zoneId			= $this->input->get('src');
		}else{
			$zoneId			= 0;
			
		}
		
		if($event == 'add_duration'){
			$eventid	= 1;
						  
		}elseif($event == 'firstquartile'){
			$eventid	= 2;
			
		}elseif($event == 'midpoint'){
			$eventid	= 3;	
			
		}elseif($event == 'thirdquartile'){
			$eventid	= 4;
			
		}elseif($event == 'complete'){
			$eventid	= 5;
			
		}elseif($event == 'skip_time'){
			$eventid	= 6;
		}elseif($event == 'mute_time'){
			$eventid	= 10;
			
		}elseif($event == 'unmute_time'){
			$eventid	= 11;
			
		}elseif($event == 'content_duration'){
			$eventid	= 7;
			
		}elseif($event == 'pause_time'){
			$eventid	= 8;
			
		}elseif($event == 'play_time'){
			$eventid	= 9;
		
		}elseif($event == 'impression'){
			$eventid	= 13;
							
		}elseif($event == 'clicks'){
			$eventid	= 12;
			
		}else{
			$eventid	= 1;
		}
		
		if($eventid==12){
			$query 					= "INSERT INTO `data_bkt_c` (`interval_start`,`creative_id`)
					VALUES (FROM_UNIXTIME(".$now."), '".$bannerId."')";
			
			
		}elseif($eventid==13){
			$query 					= "INSERT INTO `data_bkt_m` (`interval_start`,`creative_id`)
					VALUES (FROM_UNIXTIME(".$now."), '".$bannerId."')";
			
		}else{
			$query	= "INSERT INTO `data_bkt_vast_e` (`interval_start` ,`creative_id` ,`zone_id` ,`vast_event_id`,`count`)
					VALUES (
					FROM_UNIXTIME(".$now."), '".$bannerId."', '".$zoneId."', '".$eventid."','8'
					)";
			
		}
		$result =  $this->db->query($query); 
	}
	
	public function videoevent(){
		$now 			= time();
		$bannerId		= 24;
		$pastDays		= 2;
		$zoneId			= 1;
		$stop 			= $now - $pastDays*86400;
		while($now > $stop) {
			for($eventId = 1;$eventId <= 9; $eventId++) {
				// generate events inversely proportional to the event id, 
				// also make sure 25% happens more often than 50%
				$count = ceil(rand(1, 1000) * 1/ ($eventId==2?3:($eventId==3?2:$eventId)));
				$query = "INSERT INTO `data_bkt_vast_e` (
							`interval_start`,
							`creative_id`,
							`zone_id`,
							`vast_event_id`,
							`count`
							)
							VALUES (
							FROM_UNIXTIME(".$now."), '".$bannerId."', '".$zoneId."', '".$eventId."', '".$count."'
							)";
				$result =  $this->db->query($query);
				
			}
			$now = strtotime("1 hour ago", $now);
		}
		echo $now;
		
	}
	
	public function videoimpression(){
		$this->User_Model->setvideoevent();
	}
	
	public function videoclicks(){
		$this->User_Model->setvideoevent();
	}
	
	
	public function vasttags(){
		$bannerid				= $this->input->get('bannerid');
		$banner					= $this->User_Model->getbanner(null, $bannerid, true);
		$vast					= $this->User_Model->getvideoad($bannerid, true);
		
		
		//echo '<pre>';print_r($vast);print_r($banner);die;
		$bannerdata 			= json_decode(json_encode($banner), True);
		$vastdata 				= json_decode(json_encode($vast), True);
		
		$campaignId				= $banner->campaignid;
		$campaignDetails		= $this->User_Model->campaigndetails($campaignId);
		$campaginImpression		= $campaignDetails[0]->target_impression;
		
		$totalImpression			= $campaignDetails[0]->views;
		$totalTrackImpressionArr	= $this->User_Model->totalvideoimpression($bannerid);
		$todayimpression			= $this->User_Model->todayvideoimpression($bannerid);


		if(!empty($totalTrackImpressionArr)){
			$totalTrackImpression	= $totalTrackImpressionArr[0]['impcount'];
		
		}else{
			$totalTrackImpression	= 0;
		}
		
		if(!empty($todayimpression)){
				$todayimpressionCount	= $todayimpression[0]['impcount'];
			}else{
				$todayimpressionCount	= 0;
			}
		//echo '<pre>';print_r($banner);die;
		
		//echo $todayimpressionCount."<br>".$campaginImpression;die;
		if($totalImpression > $totalTrackImpression){
			if($todayimpressionCount < $campaginImpression){
				$vastdata['vast_thirdparty_impression']	= base_url().'users/getevent?bannerid='.$bannerid."&event=impression";
				$vastdata['third_party_click']			= base_url().'users/getevent?bannerid='.$bannerid."&event=clicks";
				$vastdata['start_pixel']				= base_url().'users/getevent?bannerid='.$bannerid."&event=add_duration";
				$vastdata['quater_pixel']				= base_url().'users/getevent?bannerid='.$bannerid."&event=firstquartile";
				$vastdata['mid_pixel']					= base_url().'users/getevent?bannerid='.$bannerid."&event=midpoint";
				$vastdata['third_quater']				= base_url().'users/getevent?bannerid='.$bannerid."&event=thirdquartile";
				$vastdata['end_pixel']					= base_url().'users/getevent?bannerid='.$bannerid."&event=complete";
				if($banner->ext_bannertype ==  'upload_video'){
					echo $vasttags					= renderVastOutputForThirdParty($bannerdata, $vastdata);
				}else{
					//echo '<pre>';print_r($bannerdata);print_r($vastdata);die;
					echo $vasttags					= renderVastOutput($bannerdata, $vastdata);
				}
			}else{
				echo $renderdata				= errorvast();
			}
		}else{
				echo $renderdata				= errorvast();
		}
	}
	
	
	public function  generatevasttags(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'generatevasttags';
		if(isset($_GET['clientid']) && isset($_GET['campaignid']) && isset($_GET['bannerid'])){
			$clientid				= $this->input->get('clientid');
			$campaignid				= $this->input->get('campaignid');
			$bannerid				= $this->input->get('bannerid');
			$bannerdata				= $this->User_Model->getbanner($campaignid, $bannerid);
			$data['banner']			= $bannerdata;
			//echo '<pre>';print_r($bannerdata);die;
		}
		$cb 		= floor(rand(1,20)*99999999999);
		$url		= $bannerdata[0]->url;
		$tags		= base_url().'users/vasttags?bannerid='.$bannerdata[0]->bannerid.'&cb='.$cb.'&campiagnid='.$campaignid."&vast=2";
		$data['tags']	= $tags;
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/vasttags", $data);
	} 
	
	
	public function targeting(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']								= 'inventory';
		$data['activeaction']						= 'targeting';
		$data['banner1'][0]['clientid']				= $this->input->get('clientid');
		$data['banner1'][0]['campaignid']			= $this->input->get('campaignid');
		$data['banner1'][0]['bannerid']				= $this->input->get('bannerid');
		$data['banner'][0]							= (object)$data['banner1'][0];
		
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);die;
			$target['type']					= $this->input->post('targeting');
			$target['campaignid']			= $this->input->get('campaignid');
			$target['countryid']			= $this->input->post('country');
			$target['stateid']				= $this->input->post('state');
			$target['cityid']				= $this->input->post('city');
			//$target['browsername']		= $this->input->post('browsername');
			//$target['mobiletype']			= $this->input->post('mobiletype');
			if(isset($_GET['targetid'])){
				$targetid			= $this->input->get('targetid');
				$this->User_Model->addtargeting($targetid, $target);
				$data['msg']				= 'targeting constraint updated successfully';


			}else{
				$this->User_Model->addtargeting(null, $target);
				$data['msg']		= 'targeting constraint added successfully';

				
			}
			
			
			
		}
		
		
		
		if(isset($_GET['targetid'])){
			$targetid		= $this->input->get('targetid');
			$campaignid		= $this->input->get('campaignid');
			

			$targetDetail			= $this->User_Model->gettargeting($campaignid, $targetid);
			$data['type']			= $targetDetail[0]->type;
			$data['target']			= '&targetid='.$targetid;

			$data['country']		= $this->User_Model->getname($targetDetail[0]->countryid);
			$data['state']			= $this->User_Model->getname($targetDetail[0]->stateid);
			$data['city']			= $this->User_Model->getname($targetDetail[0]->cityid);
		}else{
			$data['target']			= '';

		}
		

		
		//echo '<pre>';print_r($data);die;
		$data['objAllCountries']					= $this->User_Model->getcountrylist();
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/targeting", $data);
		
	}
	
	function getstate(){
		$locationId 					= $_POST["location_id"];
		$locationType 					= $_POST["location_type"];
		$data							= $this->User_Model->getstate($locationId, $locationType);
		echo $data;
	}
	function getcity(){
		$locationId 					= $_POST["location_id"];
		$locationType 					= $_POST["location_type"];
		$data							= $this->User_Model->getcity($locationId, $locationType);
		echo $data;
	}
	
	
	public function getexscrpt(){
		$bannerid				= $this->input->get('bannerid');
		$bannerData				= $this->User_Model->getbanner(null, $bannerid,null);
		$this->adimpression($bannerid); 
				/* var z0="";
		if(B5()){
		z0=r16+'/fm/'+i9+'/'+n11+'/'+a9+'/fm.js'+'?c='+n11+'&a='+a35+'&f='+z38+'&n='+i9+'&r='+a14+'&d='+a9+'&adm='+r17+'&q='+n31+'&$='+zd_$+p11+i31+'&s='+y7+d27+y38+w30+d35+o31+'&ct='+y37+z32+'&z='+Math.random()+'&tt=0'+a30+'&tz='+y33+'&fw='+t30+'&fh='+c35+'&mw='+o36+'&mh='+o37+'&mxw='+a37+'&mxh='+o32+'&pu='+U15(true,v6)+'&ru='+((d20!='')?encodeURI(d20.split("?")[0]):F14(true))+'&pi='+zd_pg_id+'&apv='+q38+'&ap='+n36+'&ovr='+n38+'&ove='+r35+'&ce='+r0+'&zpu='+F11(true)+'&tpu='+(F16(v6));
		z0='<scr'+'ipt language="javascript" src="'+z0+'" charset='+r0+'></scr'+'ipt>';
		}
		var i20=B0("ZEDOIDA");
		if(!(i20=="OPT_OUT"&&a9==15)){
		document.write(z0);
		} */
		
		$html 			= $bannerData[0]->extag;
		$needle 		= '"';
		$lastPos 		= 0;
		$count			= 0;
		$positions 		= array();
		while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
			if($count==2){
				break;
				
			}
			$count		 	= $count+1;
			$positions[] 	= $lastPos;
			$lastPos 		= $lastPos + strlen($needle);
		}
		$impressionUrl			= base_url()."users/adimpression?bannerid=".$bannerid;
		$start					= $positions[0]+1;
		$length					= $positions[1]-$positions[0]-1;
		
		$src					= substr($bannerData[0]->extag, $start, $length);
		$noscript				= substr($bannerData[0]->extag, strpos($bannerData[0]->extag,'<noscript>'));
				
		echo $invocationcode	= exscrptInvocationTag($src, $noscript, $impressionUrl);
		
	}
	
	
	public function invocation(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'invocation';
		$invocationCode					= "";
		if(isset($_GET['clientid']) && isset($_GET['campaignid']) && isset($_GET['bannerid'])){
			$clientid				= $this->input->get('clientid');
			$campaignid				= $this->input->get('campaignid');
			$bannerid				= $this->input->get('bannerid');
			$bannerData				= $this->User_Model->getbanner($campaignid, $bannerid);
			$bannerType				= $bannerData[0]->storagetype;
			$clickTag				= base_url()."users/adtrack?bannerid=".$bannerid;

			
			if($bannerType == 'web'){
				if(isset($_GET['codetype']) && $_GET['codetype'] == 'adframe'){
					$invocationCode			= generateIframeInvocationCode(1, $bannerid);
				}else{
					$invocationCode			= generateInvocationCode(1, $bannerid);
				}
				
			}elseif($bannerType == 'html'){
				if(isset($_POST['thirdpartytrack'])){
					$thirdPartyServer	= $this->input->post('thirdpartytrack');
					
				}else{
					$thirdPartyServer	= null;
				}
				$invocationCode			= generateVideoInvocationCode(1, $bannerid,$clickTag, $thirdPartyServer);
			
			}elseif($bannerType == 'html5'){
				if(isset($_POST['thirdpartytrack'])){
					$thirdPartyServer	= $this->input->post('thirdpartytrack');
					
				}else{
					$thirdPartyServer	= null;
				}
				$clickTag				= base_url()."users/adtrack?bannerid=".$bannerid;
				$invocationCode			= generateHtml5InvocationCode(1, $bannerid, $clickTag, $thirdPartyServer);
			
			}elseif($bannerType == 'exscrpt'){
				$html 			= $bannerData[0]->extag;
				$needle 		= '"';
				$lastPos 		= 0;
				$count			= 0;
				$positions 		= array();
				while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
					if($count==2){
						break;
						
					}
					$count		 	= $count+1;
					$positions[] 	= $lastPos;
					$lastPos 		= $lastPos + strlen($needle);
				}
				//echo $bannerData[0]->extag;
				//echo '<pre>';print_r($positions);
				$impressionUrl			= base_url()."users/adimpression?bannerid=".$bannerid;
				$start					= $positions[0]+1;
				$length					= $positions[1]-$positions[0]-1;
				
				$src					= substr($bannerData[0]->extag, $start, $length);
				$noscript				= substr($bannerData[0]->extag, strpos($bannerData[0]->extag,'<noscript>'));
				
				$invocationCode			= '<script type="text/javascript" src="'.base_url().'users/getexscrpt?bannerid='.$bannerid.'"></script>';
				//$invocationCode		= generatetagforscripttag($src, $noscript, $impressionUrl);
				
				
				
			}elseif($bannerType == 'exiframe'){
				$trackUrl				= base_url()."/users/adimpression?bannerid=".$bannerid;
				$invocationCode			= $bannerData[0]->extag;//generatescriptforextranaliframe($bannerid);
				$invocationCode			.= "<script type='text/javascript' src='".$trackUrl."'></script>";
			}
			$data['banner']				= $bannerData;
		}
		
		$data['invocationCode']			= $invocationCode;
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/invocation", $data);
	}
	
	public function adimpression($id){
		$bannerid				= $id;
		$ip						= "";
		$id						= $this->User_Model->adimpression($ip, $bannerid, 1);
		return true;

	}
	
	
	
	public function rendervideoad(){
		if(isset($_GET['bannerid'])){
			$now 					= time();
			$bannerid				= $this->input->get('bannerid');
			$ip						= $this->input->get('domain');
			$dfpClickUrl			= '';
			if(isset($_GET['adurl'])){
				$Original_url		= $_SERVER['QUERY_STRING'];
				$first_index 		= stripos($Original_url,"&click");
				$first_string 		= substr($Original_url,$first_index);
				$second_index 		= stripos($first_string,"&ord=");
				$dfpClickUrl 		= substr($first_string,strlen("&click")+1,$second_index-strlen("&ord=")-2);
				
				
			}
			
			$clientIP				= $_SERVER['REMOTE_ADDR'];
			$this->User_Model->video_adrequest($ip, $clientIP, $bannerid);
			$query 					= "INSERT INTO `data_bkt_m` (`interval_start`,`creative_id`,`zone_id`)
					VALUES (FROM_UNIXTIME(".$now."), '".$bannerid."', '".$ip."')";
			//$result 				=  $this->db->query($query);
			
			
			$bannerdata				= $this->User_Model->getbanner(null, $bannerid);
			$campaignId				= $bannerdata[0]->campaignid;
			$campaignStatus			= $this->User_Model->getcampaignstatus($campaignId);
			$multipleAdCheck 		= $this->User_Model->checkmultipleBannerType($bannerid);
			if($multipleAdCheck->multiple_banner_existence){
				
				$status		= 'active';
						
			}else{
				$status		= '';
						
			}
			$vastdata							= $this->User_Model->getvideoad($bannerid, null, $status);
			//echo '<pre>';print_r($vastdata);die;
			$content							= $this->User_Model->getcontentvideo($vastdata[0]->content_video);
			if(!empty($content)){
				$data['vidcontent1']			= $content->name;
				if($content->source !=""){
					$data['source']				= "source:".$content->source;
				}else{
					$data['source']				= "";
					
				}
			}else{
				$data['source']					= "";
				$data['vidcontent1']			= "";

				
			}
			
			
					$limitationTypes			= $this->User_Model->getlimitation($bannerid);
					$row['acl_plugins']			= $limitationTypes->acl_plugins;
					//echo $limitationTypes[0]->compiledlimitation;die;
					if(strlen($row['acl_plugins'])) {
						$acl_plugins = explode('and', $limitationTypes->compiledlimitation);
						foreach ($acl_plugins as $acl_plugin) {
							@eval('$result = (' . $acl_plugin . ');');

						}
					}
					
					/* if($result && $campaignStatus){
					
						$renderdata				= adRenderVideo($bannerdata, $vastdata, $data['vidcontent1'], $data['source']);
					
					}else{
						$renderdata				= "";
					} */
					
					$campaignDetails		= $this->User_Model->campaigndetails($campaignId);
			$campaginImpression		= $campaignDetails[0]->target_impression;
			$campaginCapping		= $campaignDetails[0]->capping;
			
			
			$totalImpression			= $campaignDetails[0]->views;
			$totalTrackImpressionArr	= $this->User_Model->totalvideoimpression($bannerid);

			if(!empty($totalTrackImpressionArr)){
				$totalTrackImpression	= $totalTrackImpressionArr[0]['impcount'];
			
			}else{
				
				$totalTrackImpression	= 0;
			}
			
			
			$todayimpression		= $this->User_Model->todayvideoimpression($bannerid, $ip);
			if($totalImpression > $totalTrackImpression){
				if(!empty($todayimpression)){
					$todayimpressionCount	= $todayimpression[0]['impcount'];
				}else{
					$todayimpressionCount	= 0;
				}
				
				if($todayimpressionCount < $campaginImpression){
					if($campaignStatus){
						$renderdata				= adRenderVideo($bannerdata, $vastdata, $data['vidcontent1'], $data['source'], $dfpClickUrl, $ip);
					}else{
						$renderdata			= '';
					}
				}else{
					$renderdata			= '';
					
				}
			}else{
				$renderdata			= '';
				
			}
					
					
					
			/* if($bannerdata[0]->ext_bannertype == 'upload_video'){
				$vastdata				= $this->User_Model->getvideoad($bannerid, null, $status);
				//print_r($vastdata);die;
				$renderdata				= adRenderVideo($bannerdata, $vastdata, $data['vidcontent1'],$data['source']);
			}else{
				$vastdata				= $this->User_Model->getvideoad($bannerid, null, $status);
				//echo '<pre>';print_r($vastdata);die;
				$renderdata				= adRenderVideo($bannerdata, $vastdata, $data['vidcontent1'],$data['source']);
			} */
			//echo '<pre>';print_r($vastdata);print_r($bannerdata);die;
			echo $this->MAX_javascriptToHTML($renderdata, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));
		}	
	}
	
	
	public function renderextiframead(){
		$bannerid				= $this->input->get('bannerid');
		$ip						= $this->input->get('domain');
		$bannerData				= $this->User_Model->getbanner(null, $bannerid);
		$id						= $this->User_Model->adimpression($ip, $bannerid, 1);
		echo $bannerData[0]->extag;
	}
	
	function rendercreativead(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'renderad';
		if(isset($_GET['bannerid'])){
			$bannerid				= $this->input->get('bannerid');
			if(isset($_GET['clickTag'])){
				$clickTag				= $this->input->get('clickTag');			
			
			}else{
				
				$clickTag				= base_url().'users'.'/adtrack?bannerid='.$bannerid;
			}
			
			$bannerData				= $this->User_Model->getbanner(null, $bannerid);
			$ip						= $this->input->get('url');
			$dfpClickUrl			= '';
			$clientIp				= $_SERVER['REMOTE_ADDR'];
			if(isset($_GET['adurl'])){
				  $Original_url		= $_SERVER['QUERY_STRING'];
				  $first_index 		= stripos($Original_url, "&click");
				  $first_string 	= substr($Original_url, $first_index);
				  $second_index 	= stripos($first_string, "&ord=");
				  $dfpClickUrl 		= substr($first_string, strlen("&click")+1,$second_index-strlen("&ord=")-2);
			}
			$clientIp				= $_SERVER['REMOTE_ADDR'];
			$this->User_Model->adrequest($ip, $clientIp, $bannerid);

			
			$campaignId				= $bannerData[0]->campaignid;
			$campaignDetails		= $this->User_Model->campaigndetails($campaignId);
			$campaginImpression		= $campaignDetails[0]->target_impression;
			$campaginCapping		= $campaignDetails[0]->capping;
			//echo '<pre>';print_r($campaignDetails);die;
			
			$totalImpression			= $campaignDetails[0]->views;
			$totalTrackImpressionArr	= $this->User_Model->totalimpression($bannerid);

			if(!empty($totalTrackImpressionArr)){
				$totalTrackImpression	= $totalTrackImpressionArr[0]['impcount'];
			
			}else{
				
				$totalTrackImpression	= 0;
			}
			
			
			$todayimpression		= $this->User_Model->todayimpression($bannerid, $ip);
			if($totalImpression > $totalTrackImpression){
				if(!empty($todayimpression)){
					$todayimpressionCount	= $todayimpression[0]['impcount'];
				}else{
					$todayimpressionCount	= 0;
				}
				
				//echo $todayimpressionCount."-".$campaginImpression;
				if($todayimpressionCount < $campaginImpression){
					$clientOnedayVisit			= $this->User_Model->clientOnedayvisit($bannerid, $clientIp);
					
					//$pattern 							= "/(?<=href=(\"|'))[^\"']+(?=(\"|'))/";
					
					
					if($bannerData[0]->storagetype == 'html5'){
						//echo $bannerData[0]->url;die;
						$bannerData[0]->htmltemplate 		= str_replace($bannerData[0]->url , $clickTag, $bannerData[0]->htmltemplate);
					}
					
					//echo '<pre>';print_r($bannerData[0]->htmltemplate);die;
					$limitationTypes			= $this->User_Model->getlimitation($bannerid);
					$row['acl_plugins']			= $limitationTypes->acl_plugins;
					//echo $limitationTypes[0]->compiledlimitation;die;
					$result			=  true;
					
					if(strlen($row['acl_plugins'])) {
						$acl_plugins = explode('and', $limitationTypes->compiledlimitation);
						foreach ($acl_plugins as $acl_plugin) {
							@eval('$result = (' . $acl_plugin . ');');

						}
					}
					
					if($result){
						if($bannerData[0]->description == 'micromax_interstatial'){
							if($dfpClickUrl && !(isset($_GET['iframe']))){
								$creativeUrl		= base_url()."users/rendercreativead?bannerid=".$bannerid;
								$ord				= floor(rand()*9999999);
								$loc				= $_GET['loc'];
								$url				= $ip;
								$compRedirectUrl	= $creativeUrl."&click=".$dfpClickUrl."&ord=".$ord."&url=".$url."&loc=".$loc."&iframe=true";

								$ifm				= "";

								$sourceSrc	= "https://www.mediaconversion.com/report/newMobilePlayer/";
								$ifm		= "";
								$ifm		.= "<script src='".$sourceSrc."jquery.js'></script>";
								$ifm		.= "<script src='https://mediaconversion.com/report/micromaxClose/iframebuster.js'></script>";
								$ifm 		.= "<script type='text/javascript'>
								

								var redirectUrl		= '".$compRedirectUrl."';
								</script>";
								echo $this->MAX_javascriptToHTML($ifm, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));
							
							}else if(isset($_GET['iframe'])){
									
								$bannerData[0]->htmltemplate = str_replace('<img is="gwd-image" source="https://mediaconversion.com/report/micromaxClose/close_btn.png" id="gwd-image_15" class="gwd-img-122p">','',$bannerData[0]->htmltemplate);
															
								$headerScript	= '<head><script src="https://www.mediaconversion.com/report/newMobilePlayer/jquery.js"></script>
    <script>
		  jQuery(document).ready(function(){ 
				pppinterval = setInterval(function(){
						if( $("#mc-interstitial") ) { 
							
							console.log("hello");
							$("#gwd-taparea_4").click(function(){
								window.open("'.$dfpClickUrl.'","_blank");
							});
							
							clearInterval(pppinterval); 
						}				
					}, 1000); 
					
					});
		</script>'; 
					$creativeCode	= str_replace('<head>', $headerScript, $bannerData[0]->htmltemplate);
					echo $creativeCode;
/* 					$("#gwd-taparea_6").click(function(){$("#mc-interstitial").hide();$("#hidepop").hide();})							
 */
				/* 				
								$headerScript	= '<head><script src="https://www.mediaconversion.com/report/newMobilePlayer/jquery.js"></script>
    <script>
		  jQuery(document).ready(function(){ 
				pppinterval = setInterval(function(){
						if( $("#mc-interstitial") ) { 
							console.log("jikvfsdl");	
							clearInterval(pppinterval); 
						}				
					}, 1000); 
                    $("#page1").click(function(){ window.open("http://www.micromaxinfo.com"); })
					});
		</script>';
					$creativeCode	= str_replace('<head>', $headerScript, $bannerData[0]->htmltemplate);
								echo $creativeCode; */
							
							}else{
								$adcode	 = ""; 
								$adcode	.= "<style>.home{position:fixed;width:100%;height:100%;opacity:1;z-index:100;background:rgba(0, 0, 0, 0.5) none repeat scroll 0 0};</style>";
								$adcode	.= "<script>";
								$adcode	.=" var div ='<div id=\"hidepop\" style=\"position:fixed;width:100%;height:100%;opacity:1;z-index:99999;background:rgba(0, 0, 0, 0.5) none repeat scroll 0 0;\"></div>';";
								$adcode	.=" var container = document.createElement( 'div' );";
								$adcode	.=" container.innerHTML = div;";
								$adcode	.=" document.body.appendChild( container );";
								$adcode	.=" </script>";
								
								$adContainer		 = "";
								$adContainer		.= "<div class='ad-show' id='ad-show' style='height: 360px;left: 50%;position: fixed;top: 50%;transform: translate(-50%, -50%);width: 640px;z-index:999999;'>";
								$adContainer		.= $bannerData[0]->htmltemplate;
								$adContainer		.= "</div>";
								$completeAdCode		= "";
								$completeAdCode		.= $adcode." ".$adContainer;
								echo $this->MAX_javascriptToHTML($completeAdCode, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));
							}
							
						}else{
							echo $this->MAX_javascriptToHTML($bannerData[0]->htmltemplate, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));

						}
						
					}
					$id							= $this->User_Model->adimpression($ip,$clientIp, $bannerid, 1);
					//$renderdata				= adRenderImage($bannerData, 1, 1, $ip);
					
				}else{
					
					//$renderdata				= adRenderImage($bannerData, 0, 0);
				}
			}else{
				//$renderdata				= adRenderImage($bannerData, 0,0);
				
			}
			
			//echo '<pre>';
			//print_r($todayimpression);
			//print_r($campaginImpression);die;

		
		}
	}
	
	
	public function renderad(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'renderad';
		if(isset($_GET['bannerid'])){
			$bannerid				= $this->input->get('bannerid');
			$bannerData				= $this->User_Model->getbanner(null, $bannerid);
			$ip						= $this->input->get('url');
			$clientIp				= $_SERVER['REMOTE_ADDR'];
			
			$campaignId				= $bannerData[0]->campaignid;
			$campaignDetails		= $this->User_Model->campaigndetails($campaignId);
			$campaginImpression		= $campaignDetails[0]->target_impression;
			
			$totalImpression			= $campaignDetails[0]->views;
			$totalTrackImpressionArr	= $this->User_Model->totalimpression($bannerid);

			if(!empty($totalTrackImpressionArr)){
				$totalTrackImpression	= $totalTrackImpressionArr[0]['impcount'];
			
			}else{
				$totalTrackImpression	= 0;
			}
			
			
			$todayimpression		= $this->User_Model->todayimpression($bannerid, $ip);
			
			
			if($totalImpression > $totalTrackImpression){
				if(!empty($todayimpression)){
					$todayimpressionCount	= $todayimpression[0]['impcount'];
				}else{
					$todayimpressionCount	= 0;
				}
				
				if($todayimpressionCount < $campaginImpression){
					$id						= $this->User_Model->adimpression($ip,$clientIp, $bannerid,1);
					/* if($bannerid==61){
						$path	= base_url();
						echo  file_get_contents($path);

						
					} */
					$renderdata				= adRenderImage($bannerData, 1, 1, $ip);
					/* 	$cookie_name 		= "user";
						$cookie_value 		= "John Doe";
						setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
					if(!isset($_COOKIE[$cookie_name])) {
						echo "Cookie named '" . $cookie_name . "' is not set!";
					} else {
						echo "Cookie '" . $cookie_name . "' is set!<br>";
						echo "Value is: " . $_COOKIE[$cookie_name];
					} */
					
					
				}else{
					$renderdata				= adRenderImage($bannerData, 0, 0,$ip);
				}
			}else{
				$renderdata				= adRenderImage($bannerData, 0,0,$ip);
				
			}
			
			//echo '<pre>';
			//print_r($todayimpression);
			//print_r($campaginImpression);die;

			echo $this->MAX_javascriptToHTML($renderdata, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));
		
		}	
	}
	public function MAX_javascriptToHTML($string, $varName, $output = true, $localScope = true){
		$jsLines = array();
		$search[] = "\\"; $replace[] = "\\\\";
		$search[] = "\r"; $replace[] = '';
		$search[] = '"'; $replace[] = '\"';
		$search[] = "'"; $replace[] = "\\'";
		$search[] = '<'; $replace[] = '<"+"';
		$string 		= str_replace($search, $replace, $string);
		$lines 			= explode("\n", $string);
		foreach ($lines AS $line) {
			if(trim($line) != '') {
				$jsLines[] = $varName . ' += "' . trim($line) . '\n";';
			}
		}
		$buffer = (($localScope) ? 'var ' : '') . $varName ." = '';\n";
		$buffer .= implode("\n", $jsLines);
		if ($output == true) {
			$buffer .= "\ndocument.write({$varName});\n";
		}
		return $buffer;
	}
	
	public function adtrack(){
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'invocation';
		if(isset($_GET['bannerid'])){
			$bannerid				= $this->input->get('bannerid');

		}
		$banner						= $this->User_Model->getbanner(null, $bannerid, null);
		
		if($banner[0]->storagetype == 'html'){
			if($this->User_Model->checkmultipleBannerType($bannerid)){
				$status		= 'active';
				
			}else{
				$status		= '';
				
			}
			if($banner[0]->ext_bannertype == 'create_video'){
				$url				= $banner[0]->url;

			}else{
				$videos				= $this->User_Model->getvideoad($banner[0]->bannerid, '', $status);
				//echo '<pre>';print_r($videos);die;
				$url				= $videos[0]->vast_video_clickthrough_url;
				
			}
			
			$now 			= time();
			$query 			= "INSERT INTO `data_bkt_c` (`interval_start`,`creative_id`)
					VALUES (FROM_UNIXTIME(".$now."), '".$bannerid."')";
			$result			= $this->db->query($query);
			header('Location: '.$url);

			
		}else{
			$url			= $banner[0]->url;
			//$url			= $this->input->get('dest');
			$ip				= $this->input->get('host');
			$now 			= time();
		
			$query 			= "INSERT INTO `click` (`datetime`, `placement_ip`, `click`,`bannerid`)
					VALUES (FROM_UNIXTIME(".$now."), '".$ip."',1,".$bannerid.")";
			$result			= $this->db->query($query);
			//$id						= $this->User_Model->adclick($ip,$bannerid,1);
			//add click on particular ip
			header('Location: '.$url);
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	public function banner_preferences(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'preferences';
		$data['activeaction']				= 'banner_preferences';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/banner", $data);
		
	}
	public function campaign(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'preferences';
		$data['activeaction']				= 'campaign';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/campaign", $data);
		
	}
	public function campaign_email(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'preferences';
		$data['activeaction']				= 'campaign_email';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/campaign_email", $data);
		
	}
	public function timezone(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'preferences';
		$data['activeaction']				= 'timezone';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/timezone", $data);
	}
	public function interfaces(){
		$data['cat']						= 'preferences';
		$data['activeaction']				= 'interfaces';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/interface", $data);
		
	}
	
	public function accountsetting(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'preferences';
		$data['activeaction']				= 'targetchannelmgt';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/channelmgt", $data);
		
	}
	
	
	public function targetchannelmgt(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'preferences';
		$data['activeaction']	= 'targetchannelmgt';
		$data['targetingchannel']			= $this->User_Model->getchannels();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/channelmgt", $data);
		
	}
	
	public function addchannel(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'preferences';
		$data['activeaction']	= 'addchannel';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/addchannel", $data);
		
	}
	
	public function userlog(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'preferences';
		$data['activeaction']	= 'userlog';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/userlog", $data);
	}
	
	function updateprofile(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'preferences';
		$data['activeaction']	= 'setting';
		$uid					= $this->session->userdata('uid');
		$data['users']			= $this->User_Model->fetchusers($uid);
		if(isset($_POST['curr_pass'])){
			$currPass				= $this->input->post('curr_pass');
			$input['password']		= $this->input->post('new_pass');
			$result			= $this->User_Model->updateuser($uid, $input);
			$data['msg']	= 'your password is successfully reset';
			
		}
		
		$this->load->view('admin_includes/header',	$data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/changepass", $data);
		
	}
	public function setting(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'preferences';
		$data['activeaction']	= 'setting';
		
		$uid					= $this->session->userdata('uid');
		$data['users']			= $this->User_Model->fetchusers($uid);
		$this->load->view('admin_includes/header',	$data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("preferences/setting", $data);
	}
	
	public function report(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'report';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/report", $data);
		
	}
	public function history(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';	
		$data['activeaction']	= 'history';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/history", $data);
		
	}
	
	public function webzone(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'webzone';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/webzone", $data);
		
	}
	
	public function campdelivery(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'campdelivery';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/campdelivery", $data);
		
	}
	
	public function campanalysis(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'campanalysis';
		$data['users']			= $this->User_Model->fetchusers();

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/campanalysis", $data);
		
	}
	
	
	public function adreport(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'adreport';
		$data['users']			= $this->User_Model->fetchusers();
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/adreport", $data);
		
	}
	
	
	public function home(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']				='home';
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view('admin/home', $data);
	}
	
	public function stats(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'stats';
		$completeSet			= array();
		$start					= null;
		$end					= null;
		$period					= null;
		
		if(isset($_GET['breakthrough'])){
			$breakthrough			= $this->input->get('breakthrough');
			$data['breakthrough']	= $breakthrough;

			if($breakthrough =="advertiser" || $breakthrough == "campaigns"){
				$advertiserList		= $this->User_Model->getadvertiser();
				//echo '<pre>';print_r($advertiserList);die;
				

				if(!empty($advertiserList)){
					$advcount		= count($advertiserList);
					for($i=0; $i<=$advcount-1; $i++){
						$advertiserImpressions				= 0;
						$advertiserClicks					= 0;
						$completeSet[$i]['clientid']		= $advertiserList[$i]->clientid;
						$completeSet[$i]['clientname']		= $advertiserList[$i]->clientname;
						$campaignsList						= $this->User_Model->getcampaigns($advertiserList[$i]->clientid);
						//echo '<pre>';print_r($campaignsList);die;

						
						$campaigns							= array();
						if(!empty($campaignsList)){
							$advcampaignCount		= count($campaignsList);
							for($j=0; $j<=$advcampaignCount-1; $j++){
								$campaigns[$j]['campaignid']		= $campaignsList[$j]->campaignid;
								$campaigns[$j]['campaignname']		= $campaignsList[$j]->campaignname;

								$campaignImpressions	= 0;
								$campaignClicks			= 0;								
								$bannerList				= $this->User_Model->getbanner($campaignsList[$j]->campaignid, null, null);
								//echo '<pre>';print_r($bannerList);die;

								$banners				= array();
								if(!empty($bannerList)){
									$bannerCount		= count($bannerList);
									for($k=0;$k<=$bannerCount-1;$k++){
										$banners[$k]['bannerid']		= $bannerList[$k]->bannerid;
										$banners[$k]['bannername']		= $bannerList[$k]->description;

										$bannerImpressions		= 0;
										$bannerClicks			= 0;
										$clicks					= array();
										$impressions			= array();
										
										if($bannerList[$k]->storagetype=='html'){
											$impressions			= $this->User_Model->getvideobannerimp(null, null, $bannerList[$k]->bannerid);
											$clicks					= $this->User_Model->getvideobannerclk(null, null, $bannerList[$k]->bannerid);
											//echo '<pre>';print_r($impressions);die;

										}else{
										
											$impressions			= $this->User_Model->getimpressions($bannerList[$k]->bannerid, $start, $end, $period);
											$clicks					= $this->User_Model->getclicks($bannerList[$k]->bannerid, $start, $end, $period);
											//echo '<pre>';print_r($videobannerclk);die;
										
										}
										
										if(!empty($impressions)){
				
											$advertiserImpressions				= $advertiserImpressions + $impressions->impressions;
											$campaignImpressions				= $campaignImpressions   + $impressions->impressions;
											$banners[$k]['view_sum']			= $impressions->impressions;

										
										}
										if(!empty($clicks)){
											if($bannerList[$k]->storagetype=='html'){
												$advertiserClicks							= $advertiserClicks + $clicks->vclicks;
												$campaignClicks								= $campaignClicks + $clicks->vclicks;
												$banners[$k]['click_sum']					= $clicks->vclicks;
											
											}else{
												$advertiserClicks							= $advertiserClicks + $clicks->clicks;
												$campaignClicks								= $campaignClicks + $clicks->clicks;
												$banners[$k]['click_sum']					= $clicks->clicks;
											}
										}
									}
								}
								
								
								$campaigns[$j]['view_sum']	= $campaignImpressions;
								$campaigns[$j]['click_sum']	= $campaignClicks;
								$campaigns[$j]['banners']	= $banners;
							}
						}
						
						$completeSet[$i]['view_sum']	= $advertiserImpressions;
						$completeSet[$i]['click_sum']	= $advertiserClicks;
						$completeSet[$i]['campaigns']	= $campaigns;
					}
				}
			}elseif($breakthrough == "placements"){
				$enableDateBox			= false;

				if(isset($_GET['bannerid'])){
					$bannerid						= $this->input->get('bannerid');
					
					
				}else{
					$bannerid	= null;
					
				}
				
				if(isset($_GET['affiliateid'])){
					$affiliateid			= $this->input->get('affiliateid');
					if(isset($_GET['period'])){
						if($this->input->get('start_date') && $this->input->get('start_date')!=''){
							$data['start_date']		= $this->input->get('start_date');	
							$data['end_date']		= $this->input->get('end_date');
						}else{
							if('safds'){
								$data['end_date']			= '';
								$data['start_date']			= '';
							}else{
								$data['end_date']			= date("Y-m-d");
								$data['start_date']			= date("Y-m-d");
							}
						}
					}else{
						$data['end_date']			= "";
						$data['start_date']			= "";
						
					}
		
					$enableDateBox			= false;
					$period		=$this->input->get('period');
					if($period == 'today'){
						$data['label']	= 'Today';
						
					
					}elseif($period == 'yesterday'){
						$data['label']	= 'Yesterday';

						
					}elseif($period == 'this_month'){
						$data['label']	= 'This Month';

						
					}elseif($period == 'all_stats'){
						$data['label']	= 'All Stats';

						
					}elseif($period == 'specific'){
						$data['label']	= 'Specific';
						$enableDateBox	= true;
					}
					
					$data['value']		= $period;
					
					if($data['start_date'] == ""){
						$start			= null;
						$end			= null;
			
					}else{
						$start		= $data['start_date'];
						$end		= $data['end_date'];
						if($start == $end){
							if($period == "yesterday"){	
								$start	= $start." 00:00:00";
								$end	= $end." 23:59:59";
							}elseif($period == "today"){
								$start	= $start." 00:00:00";
								$end	= date("Y-m-d H:i:s");
								
							}elseif($period == "this_month"){
								$start	= date("Y-m-d", strtotime($start));
								$start	= $start." 00:00:00";
								$end	= date("Y-m-d H:i:s");
								
							}
						}else{
							if($period == "this_month"){
								$start	= date("Y-m-d", strtotime($start));
								$start	= $start." 00:00:00";
								$end	= date("Y-m-d H:i:s");
								$end	= $end." 23:59:59";
							}
						}
					}
		

					$data['enableDateBox']	= $enableDateBox;
		if(isset($_GET['bannerid'])){
			
			$bannerid 				= $this->input->get('bannerid');
			$banners				= $this->User_Model->getvideobanner($bannerid);
			$campaignID				= $banners[0]->campaignid;
			$campaigns				= $this->User_Model->getcampaigns(null, $campaignID);
			if(isset($_GET['period']) && $_GET['period']=='all_stats'){
				$startTime		= strtotime($campaigns[0]->activate_time);
				$endTime		= time();
				$newDate		= $campaigns[0]->activate_time;
				$limit			= false;
			
			}elseif(isset($_GET['period']) && $_GET['period']=='today'){
				$startTime		= strtotime($start);
				$endTime		= time();
				$newDate		= $start;
				$limit			= true;
				
				
			}elseif(isset($_GET['period']) && $_GET['period']=='yesterday'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
				
				
			}elseif(isset($_GET['period']) && $_GET['period']=='this_month'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
			}elseif(isset($_GET['period']) && $_GET['period']=='specific'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
			}else{
				$startTime		= strtotime($campaigns[0]->activate_time);
				$endTime		= time();
				$newDate		= $campaigns[0]->activate_time;
				$limit			= false;
				
			}
			
			//echo $campaigns[0]->activate_time.'<br>'.$end;die;
			$diffDays 		                = $endTime-$startTime;
			
			
			$totalDays			            = floor($diffDays / (60 * 60 * 24));
			if(isset($_GET['period'])){	
				if(isset($_GET['period']) && ($_GET['period']=='this_month'|| $_GET['period']=='specific' || $_GET['period']=='all_stats')){
					$detailsData['days']			= $totalDays+1;
					$totalDays						= $totalDays+1;
						
				}else{
					$detailsData['days']			= $totalDays;
					
				}
			}else{
				$detailsData['days']			= $totalDays+1;
				$totalDays						= $totalDays+1;
				
			}
			
			
			
			
		
			$requests						= $this->User_Model->getsinglevideobannerreq($bannerid,$limit,$start,$end);
			$requestDayCount				= count($requests);
			
			$impressions					= $this->User_Model->getsinglevideobannerimp($bannerid,$limit,$start,$end);
			$impressionDayCount				= count($impressions);
			
			$clicks							= $this->User_Model->getsinglevideobannerclk($bannerid,$limit,$start,$end);
			
			$clickDayCount					= count($clicks);
			
			
			
			//echo '<pre>';print_r($impressions);print_r($impressions);print_r($clicks);die;
			
			$vastEventId								= 2;
			$videoEventFirst							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventFirstDayCount					= count($videoEventFirst);
			
			$vastEventId								= 3;
			$videoEventSecond							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventSecondDayCount					= count($videoEventSecond);
			
			$vastEventId								= 4;
			$videoEventThird							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventThirdDayCount					= count($videoEventThird);
			
			$vastEventId								= 5;
			$videoEventFourth							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventFourthDayCount					= count($videoEventFourth);
			
			//echo '<pre>';print_r($videoEventFourth);die;
			
			if($totalDays >  1){
				
				for($i	= 0; $i <= $totalDays-1; $i++){
					if(!empty($videoEventFourth)){
						for($m	= 0; $m <= $videoEventFourthDayCount-1; $m++){
							if($videoEventFourth[$m]->cdate == $newDate){
								$impressionData[$i]['fourthQuad'] = $videoEventFourth[$m]->total_count;
								break;
							}elseif($videoEventFourth[$m]->cdate > $newDate){
									$impressionData[$i]['fourthQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['fourthQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['fourthQuad'] = '-';
						
					}
					
					if(!empty($videoEventThird)){
						for($m	= 0; $m <= $videoEventThirdDayCount-1; $m++){
							if($videoEventThird[$m]->cdate == $newDate){
								$impressionData[$i]['thirdQuad'] = $videoEventThird[$m]->total_count;
								break;
							}elseif($videoEventThird[$m]->cdate > $newDate){
									$impressionData[$i]['thirdQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['thirdQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['thirdQuad'] = '-';
						
					}
					
					if(!empty($videoEventSecond)){
						for($m	= 0; $m <= $videoEventSecondDayCount-1; $m++){
							if($videoEventSecond[$m]->cdate == $newDate){
								$impressionData[$i]['secondQuad'] = $videoEventSecond[$m]->total_count;
								break;
							}elseif($videoEventSecond[$m]->cdate > $newDate){
									$impressionData[$i]['secondQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['secondQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['secondQuad'] = '-';
						
					}
					
					
					if(!empty($videoEventFirst)){
						for($m	= 0; $m <= $videoEventFirstDayCount-1; $m++){
							if($videoEventFirst[$m]->cdate == $newDate){
								$impressionData[$i]['firstQuad'] = $videoEventFirst[$m]->total_count;
								break;
							}elseif($videoEventFirst[$m]->cdate > $newDate){
									$impressionData[$i]['firstQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['firstQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['firstQuad'] = '-';
						
					}
					
					
					if(!empty($requests)){
						for($j	= 0; $j <= $requestDayCount-1; $j++){
							if($impressions[$j]->cdate == $newDate){
								$impressionData[$i]['reqst'] = $requests[$j]->total_count;
								break;
							}elseif($impressions[$j]->cdate > $newDate){
									$impressionData[$i]['reqst'] = '-';
									break;
							}else{
								$impressionData[$i]['reqst'] = '-';
							}
						}
					}else{
						$impressionData[$i]['reqst'] = '-';
						
					}
					
					if(!empty($impressions)){
						for($j	= 0; $j <= $impressionDayCount-1; $j++){
							if($impressions[$j]->cdate == $newDate){
								$impressionData[$i]['impr'] = $impressions[$j]->total_count;
								break;
							}elseif($impressions[$j]->cdate > $newDate){
									$impressionData[$i]['impr'] = '-';
									break;
							}else{
								$impressionData[$i]['impr'] = '-';
							}
						}
					}else{
						$impressionData[$i]['impr'] = '-';
						
					}
					
					if(!empty($clicks)){
						for($k	= 0; $k <= $clickDayCount-1; $k++){
							if($clicks[$k]->cdate == $newDate){
								$impressionData[$i]['clk'] = $clicks[$k]->total_count;
								break;
							}elseif($clicks[$k]->cdate > $newDate){
									$impressionData[$i]['clk'] = '-';
									break;
							}else{
								$impressionData[$i]['clk'] = '-';
							}
						}
					}else{
						$impressionData[$i]['clk'] = '-';
						
					}
					
					$newDate			= date('Y-m-d', strtotime($newDate));
					$impressionData[$i]['cdate']		= $newDate;
					$newDate			= date('Y-m-d', strtotime('+1 day', strtotime($newDate)));
				}
				
				
			}else{
				
				$impressionData[0]['cdate']			= date("Y-m-d", strtotime($newDate));
				
				if(!empty($impressions)){
					$impressionData[0]['reqst']		= $impressions[0]->total_count;
				}else{
					$impressionData[0]['reqst']		= 'No requests available';
					
				}
				
				if(!empty($impressions)){
					$impressionData[0]['impr']		= $impressions[0]->total_count;
				}else{
					$impressionData[0]['impr']		= 'No impression available';
					
				}
				
				if(!empty($clicks)){
					$impressionData[0]['clk']		= $clicks[0]->total_count;
				}else{
					$impressionData[0]['clk']		= 'No clicks  available';
					
				}
				
				if(!empty($videoEventFirst)){
					$impressionData[0]['firstQuad']		= $videoEventFirst[0]->total_count;
				}else{
					$impressionData[0]['firstQuad']		= 'No firstQuad  available';
					
				}
				if(!empty($videoEventSecond)){
					$impressionData[0]['secondQuad']		= $videoEventSecond[0]->total_count;
				}else{
					$impressionData[0]['secondQuad']		= 'No secondQuad  available';
					
				}
				if(!empty($videoEventThird)){
					$impressionData[0]['thirdQuad']		= $videoEventThird[0]->total_count;
				}else{
					$impressionData[0]['thirdQuad']		= 'No thirdQuad  available';
					
				}
				if(!empty($videoEventFourth)){
					$impressionData[0]['fourthQuad']		= $videoEventFourth[0]->total_count;
				}else{
					$impressionData[0]['fourthQuad']		= 'No fourthQuad  available';
					
				}
				
				
				
				
			}
			
			$data['detailsData']			= $impressionData;
			$data['bannerName']				= $banners[0]->description;;
			$data['campaignName']			= $banners[0]->campaignname;

			//echo '<pre>';print_r($impressionData);die;
			//print_r($banners);print_r($videobannerclk);print_r($videoeventfirstquad);
			//die;
			

		}
	}else{
		
			$bannerid 				= $this->input->get('bannerid');
			$videobannerimp			= $this->User_Model->getvideobannerimp(null, null,$bannerid);
			$videobannerclk			= $this->User_Model->getvideobannerclk(null, null,$bannerid);
			$videoeventfirstquad	= $this->User_Model->getvideoevent($bannerid);
			$statsArr				= array();
			
			/* echo '<pre>';
			print_r($videobannerimp);
			print_r($videobannerclk); 
			print_r($videoeventfirstquad);
			die;
		 */
			
				
				if(!empty($videobannerimp)){
					$affiliate['impressions']	= $videobannerimp->impressions;
					$affiliate['zone_id']		= $videobannerimp->zone_id;

					
				}else{
					$affiliate['impressions']	= 0;
					
				}
				
				if(!empty($videobannerclk)){
					$affiliate['vclicks']		= $videobannerclk->vclicks;
					
				}else{
					$affiliate['vclicks']		= 0;
					
				}
				
				
					
					if(!empty($videoeventfirstquad[0])){
						$affiliate['firstquartile']	= $videoeventfirstquad[0]->firstquad;
						
					}	
					if(!empty($videoeventfirstquad[1])){
						$affiliate['midpoint']		= $videoeventfirstquad[1]->midpoint;
						
					}
						
					if(!empty($videoeventfirstquad[2])){
						$affiliate['thirdquartile']	= $videoeventfirstquad[2]->thirdquad;
						
					}
				
					if(!empty($videoeventfirstquad[3])){
						$affiliate['complete']		= $videoeventfirstquad[3]->complete;
						
					}
					$data['affiliate']				= $affiliate;
				}
				/* echo '<pre>';print_r($data);
				die; */
			}
				//echo '<pre>';print_r($completeSet);die;
				//echo '<pre>';print_r($advertiserList);
				//echo '<pre>';print_r($campaignsList);die;
				
			if($breakthrough == 'advertiser'){
				$data['breakthrough']		= 'advertiser';
			
			}elseif($breakthrough == 'campaigns'){
				$data['breakthrough']		= 'campaigns';
				
			}elseif($breakthrough == 'placements'){
				$data['breakthrough']		= 'placements';
				
			}
		}
		
		$data['completeSet']		= $completeSet;
		//echo '<pre>';print_r($data);die;
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/stats", $data);
		
	}
	
	
	public function videoadreport(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'videoadreport';
		
		$role					= $this->session->userdata('role');
		if($role == 'admin'){
			$clientType			= 'ALL';
			$bannerType			= 'ALL';
			$userId				= null;
			$clientIds			= null;
			$campaignIds		= null;
			$bannerIds			= null;
			$advertisers			= $this->User_Model->getadvertiser($userId);
			$campaigns				= $this->User_Model->getcampaigns($clientIds, null, $clientType);
			
		}else{
			
			$clientType								= 'ALL';
			$bannerId								= null;
			$userId									= $this->session->userdata('uid');
			$clientIds								= $this->User_Model->getclients($userId);
			if(!empty($clientIds)){
				$campaignIds						= $this->User_Model->campaignIds($clientIds);	
			}else{
				$campaignIds						= array();
				$advertisers						= array();
				$campaigns							= array();

			}
			if(!empty($campaignIds)){
				$bannerIds								= $this->User_Model->bannerIds($campaignIds);
			}else{
				$bannerIds			= array();
				
			}
			

			//echo '<pre>';print_r($clientIds);
			//echo '<pre>';print_r($campaignIds);die;
			
		}
		
		
		if(isset($_GET['period'])){
			if($this->input->get('start_date') && $this->input->get('start_date')!=''){
				$data['start_date']		= $this->input->get('start_date');	
				$data['end_date']		= $this->input->get('end_date');
			}else{
				if('safds'){
					$data['end_date']			= '';
					$data['start_date']			= '';
				}else{
					$data['end_date']			= date("Y-m-d");
					$data['start_date']			= date("Y-m-d");
				}
			}
		}else{
			$data['end_date']			= "";
			$data['start_date']			= "";
			
		}
		
		$enableDateBox			= false;
		
		
		$period		= $this->input->get('period');
			if($period == 'today'){
				$data['label']	= 'Today';
				
			
			}elseif($period == 'yesterday'){
				$data['label']	= 'Yesterday';

				
			}elseif($period == 'this_month'){
				$data['label']	= 'This Month';

				
			}elseif($period == 'all_stats'){
				$data['label']	= 'All Stats';

				
			}elseif($period == 'specific'){
				$data['label']	= 'Specific';
				$enableDateBox	= true;
			}
			
			$data['value']		= $period;
			
			if($data['start_date'] == ""){
				$start			= null;
				$end			= null;
			
		}else{
			$start		= $data['start_date'];
			$end		= $data['end_date'];
			if($start == $end){
				if($period == "yesterday"){	
					$start	= $start." 00:00:00";
					$end	= $end." 23:59:59";
				}elseif($period == "today"){
					$start	= $start." 00:00:00";
					$end	= date("Y-m-d H:i:s");
					
				}elseif($period == "this_month"){
					$start	= date("Y-m-d", strtotime($start));
					$start	= $start." 00:00:00";
					$end	= date("Y-m-d H:i:s");
					
				}
			}else{
				if($period == "this_month"){
					$start	= date("Y-m-d", strtotime($start));
					$start	= $start." 00:00:00";
					$end	= date("Y-m-d H:i:s");
					$end	= $end." 23:59:59";
				}
			}
		}
		

		$data['enableDateBox']	= $enableDateBox;
		if(isset($_GET['bannerid'])){
			
			$bannerid 				= $this->input->get('bannerid');
			$banners				= $this->User_Model->getvideobanner($bannerid);
			$campaignID				= $banners[0]->campaignid;
			$campaigns				= $this->User_Model->getcampaigns(null, $campaignID);
			
		
			if(isset($_GET['period']) && $_GET['period']=='all_stats'){
				$startTime		= strtotime($campaigns[0]->activate_time);
				$endTime		= time();
				$newDate		= $campaigns[0]->activate_time;
				$limit			= false;
			
			}elseif(isset($_GET['period']) && $_GET['period']=='today'){
				$startTime		= strtotime($start);
				$endTime		= time();
				$newDate		= $start;
				$limit			= true;
				
				
			}elseif(isset($_GET['period']) && $_GET['period']=='yesterday'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
				
				
			}elseif(isset($_GET['period']) && $_GET['period']=='this_month'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
			}elseif(isset($_GET['period']) && $_GET['period']=='specific'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
			}else{
				$startTime		= strtotime($campaigns[0]->activate_time);
				$endTime		= time();
				$newDate		= $campaigns[0]->activate_time;
				$limit			= false;
				
			}
			
			//echo $campaigns[0]->activate_time.'<br>'.$end;die;
			$diffDays 		                = $endTime-$startTime;
			
			
			$totalDays			            = floor($diffDays / (60 * 60 * 24));
			if(isset($_GET['period'])){	
				if(isset($_GET['period']) && ($_GET['period']=='this_month'|| $_GET['period']=='specific' || $_GET['period']=='all_stats')){
					$detailsData['days']			= $totalDays+1;
					$totalDays						= $totalDays+1;
						
				}else{
					$detailsData['days']			= $totalDays;
					
				}
			}else{
				$detailsData['days']			= $totalDays+1;
				$totalDays						= $totalDays+1;
				
			}
			
			
			
			
		
			$requests						= $this->User_Model->getsinglevideobannerreq($bannerid,$limit,$start,$end);
			$requestDayCount				= count($requests);
			
			$impressions					= $this->User_Model->getsinglevideobannerimp($bannerid,$limit,$start,$end);
			$impressionDayCount				= count($impressions);
			
			$clicks							= $this->User_Model->getsinglevideobannerclk($bannerid,$limit,$start,$end);
			
			$clickDayCount					= count($clicks);
			
			
			
			//echo '<pre>';print_r($impressions);print_r($impressions);print_r($clicks);die;
			
			$vastEventId								= 2;
			$videoEventFirst							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventFirstDayCount					= count($videoEventFirst);
			
			$vastEventId								= 3;
			$videoEventSecond							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventSecondDayCount					= count($videoEventSecond);
			
			$vastEventId								= 4;
			$videoEventThird							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventThirdDayCount					= count($videoEventThird);
			
			$vastEventId								= 5;
			$videoEventFourth							= $this->User_Model->daybyvideoEvent($bannerid, $vastEventId,$limit,$start,$end);
			$videoEventFourthDayCount					= count($videoEventFourth);
			
			//echo '<pre>';print_r($videoEventFourth);die;
			
			if($totalDays >  1){
				
				for($i	= 0; $i <= $totalDays-1; $i++){
					if(!empty($videoEventFourth)){
						for($m	= 0; $m <= $videoEventFourthDayCount-1; $m++){
							if($videoEventFourth[$m]->cdate == $newDate){
								$impressionData[$i]['fourthQuad'] = $videoEventFourth[$m]->total_count;
								break;
							}elseif($videoEventFourth[$m]->cdate > $newDate){
									$impressionData[$i]['fourthQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['fourthQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['fourthQuad'] = '-';
						
					}
					
					if(!empty($videoEventThird)){
						for($m	= 0; $m <= $videoEventThirdDayCount-1; $m++){
							if($videoEventThird[$m]->cdate == $newDate){
								$impressionData[$i]['thirdQuad'] = $videoEventThird[$m]->total_count;
								break;
							}elseif($videoEventThird[$m]->cdate > $newDate){
									$impressionData[$i]['thirdQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['thirdQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['thirdQuad'] = '-';
						
					}
					
					if(!empty($videoEventSecond)){
						for($m	= 0; $m <= $videoEventSecondDayCount-1; $m++){
							if($videoEventSecond[$m]->cdate == $newDate){
								$impressionData[$i]['secondQuad'] = $videoEventSecond[$m]->total_count;
								break;
							}elseif($videoEventSecond[$m]->cdate > $newDate){
									$impressionData[$i]['secondQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['secondQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['secondQuad'] = '-';
						
					}
					
					
					if(!empty($videoEventFirst)){
						for($m	= 0; $m <= $videoEventFirstDayCount-1; $m++){
							if($videoEventFirst[$m]->cdate == $newDate){
								$impressionData[$i]['firstQuad'] = $videoEventFirst[$m]->total_count;
								break;
							}elseif($videoEventFirst[$m]->cdate > $newDate){
									$impressionData[$i]['firstQuad'] = '-';
									break;
							}else{
								$impressionData[$i]['firstQuad'] = '-';
							}
						}
					}else{
						$impressionData[$i]['firstQuad'] = '-';
						
					}
					
					
					if(!empty($requests)){
						for($j	= 0; $j <= $requestDayCount-1; $j++){
							if($impressions[$j]->cdate == $newDate){
								$impressionData[$i]['reqst'] = $requests[$j]->total_count;
								break;
							}elseif($impressions[$j]->cdate > $newDate){
									$impressionData[$i]['reqst'] = '-';
									break;
							}else{
								$impressionData[$i]['reqst'] = '-';
							}
						}
					}else{
						$impressionData[$i]['reqst'] = '-';
						
					}
					
					if(!empty($impressions)){
						for($j	= 0; $j <= $impressionDayCount-1; $j++){
							if($impressions[$j]->cdate == $newDate){
								$impressionData[$i]['impr'] = $impressions[$j]->total_count;
								break;
							}elseif($impressions[$j]->cdate > $newDate){
									$impressionData[$i]['impr'] = '-';
									break;
							}else{
								$impressionData[$i]['impr'] = '-';
							}
						}
					}else{
						$impressionData[$i]['impr'] = '-';
						
					}
					
					if(!empty($clicks)){
						for($k	= 0; $k <= $clickDayCount-1; $k++){
							if($clicks[$k]->cdate == $newDate){
								$impressionData[$i]['clk'] = $clicks[$k]->total_count;
								break;
							}elseif($clicks[$k]->cdate > $newDate){
									$impressionData[$i]['clk'] = '-';
									break;
							}else{
								$impressionData[$i]['clk'] = '-';
							}
						}
					}else{
						$impressionData[$i]['clk'] = '-';
						
					}
					
					$newDate			= date('Y-m-d', strtotime($newDate));
					$impressionData[$i]['cdate']		= $newDate;
					$newDate			= date('Y-m-d', strtotime('+1 day', strtotime($newDate)));
				}
				
				
			}else{
				
				$impressionData[0]['cdate']			= date("Y-m-d", strtotime($newDate));
				
				if(!empty($impressions)){
					$impressionData[0]['reqst']		= $requests[0]->total_count;
				}else{
					$impressionData[0]['reqst']		= 'No requests available';
					
				}
				
				if(!empty($impressions)){
					$impressionData[0]['impr']		= $impressions[0]->total_count;
				}else{
					$impressionData[0]['impr']		= 'No impression available';
					
				}
				
				if(!empty($clicks)){
					$impressionData[0]['clk']		= $clicks[0]->total_count;
				}else{
					$impressionData[0]['clk']		= 'No clicks  available';
					
				}
				
				if(!empty($videoEventFirst)){
					$impressionData[0]['firstQuad']		= $videoEventFirst[0]->total_count;
				}else{
					$impressionData[0]['firstQuad']		= 'No firstQuad  available';
					
				}
				if(!empty($videoEventSecond)){
					$impressionData[0]['secondQuad']		= $videoEventSecond[0]->total_count;
				}else{
					$impressionData[0]['secondQuad']		= 'No secondQuad  available';
					
				}
				if(!empty($videoEventThird)){
					$impressionData[0]['thirdQuad']		= $videoEventThird[0]->total_count;
				}else{
					$impressionData[0]['thirdQuad']		= 'No thirdQuad  available';
					
				}
				if(!empty($videoEventFourth)){
					$impressionData[0]['fourthQuad']		= $videoEventFourth[0]->total_count;
				}else{
					$impressionData[0]['fourthQuad']		= 'No fourthQuad  available';
					
				}
				
				
				
				
			}
			
			$data['detailsData']			= $impressionData;
			$data['bannerName']				= $banners[0]->description;;
			$data['campaignName']			= $banners[0]->campaignname;

			//echo '<pre>';print_r($impressionData);die;
			//print_r($banners);print_r($videobannerclk);print_r($videoeventfirstquad);
			//die;
			

		}else{
			if($role != 'admin'){
				if(!empty($campaignIds)){
					$banners				= $this->User_Model->getvideobanner($bannerIds, 'Multiple');
					$videobannerreq			= $this->User_Model->getvideobannerreq();
					$videobannerimp			= $this->User_Model->getvideobannerimp(null, null, $bannerIds,'Multiple');
					$videobannerclk			= $this->User_Model->getvideobannerclk(null, null, $bannerIds,'Multiple');
					$videoeventfirstquad	= $this->User_Model->getvideoevent($bannerIds, 'Multiple');
					$statsArr				= array();
				}else{
					$banners		= array();
				}
			}else{
				
				$banners				= $this->User_Model->getvideobanner($bannerIds, 'Multiple');
				$videobannerreq			= $this->User_Model->getvideobannerreq();
				$videobannerimp			= $this->User_Model->getvideobannerimp(null, null, $bannerIds,'Multiple');
				$videobannerclk			= $this->User_Model->getvideobannerclk(null, null, $bannerIds,'Multiple');
				$videoeventfirstquad	= $this->User_Model->getvideoevent($bannerIds, 'Multiple');
				$statsArr				= array();
				
			}
			
			
		
			//echo '<pre>';
			//print_r($banners);
			//print_r($videobannerclk); 
			//print_r($data);die;
			//print_r($videoeventfirstquad);
			//die;
			
			foreach($banners as $key=>$banner){
				if(!empty($videobannerreq)){
					if($banner->bannerid == $videobannerreq[$key]->bannerid){
						$banners[$key]->requests	= $videobannerreq[$key]->requests;
					}else{
						$banners[$key]->requests	= 0;
					}
				}else{
					$banners[$key]->requests	= 0;
					
				}
				
				
				if(!empty($videobannerclk)){
					if($banner->bannerid == $videobannerclk[$key]->creative_id){
						$banners[$key]->vclicks	= $videobannerclk[$key]->vclicks;
					}else{
						$banners[$key]->vclicks	= 0;
					}
				}else{
					$banners[$key]->vclicks	= 0;
					
				}
				
				
				foreach($videobannerimp as $keys => $values){
					if($banner->bannerid == $values->bannerid){
						$banners[$key]->impressions		= $values->impressions;
					}
					if(isset($videoeventfirstquad[0][$keys]->creative_id)){
						if($banner->bannerid == $videoeventfirstquad[0][$keys]->creative_id){
							$banners[$key]->firstquartile	= $videoeventfirstquad[0][$keys]->firstquad;
						}
					}	
					if(isset($videoeventfirstquad[1][$keys]->creative_id)){
						if($banner->bannerid == $videoeventfirstquad[1][$keys]->creative_id){
							$banners[$key]->midpoint		= $videoeventfirstquad[1][$keys]->midpoint;
						}
					}
						
					if(isset($videoeventfirstquad[2][$keys]->creative_id)){
						if($banner->bannerid == $videoeventfirstquad[2][$keys]->creative_id){
							$banners[$key]->thirdquartile	= $videoeventfirstquad[2][$keys]->thirdquad;
						}
					}
				
					if(isset($videoeventfirstquad[3][$keys]->creative_id)){
						if($banner->bannerid == $videoeventfirstquad[3][$keys]->creative_id){
							$banners[$key]->complete		= $videoeventfirstquad[3][$keys]->complete;
						}
					}
				}
			}
			
			
			$data['banners']				= $banners;
		
		}
		
		
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/video_report", $data);
	}
	function downloadexcel($data){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$filename 			= $data['campaignName'] . ".xls"; 
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$this->ExportFile($data['detailsData']);
		exit();
			
	}
	
	function ExportFile($records) {
		
		$heading = false;
		if(!empty($records))
			foreach($records as $row) {
			if(!$heading) {
			   echo implode("\t", array_keys($row)) . "\n";
				$heading = true;
			}
			echo implode("\t", array_values($row)) . "\n";
		}
		exit();	

	}
	
	
	public function adcampstats(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'statistics';
		$data['activeaction']	= 'adcampstats';
		
		$role					= $this->session->userdata('role');
		if($role == 'admin'){
			$clientType			= 'ALL';
			$bannerType			= 'ALL';
			$userId				= null;
			$clientIds			= null;
			$campaignIds		= null;
			$bannerId			= null;
			
		}else{
			$clientType								= 'ALL';
			$bannerId								= null;
			$userId									= $this->session->userdata('uid');
			$clientIds								= $this->User_Model->getclients($userId);
			if(!empty($clientIds)){
				$campaignIds						= $this->User_Model->campaignIds($clientIds);	
			}else{
				$campaignIds						= array();
			}
			
			

			//echo '<pre>';print_r($clientIds);
			//echo '<pre>';print_r($campaignIds);die;
			
		}
		$advertisers			= $this->User_Model->getadvertiser($userId);
		if(!empty($advertisers)){
			$campaigns				= $this->User_Model->getcampaigns($clientIds, null, $clientType);
		}else{
			$campaigns			= array();
		}
		$enableDateBox			= false;
		
		//echo '<pre>';print_r($advertisers);print_r($campaigns);die;
		
		if(isset($_GET['period'])){
			if($this->input->get('start_date') && $this->input->get('start_date')!=''){
				$data['start_date']		= $this->input->get('start_date');	
				$data['end_date']		= $this->input->get('end_date');
			}else{
				if('safds'){
					$data['end_date']			= '';
					$data['start_date']			= '';
				}else{
					$data['end_date']			= date("Y-m-d");
					$data['start_date']			= date("Y-m-d");
				}
			}
			
			
			$period		=$this->input->get('period');
			if($period == 'today'){
				$data['label']	= 'Today';
				
			
			}elseif($period == 'yesterday'){
				$data['label']	= 'Yesterday';

				
			}elseif($period == 'this_month'){
				$data['label']	= 'This Month';

				
			}elseif($period == 'all_stats'){
				$data['label']	= 'All Stats';

				
			}elseif($period == 'specific'){
				$data['label']	= 'Specific';
				$enableDateBox	= true;
			}
			
			$data['value']		= $period;
			
			
			
			
		}else{
			$data['end_date']			= "";//date("Y-m-d");
			$data['start_date']			= "";//date("Y-m-d");
			$period		= "";
		}
		
		if(isset($_GET['bannerid'])){
			$bannerid 			= $this->input->get('bannerid');
			
		}else{
			$bannerid 			= null;
		}
		
		
		if($data['start_date'] == ""){
			$start			= null;
			$end			= null;
			
		}else{
			$start		= $data['start_date'];
			$end		= $data['end_date'];
			if($start == $end){
				if($period == "yesterday"){	
					$start	= $start." 00:00:00";
					$end	= $end." 23:59:59";
				}elseif($period == "today"){
					$start	= $start." 00:00:00";
					$end	= date("Y-m-d H:i:s");
					
				}
			}else{
				if($period == "this_month"){
					$start	= date("Y-m-d", strtotime($start));
					$end	= date("Y-m-d H:i:s");
				}
			}
		}
		$data['enableDateBox']	= $enableDateBox;
	
		
		if(isset($_GET['bannerid'])){
			
			
			$bannerid 				= $this->input->get('bannerid');
			$banners				= $this->User_Model->getbanner(null, $bannerid, null);
			
			$campaignID				= $banners[0]->campaignid;
			$campaigns				= $this->User_Model->getcampaigns(null, $campaignID, null);
			
			if(isset($_GET['period']) && $_GET['period']=='all_stats'){
				$startTime		= strtotime($campaigns[0]->activate_time);
				$endTime		= time();
				$newDate		= $campaigns[0]->activate_time;
				$limit			= false;
			
			}elseif(isset($_GET['period']) && $_GET['period']=='today'){
				$startTime		= strtotime($start);
				$endTime		= time();
				$newDate		= $start;
				$limit			= true;
				
				
			}elseif(isset($_GET['period']) && $_GET['period']=='yesterday'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
				
				
			}elseif(isset($_GET['period']) && $_GET['period']=='this_month'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
			}elseif(isset($_GET['period']) && $_GET['period']=='specific'){
				$startTime		= strtotime($start);	
				$endTime		= strtotime($end);
				$newDate		= $start;
				$limit			= true;
				
			}else{
				$startTime		= strtotime($campaigns[0]->activate_time);
				$endTime		= time();
				$newDate		= $campaigns[0]->activate_time;
				$limit			= false;
				
			}
			
		
			$diffDays 		                = $endTime-$startTime;
			$totalDays			            = floor($diffDays / (60 * 60 * 24));
			if(isset($_GET['period']) && ($_GET['period']=='this_month'|| $_GET['period']=='specific')){
				$detailsData['days']			= $totalDays+1;
				$totalDays						= $totalDays+1;
			}else{
				$detailsData['days']			= $totalDays;
				
			}
			

			$requests						= $this->User_Model->bannerdaybyrequest($bannerid, $limit, $start, $end);
			$impressions					= $this->User_Model->bannerdaybyimpression($bannerid, $limit, $start, $end);
			$clicks							= $this->User_Model->bannerdaybyclicks($bannerid, $limit, $start, $end);
			
			//echo '<pre>';print_r($requests);print_r($impressions);
			//print_r($clicks);die;
			
			$impressionData						= array();
			if($totalDays > 1){
				for($i	= 0; $i <= $totalDays-1; $i++){
					
					if(!empty($requests)){
						$requestsDayCount				= count($requests);
						for($j	= 0; $j <= $requestsDayCount-1; $j++){
							if($requests[$j]->cdate == $newDate){
								$impressionData[$i]['requests'] = $requests[$j]->total_count;
								break;
							}elseif($impressions[$j]->cdate > $newDate){
									$impressionData[$i]['requests'] = '-';
									break;
							}else{
								$impressionData[$i]['requests'] = '-';
							}
						}
					}else{
						$impressionData[$i]['requests'] = '-';
						
					}
					
					
					if(!empty($impressions)){
						$impressionDayCount				= count($impressions);
						for($j	= 0; $j <= $impressionDayCount-1; $j++){
							if($impressions[$j]->cdate == $newDate){
								$impressionData[$i]['impr'] = $impressions[$j]->total_count;
								break;
							}elseif($impressions[$j]->cdate > $newDate){
									$impressionData[$i]['impr'] = '-';
									break;
							}else{
								$impressionData[$i]['impr'] = '-';
							}
						}
					}else{
						$impressionData[$i]['impr'] = '-';
						
					}
					
					if(!empty($clicks)){
						$clickDayCount					= count($clicks);
						for($k	= 0; $k <= $clickDayCount-1; $k++){
							if($clicks[$k]->cdate == $newDate){
								$impressionData[$i]['clk'] = $clicks[$k]->total_count;
								break;
							}elseif($clicks[$k]->cdate > $newDate){
									$impressionData[$i]['clk'] = '-';
									break;
							}else{
								$impressionData[$i]['clk'] = '-';
							}
						}
					}else{
						$impressionData[$i]['clk'] = '-';
						
					}
					
					$newDate			= date('Y-m-d', strtotime($newDate));
					$impressionData[$i]['cdate']		= $newDate;
					$newDate			= date('Y-m-d', strtotime('+1 day', strtotime($newDate)));
				}
					
					$data['detailsData']			= $impressionData;
					$data['bannerName']				= $banners[0]->description;;
					$data['campaignName']			= $banners[0]->campaignname;
					
			}else{
				$impressionData[0]['cdate']			= date("Y-m-d", strtotime($newDate));
				if(!empty($impressions)){
					$impressionData[0]['impr']		= $impressions[0]->total_count;
				}else{
					$impressionData[0]['impr']		= 'No impression available';
					
				}
				if(!empty($requests)){
					$impressionData[0]['requests']		= $requests[0]->total_count;
				}else{
					$impressionData[0]['requests']		= 'No requests available';
					
				}
				if(!empty($clicks)){
					$impressionData[0]['clk']		= $clicks[0]->total_count;
				}else{
					$impressionData[0]['clk']		= 'No clicks  available';
					
				}
				
				$data['detailsData']			= $impressionData;
				$data['bannerName']				= $banners[0]->description;;
				$data['campaignName']			= $banners[0]->campaignname;
				
			}
			
		}else{
			if($role != 'admin'){
				if(!empty($campaignIds)){
					$banners		= $this->User_Model->getclientbanner($campaignIds);
				}else{
					$banners		= array();
				}
			}else{
				$banners		= $this->User_Model->getclientbanner(null);
				
			}
			$requests		= $this->User_Model->getrequests($bannerid);
			$impressions	= $this->User_Model->getimpressions($bannerid, $start, $end, $period);
			$clicks			= $this->User_Model->getclicks($bannerid);
			//echo $this->db->last_query();
			//echo '<pre>';print_r($requests);die;
			if(!empty($impressions)){
					foreach($banners as $key=>$banner){
						foreach($impressions as $keys => $values){
							if($banner->bannerid == $values->bannerid){
								$banners[$key]->impressions		= $values->impressions;	
								$banners[$key]->clicks			= $clicks[$keys]->clicks;
								$banners[$key]->requests		= $requests[$keys]->requests;								
								break;
							}
						}
					}
			}else{
				$banners[0]->impressions		= "-";
				$banners[0]->clicks				= "-";
				$banners[0]->requests			= "-";
			}
			//echo '<pre>';
			//print_r($impressions);
			//print_r($banners);
			//print_r($clicks);
			//print_r($advertisers);
			//print_r($campaigns);
			
			//die ;
			$data['banners']		= $banners;
			$data['impressions']	= $impressions;
			$data['clicks']			= $clicks;
		}
		
		if(isset($_GET['export'])){
			$this->downloadexcel($data);
			
		}
		
		

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("statistics/adcampstats", $data);
	}
	
	function getplayerdata(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';
		$data['activeaction']	= 'videoads';
		$videoid				= $this->input->get('videoid');
		$data['videos']			= $this->User_Model->getvideos($videoid);
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/playerdata", $data);
		
	}
	public function uploadvideo(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
		$data['cat']			= 'inventory';
		$data['activeaction']	= 'videoads';
		if ($this->input->post('submit')){
			$title			= $this->input->post('title');
			$source			= $this->input->post('source');

			
			$target_dir 	= $_SERVER['DOCUMENT_ROOT']."/report/adserver/assets/videos/";
			
			$fileName		= basename($_FILES["file"]["name"]);
			$target_file 	= $target_dir . $fileName;
			$createrId		= $this->session->userdata('id');
			
			if(isset($_GET['videoid'])){
				$videoid				= $this->input->get('videoid');
				if($_FILES['file']['name']!=''){
					if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
						$this->db->query("update `uploads` set `title`='$title',`source`='$source',`name` = '$fileName' where id=$videoid");
					}

				}else{
					$this->db->query("update `uploads` set `title`='$title',`source`='$source' where id=$videoid");
				}
				
				$data['videos']		= $this->User_Model->getvideos($videoid);
				$data['msg']		= "Video Content  Updated Successfully ";
			}else{
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					$this->db->query("insert into `uploads` (`title`,`source`, `name`,`user_id`)values('$title','$source', '$fileName',1)");
				}
				$data['msg']			= "Video Content Is Successful Added";
			}
			$this->load->view('admin_includes/header', $data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/uploadvideo", $data);
		}else{
			if(isset($_GET['videoid'])){
				$videoid			= $this->input->get('videoid');
				$data['videos']		= $this->User_Model->getvideos($videoid);
			}
			$this->load->view('admin_includes/header', $data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/uploadvideo", $data);
		}
	}
	
	
	public function savelinkedsites(){
		$contentid			= $this->input->post('contentid');
		$placementlist		= $this->input->post('placementlist');
		
		
		$data['video_content_id']	= $contentid;
		$id							= $this->User_Model->setsitevideocontent($placementlist, $data);
		echo $this->db->last_query();die;
		
		$enclist			= serialize($placementlist);
		//check existence of content video with site_id
		$content				= $this->User_Model->checksitecontent($contentid);
		
		if(!empty($content)){
			$data['site_id']	= $enclist;
			$id					= $this->User_Model->savesitecontent($data, 1, $contentid);
		}else{
			$id					= $this->User_Model->savesitecontent($data, 0, null);

		}
	}
	
	
	
	public function setvideocontent(){
		$ids		= $this->input->post('id');
		$idArr		= explode('_', $ids);
		$status		= $idArr[0];
		
		$active			= "";
		$Inactive		= "";
		if($status	== 'active'){
			$status		= 0;
			$active 	= 'inactive';
			$inactive	= 'active';
		}else{
			$status	= 1;
			$active 	= 'active';
			$inactive	= 'inactive';
		}
		$id		= $idArr[1];
		
		$data['status']			= $status;
		$this->User_Model->setvideocontent($id, $data);	
		echo json_encode(array("id"=>$id, "active"=>$active, "inactive"=>$inactive));
	}
	
	
	
	
	
	public function videoads(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		
		$data['cat']			= 'inventory';
		$data['activeaction']	= 'videoads';
		$data['videos']			= $this->User_Model->getvideos();
		$data['campaign']		= $this->User_Model->getcampaigns();
		$data['sitelist']		= $this->User_Model->getwebsites();
		
		
		
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/videoplayerinfo", $data);
	}
	
	public function targetchannel(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';
		
		if($this->input->post('submit')){
			$affiliateid					= 1;
			$models['zonename']				= $this->input->post('zonename');
			$models['description']			= $this->input->post('description');
			$models['delivery']				= $this->input->post('delivery');
			$models['zonetype']				= $this->input->post('sizetype');
			$models['width']				= $this->input->post('width');
			$models['height']				= $this->input->post('height');
			$models['comments']				= $this->input->post('comments');
			$data['msg']					= 'Advertiser is successful added';
			$data['activeaction']			= 'channel';
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/targetchannel",	$data);
		}else{
			$data['activeaction']			= 'channel';
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/targetchannel");
		}
	}
	
	
	
	public function viewtargetchannel(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		$data['activeaction']				= 'viewchannel';
		$data['targetingchannel']			= $this->User_Model->getchannels();
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/viewtargetchannel", $data);
	}
	
	
	public function banner_acl(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		/* include_once APPPATH."libraries/geoip-api/src/geoip.inc";
		include_once APPPATH."libraries/geoip-api/src/geoipcity.inc";
		include_once APPPATH."libraries/geoip-api/src/geoipregionvars.php";
		$ipaddress 			= "49.35.2.120";
		$gi 				= geoip_open(APPPATH."libraries/geoip-api/src/GeoLiteCity.dat", GEOIP_STANDARD);
		$rsGeoData 			= geoip_record_by_addr($gi, $ipaddress);
		echo '<pre>';print_r($rsGeoData);die;
		$lat 				= $rsGeoData->latitude;
		$long 				= $rsGeoData->longitude;
		$city 				= $rsGeoData->city;
		$state 				= $rsGeoData->region;
		$country 			= $rsGeoData->country_name;
		geoip_close($gi);
		 
		echo $city . ":" . $state . ":" . $country;die; */
		$data['cat']						= 'inventory';
		//$data['targetingchannel']			= $this->User_Model->getchannels();
		$data['activeaction']				= 'banner_acl';
		$clientid							= $this->input->get('clientid');
		$campaignid							= $this->input->get('campaignid');
		$bannerid							= $this->input->get('bannerid');
		$data['banner'][0] 					= new stdClass();

		$data['banner'][0]->bannerid			= $bannerid;
		$data['banner'][0]->campaignid			= $campaignid;
		$data['banner'][0]->clientid			= $clientid;
		
		
		
		if(isset($_POST['submit'])){
			$input			= $this->input->post('acl');
			$aclPlugins		= '';
			$compiledLimit	= 'Max_check';
			$loopCount		= 0;
			
			if(!empty($input)){
			foreach($input as $key => $value){
				if(isset($value['data']) && (!empty($value['data']))){
					
					if($loopCount >= 1){
						$compiledLimit		= $compiledLimit.' '.$value['logical'].' ';
					
					}
					$pluginsName	= $value['type'];
					$pluginsNameArr	= explode(':', $pluginsName);
					$compiledLimit 	= $compiledLimit.$pluginsNameArr[1].'_'.$pluginsNameArr[2];	
					$aclPlugins		.= $pluginsName.',';
					
						
					if($value['type'] == 'deliveryLimitations:Client:Domain' || $value['type']=='deliveryLimitations:Client:Ip' || $value['type']=='deliveryLimitations:Time:Date'){
						
						if($value['type']=='deliveryLimitations:Time:Date'){
							
							$dateformat	 = $value['data']['date'];
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
			
			
			//echo $aclPlugins.'<br>'.$compiledLimit;die;
			$this->User_Model->updatelimitation($bannerid, $aclPlugins, $compiledLimit);
			}
		}
		
		
		/* $data['objAllCountries']				= $this->User_Model->getcountrylist();
		$data['aclplugins']						= $this->User_Model->getlimitation($bannerid);
		if(isset($data['aclplugins'][0]->compiledlimitation)){
			$limitations 		= $data['aclplugins'][0]->compiledlimitation;
			$start				= strpos($limitations,'(')+2;
			$end				= strpos($limitations,')')-6;
			$length				= $end - $start;
			$limitValue			= substr($limitations, $start, $length);
			$limitValueArr		= explode(',',$limitValue);
			$data['aclplugins'][0]->compiledlimitation	= $limitValueArr; 
			
			
		} */
		
		//$data['compiledLimit']				= ;
		//echo '<pre>';print_r($_POST);die;
		if(isset($_POST['action']['new'])){
			$acls						= array();
			$limitationDetails			= $this->User_Model->getlimitation($bannerid);
			if(strlen($limitationDetails->acl_plugins)) {
				$acl_plugins 				= explode('and', $limitationDetails->compiledlimitation);
				$pluginData				    = explode(',', $limitationDetails->acl_plugins);
				//echo '<pre>';print_r($acl_plugins);
				//echo '<pre>';print_r($pluginData);die;

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
			$this->User_Model->updatelimitation($bannerid, $aclPlugins, $compiledLimit);
			$acls							= array();
			
		 }else if(isset($_GET['action']['clear'])){
			$aclPlugins		= '';
			$compiledLimit	= '';
			$this->User_Model->updatelimitation($bannerid, $aclPlugins, $compiledLimit);
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
			$limitationDetails			= $this->User_Model->getlimitation($bannerid);
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

		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/banner_acl", $data);
		
	}
	
	public function linked_trackers(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		//$data['targetingchannel']			= $this->User_Model->getchannels();
		$data['activeaction']				= 'linked_trackers';
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/linked_trackers", $data);
	}
	
	
	public function zone_include(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		$data['activeaction']				= 'zone_include';
		$data['advertiser']					= $this->User_Model->getadvertiser();
		if(isset($_GET['clientid'])){
			$clientid					= $this->input->get('clientid');
			$data['clientszone']		= $this->User_Model->getadvertiser($clientid);
			$data['campaign']			= $this->User_Model->getcampaigns($clientid);
			if(isset($_GET['campaignid'])){
				$campaignid				= $this->input->get('campaignid');
				$data['campaignzone']	= $this->User_Model->getcampaigns(null,$campaignid);
				//echo '<pre>';print_r($data['campaignzone']);die;

				$camidArr				= array($campaignid);
				$data['banners']		= $this->User_Model->getclientbanner($camidArr);
			}else{
				$campaignid					= $this->User_Model->getcampaignids($clientid);
				foreach($campaignid as $key => $value){
					$array[]	= $value->campaignid;
				}
				
				//echo '<pre>';print_r($array);die;
				if(isset($array)){
					$data['banners']			= $this->User_Model->getclientbanner($array);
				}else{
					
				}
				//echo $this->db->last_query();die;
			}
			//echo '<pre>';print_r($data['banners']);die;
		}
		
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/zone_include", $data);
	}
	
	public function zone_probality(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		$data['targetingchannel']			= $this->User_Model->getchannels();
		$data['activeaction']				= 'zone_probability';
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/zone_probability", $data);
	}
	
	public function zone_invocation(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		$data['targetingchannel']			= $this->User_Model->getchannels();
		$data['activeaction']				= 'zone_invocation';
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/zone_invocation", $data);
		
	}
	
	public function zone_advance(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		$data['targetingchannel']			= $this->User_Model->getchannels();
		$data['activeaction']				= 'zone_advance';
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/zone_advance", $data);
	}
	
	public function getsearchsuggestion(){
		$id 			= $this->input->post('id');
		$key 			= $this->input->post('key');
		
		if($id	== 'campaigns'){
			$column 		= 'campaignname';
			$returnColumn	= '';
		}
		if($id	== 'clients'){
			$column 		= 'clientname';
			$returnColumn	= 'clientid,clientname';

		}
		$suggestionData = $this->User_Model->getsuggestion($id, $key, $column, $returnColumn);
		//echo $this->db->last_query();
		echo json_encode($suggestionData);
		
	}
	
	
	public function zone(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'zones';
		if(isset($_GET['affiliateid'])){
			$affiliateid				= $this->input->get('affiliateid');
			$zone['affiliateid']		= $affiliateid;
		}else{
			$type						= 'affiliates';
			$data['default']			= $this->User_Model->getDefault($type,'affiliateid,agencyid,name');
			if(isset($_POST['default'])){
				$zone['affiliateid']	= $this->input->post('default');;
			}
			$affiliateid				= $data['default'][0]->affiliateid;
		}
		if($this->input->post('submit')){
			$zone['zonename']				= $this->input->post('zonename');
			$zone['description']			= $this->input->post('description');
			$zone['delivery']				= $this->input->post('delivery');
			$zone['zonetype']				= $this->input->post('sizetype');
			//$zone['size']					= $this->input->post('size');
			$zone['width']				= $this->input->post('width');
			$zone['height']				= $this->input->post('height');
			$zone['comments']			= $this->input->post('comments');
			if(isset($_GET['affiliateid']) && isset($_GET['zoneid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$zoneid						= $this->input->get('zoneid');

				$id							= $this->User_Model->addzone($zone, $affiliateid, $zoneid);
				$data['affiliates']			= $this->User_Model->getzones($affiliateid, $zoneid);
				$data['msg']				= 'zone is successfully updated';
			}else{
				$affiliateid				= $this->input->get('affiliateid');
				$zoneid						= $this->User_Model->addzone($zone, $affiliateid);
				$data['msg']				= 'zone is successful added';
			}
			//echo '<pre>';print_r($zone);die;
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/zone",	$data);
		}else{
			if(isset($_GET['affiliateid']) && isset($_GET['zoneid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$zoneid						= $this->input->get('zoneid');
				$data['zones']				= $this->User_Model->getzones($affiliateid, $zoneid);
			}
			//echo '<pre>';print_r($data);die;

			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/zone");
		}
		
	}
	
	function viewzone(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewzones';
		if(isset($_GET['affiliateid']) && isset($_GET['zoneid'])){
			$affiliateid				= $this->input->get('affiliateid');
			$data['affiliates']			= $this->User_Model->getzones($affiliateid, $zoneid);
			$data['msg']				= 'zone is successfully updated';
		}elseif(isset($_GET['affiliateid'])){
			$affiliateid					= $_GET['affiliateid'];
			$data['zones']					= $this->User_Model->getzones($affiliateid);
		}else{
			$data['zones']					= $this->User_Model->getzones();
		}
		
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/viewzones", $data);
	}
	
	public function website(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'website';
		if($this->input->post('submit')){
			//echo '<pre>';print_r($_POST);
			$model['agencyid']						= 1;
			$model['website']       				= $this->input->post('website');
			$model['name']							= $this->input->post('name');
			$model['contact']						= $this->input->post('contact');
			$model['email']   						= $this->input->post('email');
			if(isset($_GET['affiliateid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$id							= $this->User_Model->addwebsite($model, $affiliateid);
				$data['affiliates']			= $this->User_Model->getwebsites($affiliateid);
				$data['msg']				= 'website is successfully updated';
			}else{
				$newbannerId					= $this->User_Model->addwebsite($model);
				$data['msg']					= 'website is successful added';
			}
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/website",	$data);
		}else{
			if(isset($_GET['affiliateid'])){
				$affiliateid				= $this->input->get('affiliateid');
				$data['affiliates']			= $this->User_Model->getwebsites($affiliateid);
			}
			//echo '<pre>';print_r($data);die;

			
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/website");
		}
		
	}
	
	
	
	
	public function viewwebsite(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewwebsite';
		$data['affiliates']				= $this->User_Model->getwebsites();
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/viewwebsite", $data);
	}
	
	/**-------------------------Start of banner module-----------------*/
	
	public function activevideobanner(){
		$ext_bannertype		= $this->input->post('ext_bannertype');
		$activeid			= $this->input->post('activeid');
		$inactiveid			= $this->input->post('inactiveid');
		$bannerid			= $this->input->post('bannerid');


		$id					= $this->User_Model->activevideobanner($activeid, $inactiveid);
		$data1['multiple_banner_existence']	= 'yes';
		$data1['ext_bannertype']			= $ext_bannertype;
		$this->User_Model->updatebanner("banners", $data1, $bannerid);


		
	}
	
	
	public function savevastreplacementbanner(){
		//process vast tags and get input for player
		$tag							= $this->input->post('tag');
		$newtag 						= trim($tag, ' ');
		$bannerid						= $this->input->post('bannerid');

		
		$banner['description']			= "multiple banner";
		$combinedata					= vastparser($newtag, $banner['description']);
		$banner							= $combinedata[0];
		$videodata						= $combinedata[1];
		$videodata['banner_id']			= $bannerid;
		$videodata['status']			= "inactive";
		$videodata['vast_tag']			= $tag;


		
		$id									= $this->User_Model->addvideoad(null, $videodata);
		$data1['multiple_banner_existence']	= 'yes';
		$data1['ext_bannertype']			= 'upload_video';

		$this->User_Model->updatebanner("banners", $data1, $bannerid);
		 echo json_encode(array('id'=>$id)); 
	}
					
					
					
	public function banner(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		//echo '<pre>';
		//print_r($_SERVER['REMOTE_ADDR']);die;
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'banner';
		
		//get active content 
		/* 	$activecontent		= $this->User_Model->getactivecontent();
			if(!empty($activecontent)){
				if(isset($activecontent[0])){
					$data['vidcontent1']			= $activecontent[0]->name;
					
				}else{
					$data['vidcontent1']			= 'no_vidd'; 
					
				}
				if(isset($activecontent[1])){
					$data['vidcontent2']			= $activecontent[1]->name;

					
				}else{
					$data['vidcontent2']			= 'no_vidd';
					
				}
				if(isset($activecontent[3])){
					$data['vidcontent3']			= $activecontent[2]->name;
					
				}else{
					$data['vidcontent3']			= 'no_vidd';
					
				}
				if(isset($activecontent[4])){
					$data['vidcontent4']			= $activecontent[3]->name;
					
				}else{
					$data['vidcontent4']			= 'no_vidd';
					
				}
				if(isset($activecontent[5])){
					$data['vidcontent5']			= $activecontent[4]->name;
					
				}else{
					$data['vidcontent5']			= 'no_vidd';
					
				}
				
			}else{
				$data['vidcontent1']			= $this->User_Model->getanycontent();
				$data['vidcontent2']			= 'no_vidd';
				$data['vidcontent3']			= 'no_vidd';
				$data['vidcontent4']			= 'no_vidd';
				$data['vidcontent5']			= 'no_vidd';
				
			} */
			
		if ($this->input->post('submit')) {
			//echo '<pre>';print_r($_POST);print_r($_FILES);die;
			$bannerType						= $this->input->post('type');
			$banner['description']			= $this->input->post('description');  

			if($bannerType == 'web'){
				$banner['storagetype']	= 'web';
				$target_dir 	= $_SERVER['DOCUMENT_ROOT']."/report/adserver/assets/banners/";
				$fileName		= basename($_FILES["upload"]["name"]);
				$target_file 	= $target_dir . $fileName;
				if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
					$type		= $_FILES['upload']['type'];
					$imagetypes	= substr($type, 6);
					$banner['contenttype'] 		= $imagetypes;
					$banner['filename'] 		= $fileName;
				}
				$banner['url']					= $this->input->post('url');          
				$banner['alt']        			= $this->input->post('alt');
				$banner['bannertext'] 			= $this->input->post('bannertext');
				$banner['target']				= $this->input->post('target');
				$banner['tracking_pixel']		= $this->input->post('tracking_pixel');

				
				//$banner['imageurl']			= $this->input->post('imageurl');    
				//$banner['htmltemplate']		= $this->input->post('htmltemplate');
			}
			
			if($bannerType == 'html5'){
				$banner['storagetype']		= 'html5';
				$banner['contenttype'] 		= 'html5';
				$banner['htmltemplate']		= $this->input->post('html5');
				//$banner['htmlcache']		= $this->input->post('html5');
				$banner['url']				= $this->input->post('html_url');          


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
			
		
			
			
			if($bannerType == 'html'){	
				$banner['storagetype']	= 'html';
				$adtype					= $this->input->post('upload_video');
				if($adtype 	== 'create_video'){
					$banner['ext_bannertype']	= $adtype;
					$target_dir 	= $_SERVER['DOCUMENT_ROOT']."/report/adserver/assets/banners/";
					$fileName		= basename($_FILES["video_upload"]["name"]);
					$target_file 	= $target_dir . $fileName;
					if (move_uploaded_file($_FILES["video_upload"]["tmp_name"], $target_file)) {
						$type		= $_FILES['video_upload']['type'];
						$banner['contenttype'] 		= 'html';
						$banner['filename'] 		= $fileName;
						$videodata['vast_video_outgoing_filename']	= base_url().'assets/banners/'.$fileName;
					}
					$videodata['skip']			= $this->input->post('skip') ? 1 : 0;
					if($videodata['skip']){
						$videodata['skip_time'] = $this->input->post('skiptime');
					}else{
						$videodata['skip_time'] = 0;
					}
					$videodata['content_video']					= $this->input->post('content_video');  
					$videodata['vast_video_bitrate']			= $this->input->post('vast_video_bitrate');  
					$videodata['vast_video_width']				= $this->input->post('vast_video_width');  
					$videodata['vast_video_height']				= $this->input->post('vast_video_height');
					$type										= $this->input->post('vast_video_type');
					$videodata['vast_video_type']				= 'video/'.$type;
					$videodata['vast_video_delivery']			= $this->input->post('vast_video_delivery');
					$videodata['vast_video_duration']			= $this->input->post('vast_video_duration');  
					
					
					

					
					$videodata['mute']					= $this->input->post('mute') ? 1 : 0;  
					$videodata['start_pixel']			= $this->input->post('start_pixel');          
					$videodata['quater_pixel']			= $this->input->post('quater_pixel');          
					$videodata['mid_pixel']				= $this->input->post('mid_pixel');          
					$videodata['end_pixel']				= $this->input->post('end_pixel');
					$videodata['third_party_click']		= $this->input->post('click_tracking_url');
					$videodata['status']				= "active";


					//$videodata['third_party_click']		= $this->input->post('third_party_click');
					//$banner['imageurl']					= $this->input->post('imageurl');    
					//$banner['htmltemplate']				= $this->input->post('htmltemplate');
					//echo '<pre>';print_r($videodata);die;
				}else{
					//process vast tags and get input for player
					$tag				= $this->input->post('tag');
					$newtag 			= trim($tag, ' ');

					$combinedata		= vastparser($newtag, $banner['description']);
					$banner				= $combinedata[0];
					$videodata			= $combinedata[1];
					$videodata['vast_tag']	= $tag;  
					//echo '<pre>';print_r($banner);print_r($videodata);die;
				}
				$banner['url']			= $this->input->post('vast_dest_url');
			}

			
			$banner['comments']				= $this->input->post('comments');     
			//$banner['adserver']  			= $this->input->post('adserver');   
			$banner['keyword']				= $this->input->post('keyword');      
			$banner['weight']				= $this->input->post('weight');
			
			
			
			if(isset($_GET['bannerid'])){
				if($banner['storagetype'] == 'web'){
					$banner['width'] 				= $this->input->post('width');      
					$banner['height'] 				= $this->input->post('height');
				}

				$bannerid						= $this->input->get('bannerid');
				$campaignid						= $this->input->get('campaignid');
				$banner['campaignid']			= $campaignid;
				
				$data['banner']					= $this->User_Model->addbanner($banner, $bannerid, $campaignid);
				$data['banner'][0]->clientid	= $this->input->get('clientid');
				
				if($banner['storagetype'] == 'html'){
					if($this->User_Model->checkmultipleBannerType($bannerid)){
						$status		= 'active';
						
					}else{
						$status		= '';
						
					}
					
					if($banner['ext_bannertype']=='upload_video'){
						$videodata['banner_id']			= $bannerid;
						$data['videos']					= $this->User_Model->addvideoad($bannerid, $videodata, $status);
					}else{
						$videodata['banner_id']			= $bannerid;
						$data['videos']					= $this->User_Model->addvideoad($bannerid, $videodata, $status);
						
					}
						$clickurl						= base_url().'users'.'/adtrack?bannerid='.$data['banner'][0]->bannerid;
						$content						= $this->User_Model->getcontentvideo($data['videos'][0]->content_video);
						if(!empty($content)){
							$data['vidcontent1']			= $content->name;
							$data['videotitle']				= $content->title;
							if($content->source !=""){
								$data['source']				= "source:".$content->source;
							}else{
								$data['source']				= "";
								$data['vidcontent1']		= "";
								
							}
						}else{
							$data['source']				= "";
							$data['vidcontent1']		= "";
							
						}	

						$data['videoclickurl']			= $clickurl;
				}
				$data['msg']						= 'Banner is successfully updated';
				$data['contentVideo']				= $this->User_Model->getvideos();
				//echo '<pre>';print_r($data);die;
				
			}else{
				//echo 'india';
				//echo '<pre>';print_r($banner);print_r();print_r($videodata);die;
				if(isset($_GET['campaignid'])){
					$banner['campaignid']				= $_GET['campaignid'];
				}else{
					$banner['campaignid']				= 1;
				}
				
				$newbannerId						= $this->User_Model->addbanner($banner);
				if($banner['storagetype'] == 'html'){
					$videodata['banner_id']			= $newbannerId;
					$newbannerId					= $this->User_Model->addvideoad(null, $videodata);
					$data['videos']					= $this->User_Model->getvideoad($newbannerId);

				}
				$data['msg']					='Banner is successful added';
			}
			
			
			//echo '<pre>';print_r($data['banner']);die;
			$this->load->view('admin_includes/header', $data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/banner",	$data);
		}else{
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
				$clickurl					= base_url().'users'.'/adtrack?bannerid='.$data['banner'][0]->bannerid;
				$data['videoclickurl']		= $clickurl;

				if($data['banner'][0]->multiple_banner_existence){
					$status					= "active";
					$vastInactiveBannerId	= $this->User_Model->getinactivevideoadid($data['banner'][0]->bannerid);
					$data['inactivevideoid']	= $vastInactiveBannerId;
				}else{
					$status	= "";
					
				}
				$data['videos']				= $this->User_Model->getvideoad($data['banner'][0]->bannerid, '', $status);
				$data['videoclickurl']		= $clickurl;
			}
		}
		
		
		
			if(isset($data['videos'][0])){
				$content						= $this->User_Model->getcontentvideo($data['videos'][0]->content_video);
				if(!empty($content)){
					$data['vidcontent1']			= $content->name;
					$data['videotitle']				= $content->title;
					if($content->source !=""){
						$data['source']				= "source:".$content->source;
					}else{
						$data['source']				= "";
						$data['vidcontent1']		= "";

						
					}
				}else{
					$data['source']				= "";
					$data['vidcontent1']		= "";
				}
			}
			$data['contentVideo']			= $this->User_Model->getvideos();
			//echo '<pre>';print_r($data['videos']);print_r($data['banner']);die;
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/banner");
		}
	}
	
	public function viewbanner(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'viewbanner';
		
		$role							= $this->session->userdata('role');
		if($role == 'admin'){
			$userId		= null;
			
		}else{
			$userId									= $this->session->userdata('uid');
			$clientIds								= $this->User_Model->getclients($userId);
			if(empty($clientIds)){
				$campaignIds							= array();
			}else{
				$campaignIds							= $this->User_Model->campaignIds($clientIds);
				
			}
			
		}
		//echo '<pre>';print_r($clientIds);print_r($campaignIds);die;
		
		if(isset($_GET['campaignid'])){
			$campaignid					= $this->input->get('campaignid');
			$data['banner']				= $this->User_Model->getbanner($campaignid, null, null);
			
		}elseif(isset($_GET['clientid'])){
			$data['banner']				= $this->User_Model->getbanner();	
		}else{
			if(!(is_null($userId))){
				if(!empty($campaignIds)){
					$data['banner']				= $this->User_Model->getclientbanner($campaignIds);
				}else{
					$data['banner']				= array();
					
				}
			}else{
				$data['banner']				= $this->User_Model->getbanner();	

				
			}
		}
		
		
		//echo '<pre>';print_r($data['banner']);die;
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar',		$data);
		$this->load->view("admin/viewbanner",	$data);
	}
	
	
	
	
	
	/**-------------------------Start of compaign module-----------------------------------------------*/
	
	public function compaign(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']					= 'inventory';
		$data['activeaction']			= 'compaign';
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
					$campaign['status'] 					= 0; 
					
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
			//echo '<pre>';print_r($campaign);die;
			
			$campaign['capping'] 					= $this->input->post("capping");
			$campaign['session_capping'] 			= $this->input->post("session_capping");
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
				$id							= $this->User_Model->addcampaign($campaign, $clientid, $campaignid);
				$data['campaign']			= $this->User_Model->getcampaigns($clientid, $campaignid);
				if(!is_null($data['campaign'][0]->tracking_type)){
					$limit								= $data['campaign'][0]->tracking_type;
					
					$data['campaign'][0]->target_value	= $data['campaign'][0]->$limit;
				}
				
				//echo '<pre>';print_r($data['campaign'][0]);die;
				
				

				
				
				if($data['campaign'][0]->activate_time > date("Y-m-d")){
					$data['campaign'][0]->activeaction_calc	= 'yes';
					$active 							= $data['campaign'][0]->activate_time;
					$utformat							= date('d-m-Y',strtotime($active));
					$data['campaign'][0]->activate_time	= $utformat;
				}else{
					$data['campaign'][0]->activeaction_calc	= 'no';
				}
				
				
				
				
				
				if(!is_null($data['campaign'][0]->expire_time)){
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
					//echo '<pre>';print_r($campaign);die;
					$id							= $this->User_Model->addcampaign($campaign, $clientid);
					$insertId 					= $this->db->insert_id();
					$data['msg']				= 'Campaign is successfully added';

				}
			}
			
			if(isset($data['targeting'][0]->targetid)){
				$data['target']			= '&targetid='.$data['targeting'][0]->targetid;
			}else{
				$data['target']			= '';
			}
			
			$this->load->view('admin_includes/header', $data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/compaign",	$data);
		}else{
			if(isset($_GET['clientid']) && isset($_GET['campaignid'])){
				$clientid					= $this->input->get('clientid');
				$campaignid					= $this->input->get('campaignid');
				$data['campaign']			= $this->User_Model->getcampaigns($clientid, $campaignid);
				
				$data['targeting']			= $this->User_Model->gettargeting($campaignid);
				if(isset($data['targeting'][0]->targetid)){
					$data['target']			= '&targetid='.$data['targeting'][0]->targetid;
				}else{
					$data['target']			= '';
				}
			
			
			}elseif(isset($_GET['clientid'])){
				$clientid					= $this->input->get('clientid');
				$clientDetails				= $this->User_Model->getadvertiser($clientid);
				if(isset($clientDetails[0])){
					$data['defaultCampaign']	= $clientDetails[0]->clientname;
				}
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
											
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/compaign");
		}
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
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']						= 'inventory';
		$role								= $this->session->userdata('role');
		if($role == 'admin'){
			$userId	= null;
		}else{
			$userId	= $this->session->userdata('uid');;
			
		}
		
		$data['advertiserlist']			= $this->User_Model->getadvertiser($userId);
		$clientId						= $this->User_Model->getclients($userId);
		
		
		if(isset($_GET['clientid'])){
			$clientid					= $this->input->get('clientid');
			$clientType					= 'Single';
			$data['campaign']			= $this->User_Model->getcampaigns($clientid, null, $clientType);
			if(empty($data['campaign'])){
				$data['nocampaign']		= $this->User_Model->getadvertiser(null, $clientid);
			}
			
		}elseif(isset($_GET['campaignid'])){

			$campaignid					= $this->input->get('campaignid');	
			$data['campaign']			= $this->User_Model->getcampaigns(null, $campaignid, null);
			if($data['campaign'][0]->activate_time > date("Y-m-d")){
				$data['campaign'][0]->activeaction_calc	= 'yes';
				$active 							= $data['campaign'][0]->activate_time;
				$utformat							= date('d-m-Y',strtotime($active));
				$data['campaign'][0]->activate_time	= $utformat;
			}else{
				$data['campaign'][0]->activeaction_calc	= 'no';
			}
			
			
			if(isset($data['campaign'][0]->expire_time)){
				$data['campaign'][0]->expirationtion_calc	= 'yes';
				$active 							= $data['campaign'][0]->expire_time;
				$utformat							= date('d-m-Y',strtotime($active));
				$data['campaign'][0]->expire_time	= $utformat;
			}else{
				$data['campaign'][0]->expirationtion_calc	= 'no';
			}
		}else{
			
			$clientType					= 'ALL';
			if(empty($clientId)){
				$data['campaign']			= array();

			}else{
				$data['campaign']			= $this->User_Model->getcampaigns($clientId, null, $clientType);
			}
		}
		
		
		if(isset($_GET['key'])){
			$data['searchInput']		= $this->input->get('key');
			
		}

		
		
		//echo '<pre>';print_r($data['campaign']);die;

		$data['activeaction']			= 'viewcompaign';
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view("admin/viewcompaign");
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	public function play(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';
		$data['videoName']		= $this->input->get('name');
		$data['videoId']		= $this->input->get('id');
		$this->load->view('playvideo',	$data);
	}
	
	 
	
	
	public function listuploadsvideos(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';
		$this->db->select("*");
		$this->db->from('uploads');
		//$this->db->where('id', $id);
		$query 				= $this->db->get();
		if ($query->num_rows() > 0) {
			$result					= $query->result();
			$data['video']			= $result;
		}else{
			$data['msg']		= 'No Video Found';
		}
		//echo '<pre>';print_r($data);die;
		
		$this->load->view('listuploadsvideos', $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function editbanner(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
		$data['cat']			= 'inventory';

		$id				= $this->session->userdata('id');
		if ($this->input->post('update')) {
			$name		= $this->input->post('name');	
			$lname		= $this->input->post('lname');
			$address	= $this->input->post('address');
			$city		= $this->input->post('city');
			$country	= $this->input->post('country');
			$state		= $this->input->post('state');
			$url		= $this->input->post('url');
			$companyName= $this->input->post('company_name');
			$email		= $this->input->post('email');
			$phone		= $this->input->post('phone');
			$this->db->query("update  `banner` set name = '$name', 	lname= '$lname', city = '$city', state	= '$state',url	= '$url',
			company_name= '$companyName', email	='$email',phone	= '$phone',	address	= '$address' where id=$id");
		}
		
		$this->db->select("*");
		$this->db->from('banner');
		//$this->db->where('role', 'banner');
		$this->db->where('id', $id);
		$query 				= $this->db->get();
		if ($query->num_rows() > 0) {
			$result					= $query->result();
			$data['banner']		= $result;
		}else{
			$data['banner']		= '';
		}
		$this->load->view('editbanner', $data);
			
		
		
	}
	
	public function deletebanner(){
		$data['cat']			= 'inventory';
		$advertzId				= $this->input->post('id');
		$this->db->query("update `banner` set status	= '1' where id=$advertzId");
	}
	
	/**------compaing section ---------------------------*/
	/**------channel section ---------------------------*/
	/**------zone section ---------------------------*/
	public function addpublisher(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
				$data['cat']			= 'inventory';

		if ($this->input->post('submit')) {
			$name		= $this->input->post('name');
			$lname		= $this->input->post('lname');
			$address	= $this->input->post('address');
			$email		= $this->input->post('email');
			$url		= $this->input->post('url');
			$companyName= $this->input->post('company_name');
			$city		= $this->input->post('city');
			$country	= $this->input->post('country');
			$state		= $this->input->post('state');
			$phone		= $this->input->post('phone');
			$this->db->query("insert into `publisher` (`name`,`lname`,`address`,`city`,`country`,`state`,`url`,`company_name`,`email`,`phone`)values(
			'$name','$lname','$address','$city','$country','$state','$url','$companyName','$email','$phone')");
			$data['msg']	= 'You are successful added';
			$this->load->view("publisher",	$data);
		}else{
			$this->load->view("publisher");
		}
	}
	
	public function editpublisher(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';

		$id			= 1;
		if ($this->input->post('update')) {
			$name		= $this->input->post('name');
			$email		= $this->input->post('email');
			$address	= $this->input->post('address');
			$url		= $this->input->post('url');
			$companyName= $this->input->post('company_name');
			$city		= $this->input->post('city');
			$country	= $this->input->post('country');
			$state		= $this->input->post('state');
			$this->db->query("update  `publisher` set name ='$name',city='$city',country='$country',state='$state',url='$url',company_name='$companyName',email='$email',address='$address'
			where id=$id");
			$this->db->select("*");
			$this->db->from('publisher');
			//$this->db->where('role', 'publisher');
			$query 				= $this->db->get();
			if ($query->num_rows() > 0) {
				$result		= $query->result();
				$data['publisher']	= $result;
			}else{
				$data['publisher']	= '';
			}
			$this->load->view('editpublisher', $data);
		}else{
			$this->db->select("*");
			$this->db->from('publisher');
			//$this->db->where('role', 'publisher');
			$this->db->where('id', $id);

			$query 				= $this->db->get();
			if ($query->num_rows() > 0) {
				$result		= $query->result();
				$data['publisher']	= $result;
			}else{
				$data['publisher']	= '';
			}
			$this->load->view('editpublisher', $data);
		}
	}
	
	public function deletepubliser(){
		$data['cat']			= 'inventory';	
		$data['cat']			= 'inventory';

		$advertzId			= $this->input->post('id');
		$this->db->query("update `publisher` set status	= '1' where id=$advertzId");
	}
	
	public function viewpubliser(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
	$data['cat']			= 'inventory';
		$this->db->select("id, name, lname, company_name");
		$this->db->from('publisher');
		$this->db->where('status','0');
		$query 				= $this->db->get();
		if ($query->num_rows() > 0) {
			$result		= $query->result();
			$data['publisher']	= $result;
		}else{
			$data['publisher']	= '';
		}
		
		$this->load->view('viewpublisher', $data);
		
	}
	
	
	
	/**-------------------------Start of advertisemnt module-----------------------------------------------*/
	
	public function advertisement(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
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
				$data['advertiser']	= $this->User_Model->addadvertiser($userdata, $advertiser, $clientid, $userId);
				$data['msg']		= "Advertiser Is Updated Successfully ";
			}else{
				$id 					= $this->User_Model->addadvertiser($userdata, $advertiser);
				$data['msg']			= "Advertiser Is Successful Added";
			}
			$this->load->view('admin_includes/header', $data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/advertisement",	$data);
		}else{
			if(isset($_GET['id'])){
				$clientid						= $this->input->get('id');
				$data['advertiser']				= $this->User_Model->getadvertiser($clientid);
				//echo $this->db->last_query();die;
				//echo '<pre>';print_r($data);die;
			}
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view("admin/advertisement");
		}
	}
	
	public function deleteadvertiser(){	
	    $data['cat']		= 'inventory';
		$advertzId			= $this->input->post('id');
		$advertzId			= substr($advertzId, 1);
		if(strpos($advertzId, 'main_0') === 0){
			$advertzId		= substr($advertzId, 7);
		}
		$this->db->query("update `clients` set status = '0' where clientid in ('$advertzId')");
		
	}
	
	public function viewadvertiser(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }

		$data['cat']						= 'inventory';
		$data['activeaction']				= 'viewadvertiser';
		$role								= $this->session->userdata('role');
		if($role == 'admin'){
			$userId	= null;
		}else{
			$userId	= $this->session->userdata('uid');;
			
		}
		
		if(isset($_GET['clientid'])){
			$clientid						= $this->input->get('clientid');
			$data['advertiser']				= $this->User_Model->getadvertiser($userId, $clientid);
		}else{
			$data['advertiser']				= $this->User_Model->getadvertiser($userId);
		}
		
		if(isset($_GET['key'])){
			$data['searchInput']		= $this->input->get('key');
			
		}
		
		
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view('admin/viewadvertiser',  $data);
	}
	
	public function getadvertiser(){	
	$data['cat']			= 'inventory';
		$data			= $this->User_Model->getadvertiser();
		echo json_encode($data);
	}
	
	
	public function viewpublisher(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';
		$this->db->select("id,name, lname, company_name");
		$this->db->from('advertiser');
		$this->db->where('status','0');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result		= $query->result();
			$data['publisher']	= $result;
		}else{
			$data['publisher']	= '';
		}
		$this->load->view('viewpublisher', $data);
	}
	
	
	
	 
	 
	 
	 
	/* public function index(){	
		$data['cat']			= 'inventory';
		if($this->session->userdata('name')){
			$this->load->view('advertisement');
		}else{
			$this->load->view('login');
		}
	}*/
	
	public function login(){
		$data['cat']			= 'inventory';
		if($this->input->post('submit')){
			$email		= $this->input->post('email');
			$pass		= $this->input->post('password');
			$query		= $this->db->query("SELECT `id`,`f_name` FROM `user` WHERE email='$email' and password='$pass'");
			if($query->num_rows()==1){
				foreach ($query->result() as $row){
					$fname	= $row->f_name;
					$id		= $row->id;
				}
				$this->session->set_userdata("firstname", $fname);
				$this->session->set_userdata("id", $id);
				$this->load->view('welcome');
			}else{
				$data['msg']	='No user exist with this user and password';
				$this->load->view('login', $data);
			}
		}else{
			$this->load->view('login');
		}
	}
	
	public function profile(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
		$data['cat']			= 'inventory';
		$this->load->view('advertisement');
	}
	
	
	
	
	public function logout(){	
	$data['cat']			= 'inventory';
		$this->load->helper('url');
		$username		=	$this->session->userdata("name");
		$this->session->sess_destroy();
		redirect('user/login');
		
	}
	
	public function register(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
	$data['cat']			= 'inventory';
		if($this->input->post('submit')){
			$fname		= $this->input->post('fname');
			$lname		= $this->input->post('lname');
			$email		= $this->input->post('email');
			$pass		= $this->input->post('password');
			$this->db->query("insert into `user` (`f_name`,`l_name`,`email`,`password`)values('$fname','$lname','$email','$pass')");
			$id 		= $this->db->insert_id();
			$this->session->set_userdata("name", $fname);
			$this->session->set_userdata("id", 	 $id);
			$this->load->view('profile');
		}else{
			$this->load->view('register');
		}
	}
	
	
	public function myfunc(){
		$data['cat']			= 'inventory';
			$mail 			   = new PHPMailer;
			$mail->isSMTP();                                      	// Set mailer to use SMTP
			$mail->Host 	= 'smtp.gmail.com';  					// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               	// Enable SMTP authentication
			$mail->Username = 'princemadhupur@gmail';               // SMTP username
			$mail->Password = 'Prince12';                           // SMTP password
			//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port 	= 465;                                  // TCP port to connect to

			$mail->setFrom('princemadhupur@gmail', 'Prince Pandey');
			$mail->addAddress('prince.panday@rensoftglobal.com', 'Prince Pandey');
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
		}
		
		function mail(){	
		$data['cat']			= 'inventory';
		 //echo phpinfo();die;
		$recepaint		= 'princemadhupur@fastconversion.com';
		$body	   		= 'hello india';
		$creator  		= 'princemadhupur@fastconversion.com';
		$sub	   		= 'test mail';
		$mail 					= new PHPMailer(); // create a new object
		$mail->IsSMTP(); 		// enable SMTP
		$mail->SMTPDebug 		= 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth 		= true; // authentication enabled
		$mail->SMTPSecure 		= 'ssl'; // secure transfer enabled REQUIRED for GMail
		$mail->Host 			= "smtp.gmail.com";
		$mail->Port 			= "465"; // or 587
		$mail->IsHTML(true);
		$mail->Username 		= 'princemadhupur@fastconversion';//"dev@selfeedin.com";
		$mail->Password 		= 'Prince12';//"hy3IsCyxwfb";
		$mail->SetFrom($creator);
		if($sub){
			$mail->Subject 			= $sub;
		}else{
			$mail->Subject 			= "Battle Request";
		}
		$mail->Body 			= $body;
		$mail->AddAddress($recepaint);
		$mail->Send();
		      
    }
   
	
		public function sendemail(){
			$data['cat']			= 'inventory';
			if($this->input->post('submit')){
				$email			= $this->input->post('email');
				$subject		= $this->input->post('sub');
				$message		= $this->input->post('msg');
				$senderId		= 1;
				$config			= array('name'=>'prince');
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('princemadhupur@gmail'); // change it to yours
				$this->email->to('princemadhupur@gmail');// change it to yours
				$this->email->subject('Resume from JobsBuddy for your Job posting');
				$this->email->message($message);
				if($this->email->send()){
				}else{
					show_error($this->email->print_debugger());
				}	$this->db->query("insert into `email` (`email`,`subject`,`message`,`sender_id`)values('$email','$subject','$message',$senderId)");
					$data['msg']	= 'Your email is successful send';
					$this->load->view("email",	$data);
				}else{
					$this->load->view('email');
				}
		}
	


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
	
	
 	//load Page Listing Page
    public function index() {
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		
		$data['users']			= $this->User_Model->fetchusers();
		$data['activeaction']	= 'viewuser';
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view('admin/users/index', $data);   
    }
 
	function json_get_teacher() {
		$data		= $this->User_Model->fetchteachers();
		echo json_encode($data);
	}
 
 function json_check_user_unique(){	
 $data['cat']			= 'inventory';
	 $postdata 		= file_get_contents("php://input");
        $request 	= json_decode($postdata);
        $uname 		= $request->uname;
		$data		= $this->User_Model->checkuserunique($uname);
		if($data == 1)
		echo 'Duplicate';
		echo 'Unique';
	}
 

 
	//Load Add new page
	public function create(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		

		$data['cat']					= 'inventory';
		$data['activeaction']			= 'createuser';


		if($this->input->post('submit')){
			$userdata['username']	= $this->input->post('username');
			$userdata['password'] 	= $this->input->post('password');
			$userdata['firstname'] 	= $this->input->post('firstname');
			$userdata['lastname'] 	= $this->input->post('lastname');
			$userdata['role'] 		= $this->input->post('role');
			$userdata['status'] 	= $this->input->post('->status');
			if(isset($_GET['id'])){
				$userId				= $this->input->get('id');
				$data['users']		= $this->User_Model->AddUser($userdata, $userId);
				$data['msg']		= "User Is Updated Successfully ";
			}else{
				$id 				= $this->User_Model->AddUser($userdata);
				$data['msg']		= "User Is Successful Added";
			}
			$this->load->view('admin_includes/header',$data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view('admin/add', $data);
		}else{
			if(isset($_GET['id'])){
				$userId 				= $this->input->get('id');
				$data['users']			= $this->User_Model->fetchusers($userId);
			}
			$this->load->view('admin_includes/header', $data);
			$this->load->view('admin_includes/left_sidebar', $data);
			$this->load->view('admin/add', $data);
		}
	}
	
	
	public function viewuser(){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
		$data['cat']			= 'inventory';
		$data['users']			= $this->User_Model->fetchusers();
		$data['activeaction']	= 'viewuser';
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar', $data);
		$this->load->view('admin/viewuser',	$data);
	}
	
	
	
	public function deleteuser(){		
		$data['cat']			= 'inventory';
		$userId					= $this->input->post('id');
		$this->db->query("delete from `users` where id = $userId");
	}
	
	public function userstatus(){	
		$data['cat']	= 'inventory';
		$id				= $this->input->post('id');
		$statusArr		= explode('_', $id);
		$userId			= $statusArr[0];
		$status			= $statusArr[1];
		if($status	== 0){
			$status	= 1;
		}else{
			$status	= 0;
		}
		$this->db->query("update `users` set status = '$status' where id = $userId");
		echo json_encode(array('status'	=> $status));
	}
	
	
	public function json_add_user(){		
	$data['cat']			= 'inventory';
    // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable
 
      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
	  $data=array();
	 
	  $data['username']=$request->username;
	  $data['password'] = $request->password;
	  $data['firstname'] = $request->firstname;
	  $data['lastname'] = $request->lastname;
	  $data['role'] = $request->role;
	  $data['userid'] = uniqid('user');
      $data['status'] = $request->status;
	  
      $id = $this->User_Model->AddUser($data);
      if($id)
      {
         echo $result = '{"status" : "success"}';
      }else{
         echo $result = '{"status" : "failure"}';
      }
    }
	//edit page
	public function edit($id=0){
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }		
		//fetch data in variable $data	   
		//view template for editing content
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar');
		$query=$this->User_Model->getdataedit($id);
		
        $this->load->view('admin/users/edit');
		$this->load->view('admin_includes/footer');
		 
		
	}
	
	function json_get_userbyid() {
	$postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $id = $request->id;
	  $data=$this->User_Model->getdataedit($id);
        echo json_encode($data);
 }
 
 
	public function json_edit_user()
 {
   // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable
 
      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $data=array();
	  
	  $data['username']=$request->username;
	  $data['password'] = $request->password;
	  $data['firstname'] = $request->firstname;
	  $data['lastname'] = $request->lastname;
	  $data['role'] = $request->role;
      $data['status'] = $request->status;
	  $gid=$request->id;
	  
     
      if($this->User_Model->updateuser($gid,$data))
      {
         echo $result = '{"status" : "success"}';
      }else{
         echo $result = '{"status" : "failure"}';
      }
    }
	 /**
    * Delete product by his id
    * @return void
    */
    public function json_del_user()
    {
        $postdata = file_get_contents("php://input");
      	$request = json_decode($postdata);
      	$id = $request->id;
        $this->User_Model->remove_item($id);
		
    }//edit
	
	
	
	
	public function settings(){	
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        }
		$data['cat']			= 'inventory';
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar');
		$this->load->view('admin/settings');   
		$this->load->view('admin_includes/footer');
	}
	
	public function settings_change(){	
	$data['cat']			= 'inventory';
		$postdata 			= file_get_contents("php://input");
		$request 			= json_decode($postdata);
		$id					= $request->id;
		$data				= array();
		$data['password']   = $request->password;
		if($this->User_Model->updateuser($id,$data)){
			echo $result = '{"status" : "success"}';
		}else{
			echo $result = $id;
		}
	}
}
?>