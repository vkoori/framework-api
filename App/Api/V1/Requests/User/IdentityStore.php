<?php 
namespace Api\V1\Requests\User;

use Rakit\Validation\Validator;

/**
 * 
 */
class IdentityStore {
	
	function __construct() {

		$validator = new Validator;
		$validation = $validator->validate($_GET, [
			'page' 		=> 'nullable|integer|min:0'
		]);

		
		var_dump('in parent setup all and remove unset - in this method define with one needed');
	}
}