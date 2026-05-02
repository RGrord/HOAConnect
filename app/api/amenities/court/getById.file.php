<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Court Rental ID required');
}
$id = (int)$_GET['id'];

$apiUrl = "http://localhost/hoa_system/app/api/amenities/court/getById.details.php?id={$id}";

$json = file_get_contents($apiUrl);
if ($json === false) die('Cannot connect to API');

$response = json_decode($json, true);
if (!$response || !$response['success'] || empty($response['data'])) {
    die('Court rental record not found');
}

$c = $response['data']; 

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 22);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 15, 'COURT RENTAL RECEIPT', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Homeowners Association Multi-Purpose Court', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 9);
        $this->SetTextColor(100);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' | Generated: ' . date('M d, Y g:i A'), 0, 0, 'C');
    }

    function FormatDate($d) {
        return (!empty($d) && $d !== '0000-00-00') ? date('F j, Y', strtotime($d)) : 'N/A';
    }

    function CourtReport($c) {
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 12, 'Rental ID: CR-' . str_pad($c['id'], 5, '0', STR_PAD_LEFT), 0, 1);
        $this->Ln(5);

        $this->SetFillColor(240, 248, 255);
        $this->SetDrawColor(0, 51, 102);
        $this->SetFont('Arial', 'B', 12);

        $this->Cell(60, 10, 'Renter Name:', 1, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $c['renter_name'] ?? 'N/A', 1, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 10, 'Contact No.:', 1, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $c['contact_no'] ?? 'N/A', 1, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 10, 'Purpose:', 1, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $c['purpose'] ?? 'N/A', 1, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 10, 'Rental Date:', 1, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $this->FormatDate($c['start_date']) . ' to ' . $this->FormatDate($c['end_date']), 1, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 10, 'No. of Participants:', 1, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, $c['no_of_participants'] ?? 'N/A', 1, 1);

        $this->Ln(10);

        $this->SetFont('Arial', 'B', 14);
        $this->SetFillColor(0, 80, 180);
        $this->SetTextColor(255);
        $this->Cell(0, 12, 'PAYMENT DETAILS', 1, 1, 'C', true);
        $this->SetTextColor(0);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 10, 'Rental Fee:', 1, 0);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'PHP ' . number_format($c['amount'] ?? 0, 2), 1, 1, 'R');

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 10, 'Amount Paid:', 1, 0);
        $this->SetFont('Arial', 'B', 14);
        $paid = $c['amount_paid'] ?? 0;
        $this->Cell(0, 10, 'PHP ' . number_format($paid, 2), 1, 1, 'R');

        $balance = $c['amount'] - $paid;
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 10, 'Balance:', 1, 0);
        $this->SetFont('Arial', 'B', 14);
        if ($balance > 0) {
            $this->SetTextColor(200, 0, 0);
            $this->Cell(0, 10, 'PHP ' . number_format($balance, 2) . ' (UNPAID)', 1, 1, 'R');
        } else {
            $this->SetTextColor(0, 120, 0);
            $this->Cell(0, 10, 'FULLY PAID', 1, 1, 'R');
        }
        $this->SetTextColor(0);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 10, 'Status:', 1, 0);
        $this->SetFont('Arial', 'B', 14);
        $status = ($c['status'] ?? 0) == 1 ? 'PAID' : 'PENDING';
        $this->SetTextColor(($c['status'] ?? 0) == 1 ? 0x008000 : 0xDC143C);
        $this->Cell(0, 10, $status, 1, 1, 'C');
        $this->SetTextColor(0);

        $this->Ln(15);

        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Received by:', 0, 0, 'L');
        $this->Cell(0, 10, 'Approved by:', 0, 1, 'R');

        $this->Ln(20);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, '_________________________________', 0, 0, 'L');
        $this->Cell(0, 8, '_________________________________', 0, 1, 'R');

        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 8, 'Treasurer / Collector', 0, 0, 'L');
        $this->Cell(0, 8, 'HOA President / Sports Committee', 0, 1, 'R');

        $this->Ln(15);
        $this->SetFont('Arial', 'I', 11);
        $this->Cell(0, 8, 'Date Received: __________________________          Date Approved: __________________________', 0, 1, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 20);
$pdf->AddPage();
$pdf->CourtReport($c);

$filename = 'Court_Rental_Receipt_CR-' . str_pad($c['id'], 5, '0', STR_PAD_LEFT) . '_' . date('Y-m-d') . '.pdf';
$pdf->Output('D', $filename);
exit;
?>