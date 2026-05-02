<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: Homeowner ID is required');
}
$user_id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/payment-history/getById.homeowner.details.php?id={$user_id}";
$json = @file_get_contents($apiUrl);
if (!$json) die('Cannot connect to API');

$response = json_decode($json, true);
if (!$response['success'] || empty($response['data'])) {
    die('No payment records found for this homeowner.');
}

$payments = $response['data'];
$total_amount = 0;

$homeowner_name = "Homeowner ID: {$user_id}";
$homeowner_info_url = "http://localhost/hoa_system/app/api/users/get.user_info.php?id={$user_id}";
$info_json = @file_get_contents($homeowner_info_url);
if ($info_json) {
    $info = json_decode($info_json, true);
    if ($info['success'] && !empty($info['data'])) {
        $homeowner_name = $info['data']['full_name'] ?? $homeowner_name;
        $homeowner_address = $info['data']['home_address'] ?? 'N/A';
        $hoa_number = $info['data']['hoa_number'] ?? 'N/A';
    }
}

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',22);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'HOMEOWNER PAYMENT HISTORY',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Dues & Contributions',0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->SetTextColor(100);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function HomeownerInfo($name, $hoa, $address) {
        $this->SetFillColor(240,248,255);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,12,'HOMEOWNER DETAILS',1,1,'C',true);
        
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Name:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$name,1,1);
        
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'HOA Number:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$hoa,1,1);
        
        $this->SetFont('Arial','B',12);
        $this->Cell(60,10,'Address:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$address,1,1);
        
        $this->Ln(10);
    }
    function PaymentTable($payments, $total) {
        global $total_amount;
        $total_amount = $total;

        $this->SetFont('Arial','B',14);
        $this->SetFillColor(0,80,180); 
        $this->SetTextColor(255);
        $this->Cell(0,12,'PAYMENT HISTORY',1,1,'C',true);
        $this->SetTextColor(0);

        $this->SetFont('Arial','B',11);
        $this->SetFillColor(0,51,102); 
        $this->SetTextColor(255);
        $this->Cell(15,10,'#',1,0,'C',true);
        $this->Cell(50,10,'Date Paid',1,0,'C',true);
        $this->Cell(50,10,'Reference No.',1,0,'C',true);
        $this->Cell(40,10,'Method',1,0,'C',true);
        $this->Cell(60,10,'Amount',1,0,'C',true);
        $this->Cell(40,10,'Attachment',1,1,'C',true);

        $this->SetFont('Arial','',10); 
        $this->SetTextColor(0);
        $no = 1;

        foreach ($payments as $p) {
            $this->Cell(15,9,$no++,1,0,'C');
            $this->Cell(50,9,$p['date_formatted'],1,0,'C');
            $this->Cell(50,9,$p['ref_no'] ?? 'N/A',1,0,'C');
            $this->Cell(40,9,$p['payment_method'] ?? 'N/A',1,0,'C');
            $this->Cell(60,9,'PHP '.$p['amount_formatted'],1,0,'R');
            $this->Cell(40,9,$p['attachment'] ? 'Yes' : 'No',1,1,'C');
        }

        $this->SetFont('Arial','B',14);
        $this->SetFillColor(230,240,255);
        $this->Cell(215,12,'TOTAL PAID',1,0,'R',true);
        $this->Cell(60,12,'PHP '.number_format($total_amount,2),1,1,'R',true);
    }
    function Signature() {
        $this->Ln(30);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Received and Verified by:',0,1);
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,8,'_______________________________',0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'Treasurer',0,1,'C');
        $this->Ln(10);
        $this->Cell(0,8,'Date: __________________________',0,1,'C');
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 25);
$pdf->AddPage();
$pdf->HomeownerInfo($homeowner_name, $hoa_number ?? 'N/A', $homeowner_address ?? 'N/A');
$pdf->PaymentTable($payments, $response['total_amount']);
$pdf->Signature();

$filename = 'Payment_History_'.$user_id.'_'.date('Y-m-d').'.pdf';
$pdf->Output('D', $filename);
exit;
?>