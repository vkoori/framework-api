<?php 
namespace Core;

/**
 * 
 */
trait I18n {
	private static $file = NULL;

	/**
	 * @return void
	 */
	public static function setLocale($lang) {
		self::$file = dirname(__DIR__, 3) . '/App/Langs/' . $lang . '.json';
		self::$file = file_get_contents( self::$file );
		self::$file = json_decode(self::$file);
	}

	/**
	 * @return string
	 */
	public static function I18n($key, $replace) {
		if (isset(self::$file->{$key})) {
			$message = self::$file->{$key};
			if (is_array($replace)) {
				foreach ($replace as $k => $v) {
					$message = str_replace(":$k", $v, $message);
				}
			}
		} else {
			$message = $key;
		}
		return $message;
	}
}
