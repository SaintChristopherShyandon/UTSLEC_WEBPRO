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
    <title>Search Page</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Tailwind CSS link -->
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <!-- Header section starts -->
    <?php include 'components/user_header.php'; ?>
    <!-- Header section ends -->

    <!-- Search form section starts -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto">
            <form method="post" action="" class="flex items-center">
                <input type="text" name="search_box" placeholder="Search here..."
                    class="p-2 rounded-l-md flex-grow border border-gray-300 focus:outline-none focus:ring focus:border-blue-300">
                <button type="submit" name="search_btn"
                    class="bg-blue-500 text-white rounded-r-md px-4 py-2 hover:bg-blue-600"><i
                        class="fas fa-search"></i></button>
            </form>
        </div>
    </section>
    <!-- Search form section ends -->

    <section class="bg-gray-100 py-4">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php
            if(isset($_POST['search_box']) || isset($_POST['search_btn'])){
               $search_box = $_POST['search_box'];
               $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
               $select_products->execute();
               if($select_products->rowCount() > 0){
                  while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
                <form action="" method="post" class="relative bg-white p-4 shadow-md rounded-md">
                    <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                    <img src="resto-images/<?= $fetch_products['image']; ?>" alt="">
                    <a href="category.php?category=<?= $fetch_products['category']; ?>" class="text-gray-600">
                        <?= $fetch_products['category']; ?>
                    </a>

                    </a>
                    <div class="text-lg font-semibold text-gray-800 mt-2"><?= $fetch_products['name']; ?></div>
                    <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>"
                        class="hover-button absolute inset-12 opacity-0 flex items-center justify-center text-white bg-blue-300 rounded-full transition-opacity duration-300 hover:opacity-100 h-10">
                        View Details
                    </a>
                </form>
                <?php
                  }
               } else {
                  echo '<p class="empty text-2xl text-center mt-8">No products found!</p>';
               }
            }
         ?>
            </div>
        </div>
    </section>

    <!-- Footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- Footer section ends -->

    <!-- Custom JS file link -->
    <script src="js/script.js"></script>

</body>

</html>