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
変更完了しました。<br>
<?php if(isset($msg)) echo $msg; ?>
<br>
<a href="/login">ここ</a>からログインできます。
</body>
</html>