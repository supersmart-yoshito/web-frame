<?php
require "base.php" ;
require PATH_CONF . "/config.".ENVIRONMENT.".php" ;
require PATH_LIBS . "/Smarty/Smarty.class.php" ;
require PATH_LIBS . "/App/Kernel.php" ;

// ベースクラスのロード
require dirname(__FILE__).'/autoload.php' ;

// テンプレートエンジン設定
$smarty = new Smarty ;
$smarty->template_dir = PATH_VIEWS ;
$smarty->compile_dir = PATH_COMPILES ;
$smarty->cache_dir = PATH_CACHE ;

// フレームワークカーネル生成
$kernel = new AppKernel($smarty) ;
$kernel->setModelDir(array(
	PATH_ROOT.'/models/base',
	PATH_MODELS
)) ;
$kernel->setEntityDir(PATH_ENTITIES) ;

// セッション設定
$sessionHandler = new SessionsModel();
session_set_save_handler($sessionHandler);                   
session_start();

// イベントディスパッチ
$kernel->setRouting(PATH_CONF.'/routes.php')->dispatch() ;


