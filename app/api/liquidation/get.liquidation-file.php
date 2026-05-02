<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = 'http://localhost/hoa_system/app/api/liquidation/get.full-liquidation.php';

$json = file_get_contents($apiUrl);
if ($json === false) die('Error: Could not fetch data from API');

$response = json_decode($json, true);
if (!$response || !$response['success'] || empty($response['data'])) {
    die('No liquidation records available');
}

$data = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 12, 'LIQUIDATION OF EXPENSES REPORT', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' | Generated on ' . date('M d, Y g:i A'), 0, 0, 'C');
    }

    function FormatDate($date) {
        return (!empty($date) && $date !== '0000-00-00') ? date('F d, Y', strtotime($date)) : 'Not specified';
    }

    function LiquidationRecord($l) {
        $this->SetFont('Arial', 'B', 15);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 10, 'Liquidation ID: ' . str_pad($l['id'], 5, '0', STR_PAD_LEFT), 0, 1);

        $this->SetFont('Arial', 'B', 13);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(50, 10, 'Project Title:', 0, 0);
        $this->SetFont('Arial', '', 13);
        $this->Cell(0, 10, $l['project_title'] ?? 'N/A', 0, 1);

        $status = $l['status_label'] ?? 'Unknown';
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 9, 'Status:', 0, 0);
        $this->SetFont('Arial', 'B', 12);
        if ($status === 'Approved') $this->SetTextColor(0, 128, 0);
        elseif ($status === 'Rejected') $this->SetTextColor(200, 0, 0);
        else $this->SetTextColor(255, 140, 0);
        $this->Cell(60, 9, $status, 0, 0);
        $this->SetTextColor(0, 0, 0);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 9, 'Date:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 9, $this->FormatDate($l['liquidation_date'] ?? null), 0, 1);

        $this->Ln(3);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 8, 'Approved Budget:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(60, 8, 'PHP ' . number_format($l['approved_budget'] ?? 0, 2), 0, 0);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Reported Total:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, 'PHP ' . number_format($l['reported_total'] ?? 0, 2), 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 8, 'Actual Spent:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(60, 8, 'PHP ' . ($l['actual_total_spent'] ?? '0.00'), 0, 0);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Remaining:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $remaining = $l['remaining_budget'] ?? '0.00';
        if (($l['is_over_budget'] ?? false)) {
            $this->SetTextColor(200, 0, 0);
            $this->Cell(0, 8, 'OVER BUDGET by PHP ' . ($l['over_budget_amount'] ?? '0.00'), 0, 1);
        } else {
            $this->SetTextColor(0, 100, 0);
            $this->Cell(0, 8, 'PHP ' . $remaining, 0, 1);
        }
        $this->SetTextColor(0, 0, 0);

        $this->Ln(3);
        if (!empty($l['budget_recipient'])) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(50, 8, 'Budget Released To:', 0, 0);
            $this->SetFont('Arial', '', 12);
            $this->Cell(0, 8, $l['budget_recipient'], 0, 1);

            $this->SetFont('Arial', 'B', 12);
            $this->Cell(50, 8, 'Release Date:', 0, 0);
            $this->SetFont('Arial', '', 12);
            $this->Cell(60, 8, $this->FormatDate($l['budget_release_date'] ?? null), 0, 0);

            $this->SetFont('Arial', 'B', 12);
            $this->Cell(40, 8, 'Ref No.:', 0, 0);
            $this->SetFont('Arial', '', 12);
            $this->Cell(0, 8, $l['budget_ref_no'] ?? '-', 0, 1);
        } else {
            $this->SetFont('Arial', 'I', 11);
            $this->SetTextColor(150, 150, 150);
            $this->Cell(0, 8, 'No budget release recorded', 0, 1);
            $this->SetTextColor(0, 0, 0);
        }

        $this->Ln(4);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 8, 'Total Items:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, ($l['total_items'] ?? 0) . ' expense item(s)', 0, 1);

        $this->Ln(8);
        $this->SetDrawColor(0, 51, 102);
        $this->SetLineWidth(0.8);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(10);

        if ($this->GetY() > 250) {
            $this->AddPage();
        }
    }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 30);
$pdf->AddPage();

foreach ($data as $liquidation) {
    $pdf->LiquidationRecord($liquidation);
}

// Final touch: Summary count
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 51, 102);
$pdf->Cell(0, 10, 'SUMMARY', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 8, 'Total Liquidation Records: ' . count($data), 0, 1);
$pdf->Cell(0, 8, 'Report Generated: ' . date('F d, Y - h:i A'), 0, 1);

$filename = 'All_Liquidations_Detailed_Report_' . date('Y-m-d') . '.pdf';
$pdf->Output('D', $filename);
exit;
?>