<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $title_for_layout; ?></title>
<link href="/favi.ico" type="image/x-icon" rel="icon" />
<link href="/favi.ico" type="image/x-icon" rel="shortcut icon" />
<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
<?php
	echo $this->Html->meta('keywords', '認知症,認知,痴呆症,痴呆,介護,介護保険制度,介護保険,介護施設,相談');
	echo $this->Html->meta('description', '認知症（旧痴呆症）の基本情報、高齢者介護のコツなどを掲載。認知症患者や認知症介護家族と介護関係者（ヘルパーやケアマネージャーなど）が、意見を交換する掲示板「認知症相談室」を公開しています。');
	echo $this->Html->css('style');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>
<body>
<table width="816" border="0" cellspacing="0" cellpadding="0">
<tr>
	<?php if (!isset($actionName) || $actionName != 'top_index'): ?>
	<td width="801" valign="top" background="/img/haikei_2.gif">
	<?php else: ?>
	<td width="801" valign="top" background="img/top/haikei_2.gif">
	<?php endif; ?>
		<?php include 'layout_user/_header.ctp'; ?>
		<?php include 'layout_user/_global_menu.ctp'; ?>
      	<?php include 'layout_user/_pkz.ctp'; ?>
		<?php echo $this->fetch('content'); ?>
	</td>
	<td width="15" valign="top" background="../../img/shadow.gif"><img src="../../img/shadow.gif" width="15" height="180" alt=""></td>
</tr>
<tr>
<td valign="top" background="../../img/top/haikei_2.gif">
	<?php include 'layout_user/_footer.ctp'; ?>
</td>
<td valign="top" background="../../img/shadow.gif">&nbsp;</td>
</tr>
</table>

</body>
</html>

