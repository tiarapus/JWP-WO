<?php
include '../layouts/header.php';


if(!isset($_SESSION["login"])){
    echo "<script>
    alert('Login untuk mengakses halaman');
    document.location.href = 'login.php'
    </script>";
    exit;
}

$orders = select("SELECT * FROM orders WHERE userId = $userId");
$order =  select("SELECT od.*, o.orderId, p.productName, p.price, p.productId, p.deletedAt
        FROM orders o 
        JOIN order_details od ON o.orderId = od.orderId 
        JOIN products p ON od.productId = p.productId 
        WHERE od.userId = $userId AND o.isProceed <> 2; 
        ");
if (isset($_POST['proceed'])) {
    $result = updateOrderStatus($_POST);
   
}


?>

<div class="w-2/5 mx-auto justify-center">
<h1 class="text-xl pt-12">
    Hi, User! <?=$firstName?> <?=$lastName?>
</h1>

<div class="py-12 flex w-full">
    <form method="post" action="" class="">
        <h1 class="text-base pb-4 font-semibold">
            Personal Info
        </h1>
    
        <div class="flex flex-col gap-y-3 w-96 pb-3">
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input Email Address" required />
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                <input type="number" id="phoneNumber" name="phoneNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Input phone number" required />
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input type="number" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Input your address" required />
            </div>
            
        </div>
        <button type="submit" name="addProduct" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Submit
        </button>
    </form>
</div>
    <h1 class="text-base pb-4 font-semibold">
        Your Orders
    </h1>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Order Id
            </th>
            <th scope="col" class="px-6 py-3">
                Total Amount
            </th>
            <th scope="col" class="px-6 py-3">
                Order Status
            </th>
            <th scope="col" class="px-6 py-3">
                Approved Schedule
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
            
        </tr>
    </thead>
    <tbody>
    <?php if (isset($orders) && count($orders)) : ?>
        <?php foreach ($orders as $item) : ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $item['orderId'] ?>
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= formatRupiah($item['totalPrice']) ?>
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?php  
                        if ($item['isProceed'] == 0 ){
                            echo "Requested";
                        } else if ($item['isProceed'] == 1){
                            echo "Approved";
                        } else {
                            echo "Canceled";
                        }
                    ?>
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <?php  
                        if ($item['isProceed'] == 0 || $item['isProceed'] == 2 ){
                            echo "-";
                        } else {
                            echo $item['scheduled'];
                        }
                    ?>
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <form id="cancelForm" method="post" class="status-form">
                        <input  type="number" hidden name="orderId" value="<?= $item['orderId'] ?>">
                        <button type="submit" name="proceed" value="2" class="px-2 py-1 <?= $item['isProceed'] == 0 ? 'bg-red-500 text-white ' : 'bg-gray-400 text-gray-100' ?> text-sm rounded-md " <?= $item['isProceed'] == 2 ? 'disabled' : '' ?>>Cancel Order</button>
                    </form>

                </td>
            </tr>
        <?php endforeach;?>
    <?php else :?>
            <span>No Data Available</span>
    <?php endif;?>
        </div>
    </tbody>
    </table>
    <h1 class="text-base pt-12 pb-4 font-semibold">
        Your Orders Details
    </h1>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                No.
            </th>
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
    <?php if (isset($order) && count($order)) : ?>
        <?php 
            $count = 1;
            foreach ($order as $item  ) : ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $count++ ?>
                </td>
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
    <?php else :?>
            <span>No Data Available</span>
    <?php endif;?>
        </div>
    </tbody>
    </table>
</div>

<script>
    document.getElementById('cancelForm').onsubmit = function(event) {
        var confirmation = confirm('Are you sure you want to cancel the order?');
        if (!confirmation) {
            event.preventDefault(); 
        }
    };
</script>




<?php
    include '../layouts/footer.php'
?>
