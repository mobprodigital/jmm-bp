<?php		
	
	$bannerid						= $this->input->get('bannerid');
	$campaignid						= $this->input->get('campaignid');
	$banner['campaignid']			= $campaignid;
	if($banner['storagetype'] == 'web'){
		$banner['width'] 				= $this->input->post('width');      
		$banner['height'] 				= $this->input->post('height');
	}

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
		
		$clickurl						= $GLOBALS['deliveryCorePath'].'ckvast.php?bannerid='.$data['banner'][0]->bannerid;
		//echo '<pre>';print_r($data['videos']);die;
		$content						= $this->User_Model->getcontentvideo($data['videos'][0]->content_video);
		//if(){
		//}
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
			$cacheArr		= array($banner, $videodata);
			$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_'.$bannerid.'.php';
			file_put_contents($my_file, json_encode($cacheArr));
	}else{
		$banner['bannerid']	= $bannerid;
		$cacheArr		= array($banner);
		$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_'.$bannerid.'.php';
		file_put_contents($my_file, json_encode($cacheArr));
	}
	$data['msg']						= 'Banner is successfully updated';
	$data['contentVideo']				= $this->User_Model->getvideos();
	
	?>