<?php
namespace Event;

use Kernel\Caller;

class Event {
	use Caller;

	private static $events = [];
	
	public static function listen($name, $callbackArr) {
		self::$events[$name] = $callbackArr;
	}

	public static function trigger($name, $argument=[]) {
		$listeners = self::$events[$name];
		foreach ($listeners as $listener) {
			self::fire($listener, "handel", $argument);
		}
	}
}