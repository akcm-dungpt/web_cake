<?php
App::uses('MemberController', 'Controller');
class TopController extends MemberController {
	/**
	 * Top Chihou
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index() {
		$this->set('actionName', 'top_index');
		$this->set('title_for_layout', '認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ)');
	}
}