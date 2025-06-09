<?php
include '../layouts/header.php';
include '../components/datePricker.php';

if(!isset($_SESSION["login"])){
    echo "<script>
    alert('Login untuk mengakses halaman');
    document.location.href = 'home.php'
    </script>";
    exit;
}

$products = select("SELECT c.*, p.productName, p.price FROM cart c JOIN products p ON c.productId = p.productId WHERE status = 0 AND userId = $userId");



if (isset($_POST['checkout'])) {
    $selectedItems = $_POST['selectedItems'] ?? [];
    $scheduled =  $_POST['scheduled'];
    $totalPrice = $_POST['totalPrice'];
    $addOrders = addOrders($userId, $totalPrice,$scheduled);
    if (!empty($selectedItems)) {
        if (!empty($addOrders)) {
            $orderId = mysqli_insert_id($conn);
            foreach ($selectedItems as $productId) {
                $updateCart = updateCart($userId, $productId);
                $addOrderDetails = addOrderDetails($orderId, $userId, $productId);
            }
        }
    }
}


?>

<div class="max-w-5xl mx-auto w-96 justify-between py-12">
    <div class="card flex flex-col gap-y-6">
        <form method="post" class=" w-full basis-1/2">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Choose
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Products
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $item) : ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <input type="checkbox" class="product-checkbox" name="selectedItems[]" value="<?= $item['productId'] ?>"
                                data-price="<?= $item['price'] ?>">
                                <input type="hidden" name="selectedName[]" value="<?= $item['productName'] ?>">
                                <input type="hidden" name="selectedPrice[]" value="<?= $item['price'] ?>">
                                <input type="hidden" name="selectedId[]" value="<?= $item['productId'] ?>">
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
            <div class="flex flex-col gap-y-2">
                <div class="px-3 w-full flex flex-row pt-4">
                    <h5 class="font-bold">Total Harga : </h5>
                    <h5 class="ml-2" id="total"> 0 </h5>
                </div>
                <div class="flex-flex-row gap-x-12 px-3">
                    <span class="text-base font-bold">Your wedding day : </span>
                    <input class="" type="date" id="wedding_date">
                </div>
                <div class="flex-flex-row gap-x-12 px-3">
                    <span class="text-base font-bold">Estimated schedule : </span>
                    <input class="" type="date" id="estimated_schedule" name="scheduled"  readonly>
                </div>
            </div>
            <input type="hidden" name="totalPrice" value="0">
            <input type="hidden" name="userId" value="<?=$userId?>">
            <button name="checkout" class="w-full mt-4 py-2 rounded-sm text-white text-center bg-black">
                Check Out
            </button>
        </form>
      
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Menginisialisasi total harga
    let totalPrice = 0;
    function formatRupiah(amount) {
        return 'Rp ' + amount.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    }
    function updateTotalPrice() {
        $("#total").text(formatRupiah(totalPrice)); // Perbarui tampilan total harga
        $("input[name='totalPrice']").val(totalPrice); // Perbarui nilai total harga dalam input tersembunyi
    }

    // Ketika kotak centang produk berubah
    $(".product-checkbox").on("change", function () {
        totalPrice = 0; // Reset total harga
        // Iterasi melalui semua kotak centang yang dipilih
        $(".product-checkbox:checked").each(function () {
            const price = parseFloat($(this).data("price"));
            totalPrice += price; // Tambahkan harga produk yang dipilih ke total harga
        });
        updateTotalPrice(); // Perbarui tampilan total harga
    });

    // Scheduling
    var weddingDateInput = document.getElementById('wedding_date');

    // Menambahkan event listener untuk memantau perubahan pada input tanggal pernikahan
    weddingDateInput.addEventListener('change', function() {
        // Mendapatkan tanggal pernikahan yang dipilih
        var weddingDate = new Date(this.value);
        
        // Menghitung tanggal 7 hari sebelumnya
        var estimatedScheduleDate = new Date(weddingDate);
        estimatedScheduleDate.setDate(estimatedScheduleDate.getDate() - 7);
        
        // Mendapatkan elemen input estimasi jadwal
        var estimatedScheduleInput = document.getElementById('estimated_schedule');
        
        // Menetapkan nilai input estimasi jadwal dengan tanggal yang dihitung
        estimatedScheduleInput.valueAsDate = estimatedScheduleDate;
    });
</script>

<?php
include '../layouts/footer.php'
?>