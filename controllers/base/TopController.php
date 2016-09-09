<?php

class TopController extends AbstractController {

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

		$clipMapper = $this->mapper['Clips'] ;



		// ログイン済みの場合Myクリップを取得
		if ($this->mapper['Accounts']->isLoggedIn()) {

			$myclips = $clipMapper->findclipsByUserId(
				$this->_user->getId(),
				ClipsModel::CLIP_TYPE_IMAGES,
				10
			);


/*
			$myclips = $clipMapper->findByUserId($this->_user->getId(), 10) ;
			foreach ($myclips as $index => $myclip) {
				$imageclipImages[$myclip->getId()] = $clipMapper->findLatestByClipId($myclip->getId()) ;
			}
*/
			// 友達のクリップを取得
		}


		return $this->render('index.tpl', array(
			'myclips' => $myclips
		)) ;
	}


	public function test2Action() {
echo __METHOD__ ;
	}

	public function test3Action($aaa,$params) {
echo __METHOD__ ;
	}
}


