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
都道府県：<?php echo $data['pref1_name']; ?><br>
認知症ねっとをどうやって知りましたか？：<?php echo $data['whichkn']; ?><br>
興味のある質問：<?php echo join(',', $data['question']); ?><br>
続柄：<?php echo $data['relation']; ?><br>
年齢：<?php echo $data['age']; ?><br>
介護状況：<?php echo $data['situation']; ?><br>
要介護度：<?php echo $data['care_degree']; ?><br>
認知症：<?php echo $data['ninchi_text']; ?><br>
診断名：<?php echo $data['disease_name']; ?><br>

メルマガ配信：<?php echo $data['mailmagazine_text']; ?><br>
<form action="/entry/create" method="POST">
<input type="hidden" name="handle" value="<?php echo $data['handle']; ?>">
<input type="hidden" name="usrmail" value="<?php echo $data['usrmail']; ?>">
<input type="hidden" name="ps" value="<?php echo $data['ps']; ?>">

<input type="hidden" name="attributePlan" value="<?php echo $data['attributePlan_text']; ?>">
<input type="hidden" name="attributePlan_val" value="<?php echo $data['attributePlan']; ?>">
<input type="hidden" name="birthyear" value="<?php echo $data['birthyear']; ?>">
<input type="hidden" name="month" value="<?php echo $data['month']; ?>">
<input type="hidden" name="date" value="<?php echo $data['date']; ?>">
<input type="hidden" name="sex" value="<?php echo $data['sex']; ?>">
<input type="hidden" name="pref1" value="<?php echo $data['pref1_name']; ?>">
<input type="hidden" name="whichkn" value="<?php echo $data['whichkn']; ?>">
<input type="hidden" name="question" value="<?php echo join(',', $data['question']); ?>">
<input type="hidden" name="relation" value="<?php echo $data['relation']; ?>">
<input type="hidden" name="age_val" value="<?php echo $data['age']; ?>">
<input type="hidden" name="situation" value="<?php echo $data['situation']; ?>">
<input type="hidden" name="care_degree" value="<?php echo $data['care_degree']; ?>">
<input type="hidden" name="ninchi" value="<?php echo $data['ninchi']; ?>">
<input type="hidden" name="disease_name" value="<?php echo $data['disease_name']; ?>">

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
