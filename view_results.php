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
 * The main mod_osa view_results file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

global $PAGE, $DB, $CFG, $OUTPUT; $USER;

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.
$feedback = $DB->get_record('osa_cat_feedback_settings', array('fk_cmid' => $cmid), '*', MUST_EXIST); // Get feedback from osa_cat_feedback_settings db.
// Set error message when feedback settings are not available.

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/view_results.php', ['cmid' => $cmid]);

$PAGE->set_url($url);
$PAGE->set_title(get_string('viewresults', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);
$PAGE->add_body_class('limitedwidth');

// Get config settings from adminsettings.
// Get config of admin settings where to get libraries for graphics creation.
$getadminconfigd3 = get_config('mod_osa', 'osasettingurld3');
$getadminconfigplotly = get_config('mod_osa', 'osasettingurlplotly');

// Get data from DB
// Sort records in array according to sort entry in osa_qtype_collection.
$recordsqtypecoll = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id), 'sort ASC');


echo $OUTPUT->header();

// Get category name data.
$osanamecat01 = $osa->namecat01;
$osanamecat02 = $osa->namecat02;
$osanamecat03 = $osa->namecat03;
$osanamecat04 = $osa->namecat04;
$osanamecat05 = $osa->namecat05;
$osanamecat06 = $osa->namecat06;
$osanamecat07 = $osa->namecat07;
$osanamecat08 = $osa->namecat08;
$osanamecat09 = $osa->namecat09;
$osanamecat10 = $osa->namecat10;
$osanamecat11 = $osa->namecat11;
$osanamecat12 = $osa->namecat12;
$osanamecat13 = $osa->namecat13;
$osanamecat14 = $osa->namecat14;
$osanamecat15 = $osa->namecat15;
$osanamecat16 = $osa->namecat16;
$osanamecat17 = $osa->namecat17;
$osanamecat18 = $osa->namecat18;
$osanamecat19 = $osa->namecat19;
$osanamecat20 = $osa->namecat20;

// Get category desc data.
$osanamecat01desc = $osa->osanamecat01;
$osanamecat02desc = $osa->osanamecat02;
$osanamecat03desc = $osa->osanamecat03;
$osanamecat04desc = $osa->osanamecat04;
$osanamecat05desc = $osa->osanamecat05;
$osanamecat06desc = $osa->osanamecat06;
$osanamecat07desc = $osa->osanamecat07;
$osanamecat08desc = $osa->osanamecat08;
$osanamecat09desc = $osa->osanamecat09;
$osanamecat10desc = $osa->osanamecat10;
$osanamecat11desc = $osa->osanamecat11;
$osanamecat12desc = $osa->osanamecat12;
$osanamecat13desc = $osa->osanamecat13;
$osanamecat14desc = $osa->osanamecat14;
$osanamecat15desc = $osa->osanamecat15;
$osanamecat16desc = $osa->osanamecat16;
$osanamecat17desc = $osa->osanamecat17;
$osanamecat18desc = $osa->osanamecat18;
$osanamecat19desc = $osa->osanamecat19;
$osanamecat20desc = $osa->osanamecat20;

// Get feedback value lower limit and upper limit for each category.
// Lower limit values.
$llc01 = $feedback->stdvalllcat01;
$llc02 = $feedback->stdvalllcat02;
$llc03 = $feedback->stdvalllcat03;
$llc04 = $feedback->stdvalllcat04;
$llc05 = $feedback->stdvalllcat05;
$llc06 = $feedback->stdvalllcat06;
$llc07 = $feedback->stdvalllcat07;
$llc08 = $feedback->stdvalllcat08;
$llc09 = $feedback->stdvalllcat09;
$llc10 = $feedback->stdvalllcat10;
$llc11 = $feedback->stdvalllcat11;
$llc12 = $feedback->stdvalllcat12;
$llc13 = $feedback->stdvalllcat13;
$llc14 = $feedback->stdvalllcat14;
$llc15 = $feedback->stdvalllcat15;
$llc16 = $feedback->stdvalllcat16;
$llc17 = $feedback->stdvalllcat17;
$llc18 = $feedback->stdvalllcat18;
$llc19 = $feedback->stdvalllcat19;
$llc20 = $feedback->stdvalllcat20;
// Upper limit values.
$ulc01 = $feedback->stdvalulcat01;
$ulc02 = $feedback->stdvalulcat02;
$ulc03 = $feedback->stdvalulcat03;
$ulc04 = $feedback->stdvalulcat04;
$ulc05 = $feedback->stdvalulcat05;
$ulc06 = $feedback->stdvalulcat06;
$ulc07 = $feedback->stdvalulcat07;
$ulc08 = $feedback->stdvalulcat08;
$ulc09 = $feedback->stdvalulcat09;
$ulc10 = $feedback->stdvalulcat10;
$ulc11 = $feedback->stdvalulcat11;
$ulc12 = $feedback->stdvalulcat12;
$ulc13 = $feedback->stdvalulcat13;
$ulc14 = $feedback->stdvalulcat14;
$ulc15 = $feedback->stdvalulcat15;
$ulc16 = $feedback->stdvalulcat16;
$ulc17 = $feedback->stdvalulcat17;
$ulc18 = $feedback->stdvalulcat18;
$ulc19 = $feedback->stdvalulcat19;
$ulc20 = $feedback->stdvalulcat20;


// Rewrite pluginfile urls.
$options = array('noclean' => true, 'para' => false, 'filter' => $filter, 'context' => $context, 'overflowdiv' => true);

