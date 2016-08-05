<?php
define('MSG', '登録日は「' . date('Y-m-d') . '」のように入力して下さい');
/**
 * Member Model
 * @author Luvina
 * @access Public
 * @package Smscom
 *
 */
class Member extends AppModel{	
	public $useTable = 'member';
	public $primaryKey = 'user_id';
	public $validate = array(
		'ps' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'パスワードを入力して下さい',
		),
		'handle' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'ハンドルネームを入力して下さい',
		),
		'usrname' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '名前を入力して下さい',
		),
		'age' => array(
			'checkNull' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '年齢を入力して下さい',
			),
			'checkNumeric' => array(
				'rule' => 'numeric',
				'message' => '年齢は半角数字で入力して下さい',
			),
			'negative' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => '年齢は半角数字で入力して下さい'
			)
		),
		'zip' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => '郵便番号を入力して下さい',
		),
		'pref' => array(
			'rule' => array('comparison', '>', 0),
			'required' => true,
			'message' => '都道府県を選択して下さい',
		),
		'attribute' => array(
			'rule' => array('comparison', '>', 0),
			'required' => true,
			'message' => '属性を選択して下さい',
		),
		'income' => array(
			'checkNumeric' => array(
				'rule' => 'numeric',
				'message' => '世帯収入は数字で入力してください',
			),
			'negative' => array(
				'rule' => array('comparison', '>=', 0),
				'message' => '世帯収入は数字で入力してください',
			)
		),
		'entryDay' => array(
			'checkNull' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '登録日を入力して下さい',
			),
			'formatDate' => array(
				'rule' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
				'message' => MSG,
			),
			'date' => array(
				'rule' => array('date', 'ymd'),
				'message' => MSG,
			)
		),
	);
}
?>