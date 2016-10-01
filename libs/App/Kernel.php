<?php


class AppKernel {

	private $_engine ;
	private $_configDir ;
	private $_controllerDir ;
	private $_viewDir ;
	private $_modelDir ;
	private $_routing ;

	public function __construct($engine) {
		$this->_engine = $engine ;
		$this->_appDir = dirname(__FILE__) ;
		$this->_configDir = dirname(__FILE__).'/configs' ;
		$this->_controllerDir = dirname(__FILE__).'/controllers' ;
		$this->_templateDir = dirname(__FILE__).'/views' ;
		$this->_modelDir = dirname(__FILE__).'/models' ;
	}

	public function setAppDir($dir) {
		$this->_appDir = $dir ;
	}

	public function setConfigDir($dir) {
		$this->_configDir = $dir ;
	}

	public function setControllerDir($dir) {
		$this->_controllerDir = $dir ;
	}

	public function setTemplateDir($dir) {
		$this->_templateDir = $dir ;
	}

	public function setModelDir($dir) {
		$this->_modelDir = $dir ;
	}

	public function setEntityDir($dirname) {

		// open directory
		$dir = opendir($dirname) ;
		while (($file = readdir($dir)) !== false) {

			if (in_array($file, array('.', '..'))) {
				continue ;
			}

			if (is_dir($dirname.'/'.$file)) {
				continue ;
			}

			if (is_file($dirname."/{$file}")) {
				require_once($dirname."/{$file}") ;
			}
		}
	}

	public function setRouting($file) {
		include $file ;
		$this->_routing = $routing ;
		return $this ;
	}

	public function dispatch() {

		$event = new AppKernelEvent() ;
		$routing = new AppKernelRoute($event, $this->_routing) ;

		// テンプレートエンジン設定
		$routing->controller->setEngine($this->_engine) ;
		$routing->controller->loadModels($this->_modelDir) ;

		// 事前フィルタ設定
		if ($routing->controller->isRegisteredFilter('prefilter')) {
			$routing->controller->executePreFilter() ;
		}

		// アクション実行
		$template = call_user_func_array(array($routing->controller, $routing->action), $routing->params) ;

		// 事後フィルタ設定
		if ($routing->controller->isRegisteredFilter('postfilter')) {
			$routing->controller->executePostFilter() ;
		}
		$this->_engine->display($template) ;
	}


	public static function autoload($class) {
		$class = str_replace('AppKernel', '', $class) ;
		$class = str_replace('AppVendor', '', $class) ;

		if (is_file(dirname(__FILE__).'/' . $class . '.php')) {
			require dirname(__FILE__).'/' . $class . '.php' ;
		}

		// open directory
		$dir = opendir(dirname(__FILE__)) ;
		while (($file = readdir($dir)) !== false) {

			if (in_array($file, array('.', '..'))) {
				continue ;
			}

			if (!is_dir(dirname(__FILE__).'/'.$file)) {
				continue ;
			}

			if (is_file(dirname(__FILE__)."/{$file}/" . $class . '.php')) {
				require dirname(__FILE__)."/{$file}/" . $class . '.php' ;
			}
		}
	}
}

spl_autoload_register(array('AppKernel', 'autoload')) ;
