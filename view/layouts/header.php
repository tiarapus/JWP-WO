<?php
    include '../../config/app.php';
    include '../components/navbar.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // $logged_in = isset($_SESSION['userId']);
    // $firstName = $_SESSION['firstName'];
    // $lastName = $_SESSION['lastName'];
    // $userId = $_SESSION['userId'];
    $logged_in = isset($_SESSION['userId']);
    $firstName = $_SESSION['firstName'] ?? '';
    $lastName = $_SESSION['lastName'] ?? '';
    $userId = $_SESSION['userId'] ?? '';
    $cart = 0;
    if ($logged_in && !empty($userId)) {
        $result = select("SELECT COUNT(*) as count_row FROM cart WHERE userId = '$userId' AND status = 0;");
        if ($result && count($result) > 0) {
            $cart = $result[0]['count_row'];
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../app//assets/css/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@200&family=Ysabeau+Infant:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="" href="../../assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+FR+Moderne:wght@100..400&display=swap" rel="stylesheet">
    </head>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:ital,wght@0,100;1,100&family=Ysabeau+Infant:wght@300&display=swap" rel="stylesheet">
<style>
    /* Remove the white background on autocomplete dropdown */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px rgba(255, 255, 255, 0.5) inset !important;
        -webkit-text-fill-color: #000 !important;
    }

    /* Ensure the input fields have transparent background */
    .custom-input {
        background-color: transparent !important;
    }
   
    .font-playwrite{
        font-family: "Playwrite FR Moderne";
    }
    
</style>

</head>
  <body>
    <?php if ($logged_in) {?>
        <?= navbar($logged_in, $firstName, $lastName, $cart); ?>
    <?php } else { ?>
        <?= navbar($logged_in); ?>
    <?php };?>
    
    <div class="body mt-16 w-full">

   