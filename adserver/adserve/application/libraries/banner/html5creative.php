<?php 
	$banner['storagetype']		= 'html5';
	$banner['contenttype'] 		= 'html5';
	$banner['url']				= $this->input->post('html_url');
	$banner['tracking_pixel']	= $this->input->post('html_tracking_pixel');
	$banner['width']			= $this->input->post('hwidth');
	$banner['height']			= $this->input->post('hheight');
	$banner['rich_media_type']	= $this->input->post('rich_media_type');
	
	if($banner['rich_media_type'] == 1 || $banner['rich_media_type'] == 2 || $banner['rich_media_type'] == 3 || $banner['rich_media_type'] == 4){
		$fileName		= basename($_FILES["richmediaimg1"]["name"]);
		$target_file 	= $targetDirImage . $fileName;
		if (move_uploaded_file($_FILES["richmediaimg1"]["tmp_name"], $target_file)) {
			$imageName1		= $fileName;
			$image1Path 	= $GLOBALS['imageURlDir'].$imageName1;
			$banner['filename'] =$fileName;
			
		}else{
			$creativeimage		= $this->input->post('creativeimage');
			$banner['filename'] = $creativeimage;
			$image1Path 		= $GLOBALS['imageURlDir'].$creativeimage;
		}
		
		if($banner['rich_media_type'] != 4){
			$fileName2		= basename($_FILES["richmediaimg2"]["name"]);
			$target_file 	= $targetDirImage . $fileName2;
			if (move_uploaded_file($_FILES["richmediaimg2"]["tmp_name"], $target_file)) {
				
				$imageName2		= $fileName2;
				$image2Path     = $GLOBALS['imageURlDir'].$imageName2;
				$banner['filename2'] =$fileName2;
			}else{
				$creativeimage2			= $this->input->post('creativeimage2');
				$banner['filename2']	= $creativeimage2;
				$image2Path     		= $GLOBALS['imageURlDir'].$creativeimage2;

			}
		}
		
		
		
		if($banner['rich_media_type'] == 1){
			$creativeName	= 'expandorightleft';
			
		}elseif($banner['rich_media_type'] == 2){
			$creativeName = 'expandotopbottom';
			
		}elseif($banner['rich_media_type'] == 3){
			$creativeName = 'pagepusher';
			
		}elseif($banner['rich_media_type'] == 4){
			$creativeName = 'overlay';
		}
		
		$creativeFileName 				= $GLOBALS['libPath'].$creativeName.'.php';
		$creativeContent   	    		= file_get_contents($creativeFileName);
		$creativeContent 				= str_replace("{image1}", "$image1Path", $creativeContent);
		if($banner['rich_media_type'] != 4){
			$creativeContent 				= str_replace("{image2}", "$image2Path", $creativeContent);
		}
		$banner['htmltemplate']			= $creativeContent;
		
		
		//update buster files with image and click url and tracking pixel
		
	}else{
			$banner['htmltemplate']		= $this->input->post('html5');

	}
	
	//$banner['htmlcache']		= $this->input->post('html5');
	//echo '<pre>';print_r($banner);die;
?>