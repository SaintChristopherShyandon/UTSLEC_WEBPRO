<?php include 'components/connect.php';

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
   <title>Home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100 font-sans">

<?php include 'components/user_header.php'; ?>

<section class="hero bg-gradient-to-r">

   <div class="carousel relative">
   <div class="carousel-inner">
         <div class="carousel-item flex items-center justify-between"> 
         <div class="content text-white w-1/2 p-4"> 
            <span class="text-lg text-blue-500">Order Online</span>
            <h3 class="text-4xl font-bold text-center text-blue-500">Delicious Pizza</h3>
            <a href="menu.php" class="btn bg-blue-100 hover:bg-blue-200 text-blue-600 py-2 px-4 rounded-full mt-4">See Menus</a>
         </div>
         <div class="image w-1/2"> 
            <img src="images/home-img-1.png" alt="" class="w-80">
         </div>
      </div>

      <div class="carousel-item flex items-center"> 
         <div class="content text-white w-1/2 p-4">
            <span class="text-lg text-blue-500">Order Online</span>
            <h3 class="text-4xl font-bold text-center text-blue-500">Cheesy Hamburger</h3>
            <a href="menu.php" class="btn bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-full mt-4">See Menus</a>
         </div>
         <div class="image w-1/2"> 
            <img src="images/home-img-2.png" alt="" class="w-80">
         </div>
      </div>

      <div class="carousel-item flex items-center"> 
         <div class="content text-white w-1/2 p-4"> 
            <span class="text-lg text-blue-500">Order Online</span>
            <h3 class="text-4xl font-bold text-center text-blue-500">Roasted Chicken</h3>
            <a href="menu.php" class="btn bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-full mt-4">See Menus</a>
         </div>
         <div class="image w-1/2"> 
            <img src="images/home-img-3.png" alt="" class="w-80">
         </div>
      </div>
   </div>

   <div class="carousel-controls absolute top-0 left-0 right-0 bottom-0 w-full flex items-center justify-between opacity-0 hover:opacity-100 transition-opacity duration-300">
      <button class="carousel-control-prev text-4xl text-white hover:text-yellow-400 p-2">‹</button>
      <button class="carousel-control-next text-4xl text-white hover:text-yellow-400 p-2">›</button>
   </div>
</div>

<section class="bg-blue-100 py-12">
   <div class="container mx-auto">
      <h1 class="text-3xl font-bold text-center mb-8">Kategori Makanan</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
         <!-- Card 1: Makanan Cepat Saji -->
         <a href="category.php" class="block">
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:bg-blue-200">
               <img src="images/cat-1.png" alt="Fast Food" class="w-24 mx-auto mb-4">
               <h3 class="text-xl font-semibold mb-2">Makanan Cepat Saji</h3>
               <p>Sejenis makanan yang disajikan dan disiapkan dengan cepat, dan dalam waktu yang singkat.</p>
            </div>
         </a>

         <!-- Card 2: Hidangan Utama -->
         <a href="category.php" class="block">
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:bg-blue-200">
               <img src="images/cat-2.png" alt="Main Dishes" class="w-24 mx-auto mb-4">
               <h3 class="text-xl font-semibold mb-2">Hidangan Utama</h3>
               <p>Hidangan yang biasanya menjadi fokus utama dalam suatu waktu makan.</p>
            </div>
         </a>

         <!-- Card 3: Minuman -->
         <a href="category.php" class="block">
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:bg-blue-200">
               <img src="images/cat-3.png" alt="Drinks" class="w-24 mx-auto mb-4">
               <h3 class="text-xl font-semibold mb-2">Minuman</h3>
               <p>Segala jenis cairan yang dikonsumsi untuk menghilangkan dahaga, memberikan nutrisi, atau sekadar kenikmatan rasa.</p>
            </div>
         </a>

         <!-- Card 4: Makanan Penutup -->
         <a href="category.php" class="block">
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:bg-blue-200">
               <img src="images/cat-4.png" alt="Desserts" class="w-24 mx-auto mb-4">
               <h3 class="text-xl font-semibold mb-2">Makanan Penutup</h3>
               <p>Hidangan yang biasanya disajikan setelah hidangan utama untuk menyegarkan mulut dan memberikan kenikmatan manis sebagai penutup makanan.</p>
            </div>
         </a>
      </div>
   </div>
</section>


<section class="products text-center py-12 bg-white">

   <h1 class="title text-3xl font-bold text-gray-800 mb-8">Hidangan Terbaru</h1>

   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box bg-white p-4 shadow-md rounded-md">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye text-blue-600 text-xl"></a>
         <button type="submit" class="fas fa-shopping-cart text-blue-600 text-xl" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat text-gray-600"><?= $fetch_products['category']; ?></a>
         <div class="name text-lg font-semibold text-gray-800 mt-2"><?= $fetch_products['name']; ?></div>
         <div class="flex items-center mt-2">
            <div class="price text-xl font-semibold text-gray-800">
               <span class="text-gray-500">Rp.</span><?= $fetch_products['price']; ?>
            </div>
            <input type="number" name="qty" class="qty ml-4 border text-gray-800 items-center" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         } else {
            echo '<p class="empty text-2xl text-gray-800">No products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn mt-8">
   <a href="menu.php" class="btn bg-transparent hover:bg-transparent text-blue-500 hover:text-blue-600 border-2 border-blue-500 hover:border-blue-600 text-white py-2 px-4 rounded-full">View All</a>
</div>

</section>


<?php include 'components/footer.php'; ?>

<script>
   const carouselItems = document.querySelectorAll('.carousel-item');
   let currentSlide = 0;

   function showSlide(slideIndex) {
      if (slideIndex < 0) {
         currentSlide = carouselItems.length - 1;
      } else if (slideIndex >= carouselItems.length) {
         currentSlide = 0;
      }

      carouselItems.forEach((item, index) => {
         if (index === currentSlide) {
            item.style.display = 'block';
         } else {
            item.style.display = 'none';
         }
      });
   }

   showSlide(currentSlide);

   const prevButton = document.querySelector('.carousel-control-prev');
   const nextButton = document.querySelector('.carousel-control-next');

   prevButton.addEventListener('click', () => {
      currentSlide--;
      showSlide(currentSlide);
   });

   nextButton.addEventListener('click', () => {
      currentSlide++;
      showSlide(currentSlide);
   });

</script>


</body>
</html>
