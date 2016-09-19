<?php


class MemosModel extends BaseModel {

	public function findAllInbox() {
		return $this->find()->where('is_send', 1)
					->where('to_deleted', '0000-00-00 00:00:00') ;
	}

	public function findAllInboxByToAccountId($accountId) {
		return $this->find()->where('to_account_id', $accountId) ;
	}

}

