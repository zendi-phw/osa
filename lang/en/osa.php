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
 * Plugin strings are defined here.
 *
 * @package     mod_osa
 * @category    string
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

//
// Adminsettings lang strings.
$string['pluginname'] = 'Online Self Assessment';
$string['manage'] = 'Manage';

$string['osaadminsettingsdashboardheading'] = 'OSA dashboard';
$string['osaadminsettingsdashboardheadingdesc'] = 'Settings OSA dashboard';
$string['amountosadashboard'] = 'OSA elements shown in dashboard';
$string['amountosadashboarddesc'] = 'OSA elements shown in dashboard: done, in progress, not yet started';

$string['osaadminsettingssharingoptions'] = 'OSA Sharing options';
$string['osaadminsettingssharingoptionsdesc'] = 'Sharing options for teachers';
$string['osaadminsettingallowsharing'] = 'Allow sharing for teachers';
$string['osaadminsettingallowsharingdesc'] = 'OSA base construct is allowed to be used by other teachers';


$string['osaadminsettingsquestiontypeoptions'] = 'OSA Question types general settings';
$string['osaadminsettingsquestiontypeoptionsdesc'] = 'Activated question types';
$string['allowquestiontypecheckbox'] = 'Allow question type checkbox';
$string['allowquestiontypecheckboxdesc'] = 'Allow usage of checkboxes in OSA';
$string['allowquestiontypelikert'] = 'Allow question type likert scale';
$string['allowquestiontypelikertdesc'] = 'Allow usage of likert scales in OSA';
$string['allowquestiontypetext'] = 'Allow question type text';
$string['allowquestiontypetextdesc'] = 'Allow usage of text in OSA';
$string['allowquestiontypeslider'] = 'Allow question type slider';
$string['allowquestiontypesliderdesc'] = 'Allow usage of sliders in OSA';
$string['osaadminsettingsquestiontypestandardsettings'] = 'OSA Question types standard settings';
$string['osaadminsettingsquestiontypestandardsettingsdesc'] = 'Standard settings question types';
$string['osaadminsettingsquestiontypestandardsettingscheckbox'] = 'Amount of checkbox elements';
$string['osaadminsettingsquestiontypestandardsettingscheckboxdesc'] = 'Amount of checkbox elements standard value';
$string['osaadminsettingsquestiontypestandardsettingslikert'] = 'Amount of likert elements';
$string['osaadminsettingsquestiontypestandardsettingslikertdesc'] = 'Amount of likert elements standard value';
$string['osaadminsettingsquestiontypestandardsettingsslider'] = 'Amount of slider elements';
$string['osaadminsettingsquestiontypestandardsettingssliderdesc'] = 'Amount of slider elements standard value';
$string['osaadminsettingsresultcategorystandardsettings'] = 'OSA Result category standard settings';
$string['osaadminsettingsresultcategorystandardsettingsdesc'] = 'Standard settings result category';
$string['osaadminsettingsresultcategorystandardsettingsamount'] = 'OSA Amount of result category standard settings';
$string['osaadminsettingsresultcategorystandardsettingsamountdesc'] = 'Standard settings amount result category';
$string['osaadminstructuralsettings'] = 'OSA Structural settings';
$string['osaadminstructuralsettingsdesc'] = 'Standard settings structure';
$string['osaadminstructuralsettingpagenumberingstandardsetting'] = 'OSA Standard setting automatic page numbering activated';
$string['osaadminstructuralsettingpagenumberingstandardsettingdesc'] = 'Standard setting automatic page numbering activated';

$string['osaadminlibrarysettings'] = 'OSA External library settings';
$string['osaadminlibrarysettingsdesc'] = 'Standard settings external libraries: To make graphics work both libraries are necessary';
$string['osaadminsettingurld3'] = 'URL for d3';
$string['osaadminsettingurld3desc'] = 'For license please see: https://github.com/d3/d3/blob/main/LICENSE';
$string['osaadminsettingurlplotly'] = 'URL for plotly';
$string['osaadminsettingurlplotlydesc'] = 'For license please see: https://github.com/plotly/plotly.js/blob/master/LICENSE';


// Create activity in course teacher view lang strings.

$string['pluginadministration'] = 'OSA plugin administration';
$string['osaname'] = 'OSA title';
$string['osaname_help'] = 'OSA add title';
$string['general'] = 'Online Self Assessment';
$string['modulename'] = 'Online Self Assessment';
$string['modulenameplural'] = 'Online Self Assessments';
$string['osasettings'] = 'Settings';
// General schema $string[] = '';
//
// First creation of osa by teacher lang strings.
$string['osasettingtexteditoptional'] = 'Text (optional)';
$string['osasettingattachmentimageoptional'] = 'Image (optional)';

