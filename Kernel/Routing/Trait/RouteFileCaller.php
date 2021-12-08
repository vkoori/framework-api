<?php 
namespace Routing;

/**
 * 
 */
trait RouteFileCaller {
	
	private static function constantController() {
		# limit + offset
		$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
		$offset = _env('limit') * ($page - 1);
		_envSetter('offset', $offset);

		# set language
		$lang = (isset(getallheaders()['lang'])) ? getallheaders()['lang'] : config("LANG");
		_setlocale($lang);
	}

	private static function middlewareCaller($handler, &$vars) {
		if (isset($handler['middleware'])) {
			$middleware_middleArgs = $handler['middleware'];
			if (gettype($middleware_middleArgs) == "string")
				$middleware_middleArgs = [$middleware_middleArgs];

			# call each middleware
			foreach ($middleware_middleArgs as $m_a) {
				$middleArgs = array();
				$m_a = explode(':', $m_a);

				if (isset($m_a[1])) {
					$middleArgs = $m_a[1];
					$middleArgs = explode(',', $middleArgs);
				}

				$middleware = "\\Middleware\\$m_a[0]";

				$result = call_user_func_array([new $middleware, "handle"], [&$vars, $middleArgs]);
				if ($result !== true)
					self::output([], 401, ["401"]);
			}
		}
	}

	private static function controllerCaller($handler, $vars) {
		# detect controller
		if (gettype($handler) == "array")
			$controller = $handler['use'];
		else
			$controller = $handler;

		[$controllerNS, $method] = explode('@', $controller);

		# call controller
		call_user_func_array([new $controllerNS, $method], [$vars]);
	}

	/**
	* 
	* 
	*/
	private static function caller($routeInfo) {
		# set constant
		self::constantController();

		# params
		$handler = $routeInfo[1];
		$vars = $routeInfo[2];

		# call middleware
		self::middlewareCaller($handler, $vars);

		# call controller
		self::controllerCaller($handler, $vars);
		
	}
}