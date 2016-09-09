<?php

class BlogController extends AbstractController {

	const PAGE_DIVIDER = 5 ;

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
		$authPages = array('open','edit','close','post') ;

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
				'/accounts/login?r='.urlencode($this->event->getRequestUri())
			) ;
			exit ;
		}

		return true ;
	}

	/**
	 *
	 *
	 *
	 */
	public function indexAction() {

		$myblog = null ;
		if ($this->_user) {
			$myblog = $this->mapper['Blogs']->findByUserId($this->_user->getId()) ;
		}

		$usersArticle = $this->mapper['BlogArticles']->getLatestArticles() ;

		return $this->render('blog/index.tpl', array(
			'myblog' => $myblog,
			'usersArticle' => $usersArticle
		)) ;
	}

	/**
	 *
	 *
	 *
	 */
	public function listAction($userId, $year, $month, $day) {

		// 指定ユーザの存在チェック
		$postUser = $this->mapper['Accounts']->findById($userId) ;

		// 日付生成
		$date = implode('-', array_filter(compact('year','month','day'))) ;
		if (empty($date)) {
			$date = null ;
		}

		// 閲覧可能ブログの関連性取得
		$relation = AccountsModel::RELATION_OTHER ;
		if ($this->_user) {
			$relation = $this->mapper['Accounts']->getRelation(
				$userId, $this->_user->getId()
			) ;
		}


		// 該当ブログ取得
		$blog = $this->mapper['Blogs']->getBlogByUserId($userId, $relation) ;
		if (empty($blog)) {
			return $this->render('blog/outofservice.tpl') ;
		}


		// 該当記事リスト取得
		$articles = $this->mapper['BlogArticles']->getArticles(
			$blog->getId(),
			$relation,
			$date,
			(self::PAGE_DIVIDER * ($this->getPage()-1)),
			self::PAGE_DIVIDER
		) ;
		if (empty($articles)) {
			return $this->render('blog/outofservice.tpl') ;
		}

		// 対象ブログの総記事数取得
		$count = $this->mapper['BlogArticles']->count(array(
			'deleted' => null,
			'blog_id' => $blog->getId(),
			'created' => "LIKE {$date}%",
		)) ;


		return $this->render('blog/list.tpl', array(
			'postUser' => $postUser,
			'blog' => $blog,
			'articles' => $articles,
			'pager' => $this->getPager($count, self::PAGE_DIVIDER)
		)) ;
	}

	/**
	 *
	 *
	 *
	 */
	public function detailAction($userId, $articleId) {

		// 指定ユーザの存在チェック
		$postUser = $this->mapper['Accounts']->findById($userId) ;
		if (empty($postUser)) {
			return $this->render('blog/outofservice.tpl') ;
		}

		// 該当記事リスト取得
		$article = $this->getReadableArticle($articleId) ;
		if (empty($article)) {
			return $this->render('blog/outofservice.tpl') ;
		}

		// 通常閲覧
		if ($this->event->isPost()) {

			// 確認前
			if ($this->event->getParams('comment')) {

				// データ投入
				$this->mapper['BlogComments']->comment(
					$article->getId(),
					$this->_user->getId(),
					$this->event->getParams('name'),
					$this->event->getParams('body')
				) ;

			// コメントへの返信
			} else if ($this->event->getParams('response')) {

				// データ投入
				$this->mapper['BlogComments']->comment(
					$this->event->getParams('comment_id'),
					$this->event->getParams('body')
				) ;
			}
		}

		// コメント取得
		$comments = $this->mapper['BlogComments']->findByArticleId($articleId) ;


		return $this->render('blog/detail.tpl', array(
			'postUser' => $postUser,
			'article'  => $article,
			'comments' => $comments
		)) ;
	}

	/**
	 *
	 *
	 *
	 */
	public function openAction() {

		if ($this->isOpened($this->_user->getId())) {
			$this->redirect('/blog') ;
			exit ;
		}

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->render('blog/blog.tpl') ;
		}

		// キャンセル
		if ($this->event->getParams('cancel')) {
			return $this->render('blog/blog.tpl', $this->event->post) ;
		}

		// 確認前
		if(!$this->event->getParams('confirm')) {
			$this->assign('isOpened', $this->isOpened($this->_user->getId())) ;
			return $this->render('blog/blog_confirm.tpl', $this->event->post) ;
		}

		// データ投入
		$blogId = $this->mapper['Blogs']->open(
			$this->_user->getId(),
			$this->event->getParams('name'),
			$this->event->getParams('publish')
		) ;

		return $this->render('blog/blog_complete.tpl') ;
	}


	/**
	 *
	 *
	 *
	 */
	public function editAction() {

		// 未開設での直接遷移
		$blog = $this->getBlog($this->_user->getId()) ;
		if (!$blog) {
			$this->redirect('/blog/open') ;
			exit ;
		}

		// 直接遷移
		if (!$this->event->isPost()) {
			return $this->render('blog/blog.tpl', (array)$blog) ;
		}

		// キャンセル
		if ($this->event->getParams('cancel')) {
			return $this->render('blog/blog.tpl', $this->event->post) ;
		}

		// 確認前
		if(!$this->event->getParams('confirm')) {
			$this->assign('isOpened', $this->isOpened($this->_user->getId())) ;
			return $this->render('blog/blog_confirm.tpl', $this->event->post) ;
		}

		// データ投入
		$blogId = $this->mapper['Blogs']->edit(
			$this->_user->getId(),
			$this->event->getParams('name'),
			$this->event->getParams('publish')
		) ;

		return $this->render('blog/blog_complete.tpl') ;
	}


	/**
	 *
	 *
	 *
	 */
	public function closeAction() {
		return $this->render('blog/close.tpl') ;
	}


	/**
	 *
	 *
	 *
	 */
	public function postAction() {

		// 未開設での直接遷移
		$blog = $this->getBlog($this->_user->getId()) ;
		if (!$blog) {
			$this->redirect('/blog/open') ;
			exit ;
		}

		// 直接遷移
		if (!$this->event->isPost()) {

			$this->setOutProcessing() ;
			return $this->render('blog/post.tpl') ;
		}

		// キャンセル
		if ($this->event->getParams('cancel')) {
			return $this->render('blog/post.tpl', $this->event->post) ;
		}

		// 確認前
		if(!$this->event->getParams('confirm')) {

			$this->setInProcessing() ;
			$this->assign('isOpened', $this->isOpened($this->_user->getId())) ;
			return $this->render('blog/post_confirm.tpl', $this->event->post) ;
		}

		// 重複投稿防止
		if (!$this->isInProcessing()) {

			$articleId = $this->mapper['BlogArticles']
					->getLatestArticleId($blog->getid()) ;
			return $this->render('blog/post_complete.tpl', array(
				'articleId' => $articleId
			)) ;
		}

		// データ投入
		$articleId = $this->mapper['BlogArticles']->post(
			$blog->getId(),
			$this->_user->getId(),
			$this->event->getParams('title'),
			$this->event->getParams('body'),
			$this->event->getParams('publish')
		) ;

		$this->setOutProcessing() ;

		return $this->render('blog/post_complete.tpl', array('articleId' => $articleId)) ;
	}


	/**
	 *
	 *
	 *
	 */
	public function calenderAction() {
		return $this->render('blog/index.tpl') ;
	}



	/**
	 *
	 *
	 *
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
	private function getBlog($userId) {
		return $this->mapper['Blogs']->findByUserId($userId) ;
	}


	/**
	 *
	 *
	 *
	 */
	private function isOpened($userId) {
		return $this->mapper['Blogs']->isOpened($userId) ;
	}


	/**
	 *
	 *
	 *
	 */
	private function setInProcessing() {
		$_SESSION['inProcessing_'.$this->event->server['SERVER_NAME']] = true;
	}


	/**
	 *
	 *
	 *
	 */
	private function setOutProcessing() {
		$_SESSION['inProcessing_'.$this->event->server['SERVER_NAME']] = null;
		unset($_SESSION['inProcessing_'.$this->event->server['SERVER_NAME']]);
	}


	/**
	 *
	 *
	 *
	 */
	private function isInProcessing() {
		return $_SESSION['inProcessing_'.$this->event->server['SERVER_NAME']];
	}


	/**
	 *
	 *
	 *
	 */
	private function getReadableBlog($blogId) {

		// 閲覧可能ブログの関連性取得
		$relation = AccountsModel::RELATION_OTHER ;
		if ($this->_user) {
			$relation = $this->mapper['Accounts']->getRelation(
				$userId, $this->_user->getId()
			) ;
		}

		// 該当ブログ取得
		$blog = $this->mapper['Blogs']->getBlogById($blogId, $relation) ;
		if (empty($blog)) {
			return null ;
		}

		return $blog ;
	}


	/**
	 *
	 *
	 *
	 */
	private function getReadableArticle($articleId) {

		// 閲覧可能ブログの関連性取得
		$relation = AccountsModel::RELATION_OTHER ;
		if ($this->_user) {
			$relation = $this->mapper['Accounts']->getRelation(
				$userId, $this->_user->getId()
			) ;
		}

		// 該当記事取得
		$article = $this->mapper['BlogArticles']->getArticle($articleId, $relation) ;
		if (empty($article)) {
			return null ;
		}

		return $article ;
	}

}


