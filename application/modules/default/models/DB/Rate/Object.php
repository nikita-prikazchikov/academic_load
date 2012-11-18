<?php

class Model_DB_Rate_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Rate_Object';

    protected $_rate;
    protected $_id_year_fk;
    protected $_id_user_fk;

    /** @var Model_DB_User_Object */
    private $_user;
    /** @var Model_DB_Year_Object */
    private $_year;

    public function getAssocArray (){

        return array(
            Model_DB_Rate_Table::FIELDS_ID => $this->getId(),
            Model_DB_Rate_Table::FIELDS_RATE => $this->getRate(),
            Model_DB_Rate_Table::FIELDS_ID_YEAR_FK => $this->getIdYearFk(),
            Model_DB_Rate_Table::FIELDS_ID_USER_FK => $this->getIdUserFk(),
        );
    }

    public function save(){
        Model_DB_Rate_Mapper::get_instance()->save($this);
    }

    /**
     * @return Model_Abstract_DBObject|Model_DB_User_Object|null
     */
    public function getUser(){
        if ( is_null ( $this->_user ) ){
            $this->_user = Model_DB_User_Mapper::get_instance()->find( $this->getIdUserFk() );
        }
        return $this->_user;
    }

    /**
     * @return \Model_DB_Year_Object
     */
    public function getYear () {
        if ( is_null ( $this->_year ) ){
            $this->_user = Model_DB_Year_Mapper::get_instance()->find( $this->getIdYearFk() );
        }
        return $this->_year;
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

    public function setIdUserFk ( $id_user_fk ){
        $this->_id_user_fk = $id_user_fk;
        return $this;
    }

    public function getIdUserFk (){
        return $this->_id_user_fk;
    }


}
