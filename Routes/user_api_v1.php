<?php 

$api_dir = 'api/v1/user/';

/*------------------- invoice -------------------*/
$r->addRoute('POST', '/invoice/{profileid}', [
	'use' => $api_dir.'Invoice@store',
	'middleware' => 'GetUserId'
]);
$r->addRoute('GET', '/extra-items-gantt/{profileid}', [
	'use' => $api_dir.'Invoice@index',
	'middleware' => 'GetUserId'
]);
$r->addRoute('GET', '/invoice/{profileid}', [
	'use' => $api_dir.'Invoice@all',
	'middleware' => 'GetUserId'
]);

/*------------------- profile -------------------*/
$r->addRoute('POST', '/register', [
	'use' => $api_dir.'Profile@store',
	'middleware' => ['GetUserId', 'DideShowKey']
	// 'middleware' => ['DideShowKey']
]);