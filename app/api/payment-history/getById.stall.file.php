<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id'])) die('Stall Renter ID required');
$renter_id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/payment-history/getById.stall.details.php?id={$renter_id}";
$json = file_get_contents($apiUrl);
$response = json_decode($json, true);
if (!$response['success']) die('No records found');

$payments = $response['data'];
$renter_name = $response['renter_name'];
$stall_no = $response['stall_no'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',20);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'STALL RENTAL PAYMENT HISTORY',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,10,"Stall No: {$GLOBALS['stall_no']}",0,1,'C');
        $this->Cell(0,10,"Renter: {$GLOBALS['renter_name']}",0,1,'C');
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
        $this->Cell(60,10,'Date Paid',1,0,'C',true);
        $this->Cell(80,10,'Amount',1,0,'C',true);
        $this->Cell(50,10,'Attachment',1,1,'C',true);

        $this->SetFont('Arial','',11); $this->SetTextColor(0);
        $no = 1;
        foreach ($data as $p) {
            $this->Cell(20,9,$no++,1,0,'C');
            $this->Cell(60,9,$p['date_paid'],1,0,'C');
            $this->Cell(80,9,'PHP '.$p['amount_formatted'],1,0,'R');
            $this->Cell(50,9,$p['attachment'] ? 'Yes' : 'No',1,1,'C');
        }
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(230,240,255);
        $this->Cell(160,12,'TOTAL PAID',1,0,'R',true);
        $this->Cell(50,12,'PHP '.$GLOBALS['response']['total_amount'],1,1,'R',true);
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->Table($payments);
$pdf->Ln(30);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Received by:',0,1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'___________________________',0,1,'C');
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,8,'Market Collector',0,1,'C');

$pdf->Output('D','Stall_'.$stall_no.'_Payment_History.pdf');
exit;
?>