<?php

class Model_DB_Data_Table extends Model_Abstract_DBTable {

    const CLASS_NAME = 'Model_DB_Data_Table';
    const TABLE_NAME = 'data';

    const FIELDS_ID = 'id_data_pk';
    const FIELDS_TYPE = 'type';
    const FIELDS_HOURS = 'hours';
    const FIELDS_ID_SPECIALITY_FK = 'id_speciality_fk';
    const FIELDS_ID_YEAR_FK = 'id_year_fk';
    const FIELDS_SEMESTER = 'semester';
    const FIELDS_ID_USER_FK = 'id_user_fk';
    const FIELDS_ID_FLOW_FK = 'id_flow_fk';
    const FIELDS_ID_GROUP_COMPOSITION_FK = 'id_group_composition_fk';

    const TYPE_LECTURE = "lecture";
    const TYPE_PRACTICE = "practice";
    const TYPE_LABORATORY = "laboratory";
    const TYPE_RGR = "rgr";
    const TYPE_CREDIT = "credit";
    const TYPE_EXAM = "exam";
    const TYPE_COURSE_WORK = "course_work";
    const TYPE_COURSE_PROJECT = "course_project";
    const TYPE_CONSULTATION = "consultation";
    const TYPE_EXAM_CONSULTATION = "exam_consultation";
    const TYPE_CONTROL_WORK = "control_work";
    const TYPE_SRS = "srs";
    const TYPE_GRADUATE_WORK = "graduate_work";

    const SEMESTER_I = "I";
    const SEMESTER_II = "II";

    protected $_name = self::TABLE_NAME;

}