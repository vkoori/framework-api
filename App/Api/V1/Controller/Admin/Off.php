<?php 
namespace API;

use Plugins\Cache;

/**
 * 
 */
class Off {

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


		var_dump('mixed:value');exit;
	}

}