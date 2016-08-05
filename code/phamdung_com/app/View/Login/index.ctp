<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>||| 認知症相談室（掲示板） | 認知症介護のネットワーク 認知症ねっと／認知症、痴呆症、呆け（ぼけ） |||</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta name="keywords" content="認知症,認知,痴呆症,痴呆,介護,介護保険制度,介護保険,介護施設,相談">
<meta name="description" content="認知症（旧痴呆症）の基本情報、高齢者介護のコツなどを掲載。認知症患者や認知症介護家族と介護関係者（ヘルパーやケアマネージャーなど）が、意見を交換する掲示板「認知症相談室」を公開しています。">
<style type="text/css">
body {
    background-image: url(/img/haikei.gif);
    margin-left: 20px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
</style>
<?php
    echo $this->Html->css('style');
    echo $this->fetch('css');
?>
<csscriptdict import>
  <script src="/js/javacript.js"></script>
</csscriptdict>
<csactiondict>
  <script>
CSAct[/*CMP*/ 'BE2803BD0'] = new Array(CSOpenWindow,/*URL*/ '/remain','',350,180,true,true,false,false,false,false,false);
CSAct[/*CMP*/ 'BE2803BD1'] = new Array(CSOpenWindow,/*URL*/ '/profile','',350,180,true,true,false,false,false,false,false);


function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</csactiondict>
<csactions>
  <csaction name="BE2803BD0" class="Open Window" type="onevent" val0="/remain" val1="" val2="350" val3="180" val4="true" val5="true" val6="false" val7="false" val8="false" val9="false" val10="false">
  <csaction name="BE2803BD1" class="Open Window" type="onevent" val0="/profile" val1="" val2="350" val3="180" val4="true" val5="true" val6="false" val7="false" val8="false" val9="false" val10="false">
</csactions>
</head>
<body>
<div style="padding-left: 20px; background-color:#FFFFFF;">
<?php include ROOT . '/app/View/Bbs/top_menu_bbs.ctp'; ?>
</div>
<table width="640" border="0" cellpadding="20" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><img src="/img/bbs_title_01.gif" width="592" height="52"><br>
      <br>
      <?php echo $this->element('error_message'); ?>
      <br>
        <span class="text_soudan_style02">1.会員登録をして、閲覧・書き込みをする</span>
        <br>
      <form action="/login/confirm" method="post" name="the_form">
        <table width="580" border="0" align="center" cellpadding="10" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td valign="top" nowrap bgcolor="#FAFAFA"><span class="large"><strong>ユーザーID</strong></span><br>            </td>
            <td valign="top" bgcolor="#FFFFFF"><input type="text" name="id" value="<?php if(isset($returnData)) echo $returnData['id']; ?>">
              <br>
              ※ユーザーIDはご登録時のメールアドレスです。<br>
              ※ログインできない場合はご登録時のメールアドレスが間違っている可能性があります、大変申し訳ございませんが、再度会員登録してログインを行って下さい。</td>
          </tr>
          <tr>
            <td valign="top" nowrap bgcolor="#FAFAFA"><span class="large"><strong>パスワード</strong></span><br>            </td>
            <td valign="top" bgcolor="#FFFFFF"><input type="password" name="ps" value="<?php if(isset($returnData)) echo $returnData['ps']; ?>">
            　                       <?php if(isset($returnData['cookie']) && $returnData['cookie'] == 'on'): ?>
              <input type="checkbox" name="cookie" value="on" checked="checked">
              <?php else: ?>
              <input type="checkbox" name="cookie" value="on">
              <?php endif; ?>
              ID、パスワードを保存する<br>
              ※保存を削除する為にはログアウトが必要です。</td>
          </tr>
          <tr bgcolor="#F6F6F6">
            <td colspan="2" align="center" bgcolor="#FFEFEC"><input type="submit" value="閲覧・書込みする">
            　　<a href="#" onClick="CSAction(new Array(/*CMP*/'BE2803BD1'));return CSClickReturn();" csclick="BE2803BD1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','/img/pin_over.gif',1)"><img src="/img/pin.gif" name="Image2" width="20" height="17" border="0" align="absmiddle">登録情報の変更</a>　 <a href="#" onClick="CSAction(new Array(/*CMP*/'BE2803BD0'));return CSClickReturn();" csclick="BE2803BD0" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','/img/pin_over.gif',1)"><img src="/img/pin.gif" name="Image3" width="20" height="17" border="0" align="absmiddle">パスワードを忘れたら</a>        </td>
          </tr>
        </table>
        <br>
        <span class="text_soudan_style02">2.閲覧のみをする</span><br>
        <a href="/bbs/view" target="_top" onMouseOver="MM_swapImage('Image7','','/img/bbs_button_01_over.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="/img/bbs_button_01.gif" name="Image7" width="285" height="55" border="0"></a><br>
      </form>
 <table width="580" height="30" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td background="soudan/img/stitle.gif" class="text_stitle">掲示板をご利用の前に</td>
        </tr>
      </table>
      <br>
      <img src="/img/bbs_photo.gif" width="245" height="165" align="right">この掲示板は認知症に関して自由にコミュニケーションしていただく場です。みんなが気持ちよく利用していただけるよう、次のようなルールを設けています。<br>
      <span class="text_style01">
      <ol>
        <li>他を誹謗中傷するような内容などは管理者が削除することがあります。</li>
        <li>ご質問に対する回答はあくまでも「参考」とお考えください。</li>
        <li>必要に応じて、近くの専門家に相談するようにしてください。</li>
      </ol>
      </span>※認知症はその症状だけをとらまえて、対応を判断すべきものではありません。 <br>
      　医療・介護など多面的な対応が必要な場合が多々あります。<br>
    ※会員登録者は「閲覧・書込み」、未登録の方は「閲覧」のみが可能となっています。 <br></td>
  </tr>
</table>
</body>
</html>