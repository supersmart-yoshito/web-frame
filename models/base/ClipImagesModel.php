<?php


class ClipImagesModel extends BaseModel {



	/**
	 * 
	 *
	 *
	 */
	public function addImage($clipId, $userId, $name, $imagepath) {

		try {
			$image = file_get_contents($imagepath) ;

			$entity = new ClipImagesEntity() ;
			$entity->setClipId($clipId) ;
			$entity->setUserId($userId) ;
			$entity->setName($name) ;
			$entity->setImage($image) ;
			$entity->setCreated(date('Y-m-d H:i:s')) ;
			$entity->setUpdated(date('Y-m-d H:i:s')) ;
			$entity = $this->save($entity) ;

			return $entity->getId() ;
		} catch (Exception $e) {

			return false ;
		}
	}

	/**
	 * クリップIDを元にクリップを取得
	 * @param integer $clipid クリップID
	 * @return array ClipImagessEntity
	 */
	public function findByClipId($clipId) {

		return $this->findActive()
				->where('clip_id', $clipId)
				->result()
				->getAll() ;
	}


	/**
	 * クリップIDを元にクリップを取得
	 * @param integer $clipid クリップID
	 * @return array ClipImagessEntity
	 */
	public function findLatestByClipId($clipId) {

		return $this->findActive()
				->where('clip_id', $clipId)
				->order('id desc')
				->result()
				->get(0) ;
	}


	/**
	 * ユーザIDを元にクリップを取得
	 * @param integer $userid ユーザID
	 * @return array ClipsEntity
	 */
	public function findByUserId($userId) {

		return $this->findActive()
				->where('user_id', $userId)
				->result()
				->getAll() ;
	}


	/**
	 * 直近追加のクリップを取得
	 * @param integer $userid ユーザID
	 * @return array ClipsEntity
	 */
	public function findLatestClips($categoryId = null) {

		$this->findActive() ;
		$this->select('*, max(id) as id') ;
		if ($categoryId) {
			$this->where('category_id', $categoryId) ;
		}
		return $this->group('clip_id')
				->order('created desc')
				->limit(8)
				->result()
				->getAll() ;
	}
}

