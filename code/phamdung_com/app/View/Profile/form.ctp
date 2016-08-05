<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>痴呆相談室</title>
<csscriptdict>
<script>
function CSClickReturn () {
    var bAgent = window.navigator.userAgent; 
    var bAppName = window.navigator.appName;
    if ((bAppName.indexOf("Explorer") >= 0) && (bAgent.indexOf("Mozilla/3") >= 0) && (bAgent.indexOf("Mac") >= 0))
        return true; // dont follow link
    else return false; // dont follow link
}


CSStopExecution = false;
function CSAction(array) { 
    return CSAction2(CSAct, array);
}
function CSAction2(fct, array) { 
    var result;
    for (var i=0;i<array.length;i++) {
        if(CSStopExecution) return false; 
        var actArray = fct[array[i]];
        if (actArray == null) return false;
        var tempArray = new Array;
        for(var j=1;j<actArray.length;j++) {
            if((actArray[j] != null) && (typeof(actArray[j]) == "object") && (actArray[j].length == 2)) {
                if(actArray[j][0] == "VAR") {
                    tempArray[j] = CSStateArray[actArray[j][1]];
                }
                else {
                    if(actArray[j][0] == "ACT") {
                        tempArray[j] = CSAction(new Array(new String(actArray[j][1])));
                    }
                else
                    tempArray[j] = actArray[j];
                }
            }
            else
                tempArray[j] = actArray[j];
        }           
        result = actArray[0](tempArray);
    }
    return result;
}
CSAct = new Object;

function CSOpenWindow(action) {
    var wf = "";    
    wf = wf + "width=" + action[3];
    wf = wf + ",height=" + action[4];
    wf = wf + ",resizable=" + (action[5] ? "yes" : "no");
    wf = wf + ",scrollbars=" + (action[6] ? "yes" : "no");
    wf = wf + ",menubar=" + (action[7] ? "yes" : "no");
    wf = wf + ",toolbar=" + (action[8] ? "yes" : "no");
    wf = wf + ",directories=" + (action[9] ? "yes" : "no");
    wf = wf + ",location=" + (action[10] ? "yes" : "no");
    wf = wf + ",status=" + (action[11] ? "yes" : "no");     
    window.open(action[1],action[2],wf);
}


CSAct[/*CMP*/ 'BB6BF1990'] = new Array(CSOpenWindow,/*URL*/ '/close','',350,180,true,true,false,false,false,false,false);
</script>
</csactiondict>
<?php
    echo $this->Html->css('popup');
    echo $this->fetch('css');
