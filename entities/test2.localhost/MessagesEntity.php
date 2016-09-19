<?php 
class MessagesEntity {
	public $id ;
	public $from_account_id ;
	public $to_account_id ;
	public $subject ;
	public $body ;
	public $attachment ;
	public $is_send ;
	public $is_open ;
	public $message_id ;
	public $created ;
	public $updated ;
	public $deleted ;
	public $from_deleted ;
	public $to_deleted ;

	public function setId($id) {
		$this->id = $id ;
		return $this ;
	}

	public function setFromAccountId($from_account_id) {
		$this->from_account_id = $from_account_id ;
		return $this ;
	}

	public function setToAccountId($to_account_id) {
		$this->to_account_id = $to_account_id ;
		return $this ;
	}

	public function setSubject($subject) {
		$this->subject = $subject ;
		return $this ;
	}

	public function setBody($body) {
		$this->body = $body ;
		return $this ;
	}

	public function setAttachment($attachment) {
		$this->attachment = $attachment ;
		return $this ;
	}

	public function setIsSend($is_send) {
		$this->is_send = $is_send ;
		return $this ;
	}

	public function setIsOpen($is_open) {
		$this->is_open = $is_open ;
		return $this ;
	}

	public function setMessageId($message_id) {
		$this->message_id = $message_id ;
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

	public function setFromDeleted($from_deleted) {
		$this->from_deleted = $from_deleted ;
		return $this ;
	}

	public function setToDeleted($to_deleted) {
		$this->to_deleted = $to_deleted ;
		return $this ;
	}


	public function getId() {
		return $this->id ;
	}

	public function getFromAccountId() {
		return $this->from_account_id ;
	}

	public function getToAccountId() {
		return $this->to_account_id ;
	}

	public function getSubject() {
		return $this->subject ;
	}

	public function getBody() {
		return $this->body ;
	}

	public function getAttachment() {
		return $this->attachment ;
	}

	public function getIsSend() {
		return $this->is_send ;
	}

	public function getIsOpen() {
		return $this->is_open ;
	}

	public function getMessageId() {
		return $this->message_id ;
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

	public function getFromDeleted() {
		return $this->from_deleted ;
	}

	public function getToDeleted() {
		return $this->to_deleted ;
	}


} 
