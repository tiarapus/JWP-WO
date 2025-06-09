<?php
    include '../../config/app.php';
    include '../components/sideBar.php';
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $logged_in = isset($_SESSION['userId']);
    $firstName = isset($_SESSION['firstName']);
    $lastName = isset($_SESSION['lastName']);
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
    <link rel="stylesheet" type="" href="../../assets/css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

</head>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:ital,wght@0,100;1,100&family=Ysabeau+Infant:wght@300&display=swap" rel="stylesheet">

<style>
@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);
/**
 * tailwind.config.js
 * module.exports = {
 *   variants: {
 *     extend: {
 *       backgroundColor: ['active'],
 *     }
 *   },
 * }
 */
.active\:bg-gray-50:active {
    --tw-bg-opacity:1;
    background-color: rgba(249,250,251,var(--tw-bg-opacity));
}
</style>

</head>

<body>
    <div class="flex">
        <div class="basis-1/5">
            <?php sideBar()?>
        </div>
        <div class="body basis-4/5 px-12 py-4 mx-auto h-full flex flex-col gap-y-6">
