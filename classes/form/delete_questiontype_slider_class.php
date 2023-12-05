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
$sliderid = optional_param('slider', 0, PARAM_INT); // Get slider id from the url parameter.

global $DB;

$recordtobedeleted = $DB->get_record('osa_instance_qtslider', ['fk_qts' => $cmid, 'id' => $sliderid]);

$msg = "";
try {
    $deleteqtypeslider = $DB->delete_records('osa_instance_qtslider', ['fk_qts' => $cmid, 'id' => $sliderid]);
    $msgqtypeslider = get_string('successdel', 'mod_osa');
    $deleteqtypecol = $DB->delete_records('osa_qtype_collection', ['fk_cmid' => $cmid, 'fk_tqts' => $sliderid]);
    $msgqtypecol = get_string('successdel', 'mod_osa');
    $deleteqtypetextanswers = $DB->delete_records('osa_instance_qtslider_a', ['fk_osa_instance_qtslider' => $sliderid]);
    $msgqtypeanswer = get_string('successdel', 'mod_osa');
} catch (Exception $e) {
    $msgqtypeslider = get_string('faileddel', 'mod_osa');
    $msgqtypecol = get_string('faileddel', 'mod_osa');
    $msgqtypeanswer = get_string('faileddel', 'mod_osa');
}

$url = new moodle_url('/mod/osa/view.php', ['id' => $cmid]);
$messageqtypeslider = $msgqtypeslider;
$messageqtypecol = $msgqtypecol;
$messageqtypeanswer = $msgqtypeanswer;
redirect($url, $messageqtypeslider, $messageqtypecol, $messageqtypeanswer);
