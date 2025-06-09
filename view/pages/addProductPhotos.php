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
    $productId = isset($_GET['productId']) ? (int)$_GET['productId'] : null;

    if (isset($_POST['uploadImage'])){
        $result = addProductImage($_POST);
        echo "<script>
            alert('Image has successfully uploaded!');
            document.location.href = 'addProductPhotos.php?productId=$productId'
            </script>";
    }



    if ($productId !== null) {
        $productName = select("SELECT productName FROM products WHERE productId = $productId");
        $products =  select("SELECT * FROM productImages WHERE productId = $productId");
    }

?>

    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Upload Image
        </h1>
    </div>
    <form method="post" action="" class="mb-6" enctype="multipart/form-data">
        <input type="hidden" id="productId" name="productId" value="<?= $productId ?>">

        <div class="mb-6">
        <input type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="cover" name="cover" placeholder="Category Image">
        </div> 
        <button type="submit" name="uploadImage" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Upload
        </button>
    </form>
    <div class="overflow-x-auto border sm:rounded-lg shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <?= isset($productName[0]['productName']) ? $productName[0]['productName'] : 'Product' ?>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <a href="">Delete All</a>
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($products) && count($products) > 0): ?>
                <?php foreach ($products as $item) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            <img src="../../assets/img/<?= $item['img'] ?>" class="w-24 h-24 object-cover" alt="">
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php else: ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="3">
                        No products image available
                    </td>
                </tr>
            <?php endif ?>
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
