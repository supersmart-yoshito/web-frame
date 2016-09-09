<?php


class SessionsModel extends BaseModel implements SessionHandlerInterface {

	/**
	 * Primary Key名取得
	 * @return string Primary Key名
	 */
	protected function getPrimaryKeyName() {
		return 'id' ;
	}


	/**
	 * セッションインタフェース定義
	 */
	public function open($savePath, $name) {
		return true ;
	}
	public function close() {
		return true ;
	}
	public function read($sessionId) {
		$entity = $this->find()
			->where('session_id', $sessionId)
			->result()
			->get(0) ;
		if (empty($entity)) {
			return null ;
		}

		return $entity->getSessionData() ;
	}
	public function write($sessionId, $sessionData) {

		$entity = $this->find()->where('session_id', $sessionId)->result()->get(0) ;
		if (empty($entity)) {
			$entity = new SessionsEntity() ;
		}

		$entity->setSessionId($sessionId) ;
		$entity->setSessionData($sessionData) ;
		$entity->setSessionUpdated(time()) ;
		$this->save($entity) ;
		return true ;
	}
	public function destroy($sessionId) {
		$this->delete()
			->where('session_id', $sessionId)
			->execute() ;
		return true ;
	}
	public function gc($maxlifetime) {
		$this->delete()
			->where('session_updated', ">= {$sessionId}")
			->execute() ;
		return true ;
	}
}



