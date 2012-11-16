<?php

include_once "AbstractCtrl.php";

class UserController extends AbstractCtrl {

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
            $specialityId = $this->getRequestIdUser();
            if ( $specialityId == 0 ) {
                $speciality = new Model_DB_User_Object();
            }
            else {
                $speciality = Model_DB_User_Mapper::get_instance()->find( $specialityId );
            }
            $speciality->setName( $this->getRequestName());
            $speciality->save();

            $data[ 'success' ] = true;
        }
        catch ( Exception $e ) {
            $data[ 'success' ] = false;
            $data[ 'message' ] = $e->getMessage();
        }

        $this->_helper->json->sendJson( $data );
    }

    public function dialogAction () {
        try {
            $userId = $this->getRequestIdUser();
            if ( $userId == 0 ) {
                $user = new Model_DB_User_Object();
            }
            else {
                $user = Model_DB_User_Mapper::get_instance()->find( $userId );
            }
            $this->view->assign( "user", $user );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public function listAction () {
        try {
            $userList = new Model_User_List();
            $this->view->assign( "userList", $userList );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public function viewAction () {
        $this->listAction();
    }
}