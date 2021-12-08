<?php

# Register composer auto loader
require __DIR__.'/../vendor/autoload.php';

# CORS
cors();

# timezone
date_default_timezone_set(config("TIMEZONE"));

# call app router
\Routing\Route::boot();