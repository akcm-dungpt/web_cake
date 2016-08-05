<?php
/**
* Controller common for user (front-end)
*/
class MemberController extends AppController {
	public $layout = 'user';
	/**
	* Create checkbox for Sikaku
	*
	* @param int $type
	* @param array $data (options)
	* @return String
	*/
	function _createCheckboxSikaku($type, $data = NULL)
	{
		if ($type == 1) {
			$value = array(
				'介護支援専門員（ケアマネジャー）', '主任介護支援専門員',
				'介護福祉士', '認知症専門介護福祉士',
				'社会福祉士', 'ヘルパー1級',
				'ヘルパー2級', '社会福祉主事任用資格',
				'認知症ケア専門士', '認知症介護実践者研修',
				'福祉用具専門相談員', '福祉住環境コーディネーター',
				'児童指導員', '言語聴覚士',
				'手話技能検定社会福祉士', '視能訓練士',
				'手話通訳士', '義肢装具士', 'サービス介助士',
			);
		} elseif ($type == 2) {
			$value = array(
				'医師', '正看護師', '准看護師',
				'保健師', '助産師', '精神保健福祉士',
				'臨床検査技師', '臨床工学技師', '診療放射線技師',
				'救急救命士', 'THP指導者', '歯科医師', 
				'歯科衛生士', '歯科技工士', '理学療法士',
				'作業療法士', 'はり師', '灸師',
				'あん摩マッサージ師', '指圧師', '鍼灸マッサージ師',
				'管理栄養士', '音楽療法士', '柔道整復師',
				'診療報酬請求事務能力認定', '医療秘書技能検定',
			);
		} elseif ($type == 3) {
			$value = array('ファイナンシャルプランナー', '社会保険労務士');
		}
		$return = "";
		foreach ($value as $v) {
			if (isset($data) && (array_search($v, $data) === 0 || array_search($v, $data) > 0)) {
				$return .= "<input type='checkbox' name='data[Member][sikaku][]' value='$v' checked='checked'>$v<br>";
			} else {
				$return .= "<input type='checkbox' name='data[Member][sikaku][]' value='$v'>$v<br>";
			}
		}
		return $return;
	}
}
