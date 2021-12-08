<?php 
namespace Plugins;

use Phpfastcache\CacheManager;

/**
 * 
 */
class Cache {
	
	private static $InstanceCache = null;

	public static function key($key) {
		if (is_null(self::$InstanceCache)) {
			self::setup();
		}
		return self::$InstanceCache->getItem($key);
	}

	public static function save($CachedString) {
		return self::$InstanceCache->save($CachedString);
	}
	
	private static function setup() {
		switch (config('CACHE')) {
			case 'file':
				self::Files();
				break;
			case 'redis':
				self::Redis();
				break;
			default:
				die('dirver not configure!');
				break;
		}
	}

	private static function Files() {
		CacheManager::setDefaultConfig(
			new \Phpfastcache\Config\ConfigurationOption(
				[
					'path' => dirname(__dir__, 2).'/storage/cache/'
					// 'path' => sys_get_temp_dir()
				]
			)
		);

		self::$InstanceCache = CacheManager::getInstance('files');
	}

	private static function Redis() {
		if (!class_exists(\Redis::class)) {
			throw new \Phpfastcache\Exceptions\PhpfastcacheDriverCheckException('Unable to test Redis client because the extension seems to be missing');
		}

		self::$InstanceCache = CacheManager::getInstance('Redis', new \Phpfastcache\Drivers\Redis\Config([
			'host' 			=> '127.0.0.1', //Default value
			'port' 			=> 6379, //Default value
			'password' 		=> null, //Default value
			'database' 		=> null, //Default value
		]));
	}

}