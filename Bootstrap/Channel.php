<?php 

use Event\Event;

Event::listen(
	'login', 
	[
		'Listener\V1\Test'
	]
);