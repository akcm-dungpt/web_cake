<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>||| 認知症相談室（掲示板） | 認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ） |||</title>
<?php
    echo $this->Html->css('popup');
    echo $this->fetch('css');
?>
<style type="text/css">
body {
    margin-left: 20px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
</style>
</head>
<body>
<div style="position:fixed;">
<?php include 'top_menu_bbs.ctp'; ?>
</div>
<br><br><br>
<img src="/img/bbs/title_b.gif" width="520" height="60" border="0" alt="痴呆相談室（掲示板）"><br>
<img src="/img/bbs/navi_b.gif" width="510" height="32" border="0" usemap="#navi_abdecb9f8"><br>
<?php echo $this->element('error_message'); ?>
<table width="520">
<tr>
    <td>ようこそ <font color="green"><?php echo $info[0]['Member']['handle'] . "【" . $info[0]['ma']['attribute_name'] . "】"; ?></font>さん</td>
</tr>
</table>
<font size="1"><br>
</font><font size="2">閲覧をご希望のカテゴリーを押して下さい。<br>
通常掲示板の書き込みの中から該当する物が表示されます。</font><br>
<hr align="left" noshade size="1" width="520">
<font size="3" color="green"><b>《　認知症と医療　》</b></font><br>
<table width="525">
<?php
	$count = 1;
	foreach($cateGroup1 as $cate):
    if($count % 2 == 1) echo "<tr>"; 
?>
	<?php if($cate['name'] != "全書き込み"): ?>
	<td width="50%"><font size="3"><a href="/bbs/frame/c_no:<?php echo $cate['no']; ?>" target="_blank"><?php echo $cate['name']; ?></a></font>
	<font size="2">［<?php echo $cate['total']; ?>件］</font></td>
	<?php else: ?>
	<td><?php echo $cate['name']; ?>（<?php echo $cate['total']; ?>件）</td>
	<?php endif; ?>
<?php
    if($count %2 == 0) echo "</tr>";
    $count++;
    endforeach;
?>
</table>
<br>
<hr align="left" noshade size="1" width="520">
<font size="3" color="green"><b>《　認知症の症状とその対応　》</b></font><br>
<table width="525">
<?php
	$count = 1;
	foreach($cateGroup2 as $cate):
    if($count % 2 == 1) echo "<tr>"; 
?>
	<td width="50%"><font size="3"><a href="/bbs/frame/c_no:<?php echo $cate['no']; ?>" target="_blank"><?php echo $cate['name']; ?></a></font>
	<font size="2">［<?php echo $cate['total']; ?>件］</font></td>
<?php
    if($count %2 == 0) echo "</tr>";
    $count++;
    endforeach;
?>
</table>
<br>
<hr align="left" noshade size="1" width="520">
<font size="3" color="green"><b>《　痴呆と介護（保険）　》</b></font><br>
<table width="525">
<?php
	$count = 1;
	foreach($cateGroup3 as $cate):
    if($count % 2 == 1) echo "<tr>"; 
?>
	<td width="50%"><font size="3"><a href="/bbs/frame/c_no:<?php echo $cate['no']; ?>" target="_blank"><?php echo $cate['name']; ?></a></font>
	<font size="2">［<?php echo $cate['total']; ?>件］</font></td>
<?php
    if($count %2 == 0) echo "</tr>";
    $count++;
    endforeach;
?>
</table>
<hr color="darkgray">
<font color="darkgray" size="1">認知症ねっとの記事、写真・カット等の著作権は、認知症ねっとに帰属しています。<br>
	当サイトに、掲載されている情報は、著作者に無断で転載・複製等を行うことはできません。<br>
	Copyright 2003 - <?php echo date('Y'); ?> Chihounet. All rights reserved.</font>


<map name="navi_abdecb9f8">
<area shape="rect" coords="358,6,504,25" href="/bbs/bbs_normal">
<area shape="rect" coords="262,5,340,24" href="/logout/index/flag:bbs">
<area shape="rect" coords="137,5,245,24" href="/close/index/flag:bbs">
<area shape="rect" coords="6,6,114,25" href="/profile/index/flag:bbs">
</map>
</body>
</html>