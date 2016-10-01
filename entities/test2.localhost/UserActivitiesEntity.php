<?php 
class UserActivitiesEntity {
	public $id ;
	public $account_id ;
	public $activity_id ;
	public $activity_table ;
	public $created ;
	public $updated ;
	public $deleted ;

	public function setId($id) {
		$this->id = $id ;
		return $this ;
	}

	public function setAccountId($account_id) {
		$this->account_id = $account_id ;
		return $this ;
	}

	public function setActivityId($activity_id) {
		$this->activity_id = $activity_id ;
		return $this ;
	}

	public function setActivityTable($activity_table) {
		$this->activity_table = $activity_table ;
		return $this ;
	}

	public function setCreated($created) {
		$this->created = $created ;
		return $this ;
	}

	public function setUpdated($updated) {
		$this->updated = $updated ;
		return $this ;
	}

	public function setDeleted($deleted) {
		$this->deleted = $deleted ;
		return $this ;
	}


	public function getId() {
		return $this->id ;
	}

	public function getAccountId() {
		return $this->account_id ;
	}

	public function getActivityId() {
		return $this->activity_id ;
	}

	public function getActivityTable() {
		return $this->activity_table ;
	}

	public function getCreated() {
		return $this->created ;
	}

	public function getUpdated() {
		return $this->updated ;
	}

	public function getDeleted() {
		return $this->deleted ;
	}


} 
