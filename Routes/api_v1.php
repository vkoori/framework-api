<?php 

$namespace = 'Api\\V1\\Controller\\User\\';

/*------------------- Identity -------------------*/
$r->addRoute('POST', '/identity', [
	'use' => $namespace.'Identity@store',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/identity', [
	'use' => $namespace.'Identity@list',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/identity/{id}', [
	'use' => $namespace.'Identity@show',
	'middleware' => 'UserId'
]);

/*------------------- Company -------------------*/
$r->addRoute('POST', '/company', [
	'use' => $namespace.'Company@store',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/company', [
	'use' => $namespace.'Company@list',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/company/{id}', [
	'use' => $namespace.'Company@show',
	'middleware' => 'UserId'
]);

/*------------------- LackOfBackground -------------------*/
$r->addRoute('POST', '/lack-of-background', [
	'use' => $namespace.'LackOfBackground@store',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/lack-of-background', [
	'use' => $namespace.'LackOfBackground@list',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/lack-of-background/{id}', [
	'use' => $namespace.'LackOfBackground@show',
	'middleware' => 'UserId'
]);

/*------------------- Location -------------------*/
$r->addRoute('POST', '/location', [
	'use' => $namespace.'Location@store',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/location', [
	'use' => $namespace.'Location@list',
	'middleware' => 'UserId'
]);
$r->addRoute('GET', '/location/{id}', [
	'use' => $namespace.'Location@show',
	'middleware' => 'UserId'
]);

/*------------------- Magic -------------------*/
$r->addRoute('POST', '/magic', [
	'use' => $namespace.'Magic@store',
	'middleware' => 'UserId'
]);