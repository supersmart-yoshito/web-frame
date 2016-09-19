<?php

include PATH_CONF."/../base/routes.base.php" ;

$routing = array_merge($routing, array(

	'/photo' => array(
		'controller' => 'photo',
		'action' => 'top',
	),
	'/photo/index' => array(
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
	'/photo/user/:userid' => array(
		'controller' => 'photo',
		'action' => 'user',
	),
	'/photo/friends' => array(
		'controller' => 'photo',
		'action' => 'friends',
	),
	'/photo/group' => array(
		'controller' => 'photo',
		'action' => 'group',
	),
	'/photo/latest' => array(
		'controller' => 'photo',
		'action' => 'latest',
	),
	'/friend' => array(
		'controller' => 'friend',
		'action' => 'top',
	), 
	'/friend/index' => array(
		'controller' => 'friend',
		'action' => 'index',
	), 
	'/group' => array(
		'controller' => 'group',
		'action' => 'top',
	), 
	'/group/index' => array(
		'controller' => 'group',
		'action' => 'index',
	), 
	'/message' => array(
		'controller' => 'message',
		'action' => 'index',
	), 
	'/message/inbox' => array(
		'controller' => 'message',
		'action' => 'inbox',
	), 
	'/message/group/:group' => array(
		'controller' => 'message',
		'action' => 'group',
	), 
	'/message/outbox' => array(
		'controller' => 'message',
		'action' => 'outbox',
	), 
	'/message/editbox' => array(
		'controller' => 'message',
		'action' => 'editbox',
	), 
	'/message/editbox/edit/:editId' => array(
		'controller' => 'message',
		'action' => 'edit',
	), 
	'/message/post' => array(
		'controller' => 'message',
		'action' => 'post',
	), 
	'/message/trash' => array(
		'controller' => 'message',
		'action' => 'trash',
	), 
	'/blog' => array(
		'controller' => 'blog',
		'action' => 'top',
	), 
	'/blog/index' => array(
		'controller' => 'blog',
		'action' => 'index',
	), 
	'/event' => array(
		'controller' => 'event',
		'action' => 'top',
	), 
	'/event/index' => array(
		'controller' => 'event',
		'action' => 'index',
	), 
	'/trade' => array(
		'controller' => 'trade',
		'action' => 'top',
	), 
	'/trade/index' => array(
		'controller' => 'trade',
		'action' => 'index',
	), 
)) ;
