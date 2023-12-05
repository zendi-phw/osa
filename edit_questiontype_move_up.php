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
 * The main mod_osa edit_questiontype_muove_up file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

global $PAGE, $DB, $CFG, $OUTPUT; $USER;

//$DB->set_debug(true);

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter
$textelementid = optional_param('textelement', 0, PARAM_INT); // Get textelemt id from the url parameter.
$sliderid = optional_param('slider', 0, PARAM_INT); // Get slider id from the url parameter.
$likertid = optional_param('likert', 0, PARAM_INT); // Get likert id from the url parameter.
$checkboxid = optional_param('checkbox', 0, PARAM_INT); // Get checkbox id from the url parameter.

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.

if (!empty($_POST['id'])) {
    $textelementid = (int) $_POST['id'];
    $sliderid = (int) $_POST['id'];
    $likertid = (int) $_POST['id'];
    $checkboxid = (int) $_POST['id'];
} else {
    $textelementid = optional_param('textelement', 0, PARAM_INT);
    $sliderid = optional_param('slider', 0, PARAM_INT);
    $likertid = optional_param('likert', 0, PARAM_INT);
    $checkboxid = optional_param('checkbox', 0, PARAM_INT);
}

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

// Load existingentries/records according to qtype.

if ($textelementid != 0) {

$url = new moodle_url('/mod/osa/edit_questiontype_move_up.php', ['cmid' => $cmid, 'textelement' => $textelementid]);

$currententry = $DB->get_record('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqtt' => $textelementid]);
$qtype = "text";
$qtypeid = $textelementid;

}

else if ($sliderid != 0) {

$url = new moodle_url('/mod/osa/edit_questiontype_move_up.php', ['cmid' => $cmid, 'slider' => $sliderid]);

$currententry = $DB->get_record('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqts' => $sliderid]);
$qtype = "slider";
$qtypeid = $sliderid;

}

else if ($likertid != 0) {

$url = new moodle_url('/mod/osa/edit_questiontype_move_up.php', ['cmid' => $cmid, 'likert' => $likertid]);

$currententry = $DB->get_record('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqtls' => $likertid]);
$qtype = "likert";
$qtypeid = $likertid;

}

else if ($checkboxid != 0) {

$url = new moodle_url('/mod/osa/edit_questiontype_move_up.php', ['cmid' => $cmid, 'checkbox' => $checkboxid]);

$currententry = $DB->get_record('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqtc' => $checkboxid]);
$qtype = "checkbox";
$qtypeid = $checkboxid;

}

// Set up page.
$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitlemoveup', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

// Get current sort position from DB entries.
if ($qtypeid != 0) {

$currentpositionindb = $currententry->sort;

// Get current id of current entry.
$currentidindb = $currententry->id;

// If none exist echo error.

} else {
    echo "error";
}

// Get next entry from qtype collection database where sort id is maximum of sortids but smaller than currentpositionindb id.
// Get all entries with current cmid. Sort in ascending order by sort column.
$collectionsortids = $DB->get_records('osa_qtype_collection', ['fk_cmid' => $cmid], 'sort ASC');
$tempkeys = array_keys($collectionsortids);
$position = array_search($currentidindb, $tempkeys);
$prevposition = $position-1;
$nextposition = $position+1;
$nexposition = array_search($currentidindb, $tempkeys);

// Get entry for current id.
$currentsortentry = $DB->get_record('osa_qtype_collection', ['id' => $currentidindb, 'fk_cmid' => $cmid]);
$currentsortentryid = $currentsortentry->id;
$currentsortentrysort = $currentsortentry->sort;
$currentcategoryentrycategory = $currentsortentry->category;

// Get entry for previous id.
$previousidindb = $tempkeys[$prevposition];
$previoussortentry = $DB->get_record('osa_qtype_collection', ['id' => $previousidindb, 'fk_cmid' => $cmid]);
$previoussortentryid = $previoussortentry->id;
$previoussortentrysort = $previoussortentry->sort;
$previouscategoryentrycategory = $previoussortentry->category;

// Get entry for next id.var_dump("<br>\n<br>\ncurrentsortentry<br>\n");
$nextidindb = $tempkeys[$nextposition];
$nextsortentry = $DB->get_record('osa_qtype_collection', ['id' => $nextidindb, 'fk_cmid' => $cmid]);
$nextsortentryid = $nextsortentry->id;
$nextsortentrysort = $nextsortentry->sort;

if (empty($previoussortentryid)) {
    echo "no previous entry available";
    // Return to view.php.
    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id));
    redirect($returnurl);

}

// Update smaller sort entry id with randomnumber.
//$DB->set_field('osa_qtype_collection', 'sort', $randomnumber, ['id' => $previoussortentryid, 'fk_cmid' => $cmid]);

// Update current sort entry id with smaller sort id.
$DB->set_field('osa_qtype_collection', 'sort', $previoussortentrysort, ['id' => $currentsortentryid, 'fk_cmid' => $cmid]);
// Update current category entry id with prev sort id. $currentsortentryid stays the same as it is the same record id.
$DB->set_field('osa_qtype_collection', 'category', $previouscategoryentrycategory, ['id' => $currentsortentryid, 'fk_cmid' => $cmid]);

// Update smaller sort entry id with former current sort id.
$DB->set_field('osa_qtype_collection', 'sort', $currentsortentrysort, ['id' => $previoussortentryid, 'fk_cmid' => $cmid]);
// Update prev category entry id with former current category id. $previoussortentryid stays the same as it is the same record id.
$DB->set_field('osa_qtype_collection', 'category', $currentcategoryentrycategory, ['id' => $previoussortentryid, 'fk_cmid' => $cmid]);

// Return to view.php.
$returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id));
redirect($returnurl);

echo $OUTPUT->header();



echo $OUTPUT->footer();
