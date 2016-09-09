<?php

abstract class AbstractModel {


	private $_primaryKeyName ;
	private $_table ;

	private $_select ;
	private $_where ;
	private $_join ;
	private $_order ;
	private $_group ;
	private $_limit ;


	private $_logger ;

	/**
	 * DB接続先情報取得
	 *
	 * @return array dsn/user/pass
	 */
	abstract protected function getDatabase() ;

	/**
	 * Primary Key名取得
	 * @return string Primary Key名
	 */
	abstract protected function getPrimaryKeyName() ;

	/**
	 * テーブル名取得
	 * @return string テーブル名
	 */
	abstract protected function getTable() ;

	/**
	 * コンストラクタ
	 */
	public function __construct($entity = null) {

		$this->_table = $this->getTable() ;
		$this->_primaryKeyName = $this->getPrimaryKeyName() ;

		$db = $this->getDatabase() ;
		$this->_pdo = new PDO($db['dsn'], $db['user'], $db['pass']) ;
	}

	/**
	 *
	 */
	public function __call($func, $args) {

		try {
		} catch (Exception $e) {
		}
	}

	protected function reset() {
		$this->_select = null ;
		$this->_where = null ;
		$this->_order = null ;
		$this->_group = null ;
		$this->_limit = null ;
	}

	public function select($columns=null) {

		$this->reset() ;
		if (empty($columns)) {
			$this->_select = "select * from {$this->_table}" ;
		} else if (is_string($columns)){
			$this->_select = "select {$columns} from {$this->_table}" ;
		} else if (is_array($columns)){
			$this->_select = "select ".implode(',',$columns)." from {$this->_table}" ;
		}

		return $this ;
	}

	public function where($where, $whereValue) {
		$this->_where[$where] = $whereValue ;

		return $this ;
	}

	public function order($orders = null) {

		if (empty($orders)) {
			return $this ;
		}

		if (is_array($orders)) {
			foreach ($orders as $key => $order) {
				$orderSet[] = "{$key} {$order}" ;
			}
			$this->_order = "order by " . implode(',', $orderSet) ;
		} else if (is_string($orders)) {
			$this->_order = "order by {$orders}" ;
		}
		return $this ;
	}

	public function group($groups) {

		if (empty($groups)) {
			return $this ;
		}

		if (is_array($groups)) {
			$this->_group = "group by " . implode(',', $groups) ;
		} else if (is_string($groups)) {
			$this->_group = "group by {$groups}" ;
		}
		return $this ;
	}

	public function limit($limit) {

		$this->_limit = "limit {$limit}" ;
		return $this ;
	}

	public function join($join) {

		$this->_join[] = 'JOIN '.$join ;
		return $this ;
	}

	public function leftjoin($join) {

		$this->_join[] = 'LEFT JOIN '.$join ;
		return $this ;
	}

	public function result($index = null) {

		try {

			$whereSet = null ;
			if ($this->_where) {

				foreach ($this->_where as $key => $value) {
					if (is_null($value)) {
						$whereSet[] = "{$key} IS NULL" ;
					} else if ($value === 'IS NOT NULL') {
						$this->_where[$key] = null ;
						$whereSet[] = "{$key} IS NOT NULL" ;
					} else if (substr(ltrim($value),0,2) === '<=') {
						$this->_where[$key] = trim(str_replace('<=', '', $value)) ;
						$whereSet[] = "{$key} <= :{$key}" ;
					} else if (substr(ltrim($value),0,2) === '>=') {
						$this->_where[$key] = trim(str_replace('>=', '', $value)) ;
						$whereSet[] = "{$key} >= :{$key}" ;
					} else if (substr(ltrim($value),0,1) === '<') {
						$this->_where[$key] = trim(str_replace('<', '', $value)) ;
						$whereSet[] = "{$key} <= :{$key}" ;
					} else if (substr(ltrim($value),0,1) === '>') {
						$this->_where[$key] = trim(str_replace('>', '', $value)) ;
						$whereSet[] = "{$key} >= :{$key}" ;
					} else if (substr(ltrim($value),0,2) === '!=') {
						$this->_where[$key] = trim(str_replace('!=', '', $value)) ;
						$whereSet[] = "{$key} != :{$key}" ;

					} else if (substr(ltrim($value),0,4) === 'LIKE') {
						$this->_where[$key] = trim(str_replace('LIKE', '', $value)) ;
						$whereSet[] = "{$key} LIKE :{$key}" ;
					} else {
						$whereSet[] = "{$key} = :{$key}" ;
					}
				}
			}

			$query = implode(' ', array(
				$this->_select,
				is_null($whereSet) ? null : 'where '.implode(' and ', $whereSet),
				$this->_group,
				$this->_order,
				$this->_limit
			)) ;

			$context = $this->_pdo->prepare($query) ;
			if ($context === false) {
				return $this ;
			}

			if ($this->_where) {

				foreach ($this->_where as $key => $value) {
					if (!is_null($value)) {
						$context->bindValue(':'.$key, $value) ;
					}
				}
			}

			$context->setFetchMode(
				PDO::FETCH_CLASS,
				AppUtil::camelize($this->getTable().'_entity')
			) ;

			$context->execute() ;
			$this->_result = $context->fetchAll() ;

		} catch (Exception $e) {

			//$this->setMessage($e->getMessage()) ;
		}

		return $this ;
	}

