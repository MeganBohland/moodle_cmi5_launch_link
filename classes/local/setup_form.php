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
 * Form for cmi5 connection, namely basic info - player url, user name and password. 
 *
 * @copyright  2023 Megan Bohland
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Moodleform is defined in formslib.php.
require_once("$CFG->libdir/formslib.php");

class setup_cmi5 extends moodleform {
    // Add elements to form.
    public function definition() {
        // A reference to the form is stored in $this->form.
        // A common convention is to store it in a variable, such as `$mform`.
        $mform = $this->_form; // Don't forget the underscore!

        // Add elements to your form. Second arg is the name of element
        // Player url.
        $mform->addElement('text', 'cmi5url', get_string('cmi5launchplayerurl', 'cmi5launch'));
        // Set type of element.
        $mform->setType('cmi5url', PARAM_NOTAGS);
        // Default value.
        $mform->setDefault('cmi5url', get_string('cmi5launchplayerurl_default', 'cmi5launch')); // The second arg here is the default value and appears in the text box.
        // Add a rule to make this field required.
        $mform->addRule('cmi5url', 'This is needed to connect to player', 'required'); 
        // Add a help button with a help message.
        $mform->addHelpButton('cmi5url', 'cmi5launchplayerurl', 'cmi5launch');

        // User name.
        $mform->addElement('text', 'cmi5name', get_string('cmi5launchbasicname', 'cmi5launch'));
        // Set type of element.
        $mform->setType('cmi5name', PARAM_NOTAGS);
        // Default value.
        $mform->setDefault('cmi5name', get_string('cmi5launchbasicname_default', 'cmi5launch')); // The second arg here is the default value and appears in the text box.
        // Add a rule to make this field required.
        $mform->addRule('cmi5name', 'This is needed to connect to player', 'required'); 
        // Add a help button with a help message.
        $mform->addHelpButton('cmi5name', 'cmi5launchbasicname', 'cmi5launch');
        
        // Password.
        // Add elements to your form. Second arg is the name of element
        $mform->addElement('text', 'cmi5password', get_string('cmi5launchbasepass', 'cmi5launch'));
        // Set type of element.
        $mform->setType('cmi5password', PARAM_NOTAGS);
        // Default value.
        $mform->setDefault('cmi5password', get_string('cmi5launchbasepass_default', 'cmi5launch')); // The second arg here is the default value and appears in the text box.
        // Add a rule to make this field required.
       $mform->addRule('cmi5password', 'This is needed to connect to player', 'required'); 
       // Below is the help button, it sucks you have to push it to see the help text, but it is there
       $mform->addHelpButton('cmi5password', 'cmi5launchbasepass', 'cmi5launch');

         $this->add_action_buttons();
    }

    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}
