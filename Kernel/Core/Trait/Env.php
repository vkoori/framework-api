<?php 
namespace Core;

/**
 * 
 */
trait Env {
	private static $env = NULL;
	
	public static function EnvLoader($item, $default='') {
		if (is_null(self::$env)) 
			self::$env = parse_ini_file(dirname(__DIR__, 3)."/.env",true,INI_SCANNER_RAW);

		if (isset(self::$env[$item]))
			$value = self::$env[$item];
		else
			$value = $default;
		return $value;
	}

	public static function EnvSetter($item, $value) {
		self::$env[$item] = $value;
	}

}