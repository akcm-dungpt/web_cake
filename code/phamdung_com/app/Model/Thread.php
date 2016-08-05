<?php
/**
 * Thread Model
 * @author Luvina
 * @access Public
 * @package Smscom
 *
 */
class Thread extends AppModel{
	public $useTable = 'thread';
	public $primaryKey = 'threadNo';
	public $validate = array(
			'message' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'メッセージを入力してください',
			),
			'name' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => '名前を入力してください',
			),
			'title' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'タイトルを入力してください',
			),
	);
}
?>