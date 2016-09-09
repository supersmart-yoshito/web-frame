<?php

class ClipController extends AbstractController {

	const CLIP_LISTING = 10 ;
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
		$authPages = array('open', 'close', 'post') ;

		// ログインユーザ取得
		$this->_user = $this->getUser() ;
		$this->assign('user', $this->_user) ;

		// 認証が必要なページ以外
		if (!in_array($this->action, $authPages)) {
			return true ;
		}

		// 認証が必要なページ
		if (!$this->_user) {
			$this->redirect(
				'/user/login?r='.urlencode($this->event->getRequestUri())
			) ;
			exit ;
		}

		return true ;
	}

	/**
	 * トップページ
	 * @param integer $userId ユーザID
	 * @return 
	 */
	public function indexAction($userId) {
		$shareclips = array() ;
		$clips = array() ;

		if (!$userId && !$this->_user) {
			return $this->render('clip/index.tpl', array(
				'clips' => $clips,
			)) ;
		}


		// 共有クリップ
		$shareclipImages = $this->mapper['ClipImages']->findLatestClips() ;
		foreach ($shareclipImages as $index => $image) {
			$shareclips[$image->getClipId()] = $this->mapper['Clips']
				->findById($image->getClipId()) ;
		}


		// ユーザクリップ
		if ($userId) {

			$imageclips = $this->mapper['Clips']->findByUserIdAndType(
				$userId,
				ClipsModel::CLIP_TYPE_IMAGES,
				self::CLIP_LISTING
			) ;

			$memoclips = $this->mapper['Clips']->findByUserIdAndType(
				$userId,
				ClipsModel::CLIP_TYPE_MEMOS,
				self::CLIP_LISTING
			) ;
		} else if ($this->_user) {

			$imageclips = $this->mapper['Clips']->findByUserIdAndType(
				$this->_user->getId(),
				ClipsModel::CLIP_TYPE_IMAGES,
				self::CLIP_LISTING
			) ;

			$memoclips = $this->mapper['Clips']->findByUserIdAndType(
				$this->_user->getId(),
				ClipsModel::CLIP_TYPE_MEMOS,
				self::CLIP_LISTING
			) ;
		}


		foreach ($imageclips as $index => $clip) {
			$imageclipImages[$clip->getId()] = $this->mapper['ClipImages']
				->findLatestByClipId($clip->getId()) ;
		}
		foreach ($memoclips as $index => $clip) {
			$memoclipMemos[$clip->getId()] = $this->mapper['ClipMemos']
				->findLatestByClipId($clip->getId()) ;
		}

		return $this->render('clip/index.tpl', array(
			'isMyClip' => $userId == $this->_user->getId(),
			'shareclips' => $shareclips,
			'shareclipImages' => $shareclipImages,
			'imageclips' => $imageclips,
			'imageclipImages' => $imageclipImages,
			'memoclips' => $memoclips,
			'memoclipMemos' => $memoclipMemos
		)) ;
	}


	/**
	 * リストページ
	 * @param integer $userId ユーザID
	 * @return 
	 */
	public function listAction($type, $userId) {
		$shareclips = array() ;
		$clips = array() ;

		if (!$userId && !$this->_user) {
			return $this->render('clip/index.tpl', array(
				'clips' => $clips,
			)) ;
		}


		// 共有クリップ
		$shareclipImages = $this->mapper['ClipImages']->findLatestClips() ;
		foreach ($shareclipImages as $index => $image) {
			$shareclips[$image->getClipId()] = $this->mapper['Clips']
				->findById($image->getClipId()) ;
		}


		// ユーザクリップ
		if ($userId) {

			$clips = $this->mapper['Clips']->findByUserId($userId, self::CLIP_LISTING) ;

		} else if ($this->_user) {

			$clips = $this->mapper['Clips']->findByUserId($this->_user->getId(), self::CLIP_LISTING) ;
		}


		foreach ($clips as $index => $clip) {
			$clipImages[$clip->getId()] = $this->mapper['ClipImages']
				->findLatestByClipId($clip->getId()) ;
		}

		return $this->render('clip/index.tpl', array(
			'isMyClip' => $userId == $this->_user->getId(),
			'shareclips' => $shareclips,
			'shareclipImages' => $shareclipImages,
			'clips' => $clips,
			'clipImages' => $clipImages
		)) ;
	}


	/**
	 *
	 *
	 *
	 */
	public function clipAction($clipId) {

		if (!$clipId) {
		}

		$clip = $this->mapper['Clips']->findById($clipId) ;
		if (!$clip) {
		}


		switch ($clip->getType()) {
		case ClipsModel::CLIP_TYPE_IMAGES :
			$clips = $this->mapper['ClipImages']->findByClipId($clipId) ;
			break ;
		case ClipsModel::CLIP_TYPE_VIDEOS :
			break ;
		case ClipsModel::CLIP_TYPE_MUSICS :
			break ;
		case ClipsModel::CLIP_TYPE_MEMOS :
			break ;
		default :
			$clips = $this->mapper['ClipImages']->findByClipId($clipId) ;
			break ;
		}

		return $this->render('clip/clip.tpl', array(
			'clip' => $clip,
			'clips' => $clips,
		)) ;
	}


	/**
	 *
	 *
	 *
	 */
	public function openAction() {

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->render('clip/open.tpl') ;
		}

		// キャンセル
		if ($this->event->getParams('cancel')) {
			return $this->render('clip/open.tpl', $this->event->post) ;
		}

		// 確認前
		if(!$this->event->getParams('confirm')) {
			return $this->render('clip/open_confirm.tpl', $this->event->post) ;
		}

		// データ投入
		$clipId = $this->mapper['Clips']->open(
			$this->_user->getId(),
			$this->event->getParams('title'),
			$this->event->getParams('publish'),
			$this->event->getParams('type')
		) ;

		return $this->render('clip/open_complete.tpl') ;
	}


	/**
	 *
	 *
	 *
	 */
	public function createApiAction() {

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->renderJson(-1) ;
		}

		// データ投入
		$clipId = $this->mapper['Clips']->open(
			$this->_user->getId(),
			$this->event->getParams('title'),
			$this->event->getParams('publish'),
			$this->event->getParams('type')
		) ;

		return $this->renderJson(0, array(
			'clip_id'=>$clipId,
			'type'=>$this->event->getParams('type'),
			'title'=>$this->event->getParams('title')
		)) ;
	}


	/**
	 *
	 *
	 *
	 */
	public function postApiAction() {

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->renderJson(-1) ;
		}

		// 必要項目のPOSTチェック
		if (empty($this->event->getParams('title'))
			|| empty($this->event->getParams('publish'))
			|| empty($this->event->getParams('type'))) {

			return $this->renderJson(-2) ;
		}

		// 画像付きクリップのチェック
		$clipWithImage = array(ClipsModel::CLIP_TYPE_IMAGES) ;
		if (in_array($this->event->getParams('type'), $clipWithImage)) {

			if (empty($this->event->files) || empty($this->event->files['clip'])) {
				return $this->renderJson(-3) ;
			}

			// エラーが発生している場合は即時終了
			foreach ($this->event->files['clip']['error'] as $index => $error) {
				if ($error !== 0) {
					return $this->renderJson(
						-4, 
						$this->event->files['clip']['error']
					) ;
				}

				// 許容MIMEチェック
				$type = @exif_imagetype($this->event->files['clip']['tmp_name'][$index]);
				if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
					return $this->renderJson(-5, array('index' => $index)) ;
				}
			}
		}

		// クリップの作成
		$clipId = $this->mapper['Clips']->open(
			$this->_user->getId(),
			$this->event->getParams('title'),
			$this->event->getParams('publish'),
			$this->event->getParams('type')
		) ;

		// クリップへのデータ紐付け
		switch ($this->event->getParams('type')) {
		case ClipsModel::CLIP_TYPE_IMAGES :
			$postIds = $this->addImages($clipId) ;
			break ;
		case ClipsModel::CLIP_TYPE_MEMOS :
			$postIds = $this->addMemos($clipId) ;
			break ;
		default :
			$postIds = $this->addImages($clipId) ;
			break ;
		}

		return $this->renderJson(0, array(
			'clip_id'=>$clipId,
			'type'=>$this->event->getParams('type'),
			'title'=>$this->event->getParams('title'),
			'post_ids' => $postIds,
		)) ;
	}


	/**
	 *
	 * @param integer $clipId クリップID
	 * @return 
	 */
	public function updateApiAction($clipId) {

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->renderJson(1) ;
		}

		$clip = $this->mapper['Clips']->findById($clipId) ;
		if (!$clip || $clip->getUserId() != $this->_user->getId()) {
			return $this->renderJson(2) ;
		}

		switch ($clip->getType()) {
		case ClipsModel::CLIP_TYPE_IMAGES :
		case ClipsModel::CLIP_TYPE_MEMOS :
		default :
		}
	}


	/**
	 * 画像取得API
	 * @param integer $imageId 画像ID
	 * @return 
	 */
	public function imageApiAction($imageId) {

		// 画像の有無チェック
		$image = $this->mapper['ClipImages']->findById($imageId) ;
		if ($image) {
			$clip = $this->mapper['Clips']->findById($image->getClipId()) ;
		}

		// TODO: アクセス可否チェック

		header('Content-type: image/jpeg');
		echo $image->getImage() ;
		//readfile('data/user/'.$image->getUserId().'/'.$image->getName()) ;
		exit ;
	}



	/**
	 * ユーザ情報
	 * @return mixed 
	 */
	private function getUser() {
		$user = null ;
		if ($this->mapper['Accounts']->isLoggedIn()) {
			$user = $this->mapper['Accounts']->getUser() ;
		}

		return $user ;
	}


	/**
	 *
	 *
	 *
	 */
	private function makeDirectory($dirname) {

		if (is_dir($dirname)) {
			return true ;
		}

		mkdir($dirname) ;
		return true ;
	}

	/**
	 * 画像クリップ処理
	 * @param integer $clipId クリップID
	 * @return string テンプレート名
	 */
	private function addImages($clipId) {

		if (!$this->event->files) {
			return false ;
		}

		$tmpNames = $this->event->files['clip']['tmp_name'] ;
		$names = $this->event->files['clip']['name'] ;

/*
		$this->makeDirectory(STORAGE_DIR.'/user/'.$this->_user->getId()) ;
		if (!move_uploaded_file($tmpName, STORAGE_DIR.'/user/'.$this->_user->getId().'/'.$name)) {
			return $this->render('api/response.tpl', array(
				'apiResponse' => json_encode(array('status' => 4)),
			)) ; 
		}
*/

		$imageIds = array() ;
		foreach ($tmpNames as $index => $tmpName) {

			// データ投入
			$imageId = $this->mapper['ClipImages']->addImage(
				$clipId,
				$this->_user->getId(),
				$names[$index],
				$tmpName
			) ;

			$imageIds[] = $imageId ;
		}

		return $imageIds ;
	}

	/**
	 * メモクリップ処理
	 * @param integer $clipId クリップID
	 * @return string テンプレート名
	 */
	private function clipMemos($clipId) {


		$text = $this->event->getParams('text') ;

		// データ投入
		$clipMemosId = $this->mapper['ClipMemos']->post(
			$clipId,
			$this->_user->getId(),
			$text
		) ;

		return $this->renderJson(0, array(
			'clip_id' => $clipId,
			'memo_id' => $clipMemosId
		)) ; 
	}


	/**
	 * メモクリップ処理
	 * @param integer $clipId クリップID
	 * @return string テンプレート名
	 */
	private function addMemos($clipId) {


		$text = $this->event->getParams('text') ;

		// データ投入
		$clipMemosId = $this->mapper['ClipMemos']->post(
			$clipId,
			$this->_user->getId(),
			$text
		) ;

		return $this->renderJson(0, array(
			'clip_id' => $clipId,
			'memo_id' => $clipMemosId
		)) ; 
	}


	private function renderJson($status, $data=array()) {

		return $this->render('api/response.tpl', array(
			'apiResponse' => json_encode(array_merge(array('status' => $status), $data)),
		)) ; 
	}
}

