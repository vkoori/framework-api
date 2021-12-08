<?php 

$api_dir = 'api/v1/enduser/';

/*------------------- items -------------------*/
$r->addRoute('GET', '/items', $api_dir.'Item@index');

/*------------------- buy -------------------*/
$r->addRoute('GET', '/return-from-bank/{tracking_code}', $api_dir.'Invoice@bank');

/*------------------- buy -------------------*/
$r->addRoute('GET', '/calculator', $api_dir.'Calculator@show');

/*------------------- all data -------------------*/
$r->addRoute('GET', '/profile/{slug}', [
	'use' => $api_dir.'Profile@show',
	'middleware' => 'DideShowKey'
]);

/*------------------- plan -------------------*/
$r->addRoute('GET', '/plan', [
	'use' => 'API\Off@modify_q',
	'middleware' => 'DideShowKey'
]);