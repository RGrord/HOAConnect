<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/fee-type/get.details.php";
$json = file_get_contents($apiUrl);
$response = json_decode($json, true)['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',22);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'MASTER LIST OF FEES & CHARGES',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Approved Fees',0,1,'C');
        $this->Cell(0,10,'As of '.date('F d, Y'),0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function List($data) {
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(0,51,102); 
        $this->SetTextColor(255);

        $this->Cell(15,10,'ID',1,0,'C',true);
        $this->Cell(60,10,'Fee Name',1,0,'C',true);
        $this->Cell(70,10,'Description',1,0,'C',true);
        $this->Cell(40,10,'Amount',1,0,'C',true);
        $this->Cell(40,10,'Effective',1,0,'C',true);
        $this->Cell(25,10,'Recurring',1,0,'C',true);
        $this->Cell(25,10,'Status',1,1,'C',true);

        $this->SetFont('Arial','',10); 
        $this->SetTextColor(0);

        foreach ($data as $f) {
            $this->Cell(15,9,$f['id'],1,0,'C');
            $this->Cell(60,9,substr($f['fee_name'],0,32),1,0);
            $this->Cell(70,9,substr($f['description'] ?? 'N/A',0,40),1,0);
            $this->Cell(40,9,'PHP '.$f['amount_formatted'],1,0,'R');
            $this->Cell(40,9,$f['effectivity_formatted'],1,0,'C');
            $this->Cell(25,9,$f['recurring_label'],1,0,'C');
            $this->Cell(25,9,$f['status_label'],1,1,'C');
        }
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->List($response);
$pdf->Output('D','Fee_Type_Master_List_'.date('Y-m-d').'.pdf');
exit;
?>