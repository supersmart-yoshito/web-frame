<?php

class BaseModel extends AbstractModel {


	/**
	 * DB接続先情報取得
	 *
	 * @return array dsn/user/pass
	 */
	protected function getDatabase() {
		return array(
			'dsn' => 'mysql:dbname='.DB_NAME.';host='.DB_HOST,
			'user'=> DB_USER,
			'pass'=> DB_PASS,
		) ;
	}

	/**
	 * Primary Key名取得
	 * @return string Primary Key名
	 */
	protected function getPrimaryKeyName() {
		return 'id' ;
	}

	/**
	 * テーブル名取得
	 * @return string テーブル名
	 */
	protected function getTable() {
		return str_replace('_model', '', AppUtil::decamelize((string)$this)) ;
	}

	/**
	 * テーブル検索
	 * @param array $where WHERE句の連想配列 
	 * @return $this
	 */
	public function find($where=array()) {

		$this->reset() ;
		$this->select() ;
		foreach ($where as $key => $value) {
			$this->where($key, $value) ;
		}
		return $this ;
	}

	/**
	 * テーブル検索
	 * @param array $where WHERE句の連想配列 
	 * @return $this
	 */
	public function findActive($where=array()) {

		$this->find($where)->where('deleted', null) ;
		return $this ;
	}

	/**
	 * レコード数
	 * @param array $where WHERE句の連想配列 
	 * @return $this
	 */
	public function count($where=array()) {

		$this->reset() ;
		$this->select('count(1) as count') ;
		foreach ($where as $key => $value) {
			$this->where($key, $value) ;
		}
		$count = $this->result()->get(0) ;
		return intval($count->count) ;
	}

	/**
	 * テーブル検索
	 * @param array $id PrimaryKey
	 * @return $this
	 */
	public function findById($id) {
		return $this->find()
			->where($this->getPrimaryKeyName(), $id)
			->limit(1)
			->result()->get(0) ;
	}

}

