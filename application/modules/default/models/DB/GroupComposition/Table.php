<?php

class Model_DB_GroupComposition_Table extends Model_Abstract_DBTable{

    const CLASS_NAME = 'Model_DB_GroupComposition_Table';
    const TABLE_NAME = 'group_composition';

    const FIELDS_ID = 'id_group_composition_pk';
    const FIELDS_SIZE = 'size';
    const FIELDS_SEMESTER = 'semester';
    const FIELDS_ID_YEAR_FK = 'id_year_fk';
    const FIELDS_ID_GROUP_FK = 'id_group_fk';

    const SEMESTER_I = "I";
    const SEMESTER_II = "II";

    protected $_name = self::TABLE_NAME;

}