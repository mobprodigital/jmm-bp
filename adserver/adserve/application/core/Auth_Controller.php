<?php 

class Auth_Controller extends CI_Controller {

    function __construct(){
        parent::__construct();

        if ( ! $this->session->userdata('is_logged_in')){
				if($this->uri->segment(1) == 'publisher'){
					redirect('publisher/login');
					
				}elseif($this->uri->segment(1) == 'advertiser'){
					redirect('advertiser/login');
					
				}else{
					
				}
        }
    }
}



?>