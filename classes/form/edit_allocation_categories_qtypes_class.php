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
 * The mod_osa edit_allocation_categories_qtypes_class form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/lib.php');
require_once($CFG->libdir.'/formslib.php');

class edit_allocation_categories_qtypes_class extends moodleform {
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

        $mform->addElement('header', 'choosecategory', get_string('choosecategory', 'mod_osa'));


        foreach ($records as $record) {

            $recordqtypecollectionid = $record->id;

            // Get title of each question
            if ($record->fk_tqtt != 0) {
            // Get record for textelement.
            $recordinstance = $DB->get_record('osa_instance_qttextelement', array('id' => $record->fk_tqtt));
            $recordid = $recordinstance->id;
            $osaqtypetitle = $recordinstance->textelementname;
            $recordqtypecollectionid = $record->id;
            }

            else if ($record->fk_tqtls != 0) {
            // Get record for likert scale.
            $recordinstance = $DB->get_record('osa_instance_qtlikertscale', array('id' => $record->fk_tqtls));
            $recordid = $recordinstance->id;
            $osaqtypetitle = $recordinstance->lsname;
            $recordqtypecollectionid = $record->id;
            }

            else if ($record->fk_tqtc != 0) {
            $recordinstance = $DB->get_record('osa_instance_qtcheckbox', array('id' => $record->fk_tqtc));
            $recordid = $recordinstance->id;
            $osaqtypetitle = $recordinstance->cbname;
            $recordqtypecollectionid = $record->id;
            }

            else if ($record->fk_tqts != 0) {
            $recordinstance = $DB->get_record('osa_instance_qtslider', array('id' => $record->fk_tqts));
            $recordid = $recordinstance->id;
            $osaqtypetitle = $recordinstance->sname01;
            $recordqtypecollectionid = $record->id;
            }

            $datafromdbrecordidosaqtypecollection[] = $recordqtypecollectionid;
            $datafromdbosaqtypetitle[] = $osaqtypetitle;

            $selectidfeature = array(
                0 => $osanamecat01,
                1 => $osanamecat02,
                2 => $osanamecat03,
                3 => $osanamecat04,
                4 => $osanamecat05,
                5 => $osanamecat06,
                6 => $osanamecat07,
                7 => $osanamecat08,
                8 => $osanamecat09,
                9 => $osanamecat10,
                10 => $osanamecat11,
                11 => $osanamecat12,
                12 => $osanamecat13,
                13 => $osanamecat14,
                14 => $osanamecat15,
                15 => $osanamecat16,
                16 => $osanamecat17,
                17 => $osanamecat18,
                18 => $osanamecat19,
                19 => $osanamecat20,
            );

        }

        for ($i = 0, $length = sizeof($datafromdbrecordidosaqtypecollection); $i < $length; $i++) {

            $ii = $i+1;

            $mform->addElement('select', 'qtypecatselection' . $datafromdbrecordidosaqtypecollection[$i], $datafromdbosaqtypetitle[$i], $selectidfeature);
            $mform->setDefault('qtypecatselection' . $datafromdbrecordidosaqtypecollection[$i], $currentdata[$datafromdbrecordidosaqtypecollection[$i]]->category);

        }

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
