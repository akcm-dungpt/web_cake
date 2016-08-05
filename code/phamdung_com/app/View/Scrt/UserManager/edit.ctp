<h1>会員情報詳細</h1>
<?php
echo $this->element('error_message');
?>
<div>
<center>
<table border="1" style="font-size: 15px; text-align: left;">
<form method="POST" name="user" action="/scrt/user_manager/edit_complete" />
	<tr>
		<td>ID</td>
		<td>
			<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['id'] : $validateReturn['Member']['id']); ?>
			<input type="hidden" name="data[Member][id]"
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['id'] : $validateReturn['Member']['id']); ?>" />
			<input type="hidden" name="data[Member][user_id]"
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['user_id'] : $validateReturn['Member']['user_id']); ?>" />
		</td>
	</tr>
	<tr>
		<td>パスワード</td>
		<td>
			<input type="text" name="data[Member][ps]"
			value="<?php if(isset($validateReturn)) echo $validateReturn['Member']['ps']; ?>" />
		</td>
	</tr>
	<tr>
		<td>ハンドルネーム</td>
		<td>
			<input type="text" name="data[Member][handle]" 
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['handle'] : $validateReturn['Member']['handle']); ?>">
		</td>
	</tr>
	<tr>
		<td>名前</td>
		<td>
			<input type="text" name="data[Member][usrname]" 
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['usrname'] : $validateReturn['Member']['usrname']); ?>">
		</td>
	</tr>
	<tr>
		<td>年齢</td>
		<td>
			<input type="text" name="data[Member][age]" 
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['age'] : $validateReturn['Member']['age']); ?>">
		</td>
	</tr>
	<tr>
		<td>性別</td>
		<td>
			<select name="data[Member][gender]">
				<?php if ($userInfo[0]['Member']['gender'] == 1 || $validateReturn['Member']['gender'] == 1): ?>
					<option value="1" selected="selected">男性</option>
					<option value="2">女性</option>
				<?php else: ?>
					<option value="1">男性</option>
					<option value="2" selected="selected">女性</option>
				<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>郵便番号</td>
		<td>
			<input type="text" name="data[Member][zip]" 
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['zip'] : $validateReturn['Member']['zip']); ?>">
		</td>
	</tr>
	<tr>
		<td>都道府県</td>
		<td>
			<select name="data[Member][pref]">
				<?php echo $optionSelect; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>属性</td>
		<td>
			<select name="data[Member][attribute]">
				<?php echo $optionAttribute; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>世帯収入</td>
		<td>
			<input type="text" name="data[Member][income]" 
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['income'] : $validateReturn['Member']['income']); ?>">
		</td>
	</tr>
	<tr>
		<td>掲示板情報配信</td>
		<td>
			<select name="data[Member][bbsmail]">
				<?php if ($userInfo[0]['Member']['bbsmail'] == 1 || $validateReturn['Member']['bbsmail'] == 1): ?>
					<option value="1" selected="selected">希望する</option>
					<option value="0">希望しない</option>
				<?php else: ?>
					<option value="1">希望する</option>
					<option value="0" selected="selected">希望しない</option>
				<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>施設情報配信</td>
		<td>
			<select name="data[Member][institution]">
				<?php if ($userInfo[0]['Member']['institution'] == 1 || $validateReturn['Member']['institution'] == 1): ?>
					<option value="1" selected="selected">希望する</option>
					<option value="0">希望しない</option>
				<?php else: ?>
					<option value="1">希望する</option>
					<option value="0" selected="selected">希望しない</option>
				<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>メールマガジン配信</td>
		<td>
			<select name="data[Member][mailmagazine]">
				<?php if ($userInfo[0]['Member']['mailmagazine'] == 1 || $validateReturn['Member']['mailmagazine'] == 1): ?>
					<option value="1" selected="selected">希望する</option>
					<option value="0">希望しない</option>
				<?php else: ?>
					<option value="1">希望する</option>
					<option value="0" selected="selected">希望しない</option>
				<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>アンケート配信</td>
		<td>
			<select name="data[Member][enquete]">
				<?php if ($userInfo[0]['Member']['enquete'] == 1 || $validateReturn['Member']['enquete'] == 1): ?>
					<option value="1" selected="selected">希望する</option>
					<option value="0">希望しない</option>
				<?php else: ?>
					<option value="1">希望する</option>
					<option value="0" selected="selected">希望しない</option>
				<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>フラグ</td>
		<td>
			<select name="data[Member][flag]">
				<?php if ($userInfo[0]['Member']['flag'] == 1 || $validateReturn['Member']['flag'] == 1): ?>
					<option value="1" selected="selected">希望する</option>
					<option value="0">希望しない</option>
				<?php else: ?>
					<option value="1">希望する</option>
					<option value="0" selected="selected">希望しない</option>
				<?php endif; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>登録日</td>
		<td>
			<input type="text" name="data[Member][entryDay]" 
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['entryDay'] : $validateReturn['Member']['entryDay']); ?>">
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
		    <input type="hidden" name="old_ps" value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['ps'] : $validateReturn['old_ps']); ?>">  
			<input type="submit" onclick='return confirm("データを変更します。\nよろしいですか？");' value="更新">
		</td>
	</tr>
</form>
	<tr>
		<td align="center" colspan="2">
			<form name="deleteUser" method="POST" action="/scrt/user_manager/delete_complete">
			<input type="submit" onclick='return confirm("データを削除します。\nよろしいですか？");' value="削除">
			<input type="hidden" name="user_id"
			value="<?php echo ((isset($userInfo)) ? $userInfo[0]['Member']['user_id'] : $validateReturn['Member']['user_id']); ?>" />
			</form>
		</td>
	</tr>
</table>
</center>
</div>