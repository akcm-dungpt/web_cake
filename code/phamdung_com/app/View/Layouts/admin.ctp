<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="/favi.ico" type="image/x-icon" rel="icon" />
<link href="/favi.ico" type="image/x-icon" rel="shortcut icon" />
<title><?php echo $title_for_layout; ?></title>
<?php
	echo $this->Html->css('admin/style');
	echo $this->Html->css('admin/page');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
</head>
<body>
<!-- wrapper -->
<div id="wrapper">
<!--header-->
<?php include 'layout_admin/_header.ctp'; ?>
<!-- gmenu/pkz -->
<div id="navi">
<?php
	if($this->here != '/scrt/login/' && $this->here != '/scrt/login' && $this->here != '/scrt/login/do') {
		include 'layout_admin/_gmenu.ctp';
		if ($this->here != '/scrt' && $this->here != '/scrt/') {
			include 'layout_admin/_pkz.ctp';
		}
	}
?>
</div>
<br clear="all" />


<div>
<!-- smenu -->
<?php
	if(isset($smenu)) {
		include $smenu;
	}
?>
<!--/smenu -->
<div id="main">
<?php echo $this->fetch('content'); ?>
</div>
</div>

<br clear="all" />
<!-- footer -->
<?php include 'layout_admin/_footer.ctp'; ?>
</div>
</body>
</html>
