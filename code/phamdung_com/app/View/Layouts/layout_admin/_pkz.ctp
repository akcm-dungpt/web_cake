<div id="pkz">
<?php
if (isset($pkz)) {
	foreach ($pkz as $key => $val) {
		if ($key > 0) {
			echo "&nbsp;&gt;&nbsp;";
		}
		if($val['url'] != "") {
			echo "<a href='" . $val['url'] . "'>" . $val['name'] . "</a>";
		} else {
			echo $val['name'];
		}
	}
}
?>
</div>
