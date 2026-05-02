<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id'])) die('Fee Type ID required');
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/fee-type/getById.details.php?id={$id}";
$json = file_get_contents($apiUrl);
$response = json_decode($json, true);
if (!$response['success']) die('Fee type not found');
$f = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',22);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'FEE TYPE DETAILS',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',16);
        $this->Cell(0,12,$GLOBALS['f']['fee_name'],0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function Details($f) {
        $this->SetFillColor(240,248,255);
        $this->SetFont('Arial','B',12);
        $this->Cell(70,12,'Fee Name:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,12,$f['fee_name'],1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(70,12,'Description:',1,0); $this->SetFont('Arial','',12); $this->MultiCell(0,12,$f['description'] ?? 'N/A',1);
        $this->SetFont('Arial','B',12);
        $this->Cell(70,12,'Amount:',1,0); $this->SetFont('Arial','B',16); $this->Cell(0,12,'PHP '.$f['amount_formatted'],1,1,'R');
        $this->SetFont('Arial','B',12);
        $this->Cell(70,12,'Effective Date:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,12,$f['effectivity_formatted'],1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(70,12,'Recurring:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,12,$f['recurring_label'],1,1);
        $this->SetFont('Arial','B',12);
        $this->Cell(70,12,'Status:',1,0); $this->SetFont('Arial','',12); $this->Cell(0,12,$f['status_label'],1,1);

        $this->Ln(20);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,'Approved by:',0,1);
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,8,'___________________________',0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'HOA Treasurer / President',0,1,'C');
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->Details($f);
$pdf->Output('D','Fee_Type_'.$f['fee_name'].'_'.date('Y-m-d').'.pdf');
exit;
?>