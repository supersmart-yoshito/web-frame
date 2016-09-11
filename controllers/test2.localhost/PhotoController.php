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

			// マイフォト
			$myphotos = $this->mapper['Photos']
				->findByAccountId($this->_user->getId()) ;
			$this->assign('myphotos', $myphotos) ;

		}

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
}


