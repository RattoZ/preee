<?php
require('./lib/fpdf/fpdf.php');

class PDF extends FPDF
{

    private $titolo = '© Copyright ZINGA VET - Via M. L. Maverna, 4 - 44122 Ferrara';

    // Page header
    function Header()
    {
        // Logo
        $this->Image('./images/zingalogo.png', 10, 6, 50);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 40);
        // Move to the right
        $this->Cell(70);
        // Title
        $this->Cell(100, 40, strtoupper('Zinga Vet'), 2, 0, 'B');
        $this->SetFont('Arial', 'I', 15);
        $this->Cell(10, 70, 'Dott. Rossi', 2, 0, 'R');
        $this->SetFont('Arial', 'I', 14);
        $this->Cell(10, 80, 'Reperibile h24 - tel. 3293267343', 2, 0, 'R');
        // Line break
        $this->Ln(43);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 12);
        // Page number
        $this->Cell(0, 10, $this->titolo, 0, 0, 'C');
    }

    function ChapterTitle($num, $label)
    {
        // Arial 12
        $this->SetFont('Arial', '', 12);
        // Background color
        $this->SetFillColor(200, 220, 255);
        // Title
        $this->Cell(0, 6, "Data:     $label", 0, 1, 'L', true);
        // $this->Cell(0, 6, "Chapter $num : $label", 0, 1, 'L', true);
        // Line break
        $this->Ln(4);
    }

    function ChapterBody($file)
    {
        // Read text file
        $txt = file_get_contents($file);
        // Times 12
        $this->SetFont('Times', '', 12);
        // Output justified text
        $this->MultiCell(0, 5, $txt);
        // Line break
        // $this->Ln();
    }

    function PrintChapter($num, $title, $file)
    {
        $this->ChapterTitle($num, $title);
        $this->ChapterBody($file);
    }
}

$text = $_GET['text'];
$data = explode(';', $text);

// Instanciation of inherited class
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(100);


$pdf->PrintChapter(1,  date("d-m-Y H:i"), '20k_c1.txt');

// $pdf->Cell(20, 10, 'Title', 1, 1, 'C');
// Line break
$pdf->SetFont('Arial', 'I', 16);
for ($i = 0; $i <= count($data); $i++) {
    $pdf->Cell(0, 10, $data[$i], 0, 1);
}
$id = $_GET['id'];
$tmp = './tmp/' . $id . 'qr.png';
$pdf->Image($tmp, 65, 180, 80);

$pdf->Output();