$string['osasettingnamecat'] = 'Competence categories';
$string['namecat01'] = 'Category 1';
$string['namecat02'] = 'Category 2';
$string['namecat03'] = 'Category 3';
$string['namecat04'] = 'Category 4';
$string['namecat05'] = 'Category 5';
$string['namecat06'] = 'Category 6';
$string['namecat07'] = 'Category 7';
$string['namecat08'] = 'Category 8';
$string['namecat09'] = 'Category 9';
$string['namecat10'] = 'Category 10';
$string['namecat11'] = 'Category 11';
$string['namecat12'] = 'Category 12';
$string['namecat13'] = 'Category 13';
$string['namecat14'] = 'Category 14';
$string['namecat15'] = 'Category 15';
$string['namecat16'] = 'Category 16';
$string['namecat17'] = 'Category 17';
$string['namecat18'] = 'Category 18';
$string['namecat19'] = 'Category 19';
$string['namecat20'] = 'Category 20';
$string['osanamecateditor'] = 'Category description';

$string['osasettingattempts'] = 'Attempts';
$string['allowedattempts'] = 'Allowed attempts';
$string['allowedattempts_help'] = '0 = Infinite attempts';
$string['duration'] = 'Time until consecutive OSA is allowed to be filled in';
$string['nextcompletionindays_help'] = '0 = No restriction until consecutive OSA is allowed to be filled in';


$string['osasettingidentification'] = 'Identification';
$string['osasettingidentificationone'] = 'Identification feature 1';
$string['osasettingidentificationtwo'] = 'Identification feature 2';
$string['idfeaturezero'] = 'Identification featureselection 0';
$string['idfeatureone'] = 'Identification featureselection 1';
$string['idfeaturetwo'] = 'Identification featureselection 2';


$string['osasettingpeerevaluation'] = 'Peer evaluation';
$string['osasettingpeerevaluationenable'] = 'Enable peer evaluation';

$string['osasettingconsentresearch'] = 'Research';
$string['osasettingconsentresearchenableconsentform'] = 'Show research request prompt form';

$string['osasettingreusage'] = 'Reusage';
$string['osasettingreusageenable'] = 'Provide OSA as template for other users within this moodle site';


$string['researchtitle'] = 'Title of project / lesson';

