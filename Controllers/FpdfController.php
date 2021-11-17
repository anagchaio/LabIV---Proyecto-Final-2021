<?php

namespace Controllers;

require_once('./Fpdf/fpdf.php');

use Controllers\JobOfferController as JobOfferController;
use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\CareerDAO as CareerDAO;

class FpdfController {

    function Header()
{
    // Logo
    // $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','C',18);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'JobOffers',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Page ').$this->PageNo().'/{nb}',0,0,'C');
}

public function createPDF(){

    $jobOffer = new JobOfferController();

    $jobOfferList = $jobOffer->getAll();
    
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',16);
    
    while(){

    }

    $pdf->Output();
}
    
    

}