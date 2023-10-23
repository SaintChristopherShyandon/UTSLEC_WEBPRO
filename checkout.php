<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Periksa apakah sesi 'user_profile' telah diinisialisasi
    if (isset($_SESSION['user_profile'])) {
        // Jika ya, maka ambil profil pengguna dari sesi
        $fetch_profile = $_SESSION['user_profile'];
    } else {
        // Jika tidak, atur $fetch_profile ke nilai default
        $fetch_profile = array(
            'name' => '',
            'number' => '',
            'email' => '',
            'address' => ''
        );
    }
} else {
    $user_id = '';
    header('location:home.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {
        if ($address == '') {
            $message[] = 'Please add your address!';
        } else {
            $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

            $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart->execute([$user_id]);

            $message[] = 'Order placed successfully!';
        }
    } else {
        $message[] = 'Your cart is empty';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Tailwind CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">

    <?php include 'components/user_header.php' ?>

    <div class="bg-gray-200 p-4">
        <h3 class="text-2xl text-center">Checkout</h3>
        <p class="mt-2 text-center">
            <a href="home.php">Home</a>
            <span class="mx-2">/</span>
            <span>Checkout</span>
        </p>
    </div>

    <section class="checkout bg-gray-100 min-h-screen flex items-center justify-center">

        <div class="max-w-xl w-full bg-white rounded shadow-lg">
            <form action="" method="post" class="p-4 grid justify-items-center">
                <h1 class="text-2xl font-bold text-center mb-4">Info Pesanan</h1>

                <div class="cart-items mb-4">
                    <h3 class="text-xl font-semibold">Cart Items</h3>
                    <?php
                  $grand_total = 0;
                  $cart_items = [];
                  $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                  $select_cart->execute([$user_id]);
                  if ($select_cart->rowCount() > 0) {
                     while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                           $cart_items[] = $fetch_cart['name'] . ' (' . 'RP' . number_format($fetch_cart['price'] * $fetch_cart['quantity'], 0, ',', '.') . ')';
                           $total_products = implode($cart_items);
                           $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                           ?>
                    <p class="text-left">
                        <span class="name"><?= $fetch_cart['name']; ?></span>
                        <span
                            class="price">RP<?= number_format($fetch_cart['price'] * $fetch_cart['quantity'], 0, ',', '.'); ?>,000</span>
                    </p>
                    <?php
                     }
                  } else {
                     echo '<p class="empty text-center">Your cart is empty!</p>';
                  }
                  ?>
                </div>

                <p class="grand-total text-left">
                    <span class="name">Grand Total:</span>
                    <span class="price">RP<?= number_format($grand_total, 0, ',', '.'); ?>,000</span>
                </p>


                <a href="cart.php"
                    class="btn bg-transparent hover:bg-transparent text-blue-500 hover:text-blue-600 border-2 border-blue-500 hover:border-blue-600 text-white py-2 px-4 rounded-full">View
                    Cart</a>

                <div class="user-info mt-4 grid justify-items-center">
                    <h3 class="text-xl font-semibold">Info</h3>
                    <p><i class="fas fa-user"></i><span><?= $fetch_profile['name'] ?></span></p>
                    <p><i class="fas fa-phone"></i><span><?= $fetch_profile['number'] ?></span></p>
                    <p><i class="fas fa-envelope"></i><span><?= $fetch_profile['email'] ?></span></p>

                    <a href="update_profile.php"
                        class="btn bg-transparent hover:bg-transparent text-blue-500 hover:text-blue-600 border-2 border-blue-500 hover:border-blue-600 text-white py-2 px-4 rounded-full mt-4">Update
                        Info</a>

                    <h3 class="text-xl font-semibold mt-4">Delivery Address</h3>
                    <p><i class="fas fa-map-marker-alt"></i><span><?php
                            if ($fetch_profile['address'] == '') {
                                echo 'Please enter your address';
                            } else {
                                echo $fetch_profile['address'];
                            } ?></span></p>

                    <a href="update_address.php"
                        class="btn bg-transparent hover:bg-transparent text-blue-500 hover:text-blue-600 border-2 border-blue-500 hover:border-blue-600 text-white py-2 px-4 rounded-full mt-4">Update
                        Address</a>

                    <label class="block mt-4">Select Payment Method
                        <select name="method" class="input mt-1" required>
                            <option value="" disabled selected>Select Payment Method --</option>
                            <option value="cash on delivery">Cash on Delivery</option>
                            <option value="credit card">Credit Card</option>
                            <option value="paytm">Paytm</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </label>

                    <input type="submit" value="Place Order" name="submit" class="btn <?php if ($fetch_profile['address'] == '') {
                               echo 'cursor-not-allowed';
                           } ?> block w-full mt-4" style="background: var(--red); color: var(--white);">

                </div>
            </form>
        </div>
    </section>

    <?php include 'components/footer.php' ?>

    <!-- custom js file link -->
    <script src="js/script.js"></script>

</body>

</html>