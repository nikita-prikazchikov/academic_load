<?php

class AbstractCtrl extends Zend_Controller_Action {

    protected $_acl;
    protected $_redirector;

    const PAGE_TITLE = "";

    protected function setPageTitle ( $value ) {
        $this->view->headTitle( $value );
    }

    /**
     * @return Model_Acl
     */
    protected function getAcl () {
        return $this->_acl;
    }

    public function init () {

//	    $profiler = new Zend_Db_Profiler_Firebug('All DB Queries');
//      $profiler->setEnabled(true);
//
//      // Attach the profiler to your db adapter
//      Zend_Db_Table::getDefaultAdapter()->setProfiler($profiler);
    }

    public function indexAction () {
        Zend_Layout::getMvcInstance()->setLayout( 'layout' );

        $yearId = $this->getRequestIdYear();
        $semester = $this->getRequestSemester();

        if ( $semester ) {
            $this->view->assign( "semester", $semester );
        }
        else {
            $this->view->assign( "semester", "" );
        }

        if ( $yearId ) {
            $yearId = 1;
            $mapper = Model_DB_Year_Mapper::get_instance();
            $yearName = $mapper->getName( $yearId );
            $this->view->assign( "yearId", $yearId );
            $this->view->assign( "yearName", $yearName );
        }
        else {
            $this->view->assign( "yearId", null );
        }
    }

    //================================================================================================================================================

    protected function getRequestId () {
        return $this->getRequest()->getParam( 'id' );
    }

    protected function getRequestIdGroup () {
        return $this->getRequest()->getParam( 'id_group' );
    }

    protected function getRequestIdSpeciality () {
        return $this->getRequest()->getParam( 'id_speciality' );
    }

    protected function getRequestIdUser () {
        return $this->getRequest()->getParam( 'id_user' );
    }

    protected function getRequestIdYear () {
        return $this->getRequest()->getParam( 'id_year' );
    }

    protected function getRequestName () {
        return $this->getRequest()->getParam( 'name' );
    }

    protected function getRequestSemester () {
        return $this->getRequest()->getParam( 'semester' );
    }

    protected function getRequestType () {
        return $this->getRequest()->getParam( 'type' );
    }
}