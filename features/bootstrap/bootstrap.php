<?php

// Start off by requiring the Kohana unittest bootstrap as a good starting point
require_once __DIR__.'/../../../unittest/bootstrap.php';

// Enable the kohat module
Kohana::modules(Kohana::modules() + array('kohat' => MODPATH.'kohat'));

/*
 * Include contexts from all levels of the application - you still have to
 * manually register the ones you want in your application main context though.
 */

$contexts = Kohana::list_files('features/contexts/');
foreach ($contexts as $context)
{
	if (pathinfo($context, PATHINFO_EXTENSION) == 'php')
	{
		require_once($context);
	}
}