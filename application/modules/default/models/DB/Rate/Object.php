<?php

class Model_DB_Rate_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Rate_Object';

    protected $_type;
    protected $_rate;
    protected $_id_year_fk;
    protected $_id_user_fk;

    public function getAssocArray (){

        return array(
            Model_DB_Rate_Table::FIELDS_ID => $this->getId(),
            Model_DB_Rate_Table::FIELDS_RATE => $this->getRate(),
            Model_DB_Rate_Table::FIELDS_ID_YEAR_FK => $this->getIdYearFk(),
            Model_DB_Rate_Table::FIELDS_ID_USER_FK => $this->getIdUserFk(),
        );
    }

    public function setRate ( $rate ){
        $this->_rate = $rate;
        return $this;
    }

    public function getRate (){
        return $this->_rate;
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

    public function setIdUserFk ( $id_user_fk ){
        $this->_id_user_fk = $id_user_fk;
        return $this;
    }

    public function getIdUserFk (){
        return $this->_id_user_fk;
    }


}
