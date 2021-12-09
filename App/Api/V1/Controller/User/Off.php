<?php 
namespace Api\V1\Controller\User;

use Controller\BaseController;
use Controller\ApiResponse;
use Plugins\Cache;
use DB\IlluminateDB as DB;
use Models\XService;

/**
 * 
 */
class Off extends BaseController {

	/**
	* 
	* @return 
	*/
	public function modify_q() : void {

		$CachedString = Cache::key('asd');
		if (!$CachedString->isHit()) {
			$CachedString->set('test')->expiresAfter(5);
			Cache::save($CachedString);

			echo 'FIRST LOAD // WROTE OBJECT TO CACHE // RELOAD THE PAGE AND SEE // ';
			echo $CachedString->get();

		} else {
			echo 'READ FROM CACHE // ';
			echo $CachedString->get();
		}

		DB::conn();
		$x = XService::first();
		ApiResponse::output($x);
	}

}