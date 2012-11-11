<?php

class Model_DB_Group_Table extends Model_Abstract_DBTable{

    const CLASS_NAME = 'Model_DB_Group_Table';
    const TABLE_NAME = 'group';

    const FIELDS_ID = 'id_group_pk';
    const FIELDS_NAME = 'name';
    const FIELDS_ID_SPECIALITY_FK = 'id_speciality_fk';

    protected $_name = self::TABLE_NAME;

}