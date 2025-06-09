<?php
include '../layouts/header.php';



if (isset($_POST['buy'])){
    if(!isset($_SESSION["login"])){
        echo "<script>
        alert('Login untuk mengakses halaman');
        document.location.href = 'catalogue.php'
        </script>";
        exit;
    }
    $pId = (int)$_GET['productId'] ;
    $existingProduct = select("SELECT * FROM cart WHERE productId = $pId AND status = 0 AND userId = $userId");

    if ($existingProduct) {
        // Jika ada, tampilkan pesan peringatan
        echo "<script>
        alert('You already have this item on cart!');
        </script>";
    } else {
        // Jika tidak, tambahkan produk ke keranjang
        $result = addCart($_POST);
        echo "<script>
            alert('Product has successfully added to cart!');
            document.location.href = 'cart.php'
            </script>";
    }
}

$categories = select("SELECT * FROM categories LIMIT 5");
$productId = isset($_GET['productId']) ? (int)$_GET['productId'] : null;

if ($productId !== null) {
    $Product = select("SELECT * FROM products WHERE productId = $productId");
    $images = select("SELECT * FROM productImages WHERE productId = $productId");
}
    if (!empty($Product)) {
?>

<div class="max-w-5xl mx-auto flex flex-row gap-x-12 justify-between ">
    <div class="kiri w-1/2 py-16 bg-white">
        <div id="animation-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <?php foreach($images as $item) : ?>
                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                        <img src="../../assets/img/<?=$item['img']?>" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 h-80 object-cover" alt="...">
                    </div>
                <?php endforeach;?>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </div>
    <div class="kanan 0 w-1/2 mx-auto h-full pt-24 flex flex-col gap-y-3">
    <?php foreach($Product as $item) : ?>
        <span class="text-xl font-semibold"><?= $item['productName']?></span>  
        <span><?= formatRupiah($item['price'])?></span>   
        <p><?= $item['descriptions']?></p> 
        <form action="" method="post">
            <input type="text" hidden name="productId" value="<?=$item['productId']?>">
            <input type="text" hidden name="userId" value="<?=$userId?>">
            <button type="submit" class="px-5 py-2 bg-black text-white" name="buy">
                Buy
            </button>
        </form>
    <?php endforeach;?>
    </div>
</div>

<?php } else { ?>
    <span class="h-80 flex items-center justify-center" colspan="3">
        No data available
    </span>
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const carouselElement = document.getElementById('animation-carousel');
        const items = carouselElement.querySelectorAll('[data-carousel-item]');
        let currentIndex = 0;

        function showItem(index) {
            items.forEach((item, i) => {
                if (i === index) {
                    item.classList.remove('hidden');
                    item.classList.add('block');
                } else {
                    item.classList.remove('block');
                    item.classList.add('hidden');
                }
            });
        }

        function nextItem() {
            currentIndex = (currentIndex + 1) % items.length;
            showItem(currentIndex);
        }

        function prevItem() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showItem(currentIndex);
        }

        const nextButton = carouselElement.querySelector('[data-carousel-next]');
        const prevButton = carouselElement.querySelector('[data-carousel-prev]');

        nextButton.addEventListener('click', (event) => {
            event.preventDefault();
            nextItem();
        });
        prevButton.addEventListener('click', (event) => {
            event.preventDefault();
            prevItem();
        });

        // Initialize the first slide
        showItem(currentIndex);
    });
</script>


<?php
    include '../layouts/footer.php'
?>
