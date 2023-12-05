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
 * The main mod_osa questiontype textelement configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once($CFG->libdir.'/formslib.php');

class edit_questiontype_textelement_class extends moodleform {
    public function definition() {
        global $CFG, $DB;

        $standardsizeformlength = osa_get_mform_length();

        $mform = $this->_form;

        // Set coursemodule.
        $cm = $this->_customdata['cm'];
        // Set context.
        $context = context_module::instance($cm->id);

        // Get options for editor.
        $seteditorsettingsosasettingedittextelementeditor = osa_get_editor_options_edit_questiontype_textelement($context);

        // Add hidden elements. Contain handed over values see $passinfotoform var in edit_questiontype_textelement.php
        $mform->addElement('hidden', 'cmid', $this->_customdata['cmid']);
        $mform->setType('cmid', PARAM_INT);
        
        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);

        $currentdata = $this->_customdata['currentdata']; // Get current data from draft area to display later in the form. The data is passed to the form via the $passinfotoform array.

        $recordid = $this->_customdata['id'];

        // Textelement name.
        $mform->addElement('header', 'textelementheadername', get_string('textelementheadername', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'textelementname', get_string('textelementname', 'mod_osa'), $standardsizeformlength);
        $mform->setType('textelementname', PARAM_TEXT);

        // Textelement content.
        $mform->addElement('header', 'textelement', get_string('textelement', 'mod_osa'));
        
        $mform->addElement('editor', 'textelementeditor_editor', get_string('textelementtextarea', 'mod_osa'), $recordid, $seteditorsettingsosasettingedittextelementeditor);
        $mform->setType('textelementeditor_editor', PARAM_RAW);

        // Add action buttons for either saving data to db or cancel the form.
        $this->add_action_buttons();

        // Set existing data.
        $this->set_data($currentdata);
    }

    //public function get_data() {
    //    $data = parent::get_data('cm');
    //    return $data;
    //    $cm = $this->_customdata['cm'];
//}

//    Validation
    function validation($data, $files) {
        return array();
    }
}
