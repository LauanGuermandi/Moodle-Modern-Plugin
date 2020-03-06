<?php

namespace App\Traits;

use dml_exception;
use stdClass;

if(!trait_exists('CourseHelpers')){
    trait CourseHelpers
    {
        /**
         * Get course from cmid.
         * @param $cmid
         * @return bool
         */
        public static function get_course_from_cmid($cmid)
        {
            global $DB;

            $query = "select c.* from {course_modules} as cm
                        left join {course} as c 
                        on c.id = cm.course
                        where cm.id = :cmid";

            $params = [
                'cmid' => $cmid
            ];

            try {
                $result = $DB->get_record_sql($query, $params);

                if(empty($result)){
                    return false;
                }

                return $result;
            } catch (dml_exception $d) {
                error_log('Error: ' . $d->getMessage());
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
            }

            return false;
        }

        /**
         * Return course name from id.
         * @param $id
         * @return bool
         */
        public static function get_course_name($id)
        {
            global $DB;

            $query = "select * from {course} where id = :id";

            $params = [
                'id' => $id
            ];

            try {
                $result = $DB->get_record_sql($query, $params);
                return $result->fullname;
            } catch (dml_exception $d) {
                error_log('Error: ' . $d->getMessage());
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
            }

            return false;
        }
    }
}
