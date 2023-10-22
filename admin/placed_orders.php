<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placed Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">

    <?php include '../components/admin_header.php' ?>

    <section class="placed-orders pr-6 pl-6">
        <h1 class="text-3xl text-blue-600 font-bold mb-8">Placed Orders</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            if ($select_orders->rowCount() > 0) {
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="bg-white border border-gray-200 shadow-md rounded p-6">
                <p class="mb-2">User ID: <span><?= $fetch_orders['user_id']; ?></span></p>
                <p class="mb-2">Placed On: <span><?= $fetch_orders['placed_on']; ?></span></p>
                <p class="mb-2">Name: <span><?= $fetch_orders['name']; ?></span></p>
                <p class="mb-2">Email: <span><?= $fetch_orders['email']; ?></span></p>
                <p class="mb-2">Number: <span><?= $fetch_orders['number']; ?></span></p>
                <p class="mb-2">Address: <span><?= $fetch_orders['address']; ?></span></p>
                <p class="mb-2">Total Products: <span><?= $fetch_orders['total_products']; ?></span></p>
                <p class="mb-2">Total Price: <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
                <p class="mb-2">Payment Method: <span><?= $fetch_orders['method']; ?></span></p>

                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                    <select name="payment_status" class="border border-gray-200 rounded p-2 mb-2">
                        <option value="<?= $fetch_orders['payment_status']; ?>" selected disabled>
                            <?= $fetch_orders['payment_status']; ?></option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                    <div class="flex space-x-4">
                        <input type="submit" value="Update"
                            class="bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white rounded-md p-2 cursor-pointer">
                        <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>"
                            class="bg-blue-100 text-blue-600 hover:bg-red-600 hover:text-white rounded-md p-2 cursor-pointer"
                            onclick="return confirm('Delete this order?')">Delete</a>
                    </div>
                </form>
            </div>
            <?php
                }
            } else {
                echo '<p class="empty">No orders placed yet!</p>';
            }
            ?>

        </div>
    </section>
    <script src="../js/admin_script.js"></script>

</body>

</html>