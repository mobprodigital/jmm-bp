<?php
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
	?>