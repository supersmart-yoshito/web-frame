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
	'/account/login' => array(
		'controller' => 'account',
		'action' => 'login',
	), 
	'/account/logout' => array(
		'controller' => 'account',
		'action' => 'logout',
	), 
	'/account/mypage/:userid' => array(
		'controller' => 'account',
		'action' => 'mypage',
	), 
	/**
	 *
	 * 会員登録
	 *
	 */
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
	'/inquiry' => array(
		'controller' => 'inquiry',
		'action' => 'index',
	), 
) ;

