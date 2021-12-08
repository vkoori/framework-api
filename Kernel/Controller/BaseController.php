<?php 
namespace Controller;

/**
 * All basic functions we need
 */
class BaseController {
	/**
	 * This method send curl request
	 * @return json
	 */
	protected function curl($method, $url, $body=[], $header=[]) {
		if ($method == 'GET')
			$url = $url . '?' . http_build_query($body);

		$headerReq = array();
		foreach ($header as $k => $value) {
			array_push($headerReq, "$k:$value");
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_POSTFIELDS => $body,
			CURLOPT_HTTPHEADER => $headerReq,
			// CURLOPT_HEADER => true,
			CURLOPT_SSL_VERIFYPEER => false
		));

		$response = curl_exec($curl);
		curl_close($curl);

		$result = array(
			'http_code' => curl_getinfo($curl)['http_code'],
			'body' => $response
		);

		return $result;
	}

	protected function parse_raw_del() {
		$request = file_get_contents('php://input');
		parse_str($request, $delete);
		return $delete;
	}

	protected function parse_raw_put() {
		$put = json_decode(file_get_contents('php://input'), true);
		return $put;
	}

	protected function passordHash($string) {
		$algo = config('HASH');
		if (isset($algo['argon2i'])) {
			$hash = password_hash($string, PASSWORD_ARGON2I, [
				'memory_cost' => $algo['argon2i']['memory'], 
				'time_cost' => $algo['argon2i']['time'], 
				'threads' => $algo['argon2i']['threads']
			]);
		} else {
			$hash = hash($algo, $string);
		}
		return $hash;
	}

	protected function passordVerify($user_password, $stored_hash) {
		$algo = config('HASH');
		if (isset($algo['argon2i'])) {
			if(password_verify($user_password, $stored_hash))
				$validated = true;
			else
				$validated = false;
		} else {
			$hash = hash($algo, $user_password);
			$validated = $hash == $stored_hash;
		}
		return $validated;
	}

	
}