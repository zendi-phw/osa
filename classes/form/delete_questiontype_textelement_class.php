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
 * The main mod_osa questiontype delete slider configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/mod/osa/lib.php');

require_once('../../config.php');

$cmid = required_param('cmid', PARAM_INT);
$textelementid = optional_param('textelement', 0, PARAM_INT); // Get textelement id from the url parameter.

global $DB;

$recordtobedeleted = $DB->get_record('osa_instance_qttextelement', ['fk_qtt' => $cmid, 'id' => $textelementid]);

$msg = "";
try {
    $deleteqtypetext = $DB->delete_records('osa_instance_qttextelement', ['fk_qtt' => $cmid, 'id' => $textelementid]);
    $msgqtypetext = get_string('successdel', 'mod_osa');
    $deleteqtypecol = $DB->delete_records('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqtt' => $textelementid]);
    $msgqtypecol = get_string('successdel', 'mod_osa');
    $deleteqtypetextanswers = $DB->delete_records('osa_instance_qttextelement_a', ['fk_osa_instance_qttextelement' => $textelementid]);
    $msgqtypeanswer = get_string('successdel', 'mod_osa');
} catch (Exception $e) {
    $msgqtypetext = get_string('faileddel', 'mod_osa');
    $msgqtypecol = get_string('faileddel', 'mod_osa');
    $msgqtypeanswer = get_string('faileddel', 'mod_osa');
}

$url = new moodle_url('/mod/osa/view.php', ['id' => $cmid]);
$messageqtypetext = $msgqtypetext;
$messageqtypecol = $msgqtypecol;
$messageqtypeanswer = $msgqtypeanswer;
redirect($url, $messageqtypetext, $messageqtypecol, $messageqtypeanswer);
