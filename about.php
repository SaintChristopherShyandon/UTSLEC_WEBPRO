<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 font-sans">
    <?php include 'components/user_header.php'; ?>
    <?php include 'components/back_to_home.php'; ?>

    <section class="bg-gray-100 py-12">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-center mb-8">Tentang Kami</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="images/nayla.jpg" alt="About Us 1" class="w-16 mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-semibold mb-2">Nayla Mutiara</h3>
                    <p>NIM : 00000075205</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="images/bev.jpg" alt="About Us 2" class="w-16 mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-semibold mb-2">Beverly Vladislav Tan</h3>
                    <p>NIM : 00000074964</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="images/shyandon.jpg" alt="About Us 3" class="w-16 mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-semibold mb-2">Saint Christopher Shyandon</h3>
                    <p>NIM : 00000075026</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="images/dhawy.jpg" alt="About Us 4" class="w-16 mx-auto rounded-full mb-4">
                    <h3 class="text-xl font-semibold mb-2">Izdihar Dhawy</h3>
                    <p>NIM : 00000083436</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

</body>

</html>