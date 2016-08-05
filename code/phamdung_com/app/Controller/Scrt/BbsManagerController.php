<?php
App::uses('AdminController', 'Controller');
/**
 * Bbs Manager For Admin
 * @author Luvina
 * @access public
 * @package Smscom
 *
 */
class BbsManagerController extends AdminController {
	public $uses = array('Member', 'Bbs', 'Thread', 'Category');
	public $components = array('Email');
	public $paginate = array(
			'Bbs' => array(
					'limit' => 10,
					'order' => array(
							'Bbs.date' => 'desc',
					),
			),
	);
	/**
	 * Function control to display
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function display() {
		if (!$this->params->params['pass']) {
			$action = "index";
		} else {
			$action = $this->params->params['pass'][0];
		}
		$this->setAction($action);
		//set pkz
		$this->set('pkz', $this->Pkz->_setPkz('/scrt/bbs_manager/', 'コミュニケーション管理', true));
	}
	/**
	 * BbsManager_Index
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index() {
		// set tile
		$this->set('title_for_layout', 'コミュニケーション管理');
	}
	/**
	 * BbsManager_Bbs
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function bbs($page = NULL) {
		$this->set('title_for_layout', '痴呆相談室');
		// check cookie
		$infoCookie = $this->Cookie->read('bbs');
		$checkAdmin = split(":", $infoCookie);
		$id = $checkAdmin[0];
		$ps = $checkAdmin[1];
		if ($id != 'admin') {
			$this->redirect('/scrt/login');
		}
		// select infomation of admin
		$fields = array('Member.no', 'Member.handle', 'Member.mail', 'Member.attribute', 'ma.attribute_name');
		$conditions = array('Member.delete_flg' => 0, 'Member.id' => $id, 'Member.ps' => $ps);
		$joins = array(
			'table' => 'm_attribute',
			'alias' => 'ma',
			'type' => 'INNER',
			'foreignKey'    => false,
			'conditions'    => array('Member.attribute = ma.id')
		);
		$info = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions, 'joins' => array($joins)));
		$this->set('info', $info);
		if (count($info) != 1) {
			$this->redirect('/scrt/login');
		}
		// select list 10 bbs
		if (isset($page)) {
			$this->paginate['Bbs']['page'] = $page;
		}
		$this->paginate['Bbs']['fields'] = array(
				'Bbs.no', 'Bbs.date', 'Bbs.flag', 'Bbs.name', 'Bbs.mail', 'Bbs.title',
				'Bbs.message', 'Bbs.id', 'Bbs.public', 'ma.attribute_name'
		);
		$this->paginate['Bbs']['joins'] = array(
				array(
						'table' => 'm_attribute',
						'alias' => 'ma',
						'type' => 'INNER',
						'foreignKey' => false,
						'conditions' => array('Bbs.attribute = ma.id')
				)
		);
		$this->paginate['Bbs']['conditions'] = array('Bbs.delete_flg' => 0);
		$this->Bbs->recursive = 0;
		$listBbs = $this->paginate('Bbs');
		$this->set('listBbs', $listBbs);
		// select thread, category of 10 bbs
		$threadByID = array();
		$categoryById = array();
		foreach ($listBbs as $key => $val) {
			$idBbs = $val['Bbs']['no'];
			// select thread
			$condThread = array('Thread.delete_flg' => 0, 'Thread.no' => $idBbs);
			$fieldThread = array(
				'Thread.threadNo' , 'Thread.no' , 'Thread.date' , 'Thread.flag' , 'Thread.name' , 'Thread.mail' ,
				'Thread.title' , 'Thread.message' , 'Thread.id' , 'Thread.public' , 'ma.attribute_name' 
			);
			$joinThread = array(
					'table' => 'm_attribute',
					'alias' => 'ma',
					'type' => 'INNER',
					'foreignKey'    => false,
					'conditions'    => array('Thread.attribute = ma.id')
			);
			$threadByID[$idBbs] = $this->Thread->find('all', array('fields' => $fieldThread, 'conditions' => $condThread, 'joins' => array($joinThread) ));
			// select category
			$fieldCate = array('Category.name');
			$joinCate = array(
				'table' => 'categories',
				'alias' => 'cs',
				'type' => 'INNER',
				'foreignKey'    => false,
				'conditions'    => array('Category.no = cs.c_no')
			);
			$condCate = array('cs.b_no' => $idBbs, 'Category.delete_flg' => 0);
			$categoryById[$idBbs] = $this->Category->find('all', array('fields' => $fieldCate, 'conditions' => $condCate, 'joins' => array($joinCate), 'order' => 'cs.c_no'));
		}
		$this->set('threadById', $threadByID);
		$this->set('categoryById', $categoryById);
		$this->set('optionForCategory', $this->_createCategorySelect());
		$this->set('aryInfoController', array('scrt', 'bbs_manager'));
	}
	/**
	 * BbsManager_DelConfirm
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 * confirm delete bbs and thread
	 *
	 */
	public function del_confirm() {
		$this->set('title_for_layout', '痴呆相談室');
		$this->set('data', $this->request->data);
	}
	/**
	 * BbsManager_Logout
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function logout() {
		$this->set('title_for_layout', '認知症相談室');
		//check cookie
		$cookie = $this->Cookie->read('bbs');
		if (!$cookie) {
			$this->redirect('/scrt/login');
		}
		$this->Cookie->delete('bbs');
	}
	/**
	 * BbsManager_Category
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 * index category
	 */
	public function category() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
	}
	/**
	 * BbsManager_ListCategory
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 */
	public function list_category() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		// check admin
		if (!$this->_isAdmin()) {
			$this->redirect('/scrt/login');
		}
		$listCategory = $this->Category->find('all', array('conditions' => array('Category.delete_flg' => 0), 'order' => 'Category.sort_no ASC'));
		$this->set('listCategory', $listCategory);
	}
	/**
	 * BbsManager_EditCategory
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 */
	public function edit_category() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		// check admin
		if (!$this->_isAdmin()) {
			$this->redirect('/scrt/login');
		}
		$param = $this->params->named;
		
		$condCate = array('Category.delete_flg' => 0, 'Category.no' => $param['no']);
		$cateDatail = $this->Category->find('all', array('conditions' => $condCate));
		if (count($cateDatail) != 1) {
			$this->set('validationErrorsArray', array(array('不正な操作')));
		} else {
			$this->set('cateDetail', $cateDatail[0]['Category']);
		}
	}
	/**
	 * BbsManager_EditCategoryDo
	 * @author Luvina
	 * @package Smscom
	 */
	function edit_category_do() {
		//set pkz for validate
		$this->set('pkz', $this->Pkz->_setPkz('/scrt/bbs_manager/', 'コミュニケーション管理', true));
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		$data = $this->request->data;
		if (isset($data['Validate']['update']) && $data['Validate']['update'] == 'UPDATE') {
			$this->loadModel('Validate');
			$this->Validate->set($this->request->data);
			$this->Validate->validate['sort_no'] = array(
					'checkNull' => array(
						'rule' => 'notEmpty',
						'message' => '登録番号には数値を入力してください。'
					),
					'checkNumeric' => array(
						'rule' => 'numeric',
						'message' => '登録番号には数値を入力してください。'
					),
					'checkZero' => array(
						'rule' => array('comparison', '>', 0),
						'message' => '登録番号は０より大きい数値にしてください。'	
					),
			);
			if ($this->Validate->validates()) {
				$check = $this->Category->find('all', array('conditions' => array('Category.sort_no' => $data['Validate']['sort_no'], 'Category.delete_flg' => 0)));
				if (count($check) > 0) {
					$this->set('returnData', $data['Validate']);
					$this->set('validationErrorsArray', array(array("登録番号：". $data['Validate']['sort_no'] ." は使用されています。<br>登録番号を変更して下さい")));
					$this->render('/BbsManager/edit_category');
				} else {
					// update DB
					$this->Category->read(null, $data['Validate']['no']);
					$this->Category->set('sort_no', $data['Validate']['sort_no']);
					$this->Category->set('name', $data['Validate']['name']);
					$this->Category->save();
					
					$this->redirect('/scrt/bbs_manager/edit_category_complete');
				}
			} else {
				$this->set('returnData', $data['Validate']);
				$this->set('validationErrorsArray', $this->Validate->invalidFields());
				$this->render('/BbsManager/edit_category');
			}
		}
		elseif (isset($data['Validate']['delete']) && $data['Validate']['delete'] == 'DELETE') {
			// delete category
			$this->Category->read(null, $data['Validate']['no']);
			$this->Category->set('delete_flg', 1);
			$this->Category->save();
			// delete categories
			$this->loadModel('Categories');
			$this->Categories->query("delete from categories where c_no = '" . $data['Validate']['no'] . "'" );
			
			$this->redirect('/scrt/bbs_manager/del_category_complete/sort_no:' . $data['Validate']['sort_no']);
		}
	}
	/**
	 * BbsManager_EditCategoryComplete
	 * @author Luvina
	 * @package Smscom
	 * @access public
	 */
	public function edit_category_complete() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
	}
	/**
	 * BbsManager_EditCategoryComplete
	 * @author Luvina
	 * @package Smscom
	 * @access public
	 */
	public function del_category_complete() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		$this->set('sort_no', $this->params->named['sort_no']);
	}
	/**
	 * BbsManager_FormCategory
	 * @author Luvina
	 * @package Smscom
	 * @access public
	 */
	public function form_category() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		//check admin
		if (!$this->_isAdmin()) {
			$this->redirect('/scrt/login');
		}
	}
	/**
	 * BbsManager_CategoryDo
	 * @author Luvina
	 * @package Smscom
	 * @access public
	 * create new category
	 */
	public function create_category_do() {
		//set pkz for validate
		$this->set('pkz', $this->Pkz->_setPkz('/scrt/bbs_manager/', 'コミュニケーション管理', true));
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		$data = $this->request->data;
		// check duplicate sort_no
		$check = $this->Category->find('all', array('conditions' => array('Category.sort_no' => $data['Category']['sort_no'], 'Category.delete_flg' => 0)));

		$this->Category->set($this->request->data);
		$this->Category->validate['sort_no'] = array(
				'checkNull' => array(
					'rule' => 'notEmpty',
					'message' => '登録番号には数値を入力してください。'
				),
				'checkNumeric' => array(
					'rule' => 'numeric',
					'message' => '登録番号には数値を入力してください。'
				),
				'checkZero' => array(
					'rule' => array('comparison', '>', 0),
					'message' => '登録番号は０より大きい数値にしてください。'	
				),
		);
		if ($this->Category->validates() && count($check) < 1) {
			$this->Category->create();
			$this->Category->set('sort_no', $data['Category']['sort_no']);
			$this->Category->set('name', $data['Category']['name']);
			$this->Category->save();
			$this->redirect('/scrt/bbs_manager/create_category_complete/sort_no:' . $data['Category']['sort_no'] . '/name:' . $data['Category']['name']);
		} else {
			$this->set('returnData', $data['Category']);
			if (count($check) > 0) {
				$msgValidate = "登録番号：" . $data['Category']['sort_no'] . " は使用されています。<br>登録番号を変更して下さい";
				$this->set('validationErrorsArray', array(array($msgValidate)));
			} else {
				$this->set('validationErrorsArray', $this->Category->invalidFields());
			}
			$this->render('/BbsManager/form_category');
		}
	}
	/**
	 * BbsManager_CreateCategoryComplete
	 * @author Luvina
	 * @package Smscom
	 * @access public
	 * create category complete
	 */
	public function create_category_complete() {
		$this->set('title_for_layout', '-- 痴呆相談室 管理 --');
		// check admin
		if (!$this->_isAdmin()) {
			$this->redirect('/scrt/login');
		}
		$this->set('sort_no', $this->params->named['sort_no']);
		$this->set('name', $this->params->named['name']);
	}
	/**
	 * BbsManager_BbsDo
	 * @author Luvina
	 * @package Smscom
	 * process insert bbs to DB
	 *
	 */
	function bbs_do() {
		//set pkz
		$this->set('pkz', $this->Pkz->_setPkz('/scrt/bbs_manager/', 'コミュニケーション管理', true));
		$this->Bbs->set($this->request->data);
		if ($this->Bbs->validates()) {
			$data = $this->request->data;
			$this->Bbs->create();
			$this->Bbs->set('date', date('Y-m-d H:i:m'));
			$this->Bbs->set('flag', 1);
			$this->Bbs->set('name', $data['name']);
			$this->Bbs->set('mail', $data['mail']);
			$this->Bbs->set('title', $data['Bbs']['title']);
			$this->Bbs->set('message', $data['Bbs']['message']);
			$this->Bbs->set('id', $data['mail']);
			$this->Bbs->set('public', 0);
			$this->Bbs->set('attribute', $data['attribute']);
			if (!$this->Bbs->hasAny($this->Bbs->data["Bbs"])) {
				$this->Bbs->save();
				// start send mail
				$fields = array('Member.id');
				$conditions = array('Member.delete_flg' => 0, 'Member.flag' => 1, 'Member.bbsmail' => 1);
				$member = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions));
				
				foreach ($member as $val) {
					$mailTo = $val["Member"]["id"];
					$content = "新規に書き込みがありました。
[投稿者]
". $data['name'] ."
[タイトル]
". $data['Bbs']['title'] ."
[メッセージ]
". $data['Bbs']['message'] ."		

		
		
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
※こちらのメールは自動送信メールとなっております。そのままご返信頂
きましても掲示板には反映されません。掲示板に書き込みをされる場合は、
「認知症相談室」からログインしてください。
→ http://www.chihou.net/soudan/bbs/index.html

※本メール配信停止方法について
配信停止を御希望の方は、掲示板ログイン後、画面上部の「登録情報変更」
ページより「掲示板情報配信」を「希望しない」に変更してください。
→ http://www.chihou.net/soudan/bbs/index.html
";
					$this->Email->from = Configure::read('mail_from');
					$this->Email->to = $mailTo;
					$this->Email->subject = '痴呆相談室情報配信通知';
					$this->Email->send($content);
				}
			}
			$this->redirect('/bbs/bbs_normal');
		} else {
			// process bug for pagation
			$this->params->params['pass'][0] = "bbs";
			$page = $this->request->data['page'];
			$this->setAction("bbs", $page);
			$this->set('validateReturn', $this->request->data);
			$this->set('validationErrorsArray', $this->Bbs->invalidFields());
			$this->render('/BbsManager/bbs');
		}
	}
	/**
	 * BbsManager_CategoryDo
	 * @author Luvina
	 * @package Smscom
	 * register category for bbs
	 *
	 */
	function category_do() {
		$idBbs = $this->request->data['no'];
		$page = $this->request->data['page'];
		unset($this->request->data['no']);
		unset($this->request->data['page']);
		$this->loadModel('Categories');
		$this->Categories->query('delete from categories where b_no = ' . $idBbs);
		foreach ($this->request->data as $k => $val) {
			//check duplicate categories
			unset($this->request->data[$k]);
			if ($val == "") continue;
			if (array_search($val, $this->request->data)) 	continue;
			// insert if not duplicate
			$this->Categories->query("insert into categories (b_no, c_no) values ($idBbs, $val)");
		}
		$this->redirect('/scrt/bbs_manager/bbs/page:' . $page);
	}
	/**
	 * BbsManager_ThreadDo
	 * @author Luvina
	 * @package Smscom
	 * insert thread to DB
	 *
	 */
	function thread_do() {
		//set pkz
		$this->set('pkz', $this->Pkz->_setPkz('/scrt/bbs_manager/', 'コミュニケーション管理', true));
		$this->Thread->set($this->request->data);
		if ($this->Thread->validates()) {
			// check cookie
			$infoCookie = $this->Cookie->read('bbs');
			$checkAdmin = split(":", $infoCookie);
			$id = $checkAdmin[0];
			// save data to db
			$data = $this->request->data;
			$this->Thread->create();
			$this->Thread->set('no', $data['Thread']['no']);
			$this->Thread->set('date', date('Y-m-d H:i:m'));
			$this->Thread->set('flag', 1);
			$this->Thread->set('name', $data['Thread']['name']);
			$this->Thread->set('mail', $data['Thread']['mail']);
			$this->Thread->set('title', $data['Thread']['title']);
			$this->Thread->set('message', $data['Thread']['message']);
			$this->Thread->set('id', $id);
			$this->Thread->set('public', 0);
			$this->Thread->set('attribute', $data['Thread']['attribute']);
			if (!$this->Thread->hasAny($this->Thread->data["Thread"])) {
				$this->Thread->save();
				
				$bbs = $this->Bbs->query('select mail, id from bbs where no = ' . $data['Thread']['no']);
				$checkId = $this->Member->query("select no, mail from member where id = '" . $bbs[0]['bbs']['id'] . "'");
				if (count($checkId) > 0 && $checkId[0]['member']['mail'] != 'admin') {
					$content = "あなたが書き込んだ内容に返信がありました。

名前: " . $data['Thread']['name'] ."
メッセージ:
". $data['Thread']['message'];
					$this->Email->from = Configure::read('mail_from');
					$this->Email->to = $bbs[0]['bbs']['mail'];
					$this->Email->subject = '痴呆相談室掲示板からの返信通知';
					$this->Email->send($content);
				}
			}
			$this->redirect('/scrt/bbs_manager/bbs');
		} else {
			// process bug for pagation
			$this->params->params['pass'][0] = "bbs";
			$page = $this->request->data['page'];
			$this->setAction("bbs", $page);
			// process data return for thread of idBbs
			$returnData = array();
			$returnData[$this->request->data["Thread"]["no"]] = $this->request->data; 
			$this->set('validateReturnThread', $returnData);
			$this->set('validationErrorsArray', $this->Thread->invalidFields());
			$this->render('/BbsManager/bbs');
		}
	}
	/**
	 * BbsManager_CategoryDo
	 * @author Luvina
	 * @package Smscom
	 * process delete bbs and thread
	 *
	 */
	function del_bbs_thread_do() {
		$data = $this->request->data;
		if ($data['type'] == "bbs") {			
			$this->Bbs->read(null, $data['no']);
			$this->Bbs->set('delete_flg', 1);
			$this->Bbs->save();
			
			$fields = array('Thread.threadNo');
			$conditions = array('Thread.no' => $data['no'], 'Thread.delete_flg' => 0);
			$thread = $this->Thread->find('all', array('fields' => $fields, 'conditions' => $conditions));
			foreach ($thread as $val) {
				$this->Thread->read(null, $val['Thread']['threadNo']);
				$this->Thread->set('delete_flg', 1);
				$this->Thread->save();
			}
		} elseif ($data['type'] == "thread") {
			$this->Thread->read(null, $data['no']);
			$this->Thread->set('delete_flg', 1);
			$this->Thread->save();
		}
		$this->redirect('/scrt/bbs_manager/bbs/page:' . $data['page']);
	}
}