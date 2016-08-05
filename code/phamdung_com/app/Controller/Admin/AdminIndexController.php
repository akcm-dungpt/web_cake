<?php
App::uses('AdminController', 'Controller');
class AdminIndexController extends AdminController {
	public function index() {
		$this->set('title_for_layout', '--- 痴呆相談室 管理 --');
	}
	public function login() {
		$this->set('title_for_layout', '痴呆相談室');
	}
	function login_do() {
		$this->set('title_for_layout', '痴呆相談室');
		// SECURITY CHECK
		if ($this->referer() == '/') {
			$this->redirect('/scrt/login');
		}
		$this->loadModel('Member');
		$this->Member->validate = array();
		$this->Member->validate['id'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'ユーザーIDが入力されていません',
		);
		$this->Member->validate['ps'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'パスワードが入力されていません',
		);
		$this->Member->set($this->request->data);
		if ($this->Member->validates()) {
			try {
				$param = $this->request->data;
				$id = $param["Member"]["id"];
				$ps = sha1($param["Member"]["ps"]);
				if ($id != "admin") {
					throw new Exception("管理者ではありません");
				}
				// select DB
				$fields = array('Member.no', 'Member.id', 'Member.ps', 'Member.flag');
				$conditions = array('Member.delete_flg' => 0, 'Member.id' => $id, 'Member.ps' => $ps);
				$info = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions));
				if (count($info) == 0) {
					throw new Exception("入力されたIDが存在しないか、パスワードが間違っています。");
				}
				if ($info[0]['Member']['flag'] == 0) {
					throw new Exception("このIDは現在利用できません。");
				}
				$this->Cookie->write("bbs", "$id:$ps", true);
				$this->redirect('/scrt/bbs_manager/bbs');
			}
			catch (Exception $e) {
				$this->set('validationErrorsArray', array(array($e->getMessage())));
				$this->set('validateReturn', $this->request->data);
				$this->render('/AdminIndex/login');
			}
		} else {
			$this->set('validationErrorsArray', $this->Member->invalidFields());
			$this->set('validateReturn', $this->request->data);
			$this->render('/AdminIndex/login');
		}
	}
}