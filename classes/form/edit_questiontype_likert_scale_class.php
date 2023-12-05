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
 * The main mod_osa questiontype likert scale configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once("$CFG->libdir/formslib.php");

class edit_questiontype_likert_scale_class extends moodleform {
    public function definition() {
        global $CFG;
        
        // Get values for select array to define the amount of elements.
        $select = osa_get_editor_select_options_amount(10);
        
        $standardsizeformlength = osa_get_mform_length();
        
        $mform = $this->_form;
        
        // Set coursemodule.
        $cm = $this->_customdata['cm'];
        // Set context.
        $context = context_module::instance($cm->id);
        
        // Get options for editor.
        $seteditorsettingsosasettingeditlikertscaleimageoptional = osa_get_filemanager_options_imageoptional();
        $seteditorsettingsosasettingeditlikertscaletexteditor = osa_get_editor_options_edit_questiontype_slider($context);
        
        // Add hidden elements. Contain handed over values see $passinfotoform var in edit_questiontype_slider.php
        $mform->addElement('hidden', 'cmid', $this->_customdata['cmid']);
        $mform->setType('cmid', PARAM_INT);
        
        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);

        $currentdata = $this->_customdata['currentdata']; // Get current data from draft area to display later in the form. The data is passed to the form via the $passinfotoform array.
var_dump($currentdata);
        $recordid = $this->_customdata['id'];
        
        // Add mform elements to display later.

        // Likert name.
        $mform->addElement('header', 'likertheadername', get_string('likertname', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'lsname', get_string('likertscalename', 'mod_osa'), $standardsizeformlength);
        $mform->setType('lsname', PARAM_TEXT);

        // Likert steps part.
        $mform->addElement('header', 'likertheaderstep1', get_string('likertheaderstep1', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage01_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);
        
        $mform->addElement('editor', 'lstextdesceditor01_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor01_editor', PARAM_RAW);


        $mform->addElement('header', 'likertheaderstep2', get_string('likertheaderstep2', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage02_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);

        $mform->addElement('editor', 'lstextdesceditor02_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor02_editor', PARAM_RAW);


        $mform->addElement('header', 'likertheaderstep3', get_string('likertheaderstep3', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage03_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);

        $mform->addElement('editor', 'lstextdesceditor03_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor03_editor', PARAM_RAW);


        $mform->addElement('header', 'likertheaderstep4', get_string('likertheaderstep4', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage04_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);

        $mform->addElement('editor', 'lstextdesceditor04_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor04_editor', PARAM_RAW);


        $mform->addElement('header', 'likertheaderstep5', get_string('likertheaderstep5', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage05_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);

        $mform->addElement('editor', 'lstextdesceditor05_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor05_editor', PARAM_RAW);


        $mform->addElement('header', 'likertheaderstep6', get_string('likertheaderstep6', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage06_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);

        $mform->addElement('editor', 'lstextdesceditor06_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor06_editor', PARAM_RAW);


        $mform->addElement('header', 'likertheaderstep7', get_string('likertheaderstep7', 'mod_osa')); // ToDo Add lang string.
        $mform->addElement('filemanager', 'lsimage07_filemanager', get_string('likertfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaleimageoptional);

        $mform->addElement('editor', 'lstextdesceditor07_editor', get_string('likertscaletextdescription', 'mod_osa'), null, $seteditorsettingsosasettingeditlikertscaletexteditor);
        $mform->setType('lstextdesceditor07_editor', PARAM_RAW);


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
