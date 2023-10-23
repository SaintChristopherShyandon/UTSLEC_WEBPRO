<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
   
<!-- Header section starts -->
<?php include 'components/user_header.php'; ?>
<!-- Header section ends -->

<div class="bg-gray-200 p-4">
   <h3 class="text-2xl text-center">Menu Kami</h3>
   <p class="mt-2 text-center">
      <a href="home.php">Home</a>
      <span class="mx-2">/</span>
      <span>Menu</span>
   </p>
</div>


<!-- Menu section starts -->
<section class="text-center py-12">
   <h1 class="text-3xl font-bold text-gray-800 mb-8">Hidangan Terbaru</h1>

   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

   <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="bg-white p-4 shadow-md rounded-md">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="text-blue-600 text-xl">
            <i class="fas fa-eye"></i>
         </a>
         <button type="submit" class="text-blue-600 text-xl" name="add_to_cart">
            <i class="fas fa-shopping-cart"></i>
         </button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="text-gray-600">
            <?= $fetch_products['category']; ?>
         </a>
         <div class="text-lg font-semibold text-gray-800 mt-2"><?= $fetch_products['name']; ?></div>
         <div class="flex items-center mt-2">
            <div class="text-xl font-semibold text-gray-800">
               <span class="text-gray-500">Rp.</span><?= $fetch_products['price']; ?>
            </div>
            <input type="number" name="qty" class="ml-4 border text-gray-800" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         } else {
            echo '<p class="text-2xl text-gray-800">No products added yet!</p>';
         }
      ?>
   </div>
</section>
<!-- Menu section ends -->

<!-- Footer section starts -->
<?php include 'components/footer.php'; ?>
<!-- Footer section ends -->

<!-- Custom JS file link -->
<script src="js/script.js"></script>
</body>
</html>

