<?php
				$banner['storagetype']	= 'html';
				$adtype					= $this->input->post('upload_video');
				if($adtype 	== 'create_video'){
					$banner['ext_bannertype']	= $adtype;
				
					$fileName		= basename($_FILES["video_upload"]["name"]);
					$target_file 	= $targetDirVideo . $fileName;
					if (move_uploaded_file($_FILES["video_upload"]["tmp_name"], $target_file)) {
						$type		= $_FILES['video_upload']['type'];
						$banner['contenttype'] 		= 'html';
						$banner['filename'] 		= $fileName;
						$videodata['vast_video_outgoing_filename']	= $fileName;

					}else{
						$savefilename		= $this->input->post('videofilename');
						$videodata['vast_video_outgoing_filename']	= $savefilename;
					
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
					$videodata['impression_pixel']		= $this->input->post('impression_pixel');					
					$videodata['start_pixel']			= $this->input->post('start_pixel');          
					$videodata['quater_pixel']			= $this->input->post('quater_pixel');          
					$videodata['mid_pixel']				= $this->input->post('mid_pixel');
					$videodata['third_quater_pixel']	= $this->input->post('third_quater_pixel');          
					
					$videodata['end_pixel']				= $this->input->post('end_pixel');
					$videodata['third_party_click']		= $this->input->post('click_tracking_url');
					$videodata['status']				= "active";


					//$videodata['third_party_click']		= $this->input->post('third_party_click');
					//$banner['imageurl']					= $this->input->post('imageurl');    
					//$banner['htmltemplate']				= $this->input->post('htmltemplate');
					//echo '<pre>';print_r($videodata);die;
				}else{
					//process vast tags and get input for player
					
					$tag					= $this->input->post('tag');
					$newtag 				= trim($tag, ' ');

					$combinedata			= vastparser($newtag, $banner['description']);
				
					$banner					= $combinedata[0];
					$videodata				= $combinedata[1];
					$videodata['vast_tag']	= $tag;

					//echo '<pre>';print_r($banner);print_r($combinedata);die;
				}
				$banner['url']			= $this->input->post('vast_dest_url');

?>				