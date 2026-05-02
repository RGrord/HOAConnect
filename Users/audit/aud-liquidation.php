<?php
session_start();
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Auditor's - Liquidation of Expenses</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body class="bg-gray-50">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <div class="bg-teal-800 text-white w-64 py-6 flex flex-col">
        <div class="px-6 mb-8">
            <h1 class="text-2xl font-bold">HOAConnect</h1>
            <p class="text-sm text-teal-200">Mabuhay Homes 2000</p>
        </div>
        <nav class="flex-1">
            <a href="aud-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600"><i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a>
            <a href="aud-liquidation.php" class="flex items-center px-6 py-3 bg-teal-700"><i class="fas fa-file-invoice-dollar mr-3"></i>Liquidation of Expenses</a>
            <a href="aud-projectproposal.php" class="flex items-center px-6 py-3 hover:bg-teal-600"><i class="fas fa-gavel mr-3"></i>Resolution</a>
            <a href="aud-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600"><i class="fas fa-newspaper mr-3"></i>News Feed</a>
            <a href="aud-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600"><i class="fas fa-book mr-3"></i>Ledger</a>
            <a href="aud-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600"><i class="fas fa-calendar-alt mr-3"></i>Calendar</a>
            <a href="aud-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600"><i class="fas fa-user-circle mr-3"></i>Profile</a>
        </nav>
        <div class="px-6 py-4 mt-auto">
            <button class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </div>
    </div>

    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-6">Liquidation of Expenses</h1>

        <div class="overflow-x-auto bg-white rounded shadow-md">
            <table class="min-w-full border-collapse border border-gray-200">
                <thead class="bg-teal-100">
                    <tr>
                        <th class="border px-4 py-2">Project Resolution</th>
                        <th class="border px-4 py-2">Budget Released</th>
                        <th class="border px-4 py-2">Liquidation Status</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    $sql = "SELECT r.id AS proj_id, r.project_resolution_title, r.estimated_budget, r.status AS res_status,
                                l.status AS liq_status
                            FROM resolution r
                            LEFT JOIN liquidation_of_expenses l ON r.id = l.project_resolution_id
                            ORDER BY r.id DESC";

                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $proj_id = $row['proj_id'];
                            $proj_title = $row['project_resolution_title'];
                            $budget = $row['estimated_budget'];

                            $liq_status = $row['liq_status'];

                            switch($liq_status) {
                                case 1:
                                    $liq_status_display = "For Approval";
                                    $button_label = "View Details";
                                    $button_link = "aud-view-liquidation.php?id=" . $proj_id;
                                    break;
                                case 2:
                                    $liq_status_display = "Approved";
                                    $button_label = "View Details";
                                    $button_link = "aud-view-liquidation.php?id=" . $proj_id;
                                    break;
                                case 3:
                                    $liq_status_display = "Rejected";
                                    $button_label = "View Details";
                                    $button_link = "aud-view-liquidation.php?id=" . $proj_id;
                                    break;
                                case 0:
                                default:
                                    $liq_status_display = "Pending";
                                    $button_label = "Generate Expense Liquidation";
                                    $button_link = "aud-generate-liquidation.php?id=" . $proj_id;
                                    break;
                            }

                            echo "<tr class='hover:bg-gray-100'>
                                    <td class='border px-4 py-2'>{$proj_title}</td>
                                    <td class='border px-4 py-2'>₱ {$budget}</td>
                                    <td class='border px-4 py-2'>{$liq_status_display}</td>
                                    <td class='border px-4 py-2 text-center'>
                                        <a href='{$button_link}' class='bg-teal-600 text-white px-4 py-1 rounded hover:bg-teal-700'>{$button_label}</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='border px-4 py-2 text-center'>No project resolutions found.</td></tr>";
                    }
                    ?>



                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>
