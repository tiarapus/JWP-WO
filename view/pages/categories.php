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

?>
    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Category Management
        </h1>
        <a href="../pages/createCategories.php" class="bg-black text-sm text-white py-2 px-3 rounded-lg w-fit">Create New Category</a>
    </div>
    <div class="overflow-x-auto border sm:rounded-lg shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cover
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $item) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $item['category'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <img src="../../assets/img/<?=$item['img']?>" class="w-24 h-24 object-cover" alt="">
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="../pages/editCategory.php?categoryId=<?=$item['categoryId']?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
