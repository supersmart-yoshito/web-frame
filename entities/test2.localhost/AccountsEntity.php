<?php 
class AccountsEntity {
	public $id ;
	public $user_id ;
	public $user_pass ;
	public $user_status ;
	public $nickname ;
	public $prefectures ;
	public $birthday ;
	public $sex ;
	public $job ;
	public $profile ;
	public $publish ;
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

	public function setUserPass($user_pass) {
		$this->user_pass = $user_pass ;
		return $this ;
	}

	public function setUserStatus($user_status) {
		$this->user_status = $user_status ;
		return $this ;
	}

	public function setNickname($nickname) {
		$this->nickname = $nickname ;
		return $this ;
	}

	public function setPrefectures($prefectures) {
		$this->prefectures = $prefectures ;
		return $this ;
	}

	public function setBirthday($birthday) {
		$this->birthday = $birthday ;
		return $this ;
	}

	public function setSex($sex) {
		$this->sex = $sex ;
		return $this ;
	}

	public function setJob($job) {
		$this->job = $job ;
		return $this ;
	}

	public function setProfile($profile) {
		$this->profile = $profile ;
		return $this ;
	}

	public function setPublish($publish) {
		$this->publish = $publish ;
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

	public function getUserPass() {
		return $this->user_pass ;
	}

	public function getUserStatus() {
		return $this->user_status ;
	}

	public function getNickname() {
		return $this->nickname ;
	}

	public function getPrefectures() {
		return $this->prefectures ;
	}

	public function getBirthday() {
		return $this->birthday ;
	}

	public function getSex() {
		return $this->sex ;
	}

	public function getJob() {
		return $this->job ;
	}

	public function getProfile() {
		return $this->profile ;
	}

	public function getPublish() {
		return $this->publish ;
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
