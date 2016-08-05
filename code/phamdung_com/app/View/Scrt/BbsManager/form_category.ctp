<h1>掲示板 カテゴリ管理</h1>
<?php
echo $this->element('error_message');
?>
<div style="height: 200px; font-size: 16px;">
<form action="/scrt/bbs_manager/create_category_do" method="post">
<p>
<table border=1>
<tr>
<td>登録番号</td>
<td>
    <input type="text" name="data[Category][sort_no]" value="<?php if(isset($returnData)) echo $returnData['sort_no']; ?>">
</td>
</tr>
<tr>
<td>カテゴリ名</td>
<td>
    <input type="text" name="data[Category][name]" value="<?php if(isset($returnData)) echo $returnData['name']; ?>">
</td>
</tr>
</table>
<br>
<div style="margin-left: 50px;">
<input type="submit" value="追加">
<?php if(isset($returnData)) : ?>
<a href="/scrt/bbs_manager/form_category" style="text-decoration:none;"><input type="button" value="クリア"></a><br><br>
<?php else: ?>
<input type="reset" value="クリア"><br><br>
<?php endif; ?>
</div>
</form>
</div>