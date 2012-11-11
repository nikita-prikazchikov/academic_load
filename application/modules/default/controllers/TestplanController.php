<?php

include_once 'AbstractCtrl.php';

class TestplanController extends AbstractCtrl {

	public function init () {
		parent::init();
	}

	public function indexAction () {
		$page = $this->getRequest()->getParam( 'page' );

		switch ( $page ) {
			case "":
			case "view":
				$this->viewAction();
				break;
			case "viewone":
				$this->viewoneAction();
				break;
			case "edit":
				$this->editAction();
				break;
			default:
				break;
		}
		$this->_forward( "index", "index" );
	}

	public function viewAction () {
		try {
			$id = $this->getRequest_ProjectId();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW, $id );

			$m = Model_DBMapper_ApplicationMapper::get_instance();
			$o = $m->find( $id );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such application' );
			}
			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->fetchAll_ByApplication( $id );

			$this->view->assign( "o", $o );
		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function listAction () {
		try {
			$id = $this->getRequest_ProjectId();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW, $id );

			$m = Model_DBMapper_ApplicationMapper::get_instance();
			$o = $m->find( $id );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such application' );
			}
			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->fetchAll_ByApplication( $id );

			$this->view->assign( "o", $o );
		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function viewoneAction () {
		try {
			$id = $this->getRequest_ID();
			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			/** @var $o Model_DBObject_TestPlan */
			$o = $m->find( $id );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW, $o->getIdApplication() );

			$this->view->assign( "o", $o );
			$this->view->assign( "suites", $m->findDependentTestSuites( $id ) );
			$this->view->assign( "browsers", $m->findDependentBrowsers( $id ) );
		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function editAction () {
		try {
			$id = $this->getRequest_ID();

			$o = new Model_DBObject_TestPlan();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT, $o->getIdApplication() );

			$suites = array( new Model_DBObject_TestSuite() );
			$browsers = array( new Model_DBObject_Browser() );
			if ( $id != -1 ) {
				/** @var $m Model_DBMapper_TestPlanMapper */
				$m = Model_DBMapper_TestPlanMapper::get_instance();
				$o = $m->find( $id );
				if ( !isset( $o ) ) {
					throw new Exception( 'There is no such Test Plan' );
				}

				$suites = $m->findDependentTestSuites( $id );
				$browsers = $m->findDependentBrowsers( $id );
			}
			else {
				$o->setActive( true )
						->setId( -1 );
			}
			$this->view->assign( "o", $o );
			$this->view->assign( "suites", $suites );
			$this->view->assign( "browsers", $browsers );
		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function saveAction () {
		$data = array();
		try {
			$id = $this->getRequest_ID();
			$appId = $this->getRequest_ProjectId();
			$name = $this->getRequest_Name();
			$active = $this->getRequest()->getParam( 'active' );
			$description = $this->getRequest()->getParam( 'description' );
			$text = $this->getRequest()->getParam( 'text' );

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT, $appId );

			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = new Model_DBObject_TestPlan();

			if ( $id == -1 ) { // create new test plan
				$mApp = Model_DBMapper_ApplicationMapper::get_instance();
				$app = $mApp->find( $appId );
				if ( !isset( $app ) ) {
					throw new Exception( 'There is no such application' );
				}

				$o->setName( $name )
						->setIdApplication( $appId )
						->setDescription( $description )
						->setActive( $active )
						->setText( $text );

				$m->save( $o );
				if ( $o->getId() > 0 ) {
					$data[ 'success' ] = true;
				}
				else {
					throw new Exception( 'Can not save. Internal error.' );
				}
			}
			else { //update test plan
				/** @var $o Model_DBObject_TestPlan */
				$o = $m->find( $id );
				if ( !isset( $o ) ) {
					throw new Exception( "There is no Test Plan with id [$id]" );
				}

				$o->setName( $name )
						->setDescription( $description )
						->setActive( $active )
						->setText( $text );

				$m->save( $o );
				$data[ 'success' ] = true;
			}
		}
		catch ( Exception $ex ) {
			$data = array(
				"success" => false,
				"error" => $ex->getMessage()
			);
		}
		$this->_helper->json->sendJson( $data );
	}

	public function showsuiteslistAction () {
		try {
			$id = $this->getRequest_ID();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW );

			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->find( $id );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}

			$this->view->assign( "suites", $m->findDependentTestSuites( $id ) );
		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function managesuitesAction () {
		try {
			$projectId = $this->getRequest_ProjectID();
			$planId = $this->getRequest_ID();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT, $projectId );

			$m = Model_DBMapper_ApplicationMapper::get_instance();
			$o = $m->find( $projectId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Application' );
			}

			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->find( $planId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}
			$suitesAssigned = $m->findDependentTestSuites( $planId );

			/** @var $m Model_DBMapper_TestSuiteMapper */
			$m = Model_DBMapper_TestSuiteMapper::get_instance();
			$suitesNotAssigned = $m->fetchAll_NotAssignedOnTestPlan( $planId );

			$this->view->assign( "suitesAssigned", $suitesAssigned );
			$this->view->assign( "suitesNotAssigned", $suitesNotAssigned );

		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function updatesuiteslistAction () {
		$data = array();
		try {
			$projectId = $this->getRequest_ProjectID();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT, $projectId );

			$planId = $this->getRequest_ID();
			$suites = json_decode( $this->getRequest()->getParam( 'suites' ) );

			$m = Model_DBMapper_ApplicationMapper::get_instance();
			$o = $m->find( $projectId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Application' );
			}

			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->find( $planId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}
			/** @var $m Model_DBMapper_TestPlanTestSuiteMapMapper */
			$m = Model_DBMapper_TestPlanTestSuiteMapMapper::get_instance();
			$m->updateTestSuitesOfTestPlan( $planId, $suites );

			$data = array( "success" => true );
		}
		catch ( Exception $ex ) {
			$data = array(
				"success" => false,
				"error" => $ex->getMessage()
			);
		}
		$this->_helper->json->sendJson( $data );
	}

	public function managebrowsersAction () {
		try {
			$projectId = $this->getRequest_ProjectID();
			$planId = $this->getRequest_ID();

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT, $projectId );

			/** @var $m Model_DBMapper_ApplicationMapper */
			$m = Model_DBMapper_ApplicationMapper::get_instance();
			$o = $m->find( $projectId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Application' );
			}

			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->find( $planId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}
			$browsersAssigned = $m->findDependentBrowsers( $planId );

			/** @var $m Model_DBMapper_BrowserMapper */
			$m = Model_DBMapper_BrowserMapper::get_instance();
			$browsersNotAssigned = $m->fetchAll_NotAssignedOnTestPlan( $planId );

			$this->view->assign( "browsersAssigned", $browsersAssigned );
			$this->view->assign( "browsersNotAssigned", $browsersNotAssigned );

		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	public function updatebrowserslistAction () {
		$data = array();
		try {
			$projectId = $this->getRequest_ProjectID();
			$planId = $this->getRequest_ID();
			$browsers = json_decode( $this->getRequest()->getParam( 'browsers' ) );

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT, $projectId );

			$m = Model_DBMapper_ApplicationMapper::get_instance();
			$o = $m->find( $projectId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Application' );
			}

			$m = Model_DBMapper_TestPlanMapper::get_instance();
			$o = $m->find( $planId );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}

			/** @var $m Model_DBMapper_TestPlanBrowserMapMapper */
			$m = Model_DBMapper_TestPlanBrowserMapMapper::get_instance();
			$m->updateBrowsersOfTestPlan( $planId, $browsers );

			$data = array( "success" => true );
		}
		catch ( Exception $ex ) {
			$data = array(
				"success" => false,
				"error" => $ex->getMessage()
			);
		}
		$this->_helper->json->sendJson( $data );
	}

