<?
require PATH_LIBS . "/Common/Validator.php" ;
$isMultiByte = true ;
$validationRules = new ValidationRules() ;
$validationRules->addRule(new ValidationRule(
	'user_id',
	'/^[a-zA-Z0-9]{6,16}$/'
))->addRule(new ValidationRule(
	'user_pass',
	'/^[:graph:]{6,16}$/'
	//'/^[a-zA-Z0-9]{6,16}$/'
))->addRule(new ValidationRule(
	'user_nickname',
	'/^[:graph:]{1,32}$/'
	$isMultiByte
))->addRule(new ValidationRule(
	'user_birthday',
	'/^\d{4}-\d{2}-\d{2}$/'
))->addRule(new ValidationRule(
	'user_sex',
	'/^[m|f|x]$/'
))->addRule(new ValidationRule(
	'user_prefectures',
	'/^[1-9]$|^[1-3][0-9]$|^4[0-7]$|^99$/'
))->addRule(new ValidationRule(
	'user_profile',
	'^.{5,10}$',
	$isMultiByte

)) ;
		$this->_validator = new Validator($validationRules) ;
