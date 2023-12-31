<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:index.php');
}

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_item->execute([$cart_id]);
    $message[] = 'cart item deleted!';
}

if (isset($_POST['delete_all'])) {
    $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_item->execute([$user_id]);
    $message[] = 'deleted all from cart!';
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'cart quantity updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <?php include 'components/back_to_menu.php'; ?>
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-center">Keranjang</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8">
                <?php
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total += $sub_total;
                ?>
                <div class="flex justify-center"> <!-- Wrap each card in a flex container and center it -->
                    <form action="" method="post" class="bg-white p-4 shadow-md rounded-md">
                        <div class="flex justify-center mb-2 space-x-4">
                            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                            <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye text-blue-600"></a>
                            <button type="submit" class="fas fa-times text-red-600" name="delete"
                                onclick="return confirm('Delete this item?');"></button>
                        </div>

                        <img src="resto-images/<?= $fetch_cart['image']; ?>" alt="" class="w-90 h-32 mx-auto">
                        <div class="text-xl font-semibold mt-2"><?= $fetch_cart['name']; ?></div>
                        <div class="flex items-center mt-2">
                            <div class="text-blue-600 text-xl font-semibold">
                                Rp.<?= number_format((float)$fetch_cart['price'], 0, ',', '.') . ",000"; ?></div>
                            <input type="number" name="qty" class="ml-2 border border-gray-300 p-2 rounded-md w-12"
                                min="1.000" max="99.000.000" value="<?= $fetch_cart['quantity']; ?>" maxlength="5">
                            <button type="submit" class="fas fa-edit text-blue-600 ml-2" name="update_qty"></button>
                        </div>
                        <div class="text-xl font-semibold mt-2">Subtotal:
                            Rp.<?= number_format((float)$sub_total, 0, ',', '.') . ",000"; ?></div>
                    </form>
                </div>
                <?php
                }
                } else {
                    echo '<p class="text-2xl text-center mt-8">Your cart is empty</p>';
                }
                ?>
            </div>


            <div class="text-2xl text-center font-semibold mt-8 mb-3">Cart Total: Rp.<?= $grand_total; ?>,000</div>
            <div class="flex justify-center">
                <a href="checkout.php"
                class="btn bg-black text-white p-2 px-5 font-semibold rounded-full bg-blue-500 <?= ($grand_total > 1) ? '' : 'cursor-not-allowed' ?>">
                    Process to Checkout
                </a>
            </div>

            <div class="mt-8 text-center">
                <form action="" method="post">
                    <button type="submit"
                        class="delete-btn bg-black text-white p-2 px-5 font-semibold  rounded-full bg-blue-500 mb-3 <?= ($grand_total > 1) ? '' : 'cursor-not-allowed' ?>"
                        name="delete_all" onclick="return confirm('Delete all items from cart?');">Delete All
                    </button>
                </form>
            </div>
        </div>
    </section>
    <?php include 'components/footer.php'; ?>
    <script src="js/script.js"></script>

</body>

</html>