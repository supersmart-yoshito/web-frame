<?php 
class EventsEntity {
	public $id ;
	public $user_id ;
	public $name ;
	public $place ;
	public $begin ;
	public $end ;
	public $limit ;
	public $publish ;
	public $description ;
	public $notice ;
	public $created ;
	public $updated ;
	public $deleted ;

	public function setId($id) {
		$this->id = $id ;
		return $this ;
	}

	public function setUserId($user_id) {
		$this->user_id = $user_id ;
		return $this ;
	}

	public function setName($name) {
		$this->name = $name ;
		return $this ;
	}

	public function setPlace($place) {
		$this->place = $place ;
		return $this ;
	}

	public function setBegin($begin) {
		$this->begin = $begin ;
		return $this ;
	}

	public function setEnd($end) {
		$this->end = $end ;
		return $this ;
	}

	public function setLimit($limit) {
		$this->limit = $limit ;
		return $this ;
	}

	public function setPublish($publish) {
		$this->publish = $publish ;
		return $this ;
	}

	public function setDescription($description) {
		$this->description = $description ;
		return $this ;
	}

	public function setNotice($notice) {
		$this->notice = $notice ;
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

	public function getUserId() {
		return $this->user_id ;
	}

	public function getName() {
		return $this->name ;
	}

	public function getPlace() {
		return $this->place ;
	}

	public function getBegin() {
		return $this->begin ;
	}

	public function getEnd() {
		return $this->end ;
	}

	public function getLimit() {
		return $this->limit ;
	}

	public function getPublish() {
		return $this->publish ;
	}

	public function getDescription() {
		return $this->description ;
	}

	public function getNotice() {
		return $this->notice ;
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
