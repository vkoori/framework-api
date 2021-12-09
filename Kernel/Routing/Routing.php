<?php 
namespace Routing;

use FastRoute\Dispatcher;
use Controller\ApiResponse;


/**
 * 
 */
class Route extends ApiResponse {
	use RouteServiceProvider, RouteFileCaller;

	public static function boot() {
		# Register reoutes
		$dispatcher = self::RouteProviders();

		# Fetch method and URI from somewhere
		$httpMethod = $_SERVER['REQUEST_METHOD'];
		$uri = $_SERVER['REQUEST_URI'];

		# Strip query string (?foo=bar) and decode URI
		if (false !== $pos = strpos($uri, '?')) {
			$uri = substr($uri, 0, $pos);
		}
		$uri = rawurldecode($uri);

		$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
		switch ($routeInfo[0]) {
			case Dispatcher::NOT_FOUND:
				self::output([], 404, ["404"]);
				break;
			case Dispatcher::METHOD_NOT_ALLOWED:
				self::output([], 405, ["405"]);
				break;
			case Dispatcher::FOUND:
				self::caller($routeInfo);
				break;
		}
	}
	
}