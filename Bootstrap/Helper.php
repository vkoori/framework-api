<?php 

use Core\Core;
use ErrorController\ErrorApp;

function config($item, $type="app") {
	return Core::Config($item, $type);
}

function useClass($use='') {
	$use = str_replace("/","\\",$use);
	if (!class_exists($use)) {
		$use = str_replace("\\","/",$use);
		require_once dirname(__DIR__, 1).'/'.$use.'.php';
		$use = str_replace("/","\\",$use);
		if (!class_exists($use))
			$use = substr($use, strrpos($use, '\\') + 1);
	}
	return new $use;
}

function _env($item=null, $default='') {
	if (!is_null($item)) {
		return Core::EnvLoader($item, $default);
	}
	return $item;
}

function _envSetter($item='', $default='') {
	Core::EnvSetter($item, $default);
}

function _setlocale($lang) {
	Core::setLocale($lang);
}

function I18n($key, $replace=null) {
	return Core::I18n($key, $replace);
}

function cors() {
	Core::cors();
}

function root_path() {
	return dirname(__DIR__, 1);
}

function app_path() {
	return dirname(__DIR__, 1).'/App';
}

# error handler
if( !config("APP_DEBUG") ) {
	error_reporting(0);
	ini_set('error_reporting',0);
	ini_set('display_errors',0);

	ErrorApp::log();
}

# file scanner
function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
        	if (pathinfo($path, PATHINFO_EXTENSION) == 'php') {
            	$results[] = $path;
        	}
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
        }
    }

    return $results;
}

# composer dump-autoload
$controllerClasses = getDirContents(dirname(__DIR__, 1).'/App');
foreach ($controllerClasses as $controllerClass) {
	require_once $controllerClass;
}