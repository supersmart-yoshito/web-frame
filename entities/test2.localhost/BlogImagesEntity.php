<?php 
class BlogImagesEntity {
	public $id ;
	public $blog_id ;
	public $article_id ;
	public $user_id ;
	public $name ;
	public $created ;
	public $updated ;
	public $deleted ;

	public function setId($id) {
		$this->id = $id ;
		return $this ;
	}

	public function setBlogId($blog_id) {
		$this->blog_id = $blog_id ;
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

	public function getBlogId() {
		return $this->blog_id ;
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
