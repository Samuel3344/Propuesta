<?php
require('fpdf186/fpdf.php');

$fecha_actual = date('m-d-y');

class PDF extends FPDF
{

    function Tabla()
    {
        // Encabezado de la tabla
        $this->SetFont('Arial','B', 8);
        $this->SetFillColor(211, 211, 211);
        $this->Cell(25, 10, 'TOTAL:', 1);
        $this->Cell(25, 10, 'GUTTER', 1, 0, 'C', true);
        $this->Cell(25, 10, 'SUPER GUTTER', 1, 0, 'C', true);
        $this->Cell(25, 10, 'GUTTER GUARD', 1, 0, 'C', true);
        $this->Cell(25, 10, 'ROOF', 1, 0, 'C', true);
        $this->Cell(25, 10, 'SIDING', 1, 0, 'C', true);
        $this->Cell(45, 10, 'PIPE UNDERGROUND', 1, 0, 'C', true);
        $this->Ln();

        // Celdas de la tabla
        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 10, "INSTALLATION", 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(45, 10, '', 1);
        $this->Ln();

        $this->Cell(25, 10, "CLEANING", 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(45, 10, '', 1);
        $this->Ln();

        $this->Cell(25, 10, "REPAIR", 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(25, 10, '', 1);
        $this->Cell(45, 10, '', 1);
        $this->Ln();
    }
}

// Crear una instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

$pdf->SetMargins(10, 10, 1);
$pdf->SetAutoPageBreak(true, 1);

$pdf->Image('logo.png', 7, 10, 190);

// Otros contenidos del PDF

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(1);
$pdf->SetY(15);
$pdf->Cell(0, 70, 'Date: '. $fecha_actual, 0, 0);

$pdf->Image('logo2.png', 117, 30, 90, 0);

//NAME

$pdf->SetY(55);
$pdf->Tabla();

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 20, 'Name: ', 0, 0);

$pdf->SetY(100);
$pdf->SetX(31);
$pdf->Cell(50, 10, '', 1);

//TELEFONO

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(83);
$pdf->Cell(0, 12, 'Phone: ', 0, 0);

$pdf->SetY(100);
$pdf->SetX(100);
$pdf->Cell(55, 10, '', 1);

//ASIGNATURE AND DATE

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(160);
$pdf->Cell(0, 12, 'Signature and Date: ', 0, 0);

$pdf->SetY(100);
$pdf->SetX(160);
$pdf->Cell(45, 10, '', 1);

$pdf->SetY(110);
$pdf->SetX(160);
$pdf->Cell(45, 10, '', 1);

$pdf->SetY(120);
$pdf->SetX(160);
$pdf->Cell(45, 10, '', 1);

//DIRECCION

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetY(105);
$pdf->Cell(0, 35, 'Address: ', 0, 0);

$pdf->SetY(115);
$pdf->SetX(31);
$pdf->Cell(124, 10, '', 1);

//CAMPOS DEL EMAIL

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetY(120);
$pdf->Cell(0, 35, 'Email: ', 0, 0);

$pdf->SetY(130);
$pdf->SetX(31);
$pdf->Cell(124, 10, '', 1);

//DEPOSIT LINE

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(10);
$pdf->SetY(135);
$pdf->Cell(0, 35, 'Deposit:$', 0, 0);

$pdf->SetY(145);
$pdf->SetX(31);
$pdf->Cell(30, 10, '', 1);

//Check 

$pdf->SetY(148);
$pdf->SetX(65);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(134);
$pdf->SetX(70);
$pdf->Cell(0, 35, 'Check', 0, 0);

// CASH

$pdf->SetY(148);
$pdf->SetX(88);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(134);
$pdf->SetX(93);
$pdf->Cell(0, 35, 'Cash', 0, 0);

//ZELLE

$pdf->SetY(148);
$pdf->SetX(110);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(134);
$pdf->SetX(115);
$pdf->Cell(0, 35, 'Zelle', 0, 0);

//C.Card

$pdf->SetY(148);
$pdf->SetX(130);
$pdf->Cell(5, 5, '', 1);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY(134);
$pdf->SetX(135);
$pdf->Cell(0, 35, 'C.Card', 0, 0);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY(134);
$pdf->SetX(150);
$pdf->Cell(0, 35, '(non refundable)', 0, 0);

//Cuadro de imagen y privacy policy

$pdf->SetY(160);
$pdf->SetX(10);
$pdf->Cell(190, 130, '', 1);

//Notas y by

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetY(240);
$pdf->SetX(10);
$pdf->Cell(0, 35, 'Notes:', 0, 0);

$pdf->SetFont('Arial', 'B', 8);
$pdf->SetY(261);
$pdf->SetX(10);
$pdf->Cell(0, 35, 'By:', 0, 0);

//Cuadro para encerrar privacy
$pdf->SetY(250);
$pdf->SetX(10);
$pdf->Cell(90, 40, '', 1);

$pdf->SetY(250);
$pdf->SetX(100);
$pdf->Cell(100, 40, '', 1);

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(240);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'Privacy Policy: All personal data is exclusively intended for', 0, 0); 

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(243);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'internal use by FreshGutter. If you request something from us', 0, 0);

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(246);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'such as a call back or a Service Call, we will use the', 0, 0);

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(249);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'information you have provide to fulfill your request only.', 0, 0);

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(252);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'All personal details are protected. We don´t share, sell your', 0, 0);

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(255);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'information to any third parties. For any complaint text a', 0, 0);


$pdf->SetFont('Arial', '', 10);
$pdf->SetY(258);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'message to (754)-245-5564 or send an email to', 0, 0);

$pdf->SetFont('Arial', '', 10);
$pdf->SetY(261);
$pdf->SetX(102);
$pdf->Cell(0, 35, 'gutters24x7@gmail.com', 0, 0); 

$pdf->AddPage();

//Logo de la segunda pagina

$pdf->Image('tabla.png', 10, 10, 200, 190);

// Salida del PDF
$pdf->Output();
?>
