<?php
if (!file_exists(dirname(__FILE__).'/../configs/'.$argv[1].'/config.php')) {
	echo "Error...\n" ;
	exit ;
}
$domain = $argv[1] ;

include (dirname(__FILE__).'/../configs/'.$domain.'/config.php') ;

$schema = DB_NAME ;

$dsn = "mysql:dbname=information_schema;host=".DB_HOST ;
$pdo = new PDO($dsn, DB_USER, DB_PASS) ;

// テーブル走査
$context = $pdo->prepare("select TABLE_NAME from TABLES where TABLE_SCHEMA = '{$schema}'") ;
$result = $context->execute() ;

foreach ($context->fetchAll() as $table) {

	// プライマリキー取得
	$context = $pdo->prepare("
		select COLUMN_NAME from COLUMNS 
		where TABLE_SCHEMA = '{$schema}'
			and TABLE_NAME = '{$table[0]}' and COLUMN_KEY = 'PRI'
	") ;
	$result = $context->execute() ;
	$primaryKey = $context->fetch() ;


	// テーブル全カラム取得
	$context = $pdo->prepare("
		select COLUMN_NAME from COLUMNS 
		where TABLE_SCHEMA = '{$schema}' and TABLE_NAME = '{$table[0]}'
	") ;
	$result = $context->execute() ;

	$columns = null ;
	foreach($context->fetchAll() as $column) {
		$columns[] = $column[0] ;
	}

	$fp = fopen(dirname(__FILE__).'/../entities/'.$domain.'/'.camelize($table[0]).'Entity.php', 'w') ;
	fputs($fp, "<?php \n") ;
	fputs($fp, "class ".camelize($table[0])."Entity {\n") ;
	generateProperty($fp, $columns) ;
	generateSetter($fp, $columns) ;
	generateGetter($fp, $columns) ;
	fputs($fp, "} \n") ;
	fclose($fp) ;
}

function generateProperty($fp, $columns) {

	foreach ($columns as $column) {
		fputs($fp, '	public $' . $column . " ;\n") ;
	}
	fputs($fp, "\n") ;

}

function generateSetter($fp, $columns) {

	foreach ($columns as $column) {
		fputs($fp, '	public function set'.camelize($column).'($'.$column.") {\n") ;
		fputs($fp, '		$this->'.$column.' = $'.$column." ;\n") ;
		fputs($fp, '		return $this'." ;\n") ;
		fputs($fp, '	}'."\n")  ;
		fputs($fp, "\n") ;
	}
	fputs($fp, "\n") ;

}

function generateGetter($fp, $columns) {

	foreach ($columns as $column) {
		fputs($fp, '	public function get'.camelize($column)."() {\n") ;
		fputs($fp, '		return $this->'.$column." ;\n") ;
		fputs($fp, '	}'."\n")  ;
		fputs($fp, "\n") ;
	}
	fputs($fp, "\n") ;

}

function camelize($value) {
	return str_replace(' ','',ucwords(str_replace('_',' ',$value))) ;
}

function decamelize($value) {
	return ltrim(preg_replace('/([A-Z])/e',"'_'.strtolower('$1')",$value),'_') ;
}
