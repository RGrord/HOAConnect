<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>HOAConnect - Acknowledgement Receipt</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>
  [x-cloak] { display: none !important; }
</style>
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
      <a href="tres-dashboard.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-tachometer-alt mr-3"></i>
        <span>Dashboard</span>
      </a>
      <a href="tres-paymenthistory.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-receipt mr-3"></i>
        <span>Payment History</span>
      </a>
      <a href="tres-remittance.php" class="flex items-center px-6 py-3 hover:bg-teal-700">
        <i class="fas fa-money-check mr-3"></i>
        <span>Remittance</span>
      </a>
      <!-- Amenities Dropdown -->
      <div x-data="{ open: false }">
        <button @click="open = !open" :aria-expanded="open" class="flex items-center w-full px-6 py-3 hover:bg-teal-600 focus:outline-none">
          <i class="fas fa-swimming-pool mr-3"></i>
          <span class="flex-1 text-left">Amenities</span>
          <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div x-show="open" x-cloak class="bg-teal-800 text-sm">
          <!-- Tricycle Navigation -->
          <div class="relative">
            <button @click="window.location.href='tres-tricycle.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-bicycle mr-2" title="Tricycle"></i>
              <span class="flex-1 text-left">Tricycle</span>
            </button>
          </div>
          <!-- Court Navigation -->
          <div class="relative">
            <button @click="window.location.href='tres-court.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-basketball-ball mr-2" title="Court"></i>
              <span class="flex-1 text-left">Court</span>
            </button>
          </div>
          <!-- Stall Navigation -->
          <div class="relative">
            <button @click="window.location.href='tres-stall.php'" class="flex items-center w-full px-10 py-2 hover:bg-teal-600 focus:outline-none">
              <i class="fas fa-store mr-2" title="Stall"></i>
              <span class="flex-1 text-left">Stall</span>
            </button>
          </div>
        </div>
      </div>
      <a href="tres-project.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-gavel mr-3"></i>
        <span>Resolution</span>
      </a>
      <a href="tres-ledger.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-book mr-3"></i>
        <span>Ledger</span>
      </a>
      <a href="tres-acknowledgement.php" class="flex items-center px-6 py-3 bg-teal-700">
        <i class="fas fa-file-invoice mr-3"></i>
        <span>Receipt</span>
      </a>
      <a href="tres-newsfeed.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-newspaper mr-3"></i>
        <span>News Feed</span>
      </a>
      <a href="tres-calendar.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-calendar-alt mr-3"></i>
        <span>Calendar</span>
      </a>
      <a href="tres-profile.php" class="flex items-center px-6 py-3 hover:bg-teal-600">
        <i class="fas fa-user-circle mr-3"></i>
        <span>Profile</span>
      </a>
    </nav>
    <div class="px-6 py-4 mt-auto">
      <button class="mt-4 w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded flex items-center justify-center">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </div>
  </div>
   <!--Main content -->
   <div class="flex-1 overflow-x-hidden overflow-y-auto">
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">Acknowledgement Receipt</h1>
            <div class="flex items-center space-x-2">
              <button class="bg-teal-100 p-2 rounded-full text-teal-600 hover:bg-teal-200">
                <i class="fas fa-bell"></i>
              </button>
            </div>
          </div>
    </header>
    <main class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <!--Form card -->
      <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-100">
        <div class="flex items-center mb-6">
          <div class="bg-teal-100 p-3 rounded-lg mr-4">
            <i class="fas fa-file-invoice text-teal-600 text-2xl"></i>
          </div>
          <div>
            <h2 class="text-2xl font-bold text-gray-900">Generate Receipt</h2>
            <p class="text-sm text-gray-500">Fill in the details below to create an acknowledgement receipt</p>
          </div>
        </div>
        
        <form id="receiptForm" class="space-y-5">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label for="receiptNo" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-hashtag text-teal-600 mr-1"></i> Receipt No.
              </label>
              <input type="text" id="receiptNo" name="receiptNo" readonly class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 bg-gray-50 text-gray-700 font-medium focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
            </div>
            <div>
              <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-calendar text-teal-600 mr-1"></i> Date
              </label>
              <input type="date" id="date" name="date" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
            </div>
          </div>

          <div class="bg-teal-50 p-5 rounded-lg border border-teal-100">
            <h3 class="text-sm font-bold text-teal-900 mb-4 uppercase tracking-wide">Party Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label for="receiverName" class="block text-sm font-semibold text-gray-700 mb-2">
                  <i class="fas fa-user-check text-teal-600 mr-1"></i> Name of Receiver
                </label>
                <input type="text" id="receiverName" name="receiverName" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
              </div>
              <div>
                <label for="payerName" class="block text-sm font-semibold text-gray-700 mb-2">
                  <i class="fas fa-user text-teal-600 mr-1"></i> Name of Payer
                </label>
                <input type="text" id="payerName" name="payerName" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-teal-500 focus:border-transparent"/>
              </div>
            </div>
          </div>

          <div class="bg-blue-50 p-5 rounded-lg border border-blue-100">
            <h3 class="text-sm font-bold text-blue-900 mb-4 uppercase tracking-wide">Payment Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
              <div>
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                  <i class="fas fa-peso-sign text-blue-600 mr-1"></i> Amount (₱)
                </label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent"/>
              </div>
              <div>
                <label for="paymentMethod" class="block text-sm font-semibold text-gray-700 mb-2">
                  <i class="fas fa-credit-card text-blue-600 mr-1"></i> Payment Method
                </label>
                <select id="paymentMethod" name="paymentMethod" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="CASH">CASH</option>
                  <option value="GCASH">GCASH</option>
                  <option value="BANK TRANSFER">BANK TRANSFER</option>
                </select>
              </div>
            </div>
            <div class="mt-5">
              <label for="purpose" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-clipboard-list text-blue-600 mr-1"></i> Purpose
              </label>
              <input type="text" id="purpose" name="purpose" required class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent"/>
            </div>
          </div>

          <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wide">Additional Information (Optional)</h3>
            <div class="space-y-4">
              <div>
                <label for="referenceNumber" class="block text-sm font-semibold text-gray-700 mb-2">
                  <i class="fas fa-barcode text-gray-600 mr-1"></i> Reference Number
                </label>
                <input type="text" id="referenceNumber" name="referenceNumber" class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-gray-400 focus:border-transparent"/>
              </div>
              <div>
                <label for="remarks" class="block text-sm font-semibold text-gray-700 mb-2">
                  <i class="fas fa-comment-dots text-gray-600 mr-1"></i> Remarks
                </label>
                <input type="text" id="remarks" name="remarks" class="block w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 focus:ring-2 focus:ring-gray-400 focus:border-transparent"/>
              </div>
            </div>
          </div>

          <div class="flex justify-end pt-4">
            <button type="submit" class="py-3 px-8 border border-transparent rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
              <i class="fas fa-file-pdf mr-2"></i> Generate Receipt
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!-- Receipt Preview Modal -->
  <div id="receiptModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full mx-4 relative transform transition-all">
      <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-teal-50 to-blue-50 rounded-t-2xl">
        <div class="flex items-center">
          <div class="bg-teal-600 p-2 rounded-lg mr-3">
            <i class="fas fa-file-invoice text-white"></i>
          </div>
          <h3 class="text-lg font-bold text-gray-900">Receipt Preview</h3>
        </div>
        <button id="closeModalButton" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-200" aria-label="Close preview">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      <div class="p-8 max-h-[70vh] overflow-y-auto">
        <div id="receiptContent" class="border-2 border-gray-200 rounded-xl p-8 bg-white shadow-inner">
          <div class="text-center border-b-2 border-teal-600 pb-4 mb-4">
            <div class="bg-teal-600 text-white inline-block px-4 py-2 rounded-lg mb-3">
              <i class="fas fa-home text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">HOAConnect</h2>
            <p class="text-sm text-gray-600 mt-1">Homeowners Association</p>
            <p class="text-xs text-gray-500">Mabuhay Homes 2000, Paliparan II, Dasmariñas City, Cavite</p>
          </div>
          
          <h3 class="text-xl font-bold text-center text-teal-700 mb-4 uppercase tracking-wide">Acknowledgement Receipt</h3>
          
          <div class="bg-gray-50 p-3 rounded-lg mb-4 text-center">
            <p class="text-sm text-gray-600">Receipt No.: <span id="previewReceiptNo" class="font-bold text-teal-700"></span></p>
          </div>

          <div class="space-y-3 text-gray-700 leading-relaxed">
            <p>I, <span id="previewReceiverName" class="font-semibold text-gray-900"></span>, hereby acknowledge that I have received from <span id="previewPayerName" class="font-semibold text-gray-900"></span> the total amount of <span class="font-bold text-teal-700">₱<span id="previewAmount"></span></span> through <span id="previewPaymentMethod" class="font-semibold"></span> for <span id="previewPurpose" class="font-semibold text-gray-900"></span> on <span id="previewDate" class="font-semibold"></span>.</p>
            
            <div class="bg-blue-50 p-3 rounded-lg mt-4">
              <p class="text-sm"><span class="font-semibold">Reference No.:</span> <span id="previewReferenceNumber"></span></p>
              <p class="text-sm"><span class="font-semibold">Remarks:</span> <span id="previewRemarks"></span></p>
            </div>
          </div>

          <div class="flex justify-between mt-10 pt-6 border-t border-gray-300">
            <div class="text-center">
              <div class="border-t-2 border-gray-400 pt-2 w-48">
                <p class="text-xs text-gray-600 font-semibold">Signature over Printed Name</p>
                <p class="text-xs text-gray-500 mt-1">Receiver</p>
              </div>
            </div>
            <div class="text-center">
              <div class="border-t-2 border-gray-400 pt-2 w-48">
                <p class="text-xs text-gray-600 font-semibold">Signature over Printed Name</p>
                <p class="text-xs text-gray-500 mt-1">Payer</p>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-center mt-6">
          <button id="downloadPdfButton" class="py-3 px-8 border border-transparent rounded-lg text-sm font-semibold text-white bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
            <i class="fas fa-download mr-2"></i> Download as PDF
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function() {
  const receiptForm = document.getElementById('receiptForm');
  const receiptModal = document.getElementById('receiptModal');
  const closeModalButton = document.getElementById('closeModalButton');
  const downloadPdfButton = document.getElementById('downloadPdfButton');

  let receiptCounter = 1;
  const year = new Date().getFullYear();
  document.getElementById('receiptNo').value = `AR-${year}-${String(receiptCounter).padStart(3,'0')}`;

  function closeReceiptModal() {
    receiptModal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }
  closeModalButton.addEventListener('click', closeReceiptModal);
  receiptModal.addEventListener('click', function(e){
    if (e.target === receiptModal) closeReceiptModal();
  });

  receiptForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const receiptNo = document.getElementById('receiptNo').value;
    const receiverName = document.getElementById('receiverName').value;
    const payerName = document.getElementById('payerName').value;
    const amountRaw = parseFloat(document.getElementById('amount').value) || 0;
    const amount = amountRaw.toLocaleString('en-PH', { minimumFractionDigits: 2 });
    const paymentMethod = document.getElementById('paymentMethod').value;
    const purpose = document.getElementById('purpose').value;
    const date = document.getElementById('date').value;
    const referenceNumber = document.getElementById('referenceNumber').value || 'N/A';
    const remarks = document.getElementById('remarks').value || 'N/A';

    document.getElementById('previewReceiptNo').textContent = receiptNo;
    document.getElementById('previewReceiverName').textContent = receiverName;
    document.getElementById('previewPayerName').textContent = payerName;
    document.getElementById('previewAmount').textContent = amount;
    document.getElementById('previewPaymentMethod').textContent = paymentMethod;
    document.getElementById('previewPurpose').textContent = purpose;
    document.getElementById('previewDate').textContent = date;
    document.getElementById('previewReferenceNumber').textContent = referenceNumber;
    document.getElementById('previewRemarks').textContent = remarks;

    receiptModal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');

    receiptCounter++;
    document.getElementById('receiptNo').value = `AR-${year}-${String(receiptCounter).padStart(3,'0')}`;
  });

  downloadPdfButton.addEventListener('click', async function() {
    const receiptNo = document.getElementById('previewReceiptNo').textContent || '';
    const receiptContent = document.getElementById('receiptContent');
    
    try {
      // Capture the receipt content as an image using html2canvas
      const canvas = await html2canvas(receiptContent, {
        scale: 2,
        useCORS: true,
        logging: false,
        backgroundColor: '#ffffff'
      });

      const { jsPDF } = window.jspdf;
      const imgData = canvas.toDataURL('image/png');
      
      // Create PDF with A4 dimensions
      const doc = new jsPDF({
        unit: 'mm',
        format: 'a4',
        orientation: 'portrait'
      });

      const pageWidth = doc.internal.pageSize.getWidth();
      const pageHeight = doc.internal.pageSize.getHeight();
      
      // Calculate dimensions to fit the image on the page while maintaining aspect ratio
      const imgWidth = pageWidth - 10; // 5mm margin on each side
      const imgHeight = (canvas.height * imgWidth) / canvas.width;
      
      // Add image to PDF
      doc.addImage(imgData, 'PNG', 5, 5, imgWidth, imgHeight);
      
      // Save the PDF
      const safeReceiptNo = receiptNo ? receiptNo.replace(/\s+/g, '_') : 'Receipt';
      doc.save(`Acknowledgement_Receipt_${safeReceiptNo}.pdf`);
    } catch (error) {
      console.error('Error generating PDF:', error);
      alert('Error generating PDF. Please try again.');
    }
  });

});
</script>
</body>
</html>
