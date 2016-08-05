<?php
/**
* Controller common for admin
*/
class AdminController extends AppController {
	public $layout = 'admin';
	public function beforeFilter () {
		if (strstr($this->here, 'admin/user_manager')) {
			$this->set('smenu', ROOT . '/app/View/admin/UserManager/_smenu.ctp');
		}
	}
	
	function index() {
	    
	}
	
	function login () {
	    
	}
	
	function playgame ($id = null) {
	    $info = array(
	                "title_page" => "Game demo",
	                "id" => $id,
	            );
	    $this->set("data", $info);
	}
	
	/**
	 * Function check security csrf
	 * @param String $viewRender
	 */
	function _checkSecurity($viewRender) {
		if ($this->referer() == '/') {
			$this->set('validationErrorsArray', array(array('不正なアクセス')));
		 	$this->render($viewRender);
		}
	}
}
