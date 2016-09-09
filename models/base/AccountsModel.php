<?php


class AccountsModel extends BaseModel {

	const RELATION_SELF = 0 ;
	const RELATION_GROUP = 1 ;
	const RELATION_FRIEND = 2 ;
	const RELATION_OTHER = 999 ;


	/**
	 *
	 *
	 *
	 *
	 */
	public function create($userId, $userPass, $nickname = null) {

		try {
			$entity = new AccountsEntity() ;
			$entity->setUserId($userId) ;
			$entity->setUserPass($userPass) ;
			$entity->setUserStatus(1) ;
			if ($nickname) {
				$entity->setNickname($nickname) ;
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
	 *
	 */
	public function delete($id) {

		$user = $this->findById($id) ;
		if (empty($user)) {
			return false ;
		}

		$user->setUserStatus(0) ;
		$user->setUpdated(date('Y-m-d H:i:s')) ;
		return $this->save($user) ;
	}


	/**
	 *
	 *
	 *
	 *
	 */
	public function login($id, $pass) {

		$user = $this->findByUserIdAndUserPass($id, $pass) ;
		if (empty($user)) {
			return false ;
		}

		$_SESSION['user'] = $user ;
		return $user ;
	}


	/**
	 *
	 *
	 *
	 *
	 */
	public function logout() {

		if (empty($_SESSION['user'])) {
			return false ;
		}

		$_SESSION['user'] = null ;
		unset($_SESSION['user']) ;
		return true ;
	}


	/**
	 *
	 *
	 *
	 *
	 */
	public function isJoined($userId) {
		$user = $this->findByUserId($userId) ;
		return empty($user) ? false : true ;
	}


	/**
	 *
	 *
	 *
	 *
	 */
	public function isLoggedIn() {

		if (empty($_SESSION['user'])) {
			return false ;
		}
		$sessUser = $_SESSION['user'] ;

		$user = $this->findByUserIdAndUserPass($sessUser->getUserId(), $sessUser->getUserPass()) ;
		if (empty($user) || $user->getUserStatus() == 0) {
			return false ;
		}

		return true ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function getUser() {

		if (empty($_SESSION['user'])) {
			return null;
		}
		$sessUser = $_SESSION['user'] ;

		return $sessUser ;
	}

	/**
	 *
	 *
	 *
	 *
	 */
	public function getRelation($userId1, $userId2) {

		if ($userId1 === $userId2) {
			return self::RELATION_SELF ;
		} else {
			return self::RELATION_OTHER ;
		}
	}


	/**
	 *
	 *
	 *
	 *
	 */
	private function findByUserId($id) {
		$user = $this->find()
				->where('user_id', $id)
				->limit(1)
				->result()
				->get(0) ;
		return $user ;
	}


	/**
	 *
	 *
	 *
	 *
	 */
	private function findByUserIdAndUserPass($id, $pass) {
		$user = $this->find()
				->where('user_id', $id)
				->where('user_pass', $pass)
				->limit(1)
				->result()
				->get(0) ;
		return $user ;
	}
}



