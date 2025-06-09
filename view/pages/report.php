<?php


session_start();
if(!isset($_SESSION["login"])){
    echo "<script>
    alert('Login untuk mengakses halaman');
    document.location.href = 'login.php'
    </script>";
    exit;
}
if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
    include '../layouts/adminLayout.php';
    $categories = select("SELECT * FROM categories");
    $orderId = isset($_GET['orderId']) ? (int)$_GET['orderId'] : null;

    $orders =  select("SELECT od.*, o.orderId, p.productName, p.price, p.productId, p.deletedAt
    FROM orders o 
    JOIN order_details od ON o.orderId = od.orderId 
    JOIN products p ON od.productId = p.productId where o.isProceed = 1
    ");
    $totalPrice = 0;
    foreach ($orders as $order) {
        $totalPrice += $order['price'];
    }

?>

<div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
           Order Reports
        </h1>
        <a href="javascript:void(0);" onclick="generatePDF()" class="bg-black text-sm text-white py-2 px-3 rounded-lg w-fit">Generate Report as PDF</a>

    </div>
    <div class="overflow-x-auto border sm:rounded-lg shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Order Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $item) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['orderId'] ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['productName'] ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= formatRupiah($item['price']) ?>
                        </td>
                    </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>
        <div class="py-4 px-2">
            <span class="text-md font-semibold">Total Revenue : </span>
            <span><?=formatRupiah($totalPrice)?></span>
        </div>
    </div>
   

<?php } else {     
include '../layouts/authLayout.php';?>
    <div class="max-w-5xl h-screen mx-auto text-2xl py-24 font-bold text-center">
        404 Page Not Found
    </div>
<?php }?>  

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>



<!-- <script>
    async function generatePDF() {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Add a header to the PDF
        pdf.setFontSize(20);
        pdf.text('Order Reports Jewepe', 20, 20);

        // Get the HTML content
        const table = document.querySelector('table');

        try {
            // Convert HTML to canvas
            const canvas = await html2canvas(table, { scale: 1 });
            const imgData = canvas.toDataURL('image/png');

            // Add the canvas image to the PDF
            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth() - 40;
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, 'PNG', 20, 30, pdfWidth, pdfHeight);

            // Save the PDF
            pdf.save('order_report.pdf');
        } catch (error) {
            console.error('Error generating PDF', error);
        }
    }
</script> -->

<script>
async function generatePDF() {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF();

    // Add a header to the PDF
    pdf.setFontSize(20);
    pdf.text('Order Reports Jewepe', 14, 22);

    // Get the HTML content
    const table = document.querySelector('table');

    // Use autoTable plugin
    pdf.autoTable({
        html: table,
        startY: 30,
        theme: 'grid',
        headStyles: { fillColor: [0, 0, 0] },
        margin: { top: 30 },
        styles: {
            cellPadding: 2,
            fontSize: 10,
            halign: 'center',
            valign: 'middle',
        },
        didDrawPage: function (data) {
            pdf.text('Total Price: Rp. <?= number_format($totalPrice, 2) ?>', 14, pdf.internal.pageSize.height - 10);
        }
    });

    // Save the PDF
    pdf.save('order_report.pdf');
}
</script>


<?php
    include '../layouts/adminFooter.php'
?>
