<?php


class AppVendorPage {

	private $_flag ;
	private $_link ;
	private $_page ;


	public function __construct($link, $page) {

		$this->_flag = false ;
		$this->_link = $link ;
		$this->_page = $page ;
	}

	public function setCurrentPage($flag) {
		$this->_flag = $flag ;
	}

	public function isCurrentPage() {
		return $this->_flag ;
	}

	public function getPage() {
		return $this->_page ;
	}

	public function getLink() {
		return $this->_link . '?p=' . $this->_page;
	}
}

