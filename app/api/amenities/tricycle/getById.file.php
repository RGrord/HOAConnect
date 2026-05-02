<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: TODA ID is required');
}
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/amenities/tricycle/getById.details.php?id={$id}";

$json = @file_get_contents($apiUrl);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Check if get_by_id_toda.php is working.');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON from API.<br>Raw: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success']) {
    die('API Error: ' . ($response['message'] ?? 'Unknown'));
}

if (empty($response['data'])) {
    die('TODA record not found.');
}

$t = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',24);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'TODA FRANCHISE RECEIPT',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Tricycle Operators & Drivers Association',0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function Report($t) {
        $this->SetFont('Arial','B',16);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,12,'TODA ID: TDA-'.str_pad($t['id'],4,'0',STR_PAD_LEFT),0,1);
        $this->Ln(5);

        $this->SetFillColor(240,248,255);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'TODA Name:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$t['toda_name'] ?? 'N/A',1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Representative:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$t['representative'] ?? 'N/A',1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Contact No.:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$t['contact_no'] ?? 'N/A',1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'No. of Units:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,($t['no_of_tricycles'] ?? '0').' tricycle(s)',1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Contract Period:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,10,$t['contract_period'] ?? 'N/A',1,1);

        $this->Ln(10);
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(0,80,180); $this->SetTextColor(255);
        $this->Cell(0,12,'PAYMENT SUMMARY',1,1,'C',true); $this->SetTextColor(0);

        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Annual Franchise Fee:',1,0); $this->SetFont('Arial','B',14); $this->Cell(0,10,'PHP '.($t['fee_amount'] ? number_format($t['fee_amount'],2) : '0.00'),1,1,'R');
        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Amount Paid:',1,0); $this->SetFont('Arial','B',14); $this->Cell(0,10,'PHP '.($t['total_paid'] ?? '0.00'),1,1,'R');

        $bal = $t['balance'];
        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Balance:',1,0);
        $this->SetFont('Arial','B',14);
        if ($bal > 0) {
            $this->SetTextColor(200,0,0);
            $this->Cell(0,10,'PHP '.number_format($bal,2).' (UNPAID)',1,1,'R');
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
        $this->Cell(0,8,'_______________________________',0,0,'L'); $this->Cell(0,8,'_______________________________',0,1,'R');
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'Treasurer',0,0,'L'); $this->Cell(0,8,'HOA President',0,1,'R');
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->Report($t);
$pdf->Output('D','TODA_Receipt_TDA-'.str_pad($t['id'],4,'0',STR_PAD_LEFT).'_'.date('Y-m-d').'.pdf');
exit;
?>