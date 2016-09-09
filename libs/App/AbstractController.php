<?php


abstract class AbstractController extends AppUtil {

	protected $action ;
	protected $mapper;
	protected $event;
	protected $__time ;
	protected $__token ;

	private $_models ;
	private $_lang ;

	/**
	 * コンストラクタ
	 */
	public function __construct($event, $action) {
		$this->event = $event ;
		$this->action = $action ;
		$this->_lang = new AppVendorLang($event) ;
		$this->_ua = new AppVendorUseragent() ;

		// サブクラスに初期化メソッドが定義されていれば実行
		if (method_exists($this, 'initController')) {
			// 初期化
			$this->initController() ;
		}
	}

	/**
	 * テンプレートエンジン設定
	 */
	public function setEngine($engine) {
		$this->_engine = $engine ;
		$this->_engine->assign('lang', $this->_lang) ;
		$this->_engine->assign('isPc', $this->isPc()) ;
		$this->_engine->assign('isSp', $this->isSp()) ;
		$this->__time = time() ;
		$this->_engine->assign('__time', $this->__time) ;
		$this->__token = $this->generateToken(null, $this->__time) ;
		$this->_engine->assign('__token', $this->__token) ;
	}

	/**
	 * モデル設定
	 */
	public function loadModels($modeldir) {
		$this->mapper = new AppKernelDataMapper($modeldir) ;
	}


	/**
	 * PCブラウザ
	 */
	public function isPc() {
		return $this->_ua->set() !== 'mobile' ;
	}

	/**
	 * スマホブラウザ
	 */
	public function isSp() {
		return $this->_ua->set() === 'mobile' ;
	}


	/**
	 *
	 *
	 *
	 */
	protected function getPage() {
		return ($this->event->get['p'] > 0) ? $this->event->get['p'] : 1 ;
	}

	/**
	 * ページャー取得
	 * @param integer $count データ総数
	 * @param integer $divider １ページあたりの表示数
	 * @param integer $page 現在ページ
	 * @retrun 
	 */
	public function getPager($count, $divider = 30, $page = null) {

		if (is_null($page)) {
			$page = $this->getPage() ;
		}
		$uri = strtok($this->event->getRequestUri(), '?') ;
		return new AppVendorPager($uri, $page, $count, $divider) ;
	}

	/**
	 * 描画
	 * @param string $template テンプレート名
	 * @param array $params テンプレート変数値
	 * @return void 
	 */
	public function render($template, $params = array()) {
		foreach ($params as $key => $value) {
			$this->_engine->assign($key, $value) ;
		}

		if ($this->isSp()) {
			$template = 'sp/'.$template ;
		} else {
			$template = 'pc/'.$template ;
		}
		// ドメイン独自テンプレート指定
		if (!file_exists(PATH_VIEWS.'/'.$template)) {
			$template = '../base/'.$template ;
		}

		return $template ;
	}

	/**
	 * リクエスト転送
	 * @param string $route
	 * @reutrn void
	 */
	public function redirect($route, $return = null) {
		header('Location: '.$route) ;
		exit ;
	}


	/**
	 * テンプレート変数設定
	 * @param string $alias 変数名
	 * @param mixed $value 変数値
	 */
	public function assign($alias, $value) {
		$this->_engine->assign($alias, $value) ;
	}


	/**
	 * フィルター設定有無
	 * @param string $filter フィルタ種別
	 *
	 * @return boolean 
	 */
	public function isRegisteredFilter($filter) {
		return !empty($this->{$filter})
			&& !empty($this->{$filter}['class'])
			&& !empty($this->{$filter}['method']) ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function registerPrefilter($class, $method) {
		$this->registerFilter('prefilter', $class, $method) ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function registerPostfilter($class, $method) {
		$this->registerFilter('postfilter', $class, $method) ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function executePrefilter() {
		$this->executeFilter('prefilter') ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function executePostfilter() {
		$this->executeFilter('postfilter') ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function __toString() {
		return get_class() ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	protected function getAction() {
		return $this->action ;
	}


	/**
	 *
	 *
	 */
	private function registerFilter($filter, $class, $method) {
		$this->{$filter} = array(
			'class' => $class,
			'method'=> $method
		) ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	private function executeFilter($filter) {

		if (!$this->isRegisteredFilter($filter)) {
			return true ;
		}

		if (!method_exists($this->{$filter}['class'], $this->{$filter}['method'])) {
			return true ;
		}

		return call_user_func(array($this->{$filter}['class'], $this->{$filter}['method'])) ;
	}
}

