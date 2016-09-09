<?php


class InquiryController extends AbstractController {


	/**
	 * TOPページ
	 * @return string template path
	 */
	public function indexAction() {

		if ($this->event->isPost()) {
			$this->assign('params', $this->event->getParams()) ;
		}

		return $this->render('inquiry/index.tpl', array(
			'user' => $this->mapper['Accounts']->getUser()
		)) ;
	}

	/**
	 * 確認ページ
	 * @return string template path
	 */
	public function confirmAction() {

		$this->assign('params', $this->event->getParams()) ;
		return $this->render('inquiry/confirm.tpl') ;
	}

	/**
	 * 完了ページ
	 * @return string template path
	 */
	public function doneAction() {


		if ($this->event->isPost() === false) {
			return $this->redirect('/inquiry') ;
		}


		return $this->render('inquiry/done.tpl') ;
	}
}


