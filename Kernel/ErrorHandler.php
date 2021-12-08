<?php

namespace ErrorController;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
// use Monolog\Handler\BrowserConsoleHandler;

/**
 * 
 */
class ErrorApp
{

	/**
	 * @return Void
	 */
	public static function log()
	{
		$formatter = new LineFormatter(LineFormatter::SIMPLE_FORMAT, LineFormatter::SIMPLE_DATE);
		$formatter->includeStacktraces(true);

		$stream = new StreamHandler(dirname(__DIR__, 1).'/storage/log/'.date('Y-m').'/'.date('m-d').'.log');
		$stream->setFormatter($formatter);

		$logger = new Logger('logger');
		$logger->setTimezone(new \DateTimeZone(config("TIMEZONE")));

		$logger->pushHandler($stream);
		// $logger->pushHandler(new BrowserConsoleHandler);

		// $handler = new ErrorHandler($logger);
		// $handler->registerErrorHandler([], true);
		// $handler->registerExceptionHandler();
		// $handler->registerFatalHandler();
		ErrorHandler::register($logger);
	}
}
