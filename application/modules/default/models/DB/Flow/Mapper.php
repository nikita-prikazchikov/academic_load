<?php

class Model_DB_Flow_Mapper extends Model_Abstract_DBMapper{

    const CLASS_NAME = 'Model_DB_Flow_Mapper';

    /**
     * @param $row
     * @param \Model_DB_Flow_Object $db_model
     * @return Model_DB_Flow_Object
     */
    public function parseRow ( $row, Model_DB_Flow_Object $db_model = null ){

        if ( null === $db_model ){
            $db_model = new Model_DB_Flow_Object();
        }

        return $db_model
            ->setId( $row[ Model_DB_Flow_Table::FIELDS_ID ] );
    }

    public function __construct (){
        parent::__construct( 'Model_DB_Flow_Object', 'Model_DB_Flow_Table' );
    }

    /**
     * @return Model_DB_Flow_Mapper
     */
    public static function get_instance (){
        return parent::get_instance();
    }
}
