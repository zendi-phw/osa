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
 * The mod_osa edit_cat_feedback_settings_class form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once($CFG->libdir.'/formslib.php');

class edit_cat_feedback_settings_class extends moodleform {
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


            $mform->addElement('header', 'feedbackheadercat01', get_string('feedbackheadercat01', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat01', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat01_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat01_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat01_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat01_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat01', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat01_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat01_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat02', get_string('feedbackheadercat02', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat02', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat02_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat02_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat02_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat02_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat02', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat02_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat02_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat03', get_string('feedbackheadercat03', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat03', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat03_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat03_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat03_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat03_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat03', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat03_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat03_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat04', get_string('feedbackheadercat04', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat04', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat04_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat04_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat04_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat04_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat04', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat04_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat04_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat05', get_string('feedbackheadercat05', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat05', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat05_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat05_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat05_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat05_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat05', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat05_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat05_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat06', get_string('feedbackheadercat06', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat06', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat06_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat06_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat06_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat06_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat06', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat06_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat06_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat07', get_string('feedbackheadercat07', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat07', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat07_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat07_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat07_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat07_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat07', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat07_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat07_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat08', get_string('feedbackheadercat08', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat08', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat08_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat08_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat08_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat08_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat08', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat08_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat08_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat09', get_string('feedbackheadercat09', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat09', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat09_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat09_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat09_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat09_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat09', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat09_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat09_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat10', get_string('feedbackheadercat10', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat10', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat10_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat10_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat10_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat10_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat10', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat10_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat10_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat11', get_string('feedbackheadercat11', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat11', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat11_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat11_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat11_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat11_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat11', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat11_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat11_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat12', get_string('feedbackheadercat12', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat12', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat12_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat12_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat12_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat12_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat12', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat12_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat12_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat13', get_string('feedbackheadercat13', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat13', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat13_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat13_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat13_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat13_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat13', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat13_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat13_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat14', get_string('feedbackheadercat14', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat14', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat14_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat14_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat14_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat14_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat14', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat14_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat14_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat15', get_string('feedbackheadercat15', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat15', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat15_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat15_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat15_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat15_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat15', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat15_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat15_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat16', get_string('feedbackheadercat16', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat16', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat16_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat16_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat16_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat16_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat16', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat16_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat16_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat17', get_string('feedbackheadercat17', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat17', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat17_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat17_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat17_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat17_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat17', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat17_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat17_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat18', get_string('feedbackheadercat18', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat18', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat18_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat18_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat18_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat18_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat18', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat18_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat18_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat19', get_string('feedbackheadercat19', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat19', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat19_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat19_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat19_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat19_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat19', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat19_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat19_editor', PARAM_RAW);

//

            $mform->addElement('header', 'feedbackheadercat20', get_string('feedbackheadercat20', 'mod_osa'));

            $mform->addElement('float', 'stdvalllcat20', get_string('stdvalllcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtllcat20_editor', get_string('fbtllcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtllcat20_editor', PARAM_RAW);

            $mform->addElement('editor', 'fbtblulcat20_editor', get_string('fbtblulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtblulcat20_editor', PARAM_RAW);

            $mform->addElement('float', 'stdvalulcat20', get_string('stdvalulcat', 'mod_osa'), $attributes);

            $mform->addElement('editor', 'fbtulcat20_editor', get_string('fbtulcatdesc', 'mod_osa'), null, $seteditorsettingsosasettingfeedbacktexteditor);
            $mform->setType('fbtulcat20_editor', PARAM_RAW);


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
