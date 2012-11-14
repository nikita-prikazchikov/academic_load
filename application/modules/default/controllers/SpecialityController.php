<?php

include_once "AbstractCtrl.php";

class SpecialityController extends AbstractCtrl {

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
            $specialityId = $this->getRequestIdSpeciality();
            if ( $specialityId == 0 ) {
                $speciality = new Model_DB_Speciality_Object();
            }
            else {
                $speciality = Model_DB_Speciality_Mapper::get_instance()->find( $specialityId );
            }
            $speciality->setName( $this->getRequestName());
            $speciality->setType( $this->getRequestType());
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
            $specialityId = $this->getRequestIdSpeciality();
            if ( $specialityId == 0 ) {
                $speciality = new Model_DB_Speciality_Object();
            }
            else {
                $speciality = Model_DB_Speciality_Mapper::get_instance()->find( $specialityId );
            }
            $this->view->assign( "speciality", $speciality );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public function listAction () {
        try {
            $specialityList = new Model_Speciality_List();
            $this->view->assign( "specialityList", $specialityList );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public function viewAction () {
        $this->listAction();
    }
}