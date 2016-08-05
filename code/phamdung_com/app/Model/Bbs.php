<?php
/**
 * Bbs Model
 * @author Luvina
 * @access Public
 * @package Smscom
 *
 */
class Bbs extends AppModel{
	public $useTable = 'bbs';
	public $primaryKey = 'no';
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'タイトルを入力してください',
		),
		'message' => array(
			'rule' => 'notEmpty',
			'required' => true,
			'message' => 'メッセージを入力してください',
		)
	);
}
?>