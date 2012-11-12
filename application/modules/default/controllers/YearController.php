<?php

include_once "AbstractCtrl.php";

class YearController extends AbstractCtrl {

	public function init () {
		parent::init();
	}

	public function indexAction () {
		parent::indexAction();
		$this->listAction();
	}

	public function editAction (){

		$data = array();

		$this->_helper->json->sendJson( $data );
	}

	public function listAction () {
		try {
            $yearList = new Model_Year_List();
			$this->view->assign( "yearList", $yearList );
		}
		catch ( Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function viewAction () {
		$this->listAction();
	}
}