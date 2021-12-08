<?php 
namespace Plugins;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * 
 */
class Log {
	
	public static $log = null;

	public static function log($str, $loglevel){
		if (is_null(self::$log))
			self::$log = new Logger('Koorosh');

		self::$log->pushHandler(new StreamHandler(dirname(__dir__, 2).'/Storage/log/Koorosh_'.date('Y-m-d').'.log', Logger::WARNING));
		self::$log->{$loglevel}($str);
	}
}
