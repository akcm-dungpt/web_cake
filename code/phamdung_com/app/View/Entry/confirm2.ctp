<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>痴呆相談室</title>
</head>
<body>
<img src="/soudan/img/title.gif" width="521" height="61" border="0" alt="会員登録"><br>
<br>
<br>
ハンドルネーム：<?php echo $data['handle']; ?><br>
メールアドレス：<?php echo $data['usrmail']; ?><br>
パスワード：<?php echo $data['ps']; ?><br>
属性：<?php echo $data['attributePlan_text']; ?><br>
生まれた年：<?php echo $data['birthyear']; ?>年<br>
誕生日：<?php echo $data['month']; ?>月<?php echo $data['date']; ?>日<br>
性別：<?php echo $data['sex_text']; ?><br>
郵便番号：<?php echo $data['zipcode_2']; ?>-<?php echo $data['zipcode_3']; ?><br>
都道府県：<?php echo $data['pref2']; ?><br>
市区町村番地：<?php echo $data['address1']; ?><br>
マンション名等：<?php echo $data['address2']; ?><br>
保有資格：<?php echo join(',', $data['sikaku']); ?><?php echo $data['sikakuetc1']; ?><?php echo $data['sikakuetc2']; ?><?php echo $data['sikakuetc3']; ?><?php echo $data['sikakuetc4']; ?><br>

メルマガ配信：<?php echo $data['mailmagazine_text']; ?><br>
<form action="/entry/create" method="post">
<input type="hidden" name="handle" value="<?php echo $data['handle']; ?>">
<input type="hidden" name="usrmail" value="<?php echo $data['usrmail']; ?>">
<input type="hidden" name="ps" value="<?php echo $data['ps']; ?>">

<input type="hidden" name="attributePlan" value="<?php echo $data['attributePlan_text']; ?>">
<input type="hidden" name="attributePlan_val" value="<?php echo $data['attributePlan']; ?>">
<input type="hidden" name="birthyear" value="<?php echo $data['birthyear']; ?>">
<input type="hidden" name="month" value="<?php echo $data['month']; ?>">
<input type="hidden" name="date" value="<?php echo $data['date']; ?>">
<input type="hidden" name="sex" value="<?php echo $data['sex']; ?>">
<input type="hidden" name="zipcode_2" value="<?php echo $data['zipcode_2']; ?>">
<input type="hidden" name="zipcode_3" value="<?php echo $data['zipcode_3']; ?>">
<input type="hidden" name="pref2" value="<?php echo $data['pref2']; ?>">
<input type="hidden" name="address1" value="<?php echo $data['address1']; ?>">
<input type="hidden" name="address2" value="<?php echo $data['address2']; ?>">
<input type="hidden" name="sikaku" value="<?php echo join(',',$data['sikaku']); ?>">
<input type="hidden" name="sikakuetc1" value="<?php echo $data['sikakuetc1']; ?>">
<input type="hidden" name="sikakuetc2" value="<?php echo $data['sikakuetc2']; ?>">
<input type="hidden" name="sikakuetc3" value="<?php echo $data['sikakuetc3']; ?>">
<input type="hidden" name="sikakuetc4" value="<?php echo $data['sikakuetc4']; ?>">

<input type="hidden" name="usrname" value="none">
<input type="hidden" name="age" value="0">
<input type="hidden" name="gender" value="1">
<input type="hidden" name="zip" value="none">
<input type="hidden" name="pref" value="0">
<input type="hidden" name="attribute" value="<?php echo $data['attribute']; ?>">
<input type="hidden" name="income" value="<?php echo $data['income_val']; ?>">
<input type="hidden" name="bbsmail" value="0">
<input type="hidden" name="institution" value="0">
<input type="hidden" name="mailmagazine" value="<?php echo $data['mailmagazine']; ?>">
<input type="hidden" name="enquete" value="0">
<input type="submit" value="送信">
</form>
</body>
</html>
