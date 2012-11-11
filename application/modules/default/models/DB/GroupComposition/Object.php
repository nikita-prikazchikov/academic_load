<?php

class Model_DB_GroupComposition_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_GroupComposition_Object';

    protected $_size;
    protected $_semester;
    protected $_id_year_fk;
    protected $_id_group_fk;

    public function getAssocArray (){

        return array(
            Model_DB_GroupComposition_Table::FIELDS_ID => $this->getId(),
            Model_DB_GroupComposition_Table::FIELDS_SEMESTER => $this->getSemester(),
            Model_DB_GroupComposition_Table::FIELDS_SIZE => $this->getSize(),
            Model_DB_GroupComposition_Table::FIELDS_ID_YEAR_FK => $this->getIdYearFk(),
            Model_DB_GroupComposition_Table::FIELDS_ID_GROUP_FK => $this->getIdGroupFk()
        );
    }

    public function setIdYearFk ( $id_year_fk ){
        $this->_id_year_fk = $id_year_fk;
        return $this;
    }

    public function getIdYearFk (){
        return $this->_id_year_fk;
    }

    public function setIdGroupFk ( $id_group_fk ){
        $this->_id_group_fk = $id_group_fk;
        return $this;
    }

    public function getIdGroupFk (){
        return $this->_id_group_fk;
    }

    public function setSemester ( $semester ){
        $this->_semester = $semester;
        return $this;
    }

    public function getSemester (){
        return $this->_semester;
    }

    public function setSize ( $size ){
        $this->_size = $size;
        return $this;
    }

    public function getSize (){
        return $this->_size;
    }

}
