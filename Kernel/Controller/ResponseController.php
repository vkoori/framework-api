<?php 
namespace Controller;

// use kernel\plugins\common as func;

/**
 * 
 */
class ResponseController extends BaseController {

	/**
	* 
	* 
	* @return 
	*/
	protected static function output($data=null, $status=200, $message=[], $header=["Content-Type" => "application/json"]) {
		http_response_code($status);
		
		$response = (object) array();
		
		if (isset($data['paginate'])) {
			$response->paginate = $data['paginate'];
			unset($data['paginate']);
		}
		
		$response->data = $data;
		
		if (sizeof($message)>0)
			$response->message = $message;

		foreach ($header as $key => $value) {
			header("$key: $value");
		}

		echo json_encode($response);
		exit();
	}

	/**
	* 
	* 
	* @return 
	*/
	protected function serviceCaller($method, $url, $body=[], $header=[]) {
		$resp = $this->curl($method, $url, $body, $header);
		$resp['body'] = json_decode($resp['body']);

		if ($resp['http_code'] != 200) {
			$errors = isset($resp['body']->message) ? $resp['body']->message : array();
			return self::output($resp['body']->data ,$resp['http_code'], $errors);
		}

		return $resp;
	}

}