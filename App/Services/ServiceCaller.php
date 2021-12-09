<?php 

namespace Services;

use Controller\BaseController;
use Controller\ApiResponse;

/**
 * 
 */
class Service extends BaseController
{
	/**
	* 
	* @return 
	*/
	protected function serviceCaller($method, $url, $body=[], $header=[]) {
		$resp = $this->curl($method, $url, $body, $header);
		$resp['body'] = json_decode($resp['body']);

		if ($resp['http_code'] != 200) {
			$errors = isset($resp['body']->message) ? $resp['body']->message : array();
			return $this->serviceError($resp['body']->data ,$resp['http_code'], $errors);
		}

		return $resp;
	}

	/**
	* 
	* @return 
	*/
	protected function serviceError($data, $status, $message) {
		return ApiResponse::output($data, $status, $message);
	}


}