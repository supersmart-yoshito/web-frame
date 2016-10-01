<?php


class MessagesModel extends BaseModel {

	/**
	 *
	 *
	 *
	 *
	 */

	public function findAll() {
		return parent::find()->where('deleted', '0000-00-00 00:00:00')
					->order('created desc');
	}

	public function findAllInbox() {
		return $this->find()
				->where('is_send', 1)
				->where('to_deleted', '0000-00-00 00:00:00')
				->order('updated desc') ;
	}

	public function findAllOutbox() {
		return $this->find()
				->where('is_send', 1)
				->where('to_deleted', '0000-00-00 00:00:00')
				->order('updated desc') ;
	}

	public function findAllEditbox() {
		return $this->find()
				->where('is_send', 0)
				->where('from_deleted', '0000-00-00 00:00:00')
				->order('updated desc') ;
	}


	public function findAllInboxByAccountId($accountId) {
		return $this->findAllInbox()
				->where('to_account_id', $accountId)
				->result()
				->getAll() ;
	}

	public function findAllInboxByIdAndAccountId($id, $accountId) {
		return $this->findAllInbox()
			->where('id', $id)
			->where('to_account_id', $accountId)
			->result()
			->get(0) ;
	}

	public function findAllOutboxByAccountId($accountId) {
		return $this->findAllOutbox()
				->where('from_account_id', $accountId)
				->result()
				->getAll() ;
	}

	public function findAllOutboxByIdAndAccountId($id, $accountId) {
		return $this->findAllOutbox()
				->where('id', $id)
				->where('from_account_id', $accountId)
				->result()
				->get(0) ;
	}

	public function findAllEditboxByAccountId($accountId) {
		return $this->findAllEditbox()
				->where('from_account_id', $accountId)
				->result()
				->getAll() ;
	}

	public function findAllEditboxByIdAndAccountId($id, $accountId) {
		return $this->findAllEditbox()
			->where('id', $id)
			->where('from_account_id', $accountId)
			->result()
			->get(0) ;
	}

	public function countUnreadInbox($accountId) {
		return $this->count(array(
				'to_account_id' => $accountId,
				'is_send' => 1,
				'is_open' => 0,
				'to_deleted' => '0000-00-00 00:00:00',
			)) ;
	}

	/**
	 * メッセージ送信
	 *
	 *
	 */
	public function sendMessage(
		$from, $to, $subject, $body, $attachment, $isSend, $isOpen, $messageId
	) {

		try {
			$message = new MessagesEntity() ;
			$message->setFromAccountId($from) ;
			$message->setToAccountId($to) ;
			$message->setSubject($subject) ;
			$message->setBody($body) ;
			if ($attachment != null) {
				$file = file_get_contents($attachment) ;
			} else {
				$file = null ;
			}
			$message->setAttachment($file) ;
			$message->setIsSend(1) ;
			$message->setIsOpen(0) ;
			$message->setMessageId(0) ;
			$message->setCreated(date('Y-m-d H:i:s')) ;
			$message->setUpdated(date('Y-m-d H:i:s')) ;
			$message->setDeleted('0000-00-00 00:00:00') ;
			$message->setFromDeleted('0000-00-00 00:00:00') ;
			$message->setToDeleted('0000-00-00 00:00:00') ;
			$entity = $this->save($message) ;
			return $entity->getId() ;
		} catch (Exception $e) {
			echo $e->getMessage() ;
			return false ;
		}
	}
}



