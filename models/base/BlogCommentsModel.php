<?php

class BlogCommentsModel extends BaseModel {

	/**
	 * ブログ記事コメント投稿
	 * @param integer $blogId 
	 * @param integer $articleId
	 * @param integer $userId 
	 * @param string $name
	 * @param string $body
	 * @param integer $publish
	 * @return mixed 
	 */
	public function comment($articleId, $userId, $name, $body) {

		try {
			$entity = new BlogCommentsEntity() ;
			$entity->setArticleId($articleId) ;
			$entity->setUserId($userId) ;
			$entity->setName($name) ;
			$entity->setBody($body) ;
			$entity->setCreated(date('Y-m-d H:i:s')) ;
			$entity->setUpdated(date('Y-m-d H:i:s')) ;

			$this->save($entity) ;
			return $entity->getId() ;

		} catch (Exception $e) {

			return false ;
		}
	}


	/**
	 * ブログ記事コメントに対する返信
	 * @param integer $commentId
	 * @param string $resp
	 * @return mixed 
	 */
	public function response($commentId, $resp) {

		try {
			$entity = $this->findById($commentId) ;
			$entity->setResp($resp) ;
			$entity->setUpdated(date('Y-m-d H:i:s')) ;

			$this->save($entity) ;
			return $entity->getId() ;

		} catch (Exception $e) {

			return false ;
		}
	}

	/**
	 * コメント一覧取得
	 * @param integer $articleid
	 * @return array 
	 */
	public function findByArticleId($articleId) {
		return $this->findActive()
				->where('article_id', $articleId)
				->order('created DESC')
				->result()->getAll() ;
	}
}
