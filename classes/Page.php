<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Classes;

use App\Traits\CourseHelpers;
use App\Traits\Request;
use coding_exception;
use context_course;
use moodle_exception;
use moodle_url;

if(!class_exists('Page')) {
    class Page extends Globals
    {
        use CourseHelpers;

        /**
         * @param $component
         * @param $cmid
         * @param string $style
         */
        protected function config_page($component, $cmid, $style="")
        {
            try {
                $this->getPAGE()->set_url(self::get_url());

                $course = $this->get_course_from_cmid($cmid);
                $context = context_course::instance($course->id);

                $this->getPAGE()->set_context($context);

                if(!empty($style)) {
                    $this->getPAGE()->requires->css($style);
                }

                $this->getPAGE()->navbar->ignore_active();

                /** Add course link */
                $this->getPAGE()->navbar->add(
                    $course->fullname,
                    new moodle_url('/course/view.php?id=' . $course->id)
                );

                /** Add page link to navbar */
                $this->getPAGE()->navbar->add(
                    get_string('modulename', $component),
                    new moodle_url('view.php?id=' . $cmid)
                );
            } catch (coding_exception $c) {
                error_log('Error: ' . $c->getMessage());
            } catch (moodle_exception $m) {
                error_log('Error: ' . $m->getMessage());
            } catch (Exception $e) {
                error_log('Error: ' . $e->getMessage());
            }
        }

        /**
         * @return string
         */
        private static function get_url()
        {
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://"
                . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        /**
         * @param $path
         * @param $method
         * @param $params
         */
        public function add_script($path, $method, $params)
        {
            $this->getPAGE()->requires->js_call_amd($path, $method, $params);
        }
    }
}
