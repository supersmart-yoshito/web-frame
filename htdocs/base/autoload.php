<?php

$gDirs = array(
	PATH_ROOT.'/models/base',
	PATH_ROOT.'/controllers/base',
	PATH_CONTROLLERS,
) ;

function autoload($class) {

	global $gDirs ;
	foreach ($gDirs as $dir) {
		if (is_file($dir . '/' . $class . '.php')) {
			require $dir . '/' . $class . '.php' ;
		}
	}
}

spl_autoload_register('autoload') ;
