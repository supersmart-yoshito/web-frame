<?php

class PhotoController extends AbstractController {

	private $_user ;

	/**
	 * コントローラ初期化
	 */
	public function initController() {
		$this->registerPrefilter($this, 'authenticator');
	}

	/**
	 * ユーザ認証
	 */
	public function authenticator() {

		// ログインユーザ取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
			$this->_user = $this->mapper['Accounts']->getUser() ;
			$this->assign('user', $this->_user) ;
		}

		return true ;
	}

	public function indexAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {

		}

		// 直近の公開設定されているフォト取得

		return $this->render('photo/index.tpl', array(
		)) ;
	}

	public function postAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {

		}

		// 直近の公開設定されているフォト取得

		return $this->render('photo/index.tpl', array(
		)) ;
	}
}


