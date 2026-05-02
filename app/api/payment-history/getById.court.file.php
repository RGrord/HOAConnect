<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id'])) die('Court Rental ID required');
$court_id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/payment-history/getById.court.details.php?id={$court_id}";
$json = file_get_contents($apiUrl);
$response = json_decode($json, true);
if (!$response['success']) die('No records found');

$payments = $response['data'];
$renter_name = $response['renter_name'];
$purpose = $response['purpose'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',20);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'COURT RENTAL PAYMENT RECEIPT',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,"Renter: {$GLOBALS['renter_name']}",0,1,'C');
        $this->Cell(0,10,"Purpose: {$GLOBALS['purpose']}",0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
    function Table($data) {
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(0,51,102); $this->SetTextColor(255);
        $this->Cell(20,10,'#',1,0,'C',true);
        $this->Cell(80,10,'Date Paid',1,0,'C',true);
        $this->Cell(90,10,'Amount',1,1,'C',true);

        $this->SetFont('Arial','',11); $this->SetTextColor(0);
        $no = 1;
        foreach ($data as $p) {
            $this->Cell(20,9,$no++,1,0,'C');
            $this->Cell(80,9,$p['date_paid'],1,0,'C');
            $this->Cell(90,9,'PHP '.$p['amount_formatted'],1,1,'R');
        }
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(230,240,255);
        $this->Cell(100,12,'TOTAL PAID',1,0,'R',true);
        $this->Cell(90,12,'PHP '.$GLOBALS['response']['total_amount'],1,1,'R',true);
    }
    function Signature() {
        $this->Ln(30);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Received by:',0,1);
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,8,'___________________________',0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'Court Custodian / Collector',0,1,'C');
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->Table($payments);
$pdf->Signature();
$pdf->Output('D','Court_Rental_'.$court_id.'_Receipt.pdf');
exit;
?>