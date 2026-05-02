<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: Resolution ID is required');
}
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/resolutions/getById.details.php?id={$id}";

$json = @file_get_contents($apiUrl);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Check if get_by_id_resolution.php is working.');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON from API.<br>Raw: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success']) {
    die('API Error: ' . ($response['message'] ?? 'Resolution not found'));
}

if (empty($response['data'])) {
    die('Resolution data is empty.');
}

$r = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',22);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'PROJECT RESOLUTION REPORT',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Board Resolution',0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function Report($r) {
        $this->SetFont('Arial','B',18);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,12,'Resolution No: RES-'.str_pad($r['id'],4,'0',STR_PAD_LEFT),0,1);
        $this->Ln(8);

        $this->SetFont('Arial','B',16);
        $this->Cell(0,12,$r['project_resolution_title'] ?? 'Untitled Resolution',0,1);
        $this->Ln(8);

        $this->SetFillColor(240,248,255);
        $this->SetFont('Arial','B',12);
        $this->Cell(70,10,'Proposed By:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$r['proposed_by'] ?? 'N/A',1,1);

        $this->SetFont('Arial','B',12);
        $this->Cell(70,10,'Project Period:',1,0); 
        $this->SetFont('Arial','',12); 
        $this->Cell(0,10,$r['target_period'] ?? 'N/A',1,1);

        // SMART BUDGET: Released if available, otherwise Estimated
        $this->SetFont('Arial','B',12);
        $this->Cell(70,10,'Approved Budget:',1,0); 
        $this->SetFont('Arial','B',16); 
        $this->Cell(0,10,'PHP '.$r['effective_budget_formatted'],1,1,'R');

        $this->SetFont('Arial','I',10);
        $this->SetTextColor(100);
        $this->Cell(0,6,'('.($r['is_budget_released'] ? 'Actual Amount Released' : 'Estimated Budget').')',0,1,'R');
        $this->SetTextColor(0);

        $this->Ln(8);
        $this->SetFont('Arial','B',12);
        $this->MultiCell(0,8,"Project Summary:\n".($r['resolution_summary'] ?? 'No summary provided.'),1);

        $this->Ln(10);
        $this->SetFont('Arial','B',14);
        $this->SetFillColor(0,80,180); 
        $this->SetTextColor(255);
        $this->Cell(0,12,'BUDGET & LIQUIDATION STATUS',1,1,'C',true); 
        $this->SetTextColor(0);

        // Budget Release Info
        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Budget Released:',1,0); 
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$r['is_budget_released'] == 1? 'YES - PHP '.$r['released_formatted'] : 'NOT YET',1,1,'R');

        if ($r['is_budget_released']) {
            $this->Cell(80,10,'Released To:',1,0); 
            $this->Cell(0,10,$r['recipient'] ?? 'N/A',1,1);
            $this->Cell(80,10,'Reference No.:',1,0); 
            $this->Cell(0,10,$r['reference_number'] ?? 'N/A',1,1);
            $this->Cell(80,10,'Release Date:',1,0); 
            $this->Cell(0,10,$r['release_date'] ? date('M j, Y', strtotime($r['release_date'])) : 'N/A',1,1);
        }

        // Liquidation
        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Total Liquidated:',1,0); 
        $this->SetFont('Arial','B',14); 
        $this->Cell(0,10,'PHP '.$r['liquidated_formatted'],1,1,'R');

        $this->SetFont('Arial','B',12);
        $this->Cell(80,10,'Remaining Balance:',1,0); 
        $this->SetFont('Arial','B',14);
        if ($r['balance'] > 0) {
            $this->SetTextColor(0,120,0);
            $this->Cell(0,10,'PHP '.$r['balance_formatted'],1,1,'R');
        } elseif ($r['balance'] < 0) {
            $this->SetTextColor(200,0,0);
            $this->Cell(0,10,'OVERSPENT by PHP '.number_format(abs($r['balance']),2),1,1,'R');
        } else {
            $this->SetTextColor(0,100,0);
            $this->Cell(0,10,'FULLY LIQUIDATED',1,1,'R');
        }
        $this->SetTextColor(0);

        $this->Ln(20);
        $this->SetFont('Arial','',12);
        $this->Cell(90,10,'Prepared by:',0,0); 
        $this->Cell(90,10,'Approved by:',0,1,'R');
        $this->Ln(20);
        $this->SetFont('Arial','B',12);
        $this->Cell(90,8,'___________________________',0,0,'C'); 
        $this->Cell(90,8,'___________________________',0,1,'C');
        $this->SetFont('Arial','',11);
        $this->Cell(90,8,'Treasurer',0,0,'C'); 
        $this->Cell(90,8,'HOA President',0,1,'C');
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->Report($r);
$pdf->Output('D','Resolution_RES-'.str_pad($r['id'],4,'0',STR_PAD_LEFT).'_'.date('Y-m-d').'.pdf');
exit;
?>