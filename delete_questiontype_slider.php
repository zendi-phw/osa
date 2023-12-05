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
 * The main mod_osa questiontype delete slider configuration form.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/osa/classes/form/delete_questiontype_slider_class.php');

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter
$sliderid = optional_param('slider', 0, PARAM_INT); // Get slider id from the url parameter.

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/delete_questiontype_slider.php', ['id' => $cmid, 'slider' => $sliderid]);

$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitledeleteslider', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);


echo $OUTPUT->header();


echo $OUTPUT->confirm(
    get_string('deleteconfirmlikert', 'mod_osa'),
    new moodle_url('/mod/osa/classes/form/delete_questiontype_slider_class.php', ['id'  => $cmid, 'slider' => $sliderid]),
    new moodle_url('/mod/osa/view.php', ['id' => $cmid])
);

echo $OUTPUT->footer();
