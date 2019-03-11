<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Model extends CI_Model {
	private $table = 'usersingroup';
	function __construct(){
		/* Call the Model constructor */
		parent::__construct();
		$this->load->database();
	}
	
	function getBannerDetails($bannerId){
	
		$query = "
            SELECT
				*
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b
            WHERE
                b.bannerid = $bannerId
                AND
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
               
           
        ";
		//echo $query;die;
		$rowResult 									= $this->db->query($query);
		$bannerDetails								= $rowResult->row();
		return $bannerDetails;
		
		//echo '<pre>';print_r($bannerDetails);die;
		
	}	
}
	?>