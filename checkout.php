<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if (isset($_SESSION['user_profile'])) {
        $fetch_profile = $_SESSION['user_profile'];
    } else {
        $fetch_profile = array(
            'name' => '',
            'number' => '',
            'email' => '',
            'address' => ''
        );
    }
} else {
    $user_id = '';
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $delete_cart->execute([$user_id]);

    $message[] = 'Berhasil checkout! Silahkan tunggu pesanan anda!';
    header('location: menu.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">

    <?php include 'components/user_header.php' ?>
    <?php include 'components/back_to_cart.php' ?>

    <section class="checkout bg-gray-100 min-h-screen flex items-center justify-center w-full md:px-10">
        <div class="w-full bg-white rounded shadow-lg">
            <form action="" method="post" class="p-4 grid justify-items-center">
                <h1 class="text-2xl font-bold text-center mb-4">Info Pesanan</h1>

                <div class="cart-items mb-4">
                    <?php
                        $grand_total = 0;
                        $cart_items = [];
                        $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                        $select_cart->execute([$user_id]);
                        if ($select_cart->rowCount() > 0) {
                            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                                $cart_items[] = $fetch_cart['name'] . ' (' . 'RP' . number_format($fetch_cart['price'] * $fetch_cart['quantity'], 0, ',', '.') . ')';
                                $total_products = implode($cart_items);
                                $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                    ?>
                     <div class="flex items-center justify-between">
                        <span class="name text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl"><?= $fetch_cart['name']; ?></span>
                        <span class="text-gray-600">.............................................</span>
                        <span class="price text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl">Rp.
                            <?= number_format($fetch_cart['price'] * $fetch_cart['quantity'], 0, ',', '.'); ?>,000</span>
                    </div>
                    <?php
                     }
                  } else {
                     echo '<p class="empty text-center">Your cart is empty!</p>';
                  }
                  ?>
                </div>

                <p class="grand-total flex flex-col justify-center items-center">
                    <span class="name text-xl font-bold">Total Keseluruhan:</span>
                    <span class="price font-semibold text-red-600">Rp. <?= number_format($grand_total, 0, ',', '.'); ?>,000</span>
                </p>

                <div class="user-info mt-4 md:grid grid-cols-3 gap-40 px-4">
                    <div class="flex flex-col justify-center">
                        <p><i class="fas fa-user mr-4"></i><span><?= $fetch_profile['name'] ?></span></p>
                        <p><i class="fas fa-phone mr-4"></i><span><?= $fetch_profile['number'] ?></span></p>
                        <p><i class="fas fa-envelope mr-4"></i><span><?= $fetch_profile['email'] ?></span></p>

                        <a href="update_profile.php"
                            class="btn bg-transparent hover:bg-blue-100 text-blue-500 border-2 border-blue-500 py-2 text-center rounded-full mt-4">Update
                            Info</a>
                    </div>

                    <div class="flex flex-col">
                        <h3 class="text-xl font-semibold mt-4">Alamat Pengiriman</h3>
                        <p><i class="fas fa-map-marker-alt mr-4"></i><span><?php
                            if ($fetch_profile['address'] == '') {
                                echo 'Please enter your address';
                            } else {
                                echo $fetch_profile['address'];
                            } ?></span></p>

                        <a href="update_address.php"
                            class="btn bg-transparent hover:bg-blue-100 text-blue-500 border-2 border-blue-500 py-2 text-center rounded-full mt-4">Update
                            Address</a>
                    </div>

                    <div class="flex flex-col">
                        <label class="block mt-4">
                            <select name="method" class="input mt-1" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="cod">Bayar Langsung</option>
                                <option value="debit-card">Debit Card</option>
                                <option value="qr-code">QR Payment</option>
                                <option value="pay-later">PayLater</option>
                            </select>
                        </label>
                        <input type="submit" value="Checkout" name="submit" class="btn bg-transparent hover:bg-blue-100 text-blue-500 border-2 border-blue-500 py-2 text-center rounded-full mt-4">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include 'components/footer.php' ?>
    <script src="js/script.js"></script>

</body>

</html>