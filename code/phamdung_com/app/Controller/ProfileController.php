<?php
App::uses('MemberController', 'Controller');
class ProfileController extends MemberController {
	public $uses = array('Member');
	public $layout = "";
	public $components = array('Email');
	/**
	 * Form confirm id & password member
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
	}
	/**
	 * Form edit information member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 */
	public function form() {
		try {
			$data = $this->request->data;
			// check param for bbs menu
			if (isset($data['flag']) && $data['flag'] == "bbs") {
				$this->set('bbsMenu', 1);
			}
			if (!isset($data['id']) || $data['id'] == "" || !isset($data['ps']) || $data['ps'] == "") {
				throw new Exception('未入力の項目があります。');
			}
			// get information
			$conditions = array('Member.delete_flg' => 0, 'Member.id' => $data['id'], 'Member.ps' => sha1($data['ps']), 'Member.flag' => 1);
			$info = $this->Member->find('all', array('conditions' => $conditions));
			if (!$info) {
				throw new Exception('入力されたIDが存在しないか、パスワードが間違っています。');
			}
			$this->set('infoUser', $info);
		} catch (Exception $e) {
			$this->set('returnData', $data);
			$this->set('validationErrorsArray', array(array($e->getMessage())));
			$this->render('/Profile/index');
		}
	}
	/**
	 * Confirm edit information member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 */
	public function confirm() {
		$data = $this->request->data;
		// check param for bbs menu
		if (isset($data['flag']) && $data['flag'] == "bbs") {
			$this->set('bbsMenu', 1);
		}
		if (!isset($data['Member']['no'])) {
			$this->set('validationErrorsArray', array(array('不正なアクセス')));
			$this->render('/Profile/index');
		}
		$this->Member->validate = array();
		$this->Member->set($this->request->data);
		$this->Member->validate['handle'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'ハンドルネームを入力して下さい',
		);
		$this->Member->validate['id'] = array(
			'checkNull' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'メールアドレスを入力して下さい'
			),
			'checkEmail' => array(
				'rule' => array('email', true),
				'message' => 'メールアドレスがおかしいようです'
			),
		);
		// if change id, check unique
		if ($data['Member']['id'] != $data['Member']['oldID']) {
			$this->Member->validate['id']['unique'] = array(
				'rule' => 'isUnique',
				'message' => 'このメールアドレスは登録済みです',
			);
		}
		if ($data['Member']['ps'] != "") {
			$this->Member->validate['ps'] = array(
				'type' => array(
					'rule' => '/^[a-zA-Z0-9]+$/',
					'message' => 'パスワードは英数字で入力して下さい'
				),
				'lenght' => array(
					'rule' => array('between', 4, 12),
					'message' => 'パスワードは半角4文字以上12文字以内で入力して下さい',
				),
			);
		}
		if ($this->Member->validates()) {
			if ($data['Member']['mailmagazine'] == 0) {
				$data['Member']['mailmagazine_text'] = "希望しない";
			} else {
				$data['Member']['mailmagazine_text'] = "希望する";
			}
			
			$this->set('data', $data['Member']);
		} else {
			$this->set('returnData', $data['Member']);
			$this->set('validationErrorsArray', $this->Member->invalidFields());
			$this->render('/Profile/form');
		}
	}
	/**
	 * Update to DB
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 */
	public function update() {
		$data = $this->request->data;
		// check param for bbs menu
		if (isset($data['flag']) && $data['flag'] == "bbs") {
			$this->set('bbsMenu', 1);
		}
		if ($this->referer() == '/' || !isset($data['no']) || $data['no'] == "" || !isset($data['handle']) || $data['handle'] == "") {
			$this->redirect('/login');
		}
		
		$this->Member->validate = array();
		$this->Member->read(null, $data['user_id']);
		$this->Member->set('id', $data['id']);
		if ($data['ps'] != "") {
			$this->Member->set('ps', sha1($data['ps']));
		}
		$this->Member->set('handle', $data['handle']);
		$this->Member->set('mail', $data['id']);
		$this->Member->set('usrmail', $data['id']);
		$this->Member->set('mailmagazine', $data['mailmagazine']);
		$this->Member->save();
		if ($data['id'] != $data['oldID']) {
			$this->loadModel('Bbs');
			$this->loadModel('Thread');
			$bbsQuery = "UPDATE bbs SET id = '" . $data['id'] . "',	mail = '" . $data['id'] . "' where id = '" . $data['oldID'] . "'";
			$this->Bbs->query($bbsQuery);
			$threadQuery = "UPDATE thread SET id = '" . $data['id'] . "',	mail = '" . $data['id'] . "' where id = '" . $data['oldID'] . "'";
			$this->Thread->query($threadQuery);
			
			$content = "ご利用頂き、ありがとうございます。
あなたのIDは下記の通りです。

ユーザーID：". $data['id'] ."

". FULL_BASE_URL ." ／ http://www.ninchisho.net

" . Configure::read('mail_from');
			$this->Email->from = Configure::read('mail_from');
			$this->Email->to = $data['id'];
			$this->Email->subject = '【認知症ねっと】会員情報変更通知';
			$this->Email->send($content);
			
			//set message display in complete
			$this->set('msg', 'IDを送信しました。メールにてご確認下さい');
		}
		$this->render('/Profile/complete');
	}
}