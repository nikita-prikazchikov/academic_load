<?php

class Model_DB_Data_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Data_Object';

    protected $_type;
    protected $_hours;
    protected $_id_speciality_fk;
    protected $_id_year_fk;
    protected $_semester;
    protected $_id_user_fk;
    protected $_id_flow_fk;
    protected $_id_group_composition_fk;

    public function getAssocArray (){

        return array(
            Model_DB_Data_Table::FIELDS_ID => $this->getId(),
            Model_DB_Data_Table::FIELDS_HOURS => $this->getHours(),
            Model_DB_Data_Table::FIELDS_ID_SPECIALITY_FK => $this->getIdSpecialityFk(),
            Model_DB_Data_Table::FIELDS_ID_YEAR_FK => $this->getIdYearFk(),
            Model_DB_Data_Table::FIELDS_SEMESTER => $this->getSemester(),
            Model_DB_Data_Table::FIELDS_TYPE => $this->getType(),
            Model_DB_Data_Table::FIELDS_ID_USER_FK => $this->getIdUserFk(),
            Model_DB_Data_Table::FIELDS_ID_FLOW_FK => $this->getIdFlowFk(),
            Model_DB_Data_Table::FIELDS_ID_GROUP_COMPOSITION_FK => $this->getIdGroupCompositionFk()
        );
    }

    public function save(){
        Model_DB_Data_Mapper::get_instance()->save( $this );
    }

    public function setHours ( $hours ){
        $this->_hours = $hours;
        return $this;
    }

    public function getHours (){
        return $this->_hours;
    }

    public function setSemester ( $semester ){
        $this->_semester = $semester;
        return $this;
    }

    public function getSemester (){
        return $this->_semester;
    }

    public function setIdSpecialityFk ( $id_speciality_fk ){
        $this->_id_speciality_fk = $id_speciality_fk;
        return $this;
    }

    public function getIdSpecialityFk (){
        return $this->_id_speciality_fk;
    }

    public function setIdYearFk ( $id_year_fk ){
        $this->_id_year_fk = $id_year_fk;
        return $this;
    }

    public function getIdYearFk (){
        return $this->_id_year_fk;
    }

    public function setType ( $type ){
        $this->_type = $type;
        return $this;
    }

    public function getType (){
        return $this->_type;
    }

    public function setIdFlowFk ( $id_flow_fk ){
        $this->_id_flow_fk = $id_flow_fk;
        return $this;
    }

    public function getIdFlowFk (){
        return $this->_id_flow_fk;
    }

    public function setIdGroupCompositionFk ( $id_group_composition_fk ){
        $this->_id_group_composition_fk = $id_group_composition_fk;
        return $this;
    }

    public function getIdGroupCompositionFk (){
        return $this->_id_group_composition_fk;
    }

    public function setIdUserFk ( $id_user_fk ){
        $this->_id_user_fk = $id_user_fk;
        return $this;
    }

    public function getIdUserFk (){
        return $this->_id_user_fk;
    }


}
