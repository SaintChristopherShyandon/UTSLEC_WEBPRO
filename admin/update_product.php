<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, price = ? WHERE id = ?");
   $update_product->execute([$name, $category, $price, $pid]);

   $message[] = 'product updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'image updated!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update product</title>
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">
    <?php include '../components/admin_header.php' ?>
    <section class="update-product bg-blue-100 p-6">
        <h1 class="text-blue-600 text-3xl mb-6">Update Product</h1>

        <?php
        $update_id = $_GET['update'];
        $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $show_products->execute([$update_id]);
        if ($show_products->rowCount() > 0) {
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <form action="" method="POST" enctype="multipart/form-data"
            class="max-w-md mx-auto bg-white rounded p-4 border shadow-md">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
            <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="" class="mb-4">
            <span>Update Name</span>
            <input type="text" required placeholder="Enter product name" name="name" maxlength="100"
                class="bg-gray-200 p-2 rounded w-full mb-2" value="<?= $fetch_products['name']; ?>">
            <span>Update Price</span>
            <input type="number" min="0" max="9999999999" required placeholder="Enter product price" name="price"
                oninput="if(this.value.length == 10) return false;" class="bg-gray-200 p-2 rounded w-full mb-2"
                value="<?= $fetch_products['price']; ?>">
            <span>Update Category</span>
            <select name="category" class="bg-gray-200 p-2 rounded w-full mb-2" required>
                <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?>
                </option>
                <option value="main dish">Main Dish</option>
                <option value="fast food">Fast Food</option>
                <option value="drinks">Drinks</option>
                <option value="desserts">Desserts</option>
            </select>
            <span>Update Image</span>
            <input type="file" name="image" class="bg-gray-200 p-2 rounded w-full mb-2"
                accept="image/jpg, image/jpeg, image/png, image/webp">
            <div class="flex gap-4">
                <input type="submit" value="Update" class="bg-blue-100 p-2 rounded w-1/2 text-center cursor-pointer">
                <a href="products.php" class="bg-blue-100 p-2 rounded w-1/2 text-center cursor-pointer">Go Back</a>
            </div>
        </form>
        <?php
            }
        } else {
            echo '<p class="text-red-600 text-2xl p-4">No products added yet!</p>';
        }
        ?>
    </section>
    <script src="../js/admin_script.js"></script>
</body>

</html>