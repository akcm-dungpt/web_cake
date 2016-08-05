<?php
App::uses('MemberController', 'Controller');
class EntryController extends MemberController {
	public $uses = array('Member');
	public $components = array('Email');
	/**
	 * Form create member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function index($data = NULL) {
		$this->set('title_for_layout', '||| 会員登録 | 認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ） |||');
		$this->set('pkz', $this->Pkz->_setPkz('/soudan/entry/index.html', '認知症相談室'));
		$this->set('pkz', $this->Pkz->_setPkz('', '会員登録'));
		// set flag left menu
		$this->set('flag_left', '会員登録');

		if (isset($data)) {
			$this->set('birthyear', $this->_createJYearSelect($data['birthyear']));
			$this->set('month', $this->_createMonthSelect($data['month']));
			$this->set('date', $this->_createDateSelect($data['date']));
			if ($data['pref1']) {
				$this->set('pref', $this->_createPrefectureSelect($data['pref1']));
			} elseif (isset($data['pref2'])) {
				$this->set('pref', $this->_createPrefectureSelect($data['pref2']));
			}
			$this->set('whichkn', $this->_createWhichknSelect($data['whichkn']));
		} else {
			$this->set('birthyear', $this->_createJYearSelect());
			$this->set('month', $this->_createMonthSelect());
			$this->set('date', $this->_createDateSelect());
			$this->set('pref', $this->_createPrefectureSelect());
			$this->set('whichkn', $this->_createWhichknSelect());
		}
		if (isset($data['question'])) {
			$this->set('questionCate', $this->_createQuestionCateCheckbox($data['question']));
		} else {
			$this->set('questionCate', $this->_createQuestionCateCheckbox());
		}
		if (isset($data['relation'])) {
			$this->set('relation', $this->_createRelationRadio($data['relation']));
		} else {
			$this->set('relation', $this->_createRelationRadio());
		}
		if (isset($data['age'])) {
			$this->set('age', $this->_createAgeRadio($data['age']));
		} else {
			$this->set('age', $this->_createAgeRadio());
		}
		if (isset($data['situation'])) {
			$this->set('situation', $this->_createSituationRadio($data['situation']));
		} else {
			$this->set('situation', $this->_createSituationRadio());
		}
		if (isset($data['care_degree'])) {
			$this->set('careDegree', $this->_createCareDegreeRadio($data['care_degree']));
		} else {
			$this->set('careDegree', $this->_createCareDegreeRadio());
		}
		if (isset($data['sikaku'])) {
			$this->set('sikaku1', $this->_createCheckboxSikaku(1, $data['sikaku']));
			$this->set('sikaku2', $this->_createCheckboxSikaku(2, $data['sikaku']));
			$this->set('sikaku3', $this->_createCheckboxSikaku(3, $data['sikaku']));
		} else {
			$this->set('sikaku1', $this->_createCheckboxSikaku(1));
			$this->set('sikaku2', $this->_createCheckboxSikaku(2));
			$this->set('sikaku3', $this->_createCheckboxSikaku(3));
		}
	}
	/**
	 * Confirm create member
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	public function confirm() {
		$data = $this->request->data['Member'];
		$this->Member->set($this->request->data);
		// start update rule validate
		$this->Member->validate = array();
		$this->Member->validate['handle'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'ハンドルネームを入力して下さい',
		);
		$this->Member->validate['usrmail'] = array(
			'checkNull' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'メールアドレスを入力してください。'
			),
			'checkEmail' => array(
				'rule' => array('email', true),
				'message' => 'メールアドレスがおかしいようです'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'このメールアドレスは登録済みです',
			),
		);
		$this->Member->validate['ps'] = array(
			'null' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'パスワードを入力して下さい',
			),
			'type' => array(
				'rule' => 'alphaNumeric',
				'message' => 'パスワードは英数字で入力して下さい'
			),
			'lenght' => array(
				'rule' => array('between', 4, 12),
				'message' => 'パスワードは半角4文字以上12文字以内で入力して下さい',
			),
		);
		$this->Member->validate['attributePlan'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '属性を選択して下さい',
		);
		$this->Member->validate['birthyear'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '生まれた年を入力して下さい',
		);
		$this->Member->validate['month'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '誕生日の月を選択して下さい',
		);
		$this->Member->validate['date'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '誕生日の日を選択して下さい',
		);
		$this->Member->validate['sex'] = array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '性別を選択して下さい',
		);
		if ($data['attributePlan'] == 1) {
			$this->Member->validate['pref1'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '都道府県を選択して下さい',
			);
			$this->Member->validate['relation'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '続柄を選択して下さい',
			);
			$this->Member->validate['age'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '介護対象者の年齢を選択して下さい',
			);
			$this->Member->validate['situation'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '介護状況を選択して下さい',
			);
			$this->Member->validate['care_degree'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '要介護度を選択して下さい',
			);
			$this->Member->validate['ninchi'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '認知症を選択して下さい',
			);
		} elseif ($data['attributePlan'] == 2) {
			$this->Member->validate['pref2'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '都道府県を選択して下さい',
			);
			$this->Member->validate['address1'] = array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '市区町村番地を入力して下さい',
			);
			$this->Member->validate['zipcode_2'] = array(
				'rule' => 'numeric',
				'required' => true,
				'message' => '郵便番号は半角数字で入力して下さい',
			);
			$this->Member->validate['zipcode_3'] = array(
				'rule' => 'numeric',
				'required' => true,
				'message' => '郵便番号は半角数字で入力して下さい',
			);
			if ((!isset($data['sikaku']) || $data['sikaku'] == "") && $data['sikakuetc1'] == "" &&
				$data['sikakuetc2'] == "" && $data['sikakuetc3'] == "" && $data['sikakuetc4'] == ""
			) {
				$msgErr['sikaku'] = array('資格を選択して下さい');
			}
		}
		if ($data['usrmail'] != $data['usrmail2']) {
			$msgErr['usrmail2'] = array('入力したメールアドレスと再入力した<br>メールアドレスが一致しません。');
		}

		// end update rule validate
		if ($this->Member->validates()) {
			// validate plus
			if (isset($msgErr)) {
				$this->set('returnData', $data);
				$this->set('validationErrorsArray', array($msgErr));
				$this->setAction('index', $data);
				$this->render('/Entry/index');
			}
			// make data
			$data['income_val'] = "";
			if ($data['mailmagazine'] == 0) {
				$data['mailmagazine_text'] = "希望しない";
			} else {
				$data['mailmagazine_text'] = "希望する";
			}
			if ($data['attributePlan'] == 1) {
				$data['attributePlan_text'] = "ご家族の介護に関わっている方";
				$data['attribute'] = 10;
			} else {
				$data['attributePlan_text'] = "専門家その他";
				$data['attribute'] = 11;
			}
			if ($data['sex'] == 1) {
				$data['sex_text'] = "男";
			} else {
				$data['sex_text'] = "女";
			}
			if (isset($data['ninchi']) && $data['ninchi'] == 1) {
				$data['ninchi_text'] = "有";
			} elseif (isset($data['ninchi']) && $data['ninchi'] == 2) {
				$data['ninchi_text'] = "無";
			} else {
				$data['ninchi_text'] = "わからない";
			}
			// end make data
			if ($data['attributePlan'] == 1) {
				$this->loadModel('Prefecture');
				$prefInfo = $this->Prefecture->findById($data['pref1']);
				$data['pref1_name'] = $prefInfo['Prefecture']['prefecture_name'];
				$this->set('data', $data);
				
				$this->render('/Entry/confirm1', '');
			} elseif ($data['attributePlan'] == 2) {
				$this->loadModel('Prefecture');
				$prefInfo = $this->Prefecture->findById($data['pref2']);
				$data['pref2_name'] = $prefInfo['Prefecture']['prefecture_name'];
				$this->set('data', $data);
				
				$this->render('/Entry/confirm2', '');
			}
		} else {
			$this->set('returnData', $data);
			$msgReturn = $this->Member->invalidFields();
			if (isset($msgErr)) {
				$msgReturn = array_merge($msgErr, $msgReturn);
			}
			$this->set('validationErrorsArray', $msgReturn);
			$this->setAction('index', $data);
			$this->render('/Entry/index');
		}
	}
	/**
	 * Insert data to DB
	 * @author Luvina
	 * @access public
	 * @package Smscom
	 *
	 */
	function create() {
		//make member no
		function _createMemberNo() {
			$char = $numeric = "";
			for ($i = 0; $i < 4; $i++) {
				$numeric .= rand(0, 9);
				$alpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$char .= $alpha[rand(0, strlen($alpha - 1))];
			}
			$no = $char . $numeric;
			return $no;
		}
		$flag = 0;
		while ($flag == 0) {
			$no = _createMemberNo();
			$check = $this->Member->findByNo($no);
			if (!$check) $flag++;
		}
		$data = $this->request->data;
		$checkId = $this->Member->findById($data['usrmail']);
		if (isset($checkId) && is_array($checkId) && count($checkId) > 0) {
			$this->redirect('/entry/complete/');
		}
		if ($data['usrmail'] == "" || $data['usrname'] == "") {
			$this->redirect('/soudan/entry/index.html');
		}
		$this->Member->validate = array();
		$this->Member->create();
		$this->Member->set('no', $no);
		$this->Member->set('id', $data['usrmail']);
		$this->Member->set('ps', sha1($data['ps']));
		$this->Member->set('handle', $data['handle']);
		$this->Member->set('mail', $data['usrmail']);
		$this->Member->set('usrmail', $data['usrmail']);
		$this->Member->set('usrname', $data['usrname']);
		$this->Member->set('age', $data['age']);
		$this->Member->set('gender', $data['gender']);
		$this->Member->set('zip', $data['zip']);
		$this->Member->set('pref', $data['pref']);
		$this->Member->set('attribute', $data['attribute']);
		$this->Member->set('income', 0);
		$this->Member->set('bbsmail', $data['bbsmail']);
		$this->Member->set('institution', $data['institution']);
		$this->Member->set('mailmagazine', $data['mailmagazine']);
		$this->Member->set('enquete', $data['enquete']);
		$this->Member->set('attributePlan', $data['attributePlan']);
		$this->Member->set('attributePlan_val', $data['attributePlan_val']);
		$this->Member->set('birthyear', $data['birthyear']);
		$this->Member->set('month', $data['month']);
		$this->Member->set('date', $data['date']);
		$this->Member->set('sex_val', $data['sex']);
		if ($data['attributePlan_val'] == 2) {
			$this->Member->set('zipcode_2', $data['zipcode_2']);
			$this->Member->set('zipcode_3', $data['zipcode_3']);
			$this->Member->set('pref2', $data['pref2']);
			$this->Member->set('address1', $data['address1']);
			$this->Member->set('address2', $data['address2']);
			$this->Member->set('sikaku', $data['sikaku']);
			$this->Member->set('sikakuetc1', $data['sikakuetc1']);
			$this->Member->set('sikakuetc2', $data['sikakuetc2']);
			$this->Member->set('sikakuetc3', $data['sikakuetc3']);
			$this->Member->set('sikakuetc4', $data['sikakuetc4']);
		} elseif ($data['attributePlan_val'] == 1) {
			$this->Member->set('pref1', $data['pref1']);
			$this->Member->set('whichkn', $data['whichkn']);
			$this->Member->set('question', $data['question']);
			$this->Member->set('relation', $data['relation']);
			$this->Member->set('age_val', $data['age_val']);
			$this->Member->set('situation', $data['situation']);
			$this->Member->set('care_degree', $data['care_degree']);
			$this->Member->set('ninchi', $data['ninchi']);
			$this->Member->set('disease_name', $data['disease_name']);
		}
		$this->Member->set('r_flag', 1);
		$this->Member->set('flag', 1);
		$this->Member->set('entryDay', date('Y-m-d'));
		$this->Member->save();
		//send mail
		$content = "会員登録頂き、ありがとうございます。
あなたのIDは下記の通りです。

ユーザーID：" . $data['usrmail'] . "

" . FULL_BASE_URL ." ／ http://www.ninchisho.net

" . Configure::read('mail_from');
		
		$this->Email->from = Configure::read('mail_from');
		$this->Email->to = $data['usrmail'];
		$this->Email->subject = '【認知症ねっと】会員登録完了通知';
		$this->Email->send($content);
		
		$this->redirect('/entry/complete/');
	}
	public function complete() {
		$this->layout = "";
	}
}