<br>
<?php
echo $this->element('error_message');
?>
<div id="login">
<form action="/scrt/login/do" method="post" name="form_login">
<p><label>ユーザーID:</label><br />
<input type="text" name="data[Member][id]" size="25" value='<?php if(isset($validateReturn)) echo $validateReturn["Member"]["id"]; ?>'></p>
<p><label>パスワード:</label><br />
<input type="password" name="data[Member][ps]" size="25" value='<?php if(isset($validateReturn)) echo $validateReturn["Member"]["ps"]; ?>'></p>
<p><input type="submit" name="submit" value="ログイン" /></p>
</form>
</div>