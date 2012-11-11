<?php

class Model_DB_Flow_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_Flow_Object';

    public function getAssocArray (){

        return array(
            Model_DB_Flow_Table::FIELDS_ID => $this->getId()
        );
    }

}
