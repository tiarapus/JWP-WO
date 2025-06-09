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
    if (isset($_POST['addProduct'])){
        $result = addProduct($_POST);
        echo "<script>
            alert('Product has successfully added!');
            document.location.href = 'adminDashboard.php'
            </script>";
    }

    $categories =  select("SELECT * FROM categories");
?>

    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Create New Product
        </h1>
    </div>
    <form method="post" action="">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product name</label>
                <input type="text" id="productName" name="productName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input product name" required />
            </div>
            <div>
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product price</label>
                <input type="number" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Input unit price" required />
            </div>
            
        </div>
        <div class="mb-6">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
            <select required name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">-- pilih --</option>
                <?php $no = 1; ?>
                <?php foreach ($categories as $item) : ?>
                    <option value=<?= $item['categoryId'] ?>><?= $item['category']?></option>
                <?php endforeach;?>
            </select>
        </div> 
        
        <div class="mb-6">
            <div class="border border-gray-200 overflow-hidden rounded-md" x-data="app()" x-init="init($refs.wysiwyg)">
                <div class="w-full flex border-b border-gray-200 text-xl text-gray-600">
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('bold')">
                        <i class="mdi mdi-format-bold"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('italic')">
                        <i class="mdi mdi-format-italic"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('underline')">
                        <i class="mdi mdi-format-underline"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','P')">
                        <i class="mdi mdi-format-paragraph"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H1')">
                        <i class="mdi mdi-format-header-1"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H2')">
                        <i class="mdi mdi-format-header-2"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('formatBlock','H3')">
                        <i class="mdi mdi-format-header-3"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('insertUnorderedList')">
                        <i class="mdi mdi-format-list-bulleted"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 mr-1 hover:text-indigo-500 active:bg-gray-50" @click="format('insertOrderedList')">
                        <i class="mdi mdi-format-list-numbered"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-l border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyLeft')">
                        <i class="mdi mdi-format-align-left"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyCenter')">
                        <i class="mdi mdi-format-align-center"></i>
                    </button>
                    <button class="outline-none focus:outline-none border-r border-gray-200 w-10 h-10 hover:text-indigo-500 active:bg-gray-50" @click="format('justifyRight')">
                        <i class="mdi mdi-format-align-right"></i>
                    </button>
                </div>
                <div class="w-full">
                    <iframe x-ref="wysiwyg" class="w-full h-96 overflow-y-auto"></iframe>
                    <input type="hidden" name="product_description" id="product_description">
                </div>
            </div>
        </div>
        
        <div class="text-right">
            <button type="submit" name="addProduct" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
        </div>
       
    </form>


    <script>
    function app() {
        return {
            wysiwyg: null,
            init: function(el) {
                this.wysiwyg = el;
                this.wysiwyg.contentDocument.querySelector('head').innerHTML += `<style>
                *, ::after, ::before {box-sizing: border-box;}
                :root {tab-size: 4;}
                html {line-height: 1.15;text-size-adjust: 100%;}
                body {margin: 0px; padding: 1rem 0.5rem;}
                body {font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";}
                </style>`;
                this.wysiwyg.contentDocument.body.innerHTML += `
                <p>Product descriptions</p>
                `;
                this.wysiwyg.contentDocument.designMode = "on";
            },
            format: function(cmd, param) {
                this.wysiwyg.contentDocument.execCommand(cmd, !1, param||null)
            }
        }
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        document.getElementById('product_description').value = document.querySelector('[x-ref="wysiwyg"]').contentDocument.body.innerHTML;
    });
</script>

<?php } else {     
include '../layouts/authLayout.php';?>
    <div class="max-w-5xl h-screen mx-auto text-2xl py-24 font-bold text-center">
        404 Page Not Found
    </div>
<?php }?>   
 
<?php
    include '../layouts/adminFooter.php'
?>
