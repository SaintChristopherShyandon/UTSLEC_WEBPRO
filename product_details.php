<?php
include 'components/connect.php';

if(isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
    
    $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_product->execute([$product_id]);
    
    if($select_product->rowCount() > 0) {
        $product = $select_product->fetch(PDO::FETCH_ASSOC);
    } else {
        // Handle the case when the product is not found.
    }
} else {
    // Handle the case when pid is not provided.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name'] ?> Details</title>
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include your header or navigation here -->

    <div class="container">
        <h1 class="text-3xl font-bold"><?= $product['name'] ?></h1>
        <p class="text-gray-600"><?= $product['category'] ?></p>
        <p class="text-2xl font-semibold">$<?= $product['price'] ?></p>
        <img src="uploaded_img/<?= $product['image'] ?>" alt="<?= $product['name'] ?> Image">
        <p><?= $product['description'] ?></p>
    </div>

    <!-- Include your footer here -->

    <!-- Add your JavaScript file links here if needed -->
</body>
</html>
