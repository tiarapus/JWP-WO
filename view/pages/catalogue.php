<?php
include '../layouts/header.php';



$categories = select("SELECT * FROM categories LIMIT 5");
$categoryId = isset($_GET['categoryId']) ? (int)$_GET['categoryId'] : null;

if ($categoryId !== null) {
    $products = select("SELECT * FROM products WHERE categoryId = $categoryId LIMIT 5");
} else {
    $products = select("SELECT * FROM products LIMIT 5");
}
$validProducts = []; // Array to hold products with images
foreach ($products as $product) {
    $productId = $product['productId'];
    $image = select("SELECT img FROM productImages WHERE productId = $productId LIMIT 1");

    // Check if $image is not empty and contains the key 'img'
    if (!empty($image) && isset($image[0]['img'])) {
        // Add the image to the product array
        $product['img'] = $image[0]['img'];
        // Add the product to the validProducts array
        $validProducts[] = $product;
    }
}

?>
<div class="w-full h-[60vh]" style="background-image: url(../../assets/img/bg/heeero.jpg); background-size:cover; background-position:center;"></div>

<div class="max-w-5xl mx-auto flex flex-row gap-x-12">
    <div class="kiri w-1/5 py-16">
        <div class="cards flex flex-col h-fit gap-y-6" #f5f5f5="">
            <?php if (isset($categories) && count($categories) > 0): ?>
                <a href="../pages/catalogue.php" class="text-base">All Collections</a>
                <?php foreach($categories as $item) :?>    
                    <a href="../pages/catalogue.php?categoryId=<?=$item['categoryId']?>" class="text-base"><?=$item['category']?></a>
                <?php endforeach;?> 
            <?php else :?>
                <span>No Data Available</span>
            <?php endif;?>
            </div>
    </div>
    <div class="kanan  w-4/5  py-4 mx-auto h-full flex flex-col gap-y-6">
        <div class="flex flex-col gap-y-6">
            <h1 class="font-bold">
                Our Catalogues
            </h1>
            <div class="flex flex-wrap gap-x-4 gap-y-6 w-full">
                <?php if (isset($validProducts) && count($validProducts) > 0): ?>
                    <?php foreach($validProducts as $p) :?>    
                        <a href="../pages/productDetails.php?productId=<?=$p['productId']?>" class=" cards w-44 flex flex-col gap-y-3 ">
                            <img src="../../assets/img/<?=$p['img']?>" class="w-64 h-40 object-cover" alt="">
                            <div class="body flex flex-col gap-y-1">
                                <span class="font-semibold text-md">
                                    <?=$p['productName']?>
                                </span>
                                <span class="text-base">
                                    <?= formatRupiah($p['price'])?>
                                </span>
                            </div>
                        </a>
                    <?php endforeach;?>  
                <?php else :?>  
                    <span class="px-6 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="3">
                        No data available
                    </span>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>



<?php
    include '../layouts/footer.php'
?>
