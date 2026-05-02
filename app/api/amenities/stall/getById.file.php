<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id'])) die('Stall ID required');
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/amenities/stall/getById.details.php?id={$id}";
$json = @file_get_contents($apiUrl);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Check if get_by_id_stall.php is working.');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON from API.<br>Raw: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success']) {
    die('API Error: ' . ($response['message'] ?? 'Unknown error'));
}

if (empty($response['data'])) {
    die('Stall not found or no data returned.');
}

$s = $response['data']; // ← SURE NA MAY LAMAN

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',24);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'MARKET STALL RENTAL RECEIPT',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Public Market',0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function Report($s) {
        $this->SetFont('Arial','B',18);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,12,'Stall No: '.$s['stall_no'],0,1);
        $this->Ln(5);

        $this->SetFillColor(240,248,255);
        $this->SetFont('Arial','B',12);
        
        $this->Cell(60,10,'Renter Name:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$s['is_occupied'] ? ($s['renter_name'] ?? 'N/A') : 'VACANT',1,1);
        
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Contact No.:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$s['contact_no'] ?? '-',1,1);

        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Rental Period:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$s['rental_period'],1,1);

        $this->Ln(10);
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(0,80,180); $this->SetTextColor(255);
        $this->Cell(0,12,'PAYMENT SUMMARY',1,1,'C',true); $this->SetTextColor(0);

        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Monthly Rental Fee:',1,0); 
        $this->SetFont('Arial','B',14); 
        $this->Cell(0,10,'PHP '.$s['amount_formatted'],1,1,'R');
        
        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Total Paid:',1,0); 
        $this->SetFont('Arial','B',14); 
        $this->Cell(0,10,'PHP '.$s['total_paid_formatted'],1,1,'R');

        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Balance:',1,0);
        $this->SetFont('Arial','B',14);
        if ($s['balance'] > 0) {
            $this->SetTextColor(200,0,0);
            $this->Cell(0,10,'PHP '.$s['balance_formatted'].' (UNPAID)',1,1,'R');
        } else {
            $this->SetTextColor(0,120,0);
            $this->Cell(0,10,'FULLY PAID',1,1,'R');
        }
        $this->SetTextColor(0);

        $this->Ln(20);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Received by:',0,0,'L'); $this->Cell(0,10,'Approved by:',0,1,'R');
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,8,'_______________________________',0,0,'L'); 
        $this->Cell(0,8,'_______________________________',0,1,'R');
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'Market Collector',0,0,'L'); 
        $this->Cell(0,8,'HOA President',0,1,'R');
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->Report($s);
$pdf->Output('D','Stall_Receipt_'.$s['stall_no'].'_'.date('Y-m-d').'.pdf');
exit;
?>