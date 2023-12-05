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
 * The main mod_osa questiontype delete likert scale configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/mod/osa/lib.php');

require_once('../../config.php');

$cmid = required_param('cmid', PARAM_INT);
$likertid = optional_param('likert', 0, PARAM_INT); // Get likert id from the url parameter.

global $DB;

$recordtobedeleted = $DB->get_record('osa_instance_qtlikertscale', ['fk_qtls' => $cmid, 'id' => $likertid]);

$msg = "";
try {
    $deleteqtypelikert = $DB->delete_records('osa_instance_qtlikertscale', ['fk_qtls' => $cmid, 'id' => $likertid]);
    $msgqtypelikert = get_string('successdel', 'mod_osa');
    $deleteqtypecol = $DB->delete_records('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqtls' => $likertid]);
    $msgqtypecol = get_string('successdel', 'mod_osa');
    $deleteqtypelikertanswers = $DB->delete_records('osa_instance_qtlikertscale_a', ['fk_osa_instance_qtlikertscale' => $likertid]);
    $msgqtypeanswer = get_string('successdel', 'mod_osa');
} catch (Exception $e) {
    $msgqtypelikert = get_string('faileddel', 'mod_osa');
    $msgqtypecol = get_string('faileddel', 'mod_osa');
    $msgqtypeanswer = get_string('faileddel', 'mod_osa');
}

$url = new moodle_url('/mod/osa/view.php', ['id' => $cmid]);
$messageqtypelikert = $msgqtypelikert;
$messageqtypecol = $msgqtypecol;
$messageqtypeanswer = $msgqtypeanswer;
redirect($url, $messageqtypelikert, $messageqtypecol, $messageqtypeanswer);
