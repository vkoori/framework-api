<?php 

$namespace = 'Api\\V1\\Controller\\Admin\\';

/*------------------- price & off -------------------*/
$r->addRoute('POST', '/prices', [
	'use' => $namespace.'Price@modify',
	'middleware' => 'HasAccess:price_manager'
]);
$r->addRoute('GET', '/prices/{id}', [
	'use' => $namespace.'Price@show',
	'middleware' => 'HasAccess:price_manager'
]);

/*------------------- package -------------------*/
$r->addRoute('POST', '/plan', [
	'use' => $namespace.'Plan@store',
	'middleware' => 'HasAccess:packager'
]);
$r->addRoute('DELETE', '/plan/{planId}', [
	'use' => $namespace.'Plan@delete',
	'middleware' => 'HasAccess:packager'
]);
