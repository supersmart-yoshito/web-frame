<?php

class AppUtil {


	const MAGIC_NUMBER = 'addfjkl' ;


	/**
	 * キャメライズ
	 * @param string $value キャメルケース対象
	 * @return string キャルメルケース
	 */
	public static function camelize($value) {
		return str_replace(' ','',ucwords(str_replace('_',' ',$value))) ;
	}

	/**
	 * デキャメライズ
	 * @param string $value キャメルケース解除対象
	 * @return string キャルメルケース解除文字列
	 */
	public static function decamelize($value) {
		return ltrim(preg_replace('/([A-Z])/e',"'_'.strtolower('$1')",$value),'_') ;
	}

	/**
	 * トークン生成
	 * @param mixed $data トークン生成用データ
	 * @param integer $time トークン生成時間
	 * @return string キャルメルケース解除文字列
	 */
	public static function generateToken($data, $time) {
		return hash('sha256', md5(serialize($data).self::MAGIC_NUMBER.$time));
	}
}


