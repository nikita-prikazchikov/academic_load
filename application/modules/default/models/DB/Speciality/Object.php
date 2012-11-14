<?php

class Model_DB_Speciality_Object extends Model_Abstract_DBObject {

    const CLASS_NAME = 'Model_DB_Speciality_Object';

    protected $_name;
    protected $_type;

    private $_groupList;

    public function getAssocArray () {

        return array(
            Model_DB_Speciality_Table::FIELDS_ID => $this->getId(),
            Model_DB_Speciality_Table::FIELDS_NAME => $this->getName(),
            Model_DB_Speciality_Table::FIELDS_TYPE => $this->getType()
        );
    }

    public function save (){
        Model_DB_Speciality_Mapper::get_instance()->save( $this );
    }

    public function setType ( $type ) {
        $this->_type = $type;
        return $this;
    }

    public function getType () {
        return $this->_type;
    }

    public function setName ( $name ) {
        $this->_name = $name;
        return $this;
    }

    public function getName () {
        return $this->_name;
    }

    private function setGroupList ( $groupList ) {
        $this->_groupList = $groupList;
    }

    public function getGroupCollection () {
        if ( is_null( $this->_groupList ) ) {
            $filter = new Model_Group_Filter();
            $filter->setIdSpeciality( $this->getId() );
            $this->setGroupList(
                Model_DB_Group_Mapper::get_instance()->findByFilter( $filter )
            );
        }
        return $this->_groupList;
    }


}