?>
</head>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<?php
if (isset($bbsMenu)) {
    echo '<div style="padding-left: 20px; background-color:#FFFFFF;">';
    include ROOT . '/app/View/Bbs/top_menu_bbs.ctp';
    echo '</div>';
}
?>
        <table border="0" cellpadding="10" cellspacing="0" width="540">
            <tr>
                <td><img src="/soudan/img/title.gif" width="521" height="61" border="0" alt="会員登録">
                    <br><br>
                    <?php echo $this->element('error_message'); ?>
                    <br>
            この画面では、登録済みの情報を変更することが可能です。
                    <br>
                    <div align="center">
                        <p>
                        </p>
                        <form action="/profile/confirm" method="post">
              <input type="hidden" name="data[Member][no]" value="<?php echo (isset($returnData)) ? $returnData['no'] : $infoUser[0]['Member']['no']; ?>">
              <input type="hidden" name="data[Member][oldID]" value="<?php echo (isset($returnData)) ? $returnData['oldID'] : $infoUser[0]['Member']['id']; ?>">
              <input type="hidden" name="data[Member][user_id]" value="<?php echo (isset($returnData)) ? $returnData['user_id'] : $infoUser[0]['Member']['user_id']; ?>">
                            <table border="0" cellpadding="0" cellspacing="0" bgcolor="#717171">
                                <tr>
                                    <td bgcolor="white"><span class="large">■ 会員情報変更フォーム</span></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#717171">
                                        <table border="0" cellpadding="3" cellspacing="1" width="453">
                                            <tr bgcolor="#d0d0d0">
                                                <td width="121">
                                                    <div align="center">
                                                        項目</div>
                                                </td>
                                                <td width="198">
                                                    <div align="center">
                                                        入力欄</div>
                                                </td>
                                                <td>
                                                    <div align="center">
                                                        備考</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="121" valign="top" bgcolor="white"><span class="small">ハンドルネーム：</span></td>
                                                <td width="198" valign="top" bgcolor="white"><font size="2"><input type="text" name="data[Member][handle]" value="<?php echo (isset($returnData)) ? $returnData['handle'] : $infoUser[0]['Member']['handle']; ?>"></font></td>
                                                <td valign="top" bgcolor="white"><font size="2">掲示板ご利用時などに表示されるペンネームです。</font></td>
                                            </tr>
                                            <tr>
                                                <td width="121" valign="top" bgcolor="white"><span class="small">メールアドレス：</span></td>
                                                <td width="198" valign="top" bgcolor="white"><font size="2"><input type="text" name="data[Member][id]" value="<?php echo (isset($returnData)) ? $returnData['id'] : $infoUser[0]['Member']['id']; ?>"></font></td>
                                                <td valign="top" bgcolor="white"><font size="2">掲示板ご利用時のIDとなります。</font></td>
                                            </tr>
                                            <tr>
                                                <td width="121" valign="top" bgcolor="white"><span class="small">パスワード：</span></td>
                                                <td width="198" valign="top" bgcolor="white"><font size="2"><input type="text" name="data[Member][ps]" value="<?php if(isset($returnData)) echo $returnData['ps']; ?>"></font></td>
                                                <td valign="top" bgcolor="white"><font size="2">掲示板ご利用時のパスワードとなります。<br>
                                                    </font><font size="2" color="#d00000">英数字4文字以上12文字以内</font></td>
                                            </tr>
                                            <tr>
                                                <td valign="top" bgcolor="#ffc9d4" colspan="3">会員サービス</td>
                                            </tr>
                                            <tr>
                                                <td width="121" valign="top" bgcolor="white"><span class="small">メルマガ配信：</span></td>
                                                <td width="198" valign="top" bgcolor="white"><font size="2"><select name="data[Member][mailmagazine]">
                                                <?php if ((isset($infoUser) && $infoUser[0]['Member']['mailmagazine'] == 1) || (isset($returnData) && $returnData['mailmagazine'] == 1)): ?>
                                                            <option value="1" selected="selected">希望する</option>
                                                            <option value="0">希望しない</option>
                                                <?php else : ?>
                                                            <option value="1">希望する</option>
                                                            <option value="0" selected="selected">希望しない</option>
                                                <?php endif; ?>                                                            
                                                        </select></font></td>
                                                <td valign="top" bgcolor="white"><font size="2">当ホームページよりお送りするメールマガジンをお受け取りできます。</font></td>
                                            </tr>
                                            <tr>
                                                <td valign="top" bgcolor="white" colspan="3">
                                                    <div align="center">
                                                    <?php if(isset($bbsMenu)): ?>
											        <input type="hidden" name="flag" value="bbs">
											        <?php endif; ?>
                                                        　                                                                               <input type="submit" value="送信">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <a href="#" onclick="CSAction(new Array(/*CMP*/'BB6BF1990'));return CSClickReturn();" csclick="BB6BF1990">会員登録解除</a><br>
                        </form>
                        <p><br>
                        </p>
                    </div>
                    
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>
                                    <hr>
                                    <span class="small">＊このページはフレームを使用しています。<br>
                                        左側にメニューが表示されていない場合は<a href="/index.html" target="_top">こちら（ホーム）</a>から再入場して下さい<br>
                                        <hr size="1">
                                    </span><font size="1" color="#696969">痴呆ネットの記事・写真・カット等の著作権は、痴呆ネットに帰属しています。<br>
                                        当サイトに掲載されている情報は、著作権者に無断で転載・複製等を行うことはできません。<br>
                                        Copyright 2003- Chihou.net. All rights reserved.<br>
                                    </font><font size="1"><br>
                                    </font></td>
                            </tr>
                        </table></td>
            </tr>
        </table>
    </body>
</html>
