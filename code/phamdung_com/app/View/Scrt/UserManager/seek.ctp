<h1>会員情報一覧</h1>
<div style="text-align: center;">
	<center>
	<?php if (count($listMember) > 0): ?>
		<table border="1" style="font-size: 13px;">
			<tr>
				<td>詳細</td>
				<td>ユーザーID</td>
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
	<?php else: ?>
		<?php echo "<a style='font-size: 16px;'>見付かりませんでした。</a>"; ?>
	<?php endif; ?>
	</center>
</div>