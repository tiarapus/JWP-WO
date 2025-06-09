<?php
include '../layouts/authLayout.php';
include '../components/auth.php';

$error = "";
$buttonName = 'register';
$buttonTitle = 'Register Account';
if (isset($_POST[$buttonName])) {
    // Validate and sanitize user input
    // $nama = strip_tags($_POST['nama']);
    $username = strip_tags($_POST['username']);
    if (isUsernameExists($username)) {
        // Username already exists, display an error message
        $error = 'Username tidak tersedia';
    } else {
        if (register($_POST) > 0) {
            echo "<script>
                alert('Akun berhasil dibuat!');
                document.location.href = 'login.php';
                </script>";
        } else {
            echo "<script>
                alert('Akun gagal dibuat.');
                document.location.href = 'register.php';
                </script>";
        }
    }
}


?>

<?php Auth($firstName = true, $lastName = true, $buttonName = $buttonName, $buttonTitle = $buttonTitle, $error=$error, $isRegister=true)?>


<?php
    include '../layouts/authFooter.php'
?>
