<?php


class BlogsModel extends BaseModel {

	const PUBLISH_OTHER = 1 ;
	const PUBLISH_FRIEND = 2 ;
	const PUBLISH_GROUP = 3 ;
	const PUBLISH_SELF = 4 ;

	/**
	 *
	 *
	 *
	 */
	public function getBlogById($blogId, $relation) {

		$this->findActive()->where('id', $blogId) ;

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

		return $this->limit(1)->result()->get(0) ;
	}


	/**
	 *
	 *
	 *
	 */
	public function getBlogByUserId($userId, $relation) {

		$this->findActive()->where('user_id', $userId) ;

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

		return $this->limit(1)->result()->get(0) ;
	}


	/**
	 *
	 *
	 *
	 */
	public function open($userId, $name, $publish, $files = null) {

		try {
			if ($this->isOpened($userId)) {
				return false ;
			}
			$entity = new BlogsEntity() ;
			$entity->setUserId($userId) ;
			$entity->setName($name) ;
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
	 *
	 *
	 *
	 */
	public function edit($userId, $name, $publish, $files = null) {

		try {
			if (!$this->isOpened($userId)) {
				return false ;
			}
			$entity = $this->findByUserId($userId) ;
			$entity->setUserId($userId) ;
			$entity->setName($name) ;
			$entity->setPublish($publish) ;
			if ($files) {
			}
			$entity->setUpdated(date('Y-m-d H:i:s')) ;

			$this->save($entity) ;
			return $entity->getId() ;

		} catch (Exception $e) {

			return false ;
		}
	}


	/**
	 *
	 *
	 *
	 */
	public function isOpened($userId) {

		$entity = $this->findByUserid($userId) ;
		if ($entity) {
			return true ;
		} else {
			return false ;
		}
	}


	/**
	 *
	 *
	 *
	 */
	public function findByUserId($userId) {

		return $this->find()
				->where('user_id', $userId)
				->limit(1)
				->result()
				->get(0) ;
	}
}



