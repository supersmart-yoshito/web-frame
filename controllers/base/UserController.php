<?php

class UserController extends BaseController {

	/**
	 * コントローラ初期化
	 */
	public function initController() {
		parent::initController() ;
	}

	public function indexAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('user/index.tpl') ;
	}
}
