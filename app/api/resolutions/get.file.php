<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/resolutions/get.details.php";
$json = @file_get_contents($apiUrl);
if ($json === false || $json === null) {
    die('Error: Cannot connect to API. Check if get_all_resolutions.php is working.');
}

$response = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error: Invalid JSON from API.<br>Raw: <pre>' . htmlspecialchars($json) . '</pre>');
}

if (!$response['success']) {
    die('API Error: ' . ($response['message'] ?? 'Unknown error'));
}

if (empty($response['data']) || !is_array($response['data'])) {
    die('No resolution records found.');
}

$resolutions = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',22);
        $this->SetTextColor(0,51,102);
        $this->Cell(0,15,'RESOLUTION MASTER LIST',0,1,'C');
        $this->Ln(5);
        $this->SetFont('Arial','B',14);
        $this->SetTextColor(0);
        $this->Cell(0,10,'Homeowners Association Board Resolutions',0,1,'C');
        $this->Cell(0,10,'As of '.date('F d, Y'),0,1,'C');
        $this->Ln(10);
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Page '.$this->PageNo().' | Generated: '.date('M d, Y g:i A'),0,0,'C');
    }
    function List($data) {
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(0,51,102); 
        $this->SetTextColor(255);

        $this->Cell(12,10,'No.',1,0,'C',true);
        $this->Cell(70,10,'Project Title',1,0,'C',true);
        $this->Cell(40,10,'Proposed By',1,0,'C',true);
        $this->Cell(40,10,'Period',1,0,'C',true);
        $this->Cell(35,10,'Approved Budget',1,0,'C',true);
        $this->Cell(30,10,'Released',1,0,'C',true);
        $this->Cell(30,10,'Liquidated',1,0,'C',true);
        $this->Cell(30,10,'Balance',1,0,'C',true);
        $this->Cell(25,10,'Status',1,1,'C',true);

        $this->SetFont('Arial','',9); 
        $this->SetTextColor(0);

        $no = 1;
        $total_approved = $total_released = $total_liquidated = 0;

        foreach ($data as $r) {
            // Smart Budget: Released if available, otherwise Estimated
            $estimated = (float)($r['estimated_budget'] ?? 0);
            $released  = (float)($r['released_amount'] ?? 0);
            $effective = $released > 0 ? $released : $estimated;

            $liquidated = $r['liquidated_amount'] ?? 0;
            $balance    = $effective - $liquidated;

            $total_approved     += $effective;
            $total_released     += $released;
            $total_liquidated   += $liquidated;

            $this->Cell(12,9,$no++,1,0,'C');
            $this->Cell(70,9,substr($r['project_resolution_title'] ?? 'N/A',0,35),1,0);
            $this->Cell(40,9,substr($r['proposed_by'] ?? '',0,20),1,0);
            $this->Cell(40,9,$r['period'] ?? 'N/A',1,0,'C');

            // Approved Budget (smart)
            $this->Cell(35,9,number_format($effective,0),1,0,'R');

            // Released
            $this->Cell(30,9,$released > 0 ? number_format($released,0) : '-',1,0,'R');

            // Liquidated
            $this->Cell(30,9,$r['liquidation_status'] !== null ? number_format($liquidated,0) : '-',1,0,'R');

            // Balance with color
            if ($balance > 0) {
                $this->SetTextColor(0,120,0);
                $this->Cell(30,9,number_format($balance,0),1,0,'R');
            } elseif ($balance < 0) {
                $this->SetTextColor(200,0,0);
                $this->Cell(30,9,'OVER',1,0,'R');
            } else {
                $this->SetTextColor(0,100,0);
                $this->Cell(30,9,'FULL',1,0,'C');
            }
            $this->SetTextColor(0);

            // Status
            $status = $r['status_label'] ?? 'Unknown';
            $this->SetTextColor($status === 'Approved' ? 0x008000 : ($status === 'Rejected' ? 0xDC143C : 0xFF8C00));
            $this->Cell(25,9,$status,1,1,'C');
            $this->SetTextColor(0);
        }

        // GRAND TOTAL
        $this->SetFont('Arial','B',12);
        $this->SetFillColor(230,240,255);
        $this->Cell(192,12,'GRAND TOTAL',1,0,'R',true);
        $this->Cell(35,12,'PHP '.number_format($total_approved,0),1,0,'R',true);
        $this->Cell(30,12,'PHP '.number_format($total_released,0),1,0,'R',true);
        $this->Cell(30,12,'PHP '.number_format($total_liquidated,0),1,0,'R',true);
        $this->Cell(30,12,'PHP '.number_format($total_approved - $total_liquidated,0),1,1,'R',true);

        $this->Ln(10);
        $this->SetFont('Arial','',11);
        $this->Cell(0,8,'Total Resolutions: '.count($data),0,1);
        $this->Cell(0,8,'With Budget Released: '.count(array_filter($data, fn($r) => ($r['estimated_amount'] ?? 0) > 0)),0,1);
        $this->Cell(0,8,'With Liquidation: '.count(array_filter($data, fn($r) => $r['liquidation_status'] !== null)),0,1);
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->List($resolutions);
$pdf->Output('D','Resolution_Master_List_'.date('Y-m-d').'.pdf');
exit;
?>