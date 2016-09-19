<?php

class BaseController extends AbstractController {

	protected $_user ;
	private $_authPages ;

	/**
	 * コントローラ初期化
	 */
	public function initController() {
		$this->registerPrefilter($this, 'authenticator');

		if (property_exists($this, 'authActions')) {
			foreach ($this->authActions as $action) {
				$this->addAuthAction($action) ;
			}
		}
	}

	/**
	 * ユーザ認証
	 */
	public function authenticator() {

		// ログインユーザ取得
		$this->_user = $this->getUser() ;
		$this->assign('user', $this->_user) ;

		// 認証が必要なページはなし1
		if (empty($this->_authPages)) {
			return true ;
		}

		// 認証が必要なページ以外
		if (is_array($this->_authPages) && !in_array($this->action, $this->_authPages)) {
			return true ;
		}

		// 認証が必要なページ
		if (!$this->_user) {
			$this->redirect(
				'/account/login?r='.urlencode($this->event->getRequestUri())
			) ;
			exit ;
		}

		return true ;
	}


	/**
	 * ユーザ情報
	 * @return mixed 
	 */
	protected function getUser() {

		$user = null ;
		if ($this->mapper['Accounts']->isLoggedIn()) {
			$user = $this->mapper['Accounts']->getUser() ;
		}

		return $user ;
	}


	/**
	 * 認証ページのアクション登録
	 * @param string $action アクション名
	 */
	protected function addAuthAction($action) {
		$this->_authPages[] = $action ;
	}
}

