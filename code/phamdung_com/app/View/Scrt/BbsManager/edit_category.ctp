<h1>カテゴリ管理</h1>
<?php
echo $this->element('error_message');
?>
<div style="height: 200px; font-size: 16px;">
<form method="POST" action="/scrt/bbs_manager/edit_category_do">
<table border="1" style="margin-bottom: 15px;">
<tr>
<td>管理番号</td>
<td><?php echo (isset($returnData)) ? $returnData['no'] : $cateDetail['no']; ?></td>
</tr>

<tr>
	<td>登録番号</td>
	<td>
	   <input type="text" name="data[Validate][sort_no]" value="<?php echo (isset($returnData)) ? $returnData['sort_no'] : $cateDetail['sort_no']; ?>">
	   <input type="hidden" name="data[Validate][no]" value="<?php echo (isset($returnData)) ? $returnData['no'] : $cateDetail['no']; ?>">
	</td>
</tr>

<tr>
    <td>カテゴリ名</td>
    <td>
        <input type="text" name="data[Validate][name]" value="<?php echo (isset($returnData)) ? $returnData['name'] : $cateDetail['name']; ?>">
    </td>
</tr>
</table>
<div style="margin-left: 55px;">
<input type="submit" name="data[Validate][update]" value="UPDATE" onclick='return confirm("データを変更します。\nよろしいですか？");'>
<?php if(!isset($returnData)): ?>
<input type="reset" value="クリア">
<?php else: ?>
<input type="button" value="クリア" onclick="location.href='/scrt/bbs_manager/edit_category/no:<?php echo $returnData['no']; ?>'">
<?php endif; ?>
<br><br>
<input type="submit" name="data[Validate][delete]" value="DELETE" onclick='return confirm("データを削除します。\nよろしいですか");'>
</div>
</form>
</div>