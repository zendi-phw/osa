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
 * Plugin administration pages are defined here.
 *
 * @package     mod_osa
 * @category    admin
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

    if ($ADMIN->fulltree) {
        // TODO: Define the plugin settings page - {@link https://docs.moodle.org/dev/Admin_settings}.
        //
        $select = array(0 => get_string('no'), 1 => get_string('yes'));
        $range1to5 = range(1, 5);
        $range1to10 = range(1, 10);
        $range1to20 = range(1, 20);
        $range2to10 = range(2, 10);
        //
        // $settings->add(new admin_settingpage('managemodosa', new lang_string('manage', 'mod_osa')));
        //
        // Create logical parts for each setting: osa dashboard.
        $settings->add(new admin_setting_heading('mod_osa/osadashboard',
        get_string('osaadminsettingsdashboardheading', 'mod_osa'),
        get_string('osaadminsettingsdashboardheadingdesc', 'mod_osa'),
        ));
        //
        // Define adminsetings osa dashboard settings min max and default value.
        $settings->add(new admin_setting_configselect('mod_osa/cfgamountcheckboxosadashboard',
        get_string('amountosadashboard', 'mod_osa'),
        get_string('amountosadashboarddesc', 'mod_osa'),
        2, $range1to5));
        //
        //
        // Create logical parts for each setting: osa sharing options.
        $settings->add(new admin_setting_heading('mod_osa/osasharingoptions',
        get_string('osaadminsettingssharingoptions', 'mod_osa'),
        get_string('osaadminsettingssharingoptionsdesc', 'mod_osa'),
        ));
        //
        // Define adminsettings allow osa templates to be shared by teachers with other teachers.
        $settings->add(new admin_setting_configselect('mod_osa/cfgallowsharing',
        get_string('osaadminsettingallowsharing', 'mod_osa'),
        get_string('osaadminsettingallowsharingdesc', 'mod_osa'),
        0, $select));
        //
        //
        // Create logical parts for each setting: osa question type options.
        $settings->add(new admin_setting_heading('mod_osa/osaquestiontypeoptions',
        get_string('osaadminsettingsquestiontypeoptions', 'mod_osa'),
        get_string('osaadminsettingsquestiontypeoptionsdesc', 'mod_osa'),
        ));
        //
        // Define adminsetting allow question type checkbox.
        $settings->add(new admin_setting_configcheckbox('mod_osa/questiontypecheckbox',
        get_string('allowquestiontypecheckbox', 'mod_osa'),
        get_string('allowquestiontypecheckboxdesc', 'mod_osa'),
        1));
        //
        // Define adminsetting allow question type likert scale.
        $settings->add(new admin_setting_configcheckbox('mod_osa/questiontypelikert',
        get_string('allowquestiontypelikert', 'mod_osa'),
        get_string('allowquestiontypelikertdesc', 'mod_osa'),
        1));
        //
        // Define adminsetting allow question type text.
        $settings->add(new admin_setting_configcheckbox('mod_osa/questiontypetext',
        get_string('allowquestiontypetext', 'mod_osa'),
        get_string('allowquestiontypetextdesc', 'mod_osa'),
        1));
        //
        // Define adminsetting allow question type slider.
        $settings->add(new admin_setting_configcheckbox('mod_osa/questiontypeslider',
        get_string('allowquestiontypeslider', 'mod_osa'),
        get_string('allowquestiontypesliderdesc', 'mod_osa'),
        1));
        //
        //
        // Create logical parts for each setting: osa question type standard settings.
        $settings->add(new admin_setting_heading('mod_osa/osaquestiontypestandardsettings',
        get_string('osaadminsettingsquestiontypestandardsettings', 'mod_osa'),
        get_string('osaadminsettingsquestiontypestandardsettingsdesc', 'mod_osa'),
        ));
        //
        // Define adminsetings standard settings questiontype checkbox settings min max and default value.
        $settings->add(new admin_setting_configselect('mod_osa/osaquestiontypestandardsettingscheckbox',
        get_string('osaadminsettingsquestiontypestandardsettingscheckbox', 'mod_osa'),
        get_string('osaadminsettingsquestiontypestandardsettingscheckboxdesc', 'mod_osa'),
        0, $range1to20));
        //
        // Define adminsetings standard settings questiontype likert scale settings min max and default value.
        $settings->add(new admin_setting_configselect('mod_osa/osaquestiontypestandardsettingslikert',
        get_string('osaadminsettingsquestiontypestandardsettingslikert', 'mod_osa'),
        get_string('osaadminsettingsquestiontypestandardsettingslikertdesc', 'mod_osa'),
        3, $range2to10));
        //
        // Define adminsetings standard settings questiontype slider settings min max and default value.
        $settings->add(new admin_setting_configselect('mod_osa/osaquestiontypestandardsettingsslider',
        get_string('osaadminsettingsquestiontypestandardsettingsslider', 'mod_osa'),
        get_string('osaadminsettingsquestiontypestandardsettingssliderdesc', 'mod_osa'),
        3, $range1to10));
        //
        //
        // Create logical parts for each setting: osa result category standard settings.
        $settings->add(new admin_setting_heading('mod_osa/osaresultcategorystandardsettings',
        get_string('osaadminsettingsresultcategorystandardsettings', 'mod_osa'),
        get_string('osaadminsettingsresultcategorystandardsettingsdesc', 'mod_osa'),
        ));
        //
        // Define adminsetings standard settings osa result category standard settings min max and default value.
        $settings->add(new admin_setting_configselect('mod_osa/osaresultcategorystandardsettingsamount',
        get_string('osaadminsettingsresultcategorystandardsettingsamount', 'mod_osa'),
        get_string('osaadminsettingsresultcategorystandardsettingsamountdesc', 'mod_osa'),
        2, $range2to10));
        //
        //
        // Create logical parts for each setting: osa structural settings.
        $settings->add(new admin_setting_heading('mod_osa/osastructuralsettings',
        get_string('osaadminstructuralsettings', 'mod_osa'),
        get_string('osaadminstructuralsettingsdesc', 'mod_osa'),
        ));
        //
        // Define adminsetings standard settings osa structural settting yes no default value.
        $settings->add(new admin_setting_configselect('mod_osa/osastructuralstandardsettingpagenumbering',
        get_string('osaadminstructuralsettingpagenumberingstandardsetting', 'mod_osa'),
        get_string('osaadminstructuralsettingpagenumberingstandardsettingdesc', 'mod_osa'),
        1, $select));
        //
        //
        // Create logical parts for each setting: osa library settings.
        $settings->add(new admin_setting_heading('mod_osa/osalybrarysettings',
        get_string('osaadminlibrarysettings', 'mod_osa'),
        get_string('osaadminlibrarysettingsdesc', 'mod_osa'),
        ));
        //
        // Define adminsetings standard settings osa url to libraries needed for graphics.
        // D3
        $settings->add(new admin_setting_configtext('mod_osa/osasettingurld3',
        get_string('osaadminsettingurld3', 'mod_osa'),
        get_string('osaadminsettingurld3desc', 'mod_osa'),
        'https://cdn.jsdelivr.net/npm/d3@7/+esm',
        PARAM_URL
        ));
        // plotly
        $settings->add(new admin_setting_configtext('mod_osa/osasettingurlplotly',
        get_string('osaadminsettingurlplotly', 'mod_osa'),
        get_string('osaadminsettingurlplotlydesc', 'mod_osa'),
        'https://cdn.plot.ly/plotly-2.26.0.min.js',
        PARAM_URL
        ));
        //
        //
        // Purge cache when setting has changed [https://docs.moodle.org/dev/Admin_settings][06.02.23].
        // See official documentation $setting->set_updatedcallback('theme_reset_all_caches'); .
    }
