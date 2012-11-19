<?php

include_once "AbstractCtrl.php";

class LoadingController extends AbstractCtrl {

    public function init () {
        parent::init();
    }

    public function indexAction () {
        parent::indexAction();
        $this->viewAction();
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

    public function viewAction () {
        try {
            $filter = new Model_Data_Filter();
            $this->view->assign( "filter", null );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }
}