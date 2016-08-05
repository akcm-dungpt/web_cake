<?php
App::uses('MemberController', 'Controller');
class RemainController extends MemberController {
	public $uses = array('Member');
	public $components = array('Email');
	/**
	 * Form to remain password
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index($data = NULL) {
		$this->layout = "";
		if (isset($data)) {
			$this->set('birthyear', $this->_createJYearSelect($data['birthyear']));
			$this->set('month', $this->_createMonthSelect($data['month']));
			$this->set('date', $this->_createDateSelect($data['date']));
		} else {
			$this->set('birthyear', $this->_createJYearSelect());
			$this->set('month', $this->_createMonthSelect());
			$this->set('date', $this->_createDateSelect());
		}
	}
	/**
	 * Process to remain password
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function process() {
		try {
			$data = $this->request->data;
			if (!isset($data['id']) || $data['id'] == "") {
				throw new Exception('未入力の項目があります。');
			}
			// check in db
			$fields = array(
					'Member.no', 'Member.id', 'Member.ps', 'Member.flag', 'Member.user_id', 
					'Member.birthyear', 'Member.month', 'Member.date', 'Member.delete_flg'
			);
			$conditions = array('Member.id' => $data['id']);
			$info = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions));
			if (!$info) {
				throw new Exception('入力されたメールアドレスは登録されていません。');
			}
			// check flag account
			if ($info[0]['Member']['flag'] == 0 || $info[0]['Member']['delete_flg'] == 1) {
				throw new Exception('アクセスできません');
			}
			// check validate birthday
			if ($info[0]['Member']['birthyear'] != "" && $info[0]['Member']['month'] != "" && $info[0]['Member']['date'] != "") {
				if (
					(!isset($data['birthyear']) || $data['birthyear'] == "") ||
					(!isset($data['month']) || $data['month'] == "") ||
					(!isset($data['date']) || $data['date'] == "")
				) {
					throw new Exception('生年月日を入力して下さい。');
				}
				if ($info[0]['Member']['birthyear'] != $data['birthyear'] ||
					$info[0]['Member']['month'] != $data['month'] ||
					$info[0]['Member']['date'] != $data['date']
				) {
					throw new Exception('入力されたメールアドレスは登録されていません。');
				}
			}
			// create new password
			$alpha = "abcdefghijklmnopqrstuvwxyz0123456789";
			$count = rand(6, 12);
			$newPass = "";
			for($i = 0; $i < $count; $i++) {
				$newPass .= $alpha[rand(0, strlen($alpha - 1))];
			}
			$this->Member->validate = array();
			$this->Member->read(null, $info[0]['Member']['user_id']);
			$this->Member->set('ps', sha1($newPass));
			$this->Member->save();
			// send mail
			$content = "ご利用頂き、ありがとうございます。
あなたのパスワードは下記の通りです。

パスワード：" .$newPass ."
					
" . FULL_BASE_URL ." ／ http://www.ninchisho.net

" . Configure::read('mail_from');
			
			$this->Email->from = Configure::read('mail_from');
			$this->Email->to = $info[0]['Member']['id'];
			$this->Email->subject = '【認知症ねっと】 --パスワード再通知--';
			$this->Email->send($content);
			
			$this->redirect('/remain/complete');
		} catch (Exception $e) {
			$this->set('returnData', $data);
			$this->set('validationErrorsArray', array(array($e->getMessage())));
			$this->setAction('index', $data);
			$this->render('/Remain/index');
		}
	}
	/**
	 * Complete remain password
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function complete() {
		$this->layout = "";
	}
}