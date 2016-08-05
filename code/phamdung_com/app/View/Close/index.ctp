<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>||| 認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ） |||</title>
<meta name="keywords" content="認知症,認知,痴呆症,痴呆,介護,介護保険制度,介護保険,介護施設,相談">
<meta name="description" content="認知症（旧痴呆症）の基本情報、高齢者介護のコツなどを掲載。認知症患者や認知症介護家族と介護関係者（ヘルパーやケアマネージャーなど）が、意見を交換する掲示板「認知症相談室」を公開しています。">
<style type="text/css">
body {
    background-image: url(/img/haikei.gif);
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
</style>
<?php
    echo $this->Html->css('style');
    echo $this->fetch('css');
?>
</head>
<body>
<?php
if (isset($bbsMenu)) {
    echo '<div style="padding-left: 20px; background-color:#FFFFFF;">';
    include ROOT . '/app/View/Bbs/top_menu_bbs.ctp';
    echo '</div>';
}
?>
<table width="350" border="0" cellpadding="20" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
        <td bgcolor="#FFFFFF">
        <?php echo $this->element('error_message'); ?>
                    退会するにはユーザーIDとパスワードを入力し「OK」ボタンクリックして下さい。<br>
        <br>
        <form action="/close/process" method="post">
                    ユーザーID：
        <input type="text" name="id" value="<?php if(isset($returnData)) echo $returnData['id']; ?>">
        <br>
                    パスワード：
        <input type="password" name="ps" value="<?php if(isset($returnData)) echo $returnData['ps']; ?>">
        <br>
        <?php if(isset($bbsMenu)): ?>
        <input type="hidden" name="flag" value="bbs">
        <?php endif; ?>
        <input type="submit" value="OK">
        </form>
        </td>
    </tr>
</table>
</body>
</html>