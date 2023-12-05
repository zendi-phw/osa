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
 * The main mod_osa questiontype slider configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once("$CFG->libdir/formslib.php");

class edit_questiontype_slider_class extends moodleform {
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
        $seteditorsettingsosasettingsliderimageoptional = osa_get_filemanager_options_imageoptional();
        $seteditorsettingsosasettingslidertexteditor = osa_get_editor_options_edit_questiontype_slider($context);
        
        // Add hidden elements. Contain handed over values see $passinfotoform var in edit_questiontype_slider.php
        $mform->addElement('hidden', 'cmid', $this->_customdata['cmid']);
        $mform->setType('cmid', PARAM_INT);
        
        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);

        $currentdata = $this->_customdata['currentdata']; // Get current data from draft area to display later in the form. The data is passed to the form via the $passinfotoform array.
//var_dump($currentdata);
        $recordid = $this->_customdata['id'];
        
        // Add mform elements to display later.
        
        // Slider name.
        $mform->addElement('header', 'sliderheadername', get_string('slidername', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname', get_string('scalename', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname', PARAM_TEXT);

        // Slider steps part.
        $mform->addElement('header', 'sliderheaderstep1', get_string('sliderheaderstep1', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname01', get_string('scalenameofstep1', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname01', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage01_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor01_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor01_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep2', get_string('sliderheaderstep2', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname02', get_string('scalenameofstep2', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname02', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage02_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor02_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor02_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep3', get_string('sliderheaderstep3', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname03', get_string('scalenameofstep3', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname03', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage03_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor03_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor03_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep4', get_string('sliderheaderstep4', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname04', get_string('scalenameofstep4', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname04', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage04_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor04_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor04_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep5', get_string('sliderheaderstep5', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname05', get_string('scalenameofstep5', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname05', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage05_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor05_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor05_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep6', get_string('sliderheaderstep6', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname06', get_string('scalenameofstep6', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname06', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage06_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor06_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor06_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep7', get_string('sliderheaderstep7', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname07', get_string('scalenameofstep7', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname07', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage07_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor07_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor07_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep8', get_string('sliderheaderstep8', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname08', get_string('scalenameofstep8', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname08', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage08_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor08_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor08_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep9', get_string('sliderheaderstep9', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname09', get_string('scalenameofstep9', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname09', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage09_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor09_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor09_editor', PARAM_RAW);


        $mform->addElement('header', 'sliderheaderstep10', get_string('sliderheaderstep10', 'mod_osa')); // ToDo Add lang string.
        
        $mform->addElement('text', 'sname10', get_string('scalenameofstep10', 'mod_osa'), $standardsizeformlength);
        $mform->setType('sname10', PARAM_TEXT);
        
        $mform->addElement('filemanager', 'simage10_filemanager', get_string('sliderfilemanager', 'mod_osa'), null, $seteditorsettingsosasettingsliderimageoptional);
        
        $mform->addElement('editor', 'ssdesceditor10_editor', get_string('slidertextshortdescription', 'mod_osa'), null, $seteditorsettingsosasettingslidertexteditor);
        $mform->setType('ssdesceditor10_editor', PARAM_RAW);
        

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
