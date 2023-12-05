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
 * The main mod_osa gereate_user_pdf file.
 *
 * @package     mod_osa
 * @copyright   2023 Simon Schaudt <schaudt@ph-weingarten.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('lib.php');
require_once($CFG->libdir.'/pdflib.php');

global $PAGE, $DB, $CFG, $OUTPUT; $USER;

$cmid = optional_param('cmid', 0, PARAM_INT); // Get the course module id cmid from the URL parameter

$cm = get_coursemodule_from_id('osa', $cmid, 0, false, MUST_EXIST); // Get the course module object.
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST); // Get course id.
$osa = $DB->get_record('osa', array('id' => $cm->instance), '*', MUST_EXIST); // Get general teacher settings entry from osa table.

require_login($course, true, $cm);

$context = context_module::instance($cm->id);

$url = new moodle_url('/mod/osa/generate_user_pdf.php', ['cmid' => $cmid]);

$PAGE->set_url($url);
$PAGE->set_title(get_string('pagetitleedittextelement', 'mod_osa') . ' ' . format_string($osa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);


$osaname = $osa->name;
$currentuser = $USER->firstname . ' ' . $USER->lastname;
$currentdateandtime = userdate(time());
$evaluation = get_string('evaluation', 'mod_osa');


// Extend the TCPDF class to create custom Header and Footer.
class CUSTOMPDF extends TCPDF {

    // Page header.
    public function Header() {
        global $evaluation;
        global $osaname;
        global $currentuser;
        global $currentdateandtime;

        $headertext = $evaluation . ' ' . $osaname . ' ' . $currentuser . ' ' . $currentdateandtime;
        $this->Cell(0, 15, $headertext, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer settings.
    public function Footer() {
        // Position is at 15 mm from bottom position.
        $this->SetY(-15);
        // Set font.
        $this->SetFont('helvetica', 'I', 8);
        // Page number.
        $this->Cell(0, 10, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
// Set pdf options.
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($currentuser);
$pdf->SetTitle('Online Self Assessment' . $current);
$pdf->SetSubject('OSA' . ' ' . $evaluation);
$pdf->SetKeywords('OSA,' . ' ' . $evaluation);
//
// Show header and footer true or false.
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);
//
// Set header and footer data.
$pdf->setFooterData(array(0,64,0), array(0,64,128));
//
// Set page margins for header footer and general left top and right margin.
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
// Set auto page breakts to true.
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
// Add a new page.
$pdf->AddPage();
//
$pdf->WriteHTML('<h1>OSA</h1>');
//
$pdf->AddPage();
// Set text to print
//
// Output PDF.
// Option D = Download; option I generate in Browser but do not download.
//$pdf->Output($currentdateandtime . '.pdf', 'D');
$pdf->Output($currentdateandtime . '.pdf', 'I');
//
