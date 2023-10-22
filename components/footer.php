<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

</head>

<footer class="footer">
   <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
   <div class="box flex items-center">
      <img src="images/email-icon.png" alt="" class="w-10 h-10 mr-2 ml-12">
      <div>
         <h3 class="text-lg font-semibold">Email Kami</h3>
         <a href="mailto:nayla.mutiara@student.umn.ac.id" class="text-blue-600 bg-transparent">nayla.mutiara@student.umn.ac.id</a>
         <a href="mailto:beverly.vladislav@student.umn.ac.id" class="text-blue-600 bg-transparent">beverly.vladislav@student.umn.ac.id</a>
         <a href="mailto:saint.christopher@student.umn.ac.id" class="text-blue-600 bg-transparent">saint.christopher@student.umn.ac.id</a>
         <a href="mailto:izdihar.dhawy@student.umn.ac.id" class="text-blue-600 bg-transparent">izdihar.dhawy@student.umn.ac.id</a>
      </div>
   </div>
   <div class="box flex items-center">
      <img src="images/clock-icon.png" alt="" class="w-10 h-10 mr-2 ml-12">
      <div>
         <h3 class="text-lg font-semibold">Jam Operasional</h3>
         <p>9 Pagi s/d 10 Malam</p>
      </div>
   </div>
   <div class="box flex items-center">
      <img src="images/map-icon.png" alt="" class="w-10 h-10 mr-2 ml-12">
      <div>
         <h3 class="text-lg font-semibold">Alamat Kami</h3>
         <a href="#" class="text-blue-600 bg-transparent">Universitas Multimedia Nusantara | Serpong, Tangerang</a>
      </div>
   </div>
   <div class="box flex items-center">
      <img src="images/phone-icon.png" alt="" class="w-10 h-10 mr-2 ml-12">
      <div>
         <h3 class="text-lg font-semibold">Nomor Kami</h3>
         <a href="tel:1234567890" class="text-blue-600 bg-transparent">123-456-7890</a>
         <a href="tel:1112223333" class="text-blue-600 bg-transparent">111-222-3333</a>
      </div>
   </div>
   </section>
   <div class="credit text-center py-4">&copy; copyright @ <?= date('Y'); ?> | all rights reserved!</div>
</footer>
