<?php 
class SessionsEntity {
	public $id ;
	public $session_id ;
	public $session_data ;
	public $session_updated ;

	public function setId($id) {
		$this->id = $id ;
		return $this ;
	}

	public function setSessionId($session_id) {
		$this->session_id = $session_id ;
		return $this ;
	}

	public function setSessionData($session_data) {
		$this->session_data = $session_data ;
		return $this ;
	}

	public function setSessionUpdated($session_updated) {
		$this->session_updated = $session_updated ;
		return $this ;
	}


	public function getId() {
		return $this->id ;
	}

	public function getSessionId() {
		return $this->session_id ;
	}

	public function getSessionData() {
		return $this->session_data ;
	}

	public function getSessionUpdated() {
		return $this->session_updated ;
	}


} 
