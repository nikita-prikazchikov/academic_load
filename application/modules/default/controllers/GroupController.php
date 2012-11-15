<?php

include_once "AbstractCtrl.php";

class GroupController extends AbstractCtrl {

    public function init () {
        parent::init();
    }

    public function editAction () {

        $data = array();
        try {
            $groupId = $this->getRequestIdGroup();
            if ( $groupId == 0 ) {
                $group = new Model_DB_Group_Object();
            }
            else {
                $group = Model_DB_Group_Mapper::get_instance()->find( $groupId );
            }
            $group->setName( $this->getRequestName());
            $group->setIdSpecialityFk( $this->getRequestIdSpeciality());
            $group->save();

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
            $groupId = $this->getRequestIdGroup();
            if ( $groupId == 0 ) {
                $group = new Model_DB_Group_Object();
            }
            else {
                $group = Model_DB_Group_Mapper::get_instance()->find( $groupId );
            }
            $this->view->assign( "id_speciality", $this->getRequestIdSpeciality() );
            $this->view->assign( "group", $group );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

}