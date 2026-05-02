<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/fpdf186/fpdf.php';

$apiUrl = 'http://localhost/hoa_system/app/api/users/get.full-boardmembers.php'; 
$json = file_get_contents($apiUrl);

if ($json === false) die('Error: Could not fetch data from API');

$response = json_decode($json, true);
if (!$response || !$response['success']) die('Error: Invalid API response or no data available');

$data = $response['data'];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 10, 'User Records Report', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(0,0,0);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }

    function userProfile($user) {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(0, 51, 102);
        $this->Cell(0, 10, 'User ID: ' . $user['user_id'], 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(40, 8, 'Full Name:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['fullName'], 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Email:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['email_address'], 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Role:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['role_name'], 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Status:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['status'], 0, 1);

        $this->Ln(4);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Phone Number:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['phone_number'] ?? '-', 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Date of Birth:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['date_of_birth'] ?? '-', 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Citizenship:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['citizenship'] ?? '-', 0, 1);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 8, 'Civil Status:', 0, 0);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 8, $user['civil_status'] ?? '-', 0, 1);

        $this->Ln(5);
        $this->SetDrawColor(0, 51, 102);
        $this->SetLineWidth(0.5);
        $this->Line($this->GetX(), $this->GetY(), $this->GetPageWidth() - $this->GetX(), $this->GetY());
        $this->Ln(5);

        if($this->GetY() > $this->GetPageHeight() - 40) {
            $this->AddPage();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();

foreach ($data as $user) {
    $pdf->userProfile($user);
}

$pdf->Output('D', 'user_records_report.pdf');
exit;
