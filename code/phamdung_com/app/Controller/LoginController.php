<?php
App::uses('MemberController', 'Controller');
class LoginController extends MemberController {
	public $uses = array('Member');
	public $layout = "";
	/**
	 * Form Login
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index() {
		
	}
	/**
	 * Confirm login
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function confirm() {
		$data = $this->request->data;
		try {
			if (empty($data['id']) || empty($data['ps'])) {
				throw new Exception('未入力の項目があります。');
			}
			// check in db
			$fields = array('Member.no', 'Member.id', 'Member.ps', 'Member.flag', 'Member.user_id', 'Member.delete_flg');
			$conditions = array('Member.id' => $data['id'], 'Member.ps' => sha1($data['ps']));
			$info = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions));
			
			if (!isset($info[0]['Member']['no'])) {
				throw new Exception('入力されたIDが存在しないか、パスワードが間違っています。');
			}
			if ($info[0]['Member']['flag'] == 0 || $info[0]['Member']['delete_flg'] == 1) {
				throw new Exception('このIDは現在利用できません。');
			}
			$id = $data['id'];
			$ps = sha1($data['ps']);
			
			$this->Cookie->write("bbs", "$id:$ps", true);
			
			$this->redirect('/bbs/bbs_normal');
		} catch (Exception $e) {
			$this->set('returnData', $data);
			$this->set('validationErrorsArray', array(array($e->getMessage())));
			$this->render('/Login/index');
		}
	}
}