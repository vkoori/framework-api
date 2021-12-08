<?php 
namespace DB;

use Illuminate\Database\Capsule\Manager as Capsule;
// use Illuminate\Events\Dispatcher;
// use Illuminate\Container\Container;

/**
 * All basic functions we need
 */
trait IlluminateDB {

	private static $sdb = null;

	public static function conn(){
		
		if (is_null(self::$sdb)) {

			$capsule = new Capsule;
			$capsule->addConnection([
				'driver' 	=> 'mysql',
				'host' 		=> _env("host"),
				'database' 	=> _env("db"),
				'username' 	=> _env("user"),
				'password' 	=> _env("pass"),
				'charset' 	=> 'utf8',
				'collation'	=> 'utf8_unicode_ci',
				'prefix' 	=> '',
			]);

			// Set the event dispatcher used by Eloquent models... (optional)
			# need install: composer require illuminate/events
			// $capsule->setEventDispatcher(new Dispatcher(new Container));

			// Make this Capsule instance available globally via static methods... (optional)
			$capsule->setAsGlobal();

			// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
			$capsule->bootEloquent();

			self::$sdb = $capsule;
		}
		
		return self::$sdb;
	}
}