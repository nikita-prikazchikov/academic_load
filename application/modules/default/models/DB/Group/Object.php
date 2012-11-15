<?php

class Model_DB_Group_Object extends Model_Abstract_DBObject {

    const CLASS_NAME = 'Model_DB_Group_Object';

    protected $_name;
    protected $_id_speciality_fk;
    /** @var Model_DB_Speciality_Object */
    private $_speciality;

    public function getAssocArray () {

        return array(
            Model_DB_Group_Table::FIELDS_ID => $this->getId(),
            Model_DB_Group_Table::FIELDS_NAME => $this->getName(),
            Model_DB_Group_Table::FIELDS_ID_SPECIALITY_FK => $this->getIdSpecialityFk()
        );
    }

    public function save () {
        Model_DB_Group_Mapper::get_instance()->save( $this );
    }

    /**
     * @return Model_DB_Speciality_Object
     */
    public function getSpeciality () {
        if ( is_null( $this->_speciality ) ) {
            $this->_speciality = Model_DB_Speciality_Mapper::get_instance()->find( $this->getIdSpecialityFk() );
        }
        return $this->_speciality;
    }

    public function setIdSpecialityFk ( $id_speciality_fk ) {
        $this->_id_speciality_fk = $id_speciality_fk;
        return $this;
    }

    public function getIdSpecialityFk () {
        return $this->_id_speciality_fk;
    }

    public function setName ( $name ) {
        $this->_name = $name;
        return $this;
    }

    public function getName () {
        return $this->_name;
    }


}
