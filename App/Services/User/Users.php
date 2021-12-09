<?php 
namespace Services;

/**
 * 
 */
class Users extends Service{
	
	/**
	 * get userid with @param $token
	 * @return json
	 */
	public function UserId($token) {
		$url = _env('USER_BASE')."/api/v1/user/userid/".$token;
		$method = "GET";
		$body = [];
		$header = array(
			"Clientid" => _env('USER_CLIENTID')
		);

		$resp = $this->serviceCaller($method, $url, $body, $header);
		$data = $resp['body']->data;

		if (empty($data))
			return $this->serviceError([], 401, [I18n('user_not_found')]);

		$userid = $data[0]->userid;
		return $userid;
	}
}