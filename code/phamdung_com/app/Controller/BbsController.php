<?php
App::uses('MemberController', 'Controller');
class BbsController extends MemberController {
	public $uses = array('Member', 'Bbs', 'Thread', 'Category', 'Categories');
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
	 * Top BBS
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index() {
		$this->set('title_for_layout', '||| 認知症相談室（掲示板） | 認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ） |||');
		$this->set('flag_left', '認知症相談室');
		$this->set('pkz', $this->Pkz->_setPkz('index.html', '認知症相談室'));
		$this->set('pkz', $this->Pkz->_setPkz('', '認知症相談室'));
	}
	/**
	 * BBS Normal
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function bbs_normal($page = NULL) {
		$this->layout = "";
		if (isset($this->params->named['flag_menu'])) {
			$this->set('flag_menu', $this->params->named['flag_menu']);
		}
		// check cookie
		$this->_checkCookie();
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
		}
		$this->set('threadById', $threadByID);
	}
	/**
	 * Insert thread to DB
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	function thread_do() {
		$this->Thread->set($this->request->data);
		if ($this->Thread->validates()) {
			// check cookie
			$infoCookie = $this->Cookie->read('bbs');
			if (!isset($infoCookie)) {
				$this->redirect('/login');
			}
			$check = split(":", $infoCookie);
			$id = $check[0];
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
					
				//check id of user post bbs
				$bbs = $this->Bbs->query('select mail, id from bbs where no = ' . $data['Thread']['no']);
				$checkId = $this->Member->query("select no from member where id = '" . $bbs[0]['bbs']['id'] . "'");
				if (count($checkId) > 0 && $bbs[0]['bbs']['mail'] != 'admin') {
					$content = "あなたが書き込んだ内容に返信がありました。
		
名前: " . $data['Thread']['name'] ."
メッセージ:
". $data['Thread']['message'];
					$this->Email->from = Configure::read('mail_from');
					$this->Email->to = $bbs[0]['bbs']['mail'];
					$this->Email->subject = '【認知症ねっと】掲示板からの返信通知';
					$this->Email->send($content);
				}
			}
			if (!isset($this->request->data['flag_menu'])) {
				$this->redirect('/bbs/bbs_normal');
			} else {
				$this->redirect('/bbs/bbs_normal/flag_menu:' . $this->request->data['flag_menu']);
			}
		} else {
			$page = $this->request->data['page'];
			$this->setAction("bbs_normal", $page);
			// process data return for thread of idBbs
			$returnData = array();
			$returnData[$this->request->data["Thread"]["no"]] = $this->request->data;
			$this->set('validateReturnThread', $returnData);
			$this->set('validationErrorsArray', $this->Thread->invalidFields());
			$this->render('/Bbs/bbs_normal');
		}
	}
	/**
	 * Insert bbs to DB
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	function bbs_do() {
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
					if ($mailTo == 'admin' || $mailTo == $data['mail']) {
						continue;
					}
					
					$content = "【認知症ねっと】掲示板に書き込みがありました。
http://www.chihou.net ／ http://www.ninchisho.net

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
					$this->Email->subject = '【認知症ねっと】掲示板に書き込みがありました。';
					$this->Email->send($content);
				}
			}
			$this->redirect('/Bbs/bbs_normal');
		} else {
			// process bug for pagation
			$page = $this->request->data['page'];
			$this->setAction("bbs_normal", $page);
			$this->set('validateReturn', $this->request->data);
			$this->set('validationErrorsArray', $this->Bbs->invalidFields());
			$this->render('/Bbs/bbs_normal');
		}
	}
	/**
	 * Confirm Delete BBS
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function del_bbs_confirm() {
		$this->layout = "";
		$this->set('data', $this->request->data);
	}
	/**
	 * Delete BBS
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function del_bbs_do() {
		$data = $this->request->data;
		
		$infoCookie = $this->Cookie->read('bbs');
		if (!isset($infoCookie)) {
			$this->redirect('/login');
		}
		$check = split(":", $infoCookie);
		$id = $check[0];
		if ($id != $data['mail']) {
			$this->redirect('/login');
		}
		
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
		if ($data['flag_menu'] == 'not') {
			$this->redirect('/bbs/bbs_normal/page:' . $data['page'] . '/flag_menu:not');
		} else {
			$this->redirect('/bbs/bbs_normal/page:' . $data['page']);
		}
	}
	/**
	 * Confirm Delete Thread
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function del_thread_confirm() {
		$this->layout = "";
		$this->set('data', $this->request->data);
	}
	/**
	 * Delete Thread
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function del_thread_do() {
		$data = $this->request->data;
		
		$infoCookie = $this->Cookie->read('bbs');
		if (!isset($infoCookie)) {
			$this->redirect('/login');
		}
		$check = split(":", $infoCookie);
		$id = $check[0];
		if ($id != $data['mail']) {
			$this->redirect('/login');
		}
	
		$this->Thread->read(null, $data['no']);
		$this->Thread->set('delete_flg', 1);
		$this->Thread->save();
		
		if ($data['flag_menu'] == 'not') {
			$this->redirect('/bbs/bbs_normal/page:' . $data['page'] . '/flag_menu:not');
		} else {
			$this->redirect('/bbs/bbs_normal/page:' . $data['page']);
		}
	}
	/**
	 * View list BBS if not login
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function view() {
		$this->layout = "";
		// select list 10 bbs
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
		}
		$this->set('threadById', $threadByID);
	}
	/**
	 * BBS Category
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function bbs_category() {
		$this->layout = "";
		// check cookie
		$this->_checkCookie();
		// Get list category
		$condCate = array('Category.delete_flg' => 0);
		$listCate = $this->Category->find('all', array('conditions' => $condCate, 'order' => 'Category.no ASC'));
		$this->set('listCate', $listCate);
		
		foreach ($listCate as $key => $val) {
			if ($val['Category']['no'] > 43) {
				break;
			}
			$cond = array('Categories.c_no' => $val['Category']['no']);
			$total = $this->Categories->find('count', array('conditions' => $cond));
			
			$val['Category']['total'] = $total;
			
			if ($val['Category']['no'] <= 11) {
				$cateGroup1[] = $val['Category'];
			} elseif ($val['Category']['no'] <= 33) {
				$cateGroup2[] = $val['Category'];
			} elseif ($val['Category']['no'] <= 43) {
				$cateGroup3[] = $val['Category'];
			}
		}
		// count(*) bbs
		$totalBbs = $this->Bbs->find('count', array('conditions' => array('Bbs.delete_flg' => 0)));


		$cateGroup1[] = array('name' => '全書き込み', 'total' => $totalBbs);
		$this->set('cateGroup1', $cateGroup1);
		$this->set('cateGroup2', $cateGroup2);
		$this->set('cateGroup3', $cateGroup3);
	}
	/**
	 * List bbs of category
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function frame() {
		$this->layout = "";
		// check cookie
		$this->_checkCookie();
		// get param
		$params = $this->params->named;
		$this->set('upper', '/bbs/upper/c_no:' . $params['c_no']);
	}
	/**
	 * Upper of List bbs of category
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function upper() {
		$this->layout = "";
		// check cookie
		$this->_checkCookie();
		// select list BBS
		$params = $this->params->named;
		$this->set('c_no', $params['c_no']);
		if ($params['c_no'] > 0) {
			$this->paginate['Bbs']['fields'] = array(
				'Bbs.no', 'Bbs.date', 'Bbs.flag', 'Bbs.name', 'Bbs.mail', 'Bbs.title',
				'Bbs.message', 'Bbs.id', 'Bbs.public', 'ma.attribute_name'
			);
			$this->paginate['Bbs']['conditions'] = array('cat.c_no' => $params['c_no'], 'Bbs.delete_flg' => 0);
			$this->paginate['Bbs']['joins'] = array(
				array(
					'table' => 'm_attribute',
					'alias' => 'ma',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Bbs.attribute = ma.id'),
				),
				array(
					'table' => 'categories',
					'alias' => 'cat',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Bbs.no = cat.b_no'),
				),
			);
			$this->paginate['Bbs']['order'] = array('Bbs.date DESC');
			//count total
			$joinCount = array(
				array(
					'table' => 'categories',
					'alias' => 'cat',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Bbs.no = cat.b_no'),
				),
			);
			$condCount = array('cat.c_no' => $params['c_no'], 'Bbs.delete_flg' => 0);
			$totalBbs = $this->Bbs->find('count', array('conditions' => $condCount, 'joins' => $joinCount));

			// select category
			$cond = array('Category.no' => $params['c_no']);
			$cateName = $this->Category->find('all', array('conditions' => $cond));
			$this->set('cateName', $cateName[0]['Category']['name']);
		} else {
			$this->paginate['Bbs']['joins'] = array(
				array(
					'table' => 'm_attribute',
					'alias' => 'ma',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Bbs.attribute = ma.id'),
				),
			);
			$this->paginate['Bbs']['order'] = array('Bbs.date DESC');
			//count total
			$totalBbs = $this->Bbs->find('count');
		}
		$this->Bbs->recursive = 0;
		$listBbs = $this->paginate('Bbs');
		$this->set('listBbs', $listBbs);
		$this->set('totalBbs', $totalBbs);
	}
	/**
	 * Lower of List bbs of category
	 * @author Luvina
	 * @package Smscom
	 *
	 */
	public function lower() {
		$this->layout = "";
		// check cookie
		$this->_checkCookie();
		// select bbs
		$params = $this->params->named;
		if (!isset($params['no']) || $params['no'] < 1) {
			$this->render('/Bbs/lower');
		} else {
			$this->set('no', $params['no']);
			$fieldBbs = array(
				'Bbs.no', 'Bbs.date', 'Bbs.flag', 'Bbs.name', 'Bbs.mail', 'Bbs.title',
				'Bbs.message', 'Bbs.id', 'Bbs.public', 'ma.attribute_name'
			);
			$condBbs = array('cat.c_no' => $params['c_no'], 'Bbs.no' => $params['no'], 'Bbs.delete_flg' => 0);
			$joinBbs = array(
				array(
					'table' => 'm_attribute',
					'alias' => 'ma',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Bbs.attribute = ma.id'),
				),
				array(
					'table' => 'categories',
					'alias' => 'cat',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Bbs.no = cat.b_no'),
				),
			);
			$orderBbs = 'Bbs.date DESC';

			$bbs = $this->Bbs->find('all', array('fields' => $fieldBbs, 'conditions' => $condBbs, 'joins' => $joinBbs, 'order' => $orderBbs));
			$this->set('bbs', $bbs);
			// select thread
			$fieldThread = array(
				'Thread.threadNo' , 'Thread.no' , 'Thread.date' , 'Thread.flag' , 'Thread.name' , 'Thread.mail' ,
				'Thread.title' , 'Thread.message' , 'Thread.id' , 'Thread.public' , 'ma.attribute_name'
			);
			$condThread = array('Thread.delete_flg' => 0, 'Thread.no' => $params['no']);
			$joinThread = array(
				array(
					'table' => 'm_attribute',
					'alias' => 'ma',
					'type' => 'INNER',
					'foreignKey' => false,
					'conditions' => array('Thread.attribute = ma.id'),
				),
			);
			$listThread = $this->Thread->find('all', array('conditions' => $condThread, 'joins' => $joinThread, 'fields' => $fieldThread));
			$this->set('listThread', $listThread);
		}
	}
}