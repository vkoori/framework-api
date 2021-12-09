<?php 
namespace Api\V1\Controller\User;

use Controller\BaseController;
use Controller\ApiResponse;

use Plugins\Cache;
use DB\IlluminateDB as DB;
// use Rakit\Validation\Validator;

/**
 * 
 */
class Identity extends BaseController {

	/**
	* 
	* @param
	* @void 
	*/
	public function store(\Api\V1\Requests\User\IdentityStore $request, $params=[]) : void {
		echo "string";

		\Event\Event::trigger('login');

		// $validator = new Validator;
		// $validation = $validator->validate($_GET, [
		// 	'page' 		=> 'nullable|integer|min:0'
		// ]);

		// if ($validation->fails())
		// 	return ApiResponse::output([], 422, [I18n('unprocessable_entity')]);


		// $CachedString = Cache::key('asd');
		// if (!$CachedString->isHit()) {
		// 	$CachedString->set('test')->expiresAfter(5);
		// 	Cache::save($CachedString);

		// 	echo 'FIRST LOAD // WROTE OBJECT TO CACHE // RELOAD THE PAGE AND SEE // ';
		// 	echo $CachedString->get();

		// } else {
		// 	echo 'READ FROM CACHE // ';
		// 	echo $CachedString->get();
		// }

		// ApiResponse::output(DB::conn());
	}

}