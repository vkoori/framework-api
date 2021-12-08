<?php 
namespace Middleware;

use Controller\MiddlewareController;

/**
 * 
 */
class DideShowKey extends MiddlewareController {

	/**
	* 
	* @return 
	*/
	public function handle(&$params, $args) {
		// $key = passordHash(_env('CALCULATOR_KEY'));
		// $key = bin2hex($key);

		// $data = array(
		// 	'key' => $key,
		// );
		// $params = array_merge($params, ['middleware' => $data]);
		
		return true;
	}
}