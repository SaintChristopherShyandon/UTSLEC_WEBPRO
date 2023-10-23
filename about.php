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

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 font-sans">

<!-- Header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header section ends -->

<!-- About section starts -->
<section class="bg-white text-gray-800 py-12">
   <div class="container mx-auto flex flex-col md:flex-row items-center">
      <div class="md:w-1/2 p-6">
         <img src="images/about-img.svg" alt="About Us" class="w-full">
      </div>
      <div class="md:w-1/2 p-6">
         <h3 class="text-3xl font-bold">Kenapa harus memilih kami?</h3>
         <p class="mt-4">Restoran kami memiliki cita rasa yang khas, layanan pelanggan yang unggul, dan pastinya dapat pengalaman makan yang tak terlupakan!</p>
      </div>
   </div>
</section>
<!-- About section ends -->

<!-- Steps section starts -->
<section class="bg-gray-100 py-12">
   <div class="container mx-auto">
      <h1 class="text-3xl font-bold text-center mb-8">Langkah Praktis</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
         <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img src="images/step-1.png" alt="Choose Order" class="w-24 mx-auto mb-4">
            <h3 class="text-xl font-semibold mb-2">Pilihan Menu yang Banyak</h3>
            <p>Nikmati Beragam Pilihan Menu Lezat Kami!</p>
         </div>
         <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img src="images/step-2.png" alt="Fast Delivery" class="w-24 mx-auto mb-4">
            <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
            <p>Pengiriman yang cepat secepat kilat, tidak membuat perut laparmu menunggu lama!</p>
         </div>
         <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img src="images/step-3.png" alt="Enjoy Food" class="w-24 mx-auto mb-4">
            <h3 class="text-xl font-semibold mb-2">Rasa yang Enak</h3>
            <p>Rasa makanan kami yang enak dan lezat, dijamin membuat pelanggan ketagihan!</p>
         </div>
      </div>
   </div>
</section>

<!-- Reviews section starts -->
<section class="bg-white py-12">
   <div class="container mx-auto">
      <h1 class="text-3xl font-bold text-center mb-8">Penilaian Pelanggan</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

         <!-- Card 1 -->
         <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img src="images/pic-1.png" alt="John Deo" class="w-16 mx-auto rounded-full mb-4">
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut earum nulla sint voluptatum labore nemo.</p>
            <div class="text-yellow-400 text-xl mb-2">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <h3 class="text-xl font-semibold">John Deo</h3>
         </div>

         <!-- Card 2 -->
         <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img src="images/pic-2.png" alt="Jane Smith" class="w-16 mx-auto rounded-full mb-4">
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut earum nulla sint voluptatum labore nemo.</p>
            <div class="text-yellow-400 text-xl mb-2">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3 class="text-xl font-semibold">Jane Smith</h3>
         </div>

         <!-- Card 3 -->
         <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <img src="images/pic-3.png" alt="Mike Johnson" class="w-16 mx-auto rounded-full mb-4">
            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptate eligendi laborum molestias ut earum nulla sint voluptatum labore nemo.</p>
            <div class="text-yellow-400 text-xl mb-2">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
            </div>
            <h3 class="text-xl font-semibold">Mike Johnson</h3>
         </div>

      </div>
   </div>
</section>
<!-- Reviews section ends -->


<!-- About Us section starts -->
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
            <img src="images/" alt="About Us 3" class="w-24 mx-auto mb-4">
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
<!-- About Us section ends -->


<!-- Footer section starts -->
<?php include 'components/footer.php'; ?>
<!-- Footer section ends -->


</body>
</html>
