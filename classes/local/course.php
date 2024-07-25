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
 * Class to handle invidual courses.
 * @copyright  2023 Megan Bohland
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 namespace mod_cmi5launch\local;
 defined('MOODLE_INTERNAL') || die();

class course {

    // Lowercase values are for saving to DB.
    public $id, $url, $ausgrades, $type, $lmsid, $grade, $scores, $title, $moveon, $auindex,
    $parents, $objectives, $launchurl, $sessions = array(), $sessionid, $returnurl, $description = [], $activitytype, $launchmethod,
    $masteryscore, $progress, $noattempt, $completed, $passed, $inprogress, $satisfied, $moodlecourseid;

    // The id assigned by cmi5 player.
    public $courseid;

    // The user id who is taking the course.
    public $userid;

    // The registration id assigned by the CMI5 player.
    public $registrationid;

    // Array of AUs in the course.
    public $aus = array();

    // Constructs courses. Is fed array and where array key matches property, sets the property.
    public function __construct($statement) {

        foreach ($statement as $key => $value) {

            // If the key exists as a property, set it.
            if (property_exists($this, $key) ) {

                $this->$key = ($value);

                // We want the ID to be null here, so we can assign it later.
                if ($key == 'id') {
                    $this->$key = null;
                }
            }
        }
    }
}
