<?php

class Model_DB_User_Table extends Model_Abstract_DBTable{

    const CLASS_NAME = 'Model_DB_User_Table';
    const TABLE_NAME = 'user';

    const FIELDS_ID = 'id_user_pk';
    const FIELDS_NAME = 'name';

    protected $_name = self::TABLE_NAME;
}