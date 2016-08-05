<?php
if (isset($pkz)) {
	echo '<span class="text_navi">';
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
	echo '</span><br>';
}
?>