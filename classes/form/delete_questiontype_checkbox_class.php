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
 * The main mod_osa questiontype checkbox configuration form class file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot.'/mod/osa/lib.php');

require_once('../../config.php');

$cmid = required_param('cmid', PARAM_INT);
$checkboxid = optional_param('checkbox', 0, PARAM_INT); // Get checkbox id from the url parameter.

global $DB;

$recordtobedeleted = $DB->get_record('osa_instance_qtcheckbox', ['fk_qtc' => $cmid, 'id' => $checkboxid]);

$msg = "";
try {
    $delete = $DB->delete_records('osa_instance_qtcheckbox', ['fk_qtc' => $cmid, 'id' => $checkboxid]);
    $msgqtypecheckbox = get_string('successdel', 'mod_osa');
    $deleteqtypecol = $DB->delete_records('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqtc' => $checkboxid]);
    $msgqtypecol = get_string('successdel', 'mod_osa');
    $deleteqtypetextanswers = $DB->delete_records('osa_instance_qtcheckbox_a', ['fk_osa_instance_qtcheckbox' => $checkboxid]);
    $msgqtypeanswer = get_string('successdel', 'mod_osa');
} catch (Exception $e) {
    $msgqtypecheckbox = get_string('faileddel', 'mod_osa');
    $msgqtypecol = get_string('faileddel', 'mod_osa');
    $msgqtypeanswer = get_string('faileddel', 'mod_osa');}

$url = new moodle_url('/mod/osa/view.php', ['id' => $cmid]);
$messageqtypecheckbox = $msgqtypecheckbox;
$messageqtypecol = $msgqtypecol;
$messageqtypeanswer = $msgqtypeanswer;
redirect($url, $messageqtypecheckbox, $messageqtypecol, $messageqtypeanswer);
