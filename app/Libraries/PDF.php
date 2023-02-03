<?php
namespace App\Libraries;

require_once APPPATH.'ThirdParty/tcpdf/tcpdf.php';
use \TCPDF;

class PDF extends TCPDF{
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo.png';
        $this->Image($image_file, 10, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 25);
        // Title
        $this->Cell(160, 15, 'CV.BUNTUSIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(8);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(200, 15, 'KONTRAKTOR DAN LEVERANSIR', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(200, 15, 'JL. BTN SKYLINE INDAH BLOK D NO.141 KOTARAJA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(200, 15, 'NPWP:02.813.112.6-952.000 // email:cv_buntusia@yahoo.com', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}