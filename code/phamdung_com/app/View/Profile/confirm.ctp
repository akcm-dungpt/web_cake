<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>痴呆相談室</title>
</head>
<body>
<?php
if (isset($bbsMenu)) {
	echo '<div style="padding-left: 20px; background-color:#FFFFFF;">';
    include ROOT . '/app/View/Bbs/top_menu_bbs.ctp';
    echo '</div>';
}
?>
<img src="/soudan/img/title.gif" width="521" height="61" border="0" alt="会員登録"><br>
<br>
<br>
ハンドルネーム：<?php echo $data['handle']; ?><br>
メールアドレス：<?php echo $data['id']; ?><br>
<?php if($data['ps'] != ""): ?>
パスワード：<?php echo $data['ps']; ?><br>
<?php endif; ?>
メルマガ配信：<?php echo $data['mailmagazine_text']; ?><br>
<form action="/profile/update" method="post">
<input type="hidden" name="no" value="<?php echo $data['no']; ?>">
<input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
<input type="hidden" name="handle" value="<?php echo $data['handle']; ?>">
<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
<input type="hidden" name="oldID" value="<?php echo $data['oldID']; ?>">
<input type="hidden" name="ps" value="<?php echo $data['ps']; ?>">
<input type="hidden" name="mailmagazine" value="<?php echo $data['mailmagazine']; ?>">
<input type="submit" value="送信">
<?php if(isset($bbsMenu)): ?>
<input type="hidden" name="flag" value="bbs">
<?php endif; ?>
</form>
</body>
</html>
