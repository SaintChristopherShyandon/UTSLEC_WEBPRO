<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body class="bg-white">

    <?php include '../components/admin_header.php' ?>

    <section class="dashboard mb-10">

        <h1 class="text-blue-600 text-3xl mb-8 pl-6 pt-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 pr-6 pl-6">
            <div class="bg-white border border-black rounded-lg p-4 text-center">
                <h3 class="text-2xl mb-2">Welcome!</h3>
                <p><?= $fetch_profile['name']; ?></p>
                <a href="update_profile.php" class="btn bg-blue-100 text-blue-600">Update Profile</a>
            </div>

            <div class="bg-white border border-black rounded-lg p-4 text-center">
                <?php
                $select_products = $conn->prepare("SELECT * FROM `products`");
                $select_products->execute();
                $numbers_of_products = $select_products->rowCount();
                ?>
                <h3 class="text-2xl mb-2"><?= $numbers_of_products; ?></h3>
                <p class="mb-2">Products Added</p>
                <a href="products.php" class="btn bg-blue-100 text-blue-600">See Products</a>
            </div>

            <div class="bg-white border border-black rounded-lg p-4 text-center">
                <?php
                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();
                $numbers_of_users = $select_users->rowCount();
                ?>
                <h3 class="text-2xl mb-2"><?= $numbers_of_users; ?></h3>
                <p class="mb-2">User Accounts</p>
                <a href="users_accounts.php" class="btn bg-blue-100 text-blue-600">See Users</a>
            </div>

            <div class="bg-white border border-black rounded-lg p-4 text-center">
                <?php
                $select_admins = $conn->prepare("SELECT * FROM `admin`");
                $select_admins->execute();
                $numbers_of_admins = $select_admins->rowCount();
                ?>
                <h3 class="text-2xl mb-2"><?= $numbers_of_admins; ?></h3>
                <p class="mb-2">Admins</p>
                <a href="admin_accounts.php" class="btn bg-blue-100 text-blue-600">See Admins</a>
            </div>
        </div>

    </section>
    <script src="../js/admin_script.js"></script>

</body>

</html>