<?php
include('../../connection/connection.php'); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment History</title>
<style>
body { font-family: Arial, sans-serif; }
.payment-row { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
.print-checkbox { margin-right: 10px; }
button { padding: 8px 15px; font-size: 14px; cursor: pointer; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
<h1>Payment History</h1>

<?php
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $sql_history = "
        SELECT fa.id AS assign_id, fa.user_id, fa.next_due, fa.is_paid, ft.fee_name, ft.cadence, fa.payment_method, fa.payment_receipt_name, fa.remarks
        FROM fee_assignation fa
        JOIN fee_type ft ON fa.fee_type_id = ft.fee_type_id
        WHERE fa.user_id = '$user_id'
        AND fa.is_paid = 1
        ORDER BY fa.next_due DESC;
    ";
    $run_history = mysqli_query($conn, $sql_history);

    if(mysqli_num_rows($run_history) > 0) {
        echo '<form id="paymentForm">';
        foreach($run_history as $row_history){
            ?>
            <div class="payment-row">
                <input type="checkbox" class="print-checkbox" data-assign-id="<?php echo $row_history['assign_id']; ?>">
                
                <span><?php echo ($row_history['cadence'] == 1) ? "Cadence: Monthly" : "Cadence: One-time"; ?></span>
                <br>
                <label>Fee Name:</label> <span><?php echo $row_history['fee_name']; ?></span><br>
                <label>Due Date:</label> <span><?php echo date('M d, Y', strtotime($row_history['next_due'])); ?></span><br>
                <label>Payment Method:</label> <span><?php echo $row_history['payment_method']; ?></span><br>
                <label>Receipt Name:</label> <span><?php echo $row_history['payment_receipt_name']; ?></span><br>
                <label>Remarks:</label> <span><?php echo $row_history['remarks']; ?></span><br>
                <!-- view receipt--->
            </div>
            <?php
        }
        echo '<button type="button" onclick="printSelected()">Print Selected</button>';
        echo '</form>';
    } else {
        echo "<p>No payment history found for this user.</p>";
    }
}

?>
<button type="button" onclick="downloadPDF()">Download PDF</button>
<script>
function printSelected() {
    const selectedRows = document.querySelectorAll('.print-checkbox:checked');
    if(selectedRows.length === 0){
        alert("Please select at least one payment to print.");
        return;
    }

    let htmlContent = `
        <h2 style="text-align:center;">Payment Receipt</h2>
        <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <th style="border:1px solid #000; padding:8px;">Fee Name</th>
                <th style="border:1px solid #000; padding:8px;">Due Date</th>
                <th style="border:1px solid #000; padding:8px;">Payment Method</th>
                <th style="border:1px solid #000; padding:8px;">Receipt Name</th>
                <th style="border:1px solid #000; padding:8px;">Remarks</th>
            </tr>
    `;

    selectedRows.forEach(cb => {
        const row = cb.parentElement;
        const feeName = row.querySelector('span:nth-of-type(2)').innerText;
        const dueDate = row.querySelector('span:nth-of-type(3)').innerText;
        const paymentMethod = row.querySelector('span:nth-of-type(4)').innerText;
        const receiptName = row.querySelector('span:nth-of-type(5)').innerText;
        const remarks = row.querySelector('span:nth-of-type(6)').innerText;

        htmlContent += `
            <tr>
                <td style="border:1px solid #000; padding:8px;">${feeName}</td>
                <td style="border:1px solid #000; padding:8px;">${dueDate}</td>
                <td style="border:1px solid #000; padding:8px;">${paymentMethod}</td>
                <td style="border:1px solid #000; padding:8px;">${receiptName}</td>
                <td style="border:1px solid #000; padding:8px;">${remarks}</td>
            </tr>
        `;
    });

    htmlContent += `</table><p style="margin-top:20px;">Thank you for your payment.</p>`;

    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(`<html><head><title>Receipt</title></head><body>${htmlContent}</body></html>`);
    printWindow.document.close();
    printWindow.print();
}

async function downloadPDF() {
    const selectedRows = document.querySelectorAll('.print-checkbox:checked');
    if(selectedRows.length === 0){
        alert("Please select at least one payment to download.");
        return;
    }

    const tempDiv = document.createElement('div');
    tempDiv.style.fontFamily = 'Arial, sans-serif';
    tempDiv.style.padding = '20px';

    let htmlContent = `<h2 style="text-align:center;">Payment Receipt</h2>
        <table style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <th style="border:1px solid #000; padding:8px;">Fee Name</th>
                <th style="border:1px solid #000; padding:8px;">Due Date</th>
                <th style="border:1px solid #000; padding:8px;">Payment Method</th>
                <th style="border:1px solid #000; padding:8px;">Receipt Name</th>
                <th style="border:1px solid #000; padding:8px;">Remarks</th>
            </tr>`;

    selectedRows.forEach(cb => {
        const row = cb.parentElement;
        const feeName = row.querySelector('span:nth-of-type(2)').innerText;
        const dueDate = row.querySelector('span:nth-of-type(3)').innerText;
        const paymentMethod = row.querySelector('span:nth-of-type(4)').innerText;
        const receiptName = row.querySelector('span:nth-of-type(5)').innerText;
        const remarks = row.querySelector('span:nth-of-type(6)').innerText;

        htmlContent += `
            <tr>
                <td style="border:1px solid #000; padding:8px;">${feeName}</td>
                <td style="border:1px solid #000; padding:8px;">${dueDate}</td>
                <td style="border:1px solid #000; padding:8px;">${paymentMethod}</td>
                <td style="border:1px solid #000; padding:8px;">${receiptName}</td>
                <td style="border:1px solid #000; padding:8px;">${remarks}</td>
            </tr>`;
    });

    htmlContent += `</table><p style="margin-top:20px;">Thank you for your payment.</p>`;
    tempDiv.innerHTML = htmlContent;
    document.body.appendChild(tempDiv);

    const canvas = await html2canvas(tempDiv);
    const imgData = canvas.toDataURL('image/png');

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p', 'pt', 'a4');
    const pageWidth = pdf.internal.pageSize.getWidth();
    const pageHeight = pdf.internal.pageSize.getHeight();
    const imgProps = pdf.getImageProperties(imgData);
    const pdfHeight = (imgProps.height * pageWidth) / imgProps.width;

    pdf.addImage(imgData, 'PNG', 0, 0, pageWidth, pdfHeight);
    pdf.save('payment_receipt.pdf');

    document.body.removeChild(tempDiv);
}
</script>

</body>
</html>
