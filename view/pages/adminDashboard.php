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
    $products = select("SELECT * FROM products WHERE deletedAt is NULL")
?>



    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Products Management
        </h1>
        <a href="../pages/createProducts.php" class="bg-black text-sm text-white py-2 px-3 rounded-lg w-fit">Create New Product</a>
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
                    <th scope="col" class="px-6 py-3">
                        Descriptions
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $item) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['productName'] ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= formatRupiah($item['price']) ?>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['descriptions'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <a href="../pages/addProductPhotos.php?productId=<?=$item['productId']?>" class="px-3 py-2 bg-black text-white rounded-md">Add Photos</a>
                            <a href="../pages/editProducts.php?productId=<?=$item['productId']?>" class="px-3 py-2 bg-blue-500 text-white rounded-md">Edit</a>
                            <a href="../pages/deleteProduct.php?productId=<?=$item['productId']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="px-3 py-2 bg-red-500 text-white rounded-md">Delete</a>
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
