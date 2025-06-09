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
    
    $categoryId = isset($_GET['categoryId']) ? (int)$_GET['categoryId'] : null;

    if ($categoryId !== null) {
        $category =  select("SELECT * FROM categories 
        WHERE categoryId = $categoryId;
        ");
    }

    

?>

    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Create New Category
        </h1>
    </div>
    <form method="post" action="" enctype="multipart/form-data">
        <?php foreach($category as $item) :?>
        <div class="mb-6">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
            <input type="text" id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required 
            value="<?=$item['category']?>" />
        </div> 
        <div class="mb-6">
        <input type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required id="cover" name="cover" placeholder="Category Image">
        </div>
        <?php endforeach;?> 
        <div class="text-right">
            <button type="submit" name="addCategory" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create 
            Category
            </button>
        </div>
    </form>

<?php } else {     
include '../layouts/authLayout.php';?>
    <div class="max-w-5xl h-screen mx-auto text-2xl py-24 font-bold text-center">
        404 Page Not Found
    </div>
<?php }?>    

<?php
    include '../layouts/adminFooter.php'
?>
