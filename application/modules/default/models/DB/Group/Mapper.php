<?php

class Model_DB_Group_Mapper extends Model_Abstract_DBMapper{

    const CLASS_NAME = 'Model_DB_Group_Mapper';

    /**
     * @param $row
     * @param \Model_DB_Group_Object $db_model
     * @return Model_DB_Group_Object
     */
    public function parseRow ( $row, Model_DB_Group_Object $db_model = null ){

        if ( null === $db_model ){
            $db_model = new Model_DB_Group_Object();
        }

        return $db_model
            ->setName( $row[ Model_DB_Group_Table::FIELDS_NAME ] )
            ->setIdSpecialityFk( $row[ Model_DB_Group_Table::FIELDS_ID_SPECIALITY_FK ] )
            ->setId( $row[ Model_DB_Group_Table::FIELDS_ID ] );
    }

    public function __construct (){
        parent::__construct( 'Model_DB_Group_Object', 'Model_DB_Group_Table' );
    }

    /**
     * @return Model_DB_Group_Mapper
     */
    public static function get_instance (){
        return parent::get_instance();
    }
}
