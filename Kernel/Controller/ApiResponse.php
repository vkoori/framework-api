<?php 
namespace Controller;

/**
 * 
 */
class ApiResponse {

	/**
	* 
	* 
	* @return 
	*/
	public static function output($data=null, $status=200, $message=[], $header=["Content-Type" => "application/json"]) {
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

}