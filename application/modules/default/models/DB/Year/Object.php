<?php

class Model_DB_Year_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Year_Object';

    protected $_name;

    private $_rateCollection;

    public function getAssocArray (){

        return array(
            Model_DB_Year_Table::FIELDS_ID => $this->getId(),
            Model_DB_Year_Table::FIELDS_NAME => $this->getName()
        );
    }

    public function getRateCollection () {
        if ( is_null( $this->_rateCollection ) ) {
            $filter = new Model_Rate_Filter();
            $filter->setIdYear( $this->getId() );
            $this->_userCollection = Model_DB_Rate_Mapper::get_instance()->findByFilter( $filter );
        }
    }

    public function setName ( $name ){
        $this->_name = $name;
        return $this;
    }

    public function getName (){
        return $this->_name;
    }


}
