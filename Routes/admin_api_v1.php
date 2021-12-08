<?php 

$api_dir = 'api/v1/admin/';

/*------------------- price & off -------------------*/
$r->addRoute('POST', '/prices', [
	'use' => $api_dir.'Price@modify',
	'middleware' => 'HasAccess:price_manager'
]);
$r->addRoute('GET', '/prices/{id}', [
	'use' => $api_dir.'Price@show',
	'middleware' => 'HasAccess:price_manager'
]);

/*------------------- package -------------------*/
$r->addRoute('POST', '/plan', [
	'use' => $api_dir.'Plan@store',
	'middleware' => 'HasAccess:packager'
]);
$r->addRoute('DELETE', '/plan/{planId}', [
	'use' => $api_dir.'Plan@delete',
	'middleware' => 'HasAccess:packager'
]);
