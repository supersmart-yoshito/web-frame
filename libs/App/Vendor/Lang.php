<?php


class AppVendorLang {

	private $_event ;

	public function __construct($event) {
		$this->_event = $event ;
	}

	public function convert($word) {

		switch (true) {
		case $this->_event->isEnglish() :
			break ;
		case $this->_event->isChinese() :
			break ;
		case $this->_event->isJapanese() :
		default :
			break ;
		}

		return $word ;
	}
}

