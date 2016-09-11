<?php 
class PhotosEntity {
	public $id ;
	public $account_id ;
	public $title ;
	public $image ;
	public $mime ;
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

	public function setTitle($title) {
		$this->title = $title ;
		return $this ;
	}

	public function setImage($image) {
		$this->image = $image ;
		return $this ;
	}

	public function setMime($mime) {
		$this->mime = $mime ;
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

	public function getTitle() {
		return $this->title ;
	}

	public function getImage() {
		return $this->image ;
	}

	public function getMime() {
		return $this->mime ;
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
