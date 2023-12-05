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
 * Library of interface functions and constants.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
 
function osa_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_GROUPS:
            return false;
        case FEATURE_GROUPINGS:
            return false;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return false; // Deactivated support for tracking and completion based on views or interactions.
        case FEATURE_GRADE_HAS_GRADE:
            return false; // Deactivated whether osa has grade associated with it.
        case FEATURE_GRADE_OUTCOMES:
            return false; // Deactivated outcomes and competency based grading.
        case FEATURE_BACKUP_MOODLE2:
            return false; // Deactivated support for moodle 2 backup and restore.
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        default:
            return null;
    }
}


/**
 * Saves a new instance of the mod_osa into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_osa_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function osa_add_instance($moduleinstance, $mform) {
    global $CFG, $DB;

    // Get course module id.
    $cmid = $moduleinstance->coursemodule;
    
    // Get file manager data.
    $filemanagerdraftitemid = $moduleinstance->osasettingimageoptional; // ?????????????????????????????????????????????

    // Predescribe creation time for saving later on in DB.
    $moduleinstance->timecreated = time();

    // Predescribe content and format of editor field for saving later on in DB.
    if ($mform) {
        $moduleinstance->osasettingtextoptional       = $moduleinstance->osasettingtextoptionaleditor['text'];
        $moduleinstance->osasettingtextoptionalformat = $moduleinstance->osasettingtextoptionaleditor['format'];
        // Predescribe content and format of category description field for saving later on in $DB.
        $moduleinstance->osanamecat01       = $moduleinstance->osanamecat01editor['text'];
        $moduleinstance->osanamecat01format = $moduleinstance->osanamecat01editor['format'];
        $moduleinstance->osanamecat02       = $moduleinstance->osanamecat02editor['text'];
        $moduleinstance->osanamecat02format = $moduleinstance->osanamecat02editor['format'];
        $moduleinstance->osanamecat03       = $moduleinstance->osanamecat03editor['text'];
        $moduleinstance->osanamecat03format = $moduleinstance->osanamecat03editor['format'];
        $moduleinstance->osanamecat04       = $moduleinstance->osanamecat04editor['text'];
        $moduleinstance->osanamecat04format = $moduleinstance->osanamecat04editor['format'];
        $moduleinstance->osanamecat05       = $moduleinstance->osanamecat05editor['text'];
        $moduleinstance->osanamecat05format = $moduleinstance->osanamecat05editor['format'];
        $moduleinstance->osanamecat06       = $moduleinstance->osanamecat06editor['text'];
        $moduleinstance->osanamecat06format = $moduleinstance->osanamecat06editor['format'];
        $moduleinstance->osanamecat07       = $moduleinstance->osanamecat07editor['text'];
        $moduleinstance->osanamecat07format = $moduleinstance->osanamecat07editor['format'];
        $moduleinstance->osanamecat08       = $moduleinstance->osanamecat08editor['text'];
        $moduleinstance->osanamecat08format = $moduleinstance->osanamecat08editor['format'];
        $moduleinstance->osanamecat09       = $moduleinstance->osanamecat09editor['text'];
        $moduleinstance->osanamecat09format = $moduleinstance->osanamecat09editor['format'];
        $moduleinstance->osanamecat10       = $moduleinstance->osanamecat10editor['text'];
        $moduleinstance->osanamecat10format = $moduleinstance->osanamecat10editor['format'];
        $moduleinstance->osanamecat11       = $moduleinstance->osanamecat11editor['text'];
        $moduleinstance->osanamecat11format = $moduleinstance->osanamecat11editor['format'];
        $moduleinstance->osanamecat12       = $moduleinstance->osanamecat12editor['text'];
        $moduleinstance->osanamecat12format = $moduleinstance->osanamecat12editor['format'];
        $moduleinstance->osanamecat13       = $moduleinstance->osanamecat13editor['text'];
        $moduleinstance->osanamecat13format = $moduleinstance->osanamecat13editor['format'];
        $moduleinstance->osanamecat14       = $moduleinstance->osanamecat14editor['text'];
        $moduleinstance->osanamecat14format = $moduleinstance->osanamecat14editor['format'];
        $moduleinstance->osanamecat15       = $moduleinstance->osanamecat15editor['text'];
        $moduleinstance->osanamecat15format = $moduleinstance->osanamecat15editor['format'];
        $moduleinstance->osanamecat16       = $moduleinstance->osanamecat16editor['text'];
        $moduleinstance->osanamecat16format = $moduleinstance->osanamecat16editor['format'];
        $moduleinstance->osanamecat17       = $moduleinstance->osanamecat17editor['text'];
        $moduleinstance->osanamecat17format = $moduleinstance->osanamecat17editor['format'];
        $moduleinstance->osanamecat18       = $moduleinstance->osanamecat18editor['text'];
        $moduleinstance->osanamecat18format = $moduleinstance->osanamecat18editor['format'];
        $moduleinstance->osanamecat19       = $moduleinstance->osanamecat19editor['text'];
        $moduleinstance->osanamecat19format = $moduleinstance->osanamecat19editor['format'];
        $moduleinstance->osanamecat20       = $moduleinstance->osanamecat20editor['text'];
        $moduleinstance->osanamecat20format = $moduleinstance->osanamecat20editor['format'];
        // Predescribe content and format of filemanager field.
        $moduleinstance->osasettingimageoptional      = $moduleinstance->osasettingimageoptional;
    }

    // Insert record into DB.
    $moduleinstance->id = $DB->insert_record('osa', $moduleinstance);

    // Set field in course modules table. Get context.
    $DB->set_field('course_modules', 'instance', $moduleinstance->id, array('id' => $cmid));
    $context = context_module::instance($cmid);

    // Check for empty texteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osasettingtextoptionaleditor['itemid'])) {
        $draftitemid                            = $moduleinstance->osasettingtextoptionaleditor['itemid'];
        $moduleinstance->osasettingtextoptional = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osasettingtextoptional', 0, osa_get_editor_options_textfield($context), $moduleinstance->osasettingtextoptional);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat01editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat01editor['itemid'];
        $moduleinstance->osanamecat01editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat01editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat01editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat02editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat02editor['itemid'];
        $moduleinstance->osanamecat02editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat02editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat02editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat03editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat03editor['itemid'];
        $moduleinstance->osanamecat03editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat03editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat03editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat04editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat04editor['itemid'];
        $moduleinstance->osanamecat04editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat04editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat04editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat05editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat05editor['itemid'];
        $moduleinstance->osanamecat05editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat05editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat05editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat06editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat06editor['itemid'];
        $moduleinstance->osanamecat06editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat06editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat06editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat07editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat07editor['itemid'];
        $moduleinstance->osanamecat07editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat07editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat07editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat08editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat08editor['itemid'];
        $moduleinstance->osanamecat08editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat08editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat08editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat09editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat09editor['itemid'];
        $moduleinstance->osanamecat09editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat09editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat09editor);
        $DB->update_record('osa', $moduleinstance);
    }
    // Check for empty categorytexteditorfield. If not empty save draftitem into database via update_record.
    if ($mform && !empty($moduleinstance->osanamecat10editor['itemid'])) {
        $draftitemid                            = $moduleinstance->osanamecat10editor['itemid'];
        $moduleinstance->osanamecat10editor = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osanamecat10editor', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat10editor);
        $DB->update_record('osa', $moduleinstance);
    }

    $namecatno = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'];

    if ($mform && !empty($moduleinstance->osasettingimageoptional)) {
        $filemanagerdraftitemid = $moduleinstance->osasettingimageoptional;
        $moduleinstance->osasettingimageoptional = file_save_draft_area_files($filemanagerdraftitemid, $context->id, 'mod_osa', 'osasettingimageoptional', 0, osa_get_filemanager_options_imageoptional($context), $moduleinstance->osasettingimageoptional);
    }

    return $moduleinstance->id;
}

// Calbacks have to be defined in lib.php, event observers are in events.php, actual event classes are in folder classes/event/ .


/**
 * Updates an instance of the mod_osa in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_osa_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
 
function osa_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $cmid             = $moduleinstance->coursemodule;
    $draftitemid      = $moduleinstance->osasettingtextoptionaleditor['itemid'];
    $draftitemidcat01 = $moduleinstance->osanamecat01editor['itemid'];
    $draftitemidcat02 = $moduleinstance->osanamecat02editor['itemid'];
    $draftitemidcat03 = $moduleinstance->osanamecat03editor['itemid'];
    $draftitemidcat04 = $moduleinstance->osanamecat04editor['itemid'];
    $draftitemidcat05 = $moduleinstance->osanamecat05editor['itemid'];
    $draftitemidcat06 = $moduleinstance->osanamecat06editor['itemid'];
    $draftitemidcat07 = $moduleinstance->osanamecat07editor['itemid'];
    $draftitemidcat08 = $moduleinstance->osanamecat08editor['itemid'];
    $draftitemidcat09 = $moduleinstance->osanamecat09editor['itemid'];
    $draftitemidcat10 = $moduleinstance->osanamecat10editor['itemid'];
    $draftitemidcat11 = $moduleinstance->osanamecat11editor['itemid'];
    $draftitemidcat12 = $moduleinstance->osanamecat12editor['itemid'];
    $draftitemidcat13 = $moduleinstance->osanamecat13editor['itemid'];
    $draftitemidcat14 = $moduleinstance->osanamecat14editor['itemid'];
    $draftitemidcat15 = $moduleinstance->osanamecat15editor['itemid'];
    $draftitemidcat16 = $moduleinstance->osanamecat16editor['itemid'];
    $draftitemidcat17 = $moduleinstance->osanamecat17editor['itemid'];
    $draftitemidcat18 = $moduleinstance->osanamecat18editor['itemid'];
    $draftitemidcat19 = $moduleinstance->osanamecat19editor['itemid'];
    $draftitemidcat20 = $moduleinstance->osanamecat20editor['itemid'];
    // Get file manager data.
    $filemanagerdraftitemid = $moduleinstance->osasettingimageoptional;

    $moduleinstance->timemodified = time();
    $moduleinstance->id           = $moduleinstance->instance;

    // Define in which field data for optional text is being saved into.
    $moduleinstance->osasettingtextoptional        = $moduleinstance->osasettingtextoptionaleditor['text'];
    $moduleinstance->osasettingtextoptionalformat  = $moduleinstance->osasettingtextoptionaleditor['format'];
    // Predescribe content and format of category description field for saving later on in $DB.
    $moduleinstance->osanamecat01       = $moduleinstance->osanamecat01editor['text'];
    $moduleinstance->osanamecat01format = $moduleinstance->osanamecat01editor['format'];
    $moduleinstance->osanamecat02       = $moduleinstance->osanamecat02editor['text'];
    $moduleinstance->osanamecat02format = $moduleinstance->osanamecat02editor['format'];
    $moduleinstance->osanamecat03       = $moduleinstance->osanamecat03editor['text'];
    $moduleinstance->osanamecat03format = $moduleinstance->osanamecat03editor['format'];
    $moduleinstance->osanamecat04       = $moduleinstance->osanamecat04editor['text'];
    $moduleinstance->osanamecat04format = $moduleinstance->osanamecat04editor['format'];
    $moduleinstance->osanamecat05       = $moduleinstance->osanamecat05editor['text'];
    $moduleinstance->osanamecat05format = $moduleinstance->osanamecat05editor['format'];
    $moduleinstance->osanamecat06       = $moduleinstance->osanamecat06editor['text'];
    $moduleinstance->osanamecat06format = $moduleinstance->osanamecat06editor['format'];
    $moduleinstance->osanamecat07       = $moduleinstance->osanamecat07editor['text'];
    $moduleinstance->osanamecat07format = $moduleinstance->osanamecat07editor['format'];
    $moduleinstance->osanamecat08       = $moduleinstance->osanamecat08editor['text'];
    $moduleinstance->osanamecat08format = $moduleinstance->osanamecat08editor['format'];
    $moduleinstance->osanamecat09       = $moduleinstance->osanamecat09editor['text'];
    $moduleinstance->osanamecat09format = $moduleinstance->osanamecat09editor['format'];
    $moduleinstance->osanamecat10       = $moduleinstance->osanamecat10editor['text'];
    $moduleinstance->osanamecat10format = $moduleinstance->osanamecat10editor['format'];
    $moduleinstance->osanamecat11       = $moduleinstance->osanamecat11editor['text'];
    $moduleinstance->osanamecat11format = $moduleinstance->osanamecat11editor['format'];
    $moduleinstance->osanamecat12       = $moduleinstance->osanamecat12editor['text'];
    $moduleinstance->osanamecat12format = $moduleinstance->osanamecat12editor['format'];
    $moduleinstance->osanamecat13       = $moduleinstance->osanamecat13editor['text'];
    $moduleinstance->osanamecat13format = $moduleinstance->osanamecat13editor['format'];
    $moduleinstance->osanamecat14       = $moduleinstance->osanamecat14editor['text'];
    $moduleinstance->osanamecat14format = $moduleinstance->osanamecat14editor['format'];
    $moduleinstance->osanamecat15       = $moduleinstance->osanamecat15editor['text'];
    $moduleinstance->osanamecat15format = $moduleinstance->osanamecat15editor['format'];
    $moduleinstance->osanamecat16       = $moduleinstance->osanamecat16editor['text'];
    $moduleinstance->osanamecat16format = $moduleinstance->osanamecat16editor['format'];
    $moduleinstance->osanamecat17       = $moduleinstance->osanamecat17editor['text'];
    $moduleinstance->osanamecat17format = $moduleinstance->osanamecat17editor['format'];
    $moduleinstance->osanamecat18       = $moduleinstance->osanamecat18editor['text'];
    $moduleinstance->osanamecat18format = $moduleinstance->osanamecat18editor['format'];
    $moduleinstance->osanamecat19       = $moduleinstance->osanamecat19editor['text'];
    $moduleinstance->osanamecat19format = $moduleinstance->osanamecat19editor['format'];
    $moduleinstance->osanamecat20       = $moduleinstance->osanamecat20editor['text'];
    $moduleinstance->osanamecat20format = $moduleinstance->osanamecat20editor['format'];

    // Define in which field data for optional image is being saved into.
    $moduleinstance->osasettingimageoptional      = $moduleinstance->osasettingimageoptional;

    $DB->update_record('osa', $moduleinstance);

    $context = context_module::instance($cmid);

    if ($draftitemid) {
        $moduleinstance->osasettingtextoptional = file_save_draft_area_files($draftitemid, $context->id, 'mod_osa', 'osasettingtextoptional', 0, osa_get_editor_options_textfield($context), $moduleinstance->osasettingtextoptional);
        $DB->update_record('osa', $moduleinstance);
    }

    if ($draftitemidcat01) {
        $moduleinstance->osanamecat01 = file_save_draft_area_files($draftitemidcat01, $context->id, 'mod_osa', 'osanamecat01', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat01);
//        $DB->update_record('osa', $moduleinstance);
    }

    if ($draftitemidcat02) {
        $moduleinstance->osanamecat02 = file_save_draft_area_files($draftitemidcat02, $context->id, 'mod_osa', 'osanamecat02', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat02);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat03) {
        $moduleinstance->osanamecat03 = file_save_draft_area_files($draftitemidcat03, $context->id, 'mod_osa', 'osanamecat03', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat03);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat04) {
        $moduleinstance->osanamecat04 = file_save_draft_area_files($draftitemidcat04, $context->id, 'mod_osa', 'osanamecat04', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat04);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat05) {
        $moduleinstance->osanamecat05 = file_save_draft_area_files($draftitemidcat05, $context->id, 'mod_osa', 'osanamecat05', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat05);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat06) {
        $moduleinstance->osanamecat06 = file_save_draft_area_files($draftitemidcat06, $context->id, 'mod_osa', 'osanamecat06', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat06);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat07) {
        $moduleinstance->osanamecat07 = file_save_draft_area_files($draftitemidcat07, $context->id, 'mod_osa', 'osanamecat07', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat07);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat08) {
        $moduleinstance->osanamecat08 = file_save_draft_area_files($draftitemidcat08, $context->id, 'mod_osa', 'osanamecat08', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat08);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat09) {
        $moduleinstance->osanamecat09 = file_save_draft_area_files($draftitemidcat09, $context->id, 'mod_osa', 'osanamecat09', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat09);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat10) {
        $moduleinstance->osanamecat10 = file_save_draft_area_files($draftitemidcat10, $context->id, 'mod_osa', 'osanamecat10', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat10);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat11) {
        $moduleinstance->osanamecat11 = file_save_draft_area_files($draftitemidcat11, $context->id, 'mod_osa', 'osanamecat11', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat11);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat12) {
        $moduleinstance->osanamecat12 = file_save_draft_area_files($draftitemidcat12, $context->id, 'mod_osa', 'osanamecat12', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat12);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat13) {
        $moduleinstance->osanamecat13 = file_save_draft_area_files($draftitemidcat13, $context->id, 'mod_osa', 'osanamecat13', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat13);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat14) {
        $moduleinstance->osanamecat14 = file_save_draft_area_files($draftitemidcat14, $context->id, 'mod_osa', 'osanamecat14', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat14);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat15) {
        $moduleinstance->osanamecat15 = file_save_draft_area_files($draftitemidcat15, $context->id, 'mod_osa', 'osanamecat15', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat15);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat16) {
        $moduleinstance->osanamecat16 = file_save_draft_area_files($draftitemidcat16, $context->id, 'mod_osa', 'osanamecat16', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat16);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat17) {
        $moduleinstance->osanamecat17 = file_save_draft_area_files($draftitemidcat10, $context->id, 'mod_osa', 'osanamecat17', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat17);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat18) {
        $moduleinstance->osanamecat18 = file_save_draft_area_files($draftitemidcat10, $context->id, 'mod_osa', 'osanamecat18', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat18);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat19) {
        $moduleinstance->osanamecat19 = file_save_draft_area_files($draftitemidcat19, $context->id, 'mod_osa', 'osanamecat19', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat19);
//        $DB->update_record('osa', $moduleinstance);
    }
    if ($draftitemidcat20) {
        $moduleinstance->osanamecat20 = file_save_draft_area_files($draftitemidcat20, $context->id, 'mod_osa', 'osanamecat20', 0, osa_get_editor_options_textfield($context), $moduleinstance->osanamecat20);
//        $DB->update_record('osa', $moduleinstance);
    }

    $DB->update_record('osa', $moduleinstance);



    if ($filemanagerdraftitemid) {
        $moduleinstance->osasettingimageoptional = file_save_draft_area_files($filemanagerdraftitemid, $context->id, 'mod_osa', 'osasettingimageoptional', 0, osa_get_filemanager_options_imageoptional($context), $moduleinstance->osasettingimageoptional);
        $DB->update_record('osa', $moduleinstance);
    }

    return true;
}


/**
 * Removes an instance of the mod_osa from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
 
function osa_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('osa', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('osa', array('id' => $id));

    return true;
}


/**
 * Extends the global navigation tree by adding mod_osa nodes if there is a relevant content.
 *
 * This can be called by an AJAX request so do not rely on $PAGE as it might not be set up properly.
 *
 * @param navigation_node $osanode An object representing the navigation tree node.
 * @param stdClass $course
 * @param stdClass $module
 * @param cm_info $cm
 */
 
