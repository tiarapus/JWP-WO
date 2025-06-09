<?php
include '../layouts/header.php';



$categories = select("SELECT * FROM categories LIMIT 5");
$products = select("SELECT * FROM products LIMIT 5");


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

<div class="max-w-5xl mx-auto py-12">
    <div class="about-us flex flex-row justify-between items-center pb-12">
        <img src="../../assets/img/bg/heero.jpg" class="w-1/4" alt="">
        <div class="flex flex-col gap-y-6 px-5 mx-auto text-center">
            <h1 class="font-extrabold text-3xl font-playwrite">
                Lorem Ipsum
            </h1>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores voluptate qui obcaecati voluptatem dolorum, dolore atque consequuntur laudantium sapiente nam doloremque doloribus itaque? Ea consequuntur maxime officiis dolorum. Ratione, corporis!
            </p>
            <div class="cta">
                <a href="#" class="px-3 py-2 border-[1.5px] border-black bg-black text-white font-semibold rounded-sm hover:shadow-xl">Get Started</a>


                <a href="#collection" class="px-3 py-2 border-[1.5px] font-semibold border-black rounded-sm hover:bg-black hover:text-white">See Our Collections</a>
            </div>
        </div>
        <img src="../../assets/img/bg/heero.jpg" class="w-1/4" alt="">
    </div>

    <div id="collection" class="categories flex flex-col gap-y-16 py-12">
        <h1 class="font-extrabold text-3xl font-playwrite text-center">
            Our Collections
        </h1>
        <div class="flex flex-row justify-between gap-x-4">
            <?php foreach ($categories as $item) : ?>
            <a href="../pages/catalogue.php?categoryId=<?=$item['categoryId']?>" class="card w-1/5 h-fit flex flex-col gap-y-3 shadow-sm pb-3 rounded-sm">
                <img src="../../assets/img/<?= $item['img'] ?>" class=" w-full h-64 rounded-t-sm object-cover" alt="">
                <span class="text-xl font-semibold text-center "><?= $item['category'] ?></span>
            </a>
            <?php endforeach?>
        </div>
        <a href="../pages/catalogue.php" class="mx-auto underline flex flex-row justify-center items-center font-semibold gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <span className='font-semibold underline'>
                Explore More Collections
            </span>
        </a>
    </div>

</div>
<div class="bg-[#f5f5f5] w-full">
    <div class="why-us max-w-5xl mx-auto  flex flex-row justify-between gap-x-12 py-20">
        <img src="../../assets/img/bg/heero.jpg" class="w-1/2 h-96 bg-bottom basis-1/2 object-cover" alt="">
        <div class="flex flex-col gap-y-8 basis-1/2">
            <h1 class="font-playwrite font-bold text-2xl">
                Why you need to trust Jewepe? 
            </h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quis consequuntur praesentium repellendus sit suscipit quam at voluptates consectetur, deleniti adipisci assumenda. Expedita tenetur provident cupiditate ratione numquam non doloribus?
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis facere est doloremque nam, voluptates maxime maiores ducimus quasi porro, facilis aspernatur vitae ex quisquam dicta non cumque eum suscipit tempora?
            </p>
        </div>
    </div>
</div>

<div class="products max-w-5xl mx-auto flex flex-col gap-y-16 py-24">
        <h1 class="font-extrabold text-3xl font-playwrite text-center">
            Our Catalouges
        </h1>
        <div class="flex flex-row gap-x-4">
            <?php foreach($validProducts as $p) :?>
            <a href="../pages/productDetails.php?productId=<?=$p['productId']?>" class=" cards h-72 w-1/5 flex flex-col gap-y-3 ">
                <img src="../../assets/img/<?=$p['img']?>" class=" w-full h-48 object-cover" alt="">
                <div class="body flex flex-col gap-y-1">
                    <span class="font-semibold text-md">
                        <?= $p['productName'] ?>
                    </span>
                    <span class="text-base">
                    <?= formatRupiah($p['price']) ?>
                    </span>
                    
                </div>
            </a>
            <?php endforeach; ?>
            
        </div>
        <a href="../pages/catalogue.php" class="mx-auto underline flex flex-row justify-center items-center font-semibold gap-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <span className='font-semibold underline'>
                See Our Catalouges Here
            </span>
            
        </a>
</div>

<div class="address max-w-5xl mx-auto flex flex-col gap-y-20 pt-16 pb-24">
        <div class="flex flex-row justify-between gap-x-12">
            <div class="flex flex-col gap-y-8 basis-1/2">
                <h1 class="font-playwrite font-bold text-2xl">
                    Visit Our Galery in Depok! 
                </h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit quis consequuntur praesentium repellendus sit suscipit quam at voluptates consectetur, deleniti adipisci assumenda. Expedita tenetur provident cupiditate ratione numquam non doloribus?
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis facere est doloremque nam, voluptates maxime maiores ducimus quasi porro, facilis aspernatur vitae ex quisquam dicta non cumque eum suscipit tempora?
                </p>
            </div>
            <iframe class="w-72 h-80 basis-1/2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.1926123877856!2d106.83061947399149!3d-6.369114593621043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed01b68548ad%3A0x89aea3afc2b2e77d!2sUniversitas%20Gunadarma%20Kampus%20D!5e0!3m2!1sid!2sid!4v1718434990846!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

</div>

<div id="contact" class="contact max-w-5xl mx-auto flex flex-col gap-y-20 pt-16 pb-20">
    <h1 class="font-extrabold text-3xl font-playwrite text-center">
        Contact Us
    </h1>
    <form method="post" action="">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                <input type="text" id="productName" name="productName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your First Name" required />
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                <input type="text" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Your Last Name" required />
            </div>
            
        </div>
        <div class="mb-6">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your Email Address">
        </div> 
        
        <div class="mb-6">
             <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Messages</label>
            <div class="border border-gray-200 overflow-hidden rounded-md" >
                <textarea name="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-32" id="">

                </textarea>
            </div>
        </div>
        
        <div class="text-right">
            <button type="submit" name="addProduct" class="text-white px-3 py-2 bg-black rounded-sm">
                Contact Us
            </button>
        </div>
       
    </form>
</div>




<?php
    include '../layouts/footer.php'
?>
