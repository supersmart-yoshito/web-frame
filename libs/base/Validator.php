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
		$this->_multibyte = $multibyte ;
	}

	public function getKey() {
		return $this->_key ;
	}

	public function isEnable() {
		if ($this->_key) {
			return $this->_enable ;
		} else {
			return true ;
		}
	}

	public function isValid($value) {
		if ($this->_key) {
			if ($this->_multibyte) {
				return !!mb_ereg($this->_pattern, $value) ;
			} else {
				return !!preg_match($this->_pattern, $value) ;
			}
		} else {
			return true ;
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
		$this->_rules[$rule->getKey()] = $rule ;
		return $this ;
	}

	public function removeRule($key) {
		unset($this->_rules[$key]) ;
		return $this ;
	}

	public function getRule($key) {
		if ($this->_rules[$key]) {
			return $this->_rules[$key] ;
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

	private $_event ;
	private $_validationRules ;

	public function __construct(AppKernelEvent $event, ValidationRules $validationRules) {
		$this->_event = $event ;
		$this->_validationRules = $validationRules ;
	}

	public function isValid($key, $value) {
		$result = false ;

		$rule = $this->_validationRules->getRule($key) ;
		// ルールが無効な場合は無条件有効判定
		if ($rule->isEnable() == false) {
			$result = true ;
		// ルールがある場合
		} else {
			$result = $rule->isValid($value) ;
		}

		return $result ;
	}

	public function isValidParams($params) {

		$result = false ;
		foreach ($params as $key => $value) {

			$result = $this->isValid($key, $value) ;
			if ($result == false) {
				break ;
			}
		}

		return $result ;
	}
}
