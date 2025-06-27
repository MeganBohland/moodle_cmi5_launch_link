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
 * Class to handle Assignable Units.
 *
 * @copyright  2023 Megan Bohland
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package mod_cmi5launch
 */
namespace mod_cmi5launch\local;
defined('MOODLE_INTERNAL') || die();
// Include the errorover (error override) funcs.
require_once($CFG->dirroot . '/mod/cmi5launch/classes/local/errorover.php');

/**
 * Class au
 *
 * This class is used to create an AU object from a statement.
 * It is used to handle the data for an AU in the cmi5launch module.
 *
 * @package mod_cmi5launch\local
 */
class au {

    /**
     * Lowercase values are for saving to DB.
     *  
     */ 
    public $id, $attempt, $url, $type, $lmsid, $grade, $scores, $title, $moveon, $auindex, $parents, $objectives,
    $description, $activitytype, $launchmethod, $masteryscore, $satisfied, $launchurl, $sessions, $progress, $noattempt,
    $completed, $passed, $inprogress, $userid, $moodlecourseid;

    /* Uppercase values because that's how they come from player.
     * Moodle wants all lowercase, but we need to be able to receive the data from the player.
     */
     public $launchMethod, $lmsId, $moveOn, $auIndex, $activityType, $masteryScore;
    
    /**
     * Constructs AUs. Is fed array and where array key matches property, sets the property.
     * @param mixed $statement - Data to make AU.
     * @throws \mod_cmi5launch\local\nullException
     */
    public function __construct($statement) {

        // or that the statement is not an array or not an object.
        if (is_null($statement) || (!is_array($statement) && !is_object($statement) )) {

            throw new nullException(get_string('cmi5launchaubuilderror', 'cmi5launch'), 0);
        }
        // If it is an array, create the object.
        foreach ($statement as $key => $value) {

            $this->$key = ($value);
        }
    }
}
