<?php
App::uses('MemberController', 'Controller');
class CloseController extends MemberController {
	public $uses = array('Member');
	/**
	 * Form to close account member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index() {
		$this->layout = "";
		// check param
		$param = $this->params->named;
		if (isset($param['flag']) && $param['flag'] == "bbs") {
			$this->set('bbsMenu', 1);
		}
	}
	/**
	 * Process close account member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	function process() {
		$data = $this->request->data;
		// check param for bbs menu
		if (isset($data['flag']) && $data['flag'] == "bbs") {
			$this->set('bbsMenu', 1);
		}
		try {
			if (!isset($data['id']) || $data['id'] == "" || !isset($data['ps']) || $data['ps'] == "") {
				throw new Exception('未入力の項目があります。');
			}
			// check in db
			$fields = array('Member.no', 'Member.id', 'Member.ps', 'Member.flag', 'Member.user_id');
			$conditions = array('Member.delete_flg' => 0, 'Member.id' => $data['id'], 'Member.ps' => sha1($data['ps']));
			$info = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions));
			if (!$info) {
				throw new Exception('入力されたIDが存在しないか、パスワードが間違っています。');
			}
			$this->Member->validate = array();
			$this->Member->read(null, $info[0]['Member']['user_id']);
			$this->Member->set('delete_flg', 1);
			$this->Member->save();
			$this->redirect('/close/complete/flag:bbs');
		} catch (Exception $e) {
			$this->set('returnData', $data);
			$this->set('validationErrorsArray', array(array($e->getMessage())));
			$this->setAction('index');
			$this->render('/Close/index');
		}
	}
	/**
	 * Complete close account member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function complete() {
		// check param for bbs menu
		$param = $this->params->named;
		if (isset($param['flag']) && $param['flag'] == "bbs") {
			$this->set('bbsMenu', 1);
		}
		$this->layout = "";
	}
}