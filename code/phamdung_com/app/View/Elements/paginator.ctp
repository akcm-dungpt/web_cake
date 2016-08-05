<?php 
    echo $this->Paginator->counter("【{:page}/{:pages}】 ");
    if ($this->Paginator->current() == 1) {
        echo "--";
    } else {
		if (!$aryInfoController) {
        	echo $this->Paginator->prev(
            	__('前の10ツリー', true),
            	null,
            	null,
            	array('class'=>'disabled')
        	);
		} else {
			echo $this->Paginator->prev(
            	__('前の10ツリー', true),
            	array('url' => array('controller' => $aryInfoController[0], 'action' => $aryInfoController[1])),
            	null,
            	array('class'=>'disabled')
        	);
		}
    }
    echo "/";
    $totalPage = $this->Paginator->counter(array('format' => __('{:pages}', true)));
    if ($this->Paginator->current() == $totalPage) {
        echo "--";
    } else {
		if (!$aryInfoController) {
        	echo $this->Paginator->next(
            	__('次の10ツリー', true),
            	null,
            	null,
            	array('class' => 'disabled')
        	);
		} else {
			echo $this->Paginator->next(
            	__('次の10ツリー', true),
            	array('url' => array('controller' => $aryInfoController[0], 'action' => $aryInfoController[1])),
            	null,
            	array('class' => 'disabled')
        	);
		}
    }
?>