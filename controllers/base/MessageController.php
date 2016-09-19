<?php

class MessageController extends BaseController {

        protected $authActions ;

	/**
	 * コントローラ初期化
	 */
	public function initController() {
                $this->authActions = array('inbox', 'outbox', 'edit', 'trash', 'group') ;
		parent::initController() ;
	}

	public function indexAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/index.tpl') ;
	}

	public function inboxAction() {

		$messages = $this->mapper['Messages']->findAllInboxByToAccountid($this->_user->getId()) ;

		return $this->render('message/inbox.tpl', array('messages' => $messages)) ;
	}

	public function outboxAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/outbox.tpl') ;
	}

	public function editboxAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/editbox.tpl') ;
	}

	public function editAction($editId) {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/edit.tpl') ;
	}

	public function trashAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/trash.tpl') ;
	}

	public function groupAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/group.tpl') ;
	}
}
