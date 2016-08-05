<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Pkz', 'Cookie');
	/**
     * Create options for select of prefecture
     *
     * @param int $idSelected
     * @return  array
     */
	function _createPrefectureSelect($idSelected = NULL) {
		$this->loadModel('Prefecture');
		$params = array(
			'order' => 'Prefecture.id ASC',
			'fields' => array('Prefecture.id', 'Prefecture.prefecture_name'),
		);
		$listPrefecture = $this->Prefecture->find('all', $params);
		
		$options = "";
		if (!$idSelected || $idSelected = "") {
			$options .= '<option value="" selected="selected">以下からお選びください</option>';
		}
		foreach ($listPrefecture as $key => $val) {
			$id = $val['Prefecture']['id'];
			$name = $val['Prefecture']['prefecture_name'];
			if ($idSelected && $idSelected == $id) {
				$options .= "<option value='$id' selected='selected'>$name</option>\n";
			} else {
				$options .= "<option value='$id'>$name</option>\n";
			}
		}
		return $options;
	}
	/**
     * Create options for select of attribute
     *
     * @param int $idSelected
     * @return  String
     */
	function _createAttributeSelect($idSelected = NULL) {
		$this->loadModel('Attribute');
		$params = array(
			'order' => 'Attribute.id ASC',
			'fields' => array('Attribute.id', 'Attribute.attribute_name'),
		);
		$listAttribute = $this->Attribute->find('all', $params);
		
		$options = "";
		if (!$idSelected || $idSelected == "") {
			$options .= '<option value="" selected="selected">以下からお選びください</option>';
		}
		foreach ($listAttribute as $key => $val) {
			$id = $val['Attribute']['id'];
			$name = $val['Attribute']['attribute_name'];
			if ($idSelected && $idSelected == $id) {
				$options .= "<option value='$id' selected='selected'>$name</option>\n";
			} else {
				$options .= "<option value='$id'>$name</option>\n";
			}
		}
		return $options;
	}
	/**
	 * Create options for select of category
	 *
	 * @param int $idSelected
	 * @return  String
	 */
	function _createCategorySelect($idSelected = NULL) {
		$this->loadModel('Category');
		$cond = array('Category.delete_flg' => 0);
		$params = array(
			'order' => 'Category.sort_no',
			'conditions' => $cond,
		);
		$listCategory = $this->Category->find('all', $params);
	
		$options = "";
		if (!$idSelected) {
			$options .= '<option value="" selected="selected">選択しない</option>';
			$options .= "\n";
		}
		foreach ($listCategory as $key => $val) {
			$id = $val['Category']['no'];
			$name = $val['Category']['name'];
			if ($idSelected && $idSelected == $id) {
				$options .= "<option value='$id' selected='selected'>$name</option>\n";
			} else {
				$options .= "<option value='$id'>$name</option>\n";
			}
		}
		return $options;
	}
	/**
	 * Create options for select of japan year
	 *
	 * @param int $idSelected
	 * @return  String
	 */
	function _createJYearSelect($idSelected = NULL) {
		function getJYear($format, $timestamp = null)
	    {
	        if ($timestamp === null) {
	            $timestamp = time();
	        }

	        $ymd = date('Ymd', $timestamp);
	        $year = date('Y', $timestamp);
	        if ($ymd <= "19120729") {
	            $label = "明治";
	            $wareki = $year - 1867;
	        } else if ($ymd >= "19120730" && $ymd <= "19261224") {
	            $label = "大正";
	            $wareki = $year - 1911;
	        } else if ($ymd >= "19261225" && $ymd <= "19890107") {
	            $label = "昭和";
	            $wareki = $year - 1925;
	        } else if ($ymd >= "19890108") {
	            $label = "平成";
	            $wareki = $year - 1988;
	        }

	        $ret = date($format, $timestamp);
	        $ret = str_replace('V', $label, $ret);
	        $ret = str_replace('v', $wareki, $ret);

	        return $ret;
	    }
	    $year = array();
		for ($i = date('Y'); 1930 <= $i; $i--) {
            $time = mktime(0, 0, 0, 1, 10, $i);
            $year[$i] = array('name' => getJYear('Y年 (Vv年)', $time));
        }
        $options = "<option value=''>--</option>\n";
        if (isset($idSelected)) {
        	foreach ($year as $key => $val) {
	        	$name = $val['name'];
	        	if ($idSelected == $key) {
	        		$options .= "<option value='$key' selected='selected'>$name</option>\n";
	        	} else {
	        		$options .= "<option value='$key'>$name</option>\n";
	        	}
	        }
        } else {
	        foreach ($year as $key => $val) {
	        	$name = $val['name'];
	        	$options .= "<option value='$key'>$name</option>\n";
	        }
	    }
        return $options;
	}
	/**
	 * Create options for select of month
	 *
	 * @param int $idSelected
	 * @return  String
	 */
	function _createMonthSelect($idSelected = NULL) {
		$options = "<option value=''>--</option>\n";
		for ($i=1; $i <= 12; $i++) { 
			if (isset($idSelected) && $idSelected == $i) {
				$options .= "<option value='$i' selected='selected'>$i</option>\n";
			} else {
				$options .= "<option value='$i'>$i</option>\n";
			}
		}
		return $options;
	}
	/**
	 * Create options for select of date
	 *
	 * @param int $idSelected
	 * @return  String
	 */
	function _createDateSelect($idSelected = NULL) {
		$options = "<option value=''>--</option>\n";
		for ($i=1; $i <= 31; $i++) { 
			if (isset($idSelected) && $idSelected == $i) {
				$options .= "<option value='$i' selected='selected'>$i</option>\n";
			} else {
				$options .= "<option value='$i'>$i</option>\n";
			}
		}
		return $options;
	}
	/**
	 * Create options for select of Whichkn
	 *
	 * @param int $idSelected
	 * @return  String
	 */
	function _createWhichknSelect($idSelected = NULL) {
		$this->loadModel('Whichkn');
		$params = array(
			'order' => 'Whichkn.id ASC',
			'fields' => array('Whichkn.id', 'Whichkn.which_kn'),
			'conditions' => array('Whichkn.delete_flg' => 0),
		);
		$listWhichkn = $this->Whichkn->find('all', $params);

		$options = "";
		if (!$idSelected) {
			$options .= "<option value=''>以下からお選びください</option>\n";
		}
		foreach ($listWhichkn as $key => $val) {
			$name = $val['Whichkn']['which_kn'];
			if (isset($idSelected) && $idSelected == $name) {
				$options .= "<option value='$name' selected='selected'>$name</option>\n";
			} else {
				$options .= "<option value='$name'>$name</option>\n";
			}
		}
		return $options;
	}
	/**
	 * Create input checkbox of Question Category
	 *
	 * @param array $checked
	 * @return  String
	 */
	function _createQuestionCateCheckbox($checked = NULL) {
		$this->loadModel('QuestionCategory');
		$params = array(
			'order' => 'QuestionCategory.id ASC',
			'fields' => array('QuestionCategory.id', 'QuestionCategory.category_name'),
			'conditions' => array('QuestionCategory.delete_flg' => 0),
		);
		$listQuestionCategory = $this->QuestionCategory->find('all', $params);

		$options = "";
		foreach ($listQuestionCategory as $key => $val) {
			$name = $val['QuestionCategory']['category_name'];
			if (isset($checked) && (array_search($name, $checked) === 0 || array_search($name, $checked) > 0 )) {
				$options .= "<input type='checkbox' name='data[Member][question][]' value='$name' checked='checked'>$name<br>";
			} else {
				$options .= "<input type='checkbox' name='data[Member][question][]' value='$name'>$name<br>";
			}
		}
		return $options;
	}
	/**
	 * Create radio of Relation
	 *
	 * @param int $checked
	 * @return  String
	 */
	function _createRelationRadio($checked = NULL) {
		$this->loadModel('Relation');
		$params = array(
			'order' => 'Relation.id ASC',
			'fields' => array('Relation.id', 'Relation.relation_name'),
			'conditions' => array('Relation.delete_flg' => 0),
		);
		$listRelation = $this->Relation->find('all', $params);

		$options = "";
		foreach ($listRelation as $key => $val) {
			$name = $val['Relation']['relation_name'];
			if (isset($checked) && $checked == $name) {
				$options .= "<label><input type='radio' name='data[Member][relation]' value='$name' checked='checked'/>$name</label><br>";
			} else {
				$options .= "<label><input type='radio' name='data[Member][relation]' value='$name'/>$name</label><br>";
			}
		}
		return $options;
	}
	/**
	 * Create radio of Age
	 *
	 * @param int $checked
	 * @return  String
	 */
	function _createAgeRadio($checked = NULL) {
		$this->loadModel('Age');
		$params = array(
			'order' => 'Age.id ASC',
			'fields' => array('Age.id', 'Age.name'),
			'conditions' => array('Age.delete_flg' => 0),
		);
		$listAge = $this->Age->find('all', $params);

		$options = "";
		foreach ($listAge as $key => $val) {
			$name = $val['Age']['name'];
			if (isset($checked) && $checked == $name) {
				$options .= "<label><input type='radio' name='data[Member][age]' value='$name' checked='checked'/>$name</label><br>";
			} else {
				$options .= "<label><input type='radio' name='data[Member][age]' value='$name'/>$name</label><br>";
			}
		}
		return $options;
	}
	/**
	 * Create radio of Situation
	 *
	 * @param int $checked
	 * @return  String
	 */
	function _createSituationRadio($checked = NULL) {
		$this->loadModel('Situation');
		$params = array(
			'order' => 'Situation.id ASC',
			'fields' => array('Situation.id', 'Situation.name'),
			'conditions' => array('Situation.delete_flg' => 0),
		);
		$listSituation = $this->Situation->find('all', $params);

		$options = "";
		foreach ($listSituation as $key => $val) {
			$name = $val['Situation']['name'];
			if (isset($checked) && $checked == $name) {
				$options .= "<label><input type='radio' name='data[Member][situation]' value='$name' checked='checked'/>$name</label><br>";
			} else {
				$options .= "<label><input type='radio' name='data[Member][situation]' value='$name'/>$name</label><br>";
			}
		}
		return $options;
	}
	/**
	 * Create radio of Care Degree
	 *
	 * @param int $checked
	 * @return  String
	 */
	function _createCareDegreeRadio($checked = NULL) {
		$this->loadModel('CareDegree');
		$params = array(
			'order' => 'CareDegree.id ASC',
			'fields' => array('CareDegree.id', 'CareDegree.name'),
			'conditions' => array('CareDegree.delete_flg' => 0),
		);
		$listCareDegree = $this->CareDegree->find('all', $params);

		$options = "";
		foreach ($listCareDegree as $key => $val) {
			$name = $val['CareDegree']['name'];
			if (isset($checked) && $checked == $name) {
				$options .= "<label><input type='radio' name='data[Member][care_degree]' value='$name' checked='checked'/>$name</label><br>";
			} else {
				$options .= "<label><input type='radio' name='data[Member][care_degree]' value='$name'/>$name</label><br>";
			}
		}
		return $options;
	}
	
	/**
	 * Check if admin is logging in
	 * @return boolean
	 */
	function _isAdmin() {
		$infoCookie = $this->Cookie->read('bbs');
		if(isset($infoCookie)) {
			$checkAdmin = split(":", $infoCookie);
			$id = $checkAdmin[0];
			if ($id == 'admin') {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check cookie
	 *
	 * @return  Array
	 */
	function _checkCookie() {
		// check cookie
		$infoCookie = $this->Cookie->read('bbs');
		if (!isset($infoCookie)) {
			$this->redirect('/login');
		}
		$check = split(":", $infoCookie);
		$id = $check[0];
		$ps = $check[1];
		// check in db
		$fields = array('Member.no', 'Member.handle', 'Member.mail', 'Member.attribute', 'ma.attribute_name');
		$conditions = array('Member.id' => $id, 'Member.ps' => $ps, 'Member.flag' => 1, 'Member.delete_flg' => 0);
		$joins = array(
			array(
				'table' => 'm_attribute',
				'alias' => 'ma',
				'type' => 'INNER',
				'foreignKey' => false,
				'conditions' => array('Member.attribute = ma.id'),
			),
		);
		$info = $this->Member->find('all', array('fields' => $fields, 'conditions' => $conditions, 'joins' => $joins));
		
		if (count($info) != 1) {
			$this->set('validationErrorsArray', array(array('不正な処理をした可能性があります。')));
			$this->render('/Login/index');
		}
		$this->set('info', $info);
	}
	/**
	 * Before Render Template
	 */
	function beforeRender() {
		if ($this->viewPath == 'Errors') {
			$this->layout = '';
		}
	}
}
