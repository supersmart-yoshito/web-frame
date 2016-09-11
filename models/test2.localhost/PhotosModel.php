<?php


class PhotosModel extends BaseModel {

	/**
	 * 
	 *
	 *
	 */
	public function addImage($accountId, $title, $imagepath, $mime) {

		try {
			$image = file_get_contents($imagepath) ;

			$entity = new PhotosEntity() ;
			$entity->setAccountId($accountId) ;
			$entity->setTitle($title) ;
			$entity->setImage($image) ;
			$entity->setMime($mime) ;
			$entity->setCreated(date('Y-m-d H:i:s')) ;
			$entity->setUpdated(date('Y-m-d H:i:s')) ;
			$entity = $this->save($entity) ;

			return $entity->getId() ;
		} catch (Exception $e) {

			return false ;
		}
	}

	/**
	 * 
	 * @param integer $accountId
	 * @return array 
	 */
	public function findByAccountId($accountId, $limit = 10) {

		return $this->findActive()
				->where('account_id', $accountId)
				->order('created desc')
				->result()
				->getAll() ;
	}


	/**
	 * 
	 * @param integer $
	 * @return array 
	 */
	public function findAll() {
		return $this->findActive()->order('created desc')->result()->getAll() ;
	}
}

