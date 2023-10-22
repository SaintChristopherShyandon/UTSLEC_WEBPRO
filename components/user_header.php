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

<header class="bg-blue-600 p-4">

   <section class="container mx-auto flex items-center justify-between">

      <a href="home.php" class="text-2xl font-bold text-white">Webpro Resto</a>

      <nav class="text-center flex-grow">
         <a href="home.php" class="text-white hover:underline p-2">Home</a>
         <a href="about.php" class="text-white hover:underline p-2">About</a>
         <a href="menu.php" class="text-white hover:underline p-2">Menu</a>
         <a href="orders.php" class="text-white hover:underline p-2">Orders</a>
         <a href="contact.php" class="text-white hover:underline">Contact</a>
         <a href="search.php" class="text-white hover:text-gray-200 p-3"><i class="fas fa-search"></i></a>
      </nav>

      <div class="profile flex items-center space-x-4">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="text-white"><?= $fetch_profile['name']; ?></p>
         <div class="flex space-x-4">
            <a href="profile.php" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-4 rounded-full">Profile</a>
            <a href="components/user_logout.php" onclick="return confirm('Logout from this website?');" class="text-red-600 hover:underline">Logout</a>
         </div>
         <p class="text-white">
            <a href="login.php" class="hover:underline">Login</a> or
            <a href="register.php" class="hover:underline">Register</a>
         </p>
         <?php
            }else{
         ?>
            <a href="login.php" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-4 rounded-full">Login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>
