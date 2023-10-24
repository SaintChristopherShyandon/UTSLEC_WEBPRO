<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

</head>

<footer>
   <div class="p-10 bg-blue-600 text-blue-200">
      <div class="max-w-7xl mx-auto">
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
            <div class="mb-5">
               <div class="flex items-center">
                  <img src="images/location.png" alt="" class="w-5 h-5 mr-2">
                  <h4 class="font-semibold text-white">Alamat Kami</h4>
               </div>
               <a href="#" class="bg-transparent">Universitas Multimedia Nusantara | Serpong, Tangerang</a>
            </div>
            <div class="mb-5">
               <div class="flex items-center">
                  <img src="images/clock.png" alt="" class="w-5 h-5 mr-2">
                  <h4 class="font-semibold text-white">Jam Operasional</h4>
               </div>
               <p>Pukul 09:00 - 22:00</p>
            </div>
            <div class="mb-5">
               <div class="flex items-center">
                  <img src="images/phone.png" alt="" class="w-5 h-5 mr-2">
                  <h4 class="font-semibold text-white"">Nomor Kami</h4>
               </div>
               <a href="tel:1234567890" class="bg-transparent">123-456-7890</a>
               <br/>
               <a href="tel:1112223333" class="bg-transparent">111-222-3333</a>
            </div>
            <div class="mb-5">
               <div class="flex items-center">
                  <img src="images/email.png" alt="" class="w-5 h-5 mr-2">
                  <h4 class="font-semibold text-white">Email kami</h4>
               </div>
               <a href="mailto:nayla.mutiara@student.umn.ac.id" class="bg-transparent">nayla.mutiara@student.umn.ac.id</a>
               <a href="mailto:beverly.vladislav@student.umn.ac.id" class="bg-transparent">beverly.vladislav@student.umn.ac.id</a>
               <a href="mailto:saint.christopher@student.umn.ac.id" class="bg-transparent">saint.christopher@student.umn.ac.id</a>
               <a href="mailto:izdihar.dhawy@student.umn.ac.id" class="bg-transparent">izdihar.dhawy@student.umn.ac.id</a>
            </div>
         </div>
      </div>
   </div>
   <div class="credit text-center bg-blue-700 p-1 font-semibold text-sm text-blue-200">&copy; copyright @ <?= date('Y'); ?> | melayani anda dengan baik!</div>
</footer>
