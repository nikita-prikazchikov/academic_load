<?php

include_once "AbstractCtrl.php";

class DisciplineController extends AbstractCtrl {

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
            $disciplineId = $this->getRequestIdDiscipline();
            if ( $disciplineId == 0 ) {
                $discipline = new Model_DB_Discipline_Object();
            }
            else {
                $discipline = Model_DB_Discipline_Mapper::get_instance()->find( $disciplineId );
            }
            $discipline->setName( $this->getRequestName());
            $discipline->save();

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
            $disciplineId = $this->getRequestIdDiscipline();
            if ( $disciplineId == 0 ) {
                $discipline = new Model_DB_Discipline_Object();
            }
            else {
                $discipline = Model_DB_Discipline_Mapper::get_instance()->find( $disciplineId );
            }
            $this->view->assign( "id_speciality", $this->getRequestIdSpeciality() );
            $this->view->assign( "discipline", $discipline );
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

	public function listAction () {
		try {
            $disciplineList = new Model_Discipline_List();
			$this->view->assign( "disciplineList", $disciplineList );
		}
		catch ( Exception $e ) {
			echo $e->getMessage();
		}
	}

	public function viewAction () {
		$this->listAction();
	}
}