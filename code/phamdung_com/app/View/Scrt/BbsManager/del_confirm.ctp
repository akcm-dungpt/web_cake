<h1>コミュニケーション管理</h1>
<div class="smallmain">
<img src="/img/admin/title.gif" width="521" height="61" border="0" alt="痴呆相談室（掲示板）" style="margin-left: 10px;">
<br>
<br>
<FONT SIZE="3" COLOR="black"><b>削除フォーム</b></FONT>
<br>
<table width="520">
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>記事: NO.<?php echo $data['no']; ?>を削除します。<br></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>題名: <?php if (isset($data['title'])) echo htmlspecialchars($data['title']); ?> 名前: <?php if (isset($data['name'])) echo $data['name'] ?>【<?php if (isset($data['attribute'])) echo $data['attribute']; ?>】</td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><?php if (isset($data['message'])) echo nl2br(htmlspecialchars($data['message'])); ?></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
        <form action="/scrt/bbs_manager/del_bbs_thread_do" method="POST">
			<input type="hidden" name="type" value="<?php echo $data['type']; ?>">
			<input type="hidden" name="no" value="<?php echo $data['no']; ?>">
			<input type="hidden" name="page" value="<?php echo $data['page']; ?>">
			<input type="submit" VALUE="削除">
        </form>
    </td>
</tr>
</table>
</div>