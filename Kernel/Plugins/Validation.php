<?php
namespace Plugins;

class ValidationCall{
	
	public static function __call($class=null, $args=[]){
		if(@require_once dirname(__DIR__,2)."/Validation/$class.php"){
			$class = "\Rakit\Validation\Rules\\$class";
			return new $class();
		}
	}
}