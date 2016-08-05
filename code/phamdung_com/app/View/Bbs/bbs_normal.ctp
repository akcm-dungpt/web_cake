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
<?php
if($flag_menu != 'not') {
    echo '<div style="position:fixed;">';
    include 'top_menu_bbs.ctp';
    echo "</div><br><br><br>";
}
?>
<div class="smallmain">
<table width="520">
<img src="/img/bbs/title_a.gif" width="520" height="60" border="0" alt="痴呆相談室（掲示板）"><br>
<img src="/img/bbs/navi_a.gif" width="510" height="32" border="0" usemap="#navi_abdecb9f8"><br><br>
<div style="width: 580px;"><br><?php echo $this->element('error_message'); ?></div>
<tr>
    <td>ようこそ <font color="green"><?php echo $info[0]['Member']['handle'] . "【" . $info[0]['ma']['attribute_name'] . "】"; ?></font>さん</td>
</tr>
</table>
<br>
<table width="520">
<tr>
<td><font color="green">■新規投稿</td><td><font color="green">返信は元の投稿の返信欄をご利用ください</td>
</tr>
<tr>
<td></td><td><font color="green">投稿ボタンは一度だけ押して下さい</font></td>
</tr>
</table>
<form action="/bbs/bbs_do" method="post">
<input type="hidden" name="name" value="<?php echo $info[0]['Member']['handle']; ?>">
<input type="hidden" name="mail" value="<?php echo $info[0]['Member']['mail']; ?>">
<input type="hidden" name="attribute" value="<?php echo $info[0]['Member']['attribute']; ?>">
<input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
<table>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><U>タイトル</U></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
        <input type="text" name="data[Bbs][title]" SIZE="50" value="<?php if(isset($validateReturn)) echo $validateReturn['Bbs']['title']; ?>">
    </td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><U>書き込み内容(タグは使えません。)</U></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><textarea name="data[Bbs][message]" rows="5" cols="50"><?php if(isset($validateReturn)) echo $validateReturn['Bbs']['message']; ?></textarea></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><input type="submit" value="投稿する">&nbsp;
    <?php if(!isset($validateReturn)): ?>
    <input type="reset" value="消去">
    <?php else: ?>
    <input type="button" value="消去" onclick="location.href='/bbs/bbs_normal/page:<?php echo $this->Paginator->counter("{:page}"); ?>'">
    <?php endif; ?>
    </td>
</tr>
</table>
</form>
<br>
<table width="520">
<tr>
<td>
<font color="green">■投稿一覧</font>
</td>
<td align="right">
<div style="font-size: 14px;">
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
    <td>
        <?php if($bbs['Bbs']['mail'] == $info[0]['Member']['mail']): ?>
        <form method="POST" action="/bbs/del_bbs_confirm">
           <input type="hidden" name="no" value="<?php echo $idBbs; ?>">
           <input type="hidden" name="name" value='<?php echo $bbs["Bbs"]["name"]; ?>'>
           <input type="hidden" name="mail" value='<?php echo $bbs["Bbs"]["mail"]; ?>'>
           <input type="hidden" name="title" value='<?php echo $bbs["Bbs"]["title"]; ?>'>
           <input type="hidden" name="message" value='<?php echo $bbs["Bbs"]["message"]; ?>'>
           <input type="hidden" name="attribute" value='<?php echo $bbs["ma"]["attribute_name"]; ?>'>
           <input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
           <input type="submit" value="削除" />
        </form>
        <?php endif; ?>
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
    <td align="right"><font color="black"><?php echo $this->Time->format('Y-m-d H:i', $bbs["Bbs"]["date"]); ?></font></td>
    </tr>
</table>

<?php if(count($threadById[$idBbs]) > 0): ?>
    <?php foreach($threadById[$idBbs] as $thread): ?>
        <hr color="darkgray" width="520px" align="left">
        <table width="520">
        <tr>
        <td width="40"></td>
        <td width="480"><font color="black">返信: <?php echo $thread["Thread"]["name"] . "【" . $thread["ma"]["attribute_name"] . "】"; ?></font></td>
        <td>
            <?php if($thread['Thread']['mail'] == $info[0]['Member']['mail']): ?>
            <form method="POST" action="/bbs/del_thread_confirm">
            <input type="hidden" name="no" value="<?php echo $thread['Thread']['threadNo']; ?>">
            <input type="hidden" name="name" value="<?php echo $thread['Thread']['name']; ?>">
            <input type="hidden" name="attribute" value="<?php echo $thread['ma']['attribute_name']; ?>">
            <input type="hidden" name="message" value="<?php echo $thread['Thread']['message']; ?>">
            <input type="hidden" name="mail" value="<?php echo $thread['Thread']['mail']; ?>">
            <input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
            <input type="submit" value="削除">
            </form>
            <?php endif; ?>
        </td>
        </tr>
        </table>
        
        <table width="520">
        <tr>
        <td width="40"></td>
        <td width="480"><font color="black"><?php echo nl2br(htmlspecialchars($thread["Thread"]["message"])); ?></font></td>
        <td>&nbsp;</td>
        </tr>
        </table>
        
        <table width="520">
        <tr>
        <td align="right"><font color="black"><?php echo $this->Time->format('Y-m-d H:i', $thread["Thread"]["date"]); ?></font></td>
        </tr>
        </table>
    <?php endforeach; ?>
<?php endif; ?>

<hr color="darkgray" width="520px" align="left">
<form action="/bbs/thread_do" method="POST">
<input type="hidden" name="data[Thread][no]" value="<?php echo $idBbs; ?>" />
<input type="hidden" name="data[Thread][title]" value="返信" />
<input type="hidden" name="data[Thread][name]" value="<?php echo $info[0]['Member']['handle']; ?>" />
<input type="hidden" name="data[Thread][mail]" value="<?php echo $info[0]['Member']['mail']; ?>" />
<input type="hidden" name="data[Thread][attribute]" value="<?php echo $info[0]['Member']['attribute']; ?>">
<input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
    <table width="520">
    <tr>
    <td align="right" valign="top">返信内容</td>
    <td><textarea name="data[Thread][message]" rows="5" cols="50"><?php if(isset($validateReturnThread[$idBbs])) echo $validateReturnThread[$idBbs]["Thread"]["message"]; ?></textarea></td>
    </tr>
    <tr>
    <td></td>
    <td><input type="submit" value="返信">&nbsp;<input type="reset" value="消去"></td>
    </tr>
    </table>
</form>
<!-- end foreach bbs -->
<?php endforeach; ?>
<hr size="4" noshade>
<!--/main-content-->
</div>
<div style="text-align: center; margin-bottom: 10px; font-size: 14px;">
    <?php echo $this->element('paginator'); ?>
</div>
<hr color="darkgray">
<font color="darkgray" size="1">認知症ねっとの記事、写真・カット等の著作権は、認知症ねっとに帰属しています。<br>
当サイトに、掲載されている情報は、著作者に無断で転載・複製等を行うことはできません。<br>
Copyright 2003 - <?php echo date('Y'); ?> Chihounet. All rights reserved.</font>
<map name="navi_abdecb9f8">
<area shape="rect" coords="358,6,504,25" href="/bbs/bbs_category">
<area shape="rect" coords="262,5,340,24" href="/logout/index/flag:bbs">
<area shape="rect" coords="137,5,245,24" href="/close/index/flag:bbs">
<area shape="rect" coords="6,6,114,25" href="/profile/index/flag:bbs">
</map>

</body>
</html>
