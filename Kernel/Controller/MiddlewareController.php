<?php 
namespace Controller;

/**
 * 
 */
class MiddlewareController extends ApiResponse {

	/**
	* check is set Token into header?
	* @return Token
	*/
	protected function getToken() {
		if (!isset(getallheaders()['Token']))
			return self::output([], 422, [I18n('unprocessable_entity')]);

		$token = getallheaders()['Token'];

		if ($token == '')
			return self::output([], 422, [I18n('unprocessable_entity')]);

		return $token;
	}
}