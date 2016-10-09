<?

class ValidationRule {

	private $_key ;
	private $_enable ;
	private $_pattern ;
	private $_multibyte ;

	public function __construct($key, $pattern, $multibyte = false) {
		$this->_key = $key ;
		$this->_enable = true ;
		$this->_pattern = $pattern ;
		$this->_multibyte = $mb ;
	}

	public function getKey() {
		$this->_key ;
	}

	public function isEnable() {
		return $this->_enable ;
	}

	public function isValid($value) {
		if ($multibyte) {
			return !!mb_ereg($this->_pattern, $value) ;
		} else {
			return !!preg_match($this->_pattern, $value) ;
		}
	}
}


class ValidationRules {

	private $_rules ;
	private $_default ;

	public function __construct() {
		$this->_rules = null ; 
		$this->_default = new ValidationRule(null, $this) ;
	}

	public function addRule(ValidationRule $rule) {
		$this->_rule[$rule->getKey()] = $rule ;
		return $this ;
	}

	public function removeRule($key) {
		unset($this->_rule[$key]) ;
		return $this ;
	}

	public function getRule($key) {
		if ($this->_rule[$key]) {
			return $this->_rule[$key] ;
		} else {
			return $this->_default ;
		}
	}

	public function __call($name, $arguments) {
		switch ($name) {
		case 'isEnable' :
		case 'isValid' :
			return true ;
		default :
			return null ;
		}
	}

}

class Validator {

	private $_validationRules ;

	public function __construct(ValidationRules $validationRules) {
		$this->_validationRules = $validationRules ;
	}

	public function isValid($key = null, $value = null) {
		$result = false ;

		$rule = $this->_validationRules->getRule($key) ;
		// ルールが無効な場合は無条件有効判定
		if ($rule->isEnable() == false) {
			$result = true ;
		// ルールがある場合
		} else {
			$result = $this->isValid($value) ;
		}

		return $result ;
	}

	static public function camelize(&$item, $key) {
		$item = ucfirst($item) ;
	}
}
