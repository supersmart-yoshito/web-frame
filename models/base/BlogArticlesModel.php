<?php

class BlogArticlesModel extends BaseModel {

	const PUBLISH_OTHER = 0 ;
	const PUBLISH_FRIEND = 1 ;
	const PUBLISH_GROUP = 2 ;
	const PUBLISH_SELF = 3 ;



	/**
	 * ブログ記事投稿
	 * @param integer $blogId 
	 * @param integer $userId 
	 * @param string $title
	 * @param string $body
	 * @param integer $publish
	 * @param array $files
	 * @return mixed 
	 */
	public function post($blogId, $userId, $title, $body, $publish, $files = null) {

		try {
			$entity = new BlogArticlesEntity() ;
			$entity->setBlogId($blogId) ;
			$entity->setUserId($userId) ;
			$entity->setTitle($title) ;
			$entity->setBody($body) ;
			$entity->setPublish($publish) ;
			if ($files) {
			}
			$entity->setCreated(date('Y-m-d H:i:s')) ;
			$entity->setUpdated(date('Y-m-d H:i:s')) ;

			$this->save($entity) ;
			return $entity->getId() ;

		} catch (Exception $e) {

			return false ;
		}
	}


	/**
	 * 指定ブログの記事リスト取得
	 * @param integer $blogId 
	 * @param integer $userRelatins 
	 * @param string $date 
	 * @param integer $begin
	 * @param integer $offset 
	 * @return BlogArticlesEntity
	 */
	public function getArticles($blogId, $userRelations, $date = null, $begin= null, $offset = null) {

		$this->findActive()->where('blog_id', $blogId) ;
		if($date) {
			$this->where('created', "LIKE {$date}%") ;
		}

		switch ($relation) {
		case AccountsModel::RELATION_SELF :
			$this->where('publish', '<= '.self::PUBLISH_SELF) ;
			break ;
		case AccountsModel::RELATION_GROUP :
			$this->where('publish', '<= '.self::PUBLISH_GROUP) ;
			break ;
		case AccountsModel::RELATION_FRIEND :
			$this->where('publish', '<= '.self::PUBLISH_FREND) ;
			break ;
		case AccountsModel::RELATION_OTHER :
		default :
			$this->where('publish', '<= '.self::PUBLISH_OTHER) ;
			break ;
		}

		if (!is_null($begin)) {
			$this->limit(implode(',', array_filter(compact('begin', 'offset'))));
		}
		$this->order('created DESC') ;

		return $this->result()->getAll() ;
	}


	/**
	 * 指定ブログの記事取得
	 * @param integer $blogId 
	 * @param integer $userRelatins 
	 * @param string $date 
	 * @param integer $begin
	 * @param integer $offset 
	 * @return BlogArticlesEntity
	 */
	public function getArticle($articleId, $userRelations) {

		$this->findActive()->where('id', $articleId) ;

		switch ($relation) {
		case AccountsModel::RELATION_SELF :
			$this->where('publish', '<= '.self::PUBLISH_SELF) ;
			break ;
		case AccountsModel::RELATION_GROUP :
			$this->where('publish', '<= '.self::PUBLISH_GROUP) ;
			break ;
		case AccountsModel::RELATION_FRIEND :
			$this->where('publish', '<= '.self::PUBLISH_FREND) ;
			break ;
		case AccountsModel::RELATION_OTHER :
		default :
			$this->where('publish', '<= '.self::PUBLISH_OTHER) ;
			break ;
		}

		return $this->result()->get(0) ;
	}


	/**
	 * 最新ブログの記事リスト取得
	 * @return BlogArticlesEntity
	 */
	public function getLatestArticles() {

		$this->findActive() ;
		$this->where('publish', '<= '.self::PUBLISH_OTHER) ;
		$this->group('blog_id') ;
		$this->limit(20) ;
		$this->order('created DESC') ;

		return $this->result()->getAll() ;
	}


	/**
	 *
	 *
	 *
	 *
	 */
	public function getLatestArticleId($blogId) {

		$latest = $this->findActive()
			->where('blog_id', $blogId)
			->order('id desc')
			->limit(1)
			->result()
			->get(0) ;
		if ($latest) {
			return $latest->getId() ;
		} else {
			return null ;
		}
	}
}

