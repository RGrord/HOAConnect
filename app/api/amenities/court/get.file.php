<?php
ob_clean();
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = "http://localhost/hoa_system/app/api/amenities/court/get.details.php";

$json = file_get_contents($apiUrl);
if ($json === false) die('Cannot connect to API');

$response = json_decode($json, true);
if (!$response || !$response['success'] || empty($response['data'])) {
    die('No court rental records found');
}

$rentals = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 15, 'COURT RENTAL MASTER LIST', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(0, 10, 'Homeowners Association Multi-Purpose Court', 0, 1, 'C');
        $this->Cell(0, 10, 'As of ' . date('F d, Y'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->SetTextColor(100);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' | Generated: ' . date('M d, Y g:i A'), 0, 0, 'C');
    }

    function FormatDate($d) {
        return (!empty($d) && $d !== '0000-00-00') ? date('M j, Y', strtotime($d)) : 'N/A';
    }

    function AllCourtRentals($rentals) {
        $this->SetFont('Arial', 'B', 11);
        $this->SetFillColor(0, 51, 102);
        $this->SetTextColor(255);

        $this->Cell(12, 10, 'ID', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Renter Name', 1, 0, 'C', true);
        $this->Cell(35, 10, 'Contact', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Purpose', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Rental Date', 1, 0, 'C', true);
        $this->Cell(25, 10, 'Fee', 1, 0, 'C', true);
        $this->Cell(25, 10, 'Paid', 1, 0, 'C', true);
        $this->Cell(25, 10, 'Balance', 1, 0, 'C', true);
        $this->Cell(20, 10, 'Status', 1, 1, 'C', true);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0);

        $total_fee = $total_paid = $total_balance = 0;

        foreach ($rentals as $r) {
            $balance = (float)$r['balance'];
            $total_fee     += (float)$r['amount'];
            $total_paid    += (float)$r['total_paid'];
            $total_balance += $balance;

            $this->Cell(12, 9, str_pad($r['id'], 3, '0', STR_PAD_LEFT), 1, 0, 'C');
            $this->Cell(30, 9, substr($r['renter_name'] ?? '', 0, 25), 1, 0);
            $this->Cell(35, 9, $r['contact_no'] ?? '', 1, 0, 'C');
            $this->Cell(50, 9, substr($r['purpose'] ?? '', 0, 25), 1, 0);
            $this->Cell(50, 9, $this->FormatDate($r['start_date']) . ($r['end_date'] && $r['end_date'] != $r['start_date'] ? ' to ' . $this->FormatDate($r['end_date']) : ''), 1, 0, 'C');

            $this->Cell(25, 9, number_format($r['amount'], 0), 1, 0, 'R');
            $this->Cell(25, 9, number_format($r['total_paid'], 0), 1, 0, 'R');

            if ($balance > 0) {
                $this->SetTextColor(200, 0, 0);
                $this->Cell(25, 9, number_format($balance, 0), 1, 0, 'R');
                $this->SetTextColor(0);
            } else {
                $this->SetTextColor(0, 120, 0);
                $this->Cell(25, 9, number_format($balance, 0), 1, 0, 'C');
                $this->SetTextColor(0);
            }

            $status = $r['status_label'] ?? 'Pending';
            $this->SetTextColor($status === 'Paid' ? 0x008000 : 0xDC143C);
            $this->Cell(20, 9, $status, 1, 1, 'C');
            $this->SetTextColor(0);
        }

        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(230, 240, 255);
        $this->Cell(177, 12, 'GRAND TOTAL', 1, 0, 'R', true);
        $this->Cell(25, 12, 'PHP ' . number_format($total_fee, 0), 1, 0, 'R', true);
        $this->Cell(25, 12, 'PHP ' . number_format($total_paid, 0), 1, 0, 'R', true);
        $this->Cell(25, 12, 'PHP ' . number_format($total_balance, 0), 1, 1, 'R', true);
        $this->Cell(25, 12, '' . '','R', true);

        $this->Ln(10);
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 8, 'Total Records: ' . count($rentals), 0, 1);
        $this->Cell(0, 8, 'Unpaid Rentals: ' . count(array_filter($rentals, fn($r) => (float)$r['balance'] > 0)), 0, 1);
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetAutoPageBreak(true, 20);
$pdf->AddPage();
$pdf->AllCourtRentals($rentals);

$filename = 'Court_Rental_Master_List_' . date('Y-m-d') . '.pdf';
$pdf->Output('D', $filename);
exit;
?>