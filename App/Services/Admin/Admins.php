<?php 
namespace Services;

/**
 * 
 */
class Admins extends Service{
	
	/**
	* call administrator webservice
	* @return 
	*/
	public function Access($token) {
		$url = _env('ADMIN_BASE')."/api/v1/admin-raw";
		$method = "GET";
		$body = [
			"service" 	=> _env('SERVICE_ADMIN')
		];
		$header = array(
			"Token" 	=> $token
		);

		$resp = $this->serviceCaller($method, $url, $body, $header);
		$data = $resp['body']->data;

		if (empty($data))
			return $this->serviceError([], 401, [I18n('auth_failed')]);
		
		if ($data[0]->state != _env('VERIFIED_ADMIN'))
			$access = '';
		else
			$access = $data[0]->name;

		$resp = array(
			'userIdAdmin' 	=> $data[0]->userid,
			'accessList' 	=> explode(',', $access)
		);

		return $resp;
	}
}