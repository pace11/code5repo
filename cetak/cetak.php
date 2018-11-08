<?php
require('fpdf.php');

class PDF extends FPDF{
    
    // Page header
    function Header(){
        $this->Image('img/LOGO.png',10,6,100);
        $this->SetFont('Arial','B',14);
        $this->Cell(80);
        $this->Cell(30,85,'** KONFIRMASI PENDAFTARAN **',0,0,'C');
    }

    // Page footer
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Code 5 * Konfirmasi Pendaftaran (Page '.$this->PageNo().'/{nb}) ',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Output();
?>