<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/amenities/stall/get.details.php";
$json = @file_get_contents($apiUrl);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Check get_all_stalls.php');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON from API.<br>Raw output: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success']) {
    die('API Error: ' . ($response['message'] ?? 'Unknown'));
}

if (empty($response['data']) || !is_array($response['data'])) {
    die('No stall records found.');
}

$stalls = $response['data']; // ← SURE NA MAY LAMAN

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',20);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'STALL MASTER LIST',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'As of '.date('F d, Y'),0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
    function List($stalls) {
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(0,51,102); 
        $this->SetTextColor(255);

        $this->Cell(15,10,'Stall',1,0,'C',true);
        $this->Cell(55,10,'Renter',1,0,'C',true);
        $this->Cell(35,10,'Contact',1,0,'C',true);
        $this->Cell(50,10,'Rental Period',1,0,'C',true);
        $this->Cell(30,10,'Fee',1,0,'C',true);
        $this->Cell(30,10,'Paid',1,0,'C',true);
        $this->Cell(30,10,'Balance',1,0,'C',true);
        $this->Cell(25,10,'Status',1,1,'C',true);

        $this->SetFont('Arial','',9); 
        $this->SetTextColor(0);

        foreach ($stalls as $s) {
            $this->Cell(15,8,$s['stall_no'],1,0,'C');
            $this->Cell(55,8,substr($s['renter_name'] ?? 'VACANT',0,25),1,0);
            $this->Cell(35,8,$s['contact_no'] ?? '-',1,0,'C');
            $this->Cell(50,8,$s['rental_period'],1,0,'C');
            $this->Cell(30,8,$s['amount_formatted'],1,0,'R');
            $this->Cell(30,8,$s['total_paid_formatted'],1,0,'R');

            if ($s['has_balance']) {
                $this->SetTextColor(200,0,0);
                $this->Cell(30,8,$s['balance_formatted'],1,0,'R');
                $this->SetTextColor(0);
            } else {
                $this->SetTextColor(0,120,0);
                $this->Cell(30,8,'PAID',1,0,'C');
                $this->SetTextColor(0);
            }

            $status = $s['is_occupied'] ? 'OCCUPIED' : 'VACANT';
            $this->Cell(25,8,$status,1,1,'C');
        }
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->List($stalls);
$pdf->Output('D','Market_Stall_Master_List_'.date('Y-m-d').'.pdf');
exit;
?>