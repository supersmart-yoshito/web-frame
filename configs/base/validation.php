<?
require PATH_LIBS . "/base/Validator.php" ;
$isMultiByte = true ;
$validationRules = new ValidationRules() ;
$validationRules->addRule(new ValidationRule(
	'user_id',
	'/^[a-zA-Z0-9]{4,16}$/',
	false
))->addRule(new ValidationRule(
	'user_pass',
	'/^[a-zA-Z0-9]{6,16}$/',
	false
))->addRule(new ValidationRule(
	'user_nickname',
	'^.{1,32}$',
	$isMultiByte
))->addRule(new ValidationRule(
	'user_profile',
	'^.{0,1023}$',
	$isMultiByte
))->addRule(new ValidationRule(
	'birthday',
	'/^\d{4}-\d{2}-\d{2}$/',
	false
))->addRule(new ValidationRule(
	'sex',
	'/^[m|f|x]$/',
	false
))->addRule(new ValidationRule(
	'prefectures',
	'/^[1-9]$|^[1-3][0-9]$|^4[0-7]$|^99$/',
	false
))->addRule(new ValidationRule(
	'job',
	'/^[1-9]$/',
	false
)) ;
