<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/amenities/tricycle/get.details.php";

$context = stream_context_create([
    'http' => [
        'timeout' => 10,
        'header' => "User-Agent: Mozilla/5.0\r\n"
    ]
]);

$json = @file_get_contents($apiUrl, false, $context);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Please check if get_all_toda.php is working.');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON received. Raw response: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success']) {
    die('API Error: ' . ($response['message'] ?? 'Unknown error'));
}

if (empty($response['data']) || !is_array($response['data'])) {
    die('No TODA records found.');
}
$data = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',20);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'TODA MASTER LIST & PAYMENT STATUS',0,1,'C');
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
    function List($data) {
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(0,51,102); 
        $this->SetTextColor(255);

        $this->Cell(12,10,'ID',1,0,'C',true);
        $this->Cell(70,10,'TODA Name',1,0,'C',true);
        $this->Cell(40,10,'Representative',1,0,'C',true);
        $this->Cell(25,10,'Units',1,0,'C',true);
        $this->Cell(35,10,'Fee',1,0,'C',true);
        $this->Cell(35,10,'Paid',1,0,'C',true);
        $this->Cell(35,10,'Balance',1,0,'C',true);
        $this->Cell(25,10,'Status',1,1,'C',true);

        $this->SetFont('Arial','',10); 
        $this->SetTextColor(0);
        $total = $paid = $bal = 0;

        foreach ($data as $t) {
            $total += (float)($t['fee_amount'] ?? 0);
            $paid  += (float)($t['total_paid'] ?? 0);
            $bal   += (float)($t['balance'] ?? 0);

            $this->Cell(12,9,str_pad($t['id'] ?? '0',3,'0',STR_PAD_LEFT),1,0,'C');
            $this->Cell(70,9,substr($t['toda_name'] ?? 'N/A',0,30),1,0);
            $this->Cell(40,9,substr($t['representative'] ?? '',0,20),1,0);
            $this->Cell(25,9,$t['no_of_tricycles'] ?? '0',1,0,'C');
            $this->Cell(35,9,number_format($t['fee_amount'] ?? 0,0),1,0,'R');
            $this->Cell(35,9,number_format($t['total_paid'] ?? 0,0),1,0,'R');

            if (($t['balance'] ?? 0) > 0) {
                $this->SetTextColor(200,0,0);
                $this->Cell(35,9,number_format($t['balance'] ?? 0,0),1,0,'R');
                $this->SetTextColor(0);
            } else {
                $this->SetTextColor(0,120,0);
                $this->Cell(35,9,'PAID',1,0,'C');
                $this->SetTextColor(0);
            }
            $this->Cell(25,9,$t['status_label'] ?? 'Unknown',1,1,'C');
        }

        $this->SetFont('Arial','B',12);
        $this->SetFillColor(230,240,255);
        $this->Cell(147,12,'GRAND TOTAL',1,0,'R',true);
        $this->Cell(35,12,'PHP '.number_format($total,0),1,0,'R',true);
        $this->Cell(35,12,'PHP '.number_format($paid,0),1,0,'R',true);
        $this->Cell(35,12,'PHP '.number_format($bal,0),1,1,'R',true);
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->List($data);
$pdf->Output('D', 'TODA_Master_List_'.date('Y-m-d').'.pdf');

exit;
?>