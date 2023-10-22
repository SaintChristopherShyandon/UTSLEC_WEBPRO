<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="bg-blue-600 py-5 px-9">

   <section class="container mx-auto flex items-center justify-between">

      <a href="home.php" class="text-xl font-bold text-white">WEBPRO RESTO</a>

      <nav class="text-center flex-grow">
         <a href="home.php" class="text-white hover:underline p-4">Home</a>
         <a href="menu.php" class="text-white hover:underline p-4">Menu</a>
         <a href="orders.php" class="text-white hover:underline p-4">Orders</a>
         <a href="about.php" class="text-white hover:underline p-4">About</a>
         <a href="contact.php" class="text-white hover:underline p-4">Contact</a>
      </nav>

      <button class="font-semibold text-white text-sm mr-4">Log in</button>
      <button class="font-semibold text-white text-sm text-center bg-blue-500 hover:bg-blue-700 rounded-full px-5 py-2.5">Sign Up</button>

   </section>

</header>
