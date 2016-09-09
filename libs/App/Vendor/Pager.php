<?php
require_once("Page.php") ;


class AppVendorPager {

	private $_link ;
	private $_currentPage ;
	private $_prevPage ;
	private $_nextPage ;
	private $_firstPage ;
	private $_lastPage ;
	private $_pages ;


	public function __construct($link, $currentPage, $count, $divider = 30) {

		$this->_link = $link ;
		$this->_currentPage = $currentPage ;

		$this->_firstPage = 1 ;
		$this->_lastPage = ceil($count/$divider) ;

		if ($this->_currentPage + 1 < $this->_lastPage) {
			$this->_nextPage = $this->_currentPage + 1 ;
		} else {
			$this->_nextPage = $this->_lastPage ;
		}

		if ($this->_currentPage - 1 > $this->_fistPage) {
			$this->_prevPage = $this->_currentPage - 1 ;
		} else {
			$this->_prevPage = $this->_firstPage ;
		}

		// 全ページリンク生成
		for ($page = 1; $page <= $this->_lastPage; $page++) {
			$pageObj = new AppVendorPage($this->_link, $page) ;
			if ($page == $this->_currentPage) {
				$pageObj->setCurrentPage(true) ;
			}
			$this->_pages[$page] = $pageObj ;
		}
	}

	public function getPages() {
		return $this->_pages ;
	}

	public function getPage() {
		return $this->_pages[$this->_currentPage] ;
	}

	public function getPrevPage() {
		return $this->_pages[$this->_prevPage] ;
	}

	public function getNextPage() {
		return $this->_pages[$this->_nextPage] ;
	}

	public function getFirstPage() {
		return $this->_pages[$this->_firstPage] ;
	}

	public function getLastPage() {
		return $this->_pages[$this->_lastPage] ;
	}

}
