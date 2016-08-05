<h1>会員情報一覧</h1>
<div style="text-align: center; margin-bottom: 10px; font-size: 14px;">
    <?php 
    if ($this->Paginator->current() != 1) {
	    echo $this->Paginator->prev(
	    	__('前の10件', true),
	    	array('url' => array('controller' => 'scrt', 'action' => 'user_manager')),
	    	null,
	    	array('class'=>'disabled')
		);
	}
	echo " ";
	$totalPage = $this->Paginator->counter(array('format' => __('{:pages}', true)));
	if ($this->Paginator->current() != $totalPage) {
		echo $this->Paginator->next(
			__('次の10件', true),
			array('url' => array('controller' => 'scrt', 'action' => 'user_manager')),
			null,
			array('class' => 'disabled')
		);
	}
	?>
</div>
<div>
	<center>
	<table border="1" style="font-size: 14px; text-align:left;">
		<tr>
			<td>詳細</td>
			<td>ID</td>
			<td>パスワード</td>
			<td>ハンドルネーム</td>
			<td>属性</td>
			<td>登録日</td>
		</tr>
		<?php foreach ($listMember as $member): ?>
		<tr>
			<td><a href="<? echo FULL_BASE_URL . '/scrt/user_manager/edit/user_id:' . $member['Member']['user_id']; ?>">＞</a></td>
			<td><? echo $member['Member']['id']; ?></td>
			<td><? echo $member['Member']['ps']; ?></td>
			<td><? echo $member['Member']['handle']; ?></td>
			<td><? echo $member['ma']['attribute_name']; ?></td>
			<td><? echo $member['Member']['entryDay']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
