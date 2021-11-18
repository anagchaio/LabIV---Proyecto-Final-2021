<?php

namespace Controllers;

use Exception;
use Models\Student as Student;
use Models\Career as Career;
use Models\JobOffer as JobOffer;
use fpdf\FPDF as FPDF;


class FpdfController
{

    function Header($title, $pdf)
    {
        // Logo
        // $this->Image('logo.png',10,8,33);
        // Arial bold 15

        $pdf->SetFont('Arial', 'C', 18);
        // Movernos a la derecha
        $pdf->Cell(80);
        // Título
        $pdf->Cell(30, 10, $title, 0, 0, 'C');
        // Salto de línea
        $pdf->Ln(20);
        // Cabecera de tabla
        $pdf->Cell(90, 10, "Nombre", 1, 0, 'B', 0);
        $pdf->Cell(90, 10, "Apellido", 1, 0, 'B', 0);
        $pdf->Cell(90, 10, "email", 1, 0, 'B', 0);
        $pdf->Cell(90, 10, "Telefono", 1, 0, 'B', 0);
    }

    // Pie de página
    function Footer($pdf)
    {
        // Posición: a 1,5 cm del final
        $pdf->SetY(-15);
        // Arial italic 8
       $pdf->SetFont('Arial', 'I', 8);
        // Número de página
        $pdf->Cell(0, 10, utf8_decode('Page ') . $pdf->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function createPDF($StudentList, $jobOffer)
    {
        try {
            $pdf = new FPDF();
            $this->Header($jobOffer->getCompany_name(), $pdf);

            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 16);

            foreach ($StudentList as $student) {
                $pdf->Cell(90, 10, $student->getFirstName(), 1, 0, 'C', 0);
                $pdf->Cell(90, 10, $student->getLastName(), 1, 0, 'C', 0);
                $pdf->Cell(90, 10, $student->getEmail(), 1, 0, 'C', 0);
                $pdf->Cell(90, 10, $student->getPhoneNumber(), 1, 1, 'C', 0);
            }
            $this->Footer($pdf);

            $pdf->Output();
        } catch (Exception $exception) {
            die(var_dump($exception));
            //throw $exception;

        }

        // return $pdf;
    }
}
