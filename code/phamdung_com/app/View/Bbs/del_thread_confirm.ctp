<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>||| 認知症相談室（掲示板） | 認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ） |||</title>
<style type="text/css">
body {
    margin-left: 20px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
</style>
<?php
    echo $this->Html->css('popup');
    echo $this->fetch('css');
?>
<div style="position:fixed;">
<?php if($data['flag_menu'] != 'not') include 'top_menu_bbs.ctp'; ?>
</div><br><br><br>
</head>
<body>
<div class="smallmain">
<img src="/img/admin/title.gif" width="521" height="61" border="0" alt="痴呆相談室（掲示板）" style="margin-left: 10px;">
<br>
<br>
<FONT SIZE="3" COLOR="black"><b>削除フォーム</b></FONT>
<br>
<table width="520">
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>記事: NO.<?php echo $data['no']; ?>を削除します。<br></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>題名:返信  名前: <?php echo $data['name'] ?>【<?php echo $data['attribute']; ?>】</td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php echo nl2br(htmlspecialchars($data['message'])); ?></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
        <form action="/bbs/del_thread_do" method="POST">
            <input type="hidden" name="no" value="<?php echo $data['no']; ?>">
            <input type="hidden" name="page" value="<?php echo $data['page']; ?>">
            <input type="hidden" name="mail" value="<?php echo $data['mail']; ?>">
            <input type="hidden" name="flag_menu" value="<?php echo $data['flag_menu']; ?>">
            <input type="submit" VALUE="削除">
        </form>
    </td>
</tr>
</table>
</div>

</body>
</html>