<?php 
class BlogCommentsEntity {
	public $id ;
	public $article_id ;
	public $user_id ;
	public $name ;
	public $body ;
	public $resp ;
	public $created ;
	public $updated ;
	public $deleted ;

	public function setId($id) {
		$this->id = $id ;
		return $this ;
	}

	public function setArticleId($article_id) {
		$this->article_id = $article_id ;
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

	public function setBody($body) {
		$this->body = $body ;
		return $this ;
	}

	public function setResp($resp) {
		$this->resp = $resp ;
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

	public function getArticleId() {
		return $this->article_id ;
	}

	public function getUserId() {
		return $this->user_id ;
	}

	public function getName() {
		return $this->name ;
	}

	public function getBody() {
		return $this->body ;
	}

	public function getResp() {
		return $this->resp ;
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
