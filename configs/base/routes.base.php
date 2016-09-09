<?php

$routing = array(
	'/' => array(
		'controller' => 'top',
		'action' => 'index'
	),
	'/account' => array(
		'controller' => 'account',
		'action' => 'index',
	), 
	'/account/mypage/:userid' => array(
		'controller' => 'account',
		'action' => 'mypage',
	), 
	'/account/login' => array(
		'controller' => 'account',
		'action' => 'login',
	), 
	'/account/logout' => array(
		'controller' => 'account',
		'action' => 'logout',
	), 
	'/account/create' => array(
		'controller' => 'account',
		'action' => 'create',
	), 
	'/account/create/confirm' => array(
		'controller' => 'account',
		'action' => 'create',
	), 
	'/account/create/complete' => array(
		'controller' => 'account',
		'action' => 'create',
	), 
	'/account/delete/:id' => array(
		'controller' => 'account',
		'action' => 'delete',
	), 
	'/account/delete/confirm' => array(
		'controller' => 'account',
		'action' => 'delete',
	), 
	'/account/delete/complete' => array(
		'controller' => 'account',
		'action' => 'delete',
	), 
	'/event' => array(
		'controller' => 'event',
		'action' => 'index',
	), 
	'/event/list' => array(
		'controller' => 'event',
		'action' => 'list',
	), 
	'/event/detail/:event_id' => array(
		'controller' => 'event',
		'action' => 'detail',
	),
	'/event/open' => array(
		'controller' => 'event',
		'action' => 'open',
	),
	'/event/close/:event_id' => array(
		'controller' => 'event',
		'action' => 'close',
	),
	'/blog' => array(
		'controller' => 'blog',
		'action' => 'index',
	), 
	'/blog/list/:userId/:year/:month/:day' => array(
		'controller' => 'blog',
		'action' => 'list',
	), 
	'/blog/detail/:userId/:articleId' => array(
		'controller' => 'blog',
		'action' => 'detail',
	), 
	'/blog/open' => array(
		'controller' => 'blog',
		'action' => 'open',
	), 
	'/blog/edit' => array(
		'controller' => 'blog',
		'action' => 'edit',
	), 
	'/blog/close' => array(
		'controller' => 'blog',
		'action' => 'close',
	), 
	'/blog/post' => array(
		'controller' => 'blog',
		'action' => 'post',
	), 
	'/clip/:userId' => array(
		'controller' => 'clip',
		'action' => 'index',
	), 
	'/clip/list/:type/:userId' => array(
		'controller' => 'clip',
		'action' => 'list',
	), 
	'/clip/clip/:clipId' => array(
		'controller' => 'clip',
		'action' => 'clip',
	), 
	'/clip/open' => array(
		'controller' => 'clip',
		'action' => 'open',
	), 
	'/clip/close' => array(
		'controller' => 'clip',
		'action' => 'close',
	), 
	'/clip/post' => array(
		'controller' => 'clip',
		'action' => 'postApi',
	), 
	'/clip/update/:clipId' => array(
		'controller' => 'clip',
		'action' => 'updateApi',
	), 
	'/clip/imageapi/:id' => array(
		'controller' => 'clip',
		'action' => 'imageApi',
	), 
	'/inquiry' => array(
		'controller' => 'inquiry',
		'action' => 'index',
	), 
) ;

