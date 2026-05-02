<?php
ob_clean(); // Clear any output buffer
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

// GET ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: Liquidation ID is required');
}
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/liquidation/getById.full-liquidation.php?id={$id}";

$json = file_get_contents($apiUrl);
if ($json === false) die('Error: Cannot connect to API');

$response = json_decode($json, true);
if (!$response || !$response['success'] || empty($response['data'])) {
    die('Liquidation record not found');
}

$l = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 12, 'LIQUIDATION OF EXPENSES', 0, 1, 'C');
        $this->Ln(3);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Homeowners Association', 0, 1, 'C');
        $this->Ln(8);
    }

    function Footer() {
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(100);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' | Generated: ' . date('M d, Y g:i A'), 0, 0, 'C');
    }

    function FormatDate($date) {
        return (!empty($date) && $date !== '0000-00-00') ? date('F d, Y', strtotime($date)) : 'Not specified';
    }

    function LiquidationReport($l) {
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 10, 'Liquidation ID: ' . str_pad($l['id'], 5, '0', STR_PAD_LEFT), 0, 1);
        $this->Ln(3);

        $this->SetFont('Arial', 'B', 13);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(50, 9, 'Project Title:', 0, 0);
        $this->SetFont('Arial', '', 13);
        $this->Cell(0, 9, $l['project_title'] ?? 'N/A', 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 9, 'Proposed By:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 9, $l['proposed_by'] ?? 'Unknown', 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 9, 'Status:', 0, 0);
        $this->SetFont('Arial', 'B', 13);
        $status = $l['status_label'] ?? 'Unknown';
        if ($status === 'Approved') $this->SetTextColor(0, 140, 0);
        elseif ($status === 'Rejected') $this->SetTextColor(200, 0, 0);
        else $this->SetTextColor(255, 140, 0);
        $this->Cell(60, 9, $status, 0, 0);
        $this->SetTextColor(0, 0, 0);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 9, 'Date:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 9, $this->FormatDate($l['liquidation_date'] ?? null), 0, 1);

        $this->Ln(8);

        $this->SetFillColor(240, 248, 255);
        $this->SetDrawColor(0, 51, 102);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'BUDGET SUMMARY', 1, 1, 'C', true);

        $this->SetFont('Arial', '', 11);
        $this->Cell(80, 9, 'Approved Budget:', 1, 0);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 9, 'PHP ' . number_format($l['approved_budget'] ?? 0, 2), 1, 1, 'R');

        $this->SetFont('Arial', '', 11);
        $this->Cell(80, 9, 'Reported Total Expenses:', 1, 0);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 9, 'PHP ' . number_format($l['reported_total'] ?? 0, 2), 1, 1, 'R');

        $this->SetFont('Arial', '', 11);
        $this->Cell(80, 9, 'Actual Total Spent:', 1, 0);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 9, 'PHP ' . ($l['actual_total_spent'] ?? '0.00'), 1, 1, 'R');

        $this->SetFont('Arial', '', 11);
        $this->Cell(80, 9, 'Remaining Budget:', 1, 0);
        $this->SetFont('Arial', 'B', 12);
        if (($l['is_over_budget'] ?? false)) {
            $this->SetTextColor(200, 0, 0);
            $this->Cell(0, 9, 'OVER BUDGET by PHP ' . ($l['over_budget_amount'] ?? '0.00'), 1, 1, 'R');
        } else {
            $this->SetTextColor(0, 120, 0);
            $this->Cell(0, 9, 'PHP ' . ($l['remaining_budget'] ?? '0.00'), 1, 1, 'R');
        }
        $this->SetTextColor(0, 0, 0);

        $this->Ln(8);

        if (!empty($l['budget_recipient'])) {
            $this->SetFont('Arial', 'B', 12);
            $this->SetFillColor(245, 245, 255);
            $this->Cell(0, 9, 'BUDGET RELEASE DETAILS', 1, 1, 'C', true);

            $this->SetFont('Arial', '', 11);
            $this->Cell(60, 8, 'Released To:', 1, 0);
            $this->Cell(0, 8, $l['budget_recipient'], 1, 1);
            $this->Cell(60, 8, 'Release Date:', 1, 0);
            $this->Cell(0, 8, $this->FormatDate($l['budget_release_date'] ?? null), 1, 1);
            $this->Cell(60, 8, 'Reference No.:', 1, 0);
            $this->Cell(0, 8, $l['budget_ref_no'] ?? '-', 1, 1);

            $this->Ln(5);
        }

        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(0, 51, 102);
        $this->SetTextColor(255);
        $this->Cell(10, 10, 'No.', 1, 0, 'C', true);
        $this->Cell(80, 10, 'Particular', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Qty', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Amount', 1, 0, 'C', true);
        $this->Cell(35, 10, 'Total', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Date', 1, 1, 'C', true);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0);
        $no = 1;
        foreach ($l['expenses_details'] as $item) {
            $this->Cell(10, 8, $no++, 1, 0, 'C');
            $this->Cell(80, 8, substr($item['particular'] ?? '', 0, 45), 1, 0);
            $this->Cell(20, 8, $item['quantity'] ?? '', 1, 0, 'C');
            $this->Cell(30, 8, number_format($item['amount'] ?? 0, 2), 1, 0, 'R');
            $this->Cell(35, 8, number_format($item['total_expenses'] ?? 0, 2), 1, 0, 'R');
            $this->Cell(30, 8, $this->FormatDate($item['expense_date'] ?? null), 1, 1, 'C');
        }

        $this->SetFont('Arial', 'B', 13);
        $this->SetFillColor(230, 240, 255);
        $this->SetTextColor(0);
        $this->Cell(140, 12, 'GRAND TOTAL', 1, 0, 'R', true);
        $this->Cell(65, 12, 'PHP ' . ($l['actual_total_spent'] ?? '0.00'), 1, 1, 'R', true);

        $this->Ln(15);

        $this->SetFont('Arial', '', 12);
        $this->Cell(90, 10, 'Prepared by:', 0, 0);
        $this->Cell(90, 10, 'Reviewed and Approved by:', 0, 1);
        $this->Ln(20);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(90, 8, '___________________________', 'B', 0, 'C');
        $this->Cell(90, 8, '___________________________', 'B', 1, 'C');

        $this->SetFont('Arial', '', 11);
        $this->Cell(90, 8, 'Treasurer / Project Head', 0, 0, 'C');
        $this->Cell(90, 8, 'HOA President / Auditor', 0, 1, 'C');

        $this->Ln(10);
        $this->Cell(0, 8, 'Date: __________________________', 0, 1, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 25);
$pdf->AddPage();
$pdf->LiquidationReport($l);

$filename = 'Liquidation_Report_ID_' . str_pad($l['id'], 5, '0', STR_PAD_LEFT) . '_' . date('Y-m-d') . '.pdf';
$pdf->Output('D', $filename);
exit;
?>