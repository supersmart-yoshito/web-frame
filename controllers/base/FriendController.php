<?php


class FriendController extends BaseController {

	protected $authActions ;


	/**
	 * コントローラ初期化
	 */
	public function initController() {
		$this->authActions = array(
			'list',
		) ;
		parent::initController() ;
	}


	/**
	 * TOPページ
	 * @return string template path
	 */
	public function indexAction() {

		// ログイン済みの場合はユーザページへリダイレクト
		if ($this->mapper['Accounts']->isLoggedIn()) {
			return $this->redirect('/friend/list/'.$this->_user->getId()) ;
		}
		return $this->render('friend/index.tpl') ;
	}

	/**
	 * ユーザページ
	 * @return string template path
	 */
	public function listAction($accountId) {

		// 友人一覧取得
		$friends = $this->mapper['Friends']->findByAccountId($accountId) ;

		// アクティビティを取得
		$activities = array() ;
		foreach ($friends as $friend) {
			$activities[$friend->getFriendId()] = $this->mappert['UserActivities']->findLatestByUserId($friend->getFriendId()) ;
		}

		return $this->render('friend/list.tpl', array('activities' => $activities,)) ;
	}

	/**
	 * 検索ページ
	 * @return string template path
	 */
	public function searchAction() {

		return $this->render('friend/search.tpl') ;
	}

}

