<?php
    echo $this->Html->script('touroku');
    echo $this->fetch('script');
?>
<csscriptdict import>
  <script src="/js/javacript.js"></script>
</csscriptdict>
<csactiondict>
  <script><!--

CSAct[/*CMP*/ 'C0D85D971'] = new Array(CSOpenWindow,/*URL*/ '/close/index','',370,200,true,true,false,false,false,false,false);
CSAct[/*CMP*/ 'C0D85D973'] = new Array(CSOpenWindow,/*URL*/ '/remain/index','',390,250,true,true,false,false,false,false,false);

// --></script>
</csactiondict>
<csactions>
  <csaction name="C0D85D971" class="Open Window" type="onevent" val0="/close/index" val1="" val2="350" val3="180" val4="true" val5="true" val6="false" val7="false" val8="false" val9="false" val10="false">
  <csaction name="C0D85D973" class="Open Window" type="onevent" val0="/remain/index" val1="" val2="350" val3="180" val4="true" val5="true" val6="false" val7="false" val8="false" val9="false" val10="false">
</csactions>
<script type="text/javascript">
window.onload = function(){
    attributeyChange1();
}
</script>
<table border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="10"><img src="/img/spacer.gif" width="10" height="10"></td>
    <td width="187" valign="top">
        <?php include '_side_left.ctp'; ?>
    </td>
    <td width="12" valign="top"><img src="/img/title_02.gif" width="12" height="65"></td>
    <td width="592" valign="top">
        <img src="/img/top/entry/title.gif" alt="会員登録" width="592" height="65"><br><br>
        <?php echo $this->element('error_message'); ?>
        <table width="580" height="30" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td background="/soudan/img/stitle.gif" class="text_stitle">認知症ねっとの会員限定サービス</td>
            </tr>
        </table>

        <br>

        <table width="580" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><p><span class="text_soudan_style02"> 掲示板</span><br>
                    会員登録をしていただくと、掲示板機能をフルにご利用いただけます。認知症ねっとの「認知症相談室（掲示板）」には、既に介護歴の長いご家族や、認知症介護専門のヘルパーさん、そして医師もいます。どんな質問にも、暖かい回答が返ってくることと思います。会員登録をした方のみが、書き込みをできることになっています。（なお、会員登録無しでも掲示板の閲覧は可能です。）<br>
                    <br>
                    ※メールアドレスをお持ちで無い方は、<a href="http://mail.yahoo.co.jp/" target="_blank">Yahoo!メール</a>や<a href="https://accounts.google.com/ServiceLogin?service=mail" target="_blank">Gメール</a>、<a href="http://www.hotmail.com" target="_blank">Hotmail</a>などの無料メールサービスでメールアドレスを取得して、『認知症ねっと』へご登録下さい（無料メールサービスのご利用に関しましては『認知症ねっと』では一切の責任を負いません）<br>
                    なお、携帯電話のメールアドレスは情報が十分届かないことがありますのでご遠慮ください</p>
                </td>
            </tr>
        </table>

        <br>
        <a name="100226"></a>            <br>
        <table width="580" height="30" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td background="/soudan/img/stitle.gif" class="text_stitle">会員登録フォーム</td>
            </tr>
        </table>
        <div align="center"><br><br>
        <form action="/entry/confirm" method="post" name="the_form">
            <!--table form input-->
            <table border="0" cellpadding="0" cellspacing="0" bgcolor="#717171">
                <tr>
                    <td bgcolor="white"><span class="large">■ 会員登録フォーム</span></td>
                </tr>
                <tr>
                    <td bgcolor="#717171">
                        <table border="0" cellpadding="3" cellspacing="1" width="453">
                            <tr bgcolor="#d0d0d0">
                                <td width="121">
                                    <div align="center">項目</div>
                                </td>
                                <td width="198">
                                    <div align="center">入力欄</div>
                                </td>
                                <td>
                                    <div align="center">備考</div>
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">ハンドルネーム：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                        <input type="text" name="data[Member][handle]" value="<?php if(isset($returnData)) echo $returnData['handle']; ?>">
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white">
                                    <font size="2">掲示板ご利用時などに表示されるペンネームです。</font>
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">メールアドレス：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                        <input type="text" name="data[Member][usrmail]" style="ime-mode: inactive;" value="<?php if(isset($returnData)) echo $returnData['usrmail']; ?>">
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white">
                                    <font size="2">掲示板ご利用時のIDとなります。</font>
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">メールアドレス確認：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                        <input type="text" name="data[Member][usrmail2]" style="ime-mode: inactive;" value="<?php if(isset($returnData)) echo $returnData['usrmail2']; ?>">
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white">
                                    <font size="2">確認のためメールアドレスを再入力してください。</font><font size="2" color="#d00000">アドレスの間違いが頻発しております。十分ご確認ください。</font>
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">パスワード：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                        <input type="text" name="data[Member][ps]" style="ime-mode: inactive;" value="<?php if(isset($returnData)) echo $returnData['ps']; ?>">
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white">
                                    <font size="2">掲示板ご利用時のパスワードとなります。<br>
                                    </font><font size="2" color="#d00000">半角4文字以上12文字以内</font>
                                </td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">属性：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                        <label>
                                            <input 
                                            type="radio" 
                                            name="data[Member][attributePlan]" 
                                            value="1" onclick="attributeyChange1();" 
                                            <?php if(!isset($returnData) || $returnData['attributePlan'] == 1) echo "checked='checked'"; ?>
                                            />ご家族の介護に関わっている方
                                        </label>
                                        <label>
                                            <input 
                                            type="radio" 
                                            name="data[Member][attributePlan]" 
                                            value="2" onclick="attributeyChange1();" 
                                            <?php if(isset($returnData) && $returnData['attributePlan'] == 2) echo "checked='checked'"; ?>
                                            />専門家その他
                                        </label>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"></td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">生まれた年：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white"><font size="2">
                                    <select name="data[Member][birthyear]">
                                        <?php echo $birthyear; ?>
                                    </select>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">誕生日：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white"><font size="2">
                                    <select name="data[Member][month]">
                                        <?php echo $month; ?>
                                    </select>月
                                    <select name="data[Member][date]">
                                        <?php echo $date; ?>
                                    </select>日
                                    </font></td>
                                    <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">性別：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <label>
                                        <input type="radio" 
                                        name="data[Member][sex]" value="1" 
                                        <?php if(!isset($returnData) || $returnData['sex'] == 1) echo "checked='checked'"; ?>
                                        />男
                                    </label>
                                    <label>
                                        <input type="radio" 
                                        name="data[Member][sex]" value="2" 
                                        <?php if(isset($returnData) && $returnData['sex'] == 2) echo "checked='checked'"; ?>
                                        />女
                                    </label>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white">　</td>
                            </tr>
                            <!-- ご家族の介護に関わっている方用 -->
                            <tr id="firstBox1" align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">都道府県：</span><br><font size="2" color="#d00000">必須</font>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <select name="data[Member][pref1]">
                                        <?php echo $pref; ?>
                                    </select>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white">　</td>
                            </tr>
                            <tr id="firstBox3" align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">認知症ねっとをどうやって知りましたか？：</span><br>
                                </td>
                                <td width="198" valign="top" bgcolor="white"><font size="2">
                                    <select name="data[Member][whichkn]">
                                        <?php echo $whichkn; ?>
                                    </select></font>
                                </td>
                                <td valign="top" bgcolor="white">　</td>
                            </tr>
                            <tr id="firstBox4" align="left">
                                <td width="121" valign="top" bgcolor="white">
                                    <span class="small">興味のある質問：</span>
                                </td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2"><?php echo $questionCate; ?></font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="firstBox5" align="left">
                                <td valign="top" bgcolor="#ffc9d4" colspan="3">介護の対象となる方についての質問です</td>
                            </tr>
                            <tr id="firstBox6" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">続柄：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2"><?php echo $relation; ?></font>
                                </td>
                                <td valign="top" bgcolor="white">　</td>
                            </tr>
                            <tr id="firstBox7" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">年齢：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2"><?php echo $age; ?></font></td>
                                <td valign="top" bgcolor="white">　</td>
                            </tr>
                            <tr id="firstBox8" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">介護状況：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2"><?php echo $situation; ?></font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="firstBox9" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">要介護度：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white"><font size="2">
                                    <?php echo $careDegree; ?>
                                </font></td>
                                <td valign="top" bgcolor="white">　</td>
                            </tr>
                            <tr id="firstBox10" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">認知症：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <label>
                                        <input type="radio" 
                                        name="data[Member][ninchi]" value="1" 
                                        <?php if(isset($returnData['ninchi']) && $returnData['ninchi'] == 1) echo "checked='checked'";  ?>
                                        />有
                                    </label>
                                    <label>
                                        <input type="radio" 
                                        name="data[Member][ninchi]" value="2" 
                                        <?php if(isset($returnData['ninchi']) && $returnData['ninchi'] == 2) echo "checked='checked'";  ?>
                                        />無
                                    </label>
                                    <label>
                                        <input type="radio" 
                                        name="data[Member][ninchi]" value="3" 
                                        <?php if(isset($returnData['ninchi']) && $returnData['ninchi'] == 3) echo "checked='checked'";  ?>
                                        />わからない
                                    </label>
                                    </font>
                                </td>
                                    <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="firstBox11" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">診断名：</span></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <input type="text" name="data[Member][disease_name]" 
                                    value="<?php if(isset($returnData)) echo $returnData['disease_name']; ?>"/>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="secondBox1" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">郵便番号：</span></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <input type="text" name="data[Member][zipcode_2]" 
                                    size="4" maxlength="3" style="ime-mode:disabled;" 
                                    value="<?php if(isset($returnData)) echo $returnData['zipcode_2']; ?>"
                                    />-
                                    <input type="text" name="data[Member][zipcode_3]" 
                                    size="5" maxlength="4" style="ime-mode:disabled;" 
                                    onKeyUp="AjaxZip3.zip2addr('data[Member][zipcode_2]','data[Member][zipcode_3]','data[Member][pref2]','data[Member][address1]');"
                                    value="<?php if(isset($returnData)) echo $returnData['zipcode_3']; ?>"
                                    />
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="secondBox2" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">都道府県：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <select name="data[Member][pref2]">
                                        <?php echo $pref; ?>
                                    </select>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="secondBox3" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">市区町村番地：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <input type="text" name="data[Member][address1]" value="<?php if(isset($returnData)) echo $returnData['address1']; ?>"/>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="secondBox4" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">マンション名等：</span></td>
                                <td width="198" valign="top" bgcolor="white">
                                    <font size="2">
                                    <input type="text" name="data[Member][address2]" value="<?php if(isset($returnData)) echo $returnData['address2'] ?>"/>
                                    </font>
                                </td>
                                <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr id="secondBox5" align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">保有資格：</span><br><font size="2" color="#d00000">必須</font></td>
                                <td width="198" valign="top" bgcolor="white"><font size="2">
                                    <p>福祉系資格</p>
                                    <?php echo $sikaku1 ?>
                                    その他
                                    <input type="text" name="data[Member][sikakuetc1]" 
                                    value="<?php if(isset($returnData)) echo $returnData['sikakuetc1'] ?>"/><br>
                                    <p>医療系資格</p>
                                    <?php echo $sikaku2; ?>
                                    その他
                                    <input type="text" name="data[Member][sikakuetc2]" 
                                    value="<?php if(isset($returnData)) echo $returnData['sikakuetc2'] ?>"/><br>
                                    <p>会計・法律・保険系資格</p>
                                    <?php echo $sikaku3; ?>
                                    その他
                                    <input type="text" name="data[Member][sikakuetc3]" 
                                    value="<?php if(isset($returnData)) echo $returnData['sikakuetc3'] ?>"/><br>
                                    <br>
                                    特に医療・介護関連の資格は持っていない:介護との関わり
                                    <input type="text" name="data[Member][sikakuetc4]" 
                                    value="<?php if(isset($returnData)) echo $returnData['sikakuetc4'] ?>"/><br>
                                    </font></td>
                                    <td valign="top" bgcolor="white"><font size="2"></font></td>
                            </tr>
                            <tr>
                                <td valign="top" bgcolor="#ffc9d4" colspan="3">会員サービス</td>
                            </tr>
                            <tr align="left">
                                <td width="121" valign="top" bgcolor="white"><span class="small">メルマガ配信：<br></span>
                                    <select name="data[Member][mailmagazine]">
                                        <option value="1" <?php if(!isset($returnData) || $returnData['mailmagazine'] == 1) echo "selected='selected'"; ?>>希望する</option>
                                        <option value="0" <?php if(isset($returnData) && $returnData['mailmagazine'] === 0) echo "selected='selected'"; ?>>希望しない</option>
                                    </select>
                                </td>
                                <td valign="top" bgcolor="white" colspan="2"><font size="2">当ホームページよりお送りするメールマガジンをお受け取りできます。</font></td>
                            </tr>
                            <tr>
                                <td valign="top" bgcolor="white" colspan="3">
                                    <div align="center">
                                        <input type="submit" value="送信"></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <!--/table form input-->
            </table>
            <br>
            <a href="#" onclick="CSAction(new Array(/*CMP*/'C0D85D971'));return CSClickReturn();" csclick="C0D85D971">会員登録解除</a> | <a href="#" onclick="CSAction(new Array(/*CMP*/'C0D85D973'));return CSClickReturn();" csclick="C0D85D973">パスワードを忘れたら</a><br>
        </form>
        <br>
        </div>
        <br>
        <br>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="middle" class="text_navi02"><a href="javascript:history.back();"><img src="/img/button_back.gif" width="30" height="30" border="0" align="middle"> 前のページへ戻る</a>　<a href="#top"><img src="/img/button_top.gif" width="31" height="30" border="0" align="middle"> このページの先頭へ</a></td>
            </tr>
        </table>

<!--no erase-->
    </td>
</tr>
</table>