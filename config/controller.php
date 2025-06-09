<?php


function select($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
return $rows;
}

function addSettings($post) {
    global $conn;

    $website_name = $post['website_name'];
    $descriptions = $post['descriptions'];
    $email = $post['email'];
    $phoneNumber = $post['phoneNumber'];
    $address = $post['address'];
    $maps = $post['maps'];
    $instagram = $post['instagram'];
    $facebook = $post['facebook'];
    $tiktok = $post['tiktok'];
    $bhours = $post['bhours'];

    $query = "INSERT INTO settings (website_name, descriptions, email, phoneNumber, address, maps, instagram, facebook, tiktok, bhours) 
              VALUES ('$website_name', '$descriptions', '$email', '$phoneNumber', '$address', '$maps', '$instagram', '$facebook', '$tiktok', '$bhours')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deleteProduct($productId){
    global $conn;
    
    $query = "UPDATE products SET 
    deletedAt =  CURRENT_TIMESTAMP()
    WHERE productId = '$productId'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editProduct($post){
    global $conn;
    $productId  = $post['productId'];
    $productName = $post['productName'];
    $price = $post['price'];
    $categoryId = $post['category'];
    $descriptions = $post['product_description'];

    $query = "UPDATE products SET 
    productName = '$productName', 
    price = '$price', 
    categoryId = '$categoryId', 
    descriptions = '$descriptions' 
    updatedAt = CURRENT_TIMESTAMP(),
    WHERE productId = '$productId'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function updateOrderStatus($post) {
    global $conn;
    $orderStatus = $post['proceed'];
    $orderId = $post['orderId'];

    $query = "UPDATE orders SET isProceed = ' $orderStatus' WHERE orderId = '$orderId'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteOrderDetails($post) {
    global $conn;
    $orderId = $post['orderId'];

    $query = "DELETE FROM order_details WHERE orderId = '$orderId'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function addOrders($userId, $totalPrice, $scheduled) {
    global $conn;

    $query = "INSERT INTO orders 
              VALUES (null,'$userId', '$totalPrice', 0,'$scheduled', CURRENT_TIMESTAMP())";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function addOrderDetails($orderId,$userId, $productId) {
    global $conn;

    $query = "INSERT INTO order_details
              VALUES ('$orderId','$userId', '$productId', CURRENT_TIMESTAMP())";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateCart($userId, $productId) {
    global $conn;

    $query = "UPDATE cart SET status = 1 WHERE userId = '$userId' AND productId = '$productId'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function addCart($post){
    global $conn;
    $userId = $post['userId'];
    $productId = $post['productId'];
    ;

    $query = "INSERT INTO cart 
              VALUES (null, '$userId', '$productId', 0, CURRENT_TIMESTAMP())";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function addProduct($post){
    global $conn;
    $productName = $post['productName'];
    $price = $post['price'];
    $categoryId = $post['category'];
    $descriptions = $post['product_description'];

    $query = "INSERT INTO products 
              VALUES (null,'$categoryId', '$productName', '$price', '$descriptions',CURRENT_TIMESTAMP(), null, null )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function addProductImage($post){
    global $conn;
    $productId = $post['productId'];
    $redirectURL = 'addProductPhotos.php';
    $photo = upload_file($redirectURL);

    $query = "INSERT INTO productImages (productId, img, createdAt) VALUES 
    (?, ?,CURRENT_TIMESTAMP())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is",$productId,$photo);
    
    $stmt->execute();
    $stmt->close();

    return $conn->affected_rows;

}
function addCategory($post){
    global $conn;
    $category = $post['category'];
    $redirectURL = 'createCategories.php';
    $foto = upload_file($redirectURL);

    $query = "INSERT INTO categories 
              VALUES (null, '$category', '$foto',CURRENT_TIMESTAMP(), null, null )";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload_file($redirectURL){
    $nama_file = $_FILES['cover']['name'];
    $ukuran_file = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmp_name = $_FILES['cover']['tmp_name'];

    $extensiValid = ['jpg','jpeg','png'];
    $extensiFile = explode('.', $nama_file);
    $extensiFile = strtolower(end($extensiFile));

    if(!in_array($extensiFile, $extensiValid)){
        echo "<script>
            alert('Format file tidak valid!');
            document.location.href = '$redirectURL';
            </script>";
        die();
    }

    $namaFileBaru = uniqid() . '.' . $extensiFile;
    // $uploadDirectory = '../../app/assets/img/' . $namaFileBaru;
    $uploadDirectory = realpath('../../assets/img/') . '/' . $namaFileBaru;

    if (move_uploaded_file($tmp_name, $uploadDirectory)) {
        return $namaFileBaru;
    } else {
        $errorMsg = error_get_last();
        echo "<script>
             alert('Upload file gagal. Cek konfigurasi folder dan izin file. Error: " . json_encode($errorMsg) . "');
            document.location.href = '$redirectURL';
            </script>";
        die();
    }
    if($ukuran_file > 10485760){
        echo "<script>
            alert('Ukuran file terlalu besar (Max 2MB)!');
            document.location.href = '$redirectURL';
            </script>";
        die();
    }
}

function register($post){
    global $conn;

    $firstName = strip_tags($post['firstName']);
    $lastName = strip_tags($post['lastName']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $role = 1;
    $password = password_hash($password,PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users
              VALUES (null, '$username','$firstName','$lastName','$password','$role',CURRENT_TIMESTAMP(), null, null)";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function isUsernameExists($username) {
    global $conn;
    $query = "SELECT COUNT(*) FROM users WHERE LOWER(username) = LOWER(?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        return $count > 0;
    } else {
        // Debugging information
        error_log("Failed to prepare the statement: " . mysqli_error($conn));
        return false;
    }
}