function osa_extend_navigation($osanode, $course, $module, $cm) {
}


/**
 * Extends the settings navigation with the mod_osa settings.
 *
 * This function is called when the context for the page is a mod_osa module.
 * This is not called by AJAX so it is safe to rely on the $PAGE.
 *
 * @param settings_navigation $settingsnav {@see settings_navigation}
 * @param navigation_node $osanode {@see navigation_node}
 */
 
function osa_extend_settings_navigation($settingsnav, $osanode = null) {
}


/**
 * This gets an array with values for the select mform.
 * @param  $amount amount of numbers int.
 *
 * @return array the options
 */

function osa_get_editor_select_options_amount($amount) {
    $select = array(
        0 => get_string('one', 'mod_osa'),
        1 => get_string('two', 'mod_osa'),
        2 => get_string('three', 'mod_osa'),
        3 => get_string('four', 'mod_osa'),
        4 => get_string('five', 'mod_osa'),
        5 => get_string('six', 'mod_osa'),
        6 => get_string('seven', 'mod_osa'),
        7 => get_string('eight', 'mod_osa'),
        8 => get_string('nine', 'mod_osa'),
        9 => get_string('ten', 'mod_osa'),
        10 => get_string('eleven', 'mod_osa'),
        11 => get_string('twelve', 'mod_osa'),
        12 => get_string('thirteen', 'mod_osa'),
        13 => get_string('fourteen', 'mod_osa'),
        14 => get_string('fifteen', 'mod_osa'),
        15 => get_string('sixteen', 'mod_osa'),
        16 => get_string('seventeen', 'mod_osa'),
        17 => get_string('eighteen', 'mod_osa'),
        18 => get_string('nineteen', 'mod_osa'),
        19 => get_string('twenty', 'mod_osa')
    );
    // Remove specific values from the array and return them as an array.
    if ($amount === 5) {
            $select = array_splice($select, 0, 5);
        }
        elseif ($amount === 10) {
            $select = array_splice($select, 0, 10);
        }
        elseif ($amount === 20) {
            $select = array_splice($select, 0, 20);
        }
        else {
            $select = $select;
        }
return $select;
}

/**
 * This gets an array with values for the select standard values mform.
 * @param  $amount amount of numbers int.
 *
 * @return array the options
 */

function osa_get_editor_select_options_standard_values($amount) {
    $select = array(
        0 => get_string('noselection', 'mod_osa'),
        1 => get_string('one', 'mod_osa'),
        2 => get_string('two', 'mod_osa'),
        3 => get_string('three', 'mod_osa'),
        4 => get_string('four', 'mod_osa'),
        5 => get_string('five', 'mod_osa'),
        6 => get_string('six', 'mod_osa'),
        7 => get_string('seven', 'mod_osa'),
        8 => get_string('eight', 'mod_osa'),
        9 => get_string('nine', 'mod_osa'),
        10 => get_string('ten', 'mod_osa'),
        11 => get_string('eleven', 'mod_osa'),
        12 => get_string('twelve', 'mod_osa'),
        13 => get_string('thirteen', 'mod_osa'),
        14 => get_string('fourteen', 'mod_osa'),
        15 => get_string('fifteen', 'mod_osa'),
        16 => get_string('sixteen', 'mod_osa'),
        17 => get_string('seventeen', 'mod_osa'),
        18 => get_string('eighteen', 'mod_osa'),
        19 => get_string('nineteen', 'mod_osa'),
        20 => get_string('twenty', 'mod_osa'),
        21 => get_string('twentyone', 'mod_osa'),
        22 => get_string('twentytwo', 'mod_osa'),
        23 => get_string('twentythree', 'mod_osa'),
        24 => get_string('twentyfour', 'mod_osa'),
        25 => get_string('twentyfive', 'mod_osa'),
        26 => get_string('twentysix', 'mod_osa'),
        27 => get_string('twentyseven', 'mod_osa'),
        28 => get_string('twentyeight', 'mod_osa'),
        29 => get_string('twentynine', 'mod_osa'),
        30 => get_string('thirty', 'mod_osa'),
        31 => get_string('thirtyone', 'mod_osa'),
        32 => get_string('thirtytwo', 'mod_osa'),
        33 => get_string('thirtythree', 'mod_osa'),
        34 => get_string('thirtyfour', 'mod_osa'),
        35 => get_string('thirtyfive', 'mod_osa'),
        36 => get_string('thirtysix', 'mod_osa'),
        37 => get_string('thirtyseven', 'mod_osa'),
        38 => get_string('thirtyeight', 'mod_osa'),
        39 => get_string('thirtynine', 'mod_osa'),
        40 => get_string('fourty', 'mod_osa'),
        41 => get_string('fourtyone', 'mod_osa'),
        42 => get_string('fourtytwo', 'mod_osa'),
        43 => get_string('fourtythree', 'mod_osa'),
        44 => get_string('fourtyfour', 'mod_osa'),
        45 => get_string('fourtyfive', 'mod_osa'),
        46 => get_string('fourtysix', 'mod_osa'),
        47 => get_string('fourtyseven', 'mod_osa'),
        48 => get_string('fourtyeight', 'mod_osa'),
        49 => get_string('fourtynine', 'mod_osa'),
        50 => get_string('fifty', 'mod_osa'),
        51 => get_string('fiftyone', 'mod_osa'),
        52 => get_string('fiftytwo', 'mod_osa'),
        53 => get_string('fiftythree', 'mod_osa'),
        54 => get_string('fiftyfour', 'mod_osa'),
        55 => get_string('fiftyfive', 'mod_osa'),
        56 => get_string('fiftysix', 'mod_osa'),
        57 => get_string('fiftyseven', 'mod_osa'),
        58 => get_string('fiftyeight', 'mod_osa'),
        59 => get_string('fiftynine', 'mod_osa'),
        60 => get_string('sixty', 'mod_osa'),
        61 => get_string('sixtyone', 'mod_osa'),
        62 => get_string('sixtytwo', 'mod_osa'),
        63 => get_string('sixtythree', 'mod_osa'),
        64 => get_string('sixtyfour', 'mod_osa'),
        65 => get_string('sixtyfive', 'mod_osa'),
        66 => get_string('sixtysix', 'mod_osa'),
        67 => get_string('sixtyseven', 'mod_osa'),
        68 => get_string('sixtyeight', 'mod_osa'),
        69 => get_string('sixtynine', 'mod_osa'),
        70 => get_string('seventy', 'mod_osa'),
        71 => get_string('seventyone', 'mod_osa'),
        72 => get_string('seventytwo', 'mod_osa'),
        73 => get_string('seventythree', 'mod_osa'),
        74 => get_string('seventyfour', 'mod_osa'),
        75 => get_string('seventyfive', 'mod_osa'),
        76 => get_string('seventysix', 'mod_osa'),
        77 => get_string('seventyseven', 'mod_osa'),
        78 => get_string('seventyeight', 'mod_osa'),
        79 => get_string('seventynine', 'mod_osa'),
        80 => get_string('eighty', 'mod_osa'),
        81 => get_string('eightyone', 'mod_osa'),
        82 => get_string('eightytwo', 'mod_osa'),
        83 => get_string('eightythree', 'mod_osa'),
        84 => get_string('eightyfour', 'mod_osa'),
        85 => get_string('eightyfive', 'mod_osa'),
        86 => get_string('eightysix', 'mod_osa'),
        87 => get_string('eightyseven', 'mod_osa'),
        88 => get_string('eightyeight', 'mod_osa'),
        89 => get_string('eightynine', 'mod_osa'),
        90 => get_string('ninety', 'mod_osa'),
        91 => get_string('ninetyone', 'mod_osa'),
        92 => get_string('ninetytwo', 'mod_osa'),
        93 => get_string('ninetythree', 'mod_osa'),
        94 => get_string('ninetyfour', 'mod_osa'),
        95 => get_string('ninetyfive', 'mod_osa'),
        96 => get_string('ninetysix', 'mod_osa'),
        97 => get_string('ninetyseven', 'mod_osa'),
        98 => get_string('ninetyeight', 'mod_osa'),
        99 => get_string('ninetynine', 'mod_osa'),
        100 => get_string('onehundred', 'mod_osa'),
    );
    // Remove specific values from the array and return them as an array.
    if ($amount === 5) {
            $select = array_splice($select, 0, 6);
//            $select = array_push($select, array_splice($select, 100, 100));
        }
        elseif ($amount === 7) {
            $select = array_splice($select, 0, 8);
//            $select = array_push($select, array_splice($select, 100, 100));
        }
        elseif ($amount === 10) {
            $select = array_splice($select, 0, 11);
//            $select = array_push($select, array_splice($select, 100, 100));
        }
        elseif ($amount === 20) {
            $select = array_splice($select, 0, 21);
//            $select = array_push($select, array_splice($select, 100, 100));
        }
        else {
            $select = $select;
//            $select = array_push($select, array_splice($select, 100, 100));
        }

return $select;
}


/**
 * This gets an array with value for the length of the mform element.
 *
 * @return array the options
 */

function osa_get_mform_length() {
    $standardsizeformlength = array(
        'size' => '64'
    );
return $standardsizeformlength;
}


/**
 * This gets an array with default options for the editor.
 *
 * @return array the options
 */
 
function osa_get_editor_options_textfield() {
    return array('rows' => 5,
                'maxfiles' => 1,
                'noclean' => false,
                'subdirs' => false,
                );
}


/**
 * This gets an array with default options for the questiontype textelement editor.
 *
 * @return array the options
 */

function osa_get_editor_options_edit_questiontype_textelement($context) {
    $options = array('rows' => 5,
                'maxfiles' => 1,
                'context' => $context,
                'noclean' => false,
                'subdirs' => false,
                );
    return $options;
}


/**
 * This gets an array with default options for the questiontype checkbox editor.
 *
 * @return array the options
 */

function osa_get_editor_options_edit_questiontype_checkbox($context) {
    $options = array('rows' => 5,
                'maxfiles' => 1,
                'context' => $context,
                'noclean' => false,
                'subdirs' => false,
                );
    return $options;
}


/**
 * This gets an array with default options for the questiontype checkbox editor.
 *
 * @return array the options
 */

function osa_get_editor_options_edit_questiontype_slider($context) {
    $options = array('rows' => 5,
                'maxfiles' => 1,
                'context' => $context,
                'noclean' => false,
                'subdirs' => false,
                );
    return $options;
}


function osa_get_filemanager_options_edit_questiontype_slider($context) {
    $options = array(
                'subdirs' => 0,
                'maxbytes' => 1024,
                'context' => $context,
                'areamaxbytes' => 10485760,
                'maxfiles' => 1,
                'accepted_types' => ['image'],
                );
    return $options;
}


/**
 * This gets an array with default options for the questiontype likert scale editor.
 *
 * @return array the options
 */

function osa_get_editor_options_edit_questiontype_likert($context) {
    $options = array('rows' => 5,
                'maxfiles' => 1,
                'context' => $context,
                'noclean' => false,
                'subdirs' => false,
                );
    return $options;
}


function osa_get_filemanager_options_edit_questiontype_likert($context) {
    $options = array(
                'subdirs' => 0,
                'maxbytes' => 1024,
                'context' => $context,
                'areamaxbytes' => 10485760,
                'maxfiles' => 1,
                'accepted_types' => ['image'],
                );
    return $options;
}


/**
 * This gets an array with default options for the filemanager.
 *
 * Removed types option. Aparrently it is not needed.
 * @return array the options
 */

function osa_get_filemanager_options_imageoptional() {
    $options = array('subdirs' => 0,
                'maxbytes' => 1024,
                'areamaxbytes' => 10485760,
                'maxfiles' => 1,
                'accepted_types' => ['image'],
                );
    return $options;
}


/**
 * This gets an array with default options for the category feedback settings editor.
 *
 * @return array the options
 */

function osa_get_editor_options_edit_cat_feedback_settings($context) {
    $options = array('rows' => 5,
                'maxfiles' => 1,
                'context' => $context,
                'noclean' => false,
                'subdirs' => false,
                );
    return $options;
}


