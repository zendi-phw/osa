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
 * The mod_osa edit_standard_category_values_categories_class form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once($CFG->libdir.'/formslib.php');

class edit_standard_category_values_categories_class extends moodleform {
    public function definition() {
        global $CFG, $DB;

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
//var_dump("<br>\n<br>\ncurrentdata:", $currentdata);

        $currentdata01 = $currentdata->category01;
        $currentdata02 = $currentdata->category02;
        $currentdata03 = $currentdata->category03;
        $currentdata04 = $currentdata->category04;
        $currentdata05 = $currentdata->category05;
        $currentdata06 = $currentdata->category06;
        $currentdata07 = $currentdata->category07;
        $currentdata08 = $currentdata->category08;
        $currentdata09 = $currentdata->category09;
        $currentdata10 = $currentdata->category10;
        $currentdata11 = $currentdata->category11;
        $currentdata12 = $currentdata->category12;
        $currentdata13 = $currentdata->category13;
        $currentdata14 = $currentdata->category14;
        $currentdata15 = $currentdata->category15;
        $currentdata16 = $currentdata->category16;
        $currentdata17 = $currentdata->category17;
        $currentdata18 = $currentdata->category18;
        $currentdata19 = $currentdata->category19;
        $currentdata20 = $currentdata->category20;

        $osa = $this->_customdata['osa']; // Get current osa instance data.
        $osanamecat01 = $osa->namecat01;
        $osanamecat02 = $osa->namecat02;
        $osanamecat03 = $osa->namecat03;
        $osanamecat04 = $osa->namecat04;
        $osanamecat05 = $osa->namecat05;
        $osanamecat06 = $osa->namecat06;
        $osanamecat07 = $osa->namecat07;
        $osanamecat08 = $osa->namecat08;
        $osanamecat09 = $osa->namecat09;
        $osanamecat10 = $osa->namecat10;
        $osanamecat11 = $osa->namecat11;
        $osanamecat12 = $osa->namecat12;
        $osanamecat13 = $osa->namecat13;
        $osanamecat14 = $osa->namecat14;
        $osanamecat15 = $osa->namecat15;
        $osanamecat16 = $osa->namecat16;
        $osanamecat17 = $osa->namecat17;
        $osanamecat18 = $osa->namecat18;
        $osanamecat19 = $osa->namecat19;
        $osanamecat20 = $osa->namecat20;

        $records = $this->_customdata['records'];

        $mform->addElement('header', 'choosestandardvaluebasedoncategory', get_string('choosestdvaluebocategory', 'mod_osa'));


            $selectidfeature = osa_get_editor_select_options_standard_values(10);

	    $mform->addElement('select', 'osanamecat01', get_string('namecat01', 'mod_osa') . ": " . $osanamecat01, $selectidfeature);
            $mform->setDefault('osanamecat01', $currentdata01);
	    $mform->addElement('select', 'osanamecat02', get_string('namecat02', 'mod_osa') . ": " . $osanamecat02, $selectidfeature);
            $mform->setDefault('osanamecat02', $currentdata02);
	    $mform->addElement('select', 'osanamecat03', get_string('namecat03', 'mod_osa') . ": " . $osanamecat03, $selectidfeature);
            $mform->setDefault('osanamecat03', $currentdata03);
	    $mform->addElement('select', 'osanamecat04', get_string('namecat04', 'mod_osa') . ": " . $osanamecat04, $selectidfeature);
            $mform->setDefault('osanamecat04', $currentdata04);
	    $mform->addElement('select', 'osanamecat05', get_string('namecat05', 'mod_osa') . ": " . $osanamecat05, $selectidfeature);
            $mform->setDefault('osanamecat05', $currentdata05);
	    $mform->addElement('select', 'osanamecat06', get_string('namecat06', 'mod_osa') . ": " . $osanamecat06, $selectidfeature);
            $mform->setDefault('osanamecat06', $currentdata06);
	    $mform->addElement('select', 'osanamecat07', get_string('namecat07', 'mod_osa') . ": " . $osanamecat07, $selectidfeature);
            $mform->setDefault('osanamecat07', $currentdata07);
	    $mform->addElement('select', 'osanamecat08', get_string('namecat08', 'mod_osa') . ": " . $osanamecat08, $selectidfeature);
            $mform->setDefault('osanamecat08', $currentdata08);
	    $mform->addElement('select', 'osanamecat09', get_string('namecat09', 'mod_osa') . ": " . $osanamecat09, $selectidfeature);
            $mform->setDefault('osanamecat09', $currentdata09);
	    $mform->addElement('select', 'osanamecat10', get_string('namecat10', 'mod_osa') . ": " . $osanamecat10, $selectidfeature);
            $mform->setDefault('osanamecat10', $currentdata10);
	    $mform->addElement('select', 'osanamecat11', get_string('namecat11', 'mod_osa') . ": " . $osanamecat11, $selectidfeature);
            $mform->setDefault('osanamecat11', $currentdata11);
	    $mform->addElement('select', 'osanamecat12', get_string('namecat12', 'mod_osa') . ": " . $osanamecat12, $selectidfeature);
            $mform->setDefault('osanamecat12', $currentdata12);
	    $mform->addElement('select', 'osanamecat13', get_string('namecat13', 'mod_osa') . ": " . $osanamecat13, $selectidfeature);
            $mform->setDefault('osanamecat13', $currentdata13);
	    $mform->addElement('select', 'osanamecat14', get_string('namecat14', 'mod_osa') . ": " . $osanamecat14, $selectidfeature);
            $mform->setDefault('osanamecat14', $currentdata14);
	    $mform->addElement('select', 'osanamecat15', get_string('namecat15', 'mod_osa') . ": " . $osanamecat15, $selectidfeature);
            $mform->setDefault('osanamecat15', $currentdata15);
	    $mform->addElement('select', 'osanamecat16', get_string('namecat16', 'mod_osa') . ": " . $osanamecat16, $selectidfeature);
            $mform->setDefault('osanamecat16', $currentdata16);
	    $mform->addElement('select', 'osanamecat17', get_string('namecat17', 'mod_osa') . ": " . $osanamecat17, $selectidfeature);
            $mform->setDefault('osanamecat17', $currentdata17);
	    $mform->addElement('select', 'osanamecat18', get_string('namecat18', 'mod_osa') . ": " . $osanamecat18, $selectidfeature);
            $mform->setDefault('osanamecat18', $currentdata18);
	    $mform->addElement('select', 'osanamecat19', get_string('namecat19', 'mod_osa') . ": " . $osanamecat19, $selectidfeature);
            $mform->setDefault('osanamecat19', $currentdata19);
	    $mform->addElement('select', 'osanamecat20', get_string('namecat20', 'mod_osa') . ": " . $osanamecat20, $selectidfeature);
            $mform->setDefault('osanamecat20', $currentdata20);


        // Add action buttons for either saving data to db or cancel the form.
        $this->add_action_buttons();

        // Set existing data.
//        $this->set_data($currentdata);
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
