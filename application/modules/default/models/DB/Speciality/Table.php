<?php

class Model_DB_Speciality_Table extends Model_Abstract_DBTable{

    const CLASS_NAME = 'Model_DB_Speciality_Table';
    const TABLE_NAME = 'speciality';

    const FIELDS_ID = 'id_speciality_pk';
    const FIELDS_NAME = 'name';
    const FIELDS_TYPE = 'type';

    const TYPE_DIARY = "diary";
    const TYPE_EXTRAMURAL = "extramural";
    const TYPE_EVENING = "evening";

    protected $_name = self::TABLE_NAME;
}