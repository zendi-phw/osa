<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * The main mod_osa questiontype checkbox configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once("$CFG->libdir/formslib.php");

class edit_questiontype_checkbox_class extends moodleform {
    public function definition() {
        global $CFG;

        $select = osa_get_editor_select_options_amount(20);
        
        $standardsizeformlength = osa_get_mform_length();
        
        $mform = $this->_form;

        // Set coursemodule.
        $cm = $this->_customdata['cm'];
        // Set context.
        $context = context_module::instance($cm->id);

        // Get options for editor.
        $seteditorsettingsosasettingcheckboxtexteditor = osa_get_editor_options_edit_questiontype_checkbox($context);
        
        // Add hidden elements. Contain handed over values see $passinfotoform var in edit_questiontype_checkbox.php
        $mform->addElement('hidden', 'cmid', $this->_customdata['cmid']);
        $mform->setType('cmid', PARAM_INT);
        
        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);

        $currentdata = $this->_customdata['currentdata']; // Get current data from draft area to display later in the form. The data is passed to the form via the $passinfotoform array.

        $recordid = $this->_customdata['id'];
        
        // Add mform elements to display later.

        // Checkbox name.
        $mform->addElement('header', 'checkboxheadername', get_string('cbheadername', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'cbname', get_string('checkboxname', 'mod_osa'), $standardsizeformlength);
        $mform->setType('cbname', PARAM_TEXT);

        // Checkbox steps part.
        $mform->addElement('header', 'checkboxheaderstep1', get_string('checkboxheaderstep1', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('editor', 'cbtextdesc01_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc01_editor', PARAM_RAW);
        
        $mform->addElement('header', 'checkboxheaderstep2', get_string('checkboxheaderstep2', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc02_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc02_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep3', get_string('checkboxheaderstep3', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc03_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc03_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep4', get_string('checkboxheaderstep4', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc04_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc04_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep5', get_string('checkboxheaderstep5', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc05_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc05_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep6', get_string('checkboxheaderstep6', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc06_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc06_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep7', get_string('checkboxheaderstep7', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc07_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc07_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep8', get_string('checkboxheaderstep8', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc08_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc08_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep9', get_string('checkboxheaderstep9', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc09_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc09_editor', PARAM_RAW);

        $mform->addElement('header', 'checkboxheaderstep10', get_string('checkboxheaderstep10', 'mod_osa')); // ToDo Add lang string.

        $mform->addElement('editor', 'cbtextdesc10_editor', get_string('checkboxtextdesc', 'mod_osa'), null, $seteditorsettingsosasettingcheckboxtexteditor);
        $mform->setType('cbtextdesc10_editor', PARAM_RAW);


        // Add action buttons for either saving data to db or cancel the form.
        $this->add_action_buttons();

        // Set existing data.
        $this->set_data($currentdata);
    }
//    Validation
    function validation($data, $files) {
        return array();
    }
}
