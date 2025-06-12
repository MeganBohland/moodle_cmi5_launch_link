<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Description of cmi5launch restore task
 *
 * @package    mod_cmi5launch
 * @copyright  2016 onward Remote-Learner.net Inc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/cmi5launch/backup/moodle2/restore_cmi5launch_stepslib.php'); // Because it exists (must).

class restore_cmi5launch_activity_task extends restore_activity_task {

    /**
     * Define (add) particular settings this activity can have.
     *
     * @return void
     */
    protected function define_my_settings() {
        // No particular settings for this activity.
    }

    /**
     * Define (add) particular steps this activity can have.
     *
     * @return void
     */
    protected function define_my_steps() {
        // Choice only has one structure step.
        $this->add_step(new restore_cmi5launch_activity_structure_step('cmi5launch_structure', 'cmi5launch.xml'));
    }

    /**
     * Define the contents in the activity that must be
     * processed by the link decoder.
     *
     * @return array
     */
    public static function define_decode_contents() {
        $contents = array();

        $contents[] = new restore_decode_content('cmi5launch', array('intro'), 'cmi5launch');

        return $contents;
    }

    /**
     * Define the decoding rules for links belonging
     * to the activity to be executed by the link decoder.
     *
     * @return array
     */
    public static function define_decode_rules() {
        $rules = array();

        // List of cmi5launchs in course.
        $rules[] = new restore_decode_rule('cmi5LAUNCHINDEX', '/mod/cmi5launch/index.php?id=$1', 'course');

        // Cmi5launch by cm->id.
        $rules[] = new restore_decode_rule('cmi5LAUNCHVIEWBYID', '/mod/cmi5launch/view.php?id=$1', 'course_module');

        // Cmi5launch by cmi5launch->id.
        $rules[] = new restore_decode_rule('cmi5LAUNCHVIEWBYB', '/mod/cmi5launch/view.php?b=$1', 'cmi5launch');

        // Convert old cmi5launch links MDL-33362 & MDL-35007.
        $rules[] = new restore_decode_rule('cmi5LAUNCHSTART', '/mod/cmi5launch/view.php?id=$1', 'course_module');

        return $rules;
    }

    /**
     * Define the restore log rules that will be applied
     * by the {@link restore_logs_processor} when restoring
     * cmi5launch logs. It must return one array
     * of {@link restore_log_rule} objects.
     *
     * @return array
     */
    public static function define_restore_log_rules() {
        $rules = array();

        $rules[] = new restore_log_rule('cmi5launch', 'add', 'view.php?id={course_module}', '{cmi5launch}');
        $rules[] = new restore_log_rule('cmi5launch', 'update', 'view.php?id={course_module}', '{cmi5launch}');
        $rules[] = new restore_log_rule('cmi5launch', 'view', 'view.php?id={course_module}', '{cmi5launch}');

        return $rules;
    }

    /**
     * Define the restore log rules that will be applied
     * by the {@link restore_logs_processor} when restoring
     * course logs. It must return one array
     * of {@link restore_log_rule} objects.
     *
     * Note this rules are applied when restoring course logs
     * by the restore final task, but are defined here at
     * activity level. All them are rules not linked to any module instance (cmid = 0).
     *
     * @return array
     */
    public static function define_restore_log_rules_for_course() {
        $rules = array();

        $rules[] = new restore_log_rule('cmi5launch', 'view all', 'index.php?id={course}', null);

        return $rules;
    }
}
