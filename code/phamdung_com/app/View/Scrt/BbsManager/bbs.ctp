<h1>管理モード</h1>
<?php
echo $this->element('error_message');
?>
<div class="smallmain">
<table width="520">
<img src="/img/admin/title.gif" width="521" height="61" border="0" alt="痴呆相談室（掲示板）" style="margin-left: 10px;">
<tr>
    <td>ようこそ <font color="green"><?php echo $info[0]['Member']['handle'] . "【" . $info[0]['ma']['attribute_name'] . "】"; ?></font>さん</td>
    <td align="right"><a href="/scrt/bbs_manager/logout">ログアウト</a></td>
</tr>
</table>
<br>
<font color="green">■新規投稿</font><br>
<form action="/scrt/bbs_manager/bbs_do" method="post">
<input type="hidden" name="name" value="<?php echo $info[0]['Member']['handle']; ?>">
<input type="hidden" name="mail" value="<?php echo $info[0]['Member']['mail']; ?>">
<input type="hidden" name="attribute" value="<?php echo $info[0]['Member']['attribute']; ?>">
<input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
<table>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><U>タイトル</U></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
        <input type="text" name="data[Bbs][title]" SIZE="50" value="<?php if(isset($validateReturn)) echo $validateReturn['Bbs']['title']; ?>">
    </td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><U>書き込み内容(タグは使えません。)</U></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><textarea name="data[Bbs][message]" rows="5" cols="50"><?php if(isset($validateReturn)) echo $validateReturn['Bbs']['message']; ?></textarea></td>
</tr>
<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
    	<input type="submit" value="投稿する">&nbsp;
    	<?php if(!isset($validateReturn)): ?>
	    <input type="reset" value="消去">
	    <?php else: ?>
	    <input type="button" value="消去" onclick="location.href='/scrt/bbs_manager/bbs/page:<?php echo $this->Paginator->counter("{:page}"); ?>'">
	    <?php endif; ?>
    </td>
</tr>
</table>
</form>
<br>
<font color="green">■投稿一覧</font>
<!-- start foreach bbs -->
<?php foreach ($listBbs as $bbs): ?>
<?php $idBbs = $bbs["Bbs"]["no"]; ?>
<hr size="4" color="darkgray">
<table width="520">
	<tr>
	<td>
	    <font color="green">［<?php echo $idBbs; ?>］題名: <?php echo htmlspecialchars($bbs["Bbs"]["title"]); ?> 　名前: <?php echo $bbs["Bbs"]["name"] . "【" . $bbs["ma"]["attribute_name"] . "】"; ?></font>
	</td>
	<td>
	    <form method="POST" action="/scrt/bbs_manager/del_confirm">
	       <input type="hidden" name="type" value="bbs">
	       <input type="hidden" name="no" value="<?php echo $idBbs; ?>">
	       <input type="hidden" name="name" value='<?php echo $bbs["Bbs"]["name"]; ?>'>
	       <input type="hidden" name="title" value='<?php echo $bbs["Bbs"]["title"]; ?>'>
	       <input type="hidden" name="message" value='<?php echo $bbs["Bbs"]["message"]; ?>'>
	       <input type="hidden" name="attribute" value='<?php echo $bbs["ma"]["attribute_name"]; ?>'>
	       <input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
	       <input type="submit" value="削除" />
        </form>
	</td>
	</tr>
</table>

<table width="520">
<tr>
    <?php if(count($categoryById[$idBbs]) > 0): ?>
        <td><font color="green">カテゴリ：</td></tr>
        <tr><td><font color="green">
        <?php
            foreach($categoryById[$idBbs] as $cate) {
                echo $cate["Category"]["name"] . ":";
            }
        ?>
        </td>
    <?php else: ?>
        <td><font color="green">カテゴリ：未選択</font></td>
    <?php endif; ?>
</tr>
</table>

