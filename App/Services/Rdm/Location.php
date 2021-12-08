<?php 

/**
 * 
 */
class Location extends \Controller\ResponseController{
	
	/**
	* 
	* @return 
	*/
	public function ShowCity($cityId) {
		$url = _env('RDM_BASE')."/api/v1/reverse-city/".$cityId;
		$method = "GET";
		$body = [];
		$header = [];

		$resp = $this->serviceCaller($method, $url, $body, $header);
		$data = $resp['body']->data;

		return $data[0];
	}
}