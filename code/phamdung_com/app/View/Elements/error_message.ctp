<?php if (isset($validationErrorsArray)): ?>
<div class="errorbox">
<h2>エラーが発生しました</h2>
<ul>
<?php
foreach ($validationErrorsArray as $key => $value) {
	echo '<li>' . $value[0] . "</li>";
}
?>	
</ul>
</div>
<?php endif; ?>