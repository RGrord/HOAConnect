<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id'])) die('Remittance ID required');
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/remittance/getById.details.php?id={$id}";
$json = @file_get_contents($apiUrl);
if (!$json) die('API Error');
$response = json_decode($json, true);
if (!$response['success']) die('Record not found');
$r = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',24);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'REMITTANCE VOUCHER',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Treasury Department',0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function Report($r) {
        $this->SetFont('Arial','B',16);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,12,'RV No: RV-'.str_pad($r['id'],5,'0',STR_PAD_LEFT),0,1);
        $this->Ln(5);

        $this->SetFillColor(240,248,255);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Date:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$r['date_formatted'],1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Submitted By:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$r['full_name'] ?? 'N/A',1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Transaction Type:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$r['type_label'],1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Particular:',1,0); $this->SetFont('Arial','',12); $this->MultiCell(0,10,$r['particular'] ?? 'N/A',1);

        $this->Ln(10);
        $this->SetFont('Arial','B',18);
        $this->SetFillColor(0,80,180); $this->SetTextColor(255);
        $this->Cell(0,15,'AMOUNT: PHP '.$r['amount_formatted'],1,1,'C',true);
        $this->SetTextColor(0);

        $this->Ln(20);
        $this->SetFont('Arial','',12);
        $this->Cell(90,10,'Received by:',0,0); $this->Cell(90,10,'Approved by:',0,1,'R');
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(90,8,'___________________________',0,0,'C'); 
        $this->Cell(90,8,'___________________________',0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(90,8,'Treasurer',0,0,'C'); 
        $this->Cell(90,8,'HOA President',0,1,'C');
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->Report($r);
$pdf->Output('D','Remittance_RV-'.str_pad($r['id'],5,'0',STR_PAD_LEFT).'_'.date('Y-m-d').'.pdf');
exit;
?>