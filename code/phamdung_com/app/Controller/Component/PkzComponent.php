<?php
class PkzComponent extends Component {
	function _setPkz($url, $name, $admin = false)
    {
        static $i;
        static $ar;

        if (!isset($i)) {
            $i = 0;
        }

        if (!is_array($ar)) {
            $ar = array();
        }

        if (!$i) {
            if (!$admin) {
                $ar[$i]['url'] = FULL_BASE_URL;
                $ar[$i]['name'] = "トップ";
            } else {
                $ar[$i]['url'] = FULL_BASE_URL . '/scrt/';
                $ar[$i]['name'] = "管理トップ";
            }
            $i++;
        }

        if (!empty($name)) {
            if (!$admin) {
                $ar[$i]['url'] = $url;
                $ar[$i]['name'] = $name;
            } else {
                $ar[$i]['url'] = ($url != '' ? FULL_BASE_URL : '') . $url;
                $ar[$i]['name'] = $name;
            }
            $i++;
        }

        //$this->set('pkz', $ar);
        return $ar;
    }
}
?>