<?php

class Model_DB_Year_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Year_Object';

    protected $_name;

    public function getAssocArray (){

        return array(
            Model_DB_Year_Table::FIELDS_ID => $this->getId(),
            Model_DB_Year_Table::FIELDS_NAME => $this->getName()
        );
    }

    public function setName ( $name ){
        $this->_name = $name;
        return $this;
    }

    public function getName (){
        return $this->_name;
    }


}
