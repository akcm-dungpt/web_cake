<h1>カテゴリ管理</h1>
<div style="font-size: 16px;">
<table border=1>
<tr>
<th>管理番号</th>
<th>登録番号</th>
<th>カテゴリ名</th>
<th>更新／削除</th>
</tr>
<?php foreach($listCategory as $list): ?>
<tr>
<td><?php echo $list['Category']['no']; ?></td>
<td><?php echo $list['Category']['sort_no']; ?></td>
<td><?php echo $list['Category']['name']; ?></td>
<td><a href="/scrt/bbs_manager/edit_category/no:<?php echo $list['Category']['no']; ?>">更新／削除</a></td>
</tr>
<?php endforeach; ?>
</table>
</div>