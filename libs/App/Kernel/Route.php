<?php


class AppKernelRoute {

	public $controller ;
	public $params ;


	public function __construct($event, $routing) {

		$requestUri = $this->separateUri($this->separateQuery($event->getRequestUri())) ;

		$this->controller = null ;
		$this->action = null ;
		$this->params = null ;
		foreach ($routing  as $uri => $handler) {

			$routeUri = $this->separateUri($uri) ;

			$isUnmatch = false ;
			$paramArray = array() ;
			foreach ($routeUri as $index => $value) {

				// URLパラメータ
				$param = substr($value,0,1) ;
				if ($param === ':') {

					if (empty($requestUri[$index])) {
						$paramArray[substr($value,1)] = null ;
					} else {
						$paramArray[substr($value,1)] = $requestUri[$index] ;
					}

				// URLハンドラ
				} else if ($requestUri[$index] !== $value) {
					$isUnmatch = true ;
					break ;
				}
			}

			if ($isUnmatch === false) {
				$controller = ucfirst($handler['controller']).'Controller' ;
				$action = $handler['action'] ;
				$params = $paramArray ;
			} else {
			}
		}

		$this->action = $action.'Action' ;
		$this->params = $params ; 
		$this->controller = new $controller($event, $action) ;
	}


	/**
	 *
	 *
	 */
	private function separateUri($uri) {
		return explode('/', $uri) ;
	}

	/**
	 *
	 *
	 */
	private function separateQuery($uri) {
		if (explode('?', $uri)) {
			$u = explode('?', $uri) ;
			return $u[0] ;
		} else {
			return $uri ;
		}
	}

}

