<html>
<head>
<title>痴呆相談室</title>
</head>
<body bgcolor="#ffffff" topmargin="3" marginheight="3" leftmargin="3" marginwidth="3">
<img src="/img/titlebar.gif" width="741" height="53" border="0" alt="痴呆ねっと" usemap="#titlebarbb5d7576"><map name="titlebarbb5d7576"><area shape="rect" coords="556,21,632,42" href='mailto:info@ninchisho.net'><area shape="rect" coords="641,21,724,42" href="/sitemap.html" target="_top"></map>
<br>

<table width="741">
<tr>
<td>■<?php if(isset($cateName)) echo $cateName; ?>に関する書き込み&nbsp;<?php echo $totalBbs; ?>件</td>
<td align="right">
	<?php echo $this->element('paginator'); ?>
</td>
</tr>
</table>

<table width="741">
<?php foreach($listBbs as $bbs): ?>
<tr>
	<td>
		<a href="/bbs/lower/c_no:<?php if(isset($c_no)) echo $c_no; ?>/no:<?php echo $bbs['Bbs']['no']; ?>" target="lower">
		題名: <?php echo $bbs['Bbs']['title']; ?>　名前: <?php echo $bbs['Bbs']['name']; ?>【<?php echo $bbs['ma']['attribute_name']; ?>】</a>
	</td>
</tr>
<?php endforeach; ?>
</table>

<table width="741">
<tr>
<td></td>
<td align="right">
	<?php echo $this->element('paginator'); ?>
</td>
</tr>
</table>
</body>
</html>
