<html>
<head>
<title>痴呆相談室</title>
</head>
<body>
<br>
<?php if(isset($no)): ?>

<?php foreach($bbs as $detail) : ?>
	<table width="741">
		<tr>
			<td>
			<a name="#<?php echo $detail['Bbs']['no']; ?>">
			<font color="green">［<?php echo $detail['Bbs']['no']; ?>］題名: <?php echo $detail['Bbs']['title']; ?>　名前: </a><?php echo $detail['Bbs']['name']; ?>【<?php echo $detail['ma']['attribute_name']; ?>】</font>
			</td>
			<?php if ($info[0]['Member']['mail'] == $detail['Bbs']['id']): ?>
				<td>
				<form method="POST" action="/bbs/del_bbs_confirm">
				<input type="hidden" name="no" value="<?php echo $detail['Bbs']['no']; ?>">
				<input type="hidden" name="name" value='<?php echo $detail['Bbs']['name']; ?>'>
				<input type="hidden" name="mail" value='<?php echo $detail['Bbs']['mail']; ?>'>
				<input type="hidden" name="title" value='<?php echo $detail['Bbs']['title']; ?>'>
				<input type="hidden" name="message" value='<?php echo $detail['Bbs']['message']; ?>'>
				<input type="hidden" name="attribute" value='<?php echo $detail['ma']['attribute_name']; ?>'>
				<input type="hidden" name="flag_menu" value="not">
				<input type="submit" value="削除" />
				</form>
				<td>
			<?php else: ?>
				<td>&nbsp;</td>
			<?php endif; ?>
		</tr>
	</table>
	<table width="741">
		<tr>
			<td width="20"></td>
			<td width="500"><font color="green"><?php echo nl2br(htmlspecialchars($detail['Bbs']['message'])); ?></font></td>
		</tr>
	</table>
	<table width="741">
		<tr>
			<td align="right"><font color="black"><?php echo $this->Time->format('Y-m-d H:i', $detail['Bbs']['date']); ?></font></td>
		</tr>
	</table>
	<?php foreach($listThread as $thread): ?>
		<hr align="left" color="darkgray" width="741">
		<table width="741">
			<tr>
				<td width="40"></td>
				<td width="580"><font color="black">返信: <?php echo $thread['Thread']['name']; ?>【<?php echo $thread['ma']['attribute_name']; ?>】</font></td>
				<?php if($thread['Thread']['id'] == $info[0]['Member']['mail']): ?>
					<td>
					<form method="POST" action="/bbs/del_thread_confirm">
		            <input type="hidden" name="no" value="<?php echo $thread['Thread']['threadNo']; ?>">
		            <input type="hidden" name="name" value="<?php echo $thread['Thread']['name']; ?>">
		            <input type="hidden" name="attribute" value="<?php echo $thread['ma']['attribute_name']; ?>">
		            <input type="hidden" name="message" value="<?php echo $thread['Thread']['message']; ?>">
		            <input type="hidden" name="mail" value="<?php echo $thread['Thread']['mail']; ?>">
		            <input type="hidden" name="flag_menu" value="not">
		            <input type="submit" value="削除">
		        	</form>
		        	</td>
				<?php else: ?>
					<td>&nbsp;</td>
				<?php endif; ?>
			</tr>
		</table>
		<table width="741">
			<tr>
				<td width="40"></td>
				<td width="580"><font color="black"><?php echo nl2br(htmlspecialchars($thread['Thread']['message'])); ?></font></td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table width="741">
			<tr>
				<td align="right"><font color="black"><?php echo $this->Time->format('Y-m-d H:i', $thread['Thread']['date']); ?></font></td>
			</tr>
		</table>
	<?php endforeach; ?>
	<hr align="left" color="darkgray" width="741">
	<table width="741">
		<form action="/bbs/thread_do" method="POST">
		<input type="hidden" name="data[Thread][no]" value="<?php echo $detail['Bbs']['no']; ?>" />
		<input type="hidden" name="data[Thread][title]" value="返信" />
		<input type="hidden" name="data[Thread][name]" value="<?php echo $info[0]['Member']['handle']; ?>" />
		<input type="hidden" name="data[Thread][mail]" value="<?php echo $info[0]['Member']['mail']; ?>" />
		<input type="hidden" name="data[Thread][attribute]" value="<?php echo $info[0]['Member']['attribute']; ?>">
		<input type="hidden" name="flag_menu" value="not">
		<tr>
			<td align="right" valign="top">返信内容</td>
			<td><textarea name="data[Thread][message]" rows="5" cols="50"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="返信">&nbsp;<input type="reset" value="消去"></form></td>
		</tr>
	</table>
<?php endforeach; ?>


<hr color="darkgray">
<font color="darkgray" size="1">認知症ねっとの記事、写真・カット等の著作権は、認知症ねっとに帰属しています。<br>
当サイトに、掲載されている情報は、著作者に無断で転載・複製等を行うことはできません。<br>
Copyright 2003 - <?php echo date('Y'); ?> Chihounet. All rights reserved.</font>

<?php
	// else (isset $no)
	else:
?>
	<div style="margin-left: 180px; margin-top: 60px;">
	上記題名をクリックしてください。<br>ここに本文が表示されます。 
	</div>
<?php endif; ?>
</body>
</html>
