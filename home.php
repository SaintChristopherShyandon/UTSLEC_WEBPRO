<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
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

    <section class="bg-blue-100 py-12">
        <h1 class="text-3xl font-bold text-center -mt-6 mb-8">Kategori Makanan</h1>

        <div class="container mx-auto flex justify-between gap-4">
            <a href="category.php" class="block">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200 transition-all duration-300">
                    <img src="images/cat-1.png" alt="" class="w-20 mx-auto block">
                    <a href="category.php">
                        <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Makanan Cepat Saji</h5>
                    </a>
                    <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Makanan yang disajikan dan disiapkan dengan cepat dalam waktu yang singkat</p>
                </div>
            </a>

            <a href="category.php">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200 transition-all duration-300">
                    <img src="images/cat-2.png" alt="" class="w-20 mx-auto block">
                    <a href="category.php">
                        <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Hidangan Utama</h5>
                    </a>
                    <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Hidangan yang biasanya menjadi fokus utama dalam suatu waktu makan</p>
                </div>
            </a>

            <a href="category.php">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200 transition-all duration-300">
                    <img src="images/cat-3.png" alt="" class="w-20 mx-auto block">
                    <a href="category.php">
                        <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Minuman</h5>
                    </a>
                    <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Segala jenis cairan yang dikonsumsi untuk menghilangkan dahaga, memberikan nutrisi, atau sekedar kenikmatan rasa</p>
                </div>
            </a>

            <a href="category.php">
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-200 transition-all duration-300">
                    <img src="images/cat-4.png" alt="" class="w-20 mx-auto block">
                    <a href="category.php">
                        <h5 class="mb-2 text-center text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Makanan Penutup</h5>
                    </a>
                    <p class="mb-3 text-center font-normal text-gray-500 dark:text-gray-400">Hidangan yang disajikan setelah hidangan utama untuk menyegarkan mulut dan memberikan kenikmatan manis setelah makan</p>
                </div>
            </a>
        </div>
    </section>

    <section class="text-center py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Hidangan Terbaru</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 12");
            $select_products->execute();

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
                        <a href="menu.php" class="hover-button absolute inset-12 opacity-0 flex items-center justify-center text-white bg-blue-300 rounded-full transition-opacity duration-300 hover:opacity-100">
                            View Details
                        </a>
                    </form>
                    <?php
                }
            } else {
                echo '<p class="text-2xl text-gray-800">No products added yet!</p>';
            }
            ?>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <script>
        // List images dan title
        const images = [
            { src: "images/home-img-1.png", title: "Nasi Goreng Maknyus" },
            { src: "images/home-img-2.png", title: "Es Podeng Seger" },
            { src: "images/home-img-3.png", title: "Es Teh Manis" }
        ];

        // Function untuk update image dan title
        function updateImage() {
            const randomIndex = Math.floor(Math.random() * images.length);
            const foodImage = document.getElementById("foodImage");
            const foodTitle = document.getElementById("foodTitle");

            foodImage.src = images[randomIndex].src;
            foodTitle.textContent = images[randomIndex].title;
        }

        // Update image setiap 3 seconds (3000 milliseconds)
        setInterval(updateImage, 3000);

        // Initial image update
        updateImage();
    </script>

</body>
</html>
