<?php

include_once "AbstractCtrl.php";

class RateController extends AbstractCtrl {

    public function init () {
        parent::init();
    }

    public function indexAction () {
        parent::indexAction();
        $this->listAction();
    }

    public function editAction () {

        $data = array();
        try {
            $rateId = $this->getRequestIdRate();
            if ( $rateId == 0 ) {
                $rate = new Model_DB_Rate_Object();
            }
            else {
                $rate = Model_DB_Rate_Mapper::get_instance()->find( $rateId );
            }
            $rate->setRate( $this->getRequestValue());
            $rate->save();

            $data[ 'success' ] = true;
        }
        catch ( Exception $e ) {
            $data[ 'success' ] = false;
            $data[ 'message' ] = $e->getMessage();
        }

        $this->_helper->json->sendJson( $data );
    }


    public function listAction () {
        try {
            $userList = new Model_User_List();
            $this->view->assign( "userList", $userList );
            $this->view->assign( "filter", new Model_Rate_Filter() );
            $this->view->assign( "yearId", $this->getRequestIdYear() );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public function viewAction () {
        $this->listAction();
    }
}