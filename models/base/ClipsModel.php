<?php


class ClipsModel extends BaseModel {

	const CLIP_TYPE_IMAGES = 1 ;
	const CLIP_TYPE_VOICES = 2 ;
	const CLIP_TYPE_VIDEOS = 3 ;
	const CLIP_TYPE_MUSICS = 4 ;
	const CLIP_TYPE_MEMOS  = 5 ;

	/**
	 *
	 *
	 *
	 */
	public function open($userId, $title, $publish, $type = self::CLIP_TYPE_IMAGES, $categoryId = null) {

		try {
			$entity = new ClipsEntity() ;
			$entity->setUserId($userId) ;
			$entity->setTitle($title) ;
			$entity->setPublish($publish) ;
			if ($categoryid) {
				$entity->setCategoryId($categoryId) ;
			}
			$entity->setType($type) ;
			$entity->setCreated(date('Y-m-d H:i:s')) ;
			$entity->setUpdated(date('Y-m-d H:i:s')) ;

			$this->save($entity) ;
			return $entity->getId() ;

		} catch (Exception $e) {

			return false ;
		}
	}


	/**
	 * ユーザIDを元にClipを取得
	 * @param integer $userid ユーザID
	 * @param integer $limit リミット
	 * @return array ClipsEntity
	 */
	public function findByUserId($userId, $limit = null) {

		$this->findActive()->where('user_id', $userId) ;
		if ($limit) {
			$this->limit($limit) ;
		}
		$this->order('created desc') ;
		return $this->result()->getAll() ;
	}


	/**
	 * ユーザIDを元にClip（タイプ指定）を取得
	 * @param integer $userid ユーザID
	 * @param integer $type 種別
	 * @param integer $limit リミット
	 * @return array ClipsEntity
	 */
	public function findByUserIdAndType($userId, $type, $limit = null) {

		$this->findActive()->where('user_id', $userId)->where('type', $type) ;
		if ($limit) {
			$this->limit($limit) ;
		}
		$this->order('created desc') ;
		return $this->result()->getAll() ;
	}


	public function findclipsByUserId($userId, $type = null, $limit = null) {


		if ($limit) {
			$limit = 'LIMIT '. $limit ;
		}

		// 取得対象テーブル
		$join = null ;
		if ($type === self::CLIP_TYPE_IMAGES) {
			$query = "
			SELECT 
				clip.*,
				img.id as image_id,
				img.name as image_name,
				img.created as image_created,
				img.updated as image_updated,
				img.deleted as image_deleted
			FROM 
				clips as clip 
			JOIN 
				clip_images as img on clip.id = img.clip_id 
			JOIN 	(
				SELECT 
					clip_id,
					max(created) as created
				FROM 
					clip_images
				WHERE 
					user_id = {$userId}
				GROUP BY 
					clip_id
			) as latest on img.clip_id = latest.clip_id and img.created = latest.created
			WHERE 
				clip.user_id = {$userId}
			AND 
				clip.deleted is null
			AND 
				img.deleted is null 
			GROUP BY 
				img.clip_id
			ORDER BY 
				clip.created DESC, img.created DESC
			{$limit}
			" ;
		} else if ($type === self::CLIP_TYPE_MEMOS) {
		} else {
		}

		$this->executeQuery($query) ;

		return $this->getAll() ;
	}
}

