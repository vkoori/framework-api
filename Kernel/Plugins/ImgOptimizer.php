<?php 
namespace Plugins;
use Spatie\ImageOptimizer\OptimizerChainFactory;


/**
 * 
 */
class ImgOptimizer {

	private static $optimizerChain = null;
	
	public static function optimize($pathToImage) {
		if (config('APP_ENV') != 'local') {
			if (is_null(self::$optimizerChain))
				self::$optimizerChain = OptimizerChainFactory::create();
			
			self::$optimizerChain->optimize($pathToImage);
		}
	}
}