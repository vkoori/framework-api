<?php 
namespace Plugins;

/**
 * 
 */
class Hashing {

	public static function hash($string) {
		if (config("HASH") == "argon2i") {
			return password_hash($string, PASSWORD_ARGON2I, ['memory_cost' => 1024, 'time_cost' => 2, 'threads' => 2]);
		} else {
			return $string;
		}
	}

	public static function verify_hash($sting, $hash) {
		if (config("HASH") == "argon2i") {
			if(password_verify($sting, $hash))
				return true;
			return false;
		} else {
			if($sting == $hash)
				return true;
			return false;
		}
	}
}