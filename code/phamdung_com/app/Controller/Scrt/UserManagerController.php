<?php
App::uses('AdminController', 'Controller');
/**
 * UserManager
 * @author Luvina
 * @access public
 * @package Smscom
 *
 */
class UserManagerController extends AdminController {
	public $uses = array('Member');
	public $components = array('Session');
	public $paginate = array(
        'Member' => array(
            'limit' => 10,
            'order' => array(
                'Member.entryDay' => 'desc',
            ),
        ),
    );
	/**
	 * UserManager_Display
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 * function control action
	 */
	public function display() {
		if (!$this->params->params['pass']) {
			$action = "index";
		} else {
			$action = $this->params->params['pass'][0];
		}
		$this->setAction($action);
		// set side left menu
		//$this->set('smenu', ROOT . '/app/View/Scrt/UserManager/_smenu.ctp');
	}
	/**
	 * UserManager_Index
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 * 
	 */
	public function index() {
		// set tile & pkz
		$this->set('title_for_layout', '会員管理');
		$this->set('pkz', $this->Pkz->_setPkz('', '会員管理', true));
	}
	/**
	 * UserManager_Search
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 * Form search member
	 */
	public function search() {
		// set tile & pkz
		$this->set('title_for_layout', '痴呆相談室');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);
	}
	/**
	 * UserManager_Seek
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 * Do search member with conditions
	 */
	public function seek() {
		// SECURITY CHECK
		$this->_checkSecurity('/UserManager/search');
		// set title & pkz
		$this->set('title_for_layout', '痴呆相談室');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);
		// set rule validate
		$this->loadModel('Validate');
		$this->Validate->validate['word'] = array(
			'rule' => 'notEmpty',
			'message' => 'キーワードを入力してください'
		);
		$this->Validate->set($this->request->data);
		$this->set('smenu', ROOT . '/app/View/Scrt/UserManager/_smenu.ctp');
		if ($this->Validate->validates()) {
			$keyword = $this->request->data['Validate']['word'];
			//query data
			$cond = "
				(Member.delete_flg = 0)
				AND
				(Member.flag = 1 OR Member.flag = 0)
				AND
				( Member.usrname LIKE '%$keyword%' OR Member.id LIKE '%$keyword%' OR Member.handle LIKE '%$keyword%' OR Member.entryDay LIKE '%$keyword%' )
			";
			$join = array(
				'table' => 'm_attribute',
				'alias' => 'ma',
				'type' => 'INNER',
				'foreignKey' => false,
				'conditions' => array('Member.attribute = ma.id')
			);
			$field = array(
				'Member.user_id',
				'Member.id',
				'Member.ps',
				'Member.handle',
				'ma.attribute_name',
				'Member.entryDay'
			);
			$this->set('listMember', $this->Member->find('all', array('fields' => $field ,'conditions' => $cond, 'order' => 'entryDay DESC', 'joins' => array($join))));
		} else {
			$this->set('validationErrorsArray', $this->Validate->invalidFields());
			$this->render('/UserManager/search');
		}
	}
	/**
	 * UserManager_listing
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 * List all member
	 */
	public function listing() {
		// SECURITY CHECK
		$this->_checkSecurity('/UserManager/search');
		// set tile & pkz
		$this->set('title_for_layout', '痴呆相談室');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);

		$this->paginate['Member']['fields'] = array(
			'Member.user_id',
			'Member.id',
			'Member.ps',
			'Member.handle',
			'ma.attribute_name',
			'Member.entryDay'
		);
		$this->paginate['Member']['joins'] = array(
			array(
			'table' => 'm_attribute',
			'alias' => 'ma',
			'type' => 'INNER',
			'foreignKey' => false,
			'conditions' => array('Member.attribute = ma.id')
			)
		);
		$this->paginate['Member']['conditions'] = array('Member.delete_flg' => 0);
		$this->Member->recursive = 0;
        $this->set('listMember', $this->paginate('Member'));
	}
	/**
	 * UserManager_Edit
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 * Form edit member
	 */
	public function edit() {
		// SECURITY CHECK
		$this->_checkSecurity('/UserManager/search');
		// set tile & pkz
		$this->set('title_for_layout', '痴呆相談室');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);

		$param = $this->request->named;
		$userInfo = $this->Member->findAllByUserId($param['user_id']);
		$this->set('userInfo', $userInfo);

		$optionSelect = $this->_createPrefectureSelect($userInfo[0]['Member']['pref']);
		$this->set('optionSelect', $optionSelect);
		$optionAttribute = $this->_createAttributeSelect($userInfo[0]['Member']['attribute']);
		$this->set('optionAttribute', $optionAttribute);
	}
	/**
	 * UserManager_EditComplete
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 * process edit member & update to DB
	 */
	public function edit_complete() {
		// set tile & pkz
		$this->set('title_for_layout', '--痴呆相談室 管理--');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);
		
		if ($this->request->data['Member']['ps'] == "") {
			$this->request->data['Member']['ps'] = $this->request->data['old_ps'];
		} else {
			$this->request->data['Member']['ps'] = sha1($this->request->data['Member']['ps']);
		}
		if ($this->request->data['Member']['income'] == "") {
			$this->request->data['Member']['income'] = 0;
		}
		$this->Member->set($this->request->data);
		if ($this->Member->validates()) {
			$this->Member->id = $this->request->data['Member']['user_id'];
			$this->Member->save($this->request->data);
		} else {
			if ($this->request->data['Member']['ps'] == $this->request->data['old_ps']) {
				$this->request->data['Member']['ps'] = "";
			}
			$optionSelect = $this->_createPrefectureSelect($this->request->data['Member']['pref']);
			$this->set('optionSelect', $optionSelect);
			$optionAttribute = $this->_createAttributeSelect($this->request->data['Member']['attribute']);
			$this->set('optionAttribute', $optionAttribute);

			$this->set('validationErrorsArray', $this->Member->invalidFields());
			$this->set('validateReturn', $this->request->data);
			$this->render('/UserManager/edit');
		}
	}
	/**
	 * UserManager_DeleteComplete
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 * Do search member with conditions
	 */
	public function delete_complete() {
		$params = $this->request->data;
		// SECURITY CHECK
		$this->_checkSecurity('/Scrt/UserManager/search');
		// set tile & pkz
		$this->set('title_for_layout', '-- 痴呆相談室 管理--');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);
		if ($params['user_id'] > 0) {
			$this->Member->validate = array();
			$this->Member->read(null, $params['user_id']);
			$this->Member->set('delete_flg', 1);
			$this->Member->save();
		}
	}
	/**
	 * UserManager_Csv
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 * Create CSV
	 */
	public function csv() {
		// set tile & pkz
		$this->set('title_for_layout', '痴呆相談室');
		$pkz = $this->Pkz->_setPkz('/scrt/user_manager/', '会員管理', true);
		$this->set('pkz', $pkz);
		// process download csv
		$params = $this->request->named;
		if ($params && $params['download'] == "true") {
			// list data
			$fields = array('Member.no', 'Member.id', 'Member.ps', 'Member.handle', 'Member.usrname', 'Member.age', 'Member.gender',
							'Member.zip', 'Member.pref', 'Member.attribute', 'Member.income', 'Member.bbsmail', 'Member.institution',
							'Member.mailmagazine', 'Member.enquete', 'Member.flag', 'Member.entryDay'
					);
			$conditions = array('Member.flag' => 1, 'Member.delete_flg' => 0);
			$listMember = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions));

			// CSVファイル出力
			$fileName = "csv.csv";
			header('Content-type: application/vnd.ms-excel');
			header('content-type:application/csv;charset=UTF-8');
			header("Content-Disposition: attachment; filename=\"$fileName\"");
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0,pre-check=0');
	       
	       // SJIS-winへ文字コード変換
			mb_convert_variables("SJIS-win", "UTF-8", $listMember);
			foreach ($listMember as $key => $val) {
				echo '"' . $val['Member']['no'] . '"';
				echo ',';
				echo '"' . $val['Member']['id'] . '"';
				echo ',';
				echo '"' . $val['Member']['ps'] . '"';
				echo ',';
				echo '"' . $val['Member']['handle'] . '"';
				echo ',';
				echo '"' . $val['Member']['usrname'] . '"';
				echo ',';
				echo '"' . $val['Member']['age'] . '"';
				echo ',';
				echo '"' . $val['Member']['gender'] . '"';
				echo ',';
				echo '"' . $val['Member']['zip'] . '"';
				echo ',';
				echo '"' . $val['Member']['pref'] . '"';
				echo ',';
				echo '"' . $val['Member']['attribute'] . '"';
				echo ',';
				echo '"' . $val['Member']['income'] . '"';
				echo ',';
				echo '"' . $val['Member']['bbsmail'] . '"';
				echo ',';
				echo '"' . $val['Member']['institution'] . '"';
				echo ',';
				echo '"' . $val['Member']['mailmagazine'] . '"';
				echo ',';
				echo '"' . $val['Member']['enquete'] . '"';
				echo ',';
				echo '"' . $val['Member']['flag'] . '"';
				echo ',';
				echo '"' . $val['Member']['entryDay'] . '"';
				echo "\r\n";
			}
			exit();
		}
	}
}