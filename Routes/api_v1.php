<?php 

$namespace = 'Api\\V1\\Controller\\User\\';

/*------------------- items -------------------*/
$r->addRoute('GET', '/items', $namespace.'Item@index');

/*------------------- buy -------------------*/
$r->addRoute('GET', '/return-from-bank/{tracking_code}', $namespace.'Invoice@bank');

/*------------------- buy -------------------*/
$r->addRoute('GET', '/calculator', $namespace.'Calculator@show');

/*------------------- all data -------------------*/
$r->addRoute('GET', '/profile/{slug}', [
	'use' => $namespace.'Profile@show',
	'middleware' => 'DideShowKey'
]);

/*------------------- plan -------------------*/
$r->addRoute('GET', '/plan', [
	'use' => $namespace.'Off@modify_q',
	'middleware' => 'DideShowKey'
]);