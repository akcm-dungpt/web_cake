<h1>ユーザー検索</h1>
<?php
echo $this->Session->flash();
echo $this->element('error_message');
?>
<div class="search-mem">
<?php
echo $this->Form->create('Validate', array('url' => '/scrt/user_manager/seek'));
echo $this->Form->input('word', array('label' => false, 'size' => '40', 'error' => false));
echo "<br>";
echo $this->Form->submit('検索開始', array('div' => array('style' => 'text-align: center;')));
echo $this->Form->end();
?>
<div class="ichiran"><a href="/scrt/user_manager/listing">一覧</a><br></div>
</div>