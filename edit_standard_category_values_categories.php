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
 * The main mod_osa edit_standard_category_values_categories configuration form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/classes/form/edit_standard_category_values_categories_class.php');

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.
$recordscatstdvals = $DB->get_records('osa_cat_std_vals', array('fk_cmid' => $cm->id));

$records = $recordscatstdvals;

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/edit_standard_category_values_categories.php', ['cmid' => $cmid]);

$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitleeditstandardcategoryvalues', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);


// Get current entries.

$entries = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id));

// Prepare editor content using function file_prepare_standard_editor() function.

/**
* Display the form.
*
* @package     mod_osa
* @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
* @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

// Instantiate form.
$passinfotoform = ['cmid' => $cmid, 'id' => $textelementid, 'currentdata' => $entries, 'cm' => $cm, 'osa' => $osa, 'records' => $records]; // Hand over cmid and id to edit_questiontype_textelement_class.php.

$mform = new edit_standard_category_values_categories_class(null, $passinfotoform);

if ($mform->is_cancelled()) {

    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); // Set return url.
    redirect($returnurl); // Return to view.php.

} else if ($fromform = $mform->get_data()) {
    $entries = osa_edit_standard_category_values_entry($fromform, $course, $osa, $cm, $context, $records, $entries);
    $returnurl = new moodle_url('/mod/osa/view.php', array('id' => $cm->id)); //
    redirect($returnurl);
}

echo $OUTPUT->header();

$mform->display(); // Display form.

echo $OUTPUT->footer();
