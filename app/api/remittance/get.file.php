<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/remittance/get.details.php";
$json = file_get_contents($apiUrl);
$response = json_decode($json, true)['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',20);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'REMITTANCE MASTER LIST',0,1,'C');
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
        $this->Cell(15,10,'RV#',1,0,'C',true);
        $this->Cell(40,10,'Date',1,0,'C',true);
        $this->Cell(60,10,'Submitted By',1,0,'C',true);
        $this->Cell(70,10,'Particular',1,0,'C',true);
        $this->Cell(30,10,'Type',1,0,'C',true);
        $this->Cell(35,10,'Amount',1,0,'C',true);
        $this->Cell(25,10,'Status',1,1,'C',true);

        $this->SetFont('Arial','',9); $this->SetTextColor(0);
        foreach ($data as $r) {
            $this->Cell(15,8,str_pad($r['id'],4,'0',STR_PAD_LEFT),1,0,'C');
            $this->Cell(40,8,$r['date_formatted'],1,0,'C');
            $this->Cell(60,8,substr($r['full_name'] ?? 'N/A',0,28),1,0);
            $this->Cell(70,8,substr($r['particular'],0,35),1,0);
            $this->Cell(30,8,$r['type_label'],1,0,'C');
            $this->Cell(35,8,'PHP '.$r['amount_formatted'],1,0,'R');
            $this->Cell(25,8,$r['status_label'],1,1,'C');
        }
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->List($response);
$pdf->Output('D','Remittance_Master_List_'.date('Y-m-d').'.pdf');
exit;
?>