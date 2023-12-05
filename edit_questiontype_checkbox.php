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
 * The main mod_osa questiontype checkbox configuration form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/classes/form/edit_questiontype_checkbox_class.php');

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter
$checkboxid = optional_param('checkbox', 0, PARAM_INT); // Get checkbox id from the url parameter.

// url/moodle/mod/osa/edit_questiontype_checkbox.php?id=300&checkbox=5

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.

if (!empty($_POST['id'])) {
    $checkboxid = (int) $_POST['id'];
} else {
    $checkboxid = optional_param('checkbox', 0, PARAM_INT);
}

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/edit_questiontype_checkbox.php', ['cmid' => $cmid]);

$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitleeditcheckbox', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

if ($checkboxid != 0) {

// Load existingentries/records.
$entry = $DB->get_record('osa_instance_qtcheckbox', ['id' => $checkboxid]);

} else {
    // Create new entry.
    $entry = new stdClass();
    $entry->id = null;
}

// Get editoroptions from lib.php.
$editoroptions = osa_get_editor_options_edit_questiontype_checkbox($context);

// Prepare editor content using function file_prepare_standard_editor() function.
$entry = file_prepare_standard_editor($entry, 'cbtextdesc01', $editoroptions, $context, 'mod_osa', 'cbtextdesc01', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc02', $editoroptions, $context, 'mod_osa', 'cbtextdesc02', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc03', $editoroptions, $context, 'mod_osa', 'cbtextdesc03', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc04', $editoroptions, $context, 'mod_osa', 'cbtextdesc04', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc05', $editoroptions, $context, 'mod_osa', 'cbtextdesc05', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc06', $editoroptions, $context, 'mod_osa', 'cbtextdesc06', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc07', $editoroptions, $context, 'mod_osa', 'cbtextdesc07', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc08', $editoroptions, $context, 'mod_osa', 'cbtextdesc08', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc09', $editoroptions, $context, 'mod_osa', 'cbtextdesc09', $entry->id);
$entry = file_prepare_standard_editor($entry, 'cbtextdesc10', $editoroptions, $context, 'mod_osa', 'cbtextdesc10', $entry->id);
//var_dump($entry);
//die;
$entry->cmid = $cmid;

/**
 * Display the form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Instantiate form.
$passinfotoform = ['cmid' => $cmid, 'id' => $checkboxid, 'currentdata' => $entry, 'cm' => $cm]; // Hand over cmid and id to edit_questiontype_checkbox_class.php.

$mform = new edit_questiontype_checkbox_class(null, $passinfotoform);

if ($mform->is_cancelled()) {

    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); // Set return url.
    redirect($returnurl); // Return to view.php.

} else if ($fromform = $mform->get_data()) {

    $entry = osa_edit_questiontype_checkbox_entry($fromform, $course, $cm, $osa, $context, $checkboxid);

    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); //
    redirect($returnurl);
}

echo $OUTPUT->header();

$mform->display(); // Display form.

echo $OUTPUT->footer();
 
