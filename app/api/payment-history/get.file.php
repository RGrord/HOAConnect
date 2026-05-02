<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/payment-history/get.details.php";
$json = file_get_contents($apiUrl);
$response = json_decode($json, true)['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',20);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'PAYMENT HISTORY MASTER LIST',0,1,'C');
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
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(0,51,102); $this->SetTextColor(255);
        $this->Cell(15,10,'#',1,0,'C',true);
        $this->Cell(40,10,'Date Paid',1,0,'C',true);
        $this->Cell(60,10,'Payer',1,0,'C',true);
        $this->Cell(70,10,'Payment For',1,0,'C',true);
        $this->Cell(40,10,'Amount',1,0,'C',true);
        $this->Cell(30,10,'Method',1,1,'C',true);

        $this->SetFont('Arial','',9); $this->SetTextColor(0);
        $no = 1;
        foreach ($data as $p) {
            $this->Cell(15,8,$no++,1,0,'C');
            $this->Cell(40,8,$p['date_formatted'],1,0,'C');
            $this->Cell(60,8,substr($p['payer_name'],0,28),1,0);
            $this->Cell(70,8,$p['payment_for'],1,0);
            $this->Cell(40,8,'PHP '.$p['amount_formatted'],1,0,'R');
            $this->Cell(30,8,$p['payment_method'] ?? 'N/A',1,1,'C');
        }
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->List($response);
$pdf->Output('D','Payment_History_Master_List_'.date('Y-m-d').'.pdf');
exit;
?>