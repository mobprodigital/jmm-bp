<?php 
	$banner['storagetype']	= 'web';
	$fileName		= basename($_FILES["upload"]["name"]);
	$target_file 	= $targetDirImage . $fileName;
	if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
		$type		= $_FILES['upload']['type'];
		$imagetypes	= substr($type, 6);
		$banner['contenttype'] 		= $imagetypes;
		$banner['filename'] 		= $fileName;
	}else{
		$imagefilename		= $this->input->post('imagefilename');
		$banner['filename']	= $imagefilename;
	}
	$banner['url']					= $this->input->post('url');          
	$banner['alt']        			= $this->input->post('alt');
	$banner['statustext'] 			= $this->input->post('statustext');

	$banner['bannertext'] 			= $this->input->post('bannertext');
	$banner['target']				= $this->input->post('target');
	$banner['tracking_pixel']		= $this->input->post('tracking_pixel');
	//$banner['imageurl']			= $this->input->post('imageurl');    
	//$banner['htmltemplate']		= $this->input->post('htmltemplate');
	?>