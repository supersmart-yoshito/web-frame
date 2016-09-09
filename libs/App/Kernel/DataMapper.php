<?php

class AppKernelDataMapper implements ArrayAccess {

	private $_models ;

	/**
	 *
	 *
	 */
	public function __construct($modeldirs) {

		if (!is_array($modeldirs)) {
			$modeldirs = array($modeldirs) ;
		}

		foreach ($modeldirs as $modeldir) {
			$dir = opendir($modeldir) ;
			if ($dir === false) {
				exit ;
			}

			while (($file = readdir($dir)) !== false) {

				if (substr($file,0,1) === '.') {
					continue ;
				}

				if (is_file($modeldir.'/'.$file)) {
					$model = str_replace('Model.php', '', $file) ;
					$class = str_replace('.php', '', $file) ;
					$this->_models[$model] = new $class() ;
				}
			}
		}
	}

	public function offsetSet($offset, $value) {

		if (is_null($offset)) {
			$this->_models[] = $value;
		} else {
			$this->_models[$offset] = $value;
		}
	}
	
	public function offsetExists($offset) {
		return isset($this->_models[$offset]);
	}
	
	public function offsetUnset($offset) {
		unset($this->_models[$offset]);
	}
	
	public function offsetGet($offset) {
		return isset($this->_models[$offset]) ? $this->_models[$offset] : null;
	}

}