	public function showbrowserslistAction () {
		try {
			$id = $this->getRequest_ID();

			/** @var $m Model_DBMapper_TestPlanMapper */
			$m = Model_DBMapper_TestPlanMapper::get_instance();
			/** @var $o Model_DBObject_TestPlan */
			$o = $m->find( $id );
			if ( !isset( $o ) ) {
				throw new Exception( 'There is no such Test Plan' );
			}

			$this->getAcl()->checkAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW, $o->getIdApplication() );

			$this->view->assign( "browsers", $m->findDependentBrowsers( $id ) );
		}
		catch ( Exception $ex ) {
			echo $ex->getMessage();
		}
	}

	private function getRequest_ID () {
		$value = $this->getRequest()->getParam( 'id' );
		if ( $value < -1 ) {
			throw new Exception( 'Invalid Test Plan ID' );
		}
		return $value;
	}

	private function getRequest_ProjectId () {
		$value = $this->getRequest()->getParam( 'project' );
		if ( $value < 0 ) {
			throw new Exception( 'Invalid application ID' );
		}
		return $value;
	}

	private function getRequest_Name () {
		$value = $this->getRequest()->getParam( 'name' );
		if ( empty( $value ) ) {
			throw new Exception( 'Name can not be empty' );
		}
		return $value;
	}
}

