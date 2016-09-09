<?php

class AppKernelEvent {

	public $method ;
	public $uri ;
	public $server ;
	public $post ;
	public $get ;
	public $request ;
	public $session ;
	public $cookie ;
	public $files ;


	public function __construct() {

		$this->initialize() ;
	}


	public function initialize() {

		$this->method = $_SERVER['REQUEST_METHOD'] ;
		$this->uri = $_SERVER['REQUEST_URI'] ;
		$this->server = $_SERVER ;
		$this->post = $_POST ;
		$this->get = $_GET ;
		$this->request = $_REQUEST ;
		$this->session = $_SESSION ;
		$this->cookie = $_COOKIE ;
		$this->files = $_FILES ;
	}

	public function getRequestUri() {
		return $this->uri ;
	}

	/**
	 * POSTメソッド判定
	 * @return boolean true/false
	 */
	public function isPost() {
		return $this->server['REQUEST_METHOD'] === 'POST' ;
	}

	/**
	 * GETメソッド判定
	 * @return boolean true/false
	 */
	public function isGet() {
		return $this->server['REQUEST_METHOD'] === 'GET' ;
	}

	/**
	 * パラメータ取得
	 * @param string $name パラメータキー
	 * @return string パラメータ値
	 */
	public function getParams($name = null) {

		if ($name !== null) {
			return $this->request[$name] ;
		}

		return $this->request ;
	}

	/**
	 * ファイル取得
	 * @param string $name パラメータキー
	 * @return string パラメータ値
	 */
	public function getFiles($name = null) {

		if ($name !== null) {
			return $this->files[$name] ;
		}

		return $this->files;
	}

	/**
	 * 言語判定
	 */
	public function isJapanese() {
		return $this->isLang('ja') ;
	}

	public function isEnglish() {
		return $this->isLang('en') ;
	}

	public function isChinese() {
		return $this->isLang('zh') ;
	}

	public function isLang($countryCode = 'ja') {

		$languages = explode(',', $this->server['HTTP_ACCEPT_LANGUAGE']);
		$languages = array_reverse($languages);

		foreach ($languages as $language) {
			if (preg_match('/^'.$countryCode.'/i', $language)) {
				$result = 'Japanese';
			}
		}
	}
}