//
// General lang strings.
$string['yes'] = 'Yes';
$string['no'] = 'No';
$string['amount'] = 'Amount';
$string['amountdesc'] = 'Amount allowed';
$string['unlimited'] = 'Unlimited';
$string['noselection'] = 'Nothing selected';
// General lang strings: Numbers.
$string['one'] = '01';
$string['two'] = '02';
$string['three'] = '03';
$string['four'] = '04';
$string['five'] = '05';
$string['six'] = '06';
$string['seven'] = '07';
$string['eight'] = '08';
$string['nine'] = '09';
$string['ten'] = '10';
$string['eleven'] = '11';
$string['twelve'] = '12';
$string['thirteen'] = '13';
$string['fourteen'] = '14';
$string['fifteen'] = '15';
$string['sixteen'] = '16';
$string['seventeen'] = '17';
$string['eighteen'] = '18';
$string['nineteen'] = '19';
$string['twenty'] = '20';
$string['twentyone'] = '21';
$string['twentytwo'] = '22';
$string['twentythree'] = '23';
$string['twentyfour'] = '24';
$string['twentyfive'] = '25';
$string['twentysix'] = '26';
$string['twentyseven'] = '27';
$string['twentyeight'] = '28';
$string['twentynine'] = '29';
$string['thirty'] = '30';
$string['thirtyone'] = '31';
$string['thirtytwo'] = '32';
$string['thirtythree'] = '33';
$string['thirtyfour'] = '34';
$string['thirtyfive'] = '35';
$string['thirtysix'] = '36';
$string['thirtyseven'] = '37';
$string['thirtyeight'] = '38';
$string['thirtynine'] = '39';
$string['fourty'] = '40';
$string['fourtyone'] = '41';
$string['fourtytwo'] = '42';
$string['fourtythree'] = '43';
$string['fourtyfour'] = '44';
$string['fourtyfive'] = '45';
$string['fourtysix'] = '46';
$string['fourtyseven'] = '47';
$string['fourtyeight'] = '48';
$string['fourtynine'] = '49';
$string['fifty'] = '50';
$string['fiftyone'] = '51';
$string['fiftytwo'] = '52';
$string['fiftythree'] = '53';
$string['fiftyfour'] = '54';
$string['fiftyfive'] = '55';
$string['fiftysix'] = '56';
$string['fiftyseven'] = '57';
$string['fiftyeight'] = '58';
$string['fiftynine'] = '59';
$string['sixty'] = '60';
$string['sixtyone'] = '61';
$string['sixtytwo'] = '62';
$string['sixtythree'] = '63';
$string['sixtyfour'] = '64';
$string['sixtyfive'] = '65';
$string['sixtysix'] = '66';
$string['sixtyseven'] = '67';
$string['sixtyeight'] = '68';
$string['sixtynine'] = '69';
$string['seventy'] = '70';
$string['seventyone'] = '71';
$string['seventytwo'] = '72';
$string['seventythree'] = '73';
$string['seventyfour'] = '74';
$string['seventyfive'] = '75';
$string['seventysix'] = '76';
$string['seventyseven'] = '77';
$string['seventyeight'] = '78';
$string['seventynine'] = '79';
$string['eighty'] = '80';
$string['eightyone'] = '81';
$string['eightytwo'] = '82';
$string['eightythree'] = '83';
$string['eightyfour'] = '84';
$string['eightyfive'] = '85';
$string['eightysix'] = '86';
$string['eightyseven'] = '87';
$string['eightyeight'] = '88';
$string['eightynine'] = '89';
$string['ninety'] = '90';
$string['ninetyone'] = '91';
$string['ninetytwo'] = '92';
$string['ninetythree'] = '93';
$string['ninetyfour'] = '94';
$string['ninetyfive'] = '95';
$string['ninetysix'] = '96';
$string['ninetyseven'] = '97';
$string['ninetyeight'] = '98';
$string['ninetynine'] = '99';
$string['onehundred'] = '100';
// General lang strings: Success Fail
$string['successdel'] = 'Content successfully deleted';
$string['faileddel'] = 'Error when deleting detected';
//
//
// Event lang strings.
$string['eventosabasicstructurecreated'] = 'OSA basic structure created';
$string['eventosabasicstructurecreateddesc'] = 'OSA basic structure created description';
$string['coursemoduleviewed'] = 'OSA is viewed';
$string['coursemodulevieweddesc'] = 'Is triggered when OSA is viewed';
//
//
// View results page lang strings.
$string['viewresults'] = 'View results OSA';
//
//
// Mustache lang strings.
// Strings $templatecontextsettingsstaticcontentsgeneralsettings.
$string['templategeneralsettingstitle'] = 'Introduction';
$string['templategeneralsettingstextgeneral'] = 'General text';
// Strings $templatecontextsettingsstaticcontentidentificationsettings.
$string['templatestaticcontentidentificationsettingstitleid'] = 'Question title';
$string['templatestaticcontentidentificationsettingstextidtext'] = 'For later camparison two anonymous data are required';
// Strings $templatecontextsettingsstaticcontentresearchsettings.
$string['templatestaticcontentresearchsettingstitleresearchsettings'] = 'T and C for use in Research';
// Strings $templatecontextsettingsstaticcontentbutton.
$string['buttondescqc'] = 'Add questiontype checkbox';
$string['buttondescql'] = 'Add questiontype likert scale';
$string['buttondescqs'] = 'Add questiontype slider';
$string['buttondescqt'] = 'Add questiontype textelement';
// Strings $templatecontextsettingsstaticsavebuttons.
$string['templatestaticcontentsavebuttonssave'] = 'Save';
$string['templatestaticcontentsavebuttonsdiscard'] = 'Discard';
//
// Strings $templatecontextsettingstaticviewcategorysettings.
$string['buttondesccatsettings'] = 'Allocate qtypes to categories';
//
// Strings $templatecontextsettingstaticviewcategorystandardcategoryvaluessettings.
$string['buttondesccatstandardvaluesettings'] = 'Set standard values for categories';
//
// Strings $templatecontextsettingstaticviewcategoryfeedbacksettings.
$string['buttondesccatfeedbacksettings'] = 'Set standard feedback settings for categories';
//
// Strings $templatecontextsettingnextattempt.
$string['nextattemptavailablein'] = 'Next attempt available in';
$string['madeattempts'] = 'Already made attempts';
$string['maxattempts'] = 'Max attempts available';
//
// Check rights/capability lang strings.
$string['osa:view'] = 'View OSA';
$string['osa:edit'] = 'Edit OSA';
//
// Edit forms for teacher view.
// Type textelement.
$string['pagetitleedittextelement'] = 'Edit textelement properties';
$string['textelementheadername'] = 'Textelement name';
$string['textelementname'] = 'Name';
$string['textelement'] = 'Textelement:';
$string['textelementtextarea'] = 'Text';
// Type likertscale.
$string['pagetitleeditlikert'] = 'Edit likert scale properties';
$string['likerttextelement'] = 'Likert scale';
$string['amountlikertscalesteps'] = 'Likert scale steps';
$string['likertname'] = 'Likert scale name';
$string['likertscalename'] = 'Name';
$string['likertheaderstep1'] = 'Step 1';
$string['likertheaderstep2'] = 'Step 2';
$string['likertheaderstep3'] = 'Step 3';
$string['likertheaderstep4'] = 'Step 4';
$string['likertheaderstep5'] = 'Step 5';
$string['likertheaderstep6'] = 'Step 6';
$string['likertheaderstep7'] = 'Step 7';
$string['likertfilemanager'] = 'Image';
$string['likertscaletextdescription'] = 'Short description';
// Type slider.
$string['pagetitleeditslider'] = 'Edit slider properties';
$string['slidertextelement'] = 'Slider';
$string['amountslidersteps'] = 'Slider steps';
$string['slidername'] = 'Slider name';
$string['scalename'] = 'Name';
$string['sliderheaderstep1'] = 'Slider step 1';
$string['sliderheaderstep2'] = 'Slider step 2';
$string['sliderheaderstep3'] = 'Slider step 3';
$string['sliderheaderstep4'] = 'Slider step 4';
$string['sliderheaderstep5'] = 'Slider step 5';
$string['sliderheaderstep6'] = 'Slider step 6';
$string['sliderheaderstep7'] = 'Slider step 7';
$string['sliderheaderstep8'] = 'Slider step 8';
$string['sliderheaderstep9'] = 'Slider step 9';
$string['sliderheaderstep10'] = 'Slider step 10';
$string['sliderfilemanager'] = 'Slider image step';
$string['slidertextshortdescription'] = 'Short description step (in between steps)';
$string['scalenameofstep1'] = 'Name of slider step 1';
// Type checkbox.
$string['pagetitleeditcheckbox'] = 'Edit checkbox properties';
$string['checkboxtextelement'] = 'Checkbox';
$string['amountcheckboxes'] = 'Amount of checkboxes';
$string['cbheadername'] = 'Checkbox name';
$string['checkboxname'] = 'Name';
$string['checkboxheaderstep1'] = 'Checkbox step 1';
$string['checkboxheaderstep2'] = 'Checkbox step 2';
$string['checkboxheaderstep3'] = 'Checkbox step 3';
$string['checkboxheaderstep4'] = 'Checkbox step 4';
$string['checkboxheaderstep5'] = 'Checkbox step 5';
$string['checkboxheaderstep6'] = 'Checkbox step 6';
$string['checkboxheaderstep7'] = 'Checkbox step 7';
$string['checkboxheaderstep8'] = 'Checkbox step 8';
$string['checkboxheaderstep9'] = 'Checkbox step 9';
$string['checkboxheaderstep10'] = 'Checkbox step 10';
$string['checkboxtextdesc'] = 'Checkbox text';
//
// Allocate categories and qtypes.
$string['pagetitleeditallocation'] = 'Edit allocation settings';
$string['choosecategory'] = 'Allocate questions to categories';
$string['button'] = 'Time until consecutive OSA is allowed to be filled in';
//
// Choose standard value by osa category.
$string['pagetitleeditstandardcategoryvalues'] = 'Set standard values for categories';
$string['choosestdvaluebocategory'] = 'Choose standard value by osa category';
//
// Choose standard feedback by osa category.
$string['pagetitleeditcatfeedbacksettings'] = 'Set feedback for categories';
$string['feedbackheadercat01'] = 'Feedback options category 1';
$string['feedbackheadercat02'] = 'Feedback options category 2';
$string['feedbackheadercat03'] = 'Feedback options category 3';
$string['feedbackheadercat04'] = 'Feedback options category 4';
$string['feedbackheadercat05'] = 'Feedback options category 5';
$string['feedbackheadercat06'] = 'Feedback options category 6';
$string['feedbackheadercat07'] = 'Feedback options category 7';
$string['feedbackheadercat08'] = 'Feedback options category 8';
$string['feedbackheadercat09'] = 'Feedback options category 9';
$string['feedbackheadercat10'] = 'Feedback options category 10';
$string['feedbackheadercat11'] = 'Feedback options category 11';
$string['feedbackheadercat12'] = 'Feedback options category 12';
$string['feedbackheadercat13'] = 'Feedback options category 13';
$string['feedbackheadercat14'] = 'Feedback options category 14';
$string['feedbackheadercat15'] = 'Feedback options category 15';
$string['feedbackheadercat16'] = 'Feedback options category 16';
$string['feedbackheadercat17'] = 'Feedback options category 17';
$string['feedbackheadercat18'] = 'Feedback options category 18';
$string['feedbackheadercat19'] = 'Feedback options category 19';
$string['feedbackheadercat20'] = 'Feedback options category 20';
$string['stdvalllcat'] = 'Standard value lower limit';
$string['stdvalulcat'] = 'Standard value upper limit';
$string['fbtllcatdesc'] = 'Feedback below lower limit';
$string['fbtblulcatdesc'] = 'Feedback between lower and upper limit';
$string['fbtulcatdesc'] = 'Feedback above upper limit';
//
// Generate PDF lang strings.
$string['generatepdf'] = 'Generate PDF';
$string['evaluation'] = 'Evaluation';

