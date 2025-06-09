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


    if ($orderId !== null) {
        $orders =  select("SELECT od.*, o.orderId, p.productName, p.price, p.productId, p.deletedAt
        FROM orders o 
        JOIN order_details od ON o.orderId = od.orderId 
        JOIN products p ON od.productId = p.productId 
        WHERE od.orderId = $orderId; 
        ");
    }

?>

<div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Order Details
        </h1>
        <a href="../pages/orders.php" class="bg-black text-sm text-white py-2 px-3 rounded-lg w-fit">Back</a>
    </div>
    <div class="overflow-x-auto border sm:rounded-lg shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
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
                            <?= $item['productName'] ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= formatRupiah($item['price']) ?>
                        </td>
                    </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>
    </div>
   

<?php } else {     
include '../layouts/authLayout.php';?>
    <div class="max-w-5xl h-screen mx-auto text-2xl py-24 font-bold text-center">
        404 Page Not Found
    </div>
<?php }?>    

<?php
    include '../layouts/adminFooter.php'
?>
