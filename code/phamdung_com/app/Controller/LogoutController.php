<?php
App::uses('MemberController', 'Controller');
class LogoutController extends MemberController {
	public $uses = array('Member');
	public $layout = "";
	/**
	 * Process logout
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index() {
		// check param
		$param = $this->params->named;
		if (isset($param['flag']) && $param['flag'] == "bbs") {
			$this->set('bbsMenu', 1);
		}
		//check cookie
		$cookie = $this->Cookie->read('bbs');
		
		if (!$cookie) {
			$this->redirect('/login');
		}
		$this->Cookie->delete('bbs');
	}
}