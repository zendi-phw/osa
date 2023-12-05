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
 * The mod_osa edit_cat_feedback_settings form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/classes/form/edit_cat_feedback_settings_class.php');

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.
$recordsfeedback = $DB->get_records('osa_cat_feedback_settings', array('fk_cmid' => $cm->id));

$records = $recordsfeedback;

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/edit_cat_feedback_settings.php', ['cmid' => $cmid]);

$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitleeditcatfeedbacksettings', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);


// Get current entries.
$entry = $DB->get_record('osa_cat_feedback_settings', ['fk_cmid' => $cm->id]);

// Get editoroptions from lib.php.
$editoroptions = osa_get_editor_options_edit_cat_feedback_settings($context);

// Prepare editor content using function file_prepare_standard_editor() function.
$entry = file_prepare_standard_editor($entry, 'fbtllcat01', $editoroptions, $context, 'mod_osa', 'fbtllcat01', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat01', $editoroptions, $context, 'mod_osa', 'fbtblulcat01', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat01', $editoroptions, $context, 'mod_osa', 'fbtulcat01', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat02', $editoroptions, $context, 'mod_osa', 'fbtllcat02', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat02', $editoroptions, $context, 'mod_osa', 'fbtblulcat02', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat02', $editoroptions, $context, 'mod_osa', 'fbtulcat02', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat03', $editoroptions, $context, 'mod_osa', 'fbtllcat03', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat03', $editoroptions, $context, 'mod_osa', 'fbtblulcat03', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat03', $editoroptions, $context, 'mod_osa', 'fbtulcat03', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat04', $editoroptions, $context, 'mod_osa', 'fbtllcat04', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat04', $editoroptions, $context, 'mod_osa', 'fbtblulcat04', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat04', $editoroptions, $context, 'mod_osa', 'fbtulcat04', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat05', $editoroptions, $context, 'mod_osa', 'fbtllcat05', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat05', $editoroptions, $context, 'mod_osa', 'fbtblulcat05', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat05', $editoroptions, $context, 'mod_osa', 'fbtulcat05', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat06', $editoroptions, $context, 'mod_osa', 'fbtllcat06', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat06', $editoroptions, $context, 'mod_osa', 'fbtblulcat06', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat06', $editoroptions, $context, 'mod_osa', 'fbtulcat06', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat07', $editoroptions, $context, 'mod_osa', 'fbtllcat07', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat07', $editoroptions, $context, 'mod_osa', 'fbtblulcat07', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat07', $editoroptions, $context, 'mod_osa', 'fbtulcat07', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat08', $editoroptions, $context, 'mod_osa', 'fbtllcat08', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat08', $editoroptions, $context, 'mod_osa', 'fbtblulcat08', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat08', $editoroptions, $context, 'mod_osa', 'fbtulcat08', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat09', $editoroptions, $context, 'mod_osa', 'fbtllcat09', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat09', $editoroptions, $context, 'mod_osa', 'fbtblulcat09', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat09', $editoroptions, $context, 'mod_osa', 'fbtulcat09', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat10', $editoroptions, $context, 'mod_osa', 'fbtllcat10', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat10', $editoroptions, $context, 'mod_osa', 'fbtblulcat10', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat10', $editoroptions, $context, 'mod_osa', 'fbtulcat10', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat11', $editoroptions, $context, 'mod_osa', 'fbtllcat11', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat11', $editoroptions, $context, 'mod_osa', 'fbtblulcat11', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat11', $editoroptions, $context, 'mod_osa', 'fbtulcat11', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat12', $editoroptions, $context, 'mod_osa', 'fbtllcat12', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat12', $editoroptions, $context, 'mod_osa', 'fbtblulcat12', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat12', $editoroptions, $context, 'mod_osa', 'fbtulcat12', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat13', $editoroptions, $context, 'mod_osa', 'fbtllcat13', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat13', $editoroptions, $context, 'mod_osa', 'fbtblulcat13', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat13', $editoroptions, $context, 'mod_osa', 'fbtulcat13', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat14', $editoroptions, $context, 'mod_osa', 'fbtllcat14', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat14', $editoroptions, $context, 'mod_osa', 'fbtblulcat14', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat14', $editoroptions, $context, 'mod_osa', 'fbtulcat14', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat15', $editoroptions, $context, 'mod_osa', 'fbtllcat15', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat15', $editoroptions, $context, 'mod_osa', 'fbtblulcat15', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat15', $editoroptions, $context, 'mod_osa', 'fbtulcat15', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat16', $editoroptions, $context, 'mod_osa', 'fbtllcat16', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat16', $editoroptions, $context, 'mod_osa', 'fbtblulcat16', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat16', $editoroptions, $context, 'mod_osa', 'fbtulcat16', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat17', $editoroptions, $context, 'mod_osa', 'fbtllcat17', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat17', $editoroptions, $context, 'mod_osa', 'fbtblulcat17', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat17', $editoroptions, $context, 'mod_osa', 'fbtulcat17', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat18', $editoroptions, $context, 'mod_osa', 'fbtllcat18', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat18', $editoroptions, $context, 'mod_osa', 'fbtblulcat18', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat18', $editoroptions, $context, 'mod_osa', 'fbtulcat18', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat19', $editoroptions, $context, 'mod_osa', 'fbtllcat19', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat19', $editoroptions, $context, 'mod_osa', 'fbtblulcat19', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat19', $editoroptions, $context, 'mod_osa', 'fbtulcat19', $entry->id);

$entry = file_prepare_standard_editor($entry, 'fbtllcat20', $editoroptions, $context, 'mod_osa', 'fbtllcat20', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtblulcat20', $editoroptions, $context, 'mod_osa', 'fbtblulcat20', $entry->id);
$entry = file_prepare_standard_editor($entry, 'fbtulcat20', $editoroptions, $context, 'mod_osa', 'fbtulcat20', $entry->id);

/**
* Display the form.
*
* @package     mod_osa
* @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
* @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

// Instantiate form.
$passinfotoform = ['cmid' => $cmid, 'currentdata' => $entry, 'cm' => $cm, 'osa' => $osa, 'records' => $records]; // Hand over cmid and id to edit_questiontype_textelement_class.php.

$mform = new edit_cat_feedback_settings_class(null, $passinfotoform);

if ($mform->is_cancelled()) {

    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); // Set return url.
    redirect($returnurl); // Return to view.php.

} else if ($fromform = $mform->get_data()) {
    $entry = osa_edit_cat_feedback_settings_entry($fromform, $course, $osa, $cm, $context, $records, $entry);
    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id));
    redirect($returnurl);
}

echo $OUTPUT->header();

$mform->display(); // Display form.

echo $OUTPUT->footer();
