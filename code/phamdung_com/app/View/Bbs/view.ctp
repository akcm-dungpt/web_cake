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
</head>
<body>
<div style="position:fixed;">
<?php include 'top_menu_bbs.ctp'; ?>
</div>
<br><br><br>
<div class="smallmain">
<table width="520">
<tr><td>
<img src="/img/bbs/title_out.gif" width="520" height="60" border="0" alt="痴呆相談室（掲示板）">
</td></tr>
</table>
<br>
<table width="520">
<tr>
<td>
<font color="green">■投稿一覧</font>
</td>
<td align="right">
<div style="text-align: right; font-size: 14px;">
    <?php echo $this->element('paginator'); ?>
</div>
</td>
</tr>
</table>
<!-- start foreach bbs -->
<?php foreach ($listBbs as $bbs): ?>
<?php $idBbs = $bbs["Bbs"]["no"]; ?>
<hr size="4" color="darkgray" width="520px" align="left">
<table width="520">
    <tr>
    <td>
        <font color="green">［<?php echo $idBbs; ?>］題名: <?php echo htmlspecialchars($bbs["Bbs"]["title"]); ?> 　名前: <?php echo $bbs["Bbs"]["name"] . "【" . $bbs["ma"]["attribute_name"] . "】"; ?></font>
    </td>
    </tr>
</table>

<table width="520">
    <tr>
    <td width="20"></td>
    <td width="500"><font color="green"><?php echo nl2br(htmlspecialchars($bbs["Bbs"]["message"])); ?></font></td>
    </tr>
    </table>
    <table width="520">
    <tr>
    <td align="right"><font color="darkgray"><?php echo $this->Time->format('Y-m-d H:i', $bbs["Bbs"]["date"]); ?></font></td>
    </tr>
</table>

<?php if(count($threadById[$idBbs]) > 0): ?>
    <?php foreach($threadById[$idBbs] as $thread): ?>
        <hr color="darkgray" width="520px" align="left">
        <table width="520">
        <tr>
        <td width="40"></td>
        <td width="480"><font color="gray">返信: <?php echo $thread["Thread"]["name"] . "【" . $thread["ma"]["attribute_name"] . "】"; ?></font></td>
        </tr>
        </table>
        
        <table width="520">
        <tr>
        <td width="40"></td>
        <td width="480"><font color="gray"><?php echo nl2br(htmlspecialchars($thread["Thread"]["message"])); ?></font></td>
        <td>&nbsp;</td>
        </tr>
        </table>
        
        <table width="520">
        <tr>
        <td align="right"><font color="gray"><?php echo $this->Time->format('Y-m-d H:i', $thread["Thread"]["date"]); ?></font></td>
        </tr>
        </table>
    <?php endforeach; ?>
<?php endif; ?>

<!-- end foreach bbs -->
<?php endforeach; ?>
<hr size="4" noshade>
<!--/main-content-->
</div>
<div style="text-align: center; margin-bottom: 10px; font-size: 14px;">
    <?php echo $this->element('paginator'); ?>
</div>
<hr color="darkgray">
    <font color="darkgray" size="1">Copyright(C) SMS Co.,Ltd. All Rights Reserved.<br>
    認知症ねっと内の記事・写真・イラストなど、すべてのコンテンツの無断複写・転載・公衆送信を禁じます。</font>
</body>
</html>
