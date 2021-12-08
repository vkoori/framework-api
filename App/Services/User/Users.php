<?php 

/**
 * 
 */
class Users extends \Controller\ResponseController{
	
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
			return self::output([], 401, [__messages('user_not_found')]);

		$userid = $data[0]->userid;
		return $userid;
	}

	/**
	 * get userinfo with @param $userIds
	 * @return json
	 */
	public function UserInfo($userIds) {
		$url = _env('USER_BASE')."/api/v1/micro/info/".$userIds;
		$method = "GET";
		$body = [];
		$header = array(
			"Clientid" => _env('USER_CLIENTID')
		);

		$resp = $this->serviceCaller($method, $url, $body, $header);
		$data = $resp['body']->data;

		if (empty($data))
			die(self::output([], 401, ['user_not_found']));

		return $data;
	}
}