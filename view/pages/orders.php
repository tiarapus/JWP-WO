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
    $orders = select("SELECT orders.*, users.firstName, users.lastName FROM orders JOIN users ON orders.userId=users.userId");

    if (isset($_POST['proceed'])) {
        $result = updateOrderStatus($_POST);

    }
    if (isset($_POST['cancel'])) {
        $result = updateOrderStatus($_POST);

    }


?>



    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Orders Management
        </h1>
    </div>
    <div class="overflow-x-auto border sm:rounded-lg shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Customer
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estimated Schedule
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Made
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $item) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['firstName'] ?> <?= $item['lastName'] ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= formatRupiah($item['totalPrice']) ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['scheduled'] ?>
                        </td>
                        <th scope="col" class="px-6 py-3">
                            <?= generateDate($item['createdAt']) ?>
                        </th>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <span class="<?= $item['isProceed'] == 0 ? "text-green-500" : ($item['isProceed'] == 1 ? "text-black" : "text-red-500") ?>">
                            <?php  
                                if ($item['isProceed'] == 0 ){
                                    echo "Requested";
                                } else if ($item['isProceed'] == 1){
                                    echo "Approved";
                                } else {
                                    echo "Canceled";
                                }
                            ?>
                            </span>
                        <td class="px-6 py-4 flex flex-col gap-y-1">
                            <a href="../pages/orderDetails.php?orderId=<?=$item['orderId']?>" class="px-2 py-1 bg-black text-white text-sm rounded-md">See details</a >
                            <form method="post" class="status-form">
                                <input type="number" hidden name="orderId" value="<?= htmlspecialchars($item['orderId']) ?>">
                                
                                <button type="submit" name="proceed" value="1"
                                    class="px-2 py-1 <?= $item['isProceed'] == 1 || $item['isProceed'] == 2 ? 'bg-black text-gray-400' : 'bg-green-500 text-white' ?> text-sm rounded-md"
                                    <?= $item['isProceed'] == 1 || $item['isProceed'] == 2 ? 'disabled' : '' ?>>
                                    Proceed
                                </button>
                                <button type="submit" name="proceed" value="2"
                                    class="mt-1 px-2 py-1 <?= $item['isProceed'] == 1 || $item['isProceed'] == 2 ? 'bg-black text-gray-400' : 'bg-red-500 text-white' ?> text-sm rounded-md"
                                    <?= $item['isProceed'] == 1 || $item['isProceed'] == 2 ? 'disabled' : '' ?>>
                                    Cancel
                                </button>
                                
   
                            </form>



                          
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

<script>
//     document.addEventListener("DOMContentLoaded", function() {
//     document.querySelectorAll('.status-form').forEach(form => {
//         const select = form.querySelector('.status-select');
//         select.addEventListener('change', function() {
//             select.disabled = true; // Menonaktifkan select setelah dipilih
//             form.querySelector('[name="proceed"]').click(); // Klik tombol submit tersembunyi
//         });
//     });
// });
// document.addEventListener("DOMContentLoaded", function() {
//     document.querySelectorAll('.status-form').forEach(form => {
//         const select = form.querySelector('.status-select');
//         select.addEventListener('change', function() {
//             select.disabled = true; // Menonaktifkan select setelah dipilih
//             form.querySelector('[name="proceed"]').click(); // Klik tombol submit tersembunyi
//         });
//     });
// });
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.status-form').forEach(form => {
        const select = form.querySelector('.status-select');
        select.addEventListener('change', function() {
            // Menonaktifkan select jika opsi "Proceed" dipilih
            if (select.value === '1') {
                select.disabled = true;
            }
            // Klik tombol submit tersembunyi
            form.querySelector('[name="proceed"]').click();
        });
    });
});


</script>


<?php
    include '../layouts/adminFooter.php'
?>