	public function getAll() {
		return $this->_result ;
	}

	public function get($index = 0) {
		return $this->_result[$index] ;
	}


	public function save($entity) {

		try {

			// update 
			if ($entity->getId()) {

				$entity = $this->update($entity) ;

			// insert
			} else {

				$entity = $this->insert($entity) ;
			}

			return $entity ;

		} catch (Exception $e) {

			return false ;
		}
	}

	private function update($entity) {

		// 全カラム取得
		$vars = get_object_vars($entity) ;

		$sets = null ;
		foreach ($vars as $key => $value) {
			$sets[] = "{$key} = :{$key}" ;
		}

		$query  = "update {$this->_table} set " ;
		$query .= implode(',', $sets).' ' ;
		$query .= "where {$this->_primaryKeyName} = :{$this->_primaryKeyName}" ;

		$context = $this->_pdo->prepare($query) ;
		foreach ($vars as $key => $value) {
			if (is_null($value)) {
				$context->bindValue(':'.$key, null, PDO::PARAM_NULL) ;
			} else {
				$context->bindValue(':'.$key, $value) ;
			}
		}
		$context->bindValue(':'.$this->_primaryKeyName, $vars[$this->_primaryKeyName]) ;
		$context->execute() ;

		return $entity ;
	}

	private function insert($entity) {

		// 全カラム取得
		$vars = get_object_vars($entity) ;

		unset($vars[$this->_primaryKeyName]) ;
		$keys = '(' . implode(',', array_keys($vars)) . ')' ;
		$values = '(:' . implode(', :', array_keys($vars)) . ')' ;

		$query  = "insert into {$this->_table} {$keys} values {$values} " ;
		$context = $this->_pdo->prepare($query) ;

		foreach ($vars as $key => $value) {
			if (is_null($value)) {
				$context->bindValue(':'.$key, null, PDO::PARAM_NULL) ;
			} else {
				$context->bindValue(':'.$key, $value) ;
			}
		}
		$result = $context->execute() ;

		$entity->setId($this->_pdo->lastInsertId()) ;
		return $entity ;
	}

	public function delete() {
		$this->_delete = 'delete from '.$this->_table ;
	}

	public function execute() {

		try {

			$whereSet = null ;
			if ($this->_where) {

				foreach ($this->_where as $key => $value) {
					if (is_null($value)) {
						$whereSet[] = "{$key} IS NULL" ;
					} else if ($value === 'IS NOT NULL') {
						$this->_where[$key] = null ;
						$whereSet[] = "{$key} IS NOT NULL" ;
					} else if (substr(ltrim($value),0,2) === '<=') {
						$this->_where[$key] = trim(str_replace('<=', '', $value)) ;
						$whereSet[] = "{$key} <= :{$key}" ;
					} else if (substr(ltrim($value),0,2) === '>=') {
						$this->_where[$key] = trim(str_replace('>=', '', $value)) ;
						$whereSet[] = "{$key} >= :{$key}" ;
					} else if (substr(ltrim($value),0,1) === '<') {
						$this->_where[$key] = trim(str_replace('<', '', $value)) ;
						$whereSet[] = "{$key} <= :{$key}" ;
					} else if (substr(ltrim($value),0,1) === '>') {
						$this->_where[$key] = trim(str_replace('>', '', $value)) ;
						$whereSet[] = "{$key} >= :{$key}" ;
					} else if (substr(ltrim($value),0,2) === '!=') {
						$this->_where[$key] = trim(str_replace('!=', '', $value)) ;
					} else if (substr(ltrim($value),0,2) === '!=') {
						$this->_where[$key] = trim(str_replace('!=', '', $value)) ;
						$whereSet[] = "{$key} != :{$key}" ;
					} else {
						$whereSet[] = "{$key} = :{$key}" ;
					}
				}
			}

			$query = implode(' ', array(
				$this->_delete,
				is_null($whereSet) ? null : 'where '.implode(' and ', $whereSet),
			)) ;

			$context = $this->_pdo->prepare($query) ;
			if ($context === false) {
				return $this ;
			}

			if ($this->_where) {

				foreach ($this->_where as $key => $value) {
					if (!is_null($value)) {
						$context->bindValue(':'.$key, $value) ;
					}
				}
			}

			$context->execute() ;

		} catch (Exception $e) {

			//$this->setMessage($e->getMessage()) ;
		}

		return $this ;
	}

	protected function executeQuery($query, $params = array()) {

		$context = $this->_pdo->prepare($query) ;

		foreach ($params as $key => $value) {
			$context->bindValue(':'.$key, $value) ;
		}

		$context->setFetchMode(
			PDO::FETCH_CLASS,
			AppUtil::camelize($this->getTable().'_entity')
		) ;

		$context->execute() ;
		$this->_result = $context->fetchAll() ;
	}

	public function __toString() {
		return get_class($this) ;
	}

	public function setLogger($logger) {
		$this->_logger = $logger ;
	}
}

