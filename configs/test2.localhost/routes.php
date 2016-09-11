<?php

include PATH_CONF."/../base/routes.base.php" ;

$routing = array_merge($routing, array(

	'/photo' => array(
		'controller' => 'photo',
		'action' => 'index',
	),
	'/photo/post' => array(
		'controller' => 'photo',
		'action' => 'post',
	),
	'/photo/image/:photoId' => array(
		'controller' => 'photo',
		'action' => 'image',
	),
)) ;
