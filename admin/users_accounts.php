<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_users->execute([$delete_id]);
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_order->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:users_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <?php include '../components/admin_header.php' ?>

    <section class="bg-white">
        <h1 class="text-blue-600 text-3xl text-center my-8">Users Account</h1>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php
            $select_account = $conn->prepare("SELECT * FROM `users`");
            $select_account->execute();
            if ($select_account->rowCount() > 0) {
                while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
                    ?>
            <div class="bg-white border border-black rounded shadow p-4">
                <p class="text-black">User ID: <span class="text-main-color"><?= $fetch_accounts['id']; ?></span></p>
                <p class="text-black">Username: <span class="text-main-color"><?= $fetch_accounts['name']; ?></span></p>
                <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>"
                    class="delete-btn text-white bg-red-500 hover:bg-red-600 hover:text-white"
                    onclick="return confirm('Delete this account?')">Delete</a>
            </div>
            <?php
                }
            } else {
                echo '<p class="bg-white border border-black p-4 text-red-500 rounded shadow-box">No accounts available</p>';
            }
            ?>
        </div>
    </section>

    <script src="../js/admin_script.js"></script>
</body>

</html>