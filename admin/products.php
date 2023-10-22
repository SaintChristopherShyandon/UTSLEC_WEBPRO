<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'new product added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">

    <?php include '../components/admin_header.php' ?>
    <section class="p-8">

        <form action="" method="POST" enctype="multipart/form-data"
            class="max-w-xl mx-auto bg-white p-8 border border-gray-200 shadow">
            <h3 class="text-2xl text-blue-600 mb-4">Add Product</h3>
            <input type="text" required placeholder="Enter product name" name="name" maxlength="100"
                class="w-full p-2 border border-gray-200 rounded mb-4">
            <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price"
                onkeypress="if(this.value.length == 10) return false;"
                class="w-full p-2 border border-gray-200 rounded mb-4">
            <select name="category" class="w-full p-2 border border-gray-200 rounded mb-4" required>
                <option value="" disabled selected>Select Category</option>
                <option value="main dish">Main Dish</option>
                <option value="fast food">Fast Food</option>
                <option value="drinks">Drinks</option>
                <option value="desserts">Desserts</option>
            </select>
            <input type="file" name="image" class="w-full p-2 border border-gray-200 rounded mb-4"
                accept="image/jpg, image/jpeg, image/png, image/webp" required>
            <input type="submit" value="Add Product" name="add_product"
                class="w-full p-2 bg-blue-600 text-blue-100 hover:bg-blue-100 hover:text-blue-600 rounded cursor-pointer">
        </form>

    </section>
    <section class="p-8" style="padding-top: 0;">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php
            $show_products = $conn->prepare("SELECT * FROM `products`");
            $show_products->execute();
            if ($show_products->rowCount() > 0) {
                while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="bg-white border border-gray-200 shadow rounded p-4">
                <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="" class="w-full mb-2">
                <div class="flex justify-between">
                    <div class="text-2xl text-blue-600"><?= $fetch_products['price']; ?> /-</div>
                    <div><?= $fetch_products['category']; ?></div>
                </div>
                <div class="text-xl text-blue-600"><?= $fetch_products['name']; ?></div>
                <div class="flex mt-2">
                    <a href="update_product.php?update=<?= $fetch_products['id']; ?>"
                        class="bg-blue-600 text-blue-100 hover:bg-blue-100 hover:text-blue-600 p-2 rounded mr-2">Update</a>
                    <a href="products.php?delete=<?= $fetch_products['id']; ?>"
                        class="bg-red-600 text-red-100 hover:bg-red-100 hover:text-red-600 p-2 rounded"
                        onclick="return confirm('Delete this product?');">Delete</a>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<p class="text-2xl text-red-600 mt-4">No products added yet!</p>';
            }
            ?>
        </div>
    </section>
</body>

</html>