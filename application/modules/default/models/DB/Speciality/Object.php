<?php

class Model_DB_Speciality_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Speciality_Object';

    protected $_name;
    protected $_type;

    public function getAssocArray (){

        return array(
            Model_DB_Speciality_Table::FIELDS_ID => $this->getId(),
            Model_DB_Speciality_Table::FIELDS_NAME => $this->getName(),
            Model_DB_Speciality_Table::FIELDS_TYPE => $this->getType()
        );
    }

    public function setType ( $type ){
        $this->_type = $type;
        return $this;
    }

    public function getType (){
        return $this->_type;
    }

    public function setName ( $name ){
        $this->_name = $name;
        return $this;
    }

    public function getName (){
        return $this->_name;
    }


}
