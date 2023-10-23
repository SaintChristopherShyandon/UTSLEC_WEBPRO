<?php
include 'components/connect.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];
} else {
    $category = null;
}

$select_products = $conn->prepare("SELECT * FROM `products`" . ($category ? " WHERE category = :category" : "") . " LIMIT 12");

if ($category) {
    $select_products->bindParam(':category', $category, PDO::PARAM_STR);
}

$select_products->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>

    <!-- Tailwind CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <!-- Display the category name or any message you want -->
    <?php if ($category) : ?>
    <h1 class="text-2xl font-bold mt-20 mb-6 flex justify-center">Kategori: <?= $category ?></h1>
    <?php endif; ?>

    <!-- Display the products based on the category or all products if no category selected -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php
        if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
        <form action="" method="post" class="relative bg-white p-4 shadow-md rounded-md">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <img src="resto-images/<?= $fetch_products['image']; ?>" alt="">
            <a href="category.php?category=<?= $fetch_products['category']; ?>" class="text-gray-600">
                <?= $fetch_products['category']; ?>
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
            echo '<p class="text-2xl text-gray-800">No products found for this category.</p>';
        }
        ?>
    </div>
</body>

</html>