<?php

include_once 'AbstractCtrl.php';

class IndexController extends AbstractCtrl{

    public function init() {
        parent::init();
    }

    public function indexAction(){
        parent::indexAction();
        $this->viewAction();
    }

    public function viewAction(){

    }

    public function perioddialogAction(){
        $yearList = new Model_Year_List();
        $this->view->assign( "yearList", $yearList->getListView());
        $this->view->assign( "yearCurrent", Zend_Session::getOptions( "yearId"));
        $this->view->assign( "filter", new Model_Abstract_Filter());
    }

    // ======================================= request getters ======================================================


}

