<?php 
namespace Routing;

use FastRoute\RouteCollector;

/**
 * All basic functions we need
 */
trait RouteServiceProvider {

	private static function RouteProviders() {
		$web_prefix = config("APP_PREFIX");
		$dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) use ($web_prefix) {
		# define routes
			$r->addGroup($web_prefix.'/api/v1', function (RouteCollector $r) {
				require dirname(__DIR__, 3).'/routes/api_v1.php';
			});
			$r->addGroup($web_prefix.'/admin/api/v1', function (RouteCollector $r) {
				require dirname(__DIR__, 3).'/routes/admin_api_v1.php';
			});
		});
		return $dispatcher;
	}

}