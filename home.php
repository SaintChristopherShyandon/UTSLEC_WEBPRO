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
               <h3 class="text-4xl font-bold text-center text-blue-500">Delicious Pizza</h3>
               <div class="image w-1/2"> 
                  <img src="images/home-img-1.png" alt="" class="w-80">
               </div>
            </div>
         </div>

         <div class="carousel-item flex items-center"> 
            <div class="content text-white w-1/2 p-4">
               <h3 class="text-4xl font-bold text-center text-blue-500">Cheesy Hamburger</h3>
            </div>
            <div class="image w-1/2"> 
               <img src="images/home-img-2.png" alt="" class="w-80">
            </div>
         </div>

         <div class="carousel-item flex items-center"> 
            <div class="content text-white w-1/2 p-4"> 
               <h3 class="text-4xl font-bold text-center text-blue-500">Roasted Chicken</h3>
            </div>
            <div class="image w-1/2"> 
               <img src="images/home-img-3.png" alt="" class="w-80">
            </div>
         </div>
   </div>

   <div class="carousel-controls absolute top-0 left-0 right-0 bottom-0 w-full flex items-center justify-between">
      <button class="carousel-control-prev text-4xl text-blue-500 hover:text-blue-700 p-2">‹</button>
      <button class="carousel-control-next text-4xl text-blue-500 hover:text-blue-700 p-2">›</button>
   </div>
</section>

<section class="bg-blue-100 py-12">
   <h1 class="text-3xl font-bold text-center -mt-6 mb-8">Kategori Makanan</h1>
   
   <div class="container mx-auto flex justify-between gap-4">

      <a href="category.php class="block"">
         <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200">
            <img src="images/cat-1.png" alt="" class="w-20 mx-auto block">
            <a href="#">
               <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Makanan Cepat Saji</h5>
            </a>
            <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Makanan yang disajikan dan disiapkan dengan cepat dalam waktu yang singkat</p>
         </div>
      </a>

      <a href="category.php">
         <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200">
            <img src="images/cat-2.png" alt="" class="w-20 mx-auto block">
            <a href="#">
               <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Hidangan Utama</h5>
            </a>
            <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Hidangan yang biasanya menjadi fokus utama dalam suatu waktu makan</p>
         </div>
      </a>

      <a href="category.php">    
         <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200">
            <img src="images/cat-3.png" alt="" class="w-20 mx-auto block">
            <a href="#">
               <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Minuman</h5>
            </a>
            <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Segala jenis cairan yang dikonsumsi untuk menghilangkan dahaga, memberikan nutrisi, atau sekedar kenikmatan rasa</p>
         </div>
      </a>

      <a href="category.php">       
         <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200">
            <img src="images/cat-4.png" alt="" class="w-20 mx-auto block">
            <a href="#">
               <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Makanan Penutup</h5>
            </a>
            <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Hidangan yang disajikan setelah hidangan utama untuk menyegarkan mulut dan memberikan kenikmatan manis setelah makan</p>
         </div>
      </a>
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