<form action="/scrt/bbs_manager/category_do" method="POST">
    <input type="hidden" name="no" value="<?php echo $idBbs; ?>" />
    <input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
	<table width="100%">
	<tr><td>
	<?php for($i = 0; $i < 10; $i++) : ?>
	<select name="category<?php echo ($i+1); ?>">
	    <?php echo $optionForCategory; ?>
	</select>
	<?php endfor; ?>
	</td></tr>
	<tr><td>
	<input type="submit" value="カテゴリ登録">
	</td></tr>
	</table>
</form>

<table width="520">
	<tr>
	<td width="20"></td>
	<td width="500"><font color="green"><?php echo nl2br(htmlspecialchars($bbs["Bbs"]["message"])); ?></font></td>
	</tr>
	</table>
	<table width="520">
	<tr>
	<td align="right"><font color="darkgray"><?php echo $this->Time->format('Y-m-d H:i', $bbs["Bbs"]["date"]); ?></font></td>
	</tr>
</table>

<?php if(count($threadById[$idBbs]) > 0): ?>
    <?php foreach($threadById[$idBbs] as $thread): ?>
        <hr color="darkgray">
        <table width="520">
        <tr>
        <td width="40"></td>
        <td width="480"><font color="gray">返信: <?php echo $thread["Thread"]["name"] . "【" . $thread["ma"]["attribute_name"] . "】"; ?></font></td>
        <td width="480"><font color="gray">返信: <?php echo $thread["Thread"]["name"] . "【" . $thread["ma"]["attribute_name"] . "】"; ?></font></td>
        <td>
            <form method="POST" action="/scrt/bbs_manager/del_confirm">
            <input type="hidden" name="no" value="<?php echo $thread['Thread']['threadNo']; ?>">
            <input type="hidden" name="type" value="thread">
            <input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
            <input type="submit" value="削除">
            </form>
        </td>
        </tr>
        </table>
        
        <table width="520">
        <tr>
        <td width="40"></td>
        <td width="480"><font color="gray"><?php echo nl2br(htmlspecialchars($thread["Thread"]["message"])); ?></font></td>
        <td>&nbsp;</td>
        </tr>
        </table>
        
        <table width="520">
        <tr>
        <td align="right"><font color="darkgray"><?php echo $this->Time->format('Y-m-d H:i', $thread["Thread"]["date"]); ?></font></td>
        </tr>
        </table>
    <?php endforeach; ?>
<?php endif; ?>

<hr color="darkgray">
<form action="/scrt/bbs_manager/thread_do" method="POST">
<input type="hidden" name="data[Thread][no]" value="<?php echo $idBbs; ?>" />
<input type="hidden" name="data[Thread][title]" value="返信" />
<input type="hidden" name="data[Thread][name]" value="<?php echo $info[0]['Member']['handle']; ?>" />
<input type="hidden" name="data[Thread][mail]" value="<?php echo $info[0]['Member']['mail']; ?>" />
<input type="hidden" name="data[Thread][attribute]" value="<?php echo $info[0]['Member']['attribute']; ?>">
<input type="hidden" name="page" value='<?php echo $this->Paginator->counter("{:page}"); ?>' />
	<table width="520">
	<tr>
	<td align="right" valign="top">返信内容</td>
	<td><textarea name="data[Thread][message]" rows="5" cols="50"><?php if(isset($validateReturnThread[$idBbs])) echo $validateReturnThread[$idBbs]["Thread"]["message"]; ?></textarea></td>
	</tr>
	<tr>
	<td></td>
	<td><input type="submit" value="返信">&nbsp;<input type="reset" value="消去"></td>
	</tr>
	</table>
</form>
<!-- end foreach bbs -->
<?php endforeach; ?>
<hr size="4" noshade>
<!--/main-content-->
</div>
<div style="text-align: center; margin-bottom: 10px; font-size: 14px;">
    <?php echo $this->element('paginator'); ?>
</div>