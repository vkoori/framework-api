<?php 
namespace Controller;

// use kernel\plugins\common as func;

/**
 * 
 */
class MiddlewareController extends ResponseController {

	/**
	* check is set Token into header?
	* @return Token
	*/
	protected function getToken() {
		if (!isset(getallheaders()['Token']))
			return self::output([], 422, [__messages('unprocessable_entity')]);

		$token = getallheaders()['Token'];

		if ($token == '')
			return self::output([], 422, [__messages('unprocessable_entity')]);

		return $token;
	}
}