<?php

class MessageController extends BaseController {


	// 認証必須ページ
        protected $authActions ;



	/**
	 * コントローラ初期化
	 */
	public function initController() {
		$this->registerPostfilter($this, 'unreadCount') ;
                $this->authActions = array('inbox', 'outbox', 'edit', 'post', 'trash', 'group') ;
		parent::initController() ;
	}


	/**
	 * 後処理
	 */
	public function unreadCount() {
		// 未開封数取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
			$unreadCount = $this->mapper['Messages']->countUnreadInbox(
				$this->_user->getId()
			) ;
			if ($unreadCount) {
				$this->assign('isNewMessage', true) ;
			}
			$this->assign('unreadCount', $unreadCount) ;
		}
	}

	public function indexAction() {

		// ログイン済みの場合
		if ($this->mapper['Accounts']->isLoggedIn()) {
			return $this->redirect('/message/inbox') ;
		}

		return $this->render('message/index.tpl') ;
	}

	public function inboxAction($messageId) {

		// 一覧表示
		if (empty($messageId)) {

			// 全受信メッセージ
			$messages = $this->mapper['Messages']->findAllInboxByAccountid(
				$this->_user->getId()
			) ;
			$this->assign('messages', $messages) ;
			return $this->render('message/inbox.tpl') ;

		} else {

			$this->assign('enableReply', true) ;

			// 対象メッセージ表示
			$message = $this->mapper['Messages']->findAllInboxByIdAndAccountId(
				$messageId,
				$this->_user->getId()
			) ;
			$this->assign('message', $message) ;

			// 既読に設定
			$message->setIsOpen(1) ;
			$this->mapper['Messages']->save($message) ;

			return $this->render('message/message.tpl') ;
		}
	}

	public function outboxAction($messageId) {

		// 一覧表示
		if (empty($messageId)) {

			// 全受信メッセージ
			$messages = $this->mapper['Messages']->findAllOutboxByAccountid(
				$this->_user->getId()
			) ;
			$this->assign('messages', $messages) ;
			return $this->render('message/outbox.tpl') ;

		} else {

			// 対象メッセージ表示
			$message = $this->mapper['Messages']->findAllOutboxByIdAndAccountId(
				$messageId,
				$this->_user->getId()
			) ;
			$this->assign('message', $message) ;

			return $this->render('message/message.tpl') ;
		}
	}

	public function editboxAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		return $this->render('message/editbox.tpl') ;
	}

	public function editAction($editId, $accountId) {

		$userId = $this->_user->getId() ;

		$params = array() ;
		// メッセージ指定あり
		if ($editId) {

			$message = $this->mapper['Messages']->findById($editId) ;
			if (empty($message)) {
				$params['error'] = '正常に処理が完了しませんでした。(001)' ;
				return $this->render('message/edit.tpl', array('params' => $params)) ;
			}

			// 返信
			if ($message->getIsSend() == 1 && $message->getToAccountId() == $userId) {

				// 返信相手を指定
				$accountId = $message->getFromAccountId() ;
				$params['messageId'] = $message->getId() ;
				$params['subject'] = 'Re:'.$message->getSubject() ;

			// 編集
			} else if ($message->getIsSend() == 0 && $message->getFromAccountId() == $userId) {
				$params['subject'] = $message->getSubject() ;
				$params['body'] = $message->getBody() ;

			// 自分に関連したメッセージではない
			} else {
				$params['error'] = '正常に処理が完了しませんでした。(002)' ;
				return $this->render('message/edit.tpl', array('params' => $params)) ;
			}
		}

		// 相手指定の場合
		if ($accountId) {
			$friends = $this->mapper['Accounts']->findById($accountId) ;
			$toList = array($friends) ;

		// 相手指定なしの場合
		} else {
			$friends = $this->mapper['Friends']->findByAccountId($userId) ;
			$toList = $friends ;
		}

		$params['toList'] = $toList ;
		return $this->render('message/edit.tpl', array('params' => $params)) ;
	}

	public function postAction() {

		if (!$this->event->isPost()) {
			return $this->redirect('/message/index') ;
		}

		$params = $this->event->getParams() ;
		// 必須入力チェック
		if (empty($params['to']) || empty($params['body'])) {
			$params['error'] = '入力内容をご確認の上再度お試しください' ;
			return $this->render('message/edit.tpl', array('params' => $params)) ;
		}

		// バリデーション情報の有無チェック
		if (empty($params['__token']) || empty($params['__time'])) {
			$params['error'] = '正常に処理が完了しませんでした。(001)' ;
			return $this->render('message/edit.tpl', array('params' => $params)) ;
		}

		// 60分以上
		if ($params['__time'] + 3600 < $this->__time) {
			$params['error'] = '正常に処理が完了しませんでした。(002)' ;
			return $this->render('message/edit.tpl', array('params' => $params)) ;
		}

		// トークンの有効性確認
		if ($this->generateToken(null, $params['__time']) !== $params['__token']) {
			$params['error'] = '正常に処理が完了しませんでした。(003)' ;
			return $this->render('message/edit.tpl', array('params' => $params)) ;
		}


		// メッセージ送信
		$ret = $this->mapper['Messages']->sendMessage(
			$this->_user->getId(),
			$params['to'],
			$params['subject'],
			$params['body'],
			$attachment,
			1, // 送信済みフラグ
			0, // 開封済みフラグ
			$messageId // 関連メッセージID
		) ;
		if (!$ret) {
			exit ;
		}

		return $this->redirect('/message/inbox') ;
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
