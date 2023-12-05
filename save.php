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
 * Calls function to save user answers into DB.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');
require_once(__DIR__.'/../../lib/filelib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

// Id and course module id.
$id = required_param('id', PARAM_INT);
$cm = get_coursemodule_from_id('osa', $id);
$course = $DB->get_record('course', array('id' => $cm->course));
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST);

$context = context_module::instance($cm->id);

global $PAGE, $DB, $CFG, $OUTPUT; $USER;

$url = new moodle_url('/mod/osa/save.php');
$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitlesave', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

//$DB->set_debug(true);

$formdata = data_submitted();

// Save data into database
osa_save_answers($osa, $formdata, $course, $context);

// Get cmid to pass to results page.
$cmid = $cm->id;

// Redirect URL to evaluation page.
$url = new moodle_url('/mod/osa/view_results.php', ['cmid' => $cmid]);

redirect($url);

