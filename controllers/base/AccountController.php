<?php


class AccountController extends BaseController {


	/**
	 * TOPページ
	 * @param integer $userId
	 * @return string template path
	 */
	public function indexAction() {

		return $this->render('account/index.tpl', array(
			'user' => $this->mapper['Accounts']->getUser()
		)) ;
	}

	/**
	 * 会員ページ
	 * @param integer $userId
	 * @return string template path
	 */
	public function mypageAction($userId) {

		// ログインチェック
		if (!$this->mapper['Accounts']->isLoggedIn()) {
			$this->redirect('/account/login') ;
		}

		$my = $this->mapper['Accounts']->getUser() ;
		$user = $this->mapper['Accounts']->findById($userId) ;

		if (empty($user) || ($my->getId() !== $user->getId() && !$user->getPublish())) {
			return $this->render('account/unknown.tpl', array('user' => $my)) ;
		} else if ($my->getId() === $user->getId()) {
			return $this->render('account/mypage.tpl', array('user' => $my)) ;
		} else {
			return $this->render('account/userpage.tpl', array('user' => $my)) ;
		}
	}

	/**
	 * 入会ページ
	 * @return string template path
	 */
	public function createAction() {

		// ログインチェック
		if ($this->mapper['Accounts']->isLoggedIn()) {
			$this->redirect('/account/mypage/'.$this->getUser()->getId()) ;
		}

		// 直接遷移
		if ($this->event->isGet()) {
			return $this->render('account/create.tpl') ;
		}

		$params = $this->event->getParams() ;

		// バリデーション
		if (!$this->_validator->isValid('user_id', $params['user_id'])) {
			$error = array('user_id' => 'ご入力内容をご確認ください。') ;
			return $this->render('account/create.tpl', array(
				'error' => $error,
				'params' => $params,
			)) ;
		}
		if (!$this->_validator->isValid('user_pass', $params['user_pass'])) {
			$error = array('user_pass' => 'ご入力内容をご確認ください。') ;
			return $this->render('account/create.tpl', array(
				'error' => $error,
				'params' => $params,
			)) ;
		}
		if (!$this->_validator->isValid('user_nickname', $params['user_nickname'])) {
			$error = array('user_nickname' => 'ご入力内容をご確認ください。') ;
			return $this->render('account/create.tpl', array(
				'error' => $error,
				'params' => $params,
			)) ;
		}

		// 登録済みチェック
		if ($this->mapper['Accounts']->isJoined($params['user_id'])) {
			$error = array('user_id' => 'ご入力のIDは利用できません。') ;
			return $this->render('account/create.tpl', array(
				'error' => $error,
				'params' => $params,
			)) ;
		}


		// バリデーション２
		if (!$this->_validator->isValidParams($params)) {
		}

		// 確認前
		$confirm = $params['confirm'] ;
		if ($confirm != 1) {
			return $this->render('account/create_confirm.tpl', array(
				"params" => $params
			)) ;
		}

		// 会員登録
		$id = $this->mapper['Accounts']->create(
			$params['user_id'],
			$params['user_pass'],
			$params['user_nickname'],
			$params['birthday'],
			$params['sex'],
			$params['prefectures'],
			$params['job'],
			$params['profile']
		) ;
		if (!$id) {

			return $this->render('account/create.tpl', array(
				'error' => 1,
				'params' => $params,
			)) ;
		}

		// ログイン
		$this->mapper['Accounts']->login($params['user_id'], $params['user_pass']) ;

		return $this->render('account/create_complete.tpl', array('user' => $this->getUser())) ;
	}

	/**
	 * 退会ページ
	 * @param integer $userId
	 * @return string template path
	 */
	public function deleteAction($userId) {

		// ログインチェック
		if (!$this->mapper['Accounts']->isLoggedIn()) {
			$this->redirect('/account/'.$userId) ;
		}

		// 直接遷移
		if ($this->event->isGet()) {
			return $this->render('account/delete.tpl', array(
				'id' => $userId,
			)) ;
		}

		// 登録済みチェック
		$userId = $this->event->getParams('id') ;
		if (!$this->mapper['Accounts']->findById($userId)) {
			$this->redirect('/account') ;
		}

		// 確認前
		$confirm = $this->event->getParams('confirm') ;
		if ($confirm != 1) {
			return $this->render('account/delete_confirm.tpl', $this->event->post) ;
		}

		// 会員解除
		if (!$this->mapper['Accounts']->delete($userId)) {

			return $this->render('account/delete.tpl', array_merge(
				array('error' => 1),
				$this->event->post
			)) ;
		}

		// ログイン
		$this->mapper['Accounts']->logout() ;

		return $this->render('account/delete_complete.tpl') ;
	}

	/**
	 * ログインページ
	 * @return string template path
	 */
	public function loginAction() {

		// ログインチェック
		if ($this->mapper['Accounts']->isLoggedIn()) {
			$this->redirect('/') ;
		}

		// 直接遷移
		if ($this->event->isGet()) {
			return $this->render('account/login.tpl', array(
				'r' => $this->event->getParams('r')
			)) ;
		}

		// 登録済みチェック
		$userId = $this->event->getParams('user_id') ;
		$userPass = $this->event->getParams('user_pass') ;
		if (!$this->mapper['Accounts']->isJoined($userId)) {

			return $this->render('account/login.tpl', array_merge(
				array('error' => 1),
				$this->event->post
			)) ;
		}

		// ログイン
		$user = $this->mapper['Accounts']->login($userId, $userPass) ;
		if (!$user) {

			return $this->render('account/login.tpl', array_merge(
				array('error' => 1),
				$this->event->post
			)) ;
		}

		if ($this->event->getParams('r')) {
			return $this->redirect(urldecode($this->event->getParams('r'))) ;
		}

		return $this->redirect('/') ;
	}

	/**
	 * ログアウトページ
	 * @return string template path
	 */
	public function logoutAction() {

		$this->mapper['Accounts']->logout() ;
		return $this->redirect('/') ;
	}

}


