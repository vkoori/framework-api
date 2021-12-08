<?php 
namespace Core;

/**
 * 
 */
trait Cors {

	public static function cors() {
		if (!empty( config('allowed_origins', 'cors') ))
			header('Access-Control-Allow-Origin: '.implode(',', config('allowed_origins', 'cors') ));

		if (!empty( config('allowed_headers', 'cors') ))
			header('Access-Control-Allow-Headers: '.implode(',', config('allowed_headers', 'cors') ));

		if (!empty( config('allowed_methods', 'cors') ))
			header('Access-Control-Allow-Methods: '.implode(',', config('allowed_methods', 'cors') ));

		if (!empty( config('exposed_headers', 'cors') ))
			header('Access-Control-Expose-Headers: '.implode(',', config('exposed_headers', 'cors') ));

		header('Access-Control-Max-Age: '.config('max_age', 'cors'));
		header('Access-Control-Allow-Credentials: '.config('supports_credentials', 'cors'));
	}

}