/**
 * This gets an array with default options for the view part of the textelement questiontype to fill in by the user/student.
 *
 * @return array the options
 */

//function osa_get_editor_options_edit_view_textelement() {
//    $options = array('subdirs' => 0,
//                'maxbytes' => 0,
//                'areamaxbytes' => 0,
//                'maxfiles' => 0,
//                'accepted_types' => [],
//                );
//    return $options;
//}


function osa_get_image_link($contextid, $filearea, $itemid) {
//echo "<br>\ncontextid<br>\n";
//var_dump($contextid);
//echo "<br>\nfilearea<br>\n";
//var_dump($filearea);
//echo "<br>\nitemid<br>\n";
//var_dump($itemid);
    $fs = get_file_storage();
//echo "<br>\n";
//echo "<br>\n";
//echo "fs<br>\n";
//var_dump($fs);
    $files = $fs->get_area_files(
        $contextid,
        'mod_osa',
        $filearea,
        $itemid // Elementid
    );

//echo "<br>\n<br>\nfiles<br>\n";
//var_dump($files);
//echo "<br>\n<br>\ncontextid<br>\n";
//var_dump($contextid);
//echo "<br>\n<br>\nitemid<br>\n";
//var_dump($itemid);
//echo "<br>\n";
//die;
    $imagefile = false;
//echo "<br>\n<br>\nimagefile<br>\n";
//var_dump($imagefile);
    foreach ($files as $file) {
        if ($file->get_filename() !== '.') {
            $imagefile = $file;
//echo "<br>\n<br>\nimagefile<br>\n";
//var_dump($imagefile);
//echo "<br>\n";
            break;
        }
    }
$file = $imagefile;
//echo "<br>\n<br>\nfile<br>\n";
//var_dump($file);
//die;
    if ($imagefile) {
        return moodle_url::make_pluginfile_url(
            $imagefile->get_contextid(),
            $imagefile->get_component(),
            $imagefile->get_filearea(),
            $imagefile->get_itemid(),
            $imagefile->get_filepath(),
            $imagefile->get_filename()
        );
    }

    return "";

}





/**
 * Returns the lists of all browsable file areas within the module context.
 *
 *
 * @package     mod_osa
 * @category    files
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @return string[].
 */
function osa_get_file_areas($course, $cm, $context) {
    $areas = array();
    return $areas;
}


function osa_get_file_info($browser, $areas, $course, $cm, $context, $filearea, $itemid, $filepath, $filename) {
    return null;
}


function osa_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    global $DB;

    if ($context->contextlevel != CONTEXT_MODULE) {
        return false;
    }

//var_dump($context->contextlevel);
//die;

    if (!has_capability('mod/osa:view', $context)) {
        return false;
    }

//var_dump(has_capability('mod/osa:view', $context));
//die;

//    require_login($course, true, $cm);

//    $fileareas = array(
//        'osasettingimageoptional',
//        'osasettingtextoptional',
//        'cbtextdesc01',
//        'lstextdesceditor01',
//        'ssdesceditor01',
//        'textelementeditor'
//    );

//var_dump("fileareas in osa_pluginfile function");
//var_dump($fileareas);
//die;

//    if (!in_array($filearea, $fileareas)) {
//        return false;
//    }

    if ($filearea !== 'osasettingimageoptional' && $filearea !== 'osasettingtextoptional' && $filearea !== 'cbtextdesc01' && $filearea !== 'cbtextdesc02' && $filearea !== 'cbtextdesc03' && $filearea !== 'cbtextdesc04' && $filearea !== 'cbtextdesc05' && $filearea !== 'cbtextdesc06' && $filearea !== 'cbtextdesc07' && $filearea !== 'cbtextdesc08' && $filearea !== 'cbtextdesc09' && $filearea !== 'cbtextdesc10' && $filearea !== 'lstextdesceditor01'  && $filearea !== 'lstextdesceditor02'  && $filearea !== 'lstextdesceditor03' && $filearea !== 'lstextdesceditor04' && $filearea !== 'lstextdesceditor05' && $filearea !== 'lstextdesceditor06' && $filearea !== 'lstextdesceditor07'  && $filearea !== 'lsimage01' && $filearea !== 'lsimage02' && $filearea !== 'lsimage03' && $filearea !== 'lsimage04' && $filearea !== 'lsimage05' && $filearea !== 'lsimage06' && $filearea !== 'lsimage07' && $filearea !== 'ssdesceditor01' && $filearea !== 'textelementeditor' && $filearea !== 'osanamecat01' && $filearea !== 'osanamecat02' && $filearea !== 'osanamecat03' && $filearea !== 'osanamecat04' && $filearea !== 'osanamecat05' && $filearea !== 'osanamecat06' && $filearea !== 'osanamecat07' && $filearea !== 'osanamecat08' && $filearea !== 'osanamecat09' && $filearea !== 'osanamecat10' && $filearea !== 'osanamecat11' && $filearea !== 'osanamecat12' && $filearea !== 'osanamecat13' && $filearea !== 'osanamecat14' && $filearea !== 'osanamecat15' && $filearea !== 'osanamecat16' && $filearea !== 'osanamecat17' && $filearea !== 'osanamecat18' && $filearea !== 'osanamecat19' && $filearea !== 'osanamecat20' && $filearea !== 'fbtllcat01' && $filearea !== 'fbtblulcat01' && $filearea !== 'fbtulcat01' && $filearea !== 'fbtllcat02' && $filearea !== 'fbtblulcat02' && $filearea !== 'fbtulcat02' && $filearea !== 'fbtllcat03' && $filearea !== 'fbtblulcat03' && $filearea !== 'fbtulcat03' && $filearea !== 'fbtllcat04' && $filearea !== 'fbtblulcat04' && $filearea !== 'fbtulcat04' && $filearea !== 'fbtllcat05' && $filearea !== 'fbtblulcat05' && $filearea !== 'fbtulcat05' && $filearea !== 'fbtllcat06' && $filearea !== 'fbtblulcat06' && $filearea !== 'fbtulcat06' && $filearea !== 'fbtllcat07' && $filearea !== 'fbtblulcat07' && $filearea !== 'fbtulcat07' && $filearea !== 'fbtllcat08' && $filearea !== 'fbtblulcat08' && $filearea !== 'fbtulcat08' && $filearea !== 'fbtllcat09' && $filearea !== 'fbtblulcat09' && $filearea !== 'fbtulcat09' && $filearea !== 'fbtllcat10' && $filearea !== 'fbtblulcat10' && $filearea !== 'fbtulcat10' && $filearea !== 'fbtllcat11' && $filearea !== 'fbtblulcat11' && $filearea !== 'fbtulcat11' && $filearea !== 'fbtllcat12' && $filearea !== 'fbtblulcat12' && $filearea !== 'fbtulcat12' && $filearea !== 'fbtllcat13' && $filearea !== 'fbtblulcat13' && $filearea !== 'fbtulcat13' && $filearea !== 'fbtllcat14' && $filearea !== 'fbtblulcat14' && $filearea !== 'fbtulcat14' && $filearea !== 'fbtllcat15' && $filearea !== 'fbtblulcat15' && $filearea !== 'fbtulcat15' && $filearea !== 'fbtllcat16' && $filearea !== 'fbtblulcat16' && $filearea !== 'fbtulcat16' && $filearea !== 'fbtllcat17' && $filearea !== 'fbtblulcat17' && $filearea !== 'fbtulcat17' && $filearea !== 'fbtllcat18' && $filearea !== 'fbtblulcat18' && $filearea !== 'fbtulcat18' && $filearea !== 'fbtllcat19' && $filearea !== 'fbtblulcat19' && $filearea !== 'fbtulcat19' && $filearea !== 'fbtllcat20' && $filearea !== 'fbtblulcat20' && $filearea !== 'fbtulcat20') {
////    if ($filearea !== 'osasettingimageoptional') {
        return false;
    }

//var_dump($filearea);
//die;

    $itemid = array_shift($args);

//var_dump($itemid);
//die;

    if ($itemid != 0) {
        return false;
    }

    $fs = get_file_storage();

//var_dump($fs);
//die;

    $filename = array_pop($args);
//var_dump($filename);
//var_dump($args);
//die;
    if (empty($args)) {
        $filepath = '/';
    } else {
        $filepath = '/'.implode('/', $args).'/';
    }
//var_dump($filepath);
//die;
    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'mod_osa', $filearea, $itemid, $filepath, $filename);
//var_dump($filearea);
//var_dump($context);
//var_dump($file);
//die;
// test start if we are serving only one file.
//$file = reset($files);
//var_dump($file);
//die;
// test end
    if (!$file) {
        return false;
    }
//var_dump($file);
//die;

//// finally send the file to the browser
//    send_stored_file($file, 1440, 0, true, $options);
    send_stored_file($file, 1440, 0, true, $options);
}

/**
 * Creates or updates a edit_questiontype_textelement textelementeditor entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $textelement textelement object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */

function osa_edit_questiontype_textelement_entry($entry, $course, $osa, $cm, $context, $textelementid) {
    global $DB, $USER;

    $editoroptions = osa_get_editor_options_edit_questiontype_textelement($context);

    $currenttime = time();

    if (empty($entry->id)) {
        $entry->fk_qtt                  = $osa->id;
        $entry->timecreated             = $currenttime;
        $entry->textelementeditorformat = FORMAT_HTML;
        $isnewentry              = true;
    } else {
        $isnewentry              = false;
    }

    $entry->textelementname       = $entry->textelementname;
    $entry->textelementeditor       = '';          // Field is updated later.
    $entry->textelementeditorformat = FORMAT_HTML; // Field is updated later.

    if ($isnewentry) {
        // Add new entry to osa_instance_qttextelement table.
        $entry->id = $DB->insert_record('osa_instance_qttextelement', $entry);
        // Add entry in osa_instance_qtype_collection to reference the qtype tables and add a sort number.
        $sort = new stdClass();
        $sort->fk_tqtt = $entry->id;
        $sort->fk_cmid = $osa->id;
        $sort->sort = 0; // To be automated. Only for testing purposes a static value is used.
        $sort->id = $DB->insert_record('osa_qtype_collection', $sort);
        $sort->sort = $sort->id;
        $sort->id = $DB->update_record('osa_qtype_collection', $sort);
    } else {
        $entry->timemodified = $currenttime;
        // Update existing entry in osa_instance_qttextelement table.
        $DB->update_record('osa_instance_qttextelement', $entry);
    }

    // Save and relink embedded images and save attachments.
    if (!empty($entry->textelementeditor_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'textelementeditor', $editoroptions, $context, 'mod_osa', 'textelementeditor', $entry->id);
    }

    // Store the updated value values.
    $DB->update_record('osa_instance_qttextelement', $entry);

    // Refetch complete entry.
    $entry = $DB->get_record('osa_instance_qttextelement', array('id' => $entry->id));
    return $entry;
}

/**
 * Creates or updates a edit_questiontype_textelement_a textarea entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $questionid questionid object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */

function osa_edit_questiontype_textelement_a_entry($entry, $course, $osa, $cm, $context, $questionid, $recordid) {
    global $DB, $USER;

    //$editoroptions = osa_get_editor_options_edit_questiontype_textelement($context);

    $currenttime = time();

    // Check for empty questionid. If empty create a new entry.
    if (empty($entry->questionid)) {
        $entry->fk_user                       = $USER->id;
        // 
        $entry->fk_osa_instance_qttextelement = $recordid;
        // fk_cmid is the reference to the osa id => rename later on.
        $entry->fk_cmid                       = $osa->id;
        $entry->timecreated                   = $currenttime;
        $entry->textelementeditorformat       = FORMAT_HTML;
        $isnewentry                           = true;
    } else {
        $isnewentry                           = false;
    }

    $entry->textelementeditor       = '';          // Field is updated later.
    $entry->textelementeditorformat = FORMAT_HTML; // Field is updated later.

    if ($isnewentry) {
        // Add new entry to osa_instance_qttextelement table.
        $entry->textelementeditor = $entry->textarea_editor;
        $entry->id = $DB->insert_record('osa_instance_qttextelement_a', $entry);
    } else {
    // Get id of entry where fk_osa_instance_qttextelement = recordid.
//        $entry->id = $entry->id;
        $entry->timemodified = $currenttime;
        // Update existing entry in osa_instance_qttextelement table.
        $DB->update_record('osa_instance_qttextelement_a', $entry);
    }

//    // Save and relink embedded images and save attachments.
//    if (!empty($entry->textelementeditor_editor)) {
//        $entry = file_postupdate_standard_editor($entry, 'textelementeditor', $editoroptions, $context, 'mod_osa', 'textelementeditor', $entry->id);
//    }
//
//    $entry->id = $entry->id;
    // Store the updated value values.
    $DB->update_record('osa_instance_qttextelement_a', $entry);

    // Refetch complete entry.
    $entry = $DB->get_record('osa_instance_qttextelement_a', array('id' => $entry->id));
    return $entry;
}

/**
 * Creates or updates a edit_questiontype_checkbox checkboxtextdesc entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $checkbox checkbox object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */

