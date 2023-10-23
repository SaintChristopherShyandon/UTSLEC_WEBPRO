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
    <title>quick view</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="quick-view bg-gray-100 p-12">
        <h1 class="text-3xl font-bold text-center mb-8">Detail</h1>

        <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            $product_description = $fetch_products['deskripsi'];
   ?>
        <form action="" method="post" class="box bg-white p-4 shadow-md rounded-md">
            <div class="flex justofy-center items-center">
                <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                <img src="resto-images/<?= $fetch_products['image']; ?>" alt="" class="w-1/2">
                <div class="flex flex-col justify-center ml-20">
                    <a href="category.php?category=<?= $fetch_products['category']; ?>"
                        class="justify-end flex"><?= $fetch_products['category']; ?></a>
                    <div class="name text-2xl font-bold"><?= $fetch_products['name']; ?></div>
                    <p class="text-gray-600 mt-2 mb-10"><?= $product_description ?></p>
                    <div class="flex justify-between items-center mb-6">
                        <div class="price text-2xl font-semibold"><span>Rp. </span><?= $fetch_products['price']; ?>,000
                        </div>
                        <input type="number" name="qty" class="qty w-16 p-2 border border-gray-300 rounded-md" min="1"
                            max="99" value="1" maxlength="2">
                    </div>
                    <button type="submit" name="add_to_cart"
                        class="cart-btn bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">Add
                        to Cart</button>
                </div>
            </div>
        </form>
        <?php
         }
      }else{
         echo '<p class="empty text-center text-xl font-bold mt-8">No products added yet!</p>';
      }
   ?>

    </section>

    <?php include 'components/footer.php'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

</body>

</html>