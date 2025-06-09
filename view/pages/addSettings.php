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
    if (isset($_POST['addSettings'])){
        $result = addSettings($_POST);
        echo "<script>
            alert('Settings has successfully added!');
            document.location.href = 'adminDashboard.php'
            </script>";
    }

?>

    <div class="header flex flex-col gap-y-4">
        <h1 class="text-xl font-semibold">
            Settings Config
        </h1>
    </div>
    <form method="post" action="">
    <div class="mb-6">
        <div>
            <label for="website_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Website Name</label>
            <input type="text" id="website_name" name="website_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input website name" required />
        </div>
    </div>
    
    <div class="mb-6">
        <label for="descriptions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descriptions</label>
        <textarea id="descriptions" name="descriptions" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input descriptions" required></textarea>
    </div>
    
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input email" required />
        </div>
        <div>
            <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
            <input type="text" id="phoneNumber" name="phoneNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input phone number" required />
        </div>
    </div>
    
    <div class="mb-6">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
        <textarea id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input address" required></textarea>
    </div>
    
    <div class="mb-6">
        <label for="maps" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Google Maps URL</label>
        <textarea id="maps" name="maps" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input Google Maps Iframe" required></textarea>

    </div>
    
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="instagram" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instagram URL</label>
            <input type="text" id="instagram" name="instagram" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input Instagram URL" required />
        </div>
        <div>
            <label for="facebook" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook URL</label>
            <input type="text" id="facebook" name="facebook" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input Facebook URL" required />
        </div>
        <div>
            <label for="tiktok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TikTok URL</label>
            <input type="text" id="tiktok" name="tiktok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input TikTok URL" required />
        </div>
    </div>
    
    <div class="mb-6">
        <label for="bhours" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business Hours</label>
        <textarea id="bhours" name="bhours" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input business hours" required></textarea>
    </div>

    <div class="text-right">
        <button type="submit" name="addSettings" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Submit
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
