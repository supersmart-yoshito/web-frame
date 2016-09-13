<?php


class FriendsModel extends BaseModel {


	/**
	 * 友人設定登録
	 * @param integer $myAccountId 自分のアカウントID
	 * @param integer $friendAccountId 友人のアカウントID
	 * @return boolean true/false
	 */
	public function add($myAccountId, $friendAccountId) {

		// 既に登録済みの場合はスキップ
		$friend = $this->find()
				->where('user_id', $myAccountId)
				->where('friend_id', $friendAccountId)
				->result()
				->get(0) ;
		if (!empty($friend)) {
			$friend->setDeleted('0000-00-00 00:00:00') ;
		} else {
			$friend = new FriendsEntity() ;
			$friend->setUserId($myAccountId) ;
			$friend->setFriendId($friendAccountId) ;
			$friend->setCreated(date('Y-m-d H:i:s')) ;
			$friend->setUpdated(date('Y-m-d H:i:s')) ;
		}
		return $this->save($friend) ;
	}

	/**
	 * 友人設定削除
	 * @param integer $friendId 友人設定テーブルID
	 * @return boolean true/false
	 */
	public function delete($friendId) {

		$user = $this->findById($friendId) ;
		if (empty($user)) {
			return false ;
		}

		$user->setUpdated(date('Y-m-d H:i:s')) ;
		$user->setDeleted(date('Y-m-d H:i:s')) ;
		return $this->save($user) ;
	}
}



