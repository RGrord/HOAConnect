<?php
ob_clean(); // ← SUPER CRITICAL!
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: TODA ID is required');
}
$toda_id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/payment-history/getById.toda.details.php?id={$toda_id}";

// Safe fetch
$json = @file_get_contents($apiUrl);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Check get_by_id_toda.php');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON from API.<br>Raw: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success'] || empty($response['data'])) {
    die('TODA not found or no data returned.');
}

$t = $response['data']; // ← SURE NA MAY LAMAN

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',22);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'TODA FRANCHISE PAYMENT RECEIPT',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,"TODA: {$GLOBALS['t']['toda_name']}",0,1,'C');
        $this->Cell(0,10,"Representative: {$GLOBALS['t']['representative']}",0,1,'C');
        $this->Cell(0,10,"No. of Units: {$GLOBALS['t']['no_of_tricycles']} tricycle(s)",0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function PaymentTable($data) {
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(0,51,102); 
        $this->SetTextColor(255);
        $this->Cell(20,10,'#',1,0,'C',true);
        $this->Cell(80,10,'Due Date',1,0,'C',true);
        $this->Cell(90,10,'Amount Paid',1,1,'C',true);

        $this->SetFont('Arial','',11); 
        $this->SetTextColor(0);
        $no = 1;
        foreach ($data['payment_history'] as $p) {
            $this->Cell(20,9,$no++,1,0,'C');
            $this->Cell(80,9,$p['due_formatted'] ?? 'N/A',1,0,'C');
            $this->Cell(90,9,'PHP '.$p['amount_formatted'],1,1,'R');
        }

        // Total
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(230,240,255);
        $this->Cell(100,12,'TOTAL PAID',1,0,'R',true);
        $this->Cell(90,12,'PHP '.$data['total_paid_formatted'],1,1,'R',true);

        // Balance
        if ($data['balance'] > 0) {
            $this->SetFillColor(255,240,240);
            $this->Cell(100,12,'BALANCE DUE',1,0,'R',true);
            $this->Cell(90,12,'PHP '.$data['balance_formatted'],1,1,'R',true);
        }
    }
    function Signature() {
        $this->Ln(30);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Received by:',0,1);
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,8,'___________________________',0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'Treasurer / Collector',0,1,'C');
        $this->Ln(10);
        $this->Cell(0,8,'Date: __________________________',0,1,'C');
    }
}

// Generate PDF — WALANG ERROR NA!
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->PaymentTable($t);
$pdf->Signature();

$filename = 'TODA_Receipt_'.$t['toda_name'].'_'.date('Y-m-d').'.pdf';
$pdf->Output('D', $filename);
exit;
?>