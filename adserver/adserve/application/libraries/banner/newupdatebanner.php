<?php
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
					$data['msg']					='Banner is successful added';
					$cacheArr		= array($banner, $videodata);
					$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_'.$newbannerId.'.php';
					file_put_contents($my_file, json_encode($cacheArr));
					/* echo '<pre>';print_r($banner);
					echo '<pre>';print_r($videodata);
					die; */

				}else{
						$banner['bannerid']	= $newbannerId;
						$cacheArr		= array($banner);
						
						$my_file 		= $GLOBALS['cacheDir'].'delivery_ad_'.$newbannerId.'.php';
						file_put_contents($my_file, json_encode($cacheArr));
				}
?>