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
 * The main mod_osa questiontype likert scale configuration form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/classes/form/edit_questiontype_slider_class.php');

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter
$sliderid = optional_param('slider', 0, PARAM_INT); // Get slider id from the url parameter.

// url/moodle/mod/osa/edit_questiontype_slider.php?id=300&slider=5

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.

if (!empty($_POST['id'])) {
    $sliderid = (int) $_POST['id'];
} else {
    $sliderid = optional_param('slider', 0, PARAM_INT);
}

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/edit_questiontype_slider.php', array('cmid' => $cmid));
//
$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitleeditslider', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

if ($sliderid != 0) {

// Load existingentries/records.
$entry = $DB->get_record('osa_instance_qtslider', ['id' => $sliderid]);

} else {
    // Create new entry.
    $entry = new stdClass();
    $entry->id = null;
}

// Get editoroptions from lib.php.
$editoroptions = osa_get_editor_options_edit_questiontype_slider($context);

// Get filemanageroptions from lib.php.
$filemanageroptions = osa_get_filemanager_options_edit_questiontype_slider($context);

// Prepare editor content using function file_prepare_standard_editor() function.
$entry = file_prepare_standard_editor($entry, 'ssdesceditor01', $editoroptions, $context, 'mod_osa', 'ssdesceditor01', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor02', $editoroptions, $context, 'mod_osa', 'ssdesceditor02', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor03', $editoroptions, $context, 'mod_osa', 'ssdesceditor03', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor04', $editoroptions, $context, 'mod_osa', 'ssdesceditor04', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor05', $editoroptions, $context, 'mod_osa', 'ssdesceditor05', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor06', $editoroptions, $context, 'mod_osa', 'ssdesceditor06', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor07', $editoroptions, $context, 'mod_osa', 'ssdesceditor07', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor08', $editoroptions, $context, 'mod_osa', 'ssdesceditor08', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor09', $editoroptions, $context, 'mod_osa', 'ssdesceditor09', $entry->id);
$entry = file_prepare_standard_editor($entry, 'ssdesceditor10', $editoroptions, $context, 'mod_osa', 'ssdesceditor10', $entry->id);

$entry = file_prepare_standard_filemanager($entry, 'simage01', $filemanageroptions, $context, 'mod_osa', 'simage01', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage02', $filemanageroptions, $context, 'mod_osa', 'simage02', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage03', $filemanageroptions, $context, 'mod_osa', 'simage03', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage04', $filemanageroptions, $context, 'mod_osa', 'simage04', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage05', $filemanageroptions, $context, 'mod_osa', 'simage05', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage06', $filemanageroptions, $context, 'mod_osa', 'simage06', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage07', $filemanageroptions, $context, 'mod_osa', 'simage07', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage08', $filemanageroptions, $context, 'mod_osa', 'simage08', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage09', $filemanageroptions, $context, 'mod_osa', 'simage09', $entry->id);
$entry = file_prepare_standard_filemanager($entry, 'simage10', $filemanageroptions, $context, 'mod_osa', 'simage10', $entry->id);

$entry->cmid = $cmid;

/**
 * Display the form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$passinfotoform = ['cmid' => $cmid, 'id' => $sliderid, 'currentdata' => $entry, 'cm' => $cm]; // Hand over cmid and id to edit_questiontype_slider_class.php.

$mform = new edit_questiontype_slider_class(null, $passinfotoform);

if ($mform->is_cancelled()) {

    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); // Set return url.
    redirect($returnurl); // Return to view.php.

} else if ($fromform = $mform->get_data()) {

    $entry = osa_edit_questiontype_slider_entry($fromform, $course, $cm, $osa, $context, $sliderid);

    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); //
    redirect($returnurl);
}

echo $OUTPUT->header();

$mform->display(); // Display form.

echo $OUTPUT->footer();
 
