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
    $productId = isset($_GET['productId']) ? (int)$_GET['productId'] : null;
    
    if ($productId !== null) {
        $result = deleteProduct($productId);
        echo "<script>
            alert('Product has successfully deleted!');
            document.location.href = 'adminDashboard.php'
            </script>";
    } else {
        echo "<script>
        alert('No product Selected!');
        document.location.href = 'adminDashboard.php'
        </script>";
    }
   
    


    

?>

<?php
    }
    include '../layouts/adminFooter.php'
?>
