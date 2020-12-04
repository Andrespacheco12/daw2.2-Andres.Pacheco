<?php

require ('fpdf/fpdf.php');
$fpdf = new FPDF();
$fpdf ->AddPage();

class pdf extends FPDF{
function Header() {
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(1, 6, 'Centro administrativo San Juan');
    // To be implemented in your own inherited class
}

function Footer()
{
    $this->SetFont('Arial', 'B', 12);
    $this->SetY(-15);
    $this->Write(5, 'Madrid', 'España');
    $this->SetX(-15);
    $this->Write(5, $this->PageNo());
    // To be implemented in your own inherited class
}
}
$fpdf ->Ln();
$fpdf->setFont('Arial','',18);
//Para crear lineas de texto
$fpdf ->Write(5,'Alumnos del centro');
$fpdf->Ln();
//Saltos de linea
$fpdf->Ln();

//Con esto podrás crear tabas
$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(55,89,78);
$fpdf ->Cell(80,5,'Nombre de la persona',1,0,'',true);

$fpdf ->SetFillColor(51,204,255);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',14);
$fpdf ->Cell(80,5,'Lucas',1,0,false);
$fpdf ->Cell(80,5,'Ramirez',1,1,false);
$fpdf->Ln(0);
$fpdf ->Cell(80,5,'Andrea',1,0,false);
$fpdf ->Cell(80,5,'Sanchez',1,1,false);

$fpdf ->Image('libros.png',50,100,50);
// Aqui se definen parametros como la colocacion de la imagen en la pag
// o el ancho y el tamaño de la misma

//$fpdf ->Footer(18,6,'Footer del pdf');
$fpdf ->Output();