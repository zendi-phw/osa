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
 * Prints an instance of mod_osa.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');
require_once(__DIR__.'/../../lib/filelib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

global $PAGE, $DB, $CFG, $OUTPUT; $USER;

// Course module id.
$id = optional_param('id', 0, PARAM_INT);

// Activity instance id.
$o = optional_param('o', 0, PARAM_INT);

if ($id) {
    $cm = get_coursemodule_from_id('osa', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $moduleinstance = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST);
} else {
    $moduleinstance = $DB->get_record('osa', array('id' => $o), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $moduleinstance->course), '*', MUST_EXIST);
    $cm = get_coursemodule_from_instance('osa', $moduleinstance->id, $course->id, false, MUST_EXIST);
}

//$DB->set_debug(true);

require_login($course, true, $cm);

$modulecontext = context_module::instance($cm->id);

// Event and event trigger.
$event = \mod_osa\event\course_module_viewed::create(array(
    'objectid' => $moduleinstance->id,
    'context' => $modulecontext
    )
);

$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('osa', $moduleinstance);
$event->trigger();

// Set PAGE properties.
$PAGE->set_url('/mod/osa/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($moduleinstance->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($modulecontext);
$PAGE->add_body_class('limitedwidth');
//$PAGE->requires->js_call_amd('mod_osa/somefile.min.js', 'init');

// Set context.
$context = context_module::instance($cm->id);


// Check for capability of current user. If user is allowed to edit then return true else return false. Makes edit and delete option visible via mustache and template object.
if ($PAGE->user_is_editing() && has_capability('mod/osa:edit', $context)) {
    $editable = true;
} else {
    $editable = false;
}

// Get config settings from adminsettings.
// Get config of admin settings wether questiontype is allowed.
// When questiontype is deactivated in admin settings old questions are kept. Only new instances of questions are affected.
$getadminconfigcheckbox = get_config('mod_osa', 'questiontypecheckbox');
$getadminconfiglikertscale = get_config('mod_osa', 'questiontypelikert');
$getadminconfigslider = get_config('mod_osa', 'questiontypeslider');
$getadminconfigtextelement = get_config('mod_osa', 'questiontypetext');

    if ($getadminconfigcheckbox == 1) {
        $cfgcheckbox = true;
    }
    else {
        $cfgcheckbox = false;
    }

    if ($getadminconfiglikertscale == 1) {
        $cfglikert = true;
    }
    else {
        $cfglikert = false;
    }

    if ($getadminconfigslider == 1) {
        $cfgslider = true;
    }
    else {
        $cfgslider = false;
    }

    if ($getadminconfigtextelement == 1) {
        $cfgtext = true;
    }
    else {
        $cfgtext = false;
    }


// Get username of current user.
$usernamevalue = $USER->username;

// Get data from osa instance.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST);

// Get data from DB for each question type.
$recordsqtcheckbox = $DB->get_records('osa_instance_qtcheckbox', array('fk_qtc' => $cm->id));
$recordsqtlikertscale = $DB->get_records('osa_instance_qtlikertscale', array('fk_qtls' => $cm->id));
$recordsqtslider = $DB->get_records('osa_instance_qtslider', array('fk_qts' => $cm->id));
$recordsqttextelement = $DB->get_records('osa_instance_qttextelement', array('fk_qtt' => $cm->id));

// Get data from osa instance DB for optional text.
$textoptionalvalue = $DB->get_field('osa', 'osasettingtextoptional', array('id' => $cm->instance), '*', MUST_EXIST);

$options = array('noclean' => true, 'para' => false, 'filter' => $filter, 'context' => $context, 'overflowdiv' => true);
$textoptionalvalue = file_rewrite_pluginfile_urls($osa->osasettingtextoptional, 'pluginfile.php', $context->id, 'mod_osa', 'osasettingtextoptional', 0);
$textoptionalvalue = trim(format_text($textoptionalvalue, $osa->osasettingtextoptionalformat, $options, null));

// Get data from osa instance DB for optional image.
// Param 0: Context id.
// Param 1: Name of filearea.
// Param 2: Element id is always 0 as there is only one file allowed.
$imageoptionalvalue = osa_get_image_link($context->id, 'osasettingimageoptional', '0');


// Get project title.
$titleprojectvalue = $DB->get_field('osa', 'researchtitle', array('id' => $cm->instance), '*', MUST_EXIST);


// Create view for editing for teacher role after first basic setting.
// General settings.
$templatecontextsettingsstaticcontentsgeneralsettings = (object)[
    'title' => get_string('templategeneralsettingstitle', 'mod_osa'),
    'textoptional' => $textoptionalvalue, // Get from DB.
    'imageoptional' => $imageoptionalvalue, // Get from DB.
//    'imageoptional' => $testausgabe,
//    'imageoptional' => 'Optional image', // Get from DB. ToDo: Get data from db and replace hard coded info with info from db.
//    'textgeneral' => get_string('templategeneralsettingstextgeneral', 'mod_osa'),
];

// Identification settings.
$templatecontextsettingsstaticcontentidentificationsettings = (object)[
    'titleid' => get_string('templatestaticcontentidentificationsettingstitleid', 'mod_osa'),
    'textidtext' => get_string('templatestaticcontentidentificationsettingstextidtext', 'mod_osa'),
    'textidfzero' => 'Feature zero',
    'textidfone' => 'Feature one',
];

// Research settings.
$templatecontextsettingsstaticcontentresearchsettings = (object)[
//  Commented static value for username  'username' => 'Testusername', // Get from DB.
    'username' => $usernamevalue,
    'titleresearchsettings' => get_string('templatestaticcontentresearchsettingstitleresearchsettings', 'mod_osa'),
//  Commented static value for project title  'titleproject' => 'Project title', // Get from DB.
    'titleproject' => $titleprojectvalue, // Get from DB.
];

// Save settings.
$templatecontextsettingsstaticsavebuttons = (object)[
    'save' => get_string('templatestaticcontentsavebuttonssave', 'mod_osa'),
    'discard' => get_string('templatestaticcontentsavebuttonsdiscard', 'mod_osa'),
];

// Testsettings.
$templatetest = (object)[
    'testobject' => 'Testobject',
];

$templatecontextsettingsstaticcontentbutton = (object)[
    'buttondescriptionqc' => get_string('buttondescqc', 'mod_osa'),
    'buttondescriptionql' => get_string('buttondescql', 'mod_osa'),
    'buttondescriptionqs' => get_string('buttondescqs', 'mod_osa'),
    'buttondescriptionqt' => get_string('buttondescqt', 'mod_osa'),
    'urlqc' => new moodle_url('./edit_questiontype_checkbox.php', ['cmid' => $cm->id]),
    'urlql' => new moodle_url('./edit_questiontype_likert_scale.php', ['cmid' => $cm->id]),
    'urlqs' => new moodle_url('./edit_questiontype_slider.php', ['cmid' => $cm->id]),
    'urlqt' => new moodle_url('./edit_questiontype_textelement.php', ['cmid' => $cm->id]),
// Set false or true depending on admin config setting.
    'cfgqc' => $cfgcheckbox,
    'cfgql' => $cfglikert,
    'cfgqs' => $cfgslider,
    'cfgqt' => $cfgtext,
];

//$templatecontextsettingstaticgeneratepdf = (object)[
//    'generateurl' => new moodle_url('./generate_user_pdf.php', ['cmid' => $cm->id]),
//    'generatepdf' => get_string('generatepdf', 'mod_osa'),
//
//];

$templatecontextsettingstaticviewcategorysettings = (object)[
    'buttondescriptioncatsettings' => get_string('buttondesccatsettings', 'mod_osa'),
    'urlcatsettings' => new moodle_url('./edit_allocation_categories_qtypes.php', ['cmid' => $cm->id]),
];

$templatecontextsettingstaticviewcategorystandardcategoryvaluessettings = (object)[
    'buttondescriptioncatstandardvaluessettings' => get_string('buttondesccatstandardvaluesettings', 'mod_osa'),
    'urlcatstandardvaluessettings' => new moodle_url('./edit_standard_category_values_categories.php', ['cmid' => $cm->id]),
];

$templatecontextsettingstaticviewcategoryfeedbacksettings = (object)[
    'buttondescriptioncatfeedbacksettings' => get_string('buttondesccatfeedbacksettings', 'mod_osa'),
    'urlcatfeedbacksettings' => new moodle_url('./edit_cat_feedback_settings.php', ['cmid' => $cm->id]),
];


// Check if a user is allowed to continue.
// Get user id.
$userid = $USER->id;
// Get allowed attempts.
var_dump($osa->id);
$allowedattempts = $DB->get_field('osa', 'allowedattempts', array('id' => $cm->instance), '*', MUST_EXIST);
$maxattempts = $allowedattempts;
if ($maxattempts == 0) {
    $maxattempts = get_string('unlimited', 'mod_osa');
}
// Get already made attempts.
$madeattempts = osa_get_current_attempt($osa);
// Get lastattempttime for current user.
$lastattempttime = osa_get_current_attempt_timecreated($osa);
//var_dump("<br>\nlastattempttime:", $lastattempttime);
// Get value for allowed next completion
$nextallowedcompletionval = $DB->get_field('osa', 'nextcompletionindays', array('id' => $cm->instance), '*', MUST_EXIST);
//var_dump("<br>\nnext allowed completion val:", $nextallowedcompletionval);
$timestampnextallowedattempt = $lastattempttime + $nextallowedcompletionval;
//var_dump("<br>\nnextallowedattempt:", $timestampnextallowedattempt);
//var_dump(date("Y-m-d-i-s", $timestampnextallowedattempt));
//die;
//
$currenttime = time();
//var_dump("<br>\ncurrenttime:", $currenttime);
//var_dump("<br>\ncurrenttime:", date("Y-m-d-i-s", $currenttime));
//die;
$nextattemptavailablein = $timestampnextallowedattempt-$currenttime;
$nextattemptavailableindate = sprintf('%d:%02d:%02d:%02d', $nextattemptavailablein/86400, $nextattemptavailablein/3600%24, $nextattemptavailablein/60%60, $nextattemptavailablein%60);
//$nextattemptavailableindate = date("s", $nextattemptavailablein);
//var_dump("<br>\nnext attempt available in", $nextattemptavailablein);
//var_dump("<br>\nnext attempt available in days hours minutes seconds", $nextattemptavailableindate);
//die;
if ((($nextattemptavailablein <= 0) && ($madeattempts <= $maxattempts)) || (($nextattemptavailablein <= 0) && ($maxattempts == 0))) {

$statusavailable = true;
//var_dump("<br>\nstatusavailable:", $statusavailable);
}
else {
$statusavailable = false;
//var_dump("<br>\nstatusavailable:", $statusavailable);
}

// Get current user role.
$getcurrentusersrole = get_user_roles($context, $USER->id);
foreach ($getcurrentusersrole as $role) {
    $getcurrentusersrole = $role->roleid;
}


$templatecontextsettingnextattempt = (object)[
    'nextattemptavailablein' => get_string('nextattemptavailablein', 'mod_osa'),
    'nextattemptavailableinval' => $nextattemptavailableindate,
    'madeattempts' => get_string('madeattempts', 'mod_osa'),
    'madeattemptsval' => $madeattempts,
    'maxattempts' => get_string('maxattempts', 'mod_osa'),
    'maxattemptsval' => $maxattempts,
];

// Display PAGE.

echo $OUTPUT->header();


// Added capability definition in access.php.
// If editing is turned on and capability edit is given show buttons for adding qtypes and allocating qtypes to categories.

if ($PAGE->user_is_editing() && has_capability('mod/osa:edit', $context)) {

    echo $OUTPUT->render_from_template('mod_osa/viewbuttonsettings', $templatecontextsettingsstaticcontentbutton);

    echo $OUTPUT->render_from_template('mod_osa/viewcategorysettings', $templatecontextsettingstaticviewcategorysettings);

    echo $OUTPUT->render_from_template('mod_osa/viewstandardcategoryvaluessettings', $templatecontextsettingstaticviewcategorystandardcategoryvaluessettings);
    echo $OUTPUT->render_from_template('mod_osa/viewstandardcategoryfeedbacksettings', $templatecontextsettingstaticviewcategoryfeedbacksettings);

//echo $OUTPUT->render_from_template('mod_osa/viewinfonextattempt', $templatecontextsettingnextattempt);


}

// Check if a user is allowed to continue.

// If editing is on show all to manager coursecreator editingteacher and teacher else show only forms
if (($PAGE->user_is_editing() != true && $statusavailable == true) || ($PAGE->user_is_editing() != false && $statusavailable == true) || ($PAGE->user_is_editing() != false && $statusavailable == false)) {
//if ($PAGE->user_is_editing() != true) {

// Add html to save form later.

echo "<form method=\"post\" action=\"save.php\" id=\"osaform\">";
echo '<div>';
echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";


// Render template for general text and later comparison: Is it still needed?

echo $OUTPUT->render_from_template('mod_osa/viewgeneralsettings', $templatecontextsettingsstaticcontentsgeneralsettings);

//echo $OUTPUT->render_from_template('mod_osa/viewidentificationsettings', $templatecontextsettingsstaticcontentidentificationsettings);


// Give context again.

$context = context_module::instance($cm->id);

// Sort records in array according to sort entry in osa_qtype_collection.
$recordsqtypecoll = $DB->get_records('osa_qtype_collection', array('fk_cmid' => $cm->id), 'sort ASC');

// Get current attempt.
$currentattempt = osa_get_current_attempt($osa);

$currentattempttodisplaytouser = $currentattempt+1;
//var_dump("<br>\ncurrentattempttodisplaytouser:", $currentattempttodisplaytouser);


// Set up loop through qtype_collection data.
$records = $recordsqtypecoll;

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
//        $recordvalue = $recordvalue[0];
        $recordvaluestepscontent = $recordvalue[0];
        $recordvalue01 = $recordvalue[0][0];
        $recordvalue02 = $recordvalue[0][1];
        $recordvalue03 = $recordvalue[0][2];
        $recordvalue04 = $recordvalue[0][3];
        $recordvalue05 = $recordvalue[0][4];
        $recordvalue06 = $recordvalue[0][5];
        $recordvalue07 = $recordvalue[0][6];
//        $recordqtlikertscale = $DB->get_record('osa_instance_qtlikertscale', array('id' => $record->fk_tqtls));
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
//        $recordvalue = $recordvalue[0];
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
//var_dump($recordvalue);
//        $recordqtcheckbox = $DB->get_record('osa_instance_qtcheckbox', array('id' => $record->fk_tqtc));
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
//        $recordqtslider = $DB->get_record('osa_instance_qtslider', array('id' => $record->fk_tqts));
    }

// Set move up and down url to reorganize data in osa_qtype_collection
//    $moveup = new moodle_url('./edit_questiontype_move_up.php', ['cmid' => $cm->id]);
//    $movedown = new moodle_url('./edit_questiontype_move_down.php', ['cmid' => $cm->id]);

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
];

echo $OUTPUT->render_from_template('mod_osa/viewqttypes', $templatecontextsettingqttypes);

}



//echo $OUTPUT->render_from_template('mod_osa/viewresearchsettings', $templatecontextsettingsstaticcontentresearchsettings);

//echo $OUTPUT->render_from_template('mod_osa/viewsavebuttons', $templatecontextsettingsstaticsavebuttons);


echo '<input type="submit" class="btn btn-primary" value="'. get_string("submit"). '" />';

echo "</form>";

echo "<hr>";

//echo $OUTPUT->render_from_template('mod_osa/viewgeneratepdf', $templatecontextsettingstaticgeneratepdf);
}

else {

echo $OUTPUT->render_from_template('mod_osa/viewinfonextattempt', $templatecontextsettingnextattempt);

}

echo $OUTPUT->footer();
