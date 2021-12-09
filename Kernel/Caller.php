<?php 
namespace Kernel;

trait Caller {
	private static function fire(string $class, string $method, array $args) {
		# add required class in params
		$ReflectionMethod = new \ReflectionMethod($class, $method);
		$params = $ReflectionMethod->getParameters();
		foreach ($params as $param) {
			if (!$param->isOptional() && !is_null($param->getClass())) {
				array_unshift($args, new ($param->getClass()->name));
			}
		}

		# call class
		return call_user_func_array([new $class, $method], $args);
	}
}