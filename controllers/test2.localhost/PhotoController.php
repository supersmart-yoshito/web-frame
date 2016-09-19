<?php

class PhotoController extends BaseController {

	protected $authActions ;
	/**
	 * コントローラ初期化
	 */
	public function initController() {
		$this->authActions = array(
			'index', 'post',
		) ;
		parent::initController() ;
	}

	public function topAction() {
		return $this->indexAction() ;
	}

	public function indexAction() {

		// ログイン済みの場合は関連フォト取得
		if ($this->mapper['Accounts']->isLoggedIn()) {

			// マイフォト
			$myphotos = $this->mapper['Photos']
				->findByAccountId($this->_user->getId()) ;
			$this->assign('myphotos', $myphotos) ;

			// 友人の写真
			$friends = $this->mapper['Friends']
				->findActive(array('user_id' => $this->_user->getId()))
				->result()->getAll() ;
			$firendphotos = array() ;
			foreach ($friends as $friend) {
				$photos = $this->mapper['Photos']
					->findByAccountId($friend->getFriendId()) ;
				if (!empty($photos)) {
					$friendphotos = array_merge($firendphotos, $photos) ;
				}
			}
			$this->assign('friendphotos', $friendphotos) ;
		}

		// 直近の写真
		$latestphotos = $this->mapper['Photos']
					->find()
					->order('created desc')
					->result()
					->getAll();
		$this->assign('latestphotos', $latestphotos) ;

		// 直近の公開設定されているフォト取得
		return $this->render('photo/index.tpl') ;
	}

	public function postAction() {

		// 未ログインの場合は関連フォト取得
		if (!$this->mapper['Accounts']->isLoggedIn()) {
			return $this->indexAction() ;
		}

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->indexAction() ;
		}

		// 必要項目のPOSTチェック
		$event = $this->event ;
		if (empty($event->getParams('title'))) {
			$this->assign('error', "タイトルを入力してください") ;
			return $this->indexAction() ;
		}
		if (empty($event->getParams('publish'))) {
			$this->assign('error', "公開範囲を設定してください") ;
			return $this->indexAction() ;
		}
		// 画像指定なし
		if (empty($event->files) || empty($event->files['photo'])) {
			$this->assign('error', "画像を設定してください") ;
			return $this->indexAction() ;
		}

		// エラー発生
		if (!empty($event->files['photo']['error'])) {
			$this->assign('error', "システムエラー") ;
			return $this->indexAction() ;
		}

		// 許容MIMEチェック
		$type = @exif_imagetype($event->files['photo']['tmp_name']);
		if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
			$this->assign('error', "未対応の画像ファイル形式です") ;
			return $this->indexAction() ;
		}

		$mime = null ;
		if ($type === IMAGETYPE_GIF) {
			$mime = 'image/gif' ;
		} else if ($type === IMAGETYPE_JPEG) {
			$mime = 'image/jpeg' ;
		} else if ($type === IMAGETYPE_PNG) {
			$mime = 'image/png' ;
		}

		// 画像データ保存
		$postIds = $this->mapper['Photos']->addImage(
			$this->_user->getId(),
			$event->getParams('title'),
			$event->files['photo']['tmp_name'],
			$mime
		) ;

		// 直近の公開設定されているフォト取得
		return $this->redirect('/photo') ;
	}

	public function imageAction($photoId) {

		$id = $this->event->getParams('id') ;
		$image = $this->mapper['Photos']->findById($photoId) ;

		header('Content-Type: '.$image->mime) ;
		echo $image->getImage() ;
	}

	/**
	 * 該当のユーザの写真一覧ページ
	 *
	 * @param string $userId ユーザID
	 */
	public function userAction($userId) {

		// ユーザの存在確認
		$user = $this->mapper['Accounts']->findById($userId) ;
		if (empty($user)) {
			return $this->render('photo/error.tpl', array(
				'error' => '存在しないユーザのページにアクセスしました。',
			)) ;
		}

		// ログイン済み
		if ($this->mapper['Accounts']->isLoggedIn()) {
		}

		/**  TODO
		// 参照許可のないユーザへのアクセス確認
		if () {
		}
		*/

		// 該当ユーザの写真一覧を取得
		list($limit, $offset) = $this->getPage() ;
		$count = $this->mapper['Photos']->count(array('account_id' => $user->getId())) ;
		$this->assign('pager', $this->getPager($count)) ;
		$userphotos = $this->mapper['Photos']->findByAccountId($user->getId(), 30) ;
		$this->assign('userphotos', $userphotos) ;

		return $this->render('photo/user.tpl') ;
	}

	/**
	 * 自分の友達の写真一覧ページ
	 *
	 * @param string $userId ユーザID
	 */
	public function friendsAction() {

		// ログイン済み
		if ($this->mapper['Accounts']->isLoggedIn()) {

			$friends = $this->mapper['Friends']->findByAccountId($this->_user->getId()) ;
			$friendphotos = array() ;
			foreach ($friends as $friend) {

				$friendphotos[$friend->getFriendId()] = $this->mapper['Photos']->findByAccountId($friend->getFriendId()) ;

			}
			$this->assign('friends', $friends) ;
			$this->assign('friendphotos', $friendphotos) ;
		}


/*
		// ユーザの存在確認
		$user = $this->mapper['Accounts']->findById($userId) ;
		if (empty($user)) {
			return $this->render('photo/error.tpl', array(
				'error' => '存在しないユーザのページにアクセスしました。',
			)) ;
		}
*/

		/**  TODO
		// 参照許可のないユーザへのアクセス確認
		if () {
		}
		*/

/*
		// 該当ユーザの写真一覧を取得
		list($limit, $offset) = $this->getPage() ;
		$count = $this->mapper['Photos']->count(array('account_id' => $user->getId())) ;
		$this->assign('pager', $this->getPager($count)) ;
		$userphotos = $this->mapper['Photos']->findByAccountId($user->getId(), 30) ;
		$this->assign('userphotos', $userphotos) ;
*/

		return $this->render('photo/friends.tpl') ;
	}
}
