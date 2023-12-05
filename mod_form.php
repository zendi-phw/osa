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
 * The main mod_osa configuration form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');

/**
 * Module instance settings form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_osa_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {
        global $CFG; $DB; $OUTPUT;

        // Add variables for settings later on.
        $select = array(
            0 => get_string('no'),
            1 => get_string('yes')
        );
        $selectidfeature = array(
            0 => get_string('idfeaturezero', 'mod_osa'),
            1 => get_string('idfeatureone', 'mod_osa'),
            2 => get_string('idfeaturetwo', 'mod_osa')
        );
        $standardsizeformlength = array(
            'size' => '64'
        );
        $getadminconfigreusage = get_config('mod_osa', 'cfgallowsharing');
        //
        // Set maxbytes.
        $maxbytes = 1024;
        //
        // Add variables for filemanager and editor. It is now in function osa_get_editor_options_textfield() in lib.php.
        $seteditorsettingsosasettingtextoptional = osa_get_editor_options_textfield();
        $seteditorsettingsosasettingimageoptional = osa_get_filemanager_options_imageoptional();

        // Start form.
        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are shown.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('osaname', 'mod_osa'), $standardsizeformlength);

        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'osaname', 'mod_osa');

        // Adding the standard "intro" and "introformat" fields. Checks for moodle version and uses old or new writing of adding standard introfield.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        // Adding the rest of mod_osa settings.
        //
        // Added from here.
        // Add optional text.
        $mform->addElement('editor', 'osasettingtextoptionaleditor', get_string('osasettingtexteditoptional', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osasettingtextoptionaleditor', PARAM_RAW);

        // Add optional file upload for pictures.
        $mform->addElement('filemanager', 'osasettingimageoptional', get_string('osasettingattachmentimageoptional', 'mod_osa'), null, $seteditorsettingsosasettingimageoptional);
        //
        // Define settings for categories for creating basic osa in teacher mode.
        $mform->addElement('header', 'osasettingnamecat', get_string('osasettingnamecat', 'mod_osa'));

        $mform->addElement('text', 'namecat01', get_string('namecat01', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat01', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat01editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat01editor', PARAM_RAW);

        $mform->addElement('text', 'namecat02', get_string('namecat02', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat02', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat02editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat02editor', PARAM_RAW);

        $mform->addElement('text', 'namecat03', get_string('namecat03', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat03', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat03editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat03editor', PARAM_RAW);

        $mform->addElement('text', 'namecat04', get_string('namecat04', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat04', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat04editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat04editor', PARAM_RAW);

        $mform->addElement('text', 'namecat05', get_string('namecat05', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat05', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat05editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat05editor', PARAM_RAW);

        $mform->addElement('text', 'namecat06', get_string('namecat06', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat06', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat06editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat06editor', PARAM_RAW);

        $mform->addElement('text', 'namecat07', get_string('namecat07', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat07', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat07editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat07editor', PARAM_RAW);

        $mform->addElement('text', 'namecat08', get_string('namecat08', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat08', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat08editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat08editor', PARAM_RAW);

        $mform->addElement('text', 'namecat09', get_string('namecat09', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat09', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat09editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat09editor', PARAM_RAW);

        $mform->addElement('text', 'namecat10', get_string('namecat10', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat10', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat10editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat10editor', PARAM_RAW);

        $mform->addElement('text', 'namecat11', get_string('namecat11', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat11', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat11editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat11editor', PARAM_RAW);

        $mform->addElement('text', 'namecat12', get_string('namecat12', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat12', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat12editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat12editor', PARAM_RAW);

        $mform->addElement('text', 'namecat13', get_string('namecat13', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat13', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat13editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat13editor', PARAM_RAW);

        $mform->addElement('text', 'namecat14', get_string('namecat14', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat14', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat14editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat14editor', PARAM_RAW);

        $mform->addElement('text', 'namecat15', get_string('namecat15', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat15', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat15editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat15editor', PARAM_RAW);

        $mform->addElement('text', 'namecat16', get_string('namecat16', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat16', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat16editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat16editor', PARAM_RAW);

        $mform->addElement('text', 'namecat17', get_string('namecat17', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat17', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat17editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat17editor', PARAM_RAW);

        $mform->addElement('text', 'namecat18', get_string('namecat18', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat18', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat18editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat18editor', PARAM_RAW);

        $mform->addElement('text', 'namecat19', get_string('namecat19', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat19', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat19editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat19editor', PARAM_RAW);

        $mform->addElement('text', 'namecat20', get_string('namecat20', 'mod_osa'), $standardsizeformlength);
        $mform->setType('namecat20', PARAM_TEXT);
        $mform->addElement('editor', 'osanamecat20editor', get_string('osanamecateditor', 'mod_osa'), null, $seteditorsettingsosasettingtextoptional);
        $mform->setType('osanamecat20editor', PARAM_RAW);

        //
        // Define settings for attempts and interval for allowed completion for creating basic osa in teacher mode.
        $mform->addElement('header', 'osasettingattempts', get_string('osasettingattempts', 'mod_osa'));
        $mform->addElement('text', 'allowedattempts', get_string('allowedattempts', 'mod_osa'), $standardsizeformlength);
        $mform->setType('allowedattempts', PARAM_INT);
        $mform->setDefault('allowedattempts', 0);
        $mform->addHelpButton('allowedattempts', 'allowedattempts', 'mod_osa');
        $mform->addRule('allowedattempts', null, 'required', null, 'client');
        // Next completion in days is saved in seconds in the db.
        $mform->addElement('duration', 'nextcompletionindays', get_string('duration', 'mod_osa'), $standardsizeformlength);
        $mform->setDefault('nextcompletionindays', 0);
        $mform->addHelpButton('nextcompletionindays', 'nextcompletionindays', 'mod_osa');
        $mform->addRule('nextcompletionindays', null, 'required', null, 'client');
        //
        // Define settings identification for creating basic osa in teacher mode.
        $mform->addElement('header', 'osasettingidentification', get_string('osasettingidentification', 'mod_osa'));
        $mform->addElement('select', 'idfeature1', get_string('osasettingidentificationone', 'mod_osa'), $selectidfeature);
        $mform->setDefault('idfeature1', 0);
        $mform->addElement('select', 'idfeature2', get_string('osasettingidentificationtwo', 'mod_osa'), $selectidfeature);
        $mform->setDefault('idfeature2', 1);
        //
        // Define settings peer evaluation for creating basic osa in teacher mode.
        $mform->addElement('header', 'osasettingpeerevaluation', get_string('osasettingpeerevaluation', 'mod_osa'));
        $mform->addElement('select', 'allowpeerevaluation', get_string('osasettingpeerevaluationenable', 'mod_osa'), $select);
        //
        // Define settings research for creating basic osa in teacher mode.
        $mform->addElement('header', 'osasettingconsentresearch', get_string('osasettingconsentresearch', 'mod_osa'));
        $mform->addElement('text', 'researchtitle', get_string('researchtitle', 'mod_osa'), $standardsizeformlength);
        $mform->setType('researchtitle', PARAM_TEXT);
        $mform->addElement('select', 'researchoptionresearchrequest', get_string('osasettingconsentresearchenableconsentform', 'mod_osa'), $select);
        $mform->setDefault('researchoptionresearchrequest', 0);
        //
        // Check for admin setting: var $getadminconfigreusage = get_config('mod_osa', 'cfgallowsharing'); .
        if ($getadminconfigreusage) {
            // Define settings reusage of created osa template for creating basic osa in teacher mode.
            $mform->addElement('header', 'osasettingreusage', get_string('osasettingreusage', 'mod_osa'));
            $mform->addElement('select', 'typesharingstd', get_string('osasettingreusageenable', 'mod_osa'), $select);
            $mform->setDefault('typesharingstd', 0);
        }

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }

  
    /**
    * Module instance preprocess data from form element. Preprocess editor and filemanager.
    * public function data_preprocessing
    * 
    **/
    public function data_preprocessing(&$defaultvalues) {
    //
        $seteditorsettingsosasettingtextoptional = osa_get_editor_options_textfield();
        // Get editor options from lib.php. Function for this is in lib.php. Function: osa_get_editor_options_textfield.
        $seteditorsettingsosasettingimageoptional = osa_get_filemanager_options_imageoptional();
        // Get editor options from lib.php. Function forthis is in lib.php. Function: osa_get_filemanager_options_imageoptional.
        //
        if ($this->current->instance) {
                // Editing existing instance. Files are copied into the draft area.
                // Part for editor.
                $draftitemid = file_get_submitted_draft_itemid('osasettingtextoptionaleditor');
                $defaultvalues['osasettingtextoptionaleditor']['text'] = file_prepare_draft_area($draftitemid, $this->context->id, 'mod_osa', 'osasettingtextoptional', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osasettingtextoptional']);
                $defaultvalues['osasettingtextoptionaleditor']['format'] = $defaultvalues['osasettingtextoptionalformat'];
                $defaultvalues['osasettingtextoptionaleditor']['itemid'] = $draftitemid;


                // Part for editor osanamecat01editor.
                $draftitemidcat01 = file_get_submitted_draft_itemid('osanamecat01editor');
                $defaultvalues['osanamecat01editor']['text'] = file_prepare_draft_area($draftitemidcat01, $this->context->id, 'mod_osa', 'osanamecat01', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat01']);
                $defaultvalues['osanamecat01editor']['format'] = $defaultvalues['osanamecat01format'];
                $defaultvalues['osanamecat01editor']['itemid'] = $draftitemidcat01;
                // Part for editor osanamecat02editor.
                $draftitemidcat02 = file_get_submitted_draft_itemid('osanamecat02editor');
                $defaultvalues['osanamecat02editor']['text'] = file_prepare_draft_area($draftitemidcat02, $this->context->id, 'mod_osa', 'osanamecat02', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat02']);
                $defaultvalues['osanamecat02editor']['format'] = $defaultvalues['osanamecat02format'];
                $defaultvalues['osanamecat02editor']['itemid'] = $draftitemidcat02;
                // Part for editor osanamecat03editor.
                $draftitemidcat03 = file_get_submitted_draft_itemid('osanamecat03editor');
                $defaultvalues['osanamecat03editor']['text'] = file_prepare_draft_area($draftitemidcat03, $this->context->id, 'mod_osa', 'osanamecat03', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat03']);
                $defaultvalues['osanamecat03editor']['format'] = $defaultvalues['osanamecat03format'];
                $defaultvalues['osanamecat03editor']['itemid'] = $draftitemidcat03;
                // Part for editor osanamecat04editor.
                $draftitemidcat04 = file_get_submitted_draft_itemid('osanamecat04editor');
                $defaultvalues['osanamecat04editor']['text'] = file_prepare_draft_area($draftitemidcat04, $this->context->id, 'mod_osa', 'osanamecat04', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat04']);
                $defaultvalues['osanamecat04editor']['format'] = $defaultvalues['osanamecat04format'];
                $defaultvalues['osanamecat04editor']['itemid'] = $draftitemidcat04;
                // Part for editor osanamecat05editor.
                $draftitemidcat05 = file_get_submitted_draft_itemid('osanamecat05editor');
                $defaultvalues['osanamecat05editor']['text'] = file_prepare_draft_area($draftitemidcat05, $this->context->id, 'mod_osa', 'osanamecat05', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat05']);
                $defaultvalues['osanamecat05editor']['format'] = $defaultvalues['osanamecat05format'];
                $defaultvalues['osanamecat05editor']['itemid'] = $draftitemidcat05;
                // Part for editor osanamecat06editor.
                $draftitemidcat06 = file_get_submitted_draft_itemid('osanamecat06editor');
                $defaultvalues['osanamecat06editor']['text'] = file_prepare_draft_area($draftitemidcat06, $this->context->id, 'mod_osa', 'osanamecat06', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat06']);
                $defaultvalues['osanamecat06editor']['format'] = $defaultvalues['osanamecat06format'];
                $defaultvalues['osanamecat06editor']['itemid'] = $draftitemidcat06;
                // Part for editor osanamecat07editor.
                $draftitemidcat07 = file_get_submitted_draft_itemid('osanamecat07editor');
                $defaultvalues['osanamecat07editor']['text'] = file_prepare_draft_area($draftitemidcat07, $this->context->id, 'mod_osa', 'osanamecat07', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat07']);
                $defaultvalues['osanamecat07editor']['format'] = $defaultvalues['osanamecat07format'];
                $defaultvalues['osanamecat07editor']['itemid'] = $draftitemidcat07;
                // Part for editor osanamecat08editor.
                $draftitemidcat08 = file_get_submitted_draft_itemid('osanamecat08editor');
                $defaultvalues['osanamecat08editor']['text'] = file_prepare_draft_area($draftitemidcat08, $this->context->id, 'mod_osa', 'osanamecat08', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat08']);
                $defaultvalues['osanamecat08editor']['format'] = $defaultvalues['osanamecat08format'];
                $defaultvalues['osanamecat08editor']['itemid'] = $draftitemidcat08;
                // Part for editor osanamecat09editor.
                $draftitemidcat09 = file_get_submitted_draft_itemid('osanamecat09editor');
                $defaultvalues['osanamecat09editor']['text'] = file_prepare_draft_area($draftitemidcat09, $this->context->id, 'mod_osa', 'osanamecat09', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat09']);
                $defaultvalues['osanamecat09editor']['format'] = $defaultvalues['osanamecat09format'];
                $defaultvalues['osanamecat09editor']['itemid'] = $draftitemidcat09;
                // Part for editor osanamecat10editor.
                $draftitemidcat10 = file_get_submitted_draft_itemid('osanamecat10editor');
                $defaultvalues['osanamecat10editor']['text'] = file_prepare_draft_area($draftitemidcat10, $this->context->id, 'mod_osa', 'osanamecat10', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat10']);
                $defaultvalues['osanamecat10editor']['format'] = $defaultvalues['osanamecat10format'];
                $defaultvalues['osanamecat10editor']['itemid'] = $draftitemidcat10;
                // Part for editor osanamecat11editor.
                $draftitemidcat11 = file_get_submitted_draft_itemid('osanamecat11editor');
                $defaultvalues['osanamecat11editor']['text'] = file_prepare_draft_area($draftitemidcat11, $this->context->id, 'mod_osa', 'osanamecat11', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat11']);
                $defaultvalues['osanamecat11editor']['format'] = $defaultvalues['osanamecat11format'];
                $defaultvalues['osanamecat11editor']['itemid'] = $draftitemidcat11;
                // Part for editor osanamecat12editor.
                $draftitemidcat12 = file_get_submitted_draft_itemid('osanamecat12editor');
                $defaultvalues['osanamecat12editor']['text'] = file_prepare_draft_area($draftitemidcat12, $this->context->id, 'mod_osa', 'osanamecat12', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat12']);
                $defaultvalues['osanamecat12editor']['format'] = $defaultvalues['osanamecat12format'];
                $defaultvalues['osanamecat12editor']['itemid'] = $draftitemidcat12;
                // Part for editor osanamecat13editor.
                $draftitemidcat13 = file_get_submitted_draft_itemid('osanamecat13editor');
                $defaultvalues['osanamecat13editor']['text'] = file_prepare_draft_area($draftitemidcat13, $this->context->id, 'mod_osa', 'osanamecat13', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat13']);
                $defaultvalues['osanamecat13editor']['format'] = $defaultvalues['osanamecat13format'];
                $defaultvalues['osanamecat13editor']['itemid'] = $draftitemidcat13;
                // Part for editor osanamecat14editor.
                $draftitemidcat14 = file_get_submitted_draft_itemid('osanamecat14editor');
                $defaultvalues['osanamecat14editor']['text'] = file_prepare_draft_area($draftitemidcat14, $this->context->id, 'mod_osa', 'osanamecat14', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat14']);
                $defaultvalues['osanamecat14editor']['format'] = $defaultvalues['osanamecat14format'];
                $defaultvalues['osanamecat14editor']['itemid'] = $draftitemidcat14;
                // Part for editor osanamecat15editor.
                $draftitemidcat15 = file_get_submitted_draft_itemid('osanamecat15editor');
                $defaultvalues['osanamecat15editor']['text'] = file_prepare_draft_area($draftitemidcat15, $this->context->id, 'mod_osa', 'osanamecat15', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat15']);
                $defaultvalues['osanamecat15editor']['format'] = $defaultvalues['osanamecat15format'];
                $defaultvalues['osanamecat15editor']['itemid'] = $draftitemidcat15;
                // Part for editor osanamecat16editor.
                $draftitemidcat16 = file_get_submitted_draft_itemid('osanamecat16editor');
                $defaultvalues['osanamecat16editor']['text'] = file_prepare_draft_area($draftitemidcat16, $this->context->id, 'mod_osa', 'osanamecat16', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat16']);
                $defaultvalues['osanamecat16editor']['format'] = $defaultvalues['osanamecat16format'];
                $defaultvalues['osanamecat16editor']['itemid'] = $draftitemidcat16;
                // Part for editor osanamecat17editor.
                $draftitemidcat17 = file_get_submitted_draft_itemid('osanamecat17editor');
                $defaultvalues['osanamecat17editor']['text'] = file_prepare_draft_area($draftitemidcat17, $this->context->id, 'mod_osa', 'osanamecat17', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat17']);
                $defaultvalues['osanamecat17editor']['format'] = $defaultvalues['osanamecat17format'];
                $defaultvalues['osanamecat17editor']['itemid'] = $draftitemidcat17;
                // Part for editor osanamecat18editor.
                $draftitemidcat18 = file_get_submitted_draft_itemid('osanamecat18editor');
                $defaultvalues['osanamecat18editor']['text'] = file_prepare_draft_area($draftitemidcat18, $this->context->id, 'mod_osa', 'osanamecat18', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat18']);
                $defaultvalues['osanamecat18editor']['format'] = $defaultvalues['osanamecat18format'];
                $defaultvalues['osanamecat18editor']['itemid'] = $draftitemidcat18;
                // Part for editor osanamecat19editor.
                $draftitemidcat19 = file_get_submitted_draft_itemid('osanamecat19editor');
                $defaultvalues['osanamecat19editor']['text'] = file_prepare_draft_area($draftitemidcat19, $this->context->id, 'mod_osa', 'osanamecat19', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat19']);
                $defaultvalues['osanamecat19editor']['format'] = $defaultvalues['osanamecat19format'];
                $defaultvalues['osanamecat19editor']['itemid'] = $draftitemidcat19;
                // Part for editor osanamecat20editor.
                $draftitemidcat20 = file_get_submitted_draft_itemid('osanamecat20editor');
                $defaultvalues['osanamecat20editor']['text'] = file_prepare_draft_area($draftitemidcat20, $this->context->id, 'mod_osa', 'osanamecat20', 0, $seteditorsettingsosasettingtextoptional, $defaultvalues['osanamecat20']);
                $defaultvalues['osanamecat20editor']['format'] = $defaultvalues['osanamecat20format'];
                $defaultvalues['osanamecat20editor']['itemid'] = $draftitemidcat20;


                // Part for filemanager.
                $filemanagerdraftitemid = file_get_submitted_draft_itemid('osasettingimageoptional');
                file_prepare_draft_area($filemanagerdraftitemid, $this->context->id, 'mod_osa', 'osasettingimageoptional', 0, $seteditorsettingsosasettingimageoptional);
                $defaultvalues['osasettingimageoptional'] = $filemanagerdraftitemid;

            } else {

                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemid = file_get_submitted_draft_itemid('osasettingtextoptionaleditor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemid, null, 'mod_osa', 'osasettingtextoptional', 0);
                $defaultvalues['osasettingtextoptionaleditor']['text'] = '';
                $defaultvalues['osasettingtextoptionaleditor']['format'] = editors_get_preferred_format();
                $defaultvalues['osasettingtextoptionaleditor']['itemid'] = $draftitemid;



                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat01 = file_get_submitted_draft_itemid('osanamecat01editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat01, null, 'mod_osa', 'osanamecat01editor', 0);
                $defaultvalues['osanamecat01editor']['text'] = '';
                $defaultvalues['osanamecat01editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat01editor']['itemid'] = $draftitemidcat01;

                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat02 = file_get_submitted_draft_itemid('osanamecat02editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat02, null, 'mod_osa', 'osanamecat02editor', 0);
                $defaultvalues['osanamecat02editor']['text'] = '';
                $defaultvalues['osanamecat02editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat02editor']['itemid'] = $draftitemidcat02;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat03 = file_get_submitted_draft_itemid('osanamecat03editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat03, null, 'mod_osa', 'osanamecat03editor', 0);
                $defaultvalues['osanamecat03editor']['text'] = '';
                $defaultvalues['osanamecat03editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat03editor']['itemid'] = $draftitemidcat03;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat04 = file_get_submitted_draft_itemid('osanamecat04editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat04, null, 'mod_osa', 'osanamecat04editor', 0);
                $defaultvalues['osanamecat04editor']['text'] = '';
                $defaultvalues['osanamecat04editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat04editor']['itemid'] = $draftitemidcat04;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat05 = file_get_submitted_draft_itemid('osanamecat05editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat05, null, 'mod_osa', 'osanamecat05editor', 0);
                $defaultvalues['osanamecat05editor']['text'] = '';
                $defaultvalues['osanamecat05editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat05editor']['itemid'] = $draftitemidcat05;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat06 = file_get_submitted_draft_itemid('osanamecat06editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat06, null, 'mod_osa', 'osanamecat06editor', 0);
                $defaultvalues['osanamecat06editor']['text'] = '';
                $defaultvalues['osanamecat06editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat06editor']['itemid'] = $draftitemidcat06;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat07 = file_get_submitted_draft_itemid('osanamecat07editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat07, null, 'mod_osa', 'osanamecat07editor', 0);
                $defaultvalues['osanamecat07editor']['text'] = '';
                $defaultvalues['osanamecat07editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat07editor']['itemid'] = $draftitemidcat07;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat08 = file_get_submitted_draft_itemid('osanamecat08editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat08, null, 'mod_osa', 'osanamecat08editor', 0);
                $defaultvalues['osanamecat08editor']['text'] = '';
                $defaultvalues['osanamecat08editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat08editor']['itemid'] = $draftitemidcat08;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat09 = file_get_submitted_draft_itemid('osanamecat09editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat09, null, 'mod_osa', 'osanamecat09editor', 0);
                $defaultvalues['osanamecat09editor']['text'] = '';
                $defaultvalues['osanamecat09editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat09editor']['itemid'] = $draftitemidcat09;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat10 = file_get_submitted_draft_itemid('osanamecat10editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat10, null, 'mod_osa', 'osanamecat10editor', 0);
                $defaultvalues['osanamecat10editor']['text'] = '';
                $defaultvalues['osanamecat10editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat10editor']['itemid'] = $draftitemidcat10;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat11 = file_get_submitted_draft_itemid('osanamecat11editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat11, null, 'mod_osa', 'osanamecat11editor', 0);
                $defaultvalues['osanamecat11editor']['text'] = '';
                $defaultvalues['osanamecat11editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat11editor']['itemid'] = $draftitemidcat11;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat12 = file_get_submitted_draft_itemid('osanamecat12editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat12, null, 'mod_osa', 'osanamecat12editor', 0);
                $defaultvalues['osanamecat12editor']['text'] = '';
                $defaultvalues['osanamecat12editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat12editor']['itemid'] = $draftitemidcat12;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat13 = file_get_submitted_draft_itemid('osanamecat13editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat13, null, 'mod_osa', 'osanamecat13editor', 0);
                $defaultvalues['osanamecat13editor']['text'] = '';
                $defaultvalues['osanamecat13editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat13editor']['itemid'] = $draftitemidcat13;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat14 = file_get_submitted_draft_itemid('osanamecat14editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat14, null, 'mod_osa', 'osanamecat14editor', 0);
                $defaultvalues['osanamecat14editor']['text'] = '';
                $defaultvalues['osanamecat14editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat14editor']['itemid'] = $draftitemidcat14;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat15 = file_get_submitted_draft_itemid('osanamecat15editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat15, null, 'mod_osa', 'osanamecat15editor', 0);
                $defaultvalues['osanamecat15editor']['text'] = '';
                $defaultvalues['osanamecat15editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat15editor']['itemid'] = $draftitemidcat15;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat16 = file_get_submitted_draft_itemid('osanamecat16editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat16, null, 'mod_osa', 'osanamecat16editor', 0);
                $defaultvalues['osanamecat16editor']['text'] = '';
                $defaultvalues['osanamecat16editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat16editor']['itemid'] = $draftitemidcat16;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat17 = file_get_submitted_draft_itemid('osanamecat17editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat17, null, 'mod_osa', 'osanamecat17editor', 0);
                $defaultvalues['osanamecat17editor']['text'] = '';
                $defaultvalues['osanamecat17editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat17editor']['itemid'] = $draftitemidcat17;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat18 = file_get_submitted_draft_itemid('osanamecat18editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat18, null, 'mod_osa', 'osanamecat18editor', 0);
                $defaultvalues['osanamecat18editor']['text'] = '';
                $defaultvalues['osanamecat18editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat18editor']['itemid'] = $draftitemidcat18;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat19 = file_get_submitted_draft_itemid('osanamecat19editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat19, null, 'mod_osa', 'osanamecat19editor', 0);
                $defaultvalues['osanamecat19editor']['text'] = '';
                $defaultvalues['osanamecat19editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat19editor']['itemid'] = $draftitemidcat19;


                // Add a new instance. Files are copied into draft area. Part for editor.
                $draftitemidcat20 = file_get_submitted_draft_itemid('osanamecat20editor');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($draftitemidcat20, null, 'mod_osa', 'osanamecat20editor', 0);
                $defaultvalues['osanamecat20editor']['text'] = '';
                $defaultvalues['osanamecat20editor']['format'] = editors_get_preferred_format();
                $defaultvalues['osanamecat20editor']['itemid'] = $draftitemidcat20;

                //
                //
                // Add new instance. Files are copied into draft area. Part for filemanager.
                $filemanagerdraftitemid = file_get_submitted_draft_itemid('osasettingimageoptional');
                // If there is no context yet and no itemid used yet.
                file_prepare_draft_area($filemanagerdraftitemid, null, 'mod_osa', 'osasettingimageoptional', 0, $seteditorsettingsosasettingimageoptional);
                $defaultvalues['osasettingimageoptional'] = $filemanagerdraftitemid;
            }
    }


    //
    // Custom validation should be added here.
    function validation($data, $files) {
        // Code to dump data.
        // var_dump($data); .
        // die(); .

        return array();
    }
}
