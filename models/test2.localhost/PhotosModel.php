<?php


class PhotosModel extends BaseModel {

	/**
	 * 
	 *
	 *
	 */
	public function addImage($accountId, $name, $imagepath) {

		try {
			$image = file_get_contents($imagepath) ;

			$entity = new PhotosEntity() ;
			$entity->setAccountId($accountId) ;
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
	 * 
	 * @param integer $accountId
	 * @return array 
	 */
	public function findByAccountId($accountIds, $limit = 10) {

		return $this->findActive()
				->where('account_id in ('.implode(',', $accountIds).')')
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