function osa_edit_questiontype_checkbox_entry($entry, $course, $osa, $cm, $context, $checkboxid) {
    global $DB, $USER;

    $editoroptions = osa_get_editor_options_edit_questiontype_checkbox($context);

    $currenttime = time();

    if (empty($entry->id)) {
        $entry->fk_qtc             = $osa->id;
        $entry->timecreated        = $currenttime;
        $entry->cbtextdesc01format = FORMAT_HTML;
        $entry->cbtextdesc02format = FORMAT_HTML;
        $entry->cbtextdesc03format = FORMAT_HTML;
        $entry->cbtextdesc04format = FORMAT_HTML;
        $entry->cbtextdesc05format = FORMAT_HTML;
        $entry->cbtextdesc06format = FORMAT_HTML;
        $entry->cbtextdesc07format = FORMAT_HTML;
        $entry->cbtextdesc08format = FORMAT_HTML;
        $entry->cbtextdesc09format = FORMAT_HTML;
        $entry->cbtextdesc10format = FORMAT_HTML;
        $isnewentry                = true;
    } else {
        $isnewentry                = false;
    }

//    $entry->amountqtc          = $entry->amountqtc;
    $entry->cbname             = $entry->cbname;
    $entry->cbtextdesc01       = '';          // Field is updated later.
    $entry->cbtextdesc01format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc02       = '';          // Field is updated later.
    $entry->cbtextdesc02format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc03       = '';          // Field is updated later.
    $entry->cbtextdesc03format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc04       = '';          // Field is updated later.
    $entry->cbtextdesc04format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc05       = '';          // Field is updated later.
    $entry->cbtextdesc05format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc06       = '';          // Field is updated later.
    $entry->cbtextdesc06format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc07       = '';          // Field is updated later.
    $entry->cbtextdesc07format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc08       = '';          // Field is updated later.
    $entry->cbtextdesc08format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc09       = '';          // Field is updated later.
    $entry->cbtextdesc09format = FORMAT_HTML; // Field is updated later.
    $entry->cbtextdesc10       = '';          // Field is updated later.
    $entry->cbtextdesc10format = FORMAT_HTML; // Field is updated later.


    if ($isnewentry) {
        // Add new entry to osa_instance_qtcheckbox table.
        $entry->id = $DB->insert_record('osa_instance_qtcheckbox', $entry);
        // Add entry in osa_instance_qtype_collection to reference the qtype tables and add a sort number.
        $sort = new stdClass();
        $sort->fk_tqtc = $entry->id;
        $sort->fk_cmid = $osa->id;
        $sort->sort = 0; // To be automated. Only for testing purposes a static value is used.
        $sort->id = $DB->insert_record('osa_qtype_collection', $sort);
        $sort->sort = $sort->id;
        $sort->id = $DB->update_record('osa_qtype_collection', $sort);
    } else {
        $entry->timemodified = $currenttime;
        // Update existing entry in osa_instance_qtcheckbox table.
        $DB->update_record('osa_instance_qtcheckbox', $entry);
    }

    // Save and relink embedded images and save attachments.
    if (!empty($entry->cbtextdesc01_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc01', $editoroptions, $context, 'mod_osa', 'cbtextdesc01', $entry->id);
    }
    if (!empty($entry->cbtextdesc02_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc02', $editoroptions, $context, 'mod_osa', 'cbtextdesc02', $entry->id);
    }
    if (!empty($entry->cbtextdesc03_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc03', $editoroptions, $context, 'mod_osa', 'cbtextdesc03', $entry->id);
    }
    if (!empty($entry->cbtextdesc04_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc04', $editoroptions, $context, 'mod_osa', 'cbtextdesc04', $entry->id);
    }
    if (!empty($entry->cbtextdesc05_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc05', $editoroptions, $context, 'mod_osa', 'cbtextdesc05', $entry->id);
    }
    if (!empty($entry->cbtextdesc06_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc06', $editoroptions, $context, 'mod_osa', 'cbtextdesc06', $entry->id);
    }
    if (!empty($entry->cbtextdesc07_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc07', $editoroptions, $context, 'mod_osa', 'cbtextdesc07', $entry->id);
    }
    if (!empty($entry->cbtextdesc08_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc08', $editoroptions, $context, 'mod_osa', 'cbtextdesc08', $entry->id);
    }
    if (!empty($entry->cbtextdesc09_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc09', $editoroptions, $context, 'mod_osa', 'cbtextdesc09', $entry->id);
    }
    if (!empty($entry->cbtextdesc10_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'cbtextdesc10', $editoroptions, $context, 'mod_osa', 'cbtextdesc10', $entry->id);
    }


    // Store the updated value values.
    $DB->update_record('osa_instance_qtcheckbox', $entry);

    // Refetch complete entry.
    $entry = $DB->get_record('osa_instance_qtcheckbox', array('id' => $entry->id));
    return $entry;
}


/**
 * Creates or updates a edit_questiontype_checkbox slider entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $slider slider object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */

function osa_edit_questiontype_slider_entry($entry, $course, $osa, $cm, $context, $sliderid) {
    global $DB, $USER;

    $editoroptions = osa_get_editor_options_edit_questiontype_slider($context);
    $filemanageroptions = osa_get_filemanager_options_edit_questiontype_slider($context);

    $currenttime = time();

    if (empty($entry->id)) {
        $entry->fk_qts             = $osa->id;
        $entry->timecreated        = $currenttime;
        $entry->ssdesceditor01format = FORMAT_HTML;
        $isnewentry                = true;
    } else {
        $isnewentry                = false;
    }

//    $entry->amountqts            = $entry->amountqts;
    $entry->sname                = $entry->sname;
    $entry->sname01              = $entry->sname01;
    $entry->sname02              = $entry->sname02;
    $entry->sname03              = $entry->sname03;
    $entry->sname04              = $entry->sname04;
    $entry->sname05              = $entry->sname05;
    $entry->sname06              = $entry->sname06;
    $entry->sname07              = $entry->sname07;
    $entry->sname08              = $entry->sname08;
    $entry->sname09              = $entry->sname09;
    $entry->sname10              = $entry->sname10;
    $entry->simage01             = $entry->simage01_filemanager;
    $entry->simage02             = $entry->simage02_filemanager;
    $entry->simage03             = $entry->simage03_filemanager;
    $entry->simage04             = $entry->simage04_filemanager;
    $entry->simage05             = $entry->simage05_filemanager;
    $entry->simage06             = $entry->simage06_filemanager;
    $entry->simage07             = $entry->simage07_filemanager;
    $entry->simage08             = $entry->simage08_filemanager;
    $entry->simage09             = $entry->simage09_filemanager;
    $entry->simage10             = $entry->simage09_filemanager;
    $entry->simage01format       = FORMAT_HTML;
    $entry->simage02format       = FORMAT_HTML;
    $entry->simage03format       = FORMAT_HTML;
    $entry->simage04format       = FORMAT_HTML;
    $entry->simage05format       = FORMAT_HTML;
    $entry->simage06format       = FORMAT_HTML;
    $entry->simage07format       = FORMAT_HTML;
    $entry->simage08format       = FORMAT_HTML;
    $entry->simage09format       = FORMAT_HTML;
    $entry->simage10format       = FORMAT_HTML;
    $entry->ssdesceditor01       = '';          // Field is updated later.
    $entry->ssdesceditor02       = '';          // Field is updated later.
    $entry->ssdesceditor03       = '';          // Field is updated later.
    $entry->ssdesceditor04       = '';          // Field is updated later.
    $entry->ssdesceditor05       = '';          // Field is updated later.
    $entry->ssdesceditor06       = '';          // Field is updated later.
    $entry->ssdesceditor07       = '';          // Field is updated later.
    $entry->ssdesceditor08       = '';          // Field is updated later.
    $entry->ssdesceditor09       = '';          // Field is updated later.
    $entry->ssdesceditor10       = '';          // Field is updated later.
    $entry->ssdesceditor01format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor02format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor03format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor04format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor05format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor06format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor07format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor08format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor09format = FORMAT_HTML; // Field is updated later.
    $entry->ssdesceditor10format = FORMAT_HTML; // Field is updated later.

    if ($isnewentry) {
        // Add new entry to osa_instance_qtslider table.
        $entry->id = $DB->insert_record('osa_instance_qtslider', $entry);
        // Add entry in osa_instance_qtype_collection to reference the qtype tables and add a sort number.
        $sort = new stdClass();
        $sort->fk_tqts = $entry->id;
        $sort->fk_cmid = $osa->id;
        $sort->sort = 0; // To be automated. Only for testing purposes a static value is used.
        $sort->id = $DB->insert_record('osa_qtype_collection', $sort);
        $sort->sort = $sort->id;
        $sort->id = $DB->update_record('osa_qtype_collection', $sort);
    } else {
        $entry->timemodified = $currenttime;
        // Update existing entry in osa_instance_qtslider table.
        $DB->update_record('osa_instance_qtslider', $entry);
    }

    // Save and relink embedded images and save attachments.
    if (!empty($entry->ssdesceditor01_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor01', $editoroptions, $context, 'mod_osa', 'ssdesceditor01', $entry->id);
    }

    if (!empty($entry->ssdesceditor02_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor02', $editoroptions, $context, 'mod_osa', 'ssdesceditor02', $entry->id);
    }

    if (!empty($entry->ssdesceditor03_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor03', $editoroptions, $context, 'mod_osa', 'ssdesceditor03', $entry->id);
    }

    if (!empty($entry->ssdesceditor04_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor04', $editoroptions, $context, 'mod_osa', 'ssdesceditor04', $entry->id);
    }

    if (!empty($entry->ssdesceditor05_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor05', $editoroptions, $context, 'mod_osa', 'ssdesceditor05', $entry->id);
    }

    if (!empty($entry->ssdesceditor06_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor06', $editoroptions, $context, 'mod_osa', 'ssdesceditor06', $entry->id);
    }

    if (!empty($entry->ssdesceditor07_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor07', $editoroptions, $context, 'mod_osa', 'ssdesceditor07', $entry->id);
    }

    if (!empty($entry->ssdesceditor08_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor08', $editoroptions, $context, 'mod_osa', 'ssdesceditor08', $entry->id);
    }

    if (!empty($entry->ssdesceditor09_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor09', $editoroptions, $context, 'mod_osa', 'ssdesceditor09', $entry->id);
    }

    if (!empty($entry->ssdesceditor10_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'ssdesceditor10', $editoroptions, $context, 'mod_osa', 'ssdesceditor10', $entry->id);
    }

    // Save and relink files.
    if (!empty($entry->simage01_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage01', $filemanageroptions, $context, 'mod_osa', 'simage01', $entry->id);
    }

    if (!empty($entry->simage02_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage02', $filemanageroptions, $context, 'mod_osa', 'simage02', $entry->id);
    }

    if (!empty($entry->simage03_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage03', $filemanageroptions, $context, 'mod_osa', 'simage03', $entry->id);
    }

    if (!empty($entry->simage04_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage04', $filemanageroptions, $context, 'mod_osa', 'simage04', $entry->id);
    }

    if (!empty($entry->simage05_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage05', $filemanageroptions, $context, 'mod_osa', 'simage05', $entry->id);
    }

    if (!empty($entry->simage06_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage06', $filemanageroptions, $context, 'mod_osa', 'simage06', $entry->id);
    }

    if (!empty($entry->simage07_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage07', $filemanageroptions, $context, 'mod_osa', 'simage07', $entry->id);
    }

    if (!empty($entry->simage08_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage08', $filemanageroptions, $context, 'mod_osa', 'simage08', $entry->id);
    }

    if (!empty($entry->simage09_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage09', $filemanageroptions, $context, 'mod_osa', 'simage09', $entry->id);
    }

    if (!empty($entry->simage10_filemanager)) {
        $entry = file_postupdate_standard_filemanager($entry, 'simage10', $filemanageroptions, $context, 'mod_osa', 'simage10', $entry->id);
    }

    // Store the updated value values.
    $DB->update_record('osa_instance_qtslider', $entry);

    // Refetch complete entry.
    $entry = $DB->get_record('osa_instance_qtslider', array('id' => $entry->id));
    return $entry;
}


/**
 * Creates or updates a edit_questiontype_likert entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $likert likert object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */

function osa_edit_questiontype_likert_entry($entry, $course, $osa, $cm, $context, $likertid) {
    global $DB, $USER;

    $editoroptions = osa_get_editor_options_edit_questiontype_likert($context);
    $filemanageroptions = osa_get_filemanager_options_edit_questiontype_likert($context);

    $currenttime = time();

    if (empty($entry->id)) {
        $entry->fk_qtls                  = $osa->id;
        $entry->timecreated              = $currenttime;
        $entry->lstextdesceditor01format = FORMAT_HTML;
        $entry->lstextdesceditor02format = FORMAT_HTML;
        $entry->lstextdesceditor03format = FORMAT_HTML;
        $entry->lstextdesceditor04format = FORMAT_HTML;
        $entry->lstextdesceditor05format = FORMAT_HTML;
        $entry->lstextdesceditor06format = FORMAT_HTML;
        $entry->lstextdesceditor07format = FORMAT_HTML;
        $entry->lsimage01format          = FORMAT_HTML;
        $entry->lsimage02format          = FORMAT_HTML;
        $entry->lsimage03format          = FORMAT_HTML;
        $entry->lsimage04format          = FORMAT_HTML;
        $entry->lsimage05format          = FORMAT_HTML;
        $entry->lsimage06format          = FORMAT_HTML;
        $entry->lsimage07format          = FORMAT_HTML;

//        $entry->lsimage01                = $entry->lsimage01_filemanager;
//        $entry->lsimage02                = $entry->lsimage02_filemanager;
//        $entry->lsimage03                = $entry->lsimage03_filemanager;
//        $entry->lsimage04                = $entry->lsimage04_filemanager;
//        $entry->lsimage05                = $entry->lsimage05_filemanager;
//        $entry->lsimage06                = $entry->lsimage06_filemanager;
//        $entry->lsimage07                = $entry->lsimage07_filemanager;
        $isnewentry                      = true;
    } else {
        $isnewentry                      = false;
    }

//    $entry->amountlss                = $entry->amountlss;
    $entry->lsname                   = $entry->lsname;
    $entry->lstextdesceditor01       = '';          // Field is updated later.
    $entry->lstextdesceditor02       = '';          // Field is updated later.
    $entry->lstextdesceditor03       = '';          // Field is updated later.
    $entry->lstextdesceditor04       = '';          // Field is updated later.
    $entry->lstextdesceditor05       = '';          // Field is updated later.
    $entry->lstextdesceditor06       = '';          // Field is updated later.
    $entry->lstextdesceditor07       = '';          // Field is updated later.
    $entry->lstextdesceditor01format = FORMAT_HTML; // Field is updated later.
    $entry->lstextdesceditor02format = FORMAT_HTML; // Field is updated later.
    $entry->lstextdesceditor03format = FORMAT_HTML; // Field is updated later.
    $entry->lstextdesceditor04format = FORMAT_HTML; // Field is updated later.
    $entry->lstextdesceditor05format = FORMAT_HTML; // Field is updated later.
    $entry->lstextdesceditor06format = FORMAT_HTML; // Field is updated later.
    $entry->lstextdesceditor07format = FORMAT_HTML; // Field is updated later.

    $entry->lsimage01                = '';
    $entry->lsimage01format          = FORMAT_HTML;
    $entry->lsimage02                = '';
    $entry->lsimage02format          = FORMAT_HTML;
    $entry->lsimage03                = '';
    $entry->lsimage03format          = FORMAT_HTML;
    $entry->lsimage04                = '';
    $entry->lsimage04format          = FORMAT_HTML;
    $entry->lsimage05                = '';
    $entry->lsimage05format          = FORMAT_HTML;
    $entry->lsimage06                = '';
    $entry->lsimage06format          = FORMAT_HTML;
    $entry->lsimage07                = '';
    $entry->lsimage07format          = FORMAT_HTML;

    if ($isnewentry) {
        // Add new entry to osa_instance_qtlikertscale table.
        $entry->id = $DB->insert_record('osa_instance_qtlikertscale', $entry);
        // Add entry in osa_instance_qtype_collection to reference the qtype tables and add a sort number.
        $sort = new stdClass();
        $sort->fk_tqtls = $entry->id;
        $sort->fk_cmid = $osa->id;
        $sort->sort = 0; // To be automated. Only for testing purposes a static value is used.
        $sort->id = $DB->insert_record('osa_qtype_collection', $sort);
        $sort->sort = $sort->id;
        $sort->id = $DB->update_record('osa_qtype_collection', $sort);
    } else {
        $entry->timemodified = $currenttime;
        // Update existing entry in osa_instance_qtlikertscale table.
        $DB->update_record('osa_instance_qtlikertscale', $entry);
    }

    // Save and relink embedded images and save attachments.
    // Editor part.
    if (!empty($entry->lstextdesceditor01_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor01', $editoroptions, $context, 'mod_osa', 'lstextdesceditor01', $entry->id);
    }
    if (!empty($entry->lstextdesceditor02_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor02', $editoroptions, $context, 'mod_osa', 'lstextdesceditor02', $entry->id);
    }
    if (!empty($entry->lstextdesceditor03_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor03', $editoroptions, $context, 'mod_osa', 'lstextdesceditor03', $entry->id);
    }
    if (!empty($entry->lstextdesceditor04_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor04', $editoroptions, $context, 'mod_osa', 'lstextdesceditor04', $entry->id);
    }
    if (!empty($entry->lstextdesceditor05_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor05', $editoroptions, $context, 'mod_osa', 'lstextdesceditor05', $entry->id);
    }
    if (!empty($entry->lstextdesceditor06_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor06', $editoroptions, $context, 'mod_osa', 'lstextdesceditor06', $entry->id);
    }
    if (!empty($entry->lstextdesceditor07_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'lstextdesceditor07', $editoroptions, $context, 'mod_osa', 'lstextdesceditor07', $entry->id);
    }

    // Filemanager part.
    if (!empty($entry->lsimage01_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage01', $filemanageroptions, $context, 'mod_osa', 'lsimage01', $entry->id);
    }
    if (!empty($entry->lsimage02_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage02', $filemanageroptions, $context, 'mod_osa', 'lsimage02', $entry->id);
    }
    if (!empty($entry->lsimage03_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage03', $filemanageroptions, $context, 'mod_osa', 'lsimage03', $entry->id);
    }
    if (!empty($entry->lsimage04_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage04', $filemanageroptions, $context, 'mod_osa', 'lsimage04', $entry->id);
    }
    if (!empty($entry->lsimage05_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage05', $filemanageroptions, $context, 'mod_osa', 'lsimage05', $entry->id);
    }
    if (!empty($entry->lsimage06_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage06', $filemanageroptions, $context, 'mod_osa', 'lsimage06', $entry->id);
    }
    if (!empty($entry->lsimage07_filemanager)) {
         $entry = file_postupdate_standard_filemanager($entry, 'lsimage07', $filemanageroptions, $context, 'mod_osa', 'lsimage07', $entry->id);
    }

//var_dump($entry);
    // Store the updated value values.
    $DB->update_record('osa_instance_qtlikertscale', $entry);

    // Refetch complete entry.
    $entry = $DB->get_record('osa_instance_qtlikertscale', array('id' => $entry->id));
//var_dump($entry);
//die;
    return $entry;
}

/**
 * Creates or updates a edit_allocation_categories_entry entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */


function osa_edit_allocation_categories_entry($entries, $course, $osa, $cm, $context, $recordsosaqtypecollection) {
    global $DB, $USER;

//$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$records = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id), 'sort ASC');


        foreach ($records as $record) {

            $recordqtypecollectionid = $record->id;

//            var_dump($datafromdb);
//            var_dump($recordqtypecollectionid);


            // Get title of each question
            if ($record->fk_tqtt != 0) {
            // Get record for textelement.
            $recordinstance = $DB->get_record('osa_instance_qttextelement', array('id' => $record->fk_tqtt));
            $recordid = $recordinstance->id;
            $recordqtypecollectionid = $record->id;
//var_dump("<br>\n<br>\nrecordqtypecollectionid:", $recordqtypecollectionid, "<br>\n");
            }

            else if ($record->fk_tqtls != 0) {
            // Get record for likert scale.
            $recordinstance = $DB->get_record('osa_instance_qtlikertscale', array('id' => $record->fk_tqtls));
            $recordid = $recordinstance->id;
            $recordqtypecollectionid = $record->id;
//var_dump("<br>\n<br>\nrecordqtypecollectionid:", $recordqtypecollectionid, "<br>\n");
            }

            else if ($record->fk_tqtc != 0) {
            $recordinstance = $DB->get_record('osa_instance_qtcheckbox', array('id' => $record->fk_tqtc));
            $recordid = $recordinstance->id;
            $recordqtypecollectionid = $record->id;
//var_dump("<br>\n<br>\nrecordqtypecollectionid:", $recordqtypecollectionid, "<br>\n");
            }

            else if ($record->fk_tqts != 0) {
            $recordinstance = $DB->get_record('osa_instance_qtslider', array('id' => $record->fk_tqts));
            $recordid = $recordinstance->id;
            $recordqtypecollectionid = $record->id;
//var_dump("<br>\n<br>\nrecordqtypecollectionid:", $recordqtypecollectionid, "<br>\n");
            }

            $datafromdbrecordidosaqtypecollection[] = $recordqtypecollectionid;
//var_dump("<br>\n<br>\nrecordqtypecollectionidarray:", $datafromdbrecordidosaqtypecollection, "<br>\n");

        }

//var_dump("<br>\n<br>\n datafromdbrecordid:<br>\n", $datafromdbrecordidosaqtypecollection, "<br>\n<br>\n");

    for ($i = 0, $length = sizeof($datafromdbrecordidosaqtypecollection); $i < $length; $i++) {
//            var_dump("<br>\n", $datafromdbrecordidosaqtypecollection[$i], "<br>\n");
            $savenames[] = 'qtypecatselection' . $datafromdbrecordidosaqtypecollection[$i];
//            var_dump("savenames:", $savenames, "<br>\n<br>\n");
    }



    // Filter entries array that only qtypecatselection[$i] remains in array.

    $resultarray = array();

    $i = 0;
    foreach($entries as $key => $val) {
//var_dump("\$i =", $i, "<br>\n");
//var_dump("\$savenames[\$i] =", $savenames[$i], "<br>\n");
//var_dump("\$key =", $key, "<br>\n");
//var_dump("val =", (int)$val, "<br>\n");
    $valueiduserselected = (int)$val;
        if($key == $savenames[$i]) {
            $valueiduserselected = (int)$val;
            $valcollection[] = $valueiduserselected;
//var_dump("<br>\nvalcollection:", $valcollection, "<br>\n");
            $resultarraycollection[] = "";
//var_dump("<br>\nresultarray:", $resultarray, "<br>\n");
            $i = $i+1;
        }
    }

    // Combine arrays from savenames and valcollection.

    $arraycombine = array_combine($savenames, $valcollection);

//var_dump("<br>\narraycombine:", $arraycombine, "<br>\n");

    $records = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id), 'sort ASC');

    $i = 0;
    foreach ($records as $record) {
//    var_dump("<br>\nrecord:", $record, "<br>\n");
//    var_dump("<br>\nrecordid:", $record->id, "<br>\n");
    $record->category = $valcollection[$i];
    $record->id = $DB->update_record('osa_qtype_collection', $record);
    $i = $i+1;
    }
    return $entry;
}


/**
 * Creates or updates a osa_edit_standard_category_values_entry entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */


function osa_edit_standard_category_values_entry($entries, $course, $osa, $cm, $context, $recordsosaqtypecollection, $dbentries) {
    global $DB, $USER;

    $currenttime = time();

    if (empty($dbentries->id)) {
       	$entry->fk_cmid            = $cm->id;
        $entry->timecreated        = $currenttime;
        $isnewentry                = true;
    } else {
        $isnewentry                = false;
    }

    $entry->category01      = $entries->osanamecat01;
    $entry->category02      = $entries->osanamecat02;
    $entry->category03      = $entries->osanamecat03;
    $entry->category04      = $entries->osanamecat04;
    $entry->category05      = $entries->osanamecat05;
    $entry->category06      = $entries->osanamecat06;
    $entry->category07      = $entries->osanamecat07;
    $entry->category08      = $entries->osanamecat08;
    $entry->category09      = $entries->osanamecat09;
    $entry->category10      = $entries->osanamecat10;
    $entry->category11      = $entries->osanamecat11;
    $entry->category12      = $entries->osanamecat12;
    $entry->category13      = $entries->osanamecat13;
    $entry->category14      = $entries->osanamecat14;
    $entry->category15      = $entries->osanamecat15;
    $entry->category16      = $entries->osanamecat16;
    $entry->category17      = $entries->osanamecat17;
    $entry->category18      = $entries->osanamecat18;
    $entry->category19      = $entries->osanamecat19;
    $entry->category20      = $entries->osanamecat20;

    if ($isnewentry) {
        // Add new entry to osa_instance_qtslider table.
        $entry->id = $DB->insert_record('osa_cat_std_vals', $entry);
        // Add entry in osa_instance_qtype_collection to reference the qtype tables and add a sort number.
    } else {
        $entry->timemodified = $currenttime;
        $entry->id = $dbentries->id;
        // Update existing entry in osa_instance_qtslider table.
        $DB->update_record('osa_cat_std_vals', $entry);
    }

return $entry;

}

/**
 * Creates or updates a osa_edit_cat_feedback_settings_entry entry
 *
 * @param  stdClass $entry entry data
 * @param  stdClass $course course object
 * @param  stdClass $cm course module object
 * @param  stdClass $context context object
 * @return stdClass the complete new or updated entry
 */


//function osa_edit_cat_feedback_settings_entry($entries, $course, $osa, $cm, $context, $recordsosaqtypecollection, $dbentries) {
function osa_edit_cat_feedback_settings_entry($entry, $course, $osa, $cm, $context, $recordsosaqtypecollection, $dbentries) {
    global $DB, $USER;

    $editoroptions = osa_get_editor_options_edit_cat_feedback_settings($context);

    $currenttime = time();

//var_dump("<br>\n<br>\nentries:<br>\n", $entry);
//var_dump("<br>\n<br>\ndbentries:<br>\n", $dbentries);
//die;

    if (empty($dbentries->id)) {
       	$entry->fk_cmid            = $cm->id;
        $entry->fbtllcat01format   = FORMAT_HTML;
        $entry->fbtllcat02format   = FORMAT_HTML;
        $entry->fbtllcat03format   = FORMAT_HTML;
        $entry->fbtllcat04format   = FORMAT_HTML;
        $entry->fbtllcat05format   = FORMAT_HTML;
        $entry->fbtllcat06format   = FORMAT_HTML;
        $entry->fbtllcat07format   = FORMAT_HTML;
        $entry->fbtllcat08format   = FORMAT_HTML;
        $entry->fbtllcat09format   = FORMAT_HTML;
        $entry->fbtllcat10format   = FORMAT_HTML;
        $entry->fbtllcat11format   = FORMAT_HTML;
        $entry->fbtllcat12format   = FORMAT_HTML;
        $entry->fbtllcat13format   = FORMAT_HTML;
        $entry->fbtllcat14format   = FORMAT_HTML;
        $entry->fbtllcat15format   = FORMAT_HTML;
        $entry->fbtllcat16format   = FORMAT_HTML;
        $entry->fbtllcat17format   = FORMAT_HTML;
        $entry->fbtllcat18format   = FORMAT_HTML;
        $entry->fbtllcat19format   = FORMAT_HTML;
        $entry->fbtllcat20format   = FORMAT_HTML;
        $entry->fbtblulcat01format = FORMAT_HTML;
        $entry->fbtblulcat02format = FORMAT_HTML;
        $entry->fbtblulcat03format = FORMAT_HTML;
        $entry->fbtblulcat04format = FORMAT_HTML;
        $entry->fbtblulcat05format = FORMAT_HTML;
        $entry->fbtblulcat06format = FORMAT_HTML;
        $entry->fbtblulcat07format = FORMAT_HTML;
        $entry->fbtblulcat08format = FORMAT_HTML;
        $entry->fbtblulcat09format = FORMAT_HTML;
        $entry->fbtblulcat10format = FORMAT_HTML;
        $entry->fbtblulcat11format = FORMAT_HTML;
        $entry->fbtblulcat12format = FORMAT_HTML;
        $entry->fbtblulcat13format = FORMAT_HTML;
        $entry->fbtblulcat14format = FORMAT_HTML;
        $entry->fbtblulcat15format = FORMAT_HTML;
        $entry->fbtblulcat16format = FORMAT_HTML;
        $entry->fbtblulcat17format = FORMAT_HTML;
        $entry->fbtblulcat18format = FORMAT_HTML;
        $entry->fbtblulcat19format = FORMAT_HTML;
        $entry->fbtblulcat20format = FORMAT_HTML;
        $entry->fbtulcat01format   = FORMAT_HTML;
        $entry->fbtulcat02format   = FORMAT_HTML;
        $entry->fbtulcat03format   = FORMAT_HTML;
        $entry->fbtulcat04format   = FORMAT_HTML;
        $entry->fbtulcat05format   = FORMAT_HTML;
        $entry->fbtulcat06format   = FORMAT_HTML;
        $entry->fbtulcat07format   = FORMAT_HTML;
        $entry->fbtulcat08format   = FORMAT_HTML;
        $entry->fbtulcat09format   = FORMAT_HTML;
        $entry->fbtulcat10format   = FORMAT_HTML;
        $entry->fbtulcat11format   = FORMAT_HTML;
        $entry->fbtulcat12format   = FORMAT_HTML;
        $entry->fbtulcat13format   = FORMAT_HTML;
        $entry->fbtulcat14format   = FORMAT_HTML;
        $entry->fbtulcat15format   = FORMAT_HTML;
        $entry->fbtulcat16format   = FORMAT_HTML;
        $entry->fbtulcat17format   = FORMAT_HTML;
        $entry->fbtulcat18format   = FORMAT_HTML;
        $entry->fbtulcat19format   = FORMAT_HTML;
        $entry->fbtulcat20format   = FORMAT_HTML;
        $entry->timecreated        = $currenttime;
        $isnewentry                = true;
    } else {
        $isnewentry                = false;
    }

    $entry->fbtllcat01         = '';
    $entry->fbtllcat02         = '';
    $entry->fbtllcat03         = '';
    $entry->fbtllcat04         = '';
    $entry->fbtllcat05         = '';
    $entry->fbtllcat06         = '';
    $entry->fbtllcat07         = '';
    $entry->fbtllcat08         = '';
    $entry->fbtllcat09         = '';
    $entry->fbtllcat10         = '';
    $entry->fbtllcat11         = '';
    $entry->fbtllcat12         = '';
    $entry->fbtllcat13         = '';
    $entry->fbtllcat14         = '';
    $entry->fbtllcat15         = '';
    $entry->fbtllcat16         = '';
    $entry->fbtllcat17         = '';
    $entry->fbtllcat18         = '';
    $entry->fbtllcat19         = '';
    $entry->fbtllcat20         = '';
    $entry->fbtblulcat01       = '';
    $entry->fbtblulcat02       = '';
    $entry->fbtblulcat03       = '';
    $entry->fbtblulcat04       = '';
    $entry->fbtblulcat05       = '';
    $entry->fbtblulcat06       = '';
    $entry->fbtblulcat07       = '';
    $entry->fbtblulcat08       = '';
    $entry->fbtblulcat09       = '';
    $entry->fbtblulcat10       = '';
    $entry->fbtblulcat11       = '';
    $entry->fbtblulcat12       = '';
    $entry->fbtblulcat13       = '';
    $entry->fbtblulcat14       = '';
    $entry->fbtblulcat15       = '';
    $entry->fbtblulcat16       = '';
    $entry->fbtblulcat17       = '';
    $entry->fbtblulcat18       = '';
    $entry->fbtblulcat19       = '';
    $entry->fbtblulcat20       = '';
    $entry->fbtulcat01         = '';
    $entry->fbtulcat02         = '';
    $entry->fbtulcat03         = '';
    $entry->fbtulcat04         = '';
    $entry->fbtulcat05         = '';
    $entry->fbtulcat06         = '';
    $entry->fbtulcat07         = '';
    $entry->fbtulcat08         = '';
    $entry->fbtulcat09         = '';
    $entry->fbtulcat10         = '';
    $entry->fbtulcat11         = '';
    $entry->fbtulcat12         = '';
    $entry->fbtulcat13         = '';
    $entry->fbtulcat14         = '';
    $entry->fbtulcat15         = '';
    $entry->fbtulcat16         = '';
    $entry->fbtulcat17         = '';
    $entry->fbtulcat18         = '';
    $entry->fbtulcat19         = '';
    $entry->fbtulcat20         = '';

    $entry->stdvalllcat01      = $entry->stdvalllcat01;
    $entry->stdvalllcat02      = $entry->stdvalllcat02;
    $entry->stdvalllcat03      = $entry->stdvalllcat03;
    $entry->stdvalllcat04      = $entry->stdvalllcat04;
    $entry->stdvalllcat05      = $entry->stdvalllcat05;
    $entry->stdvalllcat06      = $entry->stdvalllcat06;
    $entry->stdvalllcat07      = $entry->stdvalllcat07;
    $entry->stdvalllcat08      = $entry->stdvalllcat08;
    $entry->stdvalllcat09      = $entry->stdvalllcat09;
    $entry->stdvalllcat10      = $entry->stdvalllcat10;
    $entry->stdvalllcat11      = $entry->stdvalllcat11;
    $entry->stdvalllcat12      = $entry->stdvalllcat12;
    $entry->stdvalllcat13      = $entry->stdvalllcat13;
    $entry->stdvalllcat14      = $entry->stdvalllcat14;
    $entry->stdvalllcat15      = $entry->stdvalllcat15;
    $entry->stdvalllcat16      = $entry->stdvalllcat16;
    $entry->stdvalllcat17      = $entry->stdvalllcat17;
    $entry->stdvalllcat18      = $entry->stdvalllcat18;
    $entry->stdvalllcat19      = $entry->stdvalllcat19;
    $entry->stdvalllcat20      = $entry->stdvalllcat20;


    $entry->stdvalulcat01      = $entry->stdvalulcat01;
    $entry->stdvalulcat02      = $entry->stdvalulcat02;
    $entry->stdvalulcat03      = $entry->stdvalulcat03;
    $entry->stdvalulcat04      = $entry->stdvalulcat04;
    $entry->stdvalulcat05      = $entry->stdvalulcat05;
    $entry->stdvalulcat06      = $entry->stdvalulcat06;
    $entry->stdvalulcat07      = $entry->stdvalulcat07;
    $entry->stdvalulcat08      = $entry->stdvalulcat08;
    $entry->stdvalulcat09      = $entry->stdvalulcat09;
    $entry->stdvalulcat10      = $entry->stdvalulcat10;
    $entry->stdvalulcat11      = $entry->stdvalulcat11;
    $entry->stdvalulcat12      = $entry->stdvalulcat12;
    $entry->stdvalulcat13      = $entry->stdvalulcat13;
    $entry->stdvalulcat14      = $entry->stdvalulcat14;
    $entry->stdvalulcat15      = $entry->stdvalulcat15;
    $entry->stdvalulcat16      = $entry->stdvalulcat16;
    $entry->stdvalulcat17      = $entry->stdvalulcat17;
    $entry->stdvalulcat18      = $entry->stdvalulcat18;
    $entry->stdvalulcat19      = $entry->stdvalulcat19;
    $entry->stdvalulcat20      = $entry->stdvalulcat20;


    if ($isnewentry) {
        // Add new entry to osa_instance_qtslider table.
        $entry->id = $DB->insert_record('osa_cat_feedback_settings', $entry);
        // Add entry in osa_instance_qtype_collection to reference the qtype tables and add a sort number.
    } else {
        $entry->timemodified = $currenttime;
        $entry->id = $dbentries->id;
        // Update existing entry in osa_instance_qtslider table.
        $DB->update_record('osa_cat_feedback_settings', $entry);
    }

    // Save and relink embedded images and save attachments.
    if (!empty($entry->fbtllcat01_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat01', $editoroptions, $context, 'mod_osa', 'fbtllcat01', $entry->id);
    }
    if (!empty($entry->fbtblulcat01_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat01', $editoroptions, $context, 'mod_osa', 'fbtblulcat01', $entry->id);
    }
    if (!empty($entry->fbtulcat01_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat01', $editoroptions, $context, 'mod_osa', 'fbtulcat01', $entry->id);
    }

    if (!empty($entry->fbtllcat02_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat02', $editoroptions, $context, 'mod_osa', 'fbtllcat02', $entry->id);
    }
    if (!empty($entry->fbtblulcat02_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat02', $editoroptions, $context, 'mod_osa', 'fbtblulcat02', $entry->id);
    }
    if (!empty($entry->fbtulcat02_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat02', $editoroptions, $context, 'mod_osa', 'fbtulcat02', $entry->id);
    }

    if (!empty($entry->fbtllcat03_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat03', $editoroptions, $context, 'mod_osa', 'fbtllcat03', $entry->id);
    }
    if (!empty($entry->fbtblulcat03_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat03', $editoroptions, $context, 'mod_osa', 'fbtblulcat03', $entry->id);
    }
    if (!empty($entry->fbtulcat03_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat03', $editoroptions, $context, 'mod_osa', 'fbtulcat03', $entry->id);
    }

    if (!empty($entry->fbtllcat04_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat04', $editoroptions, $context, 'mod_osa', 'fbtllcat04', $entry->id);
    }
    if (!empty($entry->fbtblulcat04_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat04', $editoroptions, $context, 'mod_osa', 'fbtblulcat04', $entry->id);
    }
    if (!empty($entry->fbtulcat04_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat04', $editoroptions, $context, 'mod_osa', 'fbtulcat04', $entry->id);
    }

    if (!empty($entry->fbtllcat05_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat05', $editoroptions, $context, 'mod_osa', 'fbtllcat05', $entry->id);
    }
    if (!empty($entry->fbtblulcat05_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat05', $editoroptions, $context, 'mod_osa', 'fbtblulcat05', $entry->id);
    }
    if (!empty($entry->fbtulcat05_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat05', $editoroptions, $context, 'mod_osa', 'fbtulcat05', $entry->id);
    }

    if (!empty($entry->fbtllcat06_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat06', $editoroptions, $context, 'mod_osa', 'fbtllcat06', $entry->id);
    }
    if (!empty($entry->fbtblulcat06_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat06', $editoroptions, $context, 'mod_osa', 'fbtblulcat06', $entry->id);
    }
    if (!empty($entry->fbtulcat06_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat06', $editoroptions, $context, 'mod_osa', 'fbtulcat06', $entry->id);
    }

    if (!empty($entry->fbtllcat07_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat07', $editoroptions, $context, 'mod_osa', 'fbtllcat07', $entry->id);
    }
    if (!empty($entry->fbtblulcat07_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat07', $editoroptions, $context, 'mod_osa', 'fbtblulcat07', $entry->id);
    }
    if (!empty($entry->fbtulcat07_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat07', $editoroptions, $context, 'mod_osa', 'fbtulcat07', $entry->id);
    }

    if (!empty($entry->fbtllcat08_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat08', $editoroptions, $context, 'mod_osa', 'fbtllcat08', $entry->id);
    }
    if (!empty($entry->fbtblulcat08_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat08', $editoroptions, $context, 'mod_osa', 'fbtblulcat08', $entry->id);
    }
    if (!empty($entry->fbtulcat08_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat08', $editoroptions, $context, 'mod_osa', 'fbtulcat08', $entry->id);
    }

    if (!empty($entry->fbtllcat09_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat09', $editoroptions, $context, 'mod_osa', 'fbtllcat09', $entry->id);
    }
    if (!empty($entry->fbtblulcat09_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat09', $editoroptions, $context, 'mod_osa', 'fbtblulcat09', $entry->id);
    }
    if (!empty($entry->fbtulcat09_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat09', $editoroptions, $context, 'mod_osa', 'fbtulcat09', $entry->id);
    }

    if (!empty($entry->fbtllcat10_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat10', $editoroptions, $context, 'mod_osa', 'fbtllcat10', $entry->id);
    }
    if (!empty($entry->fbtblulcat10_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat10', $editoroptions, $context, 'mod_osa', 'fbtblulcat10', $entry->id);
    }
    if (!empty($entry->fbtulcat10_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat10', $editoroptions, $context, 'mod_osa', 'fbtulcat10', $entry->id);
    }

    if (!empty($entry->fbtllcat11_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat11', $editoroptions, $context, 'mod_osa', 'fbtllcat11', $entry->id);
    }
    if (!empty($entry->fbtblulcat11_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat11', $editoroptions, $context, 'mod_osa', 'fbtblulcat11', $entry->id);
    }
    if (!empty($entry->fbtulcat11_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat11', $editoroptions, $context, 'mod_osa', 'fbtulcat11', $entry->id);
    }

    if (!empty($entry->fbtllcat12_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat12', $editoroptions, $context, 'mod_osa', 'fbtllcat12', $entry->id);
    }
    if (!empty($entry->fbtblulcat12_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat12', $editoroptions, $context, 'mod_osa', 'fbtblulcat12', $entry->id);
    }
    if (!empty($entry->fbtulcat12_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat12', $editoroptions, $context, 'mod_osa', 'fbtulcat12', $entry->id);
    }

    if (!empty($entry->fbtllcat13_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat13', $editoroptions, $context, 'mod_osa', 'fbtllcat13', $entry->id);
    }
    if (!empty($entry->fbtblulcat13_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat13', $editoroptions, $context, 'mod_osa', 'fbtblulcat13', $entry->id);
    }
    if (!empty($entry->fbtulcat13_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat13', $editoroptions, $context, 'mod_osa', 'fbtulcat13', $entry->id);
    }

    if (!empty($entry->fbtllcat14_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat14', $editoroptions, $context, 'mod_osa', 'fbtllcat14', $entry->id);
    }
    if (!empty($entry->fbtblulcat14_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat14', $editoroptions, $context, 'mod_osa', 'fbtblulcat14', $entry->id);
    }
    if (!empty($entry->fbtulcat14_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat14', $editoroptions, $context, 'mod_osa', 'fbtulcat14', $entry->id);
    }

    if (!empty($entry->fbtllcat15_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat15', $editoroptions, $context, 'mod_osa', 'fbtllcat15', $entry->id);
    }
    if (!empty($entry->fbtblulcat15_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat15', $editoroptions, $context, 'mod_osa', 'fbtblulcat15', $entry->id);
    }
    if (!empty($entry->fbtulcat15_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat15', $editoroptions, $context, 'mod_osa', 'fbtulcat15', $entry->id);
    }

    if (!empty($entry->fbtllcat16_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat16', $editoroptions, $context, 'mod_osa', 'fbtllcat16', $entry->id);
    }
    if (!empty($entry->fbtblulcat16_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat16', $editoroptions, $context, 'mod_osa', 'fbtblulcat16', $entry->id);
    }
    if (!empty($entry->fbtulcat16_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat16', $editoroptions, $context, 'mod_osa', 'fbtulcat16', $entry->id);
    }

    if (!empty($entry->fbtllcat17_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat17', $editoroptions, $context, 'mod_osa', 'fbtllcat17', $entry->id);
    }
    if (!empty($entry->fbtblulcat17_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat17', $editoroptions, $context, 'mod_osa', 'fbtblulcat17', $entry->id);
    }
    if (!empty($entry->fbtulcat17_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat17', $editoroptions, $context, 'mod_osa', 'fbtulcat17', $entry->id);
    }

    if (!empty($entry->fbtllcat18_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat18', $editoroptions, $context, 'mod_osa', 'fbtllcat18', $entry->id);
    }
    if (!empty($entry->fbtblulcat18_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat18', $editoroptions, $context, 'mod_osa', 'fbtblulcat18', $entry->id);
    }
    if (!empty($entry->fbtulcat18_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat18', $editoroptions, $context, 'mod_osa', 'fbtulcat18', $entry->id);
    }

    if (!empty($entry->fbtllcat19_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat19', $editoroptions, $context, 'mod_osa', 'fbtllcat19', $entry->id);
    }
    if (!empty($entry->fbtblulcat19_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat19', $editoroptions, $context, 'mod_osa', 'fbtblulcat19', $entry->id);
    }
    if (!empty($entry->fbtulcat19_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat19', $editoroptions, $context, 'mod_osa', 'fbtulcat19', $entry->id);
    }

    if (!empty($entry->fbtllcat20_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtllcat20', $editoroptions, $context, 'mod_osa', 'fbtllcat20', $entry->id);
    }
    if (!empty($entry->fbtblulcat20_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtblulcat20', $editoroptions, $context, 'mod_osa', 'fbtblulcat20', $entry->id);
    }
    if (!empty($entry->fbtulcat20_editor)) {
        $entry = file_postupdate_standard_editor($entry, 'fbtulcat20', $editoroptions, $context, 'mod_osa', 'fbtulcat20', $entry->id);
    }


    // Store the updated values.
    $DB->update_record('osa_cat_feedback_settings', $entry);

    // Refetch complete entry.
    $entry = $DB->get_record('osa_cat_feedback_settings', array('id' => $entry->id));

return $entry;

}

/**
 * Get current attempt of current user
 *
 * @return stdClass the current attempt
 */


function osa_get_current_attempt($osa) {
    global $DB, $USER;
    // Get current attempt.
    // Get user id.
    //$currentuserid = $USER->id;
    // Get osa id.
    $osaid = $osa->id;
    // Get current attempts for every questiontype.
    $currentattemptqttextelement = $DB->get_records('osa_instance_qttextelement_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');
    $currentattemptqtlikertscale = $DB->get_records('osa_instance_qtlikertscale_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');
    $currentattemptqtcheckbox    = $DB->get_records('osa_instance_qtcheckbox_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');
    $currentattemptqtslider      = $DB->get_records('osa_instance_qtslider_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');

    $lastattemptqttextelement = end($currentattemptqttextelement)->attempt;
    $lastattemptqtlikertscale = end($currentattemptqtlikertscale)->attempt;
    $lastattemptqtcheckbox    = end($currentattemptqtcheckbox)->attempt;
    $lastattemptqtslider      = end($currentattemptqtslider)->attempt;

    $attemptarray = array((int)$lastattemptqttextelement, (int)$lastattemptqtlikertscale, (int)$lastattemptqtcheckbox, (int)$lastattemptqtslider);
    // Sort array in descending order.
    $attemptarraysorted = rsort($attemptarray);
    // Set current attempt.
    $currentattempt = $attemptarray[0];
    return $currentattempt;
}


/**
 * Get current attempt timecreated of current user
 *
 * @return stdClass the current attempt
 */


function osa_get_current_attempt_timecreated($osa) {
    global $DB, $USER;
    // Get current attempt.
    // Get user id.
    //$currentuserid = $USER->id;
    // Get osa id.
    $osaid = $osa->id;
    // Get current attempts for every questiontype.
    $currentattemptqttextelement = $DB->get_records('osa_instance_qttextelement_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'timecreated ASC');
    $currentattemptqtlikertscale = $DB->get_records('osa_instance_qtlikertscale_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'timecreated ASC');
    $currentattemptqtcheckbox    = $DB->get_records('osa_instance_qtcheckbox_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'timecreated ASC');
    $currentattemptqtslider      = $DB->get_records('osa_instance_qtslider_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'timecreated ASC');

    $lastattemptqttextelement = end($currentattemptqttextelement)->timecreated;
    $lastattemptqtlikertscale = end($currentattemptqtlikertscale)->timecreated;
    $lastattemptqtcheckbox    = end($currentattemptqtcheckbox)->timecreated;
    $lastattemptqtslider      = end($currentattemptqtslider)->timecreated;

    $attemptarray = array((int)$lastattemptqttextelement, (int)$lastattemptqtlikertscale, (int)$lastattemptqtcheckbox, (int)$lastattemptqtslider);
    // Sort array in descending order.
    $attemptarraysorted = rsort($attemptarray);
    // Set current attempt.
    $currentattempt = $attemptarray[0];
    return $currentattempt;
}





/**
 * Returns part of link to edit form according to question type
 *
 * @param  stdClass $qtype question type
 * @param stdClass $id id of entry in database
 * @return stdClass the part of the link to be composed in view.php
 */

function formlink($qtype, $cm, $id) {
    if ($qtype == 'checkbox') {
        return 'edit_questiontype_checkbox.php?cmid=' . $cm->id . '&checkbox=' . $id;
    }
    else if ($qtype == 'likert') {
        return 'edit_questiontype_likert_scale.php?cmid=' . $cm->id . '&likert=' . $id;
    }
    else if ($qtype == 'slider') {
        return 'edit_questiontype_slider.php?cmid=' . $cm->id . '&slider=' . $id;
    }
    else if ($qtype == 'text') {
        return 'edit_questiontype_textelement.php?cmid=' . $cm->id . '&textelement=' . $id;
    }
}

/**
 * Returns part of link to delete form and data in the DB according to question type
 *
 * @param  stdClass $qtype question type
 * @param stdClass $id id of entry in database
 * @return stdClass the part of the link to be composed in view.php
 */

function formlink_delete($qtype, $cm, $id) {
    if ($qtype == 'checkbox') {
        return 'delete_questiontype_checkbox.php?cmid=' . $cm->id . '&checkbox=' . $id;
    }
    else if ($qtype == 'likert') {
        return 'delete_questiontype_likert_scale.php?cmid=' . $cm->id . '&likert=' . $id;
    }
    else if ($qtype == 'slider') {
        return 'delete_questiontype_slider.php?cmid=' . $cm->id . '&slider=' . $id;
    }
    else if ($qtype == 'text') {
        return 'delete_questiontype_textelement.php?cmid=' . $cm->id . '&textelement=' . $id;
    }
}

/**
 * Returns part of link to move up form data in the DB according to question type
 *
 * @param  stdClass $qtype question type
 * @param stdClass $id id of entry in database
 * @return stdClass the part of the link to be composed in view.php
 */

function formlink_move_up($qtype, $cm, $id) {
    if ($qtype == 'checkbox') {
        return 'edit_questiontype_move_up.php?cmid=' . $cm->id . '&checkbox=' . $id;
    }
    else if ($qtype == 'likert') {
        return 'edit_questiontype_move_up.php?cmid=' . $cm->id . '&likert=' . $id;
    }
    else if ($qtype == 'slider') {
        return 'edit_questiontype_move_up.php?cmid=' . $cm->id . '&slider=' . $id;
    }
    else if ($qtype == 'text') {
        return 'edit_questiontype_move_up.php?cmid=' . $cm->id . '&textelement=' . $id;
    }
}

/**
 * Returns part of link to move down form data in the DB according to question type
 *
 * @param  stdClass $qtype question type
 * @param stdClass $id id of entry in database
 * @return stdClass the part of the link to be composed in view.php
 */

function formlink_move_down($qtype, $cm, $id) {
    if ($qtype == 'checkbox') {
        return 'edit_questiontype_move_down.php?cmid=' . $cm->id . '&checkbox=' . $id;
    }
    else if ($qtype == 'likert') {
        return 'edit_questiontype_move_down.php?cmid=' . $cm->id . '&likert=' . $id;
    }
    else if ($qtype == 'slider') {
        return 'edit_questiontype_move_down.php?cmid=' . $cm->id . '&slider=' . $id;
    }
    else if ($qtype == 'text') {
        return 'edit_questiontype_move_down.php?cmid=' . $cm->id . '&textelement=' . $id;
    }
}


//function get_data_from_question_db($records, $cm, $qtype, $dbname, $dbfieldname, $filearea, $dbnameformat) {
function get_data_from_question_db($record, $cm, $qtype, $filearea) {
    global $DB, $CFG;

        // Set context.
        $context = context_module::instance($cm->id);

        // Get entryid of DB.
        $entryid = $record->id;

        // Set questiontype. At the moment checkbox, likert, slider and text are available.
        $qtype = $qtype;

        // Set questiontype, cm and id of db entry. Function returns correct edit link.
        $formlink_edit = formlink($qtype, $cm, $entryid);

        // Set questiontype, cm and id of db entry. Function returns correct delete link.
        $formlink_delete = formlink_delete($qtype, $cm, $entryid);

        // Set questiontype, cm and id of db entry. Function returns correct move up and move down link.
        $formlink_move_up = formlink_move_up($qtype, $cm, $entryid);
        $formlink_move_down = formlink_move_down($qtype, $cm, $entryid);


        // Set options and rewrite pluginfile urls to display and format it.
        $options = array('noclean' => true, 'para' => false, 'filter' => $filter, 'context' => $context, 'overflowdiv' => true);


        if ($qtype == 'checkbox') {
            $recordvalue01 = file_rewrite_pluginfile_urls($record->cbtextdesc01, 'pluginfile.php', $context->id, 'mod_osa', $filearea[0], null);
            $recordvalue01 = trim(format_text($recordvalue01, $osa_instance_qtcheckbox->cbtextdesc01format, $options, null));
            $recordvalue02 = file_rewrite_pluginfile_urls($record->cbtextdesc02, 'pluginfile.php', $context->id, 'mod_osa', $filearea[1], null);
            $recordvalue02 = trim(format_text($recordvalue02, $osa_instance_qtcheckbox->cbtextdesc02format, $options, null));
            $recordvalue03 = file_rewrite_pluginfile_urls($record->cbtextdesc03, 'pluginfile.php', $context->id, 'mod_osa', $filearea[2], null);
            $recordvalue03 = trim(format_text($recordvalue03, $osa_instance_qtcheckbox->cbtextdesc03format, $options, null));
            $recordvalue04 = file_rewrite_pluginfile_urls($record->cbtextdesc04, 'pluginfile.php', $context->id, 'mod_osa', $filearea[3], null);
            $recordvalue04 = trim(format_text($recordvalue04, $osa_instance_qtcheckbox->cbtextdesc04format, $options, null));
            $recordvalue05 = file_rewrite_pluginfile_urls($record->cbtextdesc05, 'pluginfile.php', $context->id, 'mod_osa', $filearea[4], null);
            $recordvalue05 = trim(format_text($recordvalue05, $osa_instance_qtcheckbox->cbtextdesc05format, $options, null));
            $recordvalue06 = file_rewrite_pluginfile_urls($record->cbtextdesc06, 'pluginfile.php', $context->id, 'mod_osa', $filearea[5], null);
            $recordvalue06 = trim(format_text($recordvalue06, $osa_instance_qtcheckbox->cbtextdesc06format, $options, null));
            $recordvalue07 = file_rewrite_pluginfile_urls($record->cbtextdesc07, 'pluginfile.php', $context->id, 'mod_osa', $filearea[6], null);
            $recordvalue07 = trim(format_text($recordvalue07, $osa_instance_qtcheckbox->cbtextdesc07format, $options, null));
            $recordvalue08 = file_rewrite_pluginfile_urls($record->cbtextdesc08, 'pluginfile.php', $context->id, 'mod_osa', $filearea[7], null);
            $recordvalue08 = trim(format_text($recordvalue08, $osa_instance_qtcheckbox->cbtextdesc08format, $options, null));
            $recordvalue09 = file_rewrite_pluginfile_urls($record->cbtextdesc09, 'pluginfile.php', $context->id, 'mod_osa', $filearea[8], null);
            $recordvalue09 = trim(format_text($recordvalue09, $osa_instance_qtcheckbox->cbtextdesc09format, $options, null));
            $recordvalue10 = file_rewrite_pluginfile_urls($record->cbtextdesc10, 'pluginfile.php', $context->id, 'mod_osa', $filearea[9], null);
            $recordvalue10 = trim(format_text($recordvalue10, $osa_instance_qtcheckbox->cbtextdesc10format, $options, null));
            // Save each recordvalue in recordvalue array to return to display later in view.php.
            $recordvalue = array(
                $recordvalue01,
                $recordvalue02,
                $recordvalue03,
                $recordvalue04,
                $recordvalue05,
                $recordvalue06,
                $recordvalue07,
                $recordvalue08,
                $recordvalue09,
                $recordvalue10
            );
        // Last param originally null.
//var_dump($recordvalue);
//die;
//            $recordvalue = trim(format_text($recordvalue, $osa_instance_qtcheckbox->cbtextdesc01format, $options, null));
        }
        else if ($qtype == 'likert') {
//var_dump($record->lsimage01);
            $recordvalue01 = file_rewrite_pluginfile_urls($record->lstextdesceditor01, 'pluginfile.php', $context->id, 'mod_osa', $filearea[0], null);
            $recordvalue01 = trim(format_text($recordvalue01, $osa_instance_qtlikertscale->lstextdesceditor01format, $options, null));
//            $recordvalue01file = osa_get_image_link($context->id, $filearea[0], '0');
            $recordvalue02 = file_rewrite_pluginfile_urls($record->lstextdesceditor02, 'pluginfile.php', $context->id, 'mod_osa', $filearea[1], null);
            $recordvalue02 = trim(format_text($recordvalue02, $osa_instance_qtlikertscale->lstextdesceditor02format, $options, null));
            $recordvalue03 = file_rewrite_pluginfile_urls($record->lstextdesceditor03, 'pluginfile.php', $context->id, 'mod_osa', $filearea[2], null);
            $recordvalue03 = trim(format_text($recordvalue03, $osa_instance_qtlikertscale->lstextdesceditor03format, $options, null));
            $recordvalue04 = file_rewrite_pluginfile_urls($record->lstextdesceditor04, 'pluginfile.php', $context->id, 'mod_osa', $filearea[3], null);
            $recordvalue04 = trim(format_text($recordvalue04, $osa_instance_qtlikertscale->lstextdesceditor04format, $options, null));
            $recordvalue05 = file_rewrite_pluginfile_urls($record->lstextdesceditor05, 'pluginfile.php', $context->id, 'mod_osa', $filearea[4], null);
            $recordvalue05 = trim(format_text($recordvalue05, $osa_instance_qtlikertscale->lstextdesceditor05format, $options, null));
            $recordvalue06 = file_rewrite_pluginfile_urls($record->lstextdesceditor06, 'pluginfile.php', $context->id, 'mod_osa', $filearea[5], null);
            $recordvalue06 = trim(format_text($recordvalue06, $osa_instance_qtlikertscale->lstextdesceditor06format, $options, null));
            $recordvalue07 = file_rewrite_pluginfile_urls($record->lstextdesceditor07, 'pluginfile.php', $context->id, 'mod_osa', $filearea[6], null);
            $recordvalue07 = trim(format_text($recordvalue07, $osa_instance_qtlikertscale->lstextdesceditor07format, $options, null));
            // Save each recordvalue in recordvalue array to return to display later in view.php.
            $recordvalue = array(
//var_dump("recordvalue01file"),
//                $recordvalue01file,
                $recordvalue01,
                $recordvalue02,
                $recordvalue03,
                $recordvalue04,
                $recordvalue05,
                $recordvalue06,
                $recordvalue07,
            );
//var_dump($recordvalue);
//die;
        }
        else if ($qtype == 'slider') {
            $recordvalue = file_rewrite_pluginfile_urls($record->ssdesceditor01, 'pluginfile.php', $context->id, 'mod_osa', $filearea, null);
            $recordvalue = trim(format_text($recordvalue, $osa_instance_qtslider->ssdesceditor01format, $options, null));
        }
        else if ($qtype == 'text') {
            $recordvalue = file_rewrite_pluginfile_urls($record->textelementeditor, 'pluginfile.php', $context->id, 'mod_osa', $filearea, null);
            $recordvalue = trim(format_text($recordvalue, $osa_instance_qttextelement->textelementeditorformat, $options, null));
        }


    // Return values from each run. These contain the recordvalue, the $recordvalue, the $formlink_edit and $formlink_delete values as an array.
    $values = array($recordvalue, $formlink_edit, $formlink_delete, $formlink_move_up, $formlink_move_down);

    return $values;

// Reference to the last object (record) in the loop is removed otherwise it stays and can be used outside of loop.
//    unset($values);
//    unset($valuearray);
//    unset($record);
//    }
}

function osa_save_answers($osa, $formdata, $course, $context) {
    global $DB, $USER;

    $answers = array();
    $addedcollection = array();

$currentattempt = osa_get_current_attempt($osa);
$setcurrentattempt = $currentattempt+1;

//var_dump("<br>\n<br>\nformdata<br>\n");
//var_dump($formdata);

    // Get basic info to write to db.
    $currenttime = time();

$keysarrayqtcb = array();

    // Remove unneccessary text from element names generated by template to get qtype and id of each entry in database.
    foreach ($formdata as $key => $val) {
        if ($key != "userid" && $key != "id") {
            $key = explode('-', $key);
            $keyqtype = $key[1];
            $keyid = $key[2];
//            }
//            $key = clean_param_array($key, PARAM_ALPHANUM);
//            $key = clean_param($key, PARAM_ALPHANUM);
        // Save data to database.
        // Possible values for keyqtype: text, likert, checkbox, slider.
        if ($keyqtype == 'text') {
            $dbnameanswertable = 'osa_instance_qttextelement_a';
            $foreignkey = 'fk_osa_instance_qttextelement';
            $newentry->textelementeditor = $val;
        }
//        else if ($keyqtype == 'checkbox') {
//            echo "checkbox is processed later";
//        }
        else if ($keyqtype == 'likert') {
            // Reset lsitem entries.
            $newentry->lsitem01 = 0;
            $newentry->lsitem02 = 0;
            $newentry->lsitem03 = 0;
            $newentry->lsitem04 = 0;
            $newentry->lsitem05 = 0;
            $newentry->lsitem06 = 0;
            $newentry->lsitem07 = 0;
            $dbnameanswertable = 'osa_instance_qtlikertscale_a';
            $foreignkey = 'fk_osa_instance_qtlikertscale';
            // Convert string (slidervalue) to int.
            $val = (int)$val;
            // 0 = not selected
            // 1 = selected
            if ($val == 1) {
                $newentry->lsitem01 = 1;
            }
            else if ($val == 2) {
                $newentry->lsitem02 = 1;
            }
            else if ($val == 3) {
                $newentry->lsitem03 = 1;
            }
            else if ($val == 4) {
                $newentry->lsitem04 = 1;
            }
            else if ($val == 5) {
                $newentry->lsitem05 = 1;
            }
            else if ($val == 6) {
                $newentry->lsitem06 = 1;
            }
            else if ($val == 7) {
                $newentry->lsitem07 = 1;
            }
        }
        else if ($keyqtype == 'slider') {
            $dbnameanswertable = 'osa_instance_qtslider_a';
            $foreignkey = 'fk_osa_instance_qtslider';
            // Convert string (slidervalue) to int.
            $val = (int)$val;
            $newentry->slider = $val;
        }

        if ($keyqtype != 'checkbox') {

          // Prepare data to be saved.
        $newentry->fk_user = $USER->id;
        $newentry->$foreignkey = $keyid;
        $newentry->fk_cmid = $osa->id;
        $newentry->timecreated = $currenttime;
        $newentry->attempt = $setcurrentattempt;
//var_dump("<br><br>newentry<br>");
//var_dump($newentry);
        // Write to database.
        $newentry->id = $DB->insert_record($dbnameanswertable, $newentry);
//var_dump("<br>\nnew entry id:", $newentry->id);
        }

        }
    }

// Begin save checkbox

//var_dump("<br>\n !!! begin save checkbox !!! <br>\n");

// Set round number.
$rno = 0;


//    // Remove unneccessary text from element names generated by template to get qtype and id of each entry in database.
    foreach ($formdata as $key => $val) {
        if ($key != "userid" || $key != "id") {
            $key = explode('-', $key);
            $keyqtype = $key[1];
            $keyid = $key[2];
//var_dump("keyofeachrun", $key);
        }
//
//
            if ($keyqtype == 'checkbox') {
            $dbnameanswertable = 'osa_instance_qtcheckbox_a';
            $foreignkey = 'fk_osa_instance_qtcheckbox';
            // Convert string (checkboxvalue) to int.
            $val = (int)$val;
//var_dump("<br>\nvalue checkbox from template<br>\n:", $val, "<br>\n");
            // 0 = not selected
            // 1 = selected

// Get all $values (checkbox instances)
$values[] = $key[2];
//var_dump("<br>\nkeys:<br>\n", $values);

// Get all items which belong to each individual keys

// Remove duplicate entries
//var_dump("<br>\nkeys after loop:<br>\n", $values);
$values = array_unique($values);
// Remove empty elements.
$values = array_filter($values);
// Reset array keys.
$values = array_values($values);
//var_dump("<br>\nkeys duplicates removed after loop:<br>\n", $values);

// Get round number.
$rno = $rno+1;
//var_dump("<br>\nrno:", $rno);




        }
}
    // Remove unneccessary text from element names generated by template to get qtype and id of each entry in database.

// Set run round
$run = 0;

foreach ($values as $valueinstance) {
$run = $run+1;
    foreach ($formdata as $key => $val) {
        if ($key != "userid" || $key != "id") {
            $key = explode('-', $key);
            $keyqtype = $key[1];
            $keyid = $key[2];
        }
//var_dump("<br>\nkey:", $key, "<br>\n");
//var_dump("<br>\nkeyid:", $keyid, "<br>\n");
//var_dump("<br>\nkeyqtype:", $keyqtype, "<br>\n");

            if ($keyqtype == 'checkbox' && $valueinstance == $keyid) {
            $dbnameanswertable = 'osa_instance_qtcheckbox_a';
            $foreignkey = 'fk_osa_instance_qtcheckbox';
            // Convert string (checkboxvalue) to int.
            $val = (int)$val;
            $dynamicvarname = "valcollection$keyid";
            $$dynamicvarname[] = $val;
            // Combine var name.
            $key_val[] = [$dynamicvarname => $$dynamicvarname];
            $valc = array($val);
            $dynamicvarnamec = array($dynamicvarname);
            $combined[] = array_combine($dynamicvarnamec, $valc);

            // Add key collection for saving saving fk_osa_instance_qtcheckbox value correctly to database.
            $keysarrayqtcb[] = $keyid;
//            var_dump("<br>\nif checkbox keysarrayqtbc:<br>\n", $keysarrayqtcb);
}

//foreach ($keysarrayqtcb as $keysarrayqtcbs) {
//            $keysarrayqtcb = array_unique($keysarrayqtcb, SORT_NUMERIC);
//            $keysarrayqtcb = array_unique($keysarrayqtcb);
//            $keysarrayqtcb = array_filter($keysarrayqtcb);
            $keysarrayqtcb = array_values($keysarrayqtcb);
            $keysarrayqtcb = array_unique($keysarrayqtcb);
//            $keysarrayqtcb = array_keys($keysarrayqtcb);
//            var_dump("<br>\nkeysarrayqtbc:<br>\n", $keysarrayqtcbs);
//            var_dump("<br>\nkeysarrayqtbc:<br>\n", $keysarrayqtcb);
//}



//var_dump("<br>\ncombined:", $combined);

$collectionreducelater = array();

//var_dump("<br>\n<br>\nlist entries", $combined);
foreach ($combined as $singlekey => $singlevalue) {
//var_dump("<br>\narray values:", array_values($combined));
//var_dump("<br>\n<br>\nsingle key entry", $singlekey, "<br>\n");
//var_dump("<br>\n<br>\nsingle val entry", $singlevalue, "<br>\n");
//var_dump("<br>\n<br>\nsingle key", array_keys($singlevalue), "<br>\n");
//var_dump("<br>\n<br>\nsingle val", array_values($singlevalue), "<br>\n");

foreach ($singlevalue as $singleakey => $singleavalue) {
//var_dump("<br>\n<br>\nsingle a key entry", $singleakey, "<br>\n");
//var_dump("<br>\n<br>\nsingle a value entry", $singleavalue, "<br>\n");
array_push($collectionreducelater, $singleakey, $singleavalue);
}
//var_dump("<br>\n<br>\ncollectionreducelater:", $collectionreducelater);

$singlekeys[] = $singlevalue;
//var_dump("<br>\n<br>\nsinglekeys:", $singlekeys, "<br>\n");
}

// Flatten array.
            }
        }
//var_dump("<br>\n<br>\ncollectionreducelaterend:", $collectionreducelater);

// Get length of $collectionreducelater.
$lengtharray = sizeof($collectionreducelater);
//var_dump("<br>\nlength of array<br>\n", $lengtharray, "<br>\n<br>\n");

// Get valcollection names.
foreach ($collectionreducelater as $value) {
    if (is_string($value)) {
        var_dump("<br>\nnotintval:", $value);
        $valcollections[] = $value;
    }
}
//var_dump("<br>\n<br>\nvalcollections:", $valcollections);
// Remove duplicate entries in collection names.
$valcollections = array_unique($valcollections);
//var_dump("<br>\n<br>\nvalcollections:", $valcollections);
// Reset keys of array.
$valcollections = array_values($valcollections);
//var_dump("<br>\n<br>\nvalcollections:", $valcollections);
// Get length of $valcollections.
$lengtharrayvalcollections = sizeof($valcollections);
//var_dump("<br>\n<br>\nlength of array valcollections:", $lengtharrayvalcollections);




$resultArray = array();

//for ($x = 0; $x <= $lengtharrayvalcollections; $x++) {
//for ($x = 0; $x <= $lengtharrayvalcollections; $x++) {
for ($x = 0; $x <= $lengtharrayvalcollections; $x++) {
//var_dump($lengtharrayvalcollections);
    $valcollection = $valcollections[$x];


//var_dump("<br>\n<br>\ncollectionreducelater:", $collectionreducelater);
for ($i = 0; $i <= sizeof($collectionreducelater); $i++) {
//    var_dump("<br>\n<br>\nvalcollection before if:", $valcollection);

$keyid = $keysarrayqtcb[$x];

//var_dump("keyid in for loop:", $keyid);

//    if ($collectionreducelater[$i] === "valcollection1") {
    if ($collectionreducelater[$i] === $valcollection) {

//var_dump("<br>\n<br>\ncollectionreducelater[i]:", $collectionreducelater[$i]);

        $resultArray[] = $collectionreducelater[$i + 1];
//        var_dump("<br>\nresultarray:", $resultArray);
        $resultarrayunique = array_unique($resultArray);
//        var_dump("<br>\nresultarray unique:", $resultarrayunique);
    }
}
if (isset($valcollection)) {
        if (array_search("1", $resultarrayunique) !== false) {
        $newentry->cbitem01 = 1;
        }
        if (array_search("2", $resultarrayunique) !== false) {
        $newentry->cbitem02 = 1;
        }
        if (array_search("3", $resultarrayunique) !== false) {
        $newentry->cbitem03 = 1;
        }
        if (array_search("4", $resultarrayunique) !== false) {
        $newentry->cbitem04 = 1;
        }
        if (array_search("5", $resultarrayunique) !== false) {
        $newentry->cbitem05 = 1;
        }
        if (array_search("6", $resultarrayunique) !== false) {
        $newentry->cbitem06 = 1;
        }
        if (array_search("7", $resultarrayunique) !== false) {
        $newentry->cbitem07 = 1;
        }
        if (array_search("8", $resultarrayunique) !== false) {
        $newentry->cbitem08 = 1;
        }
        if (array_search("9", $resultarrayunique) !== false) {
        $newentry->cbitem09 = 1;
        }
        if (array_search("10", $resultarrayunique) !== false) {
        $newentry->cbitem10 = 1;
        }
        var_dump("<br>\narr search true:", $newentry, "<br>\n");

          // Prepare data to be saved.
        $newentry->fk_user = $USER->id;
        $newentry->$foreignkey = $keyid;
        $newentry->fk_cmid = $osa->id;
        $newentry->timecreated = $currenttime;
        $newentry->attempt = $setcurrentattempt;
//var_dump("<br><br>newentry<br>", $newentry);
        // Write to database.
        $newentry->id = $DB->insert_record($dbnameanswertable, $newentry);
}

//var_dump($keyid);
unset($newentry);
unset($resultArray);
unset($resultarrayunique);
}

//var_dump("<br>\n !!! end save checkbox !!! <br>\n");

// End save checkbox

}


/**
 * Returns likert scale boxplot values
 *
 * @param  stdClass $data from likert scale answers
 * @param stdClass $madeattempts madeattempts of entry in database
 * @param stdClass $lsdatacurrentuser current attempt
 * @return stdClass sorted data
 */

function osa_calculate_answer_data_for_boxplot($data, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval) {

//var_dump("<br>\n<br>\ndata inside function:", $data);

global $DB, $USER;

// Mean value likert scale current attempt / Mittelwert Likert Skala aktueller Versuch.
$meanvaluelikertscale = array();

    foreach ($likertscaledatacurrentusercurrentattempt as $lsdcuca) {

        if ($lsdcuca->lsitem01 == 1) {
            $lsitemvalue = 1;
        }
        if ($lsdcuca->lsitem02 == 1) {
            $lsitemvalue = 2;
        }
        if ($lsdcuca->lsitem03 == 1) {
            $lsitemvalue = 3;
        }
        if ($lsdcuca->lsitem04 == 1) {
            $lsitemvalue = 4;
        }
        if ($lsdcuca->lsitem05 == 1) {
            $lsitemvalue = 5;
        }
        if ($lsdcuca->lsitem06 == 1) {
            $lsitemvalue = 6;
        }
        if ($lsdcuca->lsitem07 == 1) {
            $lsitemvalue = 7;
        }
        $meanvaluelikertscalesum = $meanvaluelikertscalesum + $lsitemvalue;
//var_dump("meanvaluelikertscalesum", $meanvaluelikertscalesum);
    }

    foreach ($data as $record) {

        if ($record->fk_tqtls != 0) {
            // Get record for likert scale.
            $record = $DB->get_record('osa_instance_qtlikertscale', array('id' => $record->fk_tqtls));
            $recordid = $record->id;
            $recorduseranswer = $DB->get_record('osa_instance_qtlikertscale_a', array('fk_user' => $USER->id, 'fk_osa_instance_qtlikertscale' => $recordid, 'attempt' => $madeattempts));
    //var_dump("<br>\n<br>\nrecorduseranswer", $recorduseranswer, "<br>\n<br>\n");
            if ($recorduseranswer->lsitem01 == 1) {
                $recorduseranswervalue = 1;
            }
            else if ($recorduseranswer->lsitem02 == 1) {
                $recorduseranswervalue = 2;
            }
            else if ($recorduseranswer->lsitem03 == 1) {
                $recorduseranswervalue = 3;
            }
            else if ($recorduseranswer->lsitem04 == 1) {
                $recorduseranswervalue = 4;
            }
            else if ($recorduseranswer->lsitem05 == 1) {
                $recorduseranswervalue = 5;
            }
            else if ($recorduseranswer->lsitem06 == 1) {
                $recorduseranswervalue = 6;
            }
            else if ($recorduseranswer->lsitem07 == 1) {
                $recorduseranswervalue = 7;
            }
            // Added else to set not set ls items to null.
            else {
                $recorduseranswervalue = null;
            }
        }

    $recordscat01values[] = $recorduseranswervalue;

    // Sort data in ascending order.
    sort($recordscat01values);

//var_dump("<br>\n<br>\nrecordscat01values", $recordscat01values, "<br>\n<br>\n");
//var_dump("<br>\n<br>\nrecordscat01values", array_values($recordscat01values), "<br>\n<br>\n");

    }



    $data01 = $recordscat01values;
    $data01 = array_filter($data01);
    $data01 = array_values($data01);

//    var_dump("<br>\ndata01sorted", $data01);

//    $data01json = json_encode($data01);
//    var_dump("<br>\n<br>\ndata01<br>\n", $data01);
//    var_dump("<br>\n<br>\ndata01json<br>\n", $data01json);


    $data01 = array_filter($data01);
    // Get length of array: Not counting multidimensional array.
    $lengthofarray01 = sizeof($data01, 0);
//    var_dump("<br>\nlength of array:", $lengthofarray01, "<br>\n");
    $moduloloa01 = $lengthofarray01 % 2;
    //$moduloloa01 = $lengthofarray01 % 2;
//    var_dump($moduloloa01);
    // Calculate median even numbered data set.
    if ($moduloloa01 == 0) {
        $valpos01 = ($lengthofarray01 / 2)-1;
        $valpos02 = $valpos01+1;

//        var_dump("<br>\nvalpos01:", $valpos01, "<br>\n<br>\n");
//        var_dump("<br>\nvalpos02:", $valpos02, "<br>\n<br>\n");

        $val01 = $data01[$valpos01];
        $val02 = $data01[$valpos02];

//    var_dump("<br>\nval01:", $val01, "<br>\n<br>\n");
//    var_dump("<br>\nval02:", $val02, "<br>\n<br>\n");

    $median01 = ($val01+$val02)/2;
//    var_dump("<br>\n<br>\nmedian even number of values<br>\n", $median01, "<br>\n");

    }
    // Calculate median not even numbered data set.
    if ($moduloloa01 != 0) {
        $valpos = ($lengthofarray01 / 2)-0.5;
        $val = $data01[$valpos];
        $median01 = $val;
//    var_dump("<br>\n<br>\nmedian odd number of values<br>\n", $median01, "<br>\n");

    }


    // Calculate q1 and q3 (median of the first half q1 and second half q3 of the data set) even numbered data set.
    if ($moduloloa01 == 0) {
        $valpos00 = 0;
        $valpos01 = ($lengthofarray01 / 2)-1;
        $valpos02 = $valpos01+1;
        $valpos03 = $lengthofarray-1;
//        $valpos03 = $lengthofarray01-1;
//var_dump("<br>\nvalpos03:", $valpos03);
// Check valpos03 !!!!!!!!!!!!
//var_dump("<br>\n!!!!!!!!!!!!!!!! check valpos03 !!!!!!!!!!!!!!!!<br>\n");

        $valposq01 = ($valpos01-$valpos00)/2;
        $medianq01 = $data01[$valposq01];
        $valposq03 = ($valpos02+$valpos01)-1;
        $medianq03 = $data01[$valposq03];
//    var_dump("<br>\n<br>\nq1 and q3 even number of values<br>\n", "q1", $medianq01, "q3", $medianq03, "<br>\n");

        $iqr01 = $medianq03-$medianq01;
//    var_dump("<br>\n<br>\niqr even number of values<br>\n", $iqr01, "<br>\n");


    }

    // Calculate q1 and q3 (median of the first half q1 and second half q3 of the data set) odd numbered data set.

    if ($moduloloa01 != 0) {
        $valpos00 = 0;
        $valpos01 = ($lengthofarray01 / 2)-1.5;
        $valpos02 = $valpos01+2;
        $valpos03 = $lengthofarray-1;
// Check valpos03 !!!!!!!!!!!!
//var_dump("<br>\n!!!!!!!!!!!!!!!! check valpos03 !!!!!!!!!!!!!!!!<br>\n");
//        $valpos03 = $lengthofarray01-1;
//var_dump("<br>\nvalpos03:", $valpos03);

        $valposq01 = ($valpos01-$valpos00)/2;
        $medianq01 = $data01[$valposq01];
        $valposq03 = ($valpos02+$valpos01)-1;
        $medianq03 = $data01[$valposq03];
//    var_dump("<br>\n<br>\nq1 and q3 odd number of values<br>\n", "q1", $medianq01, "q3", $medianq03, "<br>\n");

        $iqr01 = $medianq03-$medianq01;
//    var_dump("<br>\n<br>\niqr even odd of values<br>\n", $iqr01, "<br>\n");

    }


//    var_dump("<br>\n<br>\nvalpos03<br>\n");
    $valpos03 = $lengthofarray01-1;
//    var_dump($lengthofarray01);
//    var_dump($valpos03);

    $min01 = $data01[0];
    $max01 = $data01[$valpos03];

//    var_dump("<br>\n<br>\nmin and max values<br>\n", "min", $min01, "max", $max01, "<br>\n");

// Check value of category. If category value is 0 then set visibility to hidden.

if ($setstandardval != 0) {
    $setstandardvalvisibility01 = visible;
} else {
    $setstandardvalvisibility01 = hidden;

}

$setstandardval01 = $setstandardval;


return array($median01, $medianq01, $medianq03, $iqr01, $min01, $max01, $setstandardval01, $setstandardvalvisibility01);



}