$osanamecat01desc = file_rewrite_pluginfile_urls($osa->osanamecat01, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat01', 0);
$osanamecat01desc = trim(format_text($osanamecat01desc, $osa->osanamecat01format, $options, null));
$osanamecat02desc = file_rewrite_pluginfile_urls($osa->osanamecat02, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat02', 0);
$osanamecat02desc = trim(format_text($osanamecat02desc, $osa->osanamecat02format, $options, null));
$osanamecat03desc = file_rewrite_pluginfile_urls($osa->osanamecat03, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat03', 0);
$osanamecat03desc = trim(format_text($osanamecat03desc, $osa->osanamecat03format, $options, null));
$osanamecat04desc = file_rewrite_pluginfile_urls($osa->osanamecat04, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat04', 0);
$osanamecat04desc = trim(format_text($osanamecat04desc, $osa->osanamecat04format, $options, null));
$osanamecat05desc = file_rewrite_pluginfile_urls($osa->osanamecat05, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat05', 0);
$osanamecat05desc = trim(format_text($osanamecat05desc, $osa->osanamecat05format, $options, null));
$osanamecat06desc = file_rewrite_pluginfile_urls($osa->osanamecat06, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat06', 0);
$osanamecat06desc = trim(format_text($osanamecat06desc, $osa->osanamecat06format, $options, null));
$osanamecat07desc = file_rewrite_pluginfile_urls($osa->osanamecat07, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat07', 0);
$osanamecat07desc = trim(format_text($osanamecat07desc, $osa->osanamecat07format, $options, null));
$osanamecat08desc = file_rewrite_pluginfile_urls($osa->osanamecat08, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat08', 0);
$osanamecat08desc = trim(format_text($osanamecat08desc, $osa->osanamecat08format, $options, null));
$osanamecat09desc = file_rewrite_pluginfile_urls($osa->osanamecat09, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat09', 0);
$osanamecat09desc = trim(format_text($osanamecat09desc, $osa->osanamecat09format, $options, null));
$osanamecat10desc = file_rewrite_pluginfile_urls($osa->osanamecat10, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat10', 0);
$osanamecat10desc = trim(format_text($osanamecat10desc, $osa->osanamecat10format, $options, null));
$osanamecat11desc = file_rewrite_pluginfile_urls($osa->osanamecat11, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat11', 0);
$osanamecat11desc = trim(format_text($osanamecat11desc, $osa->osanamecat11format, $options, null));
$osanamecat12desc = file_rewrite_pluginfile_urls($osa->osanamecat12, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat12', 0);
$osanamecat12desc = trim(format_text($osanamecat12desc, $osa->osanamecat12format, $options, null));
$osanamecat13desc = file_rewrite_pluginfile_urls($osa->osanamecat13, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat13', 0);
$osanamecat13desc = trim(format_text($osanamecat13desc, $osa->osanamecat13format, $options, null));
$osanamecat14desc = file_rewrite_pluginfile_urls($osa->osanamecat14, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat14', 0);
$osanamecat14desc = trim(format_text($osanamecat14desc, $osa->osanamecat14format, $options, null));
$osanamecat15desc = file_rewrite_pluginfile_urls($osa->osanamecat15, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat15', 0);
$osanamecat15desc = trim(format_text($osanamecat15desc, $osa->osanamecat15format, $options, null));
$osanamecat16desc = file_rewrite_pluginfile_urls($osa->osanamecat16, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat16', 0);
$osanamecat16desc = trim(format_text($osanamecat16desc, $osa->osanamecat16format, $options, null));
$osanamecat17desc = file_rewrite_pluginfile_urls($osa->osanamecat17, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat17', 0);
$osanamecat17desc = trim(format_text($osanamecat17desc, $osa->osanamecat17format, $options, null));
$osanamecat18desc = file_rewrite_pluginfile_urls($osa->osanamecat18, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat18', 0);
$osanamecat18desc = trim(format_text($osanamecat18desc, $osa->osanamecat18format, $options, null));
$osanamecat19desc = file_rewrite_pluginfile_urls($osa->osanamecat19, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat19', 0);
$osanamecat19desc = trim(format_text($osanamecat19desc, $osa->osanamecat19format, $options, null));
$osanamecat20desc = file_rewrite_pluginfile_urls($osa->osanamecat20, 'pluginfile.php', $context->id, 'mod_osa', 'osanamecat20', 0);
$osanamecat20desc = trim(format_text($osanamecat20desc, $osa->osanamecat20format, $options, null));


// Rewrite pluginfile urls for feedback.
// Below lower limit.
$feedbackcatll01desc = file_rewrite_pluginfile_urls($feedback->fbtllcat01, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat01', 0);
$feedbackcatll01desc = trim(format_text($feedbackcatll01desc, $feedback->fbtllcat01format, $options, null));
$feedbackcatll02desc = file_rewrite_pluginfile_urls($feedback->fbtllcat02, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat02', 0);
$feedbackcatll02desc = trim(format_text($feedbackcatll02desc, $feedback->fbtllcat02format, $options, null));
$feedbackcatll03desc = file_rewrite_pluginfile_urls($feedback->fbtllcat03, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat03', 0);
$feedbackcatll03desc = trim(format_text($feedbackcatll03desc, $feedback->fbtllcat03format, $options, null));
$feedbackcatll04desc = file_rewrite_pluginfile_urls($feedback->fbtllcat04, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat04', 0);
$feedbackcatll04desc = trim(format_text($feedbackcatll04desc, $feedback->fbtllcat04format, $options, null));
$feedbackcatll05desc = file_rewrite_pluginfile_urls($feedback->fbtllcat05, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat05', 0);
$feedbackcatll05desc = trim(format_text($feedbackcatll05desc, $feedback->fbtllcat05format, $options, null));
$feedbackcatll06desc = file_rewrite_pluginfile_urls($feedback->fbtllcat06, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat06', 0);
$feedbackcatll06desc = trim(format_text($feedbackcatll06desc, $feedback->fbtllcat06format, $options, null));
$feedbackcatll07desc = file_rewrite_pluginfile_urls($feedback->fbtllcat07, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat07', 0);
$feedbackcatll07desc = trim(format_text($feedbackcatll07desc, $feedback->fbtllcat07format, $options, null));
$feedbackcatll08desc = file_rewrite_pluginfile_urls($feedback->fbtllcat08, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat08', 0);
$feedbackcatll08desc = trim(format_text($feedbackcatll08desc, $feedback->fbtllcat08format, $options, null));
$feedbackcatll09desc = file_rewrite_pluginfile_urls($feedback->fbtllcat09, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat09', 0);
$feedbackcatll09desc = trim(format_text($feedbackcatll09desc, $feedback->fbtllcat09format, $options, null));
$feedbackcatll10desc = file_rewrite_pluginfile_urls($feedback->fbtllcat10, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat10', 0);
$feedbackcatll10desc = trim(format_text($feedbackcatll10desc, $feedback->fbtllcat10format, $options, null));
$feedbackcatll11desc = file_rewrite_pluginfile_urls($feedback->fbtllcat11, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat11', 0);
$feedbackcatll11desc = trim(format_text($feedbackcatll11desc, $feedback->fbtllcat11format, $options, null));
$feedbackcatll12desc = file_rewrite_pluginfile_urls($feedback->fbtllcat12, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat12', 0);
$feedbackcatll12desc = trim(format_text($feedbackcatll12desc, $feedback->fbtllcat12format, $options, null));
$feedbackcatll13desc = file_rewrite_pluginfile_urls($feedback->fbtllcat13, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat13', 0);
$feedbackcatll13desc = trim(format_text($feedbackcatll13desc, $feedback->fbtllcat13format, $options, null));
$feedbackcatll14desc = file_rewrite_pluginfile_urls($feedback->fbtllcat14, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat14', 0);
$feedbackcatll14desc = trim(format_text($feedbackcatll14desc, $feedback->fbtllcat14format, $options, null));
$feedbackcatll15desc = file_rewrite_pluginfile_urls($feedback->fbtllcat15, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat15', 0);
$feedbackcatll15desc = trim(format_text($feedbackcatll15desc, $feedback->fbtllcat15format, $options, null));
$feedbackcatll16desc = file_rewrite_pluginfile_urls($feedback->fbtllcat16, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat16', 0);
$feedbackcatll16desc = trim(format_text($feedbackcatll16desc, $feedback->fbtllcat16format, $options, null));
$feedbackcatll17desc = file_rewrite_pluginfile_urls($feedback->fbtllcat17, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat17', 0);
$feedbackcatll17desc = trim(format_text($feedbackcatll17desc, $feedback->fbtllcat17format, $options, null));
$feedbackcatll18desc = file_rewrite_pluginfile_urls($feedback->fbtllcat18, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat18', 0);
$feedbackcatll18desc = trim(format_text($feedbackcatll18desc, $feedback->fbtllcat18format, $options, null));
$feedbackcatll19desc = file_rewrite_pluginfile_urls($feedback->fbtllcat19, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat19', 0);
$feedbackcatll19desc = trim(format_text($feedbackcatll19desc, $feedback->fbtllcat19format, $options, null));
$feedbackcatll20desc = file_rewrite_pluginfile_urls($feedback->fbtllcat20, 'pluginfile.php', $context->id, 'mod_osa', 'fbtllcat20', 0);
$feedbackcatll20desc = trim(format_text($feedbackcatll20desc, $feedback->fbtllcat20format, $options, null));


// Between lower and upper limit.
$feedbackcatblul01desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat01, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat01', 0);
$feedbackcatblul01desc = trim(format_text($feedbackcatblul01desc, $feedback->fbtblulcat01format, $options, null));
$feedbackcatblul02desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat02, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat02', 0);
$feedbackcatblul02desc = trim(format_text($feedbackcatblul02desc, $feedback->fbtblulcat02format, $options, null));
$feedbackcatblul03desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat03, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat03', 0);
$feedbackcatblul03desc = trim(format_text($feedbackcatblul03desc, $feedback->fbtblulcat03format, $options, null));
$feedbackcatblul04desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat04, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat04', 0);
$feedbackcatblul04desc = trim(format_text($feedbackcatblul04desc, $feedback->fbtblulcat04format, $options, null));
$feedbackcatblul05desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat05, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat05', 0);
$feedbackcatblul05desc = trim(format_text($feedbackcatblul05desc, $feedback->fbtblulcat05format, $options, null));
$feedbackcatblul06desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat06, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat06', 0);
$feedbackcatblul06desc = trim(format_text($feedbackcatblul06desc, $feedback->fbtblulcat06format, $options, null));
$feedbackcatblul07desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat07, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat07', 0);
$feedbackcatblul07desc = trim(format_text($feedbackcatblul07desc, $feedback->fbtblulcat07format, $options, null));
$feedbackcatblul08desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat08, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat08', 0);
$feedbackcatblul08desc = trim(format_text($feedbackcatblul08desc, $feedback->fbtblulcat08format, $options, null));
$feedbackcatblul09desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat09, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat09', 0);
$feedbackcatblul09desc = trim(format_text($feedbackcatblul09desc, $feedback->fbtblulcat09format, $options, null));
$feedbackcatblul10desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat10, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat10', 0);
$feedbackcatblul10desc = trim(format_text($feedbackcatblul10desc, $feedback->fbtblulcat10format, $options, null));
$feedbackcatblul11desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat11, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat11', 0);
$feedbackcatblul11desc = trim(format_text($feedbackcatblul11desc, $feedback->fbtblulcat11format, $options, null));
$feedbackcatblul12desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat12, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat12', 0);
$feedbackcatblul12desc = trim(format_text($feedbackcatblul12desc, $feedback->fbtblulcat12format, $options, null));
$feedbackcatblul13desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat13, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat13', 0);
$feedbackcatblul13desc = trim(format_text($feedbackcatblul13desc, $feedback->fbtblulcat13format, $options, null));
$feedbackcatblul14desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat14, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat14', 0);
$feedbackcatblul14desc = trim(format_text($feedbackcatblul14desc, $feedback->fbtblulcat14format, $options, null));
$feedbackcatblul15desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat15, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat15', 0);
$feedbackcatblul15desc = trim(format_text($feedbackcatblul15desc, $feedback->fbtblulcat15format, $options, null));
$feedbackcatblul16desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat16, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat16', 0);
$feedbackcatblul16desc = trim(format_text($feedbackcatblul16desc, $feedback->fbtblulcat16format, $options, null));
$feedbackcatblul17desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat17, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat17', 0);
$feedbackcatblul17desc = trim(format_text($feedbackcatblul17desc, $feedback->fbtblulcat17format, $options, null));
$feedbackcatblul18desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat18, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat18', 0);
$feedbackcatblul18desc = trim(format_text($feedbackcatblul18desc, $feedback->fbtblulcat18format, $options, null));
$feedbackcatblul19desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat19, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat19', 0);
$feedbackcatblul19desc = trim(format_text($feedbackcatblul19desc, $feedback->fbtblulcat19format, $options, null));
$feedbackcatblul20desc = file_rewrite_pluginfile_urls($feedback->fbtblulcat20, 'pluginfile.php', $context->id, 'mod_osa', 'fbtblulcat20', 0);
$feedbackcatblul20desc = trim(format_text($feedbackcatblul20desc, $feedback->fbtblulcat20format, $options, null));


// Between above upper limit.
$feedbackcatul01desc = file_rewrite_pluginfile_urls($feedback->fbtulcat01, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat01', 0);
$feedbackcatul01desc = trim(format_text($feedbackcatul01desc, $feedback->fbtulcat01format, $options, null));
$feedbackcatul02desc = file_rewrite_pluginfile_urls($feedback->fbtulcat02, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat02', 0);
$feedbackcatul02desc = trim(format_text($feedbackcatul02desc, $feedback->fbtulcat02format, $options, null));
$feedbackcatul03desc = file_rewrite_pluginfile_urls($feedback->fbtulcat03, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat03', 0);
$feedbackcatul03desc = trim(format_text($feedbackcatul03desc, $feedback->fbtulcat03format, $options, null));
$feedbackcatul04desc = file_rewrite_pluginfile_urls($feedback->fbtulcat04, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat04', 0);
$feedbackcatul04desc = trim(format_text($feedbackcatul04desc, $feedback->fbtulcat04format, $options, null));
$feedbackcatul05desc = file_rewrite_pluginfile_urls($feedback->fbtulcat05, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat05', 0);
$feedbackcatul05desc = trim(format_text($feedbackcatul05desc, $feedback->fbtulcat05format, $options, null));
$feedbackcatul06desc = file_rewrite_pluginfile_urls($feedback->fbtulcat06, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat06', 0);
$feedbackcatul06desc = trim(format_text($feedbackcatul06desc, $feedback->fbtulcat06format, $options, null));
$feedbackcatul07desc = file_rewrite_pluginfile_urls($feedback->fbtulcat07, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat07', 0);
$feedbackcatul07desc = trim(format_text($feedbackcatul07desc, $feedback->fbtulcat07format, $options, null));
$feedbackcatul08desc = file_rewrite_pluginfile_urls($feedback->fbtulcat08, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat08', 0);
$feedbackcatul08desc = trim(format_text($feedbackcatul08desc, $feedback->fbtulcat08format, $options, null));
$feedbackcatul09desc = file_rewrite_pluginfile_urls($feedback->fbtulcat09, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat09', 0);
$feedbackcatul09desc = trim(format_text($feedbackcatul09desc, $feedback->fbtulcat09format, $options, null));
$feedbackcatul10desc = file_rewrite_pluginfile_urls($feedback->fbtulcat10, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat10', 0);
$feedbackcatul10desc = trim(format_text($feedbackcatul10desc, $feedback->fbtulcat10format, $options, null));
$feedbackcatul11desc = file_rewrite_pluginfile_urls($feedback->fbtulcat11, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat11', 0);
$feedbackcatul11desc = trim(format_text($feedbackcatul11desc, $feedback->fbtulcat11format, $options, null));
$feedbackcatul12desc = file_rewrite_pluginfile_urls($feedback->fbtulcat12, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat12', 0);
$feedbackcatul12desc = trim(format_text($feedbackcatul12desc, $feedback->fbtulcat12format, $options, null));
$feedbackcatul13desc = file_rewrite_pluginfile_urls($feedback->fbtulcat13, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat13', 0);
$feedbackcatul13desc = trim(format_text($feedbackcatul13desc, $feedback->fbtulcat13format, $options, null));
$feedbackcatul14desc = file_rewrite_pluginfile_urls($feedback->fbtulcat14, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat14', 0);
$feedbackcatul14desc = trim(format_text($feedbackcatul14desc, $feedback->fbtulcat14format, $options, null));
$feedbackcatul15desc = file_rewrite_pluginfile_urls($feedback->fbtulcat15, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat15', 0);
$feedbackcatul15desc = trim(format_text($feedbackcatul15desc, $feedback->fbtulcat15format, $options, null));
$feedbackcatul16desc = file_rewrite_pluginfile_urls($feedback->fbtulcat16, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat16', 0);
$feedbackcatul16desc = trim(format_text($feedbackcatul16desc, $feedback->fbtulcat16format, $options, null));
$feedbackcatul17desc = file_rewrite_pluginfile_urls($feedback->fbtulcat17, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat17', 0);
$feedbackcatul17desc = trim(format_text($feedbackcatul17desc, $feedback->fbtulcat17format, $options, null));
$feedbackcatul18desc = file_rewrite_pluginfile_urls($feedback->fbtulcat18, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat18', 0);
$feedbackcatul18desc = trim(format_text($feedbackcatul18desc, $feedback->fbtulcat18format, $options, null));
$feedbackcatul19desc = file_rewrite_pluginfile_urls($feedback->fbtulcat19, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat19', 0);
$feedbackcatul19desc = trim(format_text($feedbackcatul19desc, $feedback->fbtulcat19format, $options, null));
$feedbackcatul20desc = file_rewrite_pluginfile_urls($feedback->fbtulcat20, 'pluginfile.php', $context->id, 'mod_osa', 'fbtulcat20', 0);
$feedbackcatul20desc = trim(format_text($feedbackcatul20desc, $feedback->fbtulcat20format, $options, null));



// Set up loop through qtype_collection data.
$records = $recordsqtypecoll;

// Get already made attempts.
$madeattempts = osa_get_current_attempt($osa);


foreach ($records as $record) {

    // Set initial status of whether to display qtypes in template later on.

    $statusqttextelement = false;
    $statusqtlikertscale = false;
    $statusqtcheckbox = false;
    $statusqtslider = false;

    $currentuserid = $USER->id;

    if ($record->fk_tqtt != 0) {
        // Get record for textelement.
        $record = $DB->get_record('osa_instance_qttextelement', array('id' => $record->fk_tqtt));
        $recordid = $record->id;
        // Set $cm $cmid $qtype and $filearea
        $cm = $cm;
        $cmid = $cm->id;
        $qtype = 'text';
        $filearea = 'textelementeditor';
        // Set status of var to use it later in the template.
        $statusqttextelement = true;
        // Get data from db and rewrite URLs for question type.
        $recordvalue = get_data_from_question_db($record, $cm, $qtype, $filearea);
        $moveup = $recordvalue[3];
        $movedown = $recordvalue[4];
        $formlink_edit = $recordvalue[1];
        $formlink_delete = $recordvalue[2];
        $recordvalue = $recordvalue[0];
        // Get record for user answer.
        $recorduseranswer = $DB->get_record('osa_instance_qttextelement_a', array('fk_user' => $USER->id, 'fk_osa_instance_qttextelement' => $recordid, 'attempt' => $madeattempts));
        $recorduseranswervalue = $recorduseranswer->textelementeditor;
//        $recordqttextelementvalue = get_data_from_question_db($record, $cm, $qtype, $filearea);
    } else if ($record->fk_tqtls != 0) {
        // Get record for likert scale.
        $record = $DB->get_record('osa_instance_qtlikertscale', array('id' => $record->fk_tqtls));
        $recordid = $record->id;
        // Set $cm $qtype and $filearea.
        $cm = $cm;
        $cmid = $cm->id;
        $qtype = 'likert';
        $filearea = array(
            'lstextdesceditor01',
            'lstextdesceditor02',
            'lstextdesceditor03',
            'lstextdesceditor04',
            'lstextdesceditor05',
            'lstextdesceditor06',
            'lstextdesceditor07',
        );

        // Set status of var to use it later in the template.
        $statusqtlikertscale = true;
        // Get data from db and rewrite URLs for question type.
        $recordvalue = get_data_from_question_db($record, $cm, $qtype, $filearea);
        $moveup = $recordvalue[3];
        $movedown = $recordvalue[4];
        $formlink_edit = $recordvalue[1];
        $formlink_delete = $recordvalue[2];
        $recordvaluestepscontent = $recordvalue[0];
        $recordvalue01 = $recordvalue[0][0];
        $recordvalue02 = $recordvalue[0][1];
        $recordvalue03 = $recordvalue[0][2];
        $recordvalue04 = $recordvalue[0][3];
        $recordvalue05 = $recordvalue[0][4];
        $recordvalue06 = $recordvalue[0][5];
        $recordvalue07 = $recordvalue[0][6];
        // Get record for user answer.
        $recorduseranswer = $DB->get_record('osa_instance_qtlikertscale_a', array('fk_user' => $USER->id, 'fk_osa_instance_qtlikertscale' => $recordid, 'attempt' => $madeattempts));

        if ($recorduseranswer->lsitem01 == 1) {
            $recorduseranswervalue01 = "checked";
        }
        else {
            $recorduseranswervalue01 = "";
        }
        if ($recorduseranswer->lsitem02 == 1) {
            $recorduseranswervalue02 = "checked";
        }
        else {
            $recorduseranswervalue02 = "";
        }
        if ($recorduseranswer->lsitem03 == 1) {
            $recorduseranswervalue03 = "checked";
        }
        else {
            $recorduseranswervalue03 = "";
        }
        if ($recorduseranswer->lsitem04 == 1) {
            $recorduseranswervalue04 = "checked";
        }
        else {
            $recorduseranswervalue04 = "";
        }
        if ($recorduseranswer->lsitem05 == 1) {
            $recorduseranswervalue05 = "checked";
        }
        else {
            $recorduseranswervalue05 = "";
        }
        if ($recorduseranswer->lsitem06 == 1) {
            $recorduseranswervalue06 = "checked";
        }
        else {
            $recorduseranswervalue06 = "";
        }
        if ($recorduseranswer->lsitem07 == 1) {
            $recorduseranswervalue07 = "checked";
        }
        else {
            $recorduseranswervalue07 = "";
        }

    } else if ($record->fk_tqtc != 0) {
        $record = $DB->get_record('osa_instance_qtcheckbox', array('id' => $record->fk_tqtc));
        $recordid = $record->id;
        // Set $cm $qtype and $filearea.
        $cm = $cm;
        $cmid = $cm->id;
        $qtype = 'checkbox';
        $filearea = array(
            'cbtextdesc01',
            'cbtextdesc02',
            'cbtextdesc03',
            'cbtextdesc04',
            'cbtextdesc05',
            'cbtextdesc06',
            'cbtextdesc07',
            'cbtextdesc08',
            'cbtextdesc09',
            'cbtextdesc10'
        );
        // Set status of var to use it later in the template.
        $statusqtcheckbox = true;
        // Get data from db and rewrite URLs for question type.
        $recordvalue = get_data_from_question_db($record, $cm, $qtype, $filearea);
        $moveup = $recordvalue[3];
        $movedown = $recordvalue[4];
        $formlink_edit = $recordvalue[1];
        $formlink_delete = $recordvalue[2];
         $recordvalue01 = $recordvalue[0][0];
         $recordvalue02 = $recordvalue[0][1];
         $recordvalue03 = $recordvalue[0][2];
         $recordvalue04 = $recordvalue[0][3];
         $recordvalue05 = $recordvalue[0][4];
         $recordvalue06 = $recordvalue[0][5];
         $recordvalue07 = $recordvalue[0][6];
         $recordvalue08 = $recordvalue[0][7];
         $recordvalue09 = $recordvalue[0][8];
         $recordvalue10 = $recordvalue[0][9];
        // Get record for user answer.
        $recorduseranswer = $DB->get_record('osa_instance_qtcheckbox_a', array('fk_user' => $USER->id, 'fk_osa_instance_qtcheckbox' => $recordid, 'attempt' => $madeattempts));

        if ($recorduseranswer->cbitem01 == 1) {
            $recorduseranswervalue01 = "checked";
        }
        else {
            $recorduseranswervalue01 = "";
        }
        if ($recorduseranswer->cbitem02 == 1) {
            $recorduseranswervalue02 = "checked";
        }
        else {
            $recorduseranswervalue02 = "";
        }
        if ($recorduseranswer->cbitem03 == 1) {
            $recorduseranswervalue03 = "checked";
        }
        else {
            $recorduseranswervalue03 = "";
        }
        if ($recorduseranswer->cbitem04 == 1) {
            $recorduseranswervalue04 = "checked";
        }
        else {
            $recorduseranswervalue04 = "";
        }
        if ($recorduseranswer->cbitem05 == 1) {
            $recorduseranswervalue05 = "checked";
        }
        else {
            $recorduseranswervalue05 = "";
        }
        if ($recorduseranswer->cbitem06 == 1) {
            $recorduseranswervalue06 = "checked";
        }
        else {
            $recorduseranswervalue06 = "";
        }
        if ($recorduseranswer->cbitem07 == 1) {
            $recorduseranswervalue07 = "checked";
        }
        else {
            $recorduseranswervalue07 = "";
        }
        if ($recorduseranswer->cbitem08 == 1) {
            $recorduseranswervalue08 = "checked";
        }
        else {
            $recorduseranswervalue08 = "";
        }
        if ($recorduseranswer->cbitem09 == 1) {
            $recorduseranswervalue09 = "checked";
        }
        else {
            $recorduseranswervalue09 = "";
        }
        if ($recorduseranswer->cbitem10 == 1) {
            $recorduseranswervalue10 = "checked";
        }
        else {
            $recorduseranswervalue10 = "";
        }

//        $recorduseranswervalue = $recorduseranswer->textelementeditor;

    } else if ($record->fk_tqts != 0) {
        $record = $DB->get_record('osa_instance_qtslider', array('id' => $record->fk_tqts));
        $recordid = $record->id;
        // Set $cm $qtype and $filearea.
        $cm = $cm;
        $cmid = $cm->id;
        $qtype = 'slider';
        $filearea = 'ssdesceditor01';
        // Set status of var to use it later in the template.
        $statusqtslider = true;
        // Get data from db and rewrite URLs for question type.
        $recordvalue = get_data_from_question_db($record, $cm, $qtype, $filearea);
        $moveup = $recordvalue[3];
        $movedown = $recordvalue[4];
        $formlink_edit = $recordvalue[1];
        $formlink_delete = $recordvalue[2];
        $recordvalue = $recordvalue[0];
        // Get record for user answer.
        $recorduseranswer = $DB->get_record('osa_instance_qtslider_a', array('fk_user' => $USER->id, 'fk_osa_instance_qtslider' => $recordid, 'attempt' => $madeattempts));
        $recorduseranswervalue = $recorduseranswer->slider;
    }

$templatecontextsettingqttypes = (object)[
    'qtypetextelement' => $statusqttextelement,
    'qtypelikertscale' => $statusqtlikertscale,
    'qtypecheckbox' => $statusqtcheckbox,
    'qtypeslider' => $statusqtslider,
    'qtype' => $qtype,
    'recordid' => $recordid,
    'content' => $recordvalue,
    'content01' => $recordvalue01,
    'content02' => $recordvalue02,
    'content03' => $recordvalue03,
    'content04' => $recordvalue04,
    'content05' => $recordvalue05,
    'content06' => $recordvalue06,
    'content07' => $recordvalue07,
    'content08' => $recordvalue08,
    'content09' => $recordvalue09,
    'content10' => $recordvalue10,
    'content11' => $recordvalue11,
    'content12' => $recordvalue12,
    'content13' => $recordvalue13,
    'content14' => $recordvalue14,
    'content15' => $recordvalue15,
    'content16' => $recordvalue16,
    'content17' => $recordvalue17,
    'content18' => $recordvalue18,
    'content19' => $recordvalue19,
    'content20' => $recordvalue20,
    'edit' => $editable,
    'edit_form_link' => $formlink_edit,
    'delete_form_link' => $formlink_delete,
    'move_up_form_link' => $moveup,
    'move_down_form_link' => $movedown,
    'content_user_filled_in' => $recorduseranswervalue,
    'content_user_filled_in_01' => $recorduseranswervalue01,
    'content_user_filled_in_02' => $recorduseranswervalue02,
    'content_user_filled_in_03' => $recorduseranswervalue03,
    'content_user_filled_in_04' => $recorduseranswervalue04,
    'content_user_filled_in_05' => $recorduseranswervalue05,
    'content_user_filled_in_06' => $recorduseranswervalue06,
    'content_user_filled_in_07' => $recorduseranswervalue07,
    'content_user_filled_in_08' => $recorduseranswervalue08,
    'content_user_filled_in_09' => $recorduseranswervalue09,
    'content_user_filled_in_10' => $recorduseranswervalue10,
];


echo $OUTPUT->render_from_template('mod_osa/viewqttypesafterosa', $templatecontextsettingqttypes);

}


// Get all data necessary to give feedback.
// Get standard vals settings for categories set by teacher.
$setstandardval01 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category01;
$setstandardval02 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category02;
$setstandardval03 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category03;
$setstandardval04 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category04;
$setstandardval05 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category05;
$setstandardval06 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category06;
$setstandardval07 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category07;
$setstandardval08 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category08;
$setstandardval09 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category09;
$setstandardval10 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category10;
$setstandardval11 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category11;
$setstandardval12 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category12;
$setstandardval13 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category13;
$setstandardval14 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category14;
$setstandardval15 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category15;
$setstandardval16 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category16;
$setstandardval17 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category17;
$setstandardval18 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category18;
$setstandardval19 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category19;
$setstandardval20 = $DB->get_record('osa_cat_std_vals', array('fk_cmid' => $cm->id))->category20;
//var_dump("<br>\nsetstandardval01:", $setstandardval01, "<br>\n");

// Get already made attempts.
$madeattempts = osa_get_current_attempt($osa);
//var_dump("<br>\nmade attempts:", $madeattempts, "<br>\n");

// Get data of current user for each questiontype.
// Qtype collection.
$recordsqtypecoll = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id), 'category ASC');
// Get categories.
//foreach ($recordsqtypecoll as $collcategory) {
//var_dump("<br>\ncollcat:", $collcategory->category, "<br>\n");
//}

// General var.
$osaid = $osa->id;
// Textelement.
$textelementdatacurrentusercurrentattempt = $DB->get_records('osa_instance_qttextelement_a', array('fk_user' => $USER->id, 'attempt' => $madeattempts, 'fk_cmid' => $osaid));
$likertscaledatacurrentusercurrentattempt = $DB->get_records('osa_instance_qtlikertscale_a', array('fk_user' => $USER->id, 'attempt' => $madeattempts, 'fk_cmid' => $osaid));
$checkboxdatacurrentusercurrentattempt    = $DB->get_records('osa_instance_qtcheckbox_a', array('fk_user' => $USER->id, 'attempt' => $madeattempts, 'fk_cmid' => $osaid));
$sliderdatacurrentusercurrentattempt      = $DB->get_records('osa_instance_qtslider_a', array('fk_user' => $USER->id, 'attempt' => $madeattempts, 'fk_cmid' => $osaid));


// Get all other attempts from db for current user.
$textelementdatacurrentuser = $DB->get_records('osa_instance_qttextelement_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');
$likertscaledatacurrentuser = $DB->get_records('osa_instance_qtlikertscale_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');
$checkboxdatacurrentuser    = $DB->get_records('osa_instance_qtcheckbox_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');
$sliderdatacurrentuser      = $DB->get_records('osa_instance_qtslider_a', array('fk_user' => $USER->id, 'fk_cmid' => $osaid), 'attempt ASC');


$recordsqtypecollcat01 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 0));
$recordsqtypecollcat02 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 1));
$recordsqtypecollcat03 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 2));
$recordsqtypecollcat04 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 3));
$recordsqtypecollcat05 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 4));
$recordsqtypecollcat06 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 5));
$recordsqtypecollcat07 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 6));
$recordsqtypecollcat08 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 7));
$recordsqtypecollcat09 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 8));
$recordsqtypecollcat10 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 9));
$recordsqtypecollcat11 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 10));
$recordsqtypecollcat12 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 11));
$recordsqtypecollcat13 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 12));
$recordsqtypecollcat14 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 13));
$recordsqtypecollcat15 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 14));
$recordsqtypecollcat16 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 15));
$recordsqtypecollcat17 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 16));
$recordsqtypecollcat18 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 17));
$recordsqtypecollcat19 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 18));
$recordsqtypecollcat20 = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id, 'category' => 19));

//var_dump("<br>\n<br>\ncat01", $recordsqtypecollcat01, "<br>\n");



unset($recorduseranswervalue);


// Calculate data for boxplot.
list($datacat01median, $datacat01medianq01, $datacat01medianq03, $datacat01iqr, $datacat01min, $datacat01max, $datacat01stdval, $datacat01stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat01, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval01);
list($datacat02median, $datacat02medianq01, $datacat02medianq03, $datacat02iqr, $datacat02min, $datacat02max, $datacat02stdval, $datacat02stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat02, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval02);
list($datacat03median, $datacat03medianq01, $datacat03medianq03, $datacat03iqr, $datacat03min, $datacat03max, $datacat03stdval, $datacat03stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat03, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval03);
list($datacat04median, $datacat04medianq01, $datacat04medianq03, $datacat04iqr, $datacat04min, $datacat04max, $datacat04stdval, $datacat04stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat04, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval04);
list($datacat05median, $datacat05medianq01, $datacat05medianq03, $datacat05iqr, $datacat05min, $datacat05max, $datacat05stdval, $datacat05stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat05, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval05);
list($datacat06median, $datacat06medianq01, $datacat06medianq03, $datacat06iqr, $datacat06min, $datacat06max, $datacat06stdval, $datacat06stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat06, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval06);
list($datacat07median, $datacat07medianq01, $datacat07medianq03, $datacat07iqr, $datacat07min, $datacat07max, $datacat07stdval, $datacat07stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat07, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval07);
list($datacat08median, $datacat08medianq01, $datacat08medianq03, $datacat08iqr, $datacat08min, $datacat08max, $datacat08stdval, $datacat08stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat08, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval08);
list($datacat09median, $datacat09medianq01, $datacat09medianq03, $datacat09iqr, $datacat09min, $datacat09max, $datacat09stdval, $datacat09stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat09, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval09);
list($datacat10median, $datacat10medianq01, $datacat10medianq03, $datacat10iqr, $datacat10min, $datacat10max, $datacat10stdval, $datacat10stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat10, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval10);
list($datacat11median, $datacat11medianq01, $datacat11medianq03, $datacat11iqr, $datacat11min, $datacat11max, $datacat11stdval, $datacat11stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat11, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval11);
list($datacat12median, $datacat12medianq01, $datacat12medianq03, $datacat12iqr, $datacat12min, $datacat12max, $datacat12stdval, $datacat12stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat12, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval12);
list($datacat13median, $datacat13medianq01, $datacat13medianq03, $datacat13iqr, $datacat13min, $datacat13max, $datacat13stdval, $datacat13stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat13, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval13);
list($datacat14median, $datacat14medianq01, $datacat14medianq03, $datacat14iqr, $datacat14min, $datacat14max, $datacat14stdval, $datacat14stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat14, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval14);
list($datacat15median, $datacat15medianq01, $datacat15medianq03, $datacat15iqr, $datacat15min, $datacat15max, $datacat15stdval, $datacat15stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat15, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval15);
list($datacat16median, $datacat16medianq01, $datacat16medianq03, $datacat16iqr, $datacat16min, $datacat16max, $datacat16stdval, $datacat16stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat16, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval16);
list($datacat17median, $datacat17medianq01, $datacat17medianq03, $datacat17iqr, $datacat17min, $datacat17max, $datacat17stdval, $datacat17stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat17, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval17);
list($datacat18median, $datacat18medianq01, $datacat18medianq03, $datacat18iqr, $datacat18min, $datacat18max, $datacat18stdval, $datacat18stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat18, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval18);
list($datacat19median, $datacat19medianq01, $datacat19medianq03, $datacat19iqr, $datacat19min, $datacat19max, $datacat19stdval, $datacat19stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat19, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval19);
list($datacat20median, $datacat20medianq01, $datacat20medianq03, $datacat20iqr, $datacat20min, $datacat20max, $datacat20stdval, $datacat20stdvalvisibility) = osa_calculate_answer_data_for_boxplot($recordsqtypecollcat20, $madeattempts, $likertscaledatacurrentusercurrentattempt, $setstandardval20);

//var_dump($datacat01median, $datacat01medianq01, $datacat01medianq03, $datacat01iqr, $datacat01min, $datacat01max);

// Get individual value set by teacher. llc01 ulc01
// Get Median user input. $datacat01median

if ($datacat01median < $llc01) {
    $feedback01      = $feedbackcatll01desc;
    $feedback01color = 'red';
} else if ($datacat01median > $llc01 && $datacat01median < $ulc01) {
    $feedback01      = $feedbackcatblul01desc;
    $feedback01color = 'yellow';
} else if ($datacat01median > $ulc01) {
    $feedback01      = $feedbackcatul01desc;
    $feedback01color = 'green';
}


if ($datacat02median < $llc02) {
    $feedback02      = $feedbackcatll02desc;
    $feedback02color = 'red';
} else if ($datacat02median > $llc02 && $datacat02median < $ulc02) {
    $feedback02      = $feedbackcatblul02desc;
    $feedback02color = 'yellow';
} else if ($datacat02median > $ulc02) {
    $feedback02      = $feedbackcatul02desc;
    $feedback02color = 'green';
}


if ($datacat03median < $llc03) {
    $feedback03      = $feedbackcatll03desc;
    $feedback03color = 'red';
} else if ($datacat03median > $llc03 && $datacat03median < $ulc03) {
    $feedback03      = $feedbackcatblul03desc;
    $feedback03color = 'yellow';
} else if ($datacat03median > $ulc03) {
    $feedback03      = $feedbackcatul03desc;
    $feedback03color = 'green';
}
//var_dump("<br>\n<br>\nfeedback 02 color:", $feedback02color);

if ($datacat04median < $llc04) {
    $feedback04      = $feedbackcatll04desc;
    $feedback04color = 'red';
} else if ($datacat04median > $llc04 && $datacat04median < $ulc04) {
    $feedback04      = $feedbackcatblul04desc;
    $feedback04color = 'yellow';
} else if ($datacat04median > $ulc04) {
    $feedback04      = $feedbackcatul04desc;
    $feedback04color = 'green';
}


if ($datacat05median < $llc05) {
    $feedback05      = $feedbackcatll05desc;
    $feedback05color = 'red';
} else if ($datacat05median > $llc05 && $datacat05median < $ulc05) {
    $feedback05      = $feedbackcatblul05desc;
    $feedback05color = 'yellow';
} else if ($datacat05median > $ulc05) {
    $feedback05      = $feedbackcatul05desc;
    $feedback05color = 'green';
}


if ($datacat06median < $llc06) {
    $feedback06      = $feedbackcatll06desc;
    $feedback06color = 'red';
} else if ($datacat06median > $llc06 && $datacat06median < $ulc06) {
    $feedback06      = $feedbackcatblul06desc;
    $feedback06color = 'yellow';
} else if ($datacat06median > $ulc06) {
    $feedback06      = $feedbackcatul06desc;
    $feedback06color = 'green';
}


if ($datacat07median < $llc07) {
    $feedback07      = $feedbackcatll07desc;
    $feedback07color = 'red';
} else if ($datacat07median > $llc07 && $datacat07median < $ulc07) {
    $feedback07      = $feedbackcatblul07desc;
    $feedback07color = 'yellow';
} else if ($datacat07median > $ulc07) {
    $feedback07      = $feedbackcatul07desc;
    $feedback07color = 'green';
}


if ($datacat08median < $llc08) {
    $feedback08      = $feedbackcatll08desc;
    $feedback08color = 'red';
} else if ($datacat08median > $llc08 && $datacat08median < $ulc08) {
    $feedback08      = $feedbackcatblul08desc;
    $feedback08color = 'yellow';
} else if ($datacat08median > $ulc08) {
    $feedback08      = $feedbackcatul08desc;
    $feedback08color = 'green';
}


if ($datacat09median < $llc09) {
    $feedback09      = $feedbackcatll09desc;
    $feedback09color = 'red';
} else if ($datacat09median > $llc09 && $datacat09median < $ulc09) {
    $feedback09      = $feedbackcatblul09desc;
    $feedback09color = 'yellow';
} else if ($datacat09median > $ulc09) {
    $feedback09      = $feedbackcatul09desc;
    $feedback09color = 'green';
}


if ($datacat10median < $llc10) {
    $feedback10      = $feedbackcatll10desc;
    $feedback10color = 'red';
} else if ($datacat10median > $llc10 && $datacat10median < $ulc10) {
    $feedback10      = $feedbackcatblul10desc;
    $feedback10color = 'yellow';
} else if ($datacat10median > $ulc10) {
    $feedback10      = $feedbackcatul10desc;
    $feedback10color = 'green';
}


if ($datacat11median < $llc11) {
    $feedback11      = $feedbackcatll11desc;
    $feedback11color = 'red';
} else if ($datacat11median > $llc11 && $datacat11median < $ulc11) {
    $feedback11      = $feedbackcatblul11desc;
    $feedback11color = 'yellow';
} else if ($datacat11median > $ulc11) {
    $feedback11      = $feedbackcatul11desc;
    $feedback11color = 'green';
}


if ($datacat12median < $llc12) {
    $feedback12      = $feedbackcatll12desc;
    $feedback12color = 'red';
} else if ($datacat12median > $llc12 && $datacat12median < $ulc12) {
    $feedback12      = $feedbackcatblul12desc;
    $feedback12color = 'yellow';
} else if ($datacat12median > $ulc12) {
    $feedback12      = $feedbackcatul12desc;
    $feedback12color = 'green';
}


if ($datacat13median < $llc13) {
    $feedback13      = $feedbackcatll13desc;
    $feedback13color = 'red';
} else if ($datacat13median > $llc13 && $datacat13median < $ulc13) {
    $feedback13      = $feedbackcatblul13desc;
    $feedback13color = 'yellow';
} else if ($datacat13median > $ulc13) {
    $feedback13      = $feedbackcatul13desc;
    $feedback13color = 'green';
}


if ($datacat14median < $llc14) {
    $feedback14      = $feedbackcatll14desc;
    $feedback14color = 'red';
} else if ($datacat14median > $llc14 && $datacat14median < $ulc14) {
    $feedback14      = $feedbackcatblul14desc;
    $feedback14color = 'yellow';
} else if ($datacat14median > $ulc14) {
    $feedback14      = $feedbackcatul14desc;
    $feedback14color = 'green';
}


if ($datacat15median < $llc15) {
    $feedback15      = $feedbackcatll15desc;
    $feedback15color = 'red';
} else if ($datacat15median > $llc15 && $datacat15median < $ulc15) {
    $feedback15      = $feedbackcatblul15desc;
    $feedback15color = 'yellow';
} else if ($datacat15median > $ulc15) {
    $feedback15      = $feedbackcatul15desc;
    $feedback15color = 'green';
}


if ($datacat16median < $llc16) {
    $feedback16      = $feedbackcatll16desc;
    $feedback16color = 'red';
} else if ($datacat16median > $llc16 && $datacat16median < $ulc16) {
    $feedback16      = $feedbackcatblul16desc;
    $feedback16color = 'yellow';
} else if ($datacat16median > $ulc16) {
    $feedback16      = $feedbackcatul16desc;
    $feedback16color = 'green';
}


if ($datacat17median < $llc17) {
    $feedback17      = $feedbackcatll17desc;
    $feedback17color = 'red';
} else if ($datacat17median > $llc17 && $datacat17median < $ulc17) {
    $feedback17      = $feedbackcatblul17desc;
    $feedback17color = 'yellow';
} else if ($datacat17median > $ulc17) {
    $feedback17      = $feedbackcatul17desc;
    $feedback17color = 'green';
}


if ($datacat18median < $llc18) {
    $feedback18      = $feedbackcatll18desc;
    $feedback18color = 'red';
} else if ($datacat18median > $llc18 && $datacat18median < $ulc18) {
    $feedback18      = $feedbackcatblul18desc;
    $feedback18color = 'yellow';
} else if ($datacat18median > $ulc18) {
    $feedback18      = $feedbackcatul18desc;
    $feedback18color = 'green';
}


if ($datacat19median < $llc19) {
    $feedback19      = $feedbackcatll19desc;
    $feedback19color = 'red';
} else if ($datacat19median > $llc19 && $datacat19median < $ulc19) {
    $feedback19      = $feedbackcatblul19desc;
    $feedback19color = 'yellow';
} else if ($datacat19median > $ulc19) {
    $feedback19      = $feedbackcatul19desc;
    $feedback19color = 'green';
}


if ($datacat20median < $llc20) {
    $feedback20      = $feedbackcatll20desc;
    $feedback20color = 'red';
} else if ($datacat20median > $llc20 && $datacat20median < $ulc20) {
    $feedback20      = $feedbackcatblul20desc;
    $feedback20color = 'yellow';
} else if ($datacat20median > $ulc20) {
    $feedback20      = $feedbackcatul20desc;
    $feedback20color = 'green';
}


//var_dump("<br>\nfeedbackcolor cat 20:<br>\n", $feedback20color, "<br>\n");
//die;

$templatecontextsettingviewresults = (object)[
// URLs to d3 and plotly.
    'urld3'          => $getadminconfigd3,
    'urlplotly'      => $getadminconfigplotly,
// Assign data for median, q1, q3, iqr, min and max for every category.
//    'meanvaluels'    => $meanvaluelikertscalesum,
//    'data01'         => $data01,
    'mediancat01'         => $datacat01median,
    'mediancat02'         => $datacat02median,
    'mediancat03'         => $datacat03median,
    'mediancat04'         => $datacat04median,
    'mediancat05'         => $datacat05median,
    'mediancat06'         => $datacat06median,
    'mediancat07'         => $datacat07median,
    'mediancat08'         => $datacat08median,
    'mediancat09'         => $datacat09median,
    'mediancat10'         => $datacat10median,
    'mediancat11'         => $datacat11median,
    'mediancat12'         => $datacat12median,
    'mediancat13'         => $datacat13median,
    'mediancat14'         => $datacat14median,
    'mediancat15'         => $datacat15median,
    'mediancat16'         => $datacat16median,
    'mediancat17'         => $datacat17median,
    'mediancat18'         => $datacat18median,
    'mediancat19'         => $datacat19median,
    'mediancat20'         => $datacat20median,
    'q1cat01'             => $datacat01medianq01,
    'q1cat02'             => $datacat02medianq01,
    'q1cat03'             => $datacat03medianq01,
    'q1cat04'             => $datacat04medianq01,
    'q1cat05'             => $datacat05medianq01,
    'q1cat06'             => $datacat06medianq01,
    'q1cat07'             => $datacat07medianq01,
    'q1cat08'             => $datacat08medianq01,
    'q1cat09'             => $datacat09medianq01,
    'q1cat09'             => $datacat09medianq01,
    'q1cat10'             => $datacat10medianq01,
    'q1cat11'             => $datacat11medianq01,
    'q1cat12'             => $datacat12medianq01,
    'q1cat13'             => $datacat13medianq01,
    'q1cat14'             => $datacat14medianq01,
    'q1cat15'             => $datacat15medianq01,
    'q1cat16'             => $datacat16medianq01,
    'q1cat17'             => $datacat17medianq01,
    'q1cat18'             => $datacat18medianq01,
    'q1cat19'             => $datacat19medianq01,
    'q1cat20'             => $datacat20medianq01,
    'q3cat01'             => $datacat01medianq03,
    'q3cat02'             => $datacat02medianq03,
    'q3cat03'             => $datacat03medianq03,
    'q3cat04'             => $datacat04medianq03,
    'q3cat05'             => $datacat05medianq03,
    'q3cat06'             => $datacat06medianq03,
    'q3cat07'             => $datacat07medianq03,
    'q3cat08'             => $datacat08medianq03,
    'q3cat09'             => $datacat09medianq03,
    'q3cat10'             => $datacat10medianq03,
    'q3cat11'             => $datacat11medianq03,
    'q3cat12'             => $datacat12medianq03,
    'q3cat13'             => $datacat13medianq03,
    'q3cat14'             => $datacat14medianq03,
    'q3cat15'             => $datacat15medianq03,
    'q3cat16'             => $datacat16medianq03,
    'q3cat17'             => $datacat17medianq03,
    'q3cat18'             => $datacat18medianq03,
    'q3cat19'             => $datacat19medianq03,
    'q3cat20'             => $datacat20medianq03,
    'iqrcat01'            => $datacat01iqr,
    'iqrcat02'            => $datacat02iqr,
    'iqrcat03'            => $datacat03iqr,
    'iqrcat04'            => $datacat04iqr,
    'iqrcat05'            => $datacat05iqr,
    'iqrcat06'            => $datacat06iqr,
    'iqrcat07'            => $datacat07iqr,
    'iqrcat08'            => $datacat08iqr,
    'iqrcat09'            => $datacat09iqr,
    'iqrcat10'            => $datacat10iqr,
    'iqrcat11'            => $datacat11iqr,
    'iqrcat12'            => $datacat12iqr,
    'iqrcat13'            => $datacat13iqr,
    'iqrcat14'            => $datacat14iqr,
    'iqrcat15'            => $datacat15iqr,
    'iqrcat16'            => $datacat16iqr,
    'iqrcat17'            => $datacat17iqr,
    'iqrcat18'            => $datacat18iqr,
    'iqrcat19'            => $datacat19iqr,
    'iqrcat20'            => $datacat20iqr,
    'mincat01'            => $datacat01min,
    'mincat02'            => $datacat02min,
    'mincat03'            => $datacat03min,
    'mincat04'            => $datacat04min,
    'mincat05'            => $datacat05min,
    'mincat06'            => $datacat06min,
    'mincat07'            => $datacat07min,
    'mincat08'            => $datacat08min,
    'mincat09'            => $datacat09min,
    'mincat10'            => $datacat10min,
    'mincat11'            => $datacat11min,
    'mincat12'            => $datacat12min,
    'mincat13'            => $datacat13min,
    'mincat14'            => $datacat14min,
    'mincat15'            => $datacat15min,
    'mincat16'            => $datacat16min,
    'mincat17'            => $datacat17min,
    'mincat18'            => $datacat18min,
    'mincat19'            => $datacat19min,
    'mincat20'            => $datacat20min,
    'maxcat01'            => $datacat01max,
    'maxcat02'            => $datacat02max,
    'maxcat03'            => $datacat03max,
    'maxcat04'            => $datacat04max,
    'maxcat05'            => $datacat05max,
    'maxcat06'            => $datacat06max,
    'maxcat07'            => $datacat07max,
    'maxcat08'            => $datacat08max,
    'maxcat09'            => $datacat09max,
    'maxcat10'            => $datacat10max,
    'maxcat11'            => $datacat11max,
    'maxcat12'            => $datacat12max,
    'maxcat13'            => $datacat13max,
    'maxcat14'            => $datacat14max,
    'maxcat15'            => $datacat15max,
    'maxcat16'            => $datacat16max,
    'maxcat17'            => $datacat17max,
    'maxcat18'            => $datacat18max,
    'maxcat19'            => $datacat19max,
    'maxcat20'            => $datacat20max,
// Assign value defined by teacher.
    'definedcatval01'           => $datacat01stdval,
    'definedcatval02'           => $datacat02stdval,
    'definedcatval03'           => $datacat03stdval,
    'definedcatval04'           => $datacat04stdval,
    'definedcatval05'           => $datacat05stdval,
    'definedcatval06'           => $datacat06stdval,
    'definedcatval07'           => $datacat07stdval,
    'definedcatval08'           => $datacat08stdval,
    'definedcatval09'           => $datacat09stdval,
    'definedcatval10'           => $datacat10stdval,
    'definedcatval11'           => $datacat11stdval,
    'definedcatval12'           => $datacat12stdval,
    'definedcatval13'           => $datacat13stdval,
    'definedcatval14'           => $datacat14stdval,
    'definedcatval15'           => $datacat15stdval,
    'definedcatval16'           => $datacat16stdval,
    'definedcatval17'           => $datacat17stdval,
    'definedcatval18'           => $datacat18stdval,
    'definedcatval19'           => $datacat19stdval,
    'definedcatval20'           => $datacat20stdval,
    'definedcatval01visibility' => $datacat01stdvalvisibility,
    'definedcatval02visibility' => $datacat02stdvalvisibility,
    'definedcatval03visibility' => $datacat03stdvalvisibility,
    'definedcatval04visibility' => $datacat04stdvalvisibility,
    'definedcatval05visibility' => $datacat05stdvalvisibility,
    'definedcatval06visibility' => $datacat06stdvalvisibility,
    'definedcatval07visibility' => $datacat07stdvalvisibility,
    'definedcatval08visibility' => $datacat08stdvalvisibility,
    'definedcatval09visibility' => $datacat09stdvalvisibility,
    'definedcatval10visibility' => $datacat10stdvalvisibility,
    'definedcatval11visibility' => $datacat11stdvalvisibility,
    'definedcatval12visibility' => $datacat12stdvalvisibility,
    'definedcatval13visibility' => $datacat13stdvalvisibility,
    'definedcatval14visibility' => $datacat14stdvalvisibility,
    'definedcatval15visibility' => $datacat15stdvalvisibility,
    'definedcatval16visibility' => $datacat16stdvalvisibility,
    'definedcatval17visibility' => $datacat17stdvalvisibility,
    'definedcatval18visibility' => $datacat18stdvalvisibility,
    'definedcatval19visibility' => $datacat19stdvalvisibility,
    'definedcatval20visibility' => $datacat20stdvalvisibility,
//
    'meanvaluecat01' => $meanvaluecat01,
    'meanvaluecat02' => $meanvaluecat02,
    'meanvaluecat03' => $meanvaluecat03,
    'meanvaluecat04' => $meanvaluecat04,
    'meanvaluecat05' => $meanvaluecat05,
    'meanvaluecat06' => $meanvaluecat06,
    'meanvaluecat07' => $meanvaluecat07,
    'meanvaluecat08' => $meanvaluecat08,
    'meanvaluecat09' => $meanvaluecat09,
    'meanvaluecat10' => $meanvaluecat10,
    'meanvaluecat11' => $meanvaluecat11,
    'meanvaluecat12' => $meanvaluecat12,
    'meanvaluecat13' => $meanvaluecat13,
    'meanvaluecat14' => $meanvaluecat14,
    'meanvaluecat15' => $meanvaluecat15,
    'meanvaluecat16' => $meanvaluecat16,
    'meanvaluecat17' => $meanvaluecat17,
    'meanvaluecat18' => $meanvaluecat18,
    'meanvaluecat19' => $meanvaluecat19,
    'meanvaluecat20' => $meanvaluecat20,
// Assign name of categories.
    'namecat01'      => $osanamecat01,
    'namecat02'      => $osanamecat02,
    'namecat03'      => $osanamecat03,
    'namecat04'      => $osanamecat04,
    'namecat05'      => $osanamecat05,
    'namecat06'      => $osanamecat06,
    'namecat07'      => $osanamecat07,
    'namecat08'      => $osanamecat08,
    'namecat09'      => $osanamecat09,
    'namecat10'      => $osanamecat10,
    'namecat11'      => $osanamecat11,
    'namecat12'      => $osanamecat12,
    'namecat13'      => $osanamecat13,
    'namecat14'      => $osanamecat14,
    'namecat15'      => $osanamecat15,
    'namecat16'      => $osanamecat16,
    'namecat17'      => $osanamecat17,
    'namecat18'      => $osanamecat18,
    'namecat19'      => $osanamecat19,
    'namecat20'      => $osanamecat20,
// Assign category descriptions.
    'namecat01desc'  => $osanamecat01desc,
    'namecat02desc'  => $osanamecat02desc,
    'namecat03desc'  => $osanamecat03desc,
    'namecat04desc'  => $osanamecat04desc,
    'namecat05desc'  => $osanamecat05desc,
    'namecat06desc'  => $osanamecat06desc,
    'namecat07desc'  => $osanamecat07desc,
    'namecat08desc'  => $osanamecat08desc,
    'namecat09desc'  => $osanamecat09desc,
    'namecat10desc'  => $osanamecat10desc,
    'namecat11desc'  => $osanamecat11desc,
    'namecat12desc'  => $osanamecat12desc,
    'namecat13desc'  => $osanamecat13desc,
    'namecat14desc'  => $osanamecat14desc,
    'namecat15desc'  => $osanamecat15desc,
    'namecat16desc'  => $osanamecat16desc,
    'namecat17desc'  => $osanamecat17desc,
    'namecat18desc'  => $osanamecat18desc,
    'namecat19desc'  => $osanamecat19desc,
    'namecat20desc'  => $osanamecat20desc,
// Assign html ids of each category.
    'namecat01id'    => 'namecat01id',
    'namecat02id'    => 'namecat02id',
    'namecat03id'    => 'namecat03id',
    'namecat04id'    => 'namecat04id',
    'namecat05id'    => 'namecat05id',
    'namecat06id'    => 'namecat06id',
    'namecat07id'    => 'namecat07id',
    'namecat08id'    => 'namecat08id',
    'namecat09id'    => 'namecat09id',
    'namecat10id'    => 'namecat10id',
    'namecat11id'    => 'namecat11id',
    'namecat12id'    => 'namecat12id',
    'namecat13id'    => 'namecat13id',
    'namecat14id'    => 'namecat14id',
    'namecat15id'    => 'namecat15id',
    'namecat16id'    => 'namecat16id',
    'namecat17id'    => 'namecat17id',
    'namecat18id'    => 'namecat18id',
    'namecat19id'    => 'namecat19id',
    'namecat20id'    => 'namecat20id',
// Assign feedback descriptions.
    'feedback01'     => $feedback01,
    'feedback02'     => $feedback02,
    'feedback03'     => $feedback03,
    'feedback04'     => $feedback04,
    'feedback05'     => $feedback05,
    'feedback06'     => $feedback06,
    'feedback07'     => $feedback07,
    'feedback08'     => $feedback08,
    'feedback09'     => $feedback09,
    'feedback10'     => $feedback10,
    'feedback11'     => $feedback11,
    'feedback12'     => $feedback12,
    'feedback13'     => $feedback13,
    'feedback14'     => $feedback14,
    'feedback15'     => $feedback15,
    'feedback16'     => $feedback16,
    'feedback17'     => $feedback17,
    'feedback18'     => $feedback18,
    'feedback19'     => $feedback19,
    'feedback20'     => $feedback20,
// Assign feedback colors.
    'feedback01color' => $feedback01color,
    'feedback02color' => $feedback02color,
    'feedback03color' => $feedback03color,
    'feedback04color' => $feedback04color,
    'feedback05color' => $feedback05color,
    'feedback06color' => $feedback06color,
    'feedback07color' => $feedback07color,
    'feedback08color' => $feedback08color,
    'feedback09color' => $feedback09color,
    'feedback10color' => $feedback10color,
    'feedback11color' => $feedback11color,
    'feedback12color' => $feedback12color,
    'feedback13color' => $feedback13color,
    'feedback14color' => $feedback14color,
    'feedback15color' => $feedback15color,
    'feedback16color' => $feedback16color,
    'feedback17color' => $feedback17color,
    'feedback18color' => $feedback18color,
    'feedback19color' => $feedback19color,
    'feedback20color' => $feedback20color,
];

echo $OUTPUT->render_from_template('mod_osa/viewresults', $templatecontextsettingviewresults);



$templatecontextsettingstaticgeneratepdf = (object)[
    'generateurl' => new moodle_url('./generate_user_pdf.php', ['cmid' => $cm->id]),
    'generatepdf' => get_string('generatepdf', 'mod_osa'),
];

echo $OUTPUT->render_from_template('mod_osa/viewgeneratepdf', $templatecontextsettingstaticgeneratepdf);

echo $OUTPUT->footer();
