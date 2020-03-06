<?php

namespace App\Classes;

require_once __DIR__ . '/../../../config.php';

if(!class_exists('Globals')){
    abstract class Globals
    {

        /**
         * @return object|stdClass
         */
        protected function getCFG()
        {
            global $CFG;
            return $CFG;
        }

        /**
         * @return moodle_database
         */
        protected function getDB()
        {
            global $DB;
            return $DB;
        }

        /**
         * @return moodle_page
         */
        protected function getPAGE()
        {
            global $PAGE;
            return $PAGE;
        }

        /**
         * @return bootstrap_renderer|object
         */
        protected function getOUTPUT()
        {
            global $OUTPUT;
            return $OUTPUT;
        }

        /**
         * @return mixed|object
         */
        protected function getUSER()
        {
            global $USER;
            return $USER;
        }
    }
}
